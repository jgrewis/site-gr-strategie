#!/usr/bin/env python3
"""Tests statiques du site GR Stratégie (auto-contrôle § 10 de kit-claude/BRIEF-CLAUDE.md).

Usage : python3 -I tests/verifier_site.py [page.html ...]
Sans argument : toutes les pages .html présentes dans site/.
Code de sortie 0 = tout passe, 1 = au moins un échec.
Les contrôles navigateur (réseau, console, 375/768/1280 px, clavier) se font à part.
"""
import html.parser
import pathlib
import re
import subprocess
import sys

ROOT = pathlib.Path(__file__).resolve().parent.parent / "site"
PAGES_PREVUES = {"/": "index.html", "/affichage-dynamique": "affichage-dynamique.html",
                 "/creation-site-web": "creation-site-web.html", "/community-management": "community-management.html",
                 "/print-affichage-publicitaire": "print-affichage-publicitaire.html", "/contact": "contact.html",
                 "/mentions-legales": "mentions-legales.html", "/confidentialite": "confidentialite.html"}
PRIX_AUTORISES = ("35", "240")  # BoxVision 35 € TTC/mois, community management 240 € TTC/mois (JP, 10/11/2026)
ARTICLES_BOXVISION = {"la", "une"}
TEXT_EXT = {".html", ".css", ".js", ".php", ".xml", ".txt", ".svg", ".json", ".htaccess"}
URL_OK = re.compile(r"https?://(grstrategie\.fr|alventus\.ch|(www\.)?paulinekphotographie\.com|(www\.)?deployercoaching\.fr|schema\.org|www\.w3\.org|www\.cnil\.fr|cnil\.fr|"
                    r"www\.google\.com/maps|maps\.google\.com|maps\.app\.goo\.gl|goo\.gl/maps)")

resultats = []


def check(nom, ok, detail=""):
    resultats.append((ok, nom, detail))


def fichiers_texte():
    for p in ROOT.rglob("*"):
        if p.is_file() and (p.suffix in TEXT_EXT or p.name == ".htaccess") and not p.name.startswith("LICENCE"):
            yield p


def grep(regex, fichiers, flags=0):
    hits = []
    rx = re.compile(regex, flags)
    for f in fichiers:
        for n, ligne in enumerate(f.read_text(encoding="utf-8", errors="replace").splitlines(), 1):
            if rx.search(ligne):
                hits.append(f"{f.relative_to(ROOT)}:{n}")
    return hits


# ---------- Contrôles globaux (§ 10) ----------
tous = list(fichiers_texte())
web = [f for f in tous if f.suffix in {".html", ".css", ".js"}]

h = grep(r"raspberry|lecteur|\bpi\b|intelligence artificielle|\bIA\b|supervision|monitoring|\bSLA\b|\bOTA\b|starter|lorem",
         tous, re.I)
check("Termes interdits", not h, ", ".join(h[:8]))
noms = [str(p.relative_to(ROOT)) for p in ROOT.rglob("*") if re.search(r"raspberry|lecteur|\bpi\b|starter", p.name, re.I)]
check("Termes interdits dans les noms de fichiers", not noms, ", ".join(noms))
h = grep(r"href\s*=\s*[\"']?tel:|tel:\s*\+?\d", tous)
check("Aucun lien tel:", not h, ", ".join(h))
h = grep(r"\[TÉLÉPHONE\]|\[année\]|À CONFIRMER|TEXTE MANQUANT|PROPOSITION –|903 123|903123", tous)
check("Aucun trou de maquette", not h, ", ".join(h))
h = grep(r"#FFF7EF|#FFE3CF", [f for f in tous if f.suffix in {".css", ".html", ".svg"}], re.I)
check("Aucune teinte crème/pêche", not h, ", ".join(h))
h = []
for f in web:
    for n, ligne in enumerate(f.read_text(encoding="utf-8").splitlines(), 1):
        for u in re.findall(r"https?://[^\s\"'<>)]+", ligne):
            if not URL_OK.match(u):
                h.append(f"{f.relative_to(ROOT)}:{n} {u}")
check("URL externes autorisées seulement", not h, ", ".join(h[:8]))
h = grep(r"fonts\.googleapis|fonts\.gstatic|cdn\.|unpkg|jsdelivr|googletagmanager|analytics|gtag|facebook\.(com|net)|fbcdn|hotjar", tous, re.I)
check("Aucun CDN ni traceur", not h, ", ".join(h))
css = ROOT / "assets/css/site.css"
h = grep(r"#[0-9A-Fa-f]{3,6}\b", [css]) if css.exists() else ["site.css absent"]
check("site.css : aucun hexadécimal", not h, ", ".join(h))
js = ROOT / "assets/js/site.js"
if js.exists():
    r = subprocess.run(["node", "--check", str(js)], capture_output=True, text=True)
    check("site.js : syntaxe valide", r.returncode == 0, r.stderr.strip()[:200])


# ---------- Contrôles par page ----------
class Analyse(html.parser.HTMLParser):
    VIDES = {"area", "base", "br", "col", "embed", "hr", "img", "input", "link", "meta", "source", "track", "wbr",
             "path", "rect", "circle", "line", "polyline", "polygon", "ellipse", "use", "stop"}

    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.pile, self.erreurs, self.ids, self.h1 = [], [], [], 0
        self.liens, self.srcs, self.styles, self.title, self.desc = [], [], [], "", ""
        self.headings, self._in_title = [], False
        self.textes, self._ignore = [], 0  # textes lus par un humain ou un moteur (texte, alt, meta, JSON-LD)

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        if tag not in self.VIDES:
            self.pile.append((tag, self.getpos()[0]))
        if "id" in a:
            self.ids.append(a["id"])
        if tag == "h1":
            self.h1 += 1
        if re.fullmatch(r"h[1-6]", tag):
            self.headings.append(int(tag[1]))
        if tag == "a" and "href" in a:
            self.liens.append(a["href"])
        for k in ("src", "href"):
            if tag in {"img", "link", "script", "source"} and a.get(k):
                self.srcs.append(a[k])
        if "style" in a:
            self.styles.append(a["style"])
        self._attrs_texte(tag, a)
        if tag == "style" or (tag == "script" and a.get("type") != "application/ld+json"):
            self._ignore += 1
        if tag == "title":
            self._in_title = True
        if tag == "meta" and a.get("name") == "description":
            self.desc = a.get("content", "")

    def _attrs_texte(self, tag, a):
        for k in ("alt", "aria-label", "title", "placeholder"):
            if a.get(k):
                self.textes.append((self.getpos()[0], a[k]))
        if tag == "meta" and a.get("content") and "http-equiv" not in a and a.get("name") != "viewport":
            self.textes.append((self.getpos()[0], a["content"]))

    def handle_startendtag(self, tag, attrs):
        a = dict(attrs)
        self._attrs_texte(tag, a)
        if "id" in a:
            self.ids.append(a["id"])
        if "style" in a:
            self.styles.append(a["style"])

    def handle_endtag(self, tag):
        if tag in self.VIDES:
            return
        if tag in ("style", "script") and self._ignore:
            self._ignore -= 1
        if tag == "title":
            self._in_title = False
        if self.pile and self.pile[-1][0] == tag:
            self.pile.pop()
        else:
            self.erreurs.append(f"</{tag}> ligne {self.getpos()[0]} (ouvert : {self.pile[-1] if self.pile else '—'})")

    def handle_data(self, data):
        if not self._ignore and data.strip():
            self.textes.append((self.getpos()[0], data))
        if self._in_title:
            self.title += data


def verifier_page(page):
    nom = page.name
    src = page.read_text(encoding="utf-8")
    a = Analyse()
    a.feed(src)
    check(f"{nom} : balises équilibrées", not a.erreurs and not a.pile, "; ".join(a.erreurs[:3]) or str(a.pile[:3]))
    check(f"{nom} : un seul H1", a.h1 == 1, f"{a.h1} H1")
    sauts = [f"h{x}→h{y}" for x, y in zip(a.headings, a.headings[1:]) if y > x + 1]
    check(f"{nom} : hiérarchie des titres sans saut", not sauts, ", ".join(sauts))
    doublons = sorted({i for i in a.ids if a.ids.count(i) > 1})
    check(f"{nom} : id uniques", not doublons, ", ".join(doublons))
    check(f"{nom} : title ≤ 60 caractères", 0 < len(a.title.strip()) <= 60, f"{len(a.title.strip())} car.")
    check(f"{nom} : meta description ≤ 155 caractères", 0 < len(a.desc) <= 155, f"{len(a.desc)} car.")
    check(f"{nom} : lang=fr", '<html lang="fr"' in src)
    check(f"{nom} : aucun noindex", "noindex" not in src)
    check(f"{nom} : canonical présent", 'rel="canonical"' in src)
    vides = [l for l in a.liens if l in {"#", ""}]
    check(f"{nom} : aucun lien vide", not vides)
    check(f"{nom} : aucun style inline", not a.styles, " | ".join(a.styles[:3]))
    check(f"{nom} : CSP sans 'unsafe-inline'", "Content-Security-Policy" in src and "unsafe-inline" not in src)
    ids = set(a.ids)
    manquants, a_venir = [], []
    for l in a.liens + a.srcs:
        if l.startswith(("mailto:", "http")):
            continue
        chemin, _, ancre = l.partition("#")
        if chemin == "" and ancre and ancre not in ids:
            manquants.append(l)
        elif chemin.startswith("/"):
            if chemin in PAGES_PREVUES:
                if not (ROOT / PAGES_PREVUES[chemin]).exists():
                    a_venir.append(chemin)
            elif not (ROOT / chemin.lstrip("/")).exists():
                manquants.append(l)
        elif chemin.endswith(".html"):
            manquants.append(l + " (lien en .html)")
    check(f"{nom} : liens et ressources internes valides", not manquants, ", ".join(sorted(set(manquants))))
    if a_venir:
        print(f"  info  {nom} : pages pas encore créées → {', '.join(sorted(set(a_venir)))}")
    prix = re.findall(r"\d+(?:[.,]\d+)?(?:&nbsp;| | | )?€", src)
    autres = [p for p in prix if not re.match(r"(%s)\D" % "|".join(PRIX_AUTORISES), p)]
    check(f"{nom} : aucun prix hors 35 € et 240 €", not autres, ", ".join(autres))
    # Règles de rédaction de la revue du 10/11/2026 (points 5 et 10)
    deux_mots = [f"l.{n}" for n, t in a.textes if re.search(r"box\s+vision", t, re.I)]
    check(f"{nom} : « BoxVision » en un mot", not deux_mots, ", ".join(deux_mots[:6]))
    sans_article = []
    for n, t in a.textes:
        for m in re.finditer(r"(\S*)\s+BoxVision|^\s*BoxVision", t, re.I):
            mot = (m.group(1) or "").lower().lstrip("(«\"'’")
            if mot not in ARTICLES_BOXVISION:
                sans_article.append(f"l.{n} « {m.group(0).strip()[:30]} »")
    check(f"{nom} : « BoxVision » précédée de la/une", not sans_article, ", ".join(sans_article[:6]))
    ponct = [f"l.{n} « {t.strip()[:40]} »" for n, t in a.textes if re.search(r"[—–;]", t)]
    check(f"{nom} : ni cadratin, ni demi-cadratin, ni point-virgule", not ponct, ", ".join(ponct[:6]))
    check(f"{nom} : JSON-LD sans téléphone", "telephone" not in src)


pages = [ROOT / p for p in sys.argv[1:]] if len(sys.argv) > 1 else sorted(ROOT.glob("*.html"))
for p in pages:
    verifier_page(p)

echecs = [r for r in resultats if not r[0]]
for ok, nom, detail in resultats:
    print(f"  {'OK  ' if ok else 'ÉCHEC'} {nom}" + (f"  → {detail}" if detail and not ok else ""))
print(f"\n{len(resultats) - len(echecs)}/{len(resultats)} tests passés")
sys.exit(1 if echecs else 0)
