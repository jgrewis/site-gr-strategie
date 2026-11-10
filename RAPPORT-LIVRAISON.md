# Rapport de livraison — site grstrategie.fr 2027 (charte v2.1)

Date : 9 novembre 2026. Dossier livré : `site/` (596 Ko). Rien n'a été mis en ligne : la publication reste à faire par JP.

## 1. État des pages

| Page | URL | État | Captures |
|---|---|---|---|
| Accueil | `/` | ✅ faite, revues et tests au vert | `captures/accueil-*.png` |
| Solutions | `/solutions` | ✅ faite, revues et tests au vert | `captures/solutions-*.png` |
| Contact | `/contact` | ✅ faite ; messages de validation et phrase RGPD validés par JP | `captures/contact-*.png` |
| Mentions légales | `/mentions-legales` | ✅ faite, textes identiques à la source | `captures/mentions-legales-*.png` |
| Confidentialité | `/confidentialite` | ✅ faite, textes identiques à la source (IP hachée non mentionnée, décision de JP) | `captures/confidentialite-*.png` |

## 2. Arborescence livrée

```
site/
├── .htaccess                         3,2 Ko   HTTPS, URL propres, 301, en-têtes, cache, compression
├── index.html                        35 Ko    Accueil
├── solutions.html                    31 Ko    Solutions
├── contact.html                      19 Ko    Contact
├── mentions-legales.html             13 Ko    Mentions légales
├── confidentialite.html              17 Ko    Confidentialité
├── sitemap.xml  robots.txt                    5 URL ; Disallow: /api/
├── og-image.png                               1200 × 630, validée par JP
├── favicon.svg  favicon.ico  apple-touch-icon.png
├── api/contact/
│   ├── .htaccess                              seul index.php accessible
│   ├── index.php                     17 Ko    envoi du formulaire (PHP 8.4)
│   └── README.md                              documentation — NE PAS téléverser
└── assets/
    ├── css/  tokens.css  site.css  no-js.css
    ├── js/   site.js                          menu mobile + formulaire
    ├── fonts/ 4 woff2 + 2 licences OFL
    ├── icons/ sprite.svg + licence ISC Lucide
    └── img/  gr-monogramme.svg + 3 logos de pôle (logo d'origine, G à la couleur du pôle), box-vision.svg
```

## 3. Auto-contrôle du brief (§ 10)

### Recherches (résultat attendu : 0)

| Recherche | Résultat |
|---|---|
| Termes interdits (raspberry, lecteur, pi, IA, supervision, monitoring, SLA, OTA, starter, lorem) | ✅ 0 (un commentaire CSS « Piège » contenait « Pi » : reformulé) |
| `tel:` | ✅ 0 (la clé JS `tel:` du formulaire a été écrite `'tel':` pour ne plus tomber dans la recherche) |
| `[TÉLÉPHONE]`, `[année]`, `À CONFIRMER`, `TEXTE MANQUANT`, `903 123` | ✅ 0 |
| Teintes crème / pêche `#FFF7EF` `#FFE3CF` | ✅ 0 |
| URL externes | ✅ seulement grstrategie.fr (canonical, og, JSON-LD), schema.org (JSON-LD), Google Maps « Nous trouver », cnil.fr |
| CDN, polices Google, traceurs | ✅ 0 |
| Couleurs hexadécimales dans `site.css` | ✅ 0 (tout passe par `var(--gr-…)`) |

### Vérifications

| Point | Résultat |
|---|---|
| Prix uniquement « 35 € TTC/mois » | ✅ |
| « la Box Vision » au féminin | ✅ aucune forme masculine |
| Aucun téléphone GR ; téléphone IONOS en texte simple | ✅ |
| SIREN 843 372 087, TVA FR89843372087, « © 2026 » | ✅ (5 pieds de page + pages légales) |
| Ancres `/solutions#signage #pricing #web #print #social` (+ `#faq`) | ✅ présentes une fois chacune |
| Liens internes sans `.html`, aucun lien vers `/under-construction.html` | ✅ |
| Formulaire : rappel décoché → `tel`/`creneau` absents du POST ; coché → requis + focus ; reset ; erreur sans téléphone | ✅ vérifié dans le navigateur et côté serveur |
| Aucune requête externe au chargement | ✅ 5 pages |
| Jamais de texte blanc sur orange | ✅ |
| Rendu 375 / 768 / 1280 px, sans défilement horizontal | ✅ 5 pages |
| Navigation clavier, focus visible | ✅ (Contact 29/29, Mentions 22/22, Confidentialité 34/34 ; Accueil et Solutions lors de leurs recettes) |
| Un seul H1 par page ; title ≤ 60, description ≤ 155, identiques aux textes | ✅ |
| Aucun fond crème/pêche, aucun dégradé hors sarcelle → encre | ✅ |
| Logo | ✅ logo d'origine (R noir, G rouge, cercle, fond blanc) partout — décision 17 de JP, qui remplace l'interdit « noir et rouge » du brief |
| Contrastes AA | ✅ seules les paires calculées de la charte sont utilisées, aucune nouvelle paire |
| HTML valide (validator.w3.org) et Lighthouse ≥ 90 | ⚠️ **non exécutés** : le validateur W3C demande d'envoyer les pages à un service en ligne, et Lighthouse n'est pas disponible ici. Les contrôles locaux passent (balises équilibrées, id uniques, hiérarchie des titres). À lancer par JP après mise en ligne. |

Tests automatiques : `python3 -I tests/verifier_site.py` → **84/84**. `.htaccess` testés sur un Apache 2.4 local : **23/23** (pages, 8 redirections 301, HTTPS, fichiers cachés et de travail bloqués, POST du formulaire).

## 4. Ce qui reste à fournir ou à valider par JP

1. ~~Image Open Graph~~ : validée par JP le 09/11/2026.
2. **Sources du kit** : `kit-claude/04-logo/README.md` et le brief § 4 interdisent encore le noir et rouge — à mettre à jour par JP (décision 17).
3. **Photos réelles** : 8 emplacements neutres étiquetés sur l'accueil, 2 sur Solutions. À livrer en WebP, avec les textes alternatifs de CADRAGE.md § 4 à ajuster selon les images.
4. **Rendu 3D de la Box Vision** pour le héros : le SVG stylisé est en place en attendant (décision 3).
5. Optionnel : redirection `www.grstrategie.fr` → `grstrategie.fr` (non ajoutée, non demandée ; les balises canonical suffisent pour le référencement).

## 5. Mise en ligne (à faire par JP, via la skill mise-en-ligne-ionos)

- Téléverser le contenu de `site/` à la racine web, **sauf** `api/contact/README.md`.
- Sur le serveur : supprimer `home.html`, `under-construction.html` et `ml.html` (leurs adresses sont déjà redirigées) ; remplacer l'ancien `.htaccess` racine et celui de `api/contact/`.
- Vérifier que `MAIL_TO` / `MAIL_FROM` en tête de `api/contact/index.php` sont corrects, puis faire un envoi réel du formulaire.
- Après mise en ligne : tester une adresse en http (→ https), `/contact.html` (→ `/contact`), le formulaire, puis lancer validator.w3.org et Lighthouse.

## 6. Choix techniques à connaître

- La balise meta CSP est **conservée** dans les pages en plus de l'en-tête envoyé par le `.htaccess` : elle protège si le `.htaccess` n'est pas lu (règles identiques, l'en-tête ajoute `frame-ancestors` et `upgrade-insecure-requests`).
- Cache : pages revalidées à chaque visite, CSS/JS 1 semaine, polices et images 30 jours. Après une modification de `site.css` ou `site.js`, certains visiteurs peuvent garder l'ancienne version jusqu'à 7 jours.
- Pages légales indexées (pas de `noindex`, décision 14) et présentes dans le sitemap.
