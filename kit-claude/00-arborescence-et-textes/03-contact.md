# 03 — Contact (`/contact`, `contact.html`) — textes définitifs

> Textes copiés de `01-textes/contact-v2.md` (validé). Copier **mot pour mot**. Comportement détaillé du formulaire : `BRIEF-CLAUDE.md` § 7 et note développeur de `01-textes/contact-v2.md`.
> **Aucun numéro de téléphone GR, aucun lien `tel:`.**

## SEO
- **title** : Contactez GR Stratégie à Mulhouse | Démo & devis
- **meta description** : Parlez-nous de votre projet à Mulhouse : Box Vision dès 35 € TTC/mois, site web, print ou réseaux sociaux. Démo 15 min.
- **og:image** : [TEXTE MANQUANT – demander à JP]

---

## S1 — En-tête

- **H1** : Contactez GR Stratégie
- **Texte** : Dites-nous en quelques mots votre besoin. Nous revenons vers vous rapidement. Une démo de 15 minutes est possible, sur place ou en visio, au choix. Vous pouvez aussi demander à être rappelé(e) via le formulaire.
- **Boutons** :
  - « Réserver une démo » → `#formulaire` (principal)
  - « Demander à être rappelé » → `#formulaire` (secondaire ; en JS, peut cocher la case « Je préfère être rappelé(e) » et ouvrir les champs de rappel)

---

## S2 — Coordonnées (`#coordonnees`)

- **H2** : Nos coordonnées
- **Adresse** :
  GR Stratégie
  26 rue Victor Schoelcher
  68200 Mulhouse
- E-mail : contact@grstrategie.fr (lien `mailto:`)
- Horaires : lun–ven · 9h–18h · Alsace / Grand Est
- Lien « Nous trouver » → https://maps.google.com/?q=26+rue+Victor+Schoelcher+68200+Mulhouse
  *(lien simple, pas de carte Google intégrée en iframe : elle chargerait des cookies tiers)*

- **H3 / titre de carte** : Pourquoi nous écrire ?
  - Affichage dynamique : location ou achat de la Box Vision dès 35 € TTC/mois, écran du catalogue si besoin
  - Site web, print ou réseaux sociaux
  - Démo de 15 minutes : logiciel et modèle de contenu, sur place ou en visio
  - Demander à être rappelé(e) sur le créneau qui vous convient

---

## S3 — Formulaire (`#formulaire`)

- **H2** : Parlez-nous de votre projet
- **H3** : Formulaire de contact
- `<form id="formulaire" method="post" action="/api/contact/">` (le site actuel utilise `id="contact-form"` et `action="/api/contact"` : conserver la cible que le script PHP existant attend — à vérifier avec JP)

### Champs (dans cet ordre)

| # | Libellé visible | name / id | Type | Obligatoire | Placeholder / options |
|---|---|---|---|---|---|
| 1 | Nom / Entreprise | `nom` | text, `autocomplete="name"` | oui | Ex. Marie Dupont, Hôtel des Vosges |
| 2 | E-mail | `email` | email, `autocomplete="email"` | oui | vous@exemple.fr |
| 3 | Sujet | `sujet` | select | oui | — Choisir — (valeur vide) · Affichage dynamique (location ou achat) · Écran du catalogue · Site web · Print · Réseaux sociaux · Autre |
| 4 | Format de démo (si vous en souhaitez une) | `demo_format` | select ou radios | non | Sur place · En visio · Pas pour le moment |
| 5 | Message | `message` | textarea | oui | Décrivez votre contexte, le nombre d'écrans envisagé, vos objectifs |
| 6 | Délai souhaité (optionnel) | `delai` | select | non | — Indifférent — (valeur vide) · Cette semaine · Ce mois-ci · Ce trimestre |
| 7 | Je préfère être rappelé(e) | `rappel` | checkbox | non | — |
| 8 | Téléphone | `tel` | tel, `autocomplete="tel"` | **oui seulement si `rappel` coché** ; sinon masqué, vidé, désactivé, non envoyé | +33 6 12 34 56 78 |
| 9 | Créneau souhaité | `creneau` | radios (fieldset + legend « Créneau souhaité ») | **oui seulement si `rappel` coché** ; sinon masqué, vidé, non envoyé | `matin` = « Matin » · `apres_midi` = « Après-midi » |
| 10 | (case de consentement) | `rgpd` | checkbox | oui | voir texte ci-dessous |

Champs 8 et 9 regroupés dans `<div id="rappel-fields" hidden>`.

### Texte de la case RGPD (`rgpd`)
J'accepte que GR Stratégie me contacte au sujet de ma demande. Vos données ne servent qu'à vous répondre. Un numéro de téléphone n'est demandé que si vous souhaitez être rappelé(e).
- Lien : « politique de confidentialité » → `/confidentialite`
  *(le texte validé ne place pas le lien dans la phrase : ajouter à la suite « Voir notre politique de confidentialité. » est une formulation à valider par JP — [PROPOSITION – à valider par JP])*

### Boutons
- « Envoyer » (`type="submit"`, principal orange)
- « Effacer » (`type="reset"`, secondaire) — au reset, les champs de rappel sont de nouveau masqués

### Messages
- **Succès** : Merci ! Votre demande a bien été envoyée.
- **Erreur** : Oups, une erreur est survenue. Réessayez, ou écrivez-nous à contact@grstrategie.fr.
  *(l'adresse e-mail en lien `mailto:` ; aucun téléphone)*
- **Messages de validation des champs** (champ vide, e-mail invalide, téléphone invalide, créneau manquant) : [TEXTE MANQUANT – demander à JP] — à défaut, proposer à JP des messages courts du type « Indiquez votre e-mail. » / « Numéro de téléphone français attendu, par ex. 06 12 34 56 78. » **avant** de les intégrer.
