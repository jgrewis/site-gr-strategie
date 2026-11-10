# Cadrage — site grstrategie.fr 2027 (charte v2.1)

Sources de vérité : `kit-claude/` (`BRIEF-CLAUDE.md` fait foi). Ce document consigne les décisions de JP prises au cadrage et le plan de travail.

## 1. Décisions de JP (09/11/2026)

| # | Sujet | Décision |
|---|---|---|
| 1 | Dossier de livraison | `site/` à la racine du projet, séparé du kit |
| 2 | Photos réelles | Emplacements neutres étiquetés (style `.ph` de la maquette), photos livrées plus tard |
| 3 | Visuel héros | SVG stylisé du kit accepté en attendant le rendu 3D |
| 4 | Menu | Accueil / Solutions / Tarifs (`/solutions#pricing`) / Contact + « Demander une démo » |
| 5 | Sous-marques | **Conservées** : noms GR Vision / GR Connect / GR Ads + logos de pôle |
| 6 | Logo sur fond foncé | **R blanc** (#FFFFFF) au lieu du R crème |
| 7 | Polices | Inter + Plus Jakarta Sans auto-hébergées (fichiers du kit) |
| 8 | Textes alternatifs | Claude propose, JP valide (voir § 4) |
| 9 | Ancre S5 | `#engagements` validée |
| 10 | Image Open Graph | Logo d'origine (cercle, fond blanc) sur fond sombre — **validée** le 09/11/2026 |
| 11 | Formulaire | **Script PHP refait à neuf** (`/api/contact/index.php`, PHP 8.4), avec champ anti-spam caché |
| 12 | Messages de validation + phrase RGPD | Claude les rédige, JP valide |
| 13 | Accès rapide /solutions | Pas de titre visible, `aria-label` seulement |
| 14 | Pages légales | Pas de `noindex` : indexées et présentes dans le sitemap (meilleur choix SEO, pages de confiance) |
| 15 | `.htaccess` | Écrit à neuf (HTTPS, URL sans .html, 301 des anciennes URL) ; suppression de `home.html` et `under-construction.html` sur le serveur faite par JP |
| 16 | Favicon | Généré depuis le monogramme, montré avec la page d'accueil |
| 17 | Logo (09/11/2026, remplace la 6 et l'interdit « noir et rouge » du brief § 4) | **Logo d'origine partout** : R et cercle noirs #000000, G rouge #FF0000, disque blanc #FFFFFF (base `gr-monogramme-cercle.svg`). L'orange du logo v2.1 était une erreur d'inattention à la validation de la charte. En-tête 40 × 40 px, pied de page 32 × 32 px, favicon, image Open Graph. **Boutons et accents du site : restent orange.** |

## 2. Arborescence de livraison

```
site/
├── index.html                 Accueil            (étape 1)
├── solutions.html             Solutions          (étape 3)
├── contact.html               Contact            (étape 4)
├── mentions-legales.html      Mentions légales   (étape 5)
├── confidentialite.html       Confidentialité    (étape 6)
├── api/contact/index.php      Envoi du formulaire (étape 4)
├── assets/
│   ├── css/tokens.css         = tokens-v2.1.css + bloc « Compléments maquette v2.1 »
│   ├── css/site.css           Composants partagés (var(--gr-…) uniquement)
│   ├── js/site.js             Menu mobile (+ formulaire à l'étape 4)
│   ├── fonts/                 4 woff2 + 2 licences OFL
│   ├── icons/sprite.svg       Sprite Lucide (copié aussi inline dans chaque page)
│   └── img/                   Logos SVG (dont fond foncé R blanc), box-vision.svg, photos plus tard
├── favicon.svg  favicon.ico  apple-touch-icon.png
├── og-image.png               (étape 7)
├── sitemap.xml  robots.txt  .htaccess   (étape 7)
```

## 3. Plan de délégation — étape 1 : socle + page d'accueil

| # | Tâche | Fichiers | Modèle | Raison | Dépend de |
|---|---|---|---|---|---|
| T1 | Préparer les assets : copie des polices, tokens + compléments, logos (variante R blanc), sprite, SVG Box Vision | `assets/fonts`, `assets/css/tokens.css`, `assets/img`, `assets/icons` | haiku | copie mécanique bornée | — |
| T2 | Système de composants : `site.css` fidèle à la maquette, mobile d'abord, 4 points de rupture | `assets/css/site.css` | opus | fonde l'identité de tout le site | T1 |
| T3 | Page d'accueil S1 → S7, en-tête et pied de page, SEO, JSON-LD | `index.html` | sonnet | page au périmètre clair | T2 |
| T4 | Menu mobile (Échap, clic lien, `aria-expanded`) | `assets/js/site.js` | sonnet | interaction courte | T3 |
| T5 | Favicon (svg, ico 32, png 180) | racine `site/` | haiku | génération mécanique | T1 |
| R1 | Revue sécurité (en-têtes, liens externes, zéro requête externe) | — | opus | défaut du référentiel | T3–T5 |
| R2 | Revue design (charte, contrastes, 375 / 768 / 1280 px) | — | opus | goût et fidélité charte | R1 |
| R3 | Revue fullstack + auto-contrôle § 10 du brief | — | sonnet | site statique à ce stade | R2 |

Vérification finale par Claude : serveur local, aucun 404, aucune requête externe, captures desktop et mobile envoyées à JP. **Les autres pages ne commencent qu'après le « OK » de JP sur l'accueil.** La revue sécurité est refaite en opus sur le PHP à l'étape Contact.

## 4. Textes alternatifs proposés (à valider)

| Emplacement | alt proposé |
|---|---|
| Héros — rendu Box Vision (provisoire) | « La Box Vision, boîtier d'affichage dynamique de GR Stratégie » |
| S3 — Box Vision branchée | « La Box Vision branchée à l'arrière d'un écran » |
| S4 — Commerces | « Écran d'affichage dynamique en vitrine d'un commerce » |
| S4 — PME | « Écran d'accueil dans le hall d'une entreprise » |
| S4 — Collectivités | « Écran d'information au public dans un bâtiment municipal » |
| S4 — Événements | « Écran d'affichage dynamique sur un stand de salon » |
| S5 — Équipe / locaux | « L'équipe de GR Stratégie dans ses locaux rue Victor Schoelcher à Mulhouse » |

Les emplacements photo provisoires n'ont pas de `alt` (pas encore d'image). Ces textes s'appliqueront quand les photos seront livrées : à ajuster selon ce qu'elles montrent réellement.

## 5. Sous-marques — placement proposé (à valider sur l'accueil)

- S6 Autres services : petit logo de pôle (24 px) + nom « GR Connect » / « GR Ads » au-dessus du titre de chaque carte.
- S3 Box Vision : mention « GR Vision » avec son logo à côté du surtitre.
- Le logo principal reste seul dans l'en-tête et le pied de page.

## 6. Notes techniques pour les étapes suivantes (revue sécurité de l'accueil)

- `.htaccess` : reprendre la CSP de la meta + `frame-ancestors 'none'` + `upgrade-insecure-requests`, puis retirer la meta CSP des pages. En-têtes : `X-Content-Type-Options: nosniff`, `X-Frame-Options: DENY`, `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy: camera=(), microphone=(), geolocation=()`, `Strict-Transport-Security: max-age=31536000`, `Cross-Origin-Opener-Policy: same-origin`, `Options -Indexes`, blocage de `.env`, `.git`, `.DS_Store`.
- Formulaire / PHP : jeton CSRF en session, honeypot + délai minimal, validation client et serveur, échappement des sorties, protection contre l'injection d'en-têtes mail (CR/LF), limitation par IP, secrets SMTP dans un `.env` hors racine web.
- Page Confidentialité (à faire) : signaler à JP que le formulaire garde une empreinte hachée de l'IP 10 minutes (anti-abus) et préciser la durée de conservation des mails reçus — le texte validé ne le dit pas, ne rien ajouter sans son accord.
- `.htaccess` racine (à faire) : réécriture des URL sans .html (le routeur local `tests/router.php` imite ce comportement), 301 des anciennes URL, en-têtes ci-dessus.

## 7. État d'avancement (arrêt du 09/11/2026 à la demande de JP)

- ✅ Accueil : développé, revues sécurité / design / fullstack, tests au vert.
- ✅ Solutions : développée, revues, tests au vert.
- ✅ Contact (reprise du 09/11/2026 au soir) : revue design (correctif : cartes Coordonnées sur une colonne entre 560 et 760 px, classe `c2-late`), revue fullstack (sans JS, 422, origine étrangère, en-têtes, honeypot, téléphone ignoré sans rappel), tests navigateur 375/768/1280 au vert, clavier 29/29 focus visibles, envoi de bout en bout en mode test, captures `captures/contact-*.png`. Le test « cibles < 44 px » tient désormais compte du libellé associé aux cases et radios.
- ✅ Validé par JP (09/11/2026) : messages de validation du formulaire (`site.js`, objet `MSG`) et la phrase « Voir notre politique de confidentialité. » sous la case RGPD.
- ✅ Mentions légales : page faite (en-tête clair compact, sommaire d'ancres sans titre visible, carte pleine, H2 ancrés `#editeur` … `#contact-ml`, pas de `noindex`), texte comparé mot à mot à la source, largeur de lecture mesurée ≤ 70 signes (`.prose` à 58ch, 68 signes max à 1280 px), tests 69/69, contrôles navigateur 375/768/1280 au vert, clavier 22/22, captures `captures/mentions-legales-*.png`. Styles `.legal-*`, `.toc`, `.prose` réutilisables pour Confidentialité.
- ✅ Confidentialité : page faite (même gabarit que les mentions légales, 13 H2 ancrés `#responsable` … `#modification`, lien CNIL externe en nouvel onglet), texte identique à la source mot à mot, tests 84/84, contrôles navigateur 375/768/1280 au vert (69 signes max par ligne), clavier 34/34, captures `captures/confidentialite-*.png`.
- ✅ Décision de JP (09/11/2026) : l'empreinte hachée de l'IP gardée 10 min par le script anti-abus **n'est pas mentionnée** dans Confidentialité ; le texte validé reste tel quel.
- ✅ `sitemap.xml` (5 URL absolues, lastmod 2026-11-09) et `robots.txt` (`Disallow: /api/` + `Sitemap:`), conformes à ARBORESCENCE.md § 5.
- ✅ Logo d'origine appliqué (décision 17) : en-tête et pied de page des 5 pages, `assets/img/gr-monogramme.svg` (JSON-LD), `favicon.svg/.ico`, `apple-touch-icon.png`, `og-image.png` ; captures refaites. Tests 84/84.
- ✅ Image Open Graph avec le logo d'origine : validée par JP (09/11/2026).
- ✅ Logos de pôle alignés (09/11/2026, accord de JP) : R et cercle noirs, disque blanc, G à la couleur du pôle (Vision #E8473F, Connect #38A8DC, Ads #F5A623) ; affichés en 24 × 24 px (taille minimale de la charte).
- ℹ️ Non modifiés : `kit-claude/04-logo/README.md` et le brief § 4 disent encore « pas de noir et rouge » (sources de JP, à mettre à jour par lui).
- ✅ `.htaccess` racine (`site/.htaccess`) : l'ancien fichier racine fourni par JP ne contenait que la redirection `/index.html` → `/`, reprise. Testé sur un Apache 2.4 local : HTTPS, URL propres, 301 des anciennes URL (cible https explicite, chaîne de requête conservée), en-têtes de sécurité, cache, compression, fichiers cachés et de travail bloqués. `/api/contact/` : version stricte (seul index.php) à la place de l'ancienne réécriture générale ; l'ancienne cible `/api/contact` sans barre finale n'est pas reprise (elle renvoyait déjà 404 sur le site actuel).
- ✅ Rapport final : `RAPPORT-LIVRAISON.md` (auto-contrôle § 10, arborescence, reste à fournir, étapes de mise en ligne).
- Tests : `python3 -I tests/verifier_site.py` (54/54 à l'arrêt) + `tests/controles-navigateur.js`. Prévisualisation avec URL propres : `php -S 127.0.0.1:8766 -t site tests/router.php`.

## 8. Revue de correction du 10/11/2026

- Toutes les demandes de `REVUE-CORRECTIONS.md` appliquées, suivi et bilan dans `PLAN-revue-corrections.md`.
- Arborescence : accueil (agence de communication spécialisée dans les nouvelles technologies), `/affichage-dynamique` (GR Vision), `/creation-site-web`, `/community-management`, `/print-affichage-publicitaire` (GR Ads), contact, pages légales. `solutions.html` supprimée, 301 vers `/affichage-dynamique` (`.htaccess` et `tests/router.php`).
- Menu à 6 entrées, plus de « Tarifs ». Menu complet à partir de 1200 px (bouton Menu en dessous).
- Tests : `python3 -I tests/verifier_site.py` 153/153 (nouvelles règles : BoxVision en un mot avec article, ni cadratin ni point-virgule, prix 35 et 240 € autorisés). Serveur de test du formulaire : configuration `site-php-test` (port 8767).
