<?php
/**
 * GR Stratégie — envoi du formulaire de contact (/api/contact/).
 * PHP 8.4, hébergement mutualisé IONOS (Apache). Aucune dépendance.
 *
 * Contrat : POST multipart/urlencoded ; réponse JSON si Accept contient
 * application/json, sinon redirection 303 vers /contact?envoi=…
 *
 * Pas de jeton CSRF en session : le site est statique (pas de session ni
 * de compte), le formulaire est public et l'action ne fait qu'envoyer un
 * e-mail à GR Stratégie. Protection retenue : contrôle Origin/Referer,
 * pot de miel et limitation par IP.
 */

declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// --- Configuration ---------------------------------------------------------
const MAIL_TO   = 'contact@grstrategie.fr';
const MAIL_FROM = 'contact@grstrategie.fr'; // adresse du domaine (exigée par IONOS)
const RATE_MAX    = 5;    // envois autorisés…
const RATE_WINDOW = 600;  // … par IP sur 10 minutes
const REDIRECT_OK  = '/contact?envoi=ok#envoi-ok';
const REDIRECT_ERR = '/contact?envoi=erreur#envoi-erreur';
const MAX_BODY_BYTES = 65536; // taille maximale de la requête (le formulaire complet tient en ~25 Ko)
// Test local uniquement : GR_CONTACT_DRY_RUN=1 écrit le mail dans un fichier temporaire.
// Ignoré hors du serveur intégré de PHP (php -S) : jamais actif sous Apache en production.
define('MAIL_DRY_RUN', PHP_SAPI === 'cli-server' && getenv('GR_CONTACT_DRY_RUN') === '1');

const MAX_LEN = ['nom' => 120, 'email' => 254, 'message' => 5000, 'tel' => 20];
const TEL_REGEX = '/^(?:(?:\+|00)33\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/';

// Listes blanches : valeur envoyée => libellé visible.
const SUJETS = [
    'affichage'       => 'Affichage dynamique (location de la BoxVision)',
    'ecran'           => 'Écran du catalogue',
    'site_web'        => 'Site web',
    'print'           => 'Print et affichage publicitaire',
    'reseaux_sociaux' => 'Réseaux sociaux',
    'autre'           => 'Autre',
];
const DEMO_FORMATS = [
    'sur_place'      => 'Sur place',
    'visio'          => 'En visio',
    'pas_maintenant' => 'Pas pour le moment',
];
const DELAIS = [
    'semaine'   => 'Cette semaine',
    'mois'      => 'Ce mois-ci',
    'trimestre' => 'Ce trimestre',
];
const CRENEAUX = [
    'matin'      => 'Matin',
    'apres_midi' => 'Après-midi',
];

// --- Réponses --------------------------------------------------------------

function wants_json(): bool
{
    return str_contains(strtolower((string) ($_SERVER['HTTP_ACCEPT'] ?? '')), 'application/json');
}

/** Termine la requête : JSON (avec code HTTP) ou redirection 303. */
function respond(int $status, array $payload = []): never
{
    header('Cache-Control: no-store');
    header('X-Content-Type-Options: nosniff');
    header("Content-Security-Policy: default-src 'none'; frame-ancestors 'none'");
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: no-referrer');
    $ok = $status === 200;

    if ($status === 405) {
        header('Allow: POST');
    }
    if (wants_json()) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok] + $payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
    if ($status === 405) {
        http_response_code(405);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Méthode non autorisée.';
        exit;
    }
    http_response_code(303);
    header('Location: ' . ($ok ? REDIRECT_OK : REDIRECT_ERR));
    exit;
}

// --- Contrôles de la requête ----------------------------------------------

/**
 * Contrôle anti-CSRF. Chaque en-tête présent (Origin, Referer) doit désigner l'hôte
 * (et le port) de la requête ; « Origin: null » est refusé ; Sec-Fetch-Site
 * « cross-site » est refusé. Les navigateurs actuels envoient toujours Origin sur un
 * POST : une requête sans Origin ni Referer ne vient donc pas d'une page tierce
 * ouverte dans un navigateur ; elle est acceptée (clients qui masquent le Referer)
 * et reste soumise au pot de miel et à la limitation par IP.
 */
function origin_is_valid(): bool
{
    $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
    if (strtolower((string) ($_SERVER['HTTP_SEC_FETCH_SITE'] ?? '')) === 'cross-site') {
        return false;
    }
    foreach (['HTTP_ORIGIN', 'HTTP_REFERER'] as $h) {
        $source = (string) ($_SERVER[$h] ?? '');
        if ($source === '') {
            continue;
        }
        $parts = parse_url($source);
        if (!is_array($parts) || empty($parts['host']) || $host === ''
            || !in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https'], true)) {
            return false;
        }
        $sourceHost = strtolower($parts['host']) . (isset($parts['port']) ? ':' . $parts['port'] : '');
        if (!hash_equals($host, $sourceHost)) {
            return false;
        }
    }
    return true;
}

/** Requête de taille raisonnable et sans fichier joint. */
function size_is_valid(): bool
{
    $length = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);
    return $length <= MAX_BODY_BYTES && $_FILES === [];
}

// --- Normalisation et validation ------------------------------------------

/** Valeur texte d'un champ POST, nettoyée ; null si absente, non textuelle ou UTF-8 invalide. */
function field(string $name, bool $multiline = false): ?string
{
    $value = $_POST[$name] ?? '';
    if (!is_string($value) || !mb_check_encoding($value, 'UTF-8')) {
        return null;
    }
    if ($multiline) {
        $value = str_replace(["\r\n", "\r"], "\n", $value);
        $value = str_replace("\t", ' ', $value);
        // Contrôles C0/C1 et séparateurs Unicode retirés, sauf \n.
        $value = preg_replace('/[\x00-\x09\x0B-\x1F\x7F\x{80}-\x{9F}\x{2028}\x{2029}]/u', '', $value);
    } else {
        $value = preg_replace('/[\x00-\x1F\x7F\x{80}-\x{9F}\x{2028}\x{2029}]/u', '', $value);
    }
    return trim((string) $value);
}

/** Valide un texte obligatoire avec longueur maximale ; renvoie un code d'erreur ou null. */
function check_text(?string $value, int $max): ?string
{
    if ($value === null) {
        return 'invalid';
    }
    if ($value === '') {
        return 'required';
    }
    return mb_strlen($value, 'UTF-8') > $max ? 'too_long' : null;
}

/** Valide un choix dans une liste blanche (vide accepté si facultatif). */
function check_choice(?string $value, array $allowed, bool $required): ?string
{
    if ($value === null) {
        return 'invalid';
    }
    if ($value === '') {
        return $required ? 'required' : null;
    }
    return array_key_exists($value, $allowed) ? null : 'invalid';
}

/** Valide le formulaire. Renvoie [données propres, erreurs]. */
function validate(): array
{
    $d = [
        'nom'         => field('nom'),
        'email'       => field('email'),
        'sujet'       => field('sujet'),
        'demo_format' => field('demo_format'),
        'message'     => field('message', true),
        'delai'       => field('delai'),
        'rgpd'        => field('rgpd'),
        'rappel'      => isset($_POST['rappel']) && $_POST['rappel'] === 'oui',
    ];
    $errors = [
        'nom'         => check_text($d['nom'], MAX_LEN['nom']),
        'email'       => check_text($d['email'], MAX_LEN['email']),
        'sujet'       => check_choice($d['sujet'], SUJETS, true),
        'demo_format' => check_choice($d['demo_format'], DEMO_FORMATS, false),
        'message'     => check_text($d['message'], MAX_LEN['message']),
        'delai'       => check_choice($d['delai'], DELAIS, false),
        'rgpd'        => $d['rgpd'] === 'oui' ? null : 'required',
    ];
    if ($errors['email'] === null && filter_var($d['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'invalid';
    }

    // Téléphone et créneau : seulement si le rappel est demandé, sinon ignorés.
    if ($d['rappel']) {
        $d['tel'] = field('tel');
        $d['creneau'] = field('creneau');
        $errors['tel'] = check_text($d['tel'], MAX_LEN['tel']);
        if ($errors['tel'] === null && !preg_match(TEL_REGEX, $d['tel'])) {
            $errors['tel'] = 'invalid';
        }
        $errors['creneau'] = check_choice($d['creneau'], CRENEAUX, true);
    }

    return [$d, array_filter($errors, static fn ($e) => $e !== null)];
}

// --- Limitation par IP -----------------------------------------------------

/**
 * Clé de l'IP du visiteur : REMOTE_ADDR uniquement (X-Forwarded-For & co. sont
 * fournis par le client et ne sont jamais crus). IPv6 regroupée par /64, préfixe
 * attribué à un même abonné, pour empêcher la rotation d'adresses.
 */
function client_ip_key(): string
{
    $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? '');
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $bin = inet_pton($ip);
        if ($bin !== false && !str_starts_with($bin, str_repeat("\0", 10) . "\xff\xff")) {
            return bin2hex(substr($bin, 0, 8)) . '::/64';
        }
        return (string) inet_ntop(substr((string) $bin, 12)); // IPv4 notée en IPv6
    }
    return $ip;
}

/** Dossier des données anti-abus : hors racine web si possible, sinon dossier temporaire. */
function data_dir(): ?string
{
    $candidates = [];
    if (($env = getenv('GR_CONTACT_DATA_DIR')) !== false && $env !== '') {
        $candidates[] = rtrim($env, '/');
    }
    if (!empty($_SERVER['DOCUMENT_ROOT'])) {
        $candidates[] = dirname((string) $_SERVER['DOCUMENT_ROOT']) . '/gr-contact-data';
    }
    $candidates[] = rtrim(sys_get_temp_dir(), '/') . '/gr-contact-data';

    foreach ($candidates as $dir) {
        if ((is_dir($dir) || @mkdir($dir, 0700, true)) && is_writable($dir)) {
            protect_dir($dir);
            return $dir;
        }
    }
    return null;
}

/**
 * Le dossier parent de la racine web peut lui-même être servi (autre domaine du même
 * hébergement) : on y interdit tout accès HTTP et on restreint les droits.
 */
function protect_dir(string $dir): void
{
    @chmod($dir, 0700);
    $ht = $dir . '/.htaccess';
    if (!is_file($ht)) {
        @file_put_contents($ht, "Require all denied\n", LOCK_EX);
        @chmod($ht, 0644);
    }
}

/** Sel aléatoire propre au serveur, créé au premier usage (appelé sous verrou). */
function salt(string $dir): string
{
    $file = $dir . '/sel.txt';
    $salt = is_file($file) ? trim((string) @file_get_contents($file)) : '';
    if (strlen($salt) < 32) {
        $salt = bin2hex(random_bytes(32));
        @file_put_contents($file, $salt, LOCK_EX);
        @chmod($file, 0600);
    }
    return $salt;
}

/**
 * Enregistre une tentative d'envoi pour l'IP et indique si elle est autorisée.
 * Seule l'empreinte de l'IP (sha256 + sel) et l'heure sont conservées.
 * En cas d'indisponibilité du stockage, l'envoi n'est pas bloqué.
 */
function rate_limit_allows(): bool
{
    $dir = data_dir();
    if ($dir === null) {
        error_log('gr-contact : dossier anti-abus indisponible');
        return true;
    }
    $fh = @fopen($dir . '/compteur.json', 'c+');
    if ($fh === false || !flock($fh, LOCK_EX)) {
        error_log('gr-contact : compteur anti-abus inaccessible');
        return true;
    }
    @chmod($dir . '/compteur.json', 0600);
    // Sel lu ou créé sous le verrou : deux premières requêtes simultanées partagent le même.
    $key = hash('sha256', salt($dir) . '|' . client_ip_key());

    $now = time();
    $data = json_decode((string) stream_get_contents($fh), true);
    $data = is_array($data) ? $data : [];
    // Purge des entrées expirées.
    foreach ($data as $hash => $times) {
        $times = array_values(array_filter((array) $times, static fn ($t) => is_int($t) && $t > $now - RATE_WINDOW));
        if ($times === []) {
            unset($data[$hash]);
        } else {
            $data[$hash] = $times;
        }
    }

    $allowed = count($data[$key] ?? []) < RATE_MAX;
    if ($allowed) {
        $data[$key][] = $now;
    }
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, (string) json_encode($data));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
    return $allowed;
}

// --- Composition et envoi du mail -----------------------------------------

/** Encode une valeur d'en-tête (UTF-8, base64) sans aucun CR/LF. */
function header_encode(string $value): string
{
    $value = preg_replace('/[\r\n]+/', ' ', $value);
    $encoded = mb_encode_mimeheader((string) $value, 'UTF-8', 'B', "\r\n");
    return (string) preg_replace('/\r\n[ \t]*/', ' ', $encoded);
}

/** Nom d'affichage d'adresse : caractères spéciaux RFC 5322 retirés (le nom complet reste dans le corps). */
function display_name(string $name): string
{
    $clean = trim((string) preg_replace('/\s+/', ' ', strtr($name, '",;:<>()[]\\@', '             ')));
    return header_encode($clean !== '' ? $clean : 'Visiteur');
}

/** Coupe les lignes trop longues pour un envoi en 8bit (limite de 998 octets). */
function safe_lines(string $text): string
{
    $out = [];
    foreach (explode("\n", $text) as $line) {
        if (strlen($line) <= 900) {
            $out[] = $line;
            continue;
        }
        foreach (mb_str_split($line, 220, 'UTF-8') as $chunk) {
            $out[] = $chunk;
        }
    }
    return implode("\n", $out);
}

/** Corps du mail en texte brut, avec les libellés visibles des options. */
function build_body(array $d): string
{
    $date = new DateTimeImmutable('now', new DateTimeZone('Europe/Paris'));
    $lines = [
        'Nouvelle demande depuis le formulaire de contact du site.',
        '',
        'Nom / Entreprise : ' . $d['nom'],
        'E-mail : ' . $d['email'],
        'Sujet : ' . SUJETS[$d['sujet']],
        'Format de démo : ' . ($d['demo_format'] !== '' ? DEMO_FORMATS[$d['demo_format']] : 'Non précisé'),
        'Délai souhaité : ' . ($d['delai'] !== '' ? DELAIS[$d['delai']] : 'Indifférent'),
    ];
    if ($d['rappel']) {
        $lines[] = 'Rappel demandé : oui';
        $lines[] = 'Téléphone : ' . $d['tel'];
        $lines[] = 'Créneau souhaité : ' . CRENEAUX[$d['creneau']];
    } else {
        $lines[] = 'Rappel demandé : non';
    }
    $lines[] = '';
    $lines[] = 'Message :';
    $lines[] = $d['message'];
    $lines[] = '';
    $lines[] = '--';
    $lines[] = 'Envoyé le ' . $date->format('d/m/Y à H:i') . ' (heure de Paris).';
    $lines[] = 'Répondre à ce message écrit directement au visiteur.';
    return safe_lines(implode("\n", $lines)) . "\n";
}

/** Envoie le mail (ou l'écrit dans un fichier en mode test). */
function send_mail(array $d): bool
{
    $subject = header_encode('Contact site | ' . SUJETS[$d['sujet']] . ' | ' . $d['nom']);
    $headers = [
        'From'                      => header_encode('Site GR Stratégie') . ' <' . MAIL_FROM . '>',
        'Reply-To'                  => display_name($d['nom']) . ' <' . $d['email'] . '>',
        'MIME-Version'              => '1.0',
        'Content-Type'              => 'text/plain; charset=UTF-8',
        'Content-Transfer-Encoding' => '8bit',
    ];
    $body = build_body($d);

    if (MAIL_DRY_RUN) {
        return dry_run_write(MAIL_TO, $subject, $headers, $body);
    }
    return mail(MAIL_TO, $subject, $body, $headers, '-f' . MAIL_FROM);
}

/** Mode test : écrit le mail composé dans un fichier du dossier temporaire système. */
function dry_run_write(string $to, string $subject, array $headers, string $body): bool
{
    $dir = rtrim(sys_get_temp_dir(), '/') . '/gr-contact-dry-run';
    if (!is_dir($dir) && !@mkdir($dir, 0700, true)) {
        return false;
    }
    $raw = 'To: ' . $to . "\r\nSubject: " . $subject . "\r\n";
    foreach ($headers as $name => $value) {
        $raw .= $name . ': ' . $value . "\r\n";
    }
    $raw .= "\r\n" . $body;
    $file = $dir . '/mail-' . date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.eml';
    return @file_put_contents($file, $raw) !== false;
}

// --- Traitement ------------------------------------------------------------

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    respond(405);
}
if (!origin_is_valid() || !size_is_valid()) {
    respond(400);
}
// Pot de miel rempli : faux succès, aucun envoi.
if (($_POST['website'] ?? '') !== '') {
    respond(200);
}

[$data, $errors] = validate();
if ($errors !== []) {
    respond(422, ['errors' => $errors]);
}
if (!rate_limit_allows()) {
    respond(429);
}
if (!send_mail($data)) {
    error_log('gr-contact : échec de l\'envoi du mail');
    respond(500);
}
respond(200);
