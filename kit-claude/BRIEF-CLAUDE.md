# BRIEF — Refonte de grstrategie.fr en HTML / CSS / JS pur (charte GR v2.1)

> **À coller tel quel comme premier message à Claude**, avec tous les fichiers du kit joints (ou ajoutés à un Projet Claude).
> Langue de travail et du site : **français**. Interlocuteur : **Jean-Philippe (JP)**, GR Stratégie.

---

## 0. ⛔ RÈGLE N° 1 — STOP ET DEMANDE (avant toute ligne de code)

Avant d'écrire le moindre code, tu dois :

1. **Lister les fichiers que tu as reçus** (chemin + rôle), en les comparant à la liste attendue du § 11.
2. **Lister les fichiers manquants** (liste attendue § 11 + éléments connus comme manquants § 12).
3. **Poser à JP, en une seule fois, toutes les questions** du § 12 qui bloquent la page d'accueil.
4. **Attendre sa réponse.**

Et pendant tout le projet :
- S'il te manque un fichier source (photo, rendu, police, script PHP, `.htaccess`, logo…) : **tu t'arrêtes et tu le demandes**. Tu n'inventes pas, tu ne remplaces pas par une image de banque, une image générée, une icône « au hasard » ou un fichier trouvé en ligne.
- S'il manque un texte pour une section (marqué **[TEXTE MANQUANT – demander à JP]**) : tu demandes. Tu n'écris pas de texte « en attendant », pas de lorem ipsum.
- Si un élément est marqué **[PROPOSITION – à valider par JP]** : tu le présentes à JP et tu attends son accord.
- Si deux sources se contredisent : tu appliques l'ordre de priorité du § 2 **et tu signales la contradiction à JP**.
- Des **emplacements photo neutres et clairement étiquetés** (comme `.ph` dans la maquette) ne sont autorisés **que si JP le dit explicitement**.
- **Tu ne mets jamais rien en ligne toi-même** (pas de FTP, pas de déploiement, pas d'envoi). Tu livres des fichiers ; JP (ou son agent Admin Sites) publie.

---

## 1. Contexte

- **GR Stratégie** : agence de communication de proximité à **Mulhouse** (26 rue Victor Schoelcher, 68200 Mulhouse), SARL, gérante **Catherine Rubiero**.
- Activité principale mise en avant : **location d'affichage dynamique** avec **la Box Vision** (petit boîtier branché derrière un écran, piloté depuis un logiciel simple), à partir de **35 € TTC/mois**. Activités secondaires : sites web, création graphique et print, réseaux sociaux.
- Cibles : commerces, PME, collectivités, événements de Mulhouse et du Haut-Rhin.
- Le site actuel (2025) est daté et partiellement « en construction ». On le **refait entièrement** avec la **charte v2.1 validée par JP le 09/11/2026**.
- **Hébergement : IONOS** (Apache, HTTPS). Site **statique** HTML/CSS/JS, **sans WordPress, sans framework, sans étape de build** (pas de npm, pas de Tailwind, pas de React). **PHP 8.4** existe sur le serveur **uniquement** pour le script du formulaire `/api/contact/` (déjà en place et fonctionnel).
- **5 pages** : Accueil `/` (`index.html`), Solutions `/solutions`, Contact `/contact`, Mentions légales `/mentions-legales`, Confidentialité `/confidentialite`.

---

## 2. Sources et ordre de priorité

| Dossier du kit | Contenu | Fait foi pour |
|---|---|---|
| `00-arborescence-et-textes/` | `ARBORESCENCE.md` + 1 fichier de textes définitifs par page (`01-accueil.md` … `05-confidentialite.md`) | **Source de vérité du contenu et de la structure** (textes, titres, boutons, liens, ordre des sections, SEO, redirections) |
| `01-textes/` | Brouillons validés d'origine (avec notes de travail) | Contexte et justification ; en cas de doute, comparer avec `00-` |
| `02-charte/` | `charte-gr-v2.1.html` (+ capture PNG) et **`tokens-v2.1.css`** | **Source de vérité du style** (couleurs, typo, espacements, rayons, ombres, verre, boutons, logo) |
| `03-maquette/` | `accueil-v2.1-couleur.html` + captures desktop / mobile / premier écran mobile ; `extraits/` (sprite d'icônes Lucide, rendu SVG de la Box Vision) | Modèle visuel et composants de la page d'accueil, à décliner sur les autres pages |
| `04-logo/` | 7 SVG du monogramme + README d'usage | Logo |
| `05-site-actuel/` | Ancien site | **Référence uniquement** (URL, ancres, noms des champs du formulaire). Ne rien reprendre du style ni des textes. |
| `06-polices/` | Inter + Plus Jakarta Sans en WOFF2 (OFL) + `@font-face` prêt | Polices auto-hébergées |

**Priorités en cas de conflit :**
- **Contenu** : `00-arborescence-et-textes` > `01-textes` > maquette > charte. (Ex. : la maquette contient `[TÉLÉPHONE]`, `[année]`, `[À CONFIRMER]` et des liens `#` : ce sont des trous de maquette, les textes font foi.)
- **Style** : `tokens-v2.1.css` > `charte-gr-v2.1.html` > maquette.
- **Ne jamais utiliser** la charte v2 (crème / pêche), rejetée par JP : elle n'est pas dans le kit ; si tu en vois des traces, signale-les.

---

## 3. Règles d'or (non négociables)

1. **Uniquement les textes fournis.** Aucun texte, chiffre, client, témoignage, avis, logo client, statistique, prix, délai, garantie ou certification inventé. Pas de lorem ipsum.
2. **Prix** : « Box Vision à partir de 35 € TTC/mois* » et sa note « *tarif sur 48 mois, engagement minimum 3 mois. Facturation mensuelle. Achat possible. », **exactement** comme dans les textes. Aucun autre prix.
3. **Nom du produit** : toujours **« la Box Vision »** (féminin : « elle se branche », « une Box Vision neuve »). Variantes autorisées : « le boîtier », « la box ».
   **Termes interdits partout** (texte visible, `alt`, `title`, `aria-label`, commentaires HTML/CSS/JS, noms de fichiers, noms de classes, métadonnées, JSON-LD) : « Raspberry Pi », « Raspberry », « Pi » pour désigner le boîtier, « lecteur », « lecteur multimédia », « IA », « intelligence artificielle », « supervision », « monitoring », « SLA », « OTA », « Starter / Pro / Entreprise ».
4. **Aucun numéro de téléphone de GR**, nulle part, et **aucun lien `tel:`** (même pas pour IONOS : son numéro reste en texte simple dans les pages légales). Le contact se fait par e-mail `contact@grstrategie.fr` et par le formulaire (avec option de rappel).
5. **Pas de newsletter**, pas d'inscription, pas de pop-up.
6. **Aucune statistique de visite, aucun cookie de suivi, aucun bandeau cookies**, aucun pixel, aucun widget tiers (pas de Google Maps intégré, pas de reCAPTCHA, pas de chat, pas de vidéo YouTube intégrée).
7. **Zéro requête externe** au chargement : polices auto-hébergées dans `/assets/fonts/` (fichiers fournis dans `06-polices/`, **pas** de Google Fonts CDN), icônes Lucide **en SVG inline** (sprite fourni), pas de CDN JS/CSS. Seuls liens sortants autorisés : le lien « Nous trouver » vers Google Maps et le lien vers cnil.fr (simples `<a>`).
8. **Identité légale** : SIREN **843 372 087**, TVA **FR89843372087**, RCS Mulhouse, capital 1 000 €, directrice de la publication Catherine Rubiero — **uniquement** tels qu'écrits dans les mentions légales / confidentialité ; SIREN aussi dans le pied de page. Aucun autre numéro.
9. **Référence client** : seule la phrase « Déjà installé dans un hypermarché du Haut-Rhin. » est autorisée. **Ne jamais nommer l'enseigne ni montrer son logo** (ni U, ni Hyper U, ni aucune autre).
10. **Pas de création de contenus pour les écrans**, pas de maintenance sur site, pas de surveillance permanente : ne jamais le promettre (les textes le disent déjà, ne pas les « enrichir »).

---

## 4. Charte v2.1 — application stricte

### 4.1 Tokens = seule source des valeurs
- Copier `02-charte/tokens-v2.1.css` **tel quel** dans `/assets/css/tokens.css` et l'importer en premier.
- Dans `site.css`, **n'utiliser que `var(--gr-…)`**. Aucune autre valeur hexadécimale codée en dur.
- Exception : la maquette utilise quelques teintes absentes des tokens. Les ajouter **une seule fois**, en fin de `tokens.css`, dans un bloc commenté `/* Compléments maquette v2.1 */`, et rien d'autre :
  - `--gr-teal-950:#061D20;` (fond du pied de page)
  - `--gr-shape-dark:#0E4A50;` (formes arrondies pleines derrière le verre, sections sombres)
  - `--gr-ph-bg:#DFE6E6;` (emplacement photo, seulement si JP autorise les emplacements)
  - `--gr-footer-text:#9FB8B8;` (texte du pied de page, 8,3:1 sur #061D20)
  - `--gr-footer-link:#D7E6E5;` (liens du pied de page, 13,6:1)
  - `--gr-on-dark-soft:#E6F0EF;` (liste de coordonnées dans la bande finale)
  - `--gr-glass-fallback-dark:#1C3D41;` (repli du verre sombre sans `backdrop-filter`)
- Les couleurs internes du rendu SVG de la Box Vision (`03-maquette/extraits/box-vision-rendu-stylise.svg`) restent dans le SVG, ne pas les réutiliser ailleurs.

### 4.2 Palette et usage

| Rôle | Token | Valeur |
|---|---|---|
| Fond de page | `--gr-bg` | #F3F5F5 |
| Sections claires alternées | `--gr-bg-2` | #E8EDED |
| Cartes | `--gr-white` | #FFFFFF (ou verre clair 74 %) |
| Filets / bordures | `--gr-line` | #D3DCDC |
| Texte principal | `--gr-ink` | #0B2E33 |
| Texte secondaire sur clair | `--gr-muted` | #4A6164 |
| Sarcelle de marque (liens, bouton secondaire, R du logo) | `--gr-teal-700` | #0E5A61 (survol `--gr-teal-600` #13737A) |
| Sections sombres | `--gr-dark-grad` | dégradé 160° #0E3F45 → #0B2E33 (**le seul dégradé autorisé**) |
| Bande finale (CTA) | `--gr-teal-900` | #08262A |
| Pied de page | `--gr-teal-950` | #061D20 |
| Accent orange | `--gr-orange` | #FF7A1F (survol `--gr-orange-600` #F0650A) |
| Orange en texte sur clair | `--gr-orange-text` | #B4470B |
| Menthe (liseré Box Vision, icônes et focus sur sombre) | `--gr-mint` | #5CC8BE |

**Texte sur fond sombre (teintes réservées, pour passer l'AA)** :
- titres et texte : blanc #FFFFFF ; texte secondaire `--gr-muted-on-dark` #B3CACA ;
- orange en petit texte (surtitres, prix) : `--gr-orange-on-dark` **#FFA264** ;
- pôle Vision : `--gr-vision-on-dark` **#FF9D93** ; pôle Connect : `--gr-connect-on-dark` **#6CC4EC** ; pôle Ads : `--gr-ads-on-dark` #F5A623.

**Fonds autorisés, et seulement eux** : #F3F5F5, #E8EDED, cartes blanches ou verre clair, dégradé sombre #0E3F45 → #0B2E33, #08262A (bande finale), #061D20 (pied de page), verre sombre (blanc 6 %).

**⛔ Interdits** : crème, pêche, beige, rose, tout fond chaud ; tout dégradé autre que sarcelle → encre ; dégradés orange/rose ; **orange en fond** (sauf le bouton principal et les petites pastilles d'icône) ; **halos ou lueurs orange en fond** ; noir pur et rouge vif de l'ancien logo ; losanges de l'ancien site ; néons clignotants, reflets chromés.

**Orange = accent uniquement** : bouton principal, filets (trait sous les surtitres, filet sous le mot « Mulhouse » du H1), chiffres d'étapes (en contour), prix. Une seule action principale orange par écran (« Demander une démo » ou équivalent).

### 4.3 Pôles (couleurs du book 2021, adoucies)
| Pôle | Domaine | Couleur vive (filets, pastilles, icônes) | Texte sur clair | Texte sur sombre |
|---|---|---|---|---|
| Vision | Affichage dynamique, Box Vision | #E8473F | #B3261E | #FF9D93 |
| Connect | Sites web, réseaux sociaux | #38A8DC | #0F6A93 | #6CC4EC |
| Ads | Création graphique et print | #F5A623 | #8A5600 | #F5A623 |

- Couleurs vives = filet de 4 px en haut des cartes de service, pastilles d'icône (16 % d'opacité), icônes. **Jamais** pour du texte courant sur clair (prendre la variante « texte »).
- **Sous-marques « GR Vision / GR Connect / GR Ads »** : décision en attente de JP → **demande-lui** avant d'afficher ces noms ou les logos de pôle. En attendant sa réponse, n'utiliser que les couleurs de pôle comme code couleur des cartes (comme la maquette : web et réseaux sociaux en Connect, print en Ads), sans nom de sous-marque ni logo de pôle.

### 4.4 Logo
Voir `04-logo/README.md`. En résumé : `gr-monogramme.svg` sur fond clair (en-tête), `gr-monogramme-fond-fonce.svg` sur fond sombre (pied de page) ; taille mini 24 px ; zone de protection = largeur du jambage du R ; jamais recoloré, déformé, tourné, ombré, posé sur de l'orange ; pas de cercle dans l'en-tête ; logos de pôle seulement après accord de JP ; `id` de masques uniques si plusieurs SVG inline.

### 4.5 Typographie
- Titres : **Plus Jakarta Sans** — H1 et H2 en 800, H3 et nom de marque en 700, interlettrage −0,02em, interligne 1,12, `text-wrap:balance`.
- Texte : **Inter** — 400 (texte), 500/600 (boutons, libellés, intertitres), interligne 1,6.
- Échelle (tokens) : H1 `--gr-fs-display` (36 → 56 px), H2 `--gr-fs-h2` (28 → 40 px), H3 20 px, chapô 19 px, texte 17 px, petit 14 px, surtitre 13 px / 600 / capitales / interlettrage .12em / couleur `--gr-orange-text` (sur sombre `--gr-orange-on-dark`) avec un filet orange de 22 × 2 px devant.
- Pas d'italique, pas de texte justifié, lignes de 60 à 70 signes maximum. Un seul H1 par page, hiérarchie H2 > H3 sans saut.

### 4.6 Boutons et liens
- Forme pilule (`--gr-r-pill`), **hauteur 52 px** (44 px dans l'en-tête), padding 0 24px, Inter 600 16 px, icône `arrow-right` 20 px optionnelle.
- **Principal** : fond `--gr-orange`, **texte `--gr-ink`** (5,54:1) — **jamais de texte blanc sur orange** (2,6:1, refusé) ; ombre `--gr-glow-orange` ; survol `--gr-orange-600` + translateY(−1px).
- **Secondaire sur clair** : fond blanc, texte `--gr-teal-700`, bordure 1,5 px rgba(14,90,97,.35) ; survol bordure `--gr-teal-700`.
- **Secondaire sur sombre** : fond blanc 6 %, bordure blanc 35 %, texte blanc.
- **Lien flèche** : texte 600 en sarcelle (ou couleur « texte » du pôle), flèche qui glisse de 3 px au survol.
- **Focus clavier** visible partout : `--gr-focus` (double anneau #F3F5F5 + sarcelle) sur clair, `--gr-focus-dark` (encre + menthe) sur sombre. Ne jamais supprimer le focus.
- État désactivé prévu (bouton Envoyer pendant l'envoi).

### 4.7 Cartes en verre dépoli et formes
- **Verre clair** : fond `--gr-glass-bg` (blanc 74 %, 78 % sur fond `.alt`), bordure blanc 90–95 %, `backdrop-filter:var(--gr-glass-blur)` (+ `-webkit-`), rayon `--gr-r-lg` (24 px), ombre `--gr-shadow`.
- **Carte prix / info clé** : voile renforcé à 88 %.
- **Carte pleine** : blanc 100 % sur gris clair → textes longs (pages légales, formulaire, FAQ).
- **Verre sombre** : blanc 6 %, bordure blanc 14 %. Pastille claire sur sombre : blanc 92 %, texte encre.
- **Repli** sans `backdrop-filter` (`@supports not`) : blanc 92 % (clair) ou `--gr-glass-fallback-dark` (sombre).
- À éviter : verre sur verre, verre sur photo chargée, halos colorés.
- Rayons : 10 / 16 / 24 / 32 px (`--gr-r-sm` à `--gr-r-xl`) ; photos à coins arrondis 24 px ; **jamais de losange**.
- Formes décoratives des sections sombres : grands carrés arrondis (rayon 40 px) pleins `--gr-shape-dark`, légèrement tournés, en arrière-plan (comme la maquette).

### 4.8 Icônes
- **Lucide** (licence ISC), trait **1,5 px**, `stroke="currentColor"`, extrémités arrondies. Utiliser le sprite fourni `03-maquette/extraits/icones-lucide-sprite.svg` (inline dans chaque page ou fichier externe local), appel `<svg class="ic" aria-hidden="true"><use href="#i-check"/></svg>`.
- S'il faut une icône absente du sprite : la recopier depuis lucide.dev en SVG inline (même trait 1,5) — **jamais via CDN** — et le signaler.
- Icônes décoratives `aria-hidden="true"` ; pastille d'icône 42–46 px, rayon 12–14 px, fond sarcelle 10 % (sur sombre : menthe 14 %).
- L'icône `i-phone` du sprite ne doit **pas** servir à afficher un numéro de GR.

### 4.9 Photos et visuels
- **Uniquement des photos réelles** de GR et de ses installations, fournies par JP. Jamais de banque d'images présentée comme un client, jamais d'image générée par IA présentée comme réelle, jamais de logo client sans accord écrit.
- Style : lumière chaude et naturelle, écran allumé lisible, coins arrondis 24 px.
- Visuel héros : **un seul rendu de la Box Vision par page**, en héros, sur fond sombre. Provisoirement : `03-maquette/extraits/box-vision-rendu-stylise.svg` ; à remplacer par le rendu 3D / la photo que JP fournira.
- Formats : WebP (+ JPEG de repli si besoin), `width`/`height` renseignés, `loading="lazy"` sauf l'image du héros, `srcset` 1x/2x.

### 4.10 Mise en page et responsive (mobile d'abord)
- Conteneur `--gr-container` 1180 px ; marges latérales 20 px (mobile), 32 px (≥ 760 px).
- **Points de rupture de la maquette** : < 560 px ; **≥ 560 px** (cartes en 2 colonnes) ; **≥ 760 px** (marges 32 px, blocs « inclus » en 2 colonnes, panneau CTA en 2 colonnes) ; **≥ 980 px** (menu complet, héros et blocs `.split` en 2 colonnes, cartes en 3 ou 4 colonnes, sections 104 px de haut/bas au lieu de 72 px, barre collante mobile masquée).
- En-tête collant en verre clair ; barre « Demander une démo » collante en bas sur mobile (< 980 px).
- Alternance des fonds comme la maquette : sombre (héros) → clair alterné → sombre → clair → bande finale #08262A → pied de page #061D20.
- `scroll-padding-top` ≈ 84 px pour que les ancres ne passent pas sous l'en-tête. `prefers-reduced-motion` : couper les translations et le défilement doux.

---

## 5. Pages — spécification

**Tout est détaillé dans `00-arborescence-et-textes/ARBORESCENCE.md`** (sections, composants, ancres, liens, en-tête, pied de page, redirections) et dans les fichiers de textes `01-accueil.md` … `05-confidentialite.md`. Résumé :

- **Accueil** — suit **exactement** la maquette `accueil-v2.1-couleur.html` : S1 Héros (sombre) → S2 Location `#location` → S3 Box Vision `#box-vision` → S4 Pour qui `#pour-qui` → S5 Engagements (sombre) → S6 Autres services `#services` → S7 CTA final `#demo` (#08262A). Corriger les trous de maquette : liens `href="#"` → cibles des textes ; ligne `[TÉLÉPHONE]` supprimée ; pied de page avec « © 2026 » et SIREN 843 372 087 ; Google Fonts remplacé par les polices locales ; `noindex` de la maquette retiré.
- **Solutions** — mêmes composants que l'accueil : en-tête sombre compact avec carte prix → accès rapide (4 cartes) → `#signage` → `#pricing` (**offre unique**, pas de 3 colonnes Starter/Pro/Entreprise) → `#web` → `#print` → `#social` → FAQ `#faq` (`<details>`) → CTA final. **Ancres conservées** : `#signage #pricing #web #print #social`.
- **Contact** — en-tête sombre compact → coordonnées (2 cartes) → formulaire `#formulaire` dans une carte pleine. Pas de carte Google intégrée.
- **Mentions légales / Confidentialité** — en-tête clair compact, puis texte long dans une carte pleine blanche, largeur de lecture ≤ 70 signes, H2 ancrés.
- **En-tête et pied de page strictement identiques** sur les 5 pages (contenu dans `ARBORESCENCE.md` § 2). Pas d'inclusion par JS (le site actuel injecte l'en-tête en JS : à abandonner) : répéter le HTML dans chaque page.
- Le menu proposé (Accueil / Solutions / Tarifs / Contact + bouton « Demander une démo ») est une **proposition à faire valider par JP**.

---

## 6. URL, redirections, fichiers techniques

- URL publiques **sans `.html`** : `/`, `/solutions`, `/contact`, `/mentions-legales`, `/confidentialite`. Fichiers : `index.html`, `solutions.html`, `contact.html`, `mentions-legales.html`, `confidentialite.html`.
- `.htaccess` (Apache IONOS) : forcer HTTPS ; servir `/page` à partir de `page.html` ; **301** des anciennes URL (tableau complet dans `ARBORESCENCE.md` § 4 : `/index.html`, `/home.html`, `/solutions.html`, `/contact.html`, `/ml.html`, `/mentions-legales.html`, `/confidentialite.html`, `/under-construction.html`) ; **ne pas casser `/api/contact/`**. **Demander d'abord à JP le `.htaccess` actuel** et le compléter plutôt que l'écraser.
- `sitemap.xml` (5 URL) et `robots.txt` (`Disallow: /api/` + ligne `Sitemap:`).
- Favicon dérivé du monogramme (`favicon.svg`, `favicon.ico`, `apple-touch-icon.png`) — **rendu à faire valider par JP**.
- Arborescence de livraison attendue :
```
/index.html  /solutions.html  /contact.html  /mentions-legales.html  /confidentialite.html
/assets/css/tokens.css  /assets/css/site.css
/assets/js/site.js
/assets/fonts/*.woff2 (+ LICENCE-OFL-*.txt)
/assets/img/ (logos SVG, rendu Box Vision, photos WebP)
/favicon.svg  /favicon.ico  /apple-touch-icon.png
/sitemap.xml  /robots.txt  /.htaccess
/api/contact/index.php   ← modifié seulement si JP t'a fourni la version actuelle
```

---

## 7. Formulaire de contact — comportement exact

Source : `00-arborescence-et-textes/03-contact.md` (libellés, options, messages) + note développeur de `01-textes/contact-v2.md`.

**Envoi**
- `<form id="formulaire" method="post" action="/api/contact/">` vers le **script PHP existant sur IONOS** (PHP 8.4, fonctionnel). **Tu ne l'as pas** : demande à JP `api/contact/index.php` (et l'ancien `assets/js/site.js` s'il gère l'envoi en `fetch`) **avant** de le modifier. Ne jamais recréer un script d'envoi à partir de zéro sans son accord, ni passer par un service tiers.
- Envoi en `fetch` (progressive enhancement) avec repli en POST classique si JS est désactivé. Bouton « Envoyer » désactivé pendant l'envoi ; message de succès ou d'erreur dans une zone `role="status"` / `aria-live="polite"`.
- Champs envoyés : `nom`, `email`, `sujet`, `demo_format`, `message`, `delai`, `rgpd`, et **seulement si `rappel` est cochée** : `rappel`, `tel`, `creneau`.

**Case « Je préfère être rappelé(e) » (`rappel`)**
1. Par défaut décochée : `#rappel-fields` (Téléphone `tel` + Créneau `creneau`) **masqué** (`hidden`), champs **sans `required`**, **vidés**, **`disabled`** → donc **non envoyés**.
2. Cochée : panneau affiché, `tel` et `creneau` deviennent **obligatoires**, focus placé sur le champ Téléphone, `aria-expanded="true"` + `aria-controls="rappel-fields"` sur la case.
3. Décochée à nouveau : panneau masqué, `required` retiré, valeurs vidées (radios décochées), `disabled`, `aria-expanded="false"`.
4. Bouton « Effacer » (reset) : retour à l'état masqué.
5. Créneau : radios `name="creneau"`, valeurs `matin` (« Matin ») / `apres_midi` (« Après-midi »), dans un `<fieldset>` avec `<legend>`.
6. Le bouton « Demander à être rappelé » de l'en-tête de page peut cocher la case et ouvrir le panneau (optionnel).

**Validation**
- Navigateur : `required` dynamique ; e-mail valide ; **téléphone français** raisonnable, ex. `^(?:(?:\+|00)33\s?|0)[1-9](?:[\s.-]?\d{2}){4}$` (accepte `06 12 34 56 78`, `+33 6 12 34 56 78`) ; messages d'erreur reliés au champ (`aria-describedby`, `aria-invalid`). Textes des messages de validation : **à faire valider par JP** (non fournis).
- **Serveur (PHP, à étendre)** : accepter les nouveaux champs `demo_format`, `rappel`, `tel`, `creneau` ; si `rappel` est présent : exiger `tel` (format FR) et `creneau` ∈ {`matin`, `apres_midi`} ; si `rappel` est absent : **ignorer et ne pas enregistrer** `tel` / `creneau` même s'ils sont postés. Mettre à jour les nouvelles options de `sujet` et `delai` si le PHP les contrôle.
- **Anti-spam** : le formulaire actuel n'a **pas** de honeypot visible. Demander à JP si le PHP en gère un ; si on en ajoute un (champ caché `website`, `tabindex="-1"`, `autocomplete="off"`, masqué en CSS et `aria-hidden`), l'ajouter **des deux côtés** (HTML + PHP). Pas de reCAPTCHA (cookies tiers).

**Messages et RGPD**
- Succès : « Merci ! Votre demande a bien été envoyée. »
- Erreur : « Oups, une erreur est survenue. Réessayez, ou écrivez-nous à contact@grstrategie.fr. » (**uniquement l'e-mail**, aucun téléphone).
- Case RGPD obligatoire avec le texte validé + lien vers `/confidentialite`.
- Accessibilité : chaque champ a un `<label for>` visible, obligatoires signalés (texte, pas seulement couleur), cibles tactiles ≥ 44 px, ordre de tabulation logique.

---

## 8. Exigences techniques

- **HTML5 sémantique** : `header`, `nav`, `main id="contenu"`, `section` avec `aria-labelledby`, `article` pour les cartes, `footer` ; `lang="fr"` ; lien d'évitement.
- **CSS** : `tokens.css` + **un seul** `site.css` partagé, pas de style inline (sauf variables de pôle `--pc/--pt` sur les cartes, comme la maquette), pas de framework.
- **JS** : un seul `site.js` vanilla, minimal : menu mobile (`aria-expanded`, fermeture à Échap et au clic sur un lien) + formulaire. Le site doit rester lisible et utilisable sans JS.
- **Accessibilité WCAG 2.1 AA** : contrastes ≥ 4,5:1 (texte) et ≥ 3:1 (gros texte, icônes, bordures de champs) — les paires de la charte sont déjà calculées, ne pas en créer de nouvelles sans calcul ; navigation clavier complète ; focus visible ; `alt` pertinents (textes alternatifs à faire valider par JP) ; `prefers-reduced-motion`.
- **SEO** : `title` et `meta description` **exactement** ceux des textes (≤ 60 / ≤ 155 caractères, déjà vérifiés) ; `link rel="canonical"` (URL sans .html) ; Open Graph (`og:title`, `og:description`, `og:url`, `og:type`, `og:locale=fr_FR`, `og:image` **à demander à JP**) ; `twitter:card` ; JSON-LD `LocalBusiness` avec **uniquement** nom, adresse, e-mail, URL, horaires lun–ven 9h–18h (**pas de téléphone**, pas de note/avis) ; `FAQPage` optionnel sur /solutions ; `sitemap.xml` ; `robots.txt` ; `theme-color` = #0B2E33.
- **Performance** : images WebP dimensionnées, `loading="lazy"` + `decoding="async"` hors héros, polices préchargées (latin uniquement), `font-display:swap`, aucun script bloquant, pas de dépendance externe.
- Encodage UTF-8, typographie française (espace insécable avant `: ; ? !` et dans « 35 € », guillemets « »).
- **Aucun** lorem ipsum, aucun `[À CONFIRMER]`, `[année]`, `[TÉLÉPHONE]` dans les fichiers livrés.

---

## 9. Méthode de travail

1. **Étape 0** — inventaire des fichiers reçus / manquants + questions à JP (§ 0, § 11, § 12). Attendre ses réponses.
2. **Étape 1** — socle : `tokens.css`, `site.css` (composants), `site.js`, polices, en-tête et pied de page. Les montrer avec la **page d'accueil complète**.
3. **Étape 2** — **validation de l'accueil par JP** (desktop 1280 px et mobile 375 px). Ne pas commencer les autres pages avant son « OK ».
4. **Étape 3** — Solutions, puis Contact (avec le formulaire et, si JP a fourni le script, le PHP modifié), puis Mentions légales et Confidentialité. Montrer chaque page.
5. **Étape 4** — `.htaccess`, `sitemap.xml`, `robots.txt`, favicon.
6. **Étape 5** — livraison : **arborescence complète des fichiers** + **rapport d'auto-contrôle** (§ 10) + liste de ce qui reste à fournir ou à valider. Des fichiers complets à chaque fois (pas d'extraits « … le reste est inchangé »).

Chaque fois que tu montres une page, indique en une liste courte : ce qui vient des textes, ce qui vient de la maquette, ce que tu as dû décider (à valider), ce qui manque.

---

## 10. Auto-contrôle final (à exécuter et à rapporter, résultat par résultat)

Recherches dans **tous** les fichiers livrés (HTML, CSS, JS, PHP, XML, txt, noms de fichiers) — résultat attendu : **0** :
```
grep -rniE "raspberry|lecteur|\bpi\b|intelligence artificielle|\bIA\b|supervision|monitoring|\bSLA\b|\bOTA\b|starter|lorem" .
grep -rn "tel:" .
grep -rnE "\[TÉLÉPHONE\]|\[année\]|À CONFIRMER|TEXTE MANQUANT|903 123|903123" .
grep -rniE "#FFF7EF|#FFE3CF" --include=*.css --include=*.html .   (hors SVG du logo sur fond foncé)
grep -rnE "https?://" --include=*.html --include=*.css --include=*.js .   (seuls Google Maps « Nous trouver », cnil.fr, grstrategie.fr canonical/og attendus)
grep -rniE "fonts.googleapis|fonts.gstatic|cdn\.|unpkg|jsdelivr|googletagmanager|analytics|gtag|facebook|hotjar" .
grep -rnE "#[0-9A-Fa-f]{3,6}\b" assets/css/site.css   (0 : tout passe par var(--gr-…))
```
Vérifications :
- [ ] Le prix apparaît uniquement sous la forme « 35 € TTC/mois » avec la note 48 mois / 3 mois / mensuelle / achat possible.
- [ ] « la Box Vision » au féminin partout.
- [ ] Aucun téléphone de GR, aucun `tel:` ; téléphone IONOS en texte simple dans les pages légales.
- [ ] SIREN 843 372 087 et TVA FR89843372087 corrects ; « © 2026 ».
- [ ] Ancres `/solutions#signage #pricing #web #print #social` présentes et fonctionnelles.
- [ ] Tous les liens internes pointent vers les 5 URL sans `.html` ; aucun lien vers `/under-construction.html`.
- [ ] Formulaire : rappel décoché → `tel`/`creneau` ni visibles, ni requis, ni envoyés (vérifier le contenu du POST) ; coché → requis + focus ; reset OK ; message d'erreur sans téléphone.
- [ ] Aucune requête réseau externe au chargement (onglet Réseau du navigateur).
- [ ] Contrastes AA vérifiés sur chaque combinaison texte/fond utilisée ; jamais de texte blanc sur orange.
- [ ] Rendu vérifié à **375 px, 768 px et 1280 px** (pas de défilement horizontal, menu mobile OK, barre collante OK).
- [ ] Navigation complète au clavier, focus visible sur fond clair et sombre.
- [ ] Un seul H1 par page ; titles ≤ 60 et descriptions ≤ 155 caractères, identiques aux textes.
- [ ] Aucun fond crème/pêche/rose, aucun dégradé autre que sarcelle → encre, aucun fond orange hors boutons.
- [ ] HTML valide (validator.w3.org) ; Lighthouse ≥ 90 en accessibilité, SEO et bonnes pratiques.

---

## 11. Fichiers attendus dans le kit (à cocher à l'étape 0)

```
README.md
BRIEF-CLAUDE.md
00-arborescence-et-textes/ ARBORESCENCE.md, 01-accueil.md, 02-solutions.md, 03-contact.md, 04-mentions-legales.md, 05-confidentialite.md
01-textes/ accueil-v2.md, solutions-v1.md, contact-v2.md, mentions-legales-v1.md, confidentialite-v2.md
02-charte/ charte-gr-v2.1.html, charte-gr-v2.1-desktop.png, tokens-v2.1.css
03-maquette/ accueil-v2.1-couleur.html, accueil-v2.1-couleur-desktop.png, accueil-v2.1-couleur-mobile.png, accueil-v2.1-couleur-mobile-ecran1.png
03-maquette/extraits/ icones-lucide-sprite.svg, box-vision-rendu-stylise.svg, LICENCE-ISC-Lucide.txt
04-logo/ README.md + gr-monogramme.svg, gr-monogramme-fond-fonce.svg, gr-monogramme-cercle.svg, gr-monogramme-mono-sarcelle.svg, gr-monogramme-vision.svg, gr-monogramme-connect.svg, gr-monogramme-ads.svg
05-site-actuel/ README.md + index.html, solutions.html, contact.html, ml.html, header.html, footer.html
06-polices/ README.md + inter-latin-wght-normal.woff2, inter-latin-ext-wght-normal.woff2, plus-jakarta-sans-latin-wght-normal.woff2, plus-jakarta-sans-latin-ext-wght-normal.woff2, LICENCE-OFL-Inter.txt, LICENCE-OFL-PlusJakartaSans.txt
```
Si un de ces fichiers manque ou est illisible : le dire à JP avant de commencer.

---

## 12. Éléments connus comme MANQUANTS — à demander à JP

**Visuels**
1. **Photos réelles** (WebP ou JPEG haute définition, droits OK) : la Box Vision installée / branchée derrière un écran ; un écran en vitrine (Commerces) ; un écran dans un hall d'accueil (PME) ; un écran d'information au public (Collectivités) ; un écran sur un stand (Événements) ; l'équipe ou les locaux rue Victor Schoelcher. → Sans photo : **demander** si JP veut des emplacements neutres étiquetés (style `.ph` de la maquette), une version sans photo, ou attendre.
2. **Rendu 3D / photo de la Box Vision** (JP en possède un) pour le héros — en attendant, le SVG stylisé fourni, seulement si JP l'accepte.
3. **Image de partage Open Graph** (1200 × 630) : à fournir ou à valider (proposition : monogramme sur fond sombre).
4. **Textes alternatifs** des photos réelles (non fournis).

**Technique**
5. **`api/contact/index.php`** actuel (avant toute modification) et, s'il existe, l'ancien `assets/js/site.js` qui gère l'envoi + savoir si un honeypot existe côté PHP.
6. **`.htaccess`** actuel du serveur IONOS.
7. **Validation du favicon** généré depuis le monogramme.
8. **Polices** : fournies dans `06-polices/` (OFL) — confirmer avec JP que c'est OK (sinon il les télécharge lui-même).

**Décisions**
9. **Sous-marques Vision / Connect / Ads** : sont-elles conservées sur le site (noms + logos de pôle) ou seulement comme code couleur ? Décision en attente.
10. **Menu principal** proposé (Accueil / Solutions / Tarifs / Contact + « Demander une démo ») : à valider.
11. **Textes manquants** marqués [TEXTE MANQUANT – demander à JP] dans `00-arborescence-et-textes/` (titre du bloc d'accès rapide sur /solutions, messages de validation du formulaire, phrase du lien vers la politique de confidentialité sous la case RGPD, alt des photos, image OG).
12. **Logo sur fond foncé** : R crème (#FFF7EF, version fournie) ou R blanc ? Utiliser la version fournie sauf avis contraire de JP.
13. `noindex` sur les pages légales : oui ou non ?

Pose ces questions **regroupées et numérotées**, en indiquant pour chacune ce qui est bloquant pour la page d'accueil et ce qui peut attendre.
