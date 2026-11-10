# Polices auto-hébergées (RGPD : aucun appel à Google Fonts)

Fichiers WOFF2 **variables** (graisses 100–900 / 200–800 dans un seul fichier), sous-ensembles latin + latin étendu, issus du paquet Fontsource 5.3.0 (copie des fichiers Google Fonts). Licence SIL Open Font License 1.1 (fichiers LICENCE fournis, à garder dans `/assets/fonts/`).

| Fichier | Famille | Usage |
|---|---|---|
| `plus-jakarta-sans-latin-wght-normal.woff2` + `-latin-ext-` | Plus Jakarta Sans | Titres H1/H2 (800), H3 et nom de marque (700) |
| `inter-latin-wght-normal.woff2` + `-latin-ext-` | Inter | Texte (400), boutons et intertitres (500/600) |

Copier dans `/assets/fonts/` et déclarer :

```css
@font-face{font-family:"Plus Jakarta Sans";src:url("/assets/fonts/plus-jakarta-sans-latin-wght-normal.woff2") format("woff2");font-weight:200 800;font-style:normal;font-display:swap;unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
@font-face{font-family:"Plus Jakarta Sans";src:url("/assets/fonts/plus-jakarta-sans-latin-ext-wght-normal.woff2") format("woff2");font-weight:200 800;font-style:normal;font-display:swap;unicode-range:U+0100-02BA,U+02BD-02C5,U+02C7-02CC,U+02CE-02D7,U+02DD-02FF,U+0304,U+0308,U+0329,U+1D00-1DBF,U+1E00-1E9F,U+1EF2-1EFF,U+2020,U+20A0-20AB,U+20AD-20C0,U+2113,U+2C60-2C7F,U+A720-A7FF}
@font-face{font-family:"Inter";src:url("/assets/fonts/inter-latin-wght-normal.woff2") format("woff2");font-weight:100 900;font-style:normal;font-display:swap;unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
@font-face{font-family:"Inter";src:url("/assets/fonts/inter-latin-ext-wght-normal.woff2") format("woff2");font-weight:100 900;font-style:normal;font-display:swap;unicode-range:U+0100-02BA,U+02BD-02C5,U+02C7-02CC,U+02CE-02D7,U+02DD-02FF,U+0304,U+0308,U+0329,U+1D00-1DBF,U+1E00-1E9F,U+1EF2-1EFF,U+2020,U+20A0-20AB,U+20AD-20C0,U+2113,U+2C60-2C7F,U+A720-A7FF}
```

Précharger seulement les deux fichiers « latin » (`<link rel="preload" as="font" type="font/woff2" crossorigin>`).
