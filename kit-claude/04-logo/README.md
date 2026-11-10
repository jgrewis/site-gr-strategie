# Logo GR Stratégie — monogramme v2 (charte v2.1)

7 fichiers SVG vectoriels. **Ne jamais les redessiner, recolorer, déformer ni les convertir en PNG pour le site** (sauf pour générer `favicon.ico` / `apple-touch-icon.png`).

| Fichier | Couleurs | Où l'utiliser sur le site |
|---|---|---|
| `gr-monogramme.svg` | R sarcelle #0E5A61, G orange #FF7A1F | **Version principale.** En-tête (fond clair), toutes les sections claires, base du favicon. |
| `gr-monogramme-fond-fonce.svg` | R crème #FFF7EF, G orange #FF7A1F | **Uniquement sur fond sombre** : pied de page, sections sombres. Le R crème est une couleur de logo (prévue par la charte v2.1 « Fond foncé · R crème »), **pas** un fond. Si JP préfère un R blanc pur, il le dira : demander avant de modifier. |
| `gr-monogramme-cercle.svg` | idem principal + cercle sarcelle | Avatars, réseaux sociaux, image de partage. Pas dans l'en-tête (version par défaut = sans cercle). |
| `gr-monogramme-mono-sarcelle.svg` | tout sarcelle #0E5A61 | Usage une couleur (impression, filigrane). Pas utile sur le site en principe. |
| `gr-monogramme-vision.svg` | G corail #E8473F | Pôle GR Vision (affichage dynamique). **Ne pas utiliser** tant que JP n'a pas confirmé que les sous-marques Vision / Connect / Ads restent. |
| `gr-monogramme-connect.svg` | G bleu #38A8DC | Pôle GR Connect (web, réseaux sociaux). Même réserve. |
| `gr-monogramme-ads.svg` | G ambre #F5A623 | Pôle GR Ads (graphisme, print). Même réserve. |

## Règles (charte v2.1, section 01)
- **Taille minimale** : 24 px de haut à l'écran ; logo complet (monogramme + « GR Stratégie ») : 120 px de large minimum. En-tête : 36 × 40 px ; pied de page : 28 × 32 px (maquette).
- **Zone de protection** : X tout autour, X = largeur du jambage du R.
- **Interdits** : retour au noir et rouge ; déformer / étirer ; poser le monogramme sur de l'orange (le G disparaît) ; losange, rotation, ombre portée.
- Logo complet : nom « GR Stratégie » en Plus Jakarta Sans ExtraBold (800) ; sur le site la sous-ligne est « Mulhouse · Haut-Rhin » (Inter 500, capitales, 11 px).
- **Intégration** : SVG en ligne (inline) avec `role="img"` et `aria-label="GR Stratégie"`, ou `<img src="/assets/img/gr-monogramme.svg" alt="GR Stratégie">`. Si plusieurs SVG sont insérés en ligne dans la même page, renommer les `id` de `<mask>` (k1, k2, k3…) pour qu'ils restent **uniques** dans la page, sinon le masque du croisement R/G casse.
- **Favicon** : `favicon.svg` = copie de `gr-monogramme.svg` ; générer `favicon.ico` (32 px) et `apple-touch-icon.png` (180 px, fond #F3F5F5) — **faire valider le rendu par JP**.
