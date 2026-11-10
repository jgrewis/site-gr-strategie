# Site actuel (en ligne avant la refonte) — RÉFÉRENCE UNIQUEMENT

Ces fichiers servent **seulement** à connaître :
- les URL et ancres existantes (`/solutions#signage #pricing #web #print #social`, `/contact`, `/mentions-legales`),
- la structure du formulaire actuel (`action="/api/contact"`, `method="post"`, noms de champs `nom`, `email`, `tel`, `sujet`, `message`, `delai`, `rgpd`),
- le lien d'évitement et le menu mobile (`aria-controls`, `aria-expanded`).

## ⛔ À NE PAS faire
- **Ne pas réutiliser le style** (`gr-strategy.css`, couleurs orange #FF6B35, losanges, noir et rouge) : il est remplacé par la charte v2.1.
- **Ne pas réutiliser les textes** : ils sont obsolètes et contiennent des erreurs (ancien SIREN faux, téléphone, ancien nom du produit, mentions « IA locale », « supervision », « contenus sur mesure », liens `/under-construction.html`). Les seuls textes valides sont dans `00-arborescence-et-textes/`.
- Ne pas reprendre l'ancien nom du produit : le produit s'appelle **la Box Vision**.
- `ml.html` contient un lien `tel:` vers IONOS : dans le nouveau site, le téléphone d'IONOS est en texte simple.

Fichiers : `index.html` (accueil), `solutions.html`, `contact.html` (redirige aujourd'hui vers `/under-construction.html`), `ml.html` (anciennes mentions légales), `header.html` et `footer.html` (gabarits injectés par JS sur le site actuel).
Non fournis : `gr-strategy.css`, `assets/js/site.js`, `assets/js/include-header.js`, `img/`, `.htaccess`, `api/contact/index.php` → les demander à JP si nécessaire.
