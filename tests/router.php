<?php
// Routeur du serveur de prévisualisation local (php -S) : imite le futur .htaccess.
// /contact → contact.html ; /index.html → / ; le reste est servi tel quel.
declare(strict_types=1);

$root = realpath(__DIR__ . '/../site');
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');

// Page Solutions supprimée (revue du 10/11/2026) → page GR Vision (301), comme en production
if (preg_match('#^/solutions(\.html)?/?$#', $path)) {
    header('Location: /affichage-dynamique', true, 301);
    return true;
}

// Anciennes URL en .html → URL propre (301), comme en production
if (preg_match('#^/(index|affichage-dynamique|creation-site-web|community-management|print-affichage-publicitaire|contact|mentions-legales|confidentialite)\.html$#', $path, $m)) {
    $cible = $m[1] === 'index' ? '/' : '/' . $m[1];
    $qs = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: ' . $cible . ($qs !== '' ? '?' . $qs : ''), true, 301);
    return true;
}

// URL propre → fichier .html correspondant
if ($path !== '/' && !str_contains($path, '.')) {
    $fichier = $root . '/' . trim($path, '/') . '.html';
    if (is_file($fichier) && str_starts_with(realpath($fichier), $root)) {
        header('Content-Type: text/html; charset=utf-8');
        readfile($fichier);
        return true;
    }
    if (!is_dir($root . $path)) { // page inconnue : vrai 404 (php -S renverrait l'accueil)
        http_response_code(404);
        echo 'Page introuvable';
        return true;
    }
}

return false; // fichiers réels (assets, /api/contact/) servis par php -S
