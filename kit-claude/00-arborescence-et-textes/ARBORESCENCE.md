# Arborescence du nouveau site grstrategie.fr (charte v2.1)

> Source de vérité pour la **structure** du site. Les textes exacts sont dans les fichiers `01-accueil.md` à `05-confidentialite.md` de ce même dossier.
> Tout élément marqué **[PROPOSITION – à valider par JP]** est une proposition de structure (libellé de menu, ancre), pas un texte validé : Claude doit le soumettre à JP avant de l'utiliser.
> Tout élément marqué **[TEXTE MANQUANT – demander à JP]** n'existe dans aucun texte validé : Claude ne doit **rien inventer** et doit poser la question à JP.

---

## 1. Vue d'ensemble

```
grstrategie.fr/
├── /                    → index.html             Accueil
├── /solutions           → solutions.html         Solutions (ancres #signage #pricing #web #print #social #faq)
├── /contact             → contact.html           Contact + formulaire (#formulaire) → POST /api/contact/
├── /mentions-legales    → mentions-legales.html  Mentions légales
├── /confidentialite     → confidentialite.html   Politique de confidentialité
├── /api/contact/        → index.php (EXISTANT sur IONOS, à étendre, ne pas recréer)
├── /assets/css/         tokens.css (= tokens-v2.1.css) + site.css
├── /assets/js/          site.js (menu mobile + formulaire)
├── /assets/fonts/       Inter + Plus Jakarta Sans (woff2, auto-hébergées)
├── /assets/img/         logo SVG, rendu Box Vision, photos WebP (fournies par JP)
├── /favicon.svg (+ favicon.ico / apple-touch-icon.png 180 px générés depuis le monogramme)
├── /sitemap.xml
├── /robots.txt
└── /.htaccess           URL sans .html + redirections 301 (voir § 4)
```

URL publiques **sans extension** (`/solutions`, pas `/solutions.html`), comme les balises canoniques du site actuel.

---

## 2. Éléments communs à toutes les pages

### En-tête (identique sur les 5 pages)
- Gauche : monogramme `gr-monogramme.svg` (36 × 40 px) + « **GR Stratégie** » + sous-ligne « Mulhouse · Haut-Rhin » (repris de la maquette et de la charte) → lien `/`.
- Barre « pilule » en verre clair, collante en haut (`position:sticky`), comme la maquette.
- Navigation principale **[PROPOSITION – à valider par JP]** (la maquette ne montre que des ancres de la page d'accueil, inutilisables sur un site multipage) :
  1. « Accueil » → `/`
  2. « Solutions » → `/solutions`
  3. « Tarifs » → `/solutions#pricing`
  4. « Contact » → `/contact`
  5. Bouton principal orange « Demander une démo » → `/contact`
- Mobile (< 980 px) : liens masqués, bouton « Menu » (icône `i-menu`, bascule en `i-x`) qui ouvre le menu ; `aria-expanded` / `aria-controls`.
- Lien d'évitement « Aller au contenu » → `#contenu` (repris du site actuel).
- Page courante : `aria-current="page"` sur le lien actif.

### Pied de page (identique sur les 5 pages, fond #061D20)
- Monogramme sur fond foncé (`gr-monogramme-fond-fonce.svg`) + « GR Stratégie »
- « 26 rue Victor Schoelcher, 68200 Mulhouse » · lien `mailto:contact@grstrategie.fr` (données validées)
- Liens : « Mentions légales » → `/mentions-legales` · « Confidentialité » → `/confidentialite` · « Contact » → `/contact`
- « © 2026 GR Stratégie · SIREN 843 372 087 »
- **Aucun** numéro de téléphone GR, aucune mention « IA », aucun ancien SIREN.

### Barre d'action collante mobile (toutes pages sauf `/contact`)
- Bouton principal « Demander une démo » → `/contact`, visible < 980 px uniquement (repris de la maquette, classe `.sticky`).

---

## 3. Pages

### 3.1 Accueil — `/` (`index.html`)

- **Title** : Affichage dynamique Mulhouse, 35 € TTC/mois | GR Stratégie
- **Meta description** : Louez la Box Vision dès 35 € TTC/mois à Mulhouse et dans le Haut-Rhin. Installation clé en main, logiciel simple. Démo sur place ou en visio.
- **H1** : Location d'affichage dynamique à Mulhouse et dans le Haut-Rhin
- **Modèle visuel** : `03-maquette/accueil-v2.1-couleur.html` (+ captures PNG)

| # | Section (nom de référence) | Ancre | Fond | Composant (classes maquette) | Liens / CTA → cible |
|---|---|---|---|---|---|
| S1 | Héros | — | sombre, dégradé #0E3F45 → #0B2E33 (`.hero.dsec`) | surtitre, H1, chapô, texte, carte prix verre sombre (`.price.glass`), liste à coches (`.chk`), visuel Box Vision (`.stage` + 3 pastilles `.float`) | « Demander une démo » (principal) → `/contact` ; « Voir nos solutions » (secondaire) → `/solutions` |
| S2 | Location | `#location` | gris clair #E8EDED (`.alt`) | 4 cartes étapes en verre numérotées 01–04 (`.cards.c2.steps`) + bloc « Ce qui est compris » (`.included.glass`) | « Voir les formules » (secondaire) → `/solutions#pricing` |
| S3 | Box Vision | `#box-vision` | fond de page #F3F5F5 | 2 colonnes (`.split.rev`) : texte + liste avantages en verre (`.feat`) / photo réelle haute (`.ph.tall`) | « Découvrir l'affichage dynamique » (secondaire) → `/solutions#signage` |
| S4 | Pour qui | `#pour-qui` | gris clair (`.alt.who`) | 4 cartes avec photo + titre à icône (`.who .cards`), note (`.note.glass`), badge preuve (`.proof`) | « Parler de mon projet » (principal) → `/contact` |
| S5 | Engagements | `#engagements` [PROPOSITION d'ancre] | sombre, dégradé (`.dsec`) | 2 colonnes (`.split`) : texte + 3 avantages en verre sombre / photo locaux-équipe (`.ph.tall`) | « Nous contacter » (secondaire sur sombre) → `/contact` |
| S6 | Autres services | `#services` | gris clair (`.alt.svc`) | 3 cartes à filet de couleur (`.svc .card`, couleurs de pôle) | « Création web » → `/solutions#web` ; « Création print » → `/solutions#print` ; « Community management » → `/solutions#social` ; « Voir tous nos services » (secondaire) → `/solutions` |
| S7 | CTA final (démo) | `#demo` (la maquette utilise `#contact`, renommé pour éviter la confusion avec la page /contact) | sarcelle nuit #08262A (`.dark.cta`) | panneau verre sombre (`.panel`) : H2 + texte + bouton / liste coordonnées (`.contact`) **sans téléphone** | « Demander une démo » (principal) → `/contact` ; `mailto:contact@grstrategie.fr` |

### 3.2 Solutions — `/solutions` (`solutions.html`)

- **Title** : Box Vision & communication à Mulhouse | GR Stratégie
- **Meta description** : Louez la Box Vision dès 35 € TTC/mois à Mulhouse et dans le Haut-Rhin. Installation clé en main, logiciel simple, web et print.
- **H1** : Des solutions pour vos écrans et votre communication à Mulhouse
- **Modèle visuel** : pas de maquette dédiée → réutiliser **uniquement** les composants de la maquette d'accueil (même alternance clair / sombre).

| # | Section | Ancre | Fond | Composant | Liens / CTA → cible |
|---|---|---|---|---|---|
| S1 | En-tête | — | sombre, dégradé (`.dsec`, version compacte du héros, sans visuel ou avec le rendu Box Vision si JP le souhaite — 1 seul rendu par page) | H1, texte, carte prix verre sombre | « Demander une démo » (principal) → `/contact` ; « Voir l'affichage dynamique » (secondaire) → `#signage` |
| S2 | Accès rapide aux offres | — | gris clair | 4 cartes cliquables (`.cards.c4`, style `.svc` avec filet de couleur de pôle) | → `#signage`, `#web`, `#print`, `#social` |
| S3 | Affichage dynamique | `#signage` (conservée) | fond de page | `.split` : texte + liste avantages `.feat` / photo réelle Box Vision (`.ph.tall`) ; badge `.proof` | « Demander une démo » (principal) → `/contact` |
| S4 | Tarifs et formules | `#pricing` (conservée) | gris clair | **offre unique** (pas 3 colonnes Starter/Pro/Entreprise) : carte prix mise en avant (verre renforcé 88 %) + 3 cartes « Écran », « Inclus », « Non inclus » (`.cards.c3`) + paragraphe sur mesure | « Demander un devis » (principal) → `/contact` |
| S5 | Création web | `#web` (conservée) | fond de page | carte service (filet Connect) avec liste | « Parler de votre site » (secondaire) → `/contact` |
| S6 | Création print | `#print` (conservée) | gris clair | 3 cartes (`.cards.c3`, filet Ads) | « Demander un devis print » (secondaire) → `/contact` |
| S7 | Réseaux sociaux | `#social` (conservée) | fond de page | carte service (filet Connect) avec liste | « Parler de vos réseaux » (secondaire) → `/contact` |
| S8 | FAQ | `#faq` | gris clair | 7 questions en `<details><summary>` (accordéon natif, carte pleine blanche) | « Poser une autre question » (secondaire) → `/contact` |
| S9 | CTA final | `#demo` | sarcelle nuit (`.dark.cta`) | panneau verre sombre identique à l'accueil S7 | « Réserver une démo » (principal) → `/contact` |

### 3.3 Contact — `/contact` (`contact.html`)

- **Title** : Contactez GR Stratégie à Mulhouse | Démo & devis
- **Meta description** : Parlez-nous de votre projet à Mulhouse : Box Vision dès 35 € TTC/mois, site web, print ou réseaux sociaux. Démo 15 min.
- **H1** : Contactez GR Stratégie

| # | Section | Ancre | Fond | Composant | Liens / CTA → cible |
|---|---|---|---|---|---|
| S1 | En-tête | — | sombre, dégradé (`.dsec`, compact) | H1 + texte | « Réserver une démo » (principal) → `#formulaire` ; « Demander à être rappelé » (secondaire) → `#formulaire` (+ coche la case rappel en JS, optionnel) |
| S2 | Coordonnées | `#coordonnees` | gris clair | 2 cartes : « Nos coordonnées » (adresse, e-mail, horaires, lien carte) + « Pourquoi nous écrire ? » | « Nous trouver » → lien Google Maps (externe, `rel="noopener"`, nouvel onglet annoncé) ; `mailto:contact@grstrategie.fr` |
| S3 | Formulaire | `#formulaire` | fond de page, formulaire dans une carte pleine blanche | formulaire POST `/api/contact/` (voir `03-contact.md` et BRIEF § formulaire) | « Envoyer » (principal, submit) ; « Effacer » (secondaire, reset) ; lien « politique de confidentialité » → `/confidentialite` |

Pas de barre collante mobile sur cette page (le formulaire est déjà l'action).

### 3.4 Mentions légales — `/mentions-legales` (`mentions-legales.html`)

- **Title** : Mentions légales — GR Stratégie Mulhouse
- **Meta description** : Mentions légales de GR Stratégie (Mulhouse) : éditeur, hébergeur, propriété intellectuelle, responsabilité. Données : voir /confidentialite.
- **H1** : Mentions légales
- Mise en page : en-tête compact clair (H1 + intro + date), puis **carte pleine blanche** sur fond gris clair, largeur de lecture ≤ 70 caractères, sommaire d'ancres optionnel.
- Sections (H2) : 1 Éditeur du site `#editeur` · 2 Activité `#activite` · 3 Hébergeur `#hebergeur` · 4 Propriété intellectuelle `#propriete` · 5 Données personnelles et cookies `#donnees` · 6 Responsabilité `#responsabilite` · 7 Droit applicable `#droit` · 8 Contact `#contact-ml`
- Liens : `/confidentialite`, `/contact`, `mailto:contact@grstrategie.fr`. Le téléphone d'IONOS est affiché **en texte simple, sans lien `tel:`**.
- `<meta name="robots" content="noindex, follow">` **[PROPOSITION – à valider par JP]** (optionnel).

### 3.5 Confidentialité — `/confidentialite` (`confidentialite.html`)

- **Title** : Confidentialité — GR Stratégie Mulhouse
- **Meta description** : Comment GR Stratégie (Mulhouse) traite vos données : formulaire de contact, droits RGPD, cookies. Contact : contact@grstrategie.fr.
- **H1** : Politique de confidentialité
- Mise en page identique aux mentions légales.
- Sections (H2) : 1 Responsable `#responsable` · 2 Données collectées `#donnees` · 3 Finalités `#finalites` · 4 Base légale `#base-legale` · 5 Destinataires `#destinataires` · 6 Transfert hors UE `#transfert` · 7 Conservation `#conservation` · 8 Sécurité `#securite` · 9 Vos droits `#droits` · 10 CNIL `#cnil` · 11 Cookies `#cookies` · 12 Public du site `#public` · 13 Modification `#modification`
- Liens : `/contact`, `mailto:contact@grstrategie.fr`, `https://www.cnil.fr` (externe). Téléphone IONOS en texte simple.

---

## 4. Anciennes URL → nouvelles URL (redirections 301 dans `.htaccess`)

| Ancienne URL (site actuel) | Nouvelle URL | Action |
|---|---|---|
| `/` | `/` | inchangée |
| `/index.html` | `/` | 301 |
| `/home.html` (doublon de l'accueil présent sur le serveur) | `/` | 301 (et supprimer le fichier, après accord de JP) |
| `/solutions` | `/solutions` | inchangée (sert `solutions.html`) |
| `/solutions.html` | `/solutions` | 301 |
| `/solutions#signage` `#pricing` `#web` `#print` `#social` | mêmes ancres | conservées |
| `/contact` | `/contact` | inchangée (sert `contact.html`, **sans** la redirection `meta refresh` actuelle) |
| `/contact.html` | `/contact` | 301 |
| `/ml.html` | `/mentions-legales` | 301 |
| `/mentions-legales.html` | `/mentions-legales` | 301 |
| `/mentions-legales` | `/mentions-legales` | inchangée |
| `/confidentialite.html` | `/confidentialite` | 301 |
| `/under-construction.html` (+ `#web` `#signage` `#print` `#social`) | `/` (ancres → `/solutions#…` si possible) | 301, puis retirer le fichier (après accord de JP) |
| `/api/contact/` | `/api/contact/` | **ne pas toucher** aux règles qui le servent |

⚠️ Avant d'écrire le `.htaccess`, Claude demande à JP le `.htaccess` actuel du serveur IONOS (il peut déjà contenir des règles HTTPS / réécriture) et le complète au lieu de l'écraser.

---

## 5. Fichiers `sitemap.xml` / `robots.txt`

- `sitemap.xml` : `/`, `/solutions`, `/contact`, `/mentions-legales`, `/confidentialite` (URL absolues `https://grstrategie.fr/…`, `lastmod` 2026-11-09 ou date de mise en ligne).
- `robots.txt` : tout autoriser sauf `/api/`, + ligne `Sitemap: https://grstrategie.fr/sitemap.xml`.
