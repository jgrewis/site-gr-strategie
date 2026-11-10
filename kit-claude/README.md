# Kit Claude — refonte de grstrategie.fr (charte GR v2.1)

Kit préparé le 9 novembre 2026 pour que Claude (claude.ai) refasse le site en **HTML / CSS / JS pur** en appliquant **strictement** la charte v2.1 validée. Rien n'est en ligne ; Claude ne doit rien publier lui-même.

## Comment l'utiliser (JP)

**Option A — Projet Claude (recommandé)**
1. Sur claude.ai, créer un **Projet** « Site GR Stratégie ».
2. Dans les connaissances du projet, ajouter **tous les fichiers** du kit (glisser les dossiers ou les fichiers ; si l'import de .zip n'est pas accepté, dézipper d'abord). Les fichiers les plus importants : `BRIEF-CLAUDE.md`, tout `00-arborescence-et-textes/`, `02-charte/tokens-v2.1.css`, `03-maquette/accueil-v2.1-couleur.html` et ses 3 captures PNG, `04-logo/`.
3. Ouvrir une conversation dans le projet et **coller le contenu de `BRIEF-CLAUDE.md` comme premier message**.
4. Claude doit d'abord répondre par la liste des fichiers reçus / manquants et ses questions. **Répondre à ses questions avant qu'il code.**

**Option B — conversation simple**
Joindre le zip `kit-claude-gr-strategie.zip` (ou les fichiers un par un), puis coller `BRIEF-CLAUDE.md` comme premier message.

Ensuite : valider la page d'accueil avant que Claude passe aux autres pages. À la fin, exiger son rapport d'auto-contrôle (section 10 du brief).

## Ordre de lecture (pour Claude)

1. `BRIEF-CLAUDE.md` — les règles, la méthode, ce qu'il doit demander.
2. `00-arborescence-et-textes/` — **source de vérité du contenu** : `ARBORESCENCE.md` (plan du site, en-tête, pied de page, redirections) puis `01-accueil.md` → `05-confidentialite.md` (textes définitifs, section par section).
3. `02-charte/` — **source de vérité du style** : `tokens-v2.1.css` (valeurs), `charte-gr-v2.1.html` + capture (règles d'usage).
4. `03-maquette/` — page d'accueil de référence (HTML + captures desktop, mobile, premier écran mobile) ; `extraits/` : sprite d'icônes Lucide et rendu SVG provisoire de la Box Vision.
5. `04-logo/` — 7 SVG du monogramme + README (quel fichier où).
6. `06-polices/` — Inter et Plus Jakarta Sans auto-hébergées (licence OFL).
7. `05-site-actuel/` — ancien site, **référence seulement** (URL, ancres, champs du formulaire). Ne pas réutiliser le style ni les textes.
8. `01-textes/` — brouillons validés d'origine, avec les notes de travail (pour contexte).

## Ce que le kit ne contient pas (Claude doit le demander à JP)

Photos réelles, rendu 3D de la Box Vision, image de partage, `api/contact/index.php` actuel, `.htaccess` actuel, décision sur les sous-marques Vision / Connect / Ads, validation du menu et du favicon. Liste complète : section 12 de `BRIEF-CLAUDE.md`.

## Exclu volontairement

La charte v2 (fonds crème / pêche, jugée trop féminine par JP) et ses fichiers, les références du mood board, les fichiers de travail, le wireframe et les archives.
