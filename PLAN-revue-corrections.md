# Plan — Application de la revue de correction (REVUE-CORRECTIONS.md)

Source : `REVUE-CORRECTIONS.md` (15 points, 10/11/2026). Livraison dans `site/`.

## 1. Résumé des demandes

| Pt | Demande |
|---|---|
| 1 | Accueil réécrit, positionnement SEO « agence de communication spécialisée dans les nouvelles technologies à Mulhouse », présente GR Vision (principal), GR Connect web, GR Connect réseaux sociaux, GR Ads. Title, meta, H1, JSON-LD alignés. |
| 2 | Une page par service (600 à 1 000 mots utiles chacune) : GR Vision, création de sites web, community management, GR Ads. solutions.html disparaît, 301 vers GR Vision. Menu, pied de page, sitemap, maillage mis à jour. |
| 3 | H2 de la section Location : « Comment fonctionne la location avec GR Stratégie ? ». Le player loué reste mis en avant. |
| 4 | Prix : « (le tarif varie selon la durée d'engagement et le modèle de player) » partout où « 48 mois » apparaît. « À partir de 35 € TTC/mois » inchangé. |
| 5 | « BoxVision » en un mot, toujours avec article (« la BoxVision », « une BoxVision » si le sens l'impose), partout y compris alt, meta, JSON-LD. Les « la box » isolés deviennent « la BoxVision ». |
| 6 | Faible consommation : « une dizaine d'euros d'électricité par an ». Jamais « Raspberry Pi ». |
| 7 | Plus aucune fonction ouverte sur internet : retirer mises à jour à distance, météo, actualités, horaires automatiques. Carte sécurité : « accessible uniquement depuis votre réseau local, jamais exposée sur internet ». |
| 8 | Encart : le commerçant décide seul de sa diffusion, aucune publicité tierce, jamais. Sans viser de concurrent. |
| 9 | Retirer « Déjà installé dans un hypermarché du Haut-Rhin. » (accueil et solutions). |
| 11 | Démo de 30 minutes partout (9 occurrences), tournure « pour découvrir le logiciel et un modèle de contenu ». |
| 12 | Hiérarchie : GR Stratégie > GR Vision (BoxVision, pose, logiciel) / GR Connect / GR Ads. GR Vision présentée avant la BoxVision. |
| 13 | Écrans : « Au choix dans notre catalogue, prix sur demande. Ou vous gardez les vôtres : notre solution s'y adapte. » Conditions techniques retirées, FAQ douce. |
| 14 | Panne : « Remplacement sans souci », BoxVision neuve déjà configurée, « Vous la branchez, c'est reparti. » |
| 15 | Plus de rubrique « Tarifs » : prix dans chaque page de service, bouton « Demander un devis » vers Contact. |
| 10 | En dernier : relecture complète, zéro tiret cadratin, zéro point-virgule, zéro demi-cadratin (« Du lundi au vendredi, de 9 h à 18 h »), dans textes, title, meta, alt, JSON-LD, messages du formulaire et de l'API. |

## 2. Évaluation

- Nature : contenu et SEO (1, 3 à 14), structure (2, 15), relecture (10).
- Ampleur : 5 pages existantes réécrites ou retouchées, 4 pages créées, 1 supprimée, `.htaccess`, `sitemap.xml`, `tests/router.php`, `tests/verifier_site.py`, peut-être `site.js` et `api/contact/index.php` (messages, liste des sujets).
- Risques : liens cassés vers `/solutions#…` (accueil, contact, pages légales, JS, PHP), test « aucun autre prix que 35 € » qui bloquera le 240 €, perte de contenu de solutions.html si mal réparti, en-tête trop chargé avec 4 services.

## 3. Hors périmètre

- Photos réelles et captures des réalisations (emplacements prévus, fichiers à fournir par JP).
- Mise en ligne sur IONOS (skill mise-en-ligne-ionos, plus tard, sur demande).
- Modification des textes légaux au-delà de la ponctuation (point 10) et de la mention BoxVision.
- Mise à jour de `kit-claude/` (sources de JP, non modifiées).

## 4. Décisions et arbitrages

Tranchés par JP (10/11/2026, cadrage) :
- Titre point 3 : « Comment fonctionne la location avec GR Stratégie ? ».
- GR Connect : **deux pages** (sites web, réseaux sociaux).
- Prix : « modèle de player ».
- Réalisations web : accord obtenu, on cite Alventus, Pauline Kupper photographie, Se Déployer Coaching avec lien vers leur site (captures à fournir).

Décisions prises par Claude (modifiables à la validation de ce plan) :
- **URL** : `/affichage-dynamique` (GR Vision), `/creation-site-web`, `/community-management`, `/print-affichage-publicitaire` (GR Ads). `solutions.html` supprimée, `/solutions` et `/solutions.html` en 301 vers `/affichage-dynamique`.
- **Menu** : Accueil, Affichage dynamique, Sites web, Réseaux sociaux, Print et pub, Contact, bouton « Demander une démo » conservé (décision 4 du cadrage). Si l'en-tête déborde entre 1024 et 1280 px, le point de rupture du menu mobile est relevé.
- **Pied de page** : ajout des 4 pages de service.
- Point 5, décalage « GR Vision » / surtitre : corrigé (alignement sur la même ligne de base).
- Point 6 : une phrase dans l'introduction de la BoxVision (accueil) et une carte d'avantage sur la page GR Vision.
- Point 8 : encart après la section Location (accueil), section dédiée sur la page GR Vision, question dans la FAQ GR Vision.
- GR Ads : texte qui distingue clairement « réserver des espaces publicitaires pour votre campagne » et « aucune publicité tierce sur vos écrans GR Vision ».
- Les textes nouveaux sont rédigés par Claude **à partir des seuls faits fournis par JP** dans la revue (aucun chiffre, client, délai ou garantie inventé), à relire par JP.
- Les règles du brief § 3 contredites par JP (nom « Box Vision », prix unique, référence hypermarché) sont remplacées par ses décisions du 10/11/2026. Test « prix » adapté : 35 € et 240 € autorisés.
- Bloc démo commun en bas de chaque page de service (« On vous montre ? » pour GR Vision, « Parlons de votre projet » pour les autres).

## 5. Points de risque

- Liens `/solutions#…` restants : contrôle grep + test des liens internes (PAGES_PREVUES mis à jour).
- Contenu de solutions.html : tableau de correspondance section par section (cf. § 6), vérifié avant suppression.
- Ponctuation : contrôle automatique ajouté au test (« — », « – », « ; » dans le texte visible et le JSON-LD des pages, hors CSS/JS de code).
- Termes interdits (`raspberry`, `lecteur`, `pi`…) : test existant conservé.
- En-tête : vérifié à 375, 768, 1024 et 1280 px.

## 6. Approche technique

Répartition de solutions.html :
- #signage, #pricing, FAQ BoxVision, #demo → `affichage-dynamique.html`
- #web → `creation-site-web.html` · #social → `community-management.html` · #print → `print-affichage-publicitaire.html`
- FAQ générale répartie, bloc démo commun.

Tranches (une page à la fois, tests au vert avant la suivante) :
0. Tests : `verifier_site.py` (nouvelles pages, prix 35/240, « Box Vision » interdit, ponctuation), `router.php` (301 /solutions).
1. Page GR Vision (gabarit des pages de service, nouvel en-tête et pied de page).
2. Page Création de sites web.
3. Page Community management.
4. Page GR Ads.
5. Accueil réécrit.
6. Pages existantes : contact (démo 30 min, horaires, en-tête), mentions légales, confidentialité (en-tête, pied, ponctuation), `site.js` et `api/contact/index.php` (messages, sujets), suppression de solutions.html, `.htaccess`, `sitemap.xml`.
7. Relecture finale point 10 + revues design et fullstack.

## 7. Plan de délégation

| # | Tâche | Fichiers | Modèle | Raison | Dépend de |
|---|---|---|---|---|---|
| T0 | Adapter les tests et le routeur | `tests/verifier_site.py`, `tests/router.php` | Claude (moi) | quelques lignes | — |
| T1 | Page GR Vision | `site/affichage-dynamique.html` (+ `site.css` si besoin) | opus | gabarit de référence, beaucoup de règles métier | T0 |
| T2 | Page Création de sites web | `site/creation-site-web.html` | sonnet | suit le gabarit T1 | T1 |
| T3 | Page Community management | `site/community-management.html` | sonnet | suit le gabarit T1 | T2 (CSS partagé) |
| T4 | Page GR Ads | `site/print-affichage-publicitaire.html` | sonnet | suit le gabarit T1, vigilance pub tierce | T3 |
| T5 | Accueil réécrit | `site/index.html` | opus | positionnement SEO, page principale | T4 |
| T6 | Pages existantes, suppression solutions, .htaccess, sitemap, JS, PHP | `contact.html`, `mentions-legales.html`, `confidentialite.html`, `site.js`, `api/contact/index.php`, `.htaccess`, `sitemap.xml` | sonnet | modifications ciblées, plus de 3 fichiers | T5 |
| R1 | Revue design (charte, 375/768/1024/1280) | toutes les pages | opus | goût et charte | T6 |
| R2 | Relecture point 10 + revue fullstack | toutes les pages | opus | relecture fine du français et des règles | R1 |

Les tâches s'enchaînent dans l'ordre (en-tête et CSS partagés, une page à la fois). Recette finale par Claude.

## 8. Checklist

- [x] Pt 1 : title, meta, H1, JSON-LD de l'accueil portent « agence de communication… nouvelles technologies… Mulhouse » et présentent les 4 services avec un lien vers chaque page
- [x] Pt 2 : 4 pages de service existent, chacune 600 à 1 000 mots utiles (compte mesuré), avec démarche, inclus, tarif ou devis, FAQ
- [x] Pt 2 : `/solutions` et `/solutions.html` renvoient 301 vers `/affichage-dynamique` (routeur local et .htaccess)
- [x] Pt 2 : `grep -r "/solutions" site/` ne renvoie que la règle de redirection
- [x] Pt 2 : sitemap.xml liste les 8 pages
- [x] Pt 2 : réalisations web citées avec lien (3 sites)
- [x] Pt 2 : community management à partir de 240 € TTC/mois, ni Terranimo ni Sierentz
- [x] Pt 3 : H2 « Comment fonctionne la location avec GR Stratégie ? »
- [x] Pt 4 : `grep "48 mois"` = 0, formule « modèle de player » présente partout où il y a un prix BoxVision
- [x] Pt 5 : `grep -i "box vision"` = 0, chaque « BoxVision » précédée d'un article
- [x] Pt 6 : « une dizaine d'euros d'électricité par an » sur l'accueil et la page GR Vision
- [x] Pt 7 : `grep -iE "météo|actualit|à distance|mises? à jour"` sans promesse de fonction ouverte, carte sécurité présente
- [x] Pt 8 : encart « aucune publicité tierce » sur l'accueil, la page GR Vision et sa FAQ
- [x] Pt 9 : `grep "hypermarché"` = 0
- [x] Pt 10 : aucun « — », « – », « ; » dans les textes des pages et le JSON-LD, ni dans les messages de `site.js` et du PHP
- [x] Pt 11 : `grep "15 min"` = 0, « 30 minutes » dans les 9 emplacements
- [x] Pt 12 : GR Vision présentée avant la BoxVision sur l'accueil et la page GR Vision
- [x] Pt 13 : HDMI, luminosité, « après vérification » absents des cartes, FAQ douce présente
- [x] Pt 14 : « déjà configurée » et « c'est reparti » présents, « Pas de maintenance sur site » reformulé
- [x] Pt 15 : plus de « Tarifs » dans le menu, « Demander un devis » sur chaque page de service
- [x] `python3 -I tests/verifier_site.py` au vert
- [x] Contrôles navigateur 375/768/1024/1280 sur les 8 pages : aucun débordement, aucune requête externe, console vide, cibles ≥ 44 px
- [x] Navigation clavier et focus visibles sur le nouvel en-tête
- [x] Formulaire de contact toujours fonctionnel (envoi en mode test)
- [x] Captures d'écran mises à jour dans `captures/`

## 9. Bilan (10/11/2026)

- Tests statiques : 153/153. Contrôles navigateur (débordement, requêtes externes, images, cibles ≥ 44 px) au vert sur les 8 pages à 375 px, et en-tête vérifié à 768, 1199 et 1280 px.
- Recette complémentaire (10/11/2026) : clavier 263/263 éléments focusables avec focus visible sur les 8 pages. Envoi du formulaire de bout en bout en mode test (serveur `site-php-test`, port 8767) : réponse 200, message de confirmation, mail composé correct. Libellé du sujet « Print » aligné en « Print et affichage publicitaire » (HTML et PHP). 16 captures refaites dans `captures/`, anciennes captures Solutions supprimées.
- Écart au plan : point de rupture du menu complet passé de 980 à 1200 px (6 entrées). Pages de service et accueil écrits en parallèle (fichiers distincts), puis relecture opus.
- Répartition réelle : tests, routeur, CSS des pôles sur fond sombre et suppression de solutions.html par Claude. GR Vision et accueil par opus. Sites web, réseaux sociaux, GR Ads, contact et pages légales par sonnet. Relecture finale par opus.
- À valider par JP : voir la liste « Points à faire valider » du rendu final.
