# Revue de correction, liste des modifications demandées

Démarrée le 10/11/2026 sur la démo locale (http://localhost:8766).
Corrections appliquées le 10/11/2026, suivi dans PLAN-revue-corrections.md.

## Page d'accueil (index.html)

### 1. Reprendre tout le texte de la page d'accueil, avec un nouveau positionnement
- **Constat** : le hero (« Location d'affichage dynamique à Mulhouse et dans le Haut-Rhin ») et la page entière ne parlent que de la location d'écrans. Les autres services de GR n'apparaissent pas.
- **Demande** : réécrire les textes en les optimisant pour le SEO autour d'un axe de niche, par exemple « Agence de communication spécialisée dans les nouvelles technologies ».
- **Contenu à introduire progressivement** :
  - l'affichage dynamique (activité principale) ;
  - le community management ;
  - la création de sites web.
- **Conséquences à prévoir** : le title, la meta description, le H1, les données structurées et peut-être la page Solutions devront suivre ce positionnement.
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 3. Section « Location » : ne pas laisser croire que GR loue surtout des écrans
- **Constat** : le titre H2 (#titre-location, index.html ligne 232) dit « Comment fonctionne la location d'écrans ? ». Or GR loue surtout le player (Box Vision) ; l'écran est optionnel.
- **Demande** : un titre plus général, au choix :
  - « Comment fonctionne un écran dynamique ? »
  - « Comment fonctionne la location avec GR Stratégie ? »
- **À vérifier en même temps** : que le texte d'introduction et les étapes de la section mettent bien en avant le player loué. L'étape 02 le fait déjà (« la Box Vision, et l'écran si vous en prenez un »).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 4. Prix de la Box Vision : expliquer ce qui fait varier le tarif
- **Constat** : la mention « (tarif de référence sur 48 mois) » est technique et ne dit pas pourquoi le prix change.
- **Demande** : remplacer par « (le tarif varie selon la durée d'engagement et la puissance du player) ».
- **Variante proposée par Claude, à valider** : « modèle de player » ou « performances du player » à la place de « puissance », plus clair pour un commerçant.
- **Autres endroits où appliquer la même logique** (cohérence obligatoire) :
  - index.html l. 203 : astérisque du bloc prix du hero (« *tarif sur 48 mois… ») ;
  - index.html l. 260 : bloc « Ce qui est compris » (élément signalé) ;
  - solutions.html l. 96 : FAQ dans les données structurées (JSON-LD) ;
  - solutions.html l. 211 : astérisque du bloc prix ;
  - solutions.html l. 266 : carte Box Vision ;
  - solutions.html l. 295 : puce « Tarif de référence calculé sur 48 mois » ;
  - solutions.html l. 428 : réponse de la FAQ visible.
- **Point de vigilance** : « à partir de 35 € » doit rester exact, c'est-à-dire correspondre au player d'entrée de gamme sur la durée la plus longue. **Confirmé par JP le 10/11/2026** : c'est le tarif actuellement proposé. Un ancien client sous contrat à 50 € garde son prix contractuel, ce qui ne remet pas en cause l'affichage.
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 5. Nom du produit : toujours « la BoxVision »
- **Constat** : le site écrit « Box Vision » en deux mots, et parfois sans article. Exemple : le H2 #titre-box-vision « Box Vision : le petit boîtier qui transforme n'importe quel écran ».
- **Demande** : quand on parle du produit, on dit toujours « la BoxVision ».
- **Ampleur** : 39 mentions sur 4 pages (accueil 16, solutions 19, contact 3, mentions légales 1), dont 21 « la Box Vision », 4 « une Box Vision » et plusieurs sans article (titres, puces, données structurées).
- **À appliquer partout** : textes visibles, titres, attributs alt, meta, données structurées (JSON-LD), FAQ.
- **Décisions de JP (10/11/2026)** :
  - orthographe : « BoxVision » en un mot, partout (y compris surtitres, alt, meta, JSON-LD) ;
  - toujours un article devant : « la BoxVision » de préférence, « une BoxVision » seulement quand le sens l'impose (par exemple « chaque écran a besoin d'une BoxVision ») ;
  - jamais « BoxVision » seul, même en début de titre : « La BoxVision : le petit boîtier qui transforme n'importe quel écran ».
- **Reste à trancher** : le décalage vertical entre l'étiquette « GR Vision » et le surtitre « LA BOX VISION » dans #box-vision (à ajouter comme correction de mise en page ?).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 6. Section BoxVision : ajouter la faible consommation électrique
- **Constat** : la présentation de la BoxVision (paragraphe d'introduction de #box-vision et liste des avantages) ne parle pas de sa consommation. Ni le site ni le kit n'en font mention.
- **Demande** : préciser qu'elle consomme très peu d'électricité.
- **Emplacement proposé** : une phrase dans le paragraphe d'introduction (« … jour et nuit, en consommant très peu d'électricité ») ou une carte de plus dans la liste des avantages.
- **Chiffre** : la BoxVision repose sur un Raspberry Pi 5. Ordres de grandeur publiés pour ce matériel : environ 3 W au repos, 5 à 7 W en lecture vidéo. En marche 24 h/24, cela fait environ 45 à 60 kWh par an, soit autour de 10 € d'électricité par an au tarif réglementé (environ 0,20 €/kWh).
- **Décision de JP (10/11/2026)** : l'estimation est validée, pas de mesure nécessaire. Formulation : « une dizaine d'euros d'électricité par an ». Ne jamais citer « Raspberry Pi » sur le site (décision de JP).
- **À reprendre aussi** sur la future page Affichage dynamique (voir point 2).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 7. Remplacer « Elle se met à jour toute seule » par un argument sécurité
- **Constat** : la carte « Elle se met à jour toute seule / À distance : aucune intervention de votre part » (index.html l. 282) laisse croire que GR met à jour les contenus (médias) du client. C'est faux.
- **Demande** : remplacer la carte par une mention sur la sécurité. Les BoxVision ne sont accessibles que depuis le réseau local, jamais depuis internet, ce qui est la configuration la plus sûre.
- **Autres passages qui parlent de mises à jour à distance** (même confusion, à reprendre) :
  - index.html l. 254 : « Les mises à jour de la box partent automatiquement à distance » ;
  - solutions.html l. 269 : carte « Mises à jour : la box se met à jour automatiquement à distance ». **Carte entière à supprimer** (confirmé par JP sur la démo) ;
  - solutions.html l. 315 : puce « Mises à jour automatiques à distance ».
- **Décision de JP (10/11/2026)** : on retire du site toute fonction qui ouvre la box vers l'extérieur. Pas de mises à jour à distance, pas de météo, pas d'actualités ni d'horaires automatiques.
  - supprimer les trois mentions de mises à jour à distance listées ci-dessus. Pour index.html l. 254, garder seulement l'échange de la box en cas de panne ;
  - index.html l. 320 : retirer « la météo, des actualités ou des horaires mis à jour automatiquement » et réécrire la carte autour de ce que le commerçant diffuse lui-même ;
  - vérifier que solutions.html, la FAQ et les données structurées ne promettent rien de ce genre.
- **Formulation** : préférer un fait vérifiable (« jamais exposée sur internet », « accessible uniquement depuis votre réseau local ») à un superlatif (« la plus sécurisée »).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 8. Nouvel encart : le commerçant reste maître de sa diffusion
- **Demande** : ajouter un encart clair. Le commerçant est et restera toujours le seul à décider de ce qui passe sur ses players et ses écrans. GR ne diffuse jamais de publicité tierce rémunérée sur les écrans de ses clients, contrairement à certains concurrents.
- **Existant** : une seule allusion discrète aujourd'hui (index.html l. 233 : « vous gardez la main sur vos messages »).
- **Emplacement proposé** : un encart visible dans la section BoxVision ou juste après la section Location, à reprendre sur la future page Affichage dynamique (point 2) et dans la FAQ.
- **Formulation** : parler d'un engagement de GR (« aucune publicité tierce, jamais ») sans viser nommément un concurrent.
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 9. Retirer la preuve « Déjà installé dans un hypermarché du Haut-Rhin »
- **Constat** : le badge p.proof de la section #pour-qui (accueil) affiche « Déjà installé dans un hypermarché du Haut-Rhin. ». JP le juge peu valorisant.
- **Demande** : retirer le badge.
- **Occurrences** : index.html l. 322 (section #pour-qui) et solutions.html l. 272. Retirer les deux.
- **À vérifier** : l'espacement au-dessus du bouton « Parler de mon projet » une fois le badge retiré.
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 11. Durée de la démonstration : 30 minutes au lieu de 15
- **Constat** : le H2 #titre-demo « Voyez vos futurs écrans en 15 minutes » et tous les textes associés annoncent une démo de 15 minutes. JP estime que ce n'est pas suffisant.
- **Demande** : passer à 30 minutes partout.
- **Occurrences (9)** :
  - index.html l. 399 : H2 « Voyez vos futurs écrans en 15 minutes » ;
  - index.html l. 400 : « Une démonstration de 15 minutes suffit… » ;
  - solutions.html l. 120 : FAQ dans les données structurées (JSON-LD) ;
  - solutions.html l. 440 : réponse de la FAQ visible ;
  - solutions.html l. 457 : bloc démonstration ;
  - contact.html l. 10 et 18 : meta description et og:description (« Démo 15 min. ») ;
  - contact.html l. 113 : introduction ;
  - contact.html l. 140 : « Démo de 15 minutes : … ».
- **Formulation** : remplacer « suffit pour voir » par une tournure plus juste, par exemple « Une démonstration de 30 minutes pour découvrir le logiciel et un modèle de contenu ».
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 12. Hiérarchie des offres : la BoxVision fait partie de GR Vision
- **Précision de JP** : GR Vision est l'offre d'affichage dynamique. La BoxVision n'est qu'un des éléments de cette offre (le player), à côté de la pose, du logiciel et de l'accompagnement.
- **Hiérarchie à respecter partout** :
  - GR Stratégie (l'agence) ;
  - GR Vision : affichage dynamique, avec la BoxVision, la pose et le logiciel ;
  - GR Connect : création web et réseaux sociaux ;
  - GR Ads : création print (voir la question en attente au point 2).
- **Exemple signalé** : carte « Affichage dynamique » de solutions.html (l. 228-229), texte « Box Vision, pose, logiciel simple. », qui met le produit au même niveau que l'offre. Proposition : « L'offre complète : la BoxVision, la pose et un logiciel simple pour diffuser vos contenus. »
- **Conséquences** :
  - présenter d'abord GR Vision (l'offre), puis la BoxVision comme composant ;
  - la future page Affichage dynamique porte le nom GR Vision. La BoxVision y a sa propre section ;
  - les nouvelles pages de service (point 2) peuvent s'aligner sur les sous-marques : GR Vision, GR Connect, GR Ads ;
  - le surtitre « LA BOX VISION » à côté de l'étiquette « GR Vision » (section #box-vision de l'accueil) prend son sens : GR Vision au-dessus, la BoxVision dessous. Le décalage d'alignement reste à traiter si JP le souhaite.
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 13. Écrans du client : un message simple, « notre solution s'y adapte »
- **Constat** : la carte « Écran » de solutions.html (l. 267) détaille des conditions techniques (« s'ils acceptent une prise vidéo standard (HDMI) et un affichage prolongé ») et contient un tiret cadratin.
- **Demande de JP** : « au choix dans notre catalogue, prix sur demande, ou vous gardez les vôtres, notre solution s'y adapte ».
- **Mise en forme proposée** (règle de ponctuation du point 10) : « Au choix dans notre catalogue, prix sur demande. Ou vous gardez les vôtres : notre solution s'y adapte. »
- **Autres passages au discours plus restrictif, à aligner** :
  - index.html l. 280 : « Il suffit d'une prise vidéo standard (HDMI). » ;
  - index.html l. 281 : « Nous vérifions qu'ils supportent un affichage prolongé et une luminosité suffisante. » ;
  - solutions.html l. 306 : « Ou réutilisation de vos écrans existants, après vérification » ;
  - solutions.html l. 80 (JSON-LD) et l. 420 (FAQ visible) : « Oui, si l'écran accepte une prise vidéo standard (HDMI) et répond aux contraintes d'usage… ».
- **Décision de JP (10/11/2026)** : on retire les conditions techniques (HDMI, luminosité, durée d'allumage, « après vérification ») des cartes et des puces. On garde seulement une version douce dans la FAQ (visible et JSON-LD) : « Oui, notre solution s'adapte à la plupart des écrans. Nous vérifions ensemble lors de l'étude de votre besoin. »
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 14. En cas de panne : présenter un remplacement sans prise de tête
- **Demande de JP** : faire passer la gestion des pannes pour ce qu'elle est, un remplacement simple et sans souci pour le client.
- **Formulations proposées** (sans point-virgule ni tiret cadratin) :
  - carte « En cas de panne » : titre « Remplacement sans souci », texte « Si la BoxVision tombe en panne, nous vous en envoyons une neuve. Vous la branchez, c'est reparti. » ;
  - FAQ : « Nous vous envoyons une BoxVision neuve, sans démarche compliquée. Vous la branchez à la place de l'ancienne et la diffusion reprend. »
- **Occurrences à reprendre (8)** :
  - index.html l. 254 : texte garantie (la partie mises à jour sort, voir point 7) ;
  - index.html l. 283 : carte « En cas de panne » ;
  - index.html l. 341 : carte « Fiable » (avec le point-virgule, voir point 10) ;
  - solutions.html l. 109-112 (JSON-LD) et l. 435-436 (FAQ visible) : « Pas de maintenance sur site ni de surveillance permanente. » est formulé en négatif, à remplacer par le message positif ci-dessus ;
  - solutions.html l. 270 : carte « En cas de panne » ;
  - solutions.html l. 316 : puce « Échange de la box en cas de panne ».
- **Confirmé par JP (10/11/2026)** : la BoxVision de remplacement part déjà configurée. Le dire : « Nous vous envoyons une BoxVision neuve, déjà configurée. Vous la branchez, c'est reparti. »
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

### 15. Plus de rubrique « Tarifs » à part : les prix vont dans chaque page de service
- **Constat** : le menu a une entrée « Tarifs » (lien /solutions#pricing, index.html l. 178, contact.html l. 95) qui ne concerne que GR Vision. Le bouton « Voir les formules » de l'accueil (l. 266) pointe au même endroit.
- **Demande de JP** : diluer les tarifs dans toutes les pages produits et services.
- **Répartition** :
  - GR Vision : bloc prix de la BoxVision (à partir de 35 € TTC/mois, variation selon durée et modèle de player, voir point 4), engagement 3 mois, achat possible, écran optionnel, ce qui est inclus ;
  - GR Connect (sites web) : « sur devis », avec ce qui fait varier le prix (WordPress ou sur mesure, hébergement, mails, maintenance optionnelle) ;
  - GR Connect (réseaux sociaux) : à définir avec les infos de JP ;
  - GR Ads : « sur devis », à la carte ou chaîne complète.
- **Conséquences** :
  - retirer « Tarifs » du menu et du pied de page sur toutes les pages ;
  - repointer « Voir les formules » vers la section prix de la page GR Vision ;
  - chaque page de service garde un bouton « Demander un devis » vers Contact.
- **À corriger dans le bloc prix actuel** (en le déplaçant) :
  - « Tarif de référence calculé sur 48 mois » : voir point 4 ;
  - « Mises à jour automatiques à distance » : à supprimer (point 7) ;
  - « Ou réutilisation de vos écrans existants, après vérification » : voir point 13 ;
  - paragraphe « flux automatiques (horaires, météo, actualités) » : à supprimer (point 7) ;
  - « Ce qui n'est pas inclus : Maintenance sur site ou surveillance permanente » : à reformuler en positif ou retirer (point 14).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

## Structure du site

### 2. Une page par service, avec l'accueil comme page qui les présente
- **Décision** : chaque service a sa propre page, optimisée pour sa recherche. L'accueil porte le positionnement d'agence, présente les trois services et renvoie vers chaque page.
- **Arborescence cible** :
  - Accueil : positionnement « agence de communication spécialisée dans les nouvelles technologies à Mulhouse » ;
  - Affichage dynamique : page principale, avec l'offre à 35 € TTC/mois et Box Vision (reprend l'actuelle page Solutions) ;
  - Community management (nouvelle page) ;
  - Création de sites web (nouvelle page) ;
  - Contact, mentions légales et confidentialité : inchangées.
- **Exigence** : chaque page de service doit avoir un vrai contenu, environ 600 à 1 000 mots utiles (démarche, ce qui est inclus, tarifs ou mode de devis, FAQ, exemples).
- **Conséquences** : menu, pied de page, sitemap.xml, maillage interne, redirection éventuelle de solutions.html vers la nouvelle adresse.
- **Sort de la page Solutions (précisé le 10/11/2026)** : la page disparaît en tant que page fourre-tout. Son contenu ne va pas dans l'accueil (qui n'en garde qu'un résumé), il est réparti dans les pages de service :
  - #signage, #pricing et la partie BoxVision de la FAQ vont dans la page Affichage dynamique ;
  - #web va dans la page Création de sites web ;
  - #social va dans la page Community management ;
  - #print (« Création print et habillages ») va dans une **page dédiée GR Ads** (décision de JP du 10/11/2026), voir ci-dessous ;
  - #faq est répartie entre les pages ; #demo devient un bloc commun en bas de chaque page.
  - solutions.html est redirigée en 301 vers la page Affichage dynamique (c'est elle qui porte aujourd'hui le contenu principal), via le .htaccess ; liens internes et sitemap.xml mis à jour.
- **Page GR Ads (print et achat d'espace)** :
  - création : flyers, affiches, supports d'affichage urbain (et l'existant : plaquettes, supports salon, kakemonos, bâches, panneaux, covering léger) ;
  - diffusion : GR peut gérer, en plus de la création, la diffusion et la réservation des espaces publicitaires (affichage urbain, affichage sur les bus, affichage dynamique sur des réseaux d'écrans, etc.) ;
  - message clé : un seul interlocuteur, de la création à la mise en place de la campagne ;
  - **vigilance rédactionnelle** : bien distinguer la réservation d'espaces publicitaires pour le compte du client (GR Ads) et l'engagement GR Vision du point 8 (aucune publicité tierce sur les écrans du client). Les deux ne se contredisent pas, mais le texte ne doit laisser aucune ambiguïté ;
  - **sources manquantes** : réseaux et supports avec lesquels GR travaille réellement (régies, bus de quelle ville, etc.), zones couvertes, exemples de campagnes, mode de tarification (devis).
- **Arborescence cible mise à jour** : Accueil, GR Vision (affichage dynamique), GR Connect web (création de sites), GR Connect réseaux sociaux (community management), GR Ads (print et achat d'espace), Contact, pages légales. À trancher plus tard : GR Connect en une page ou deux (web et réseaux sociaux séparés, plus efficace pour le SEO).
- **Contenus fournis par JP (10/11/2026)** :
  - **GR Connect, création de sites web**, deux formules :
    - site sous CMS moderne (WordPress), avec une formation courte, pour les clients qui veulent modifier leur site eux-mêmes ;
    - site sur mesure, ultra moderne, développé avec les technologies web actuelles (HTML, CSS, JavaScript, etc.) ;
    - services associés : hébergement et création d'adresses mail professionnelles ;
    - contrat de maintenance possible, non obligatoire ;
    - tarifs : sur devis ;
    - réalisations (sites vérifiés en ligne le 10/11/2026) : alventus.ch (Alventus), paulinekphotographie.com (Pauline Kupper photographie), deployercoaching.fr (Se Déployer Coaching). Prévoir une capture de chaque site et l'accord des clients si on cite leur nom.
  - **GR Ads** :
    - tous formats : flyers, affiches, affichage urbain, stands d'exposition ;
    - à la carte (une étape seule, par exemple la création graphique) ou toute la chaîne, de la création à la réservation des espaces ;
    - réseau : contacts chez les principaux prestataires en France ;
    - tarifs : sur devis.
  - **GR Connect, community management** (fourni par JP le 10/11/2026) :
    - gestion des réseaux sociaux au quotidien, y compris les réponses aux messages. Les réponses validées par le client sont gardées au fur et à mesure, ce qui rend GR de plus en plus autonome ;
    - **axe principal : le gain de temps**. Le client envoie ses photos quand il veut, GR rédige les textes et publie aux bons moments ;
    - rythme de publication au choix du client (chaque semaine, chaque mois, etc.) ;
    - respect des consignes du client ou de son siège : **compatible avec les franchises** ;
    - référence : un magasin leader en chiffre d'affaires au sein de son réseau de franchise national. **Ne pas citer Terranimo ni Sierentz** (demande de JP). Formulation possible : « Nous accompagnons déjà le premier magasin de son réseau de franchise en France. » ;
    - réseaux gérés : Facebook, Instagram, LinkedIn et fiche Google de l'établissement (Google Business Profile) ;
    - tarif : 200 € HT par mois, soit **à partir de 240 € TTC par mois** (TVA 20 %). Règle du site : tous les prix sont affichés en TTC (décision de JP du 10/11/2026).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

## Relecture finale (tout le site)

### 10. Relecture complète après les modifications, sans tirets cadratins ni points-virgules
- **Demande** : une fois toutes les corrections appliquées, relire l'ensemble du site. Retirer tous les tirets cadratins (—) et tous les points-virgules, et les remplacer par des points ou des virgules (en réécrivant la phrase si besoin).
- **Exemple signalé** : carte « Fiable » (accueil) « Des systèmes testés ; en cas de panne de la box, échange contre une neuve. » devient par exemple « Des systèmes testés. En cas de panne, la BoxVision est échangée contre une neuve. »
- **Ampleur actuelle** (textes visibles et données structurées) :
  - points-virgules : confidentialité 17, mentions légales 3, accueil 2 ;
  - tirets cadratins : contact 4, confidentialité 3, accueil 2, mentions légales 2, solutions 2 ;
  - demi-cadratins (–) : contact 2, dans « lun–ven · 9h–18h ». Proposition : « Du lundi au vendredi, de 9 h à 18 h ».
- **Périmètre** : textes visibles, titres de pages (title), meta descriptions, alt, données structurées, messages du formulaire et de l'API de contact.
- **Points à contrôler en même temps** :
  - application des règles BoxVision (point 5), y compris les « la box » isolés à remplacer par « la BoxVision » quand ils désignent le produit ;
  - plus aucune promesse de fonction ouverte sur internet (point 7) ;
  - orthographe, accords, cohérence des tarifs (point 4).
- **Statut** : fait le 10/11/2026 (voir PLAN-revue-corrections.md)

---

# Deuxième revue (10/11/2026, sur le site corrigé)

Liste seulement, rien n'est appliqué.

### 16. Zone d'activité : ne pas s'enfermer dans Mulhouse et le Haut-Rhin
- **Constat** : l'accueil (index.html l. 242) dit « GR Stratégie accompagne les commerces, PME et collectivités de Mulhouse et du Haut-Rhin ». La même formule revient en introduction de chaque page de service (affichage-dynamique l. 274, community-management l. 256, print-affichage-publicitaire l. 255…) et dans les données structurées (areaServed sur 5 pages). Au total, Mulhouse, Haut-Rhin, Alsace ou Grand Est apparaissent entre 9 et 21 fois par page.
- **Demande de JP** : à terme, GR pourra accompagner des professionnels de toute la France.
- **Recommandation SEO** : garder Mulhouse comme ancrage (c'est là que GR peut se classer vite, sur des recherches locales peu concurrentielles), mais formuler l'ouverture. Par exemple : « Basée à Mulhouse, GR Stratégie accompagne les commerces, PME et collectivités du Haut-Rhin et de toute la France. »
  - title, H1 et meta gardent « Mulhouse » (référencement local) ;
  - les textes disent « basés à Mulhouse » plutôt que « de Mulhouse » ;
  - areaServed : ajouter « France » à côté des zones locales.
- **Selon le service** :
  - GR Connect (sites web, réseaux sociaux) et GR Ads (création, réservation d'espaces) : se font à distance, l'ouverture nationale est naturelle ;
  - GR Vision : la pose est sur place. **À trancher par JP** : installation partout en France (déplacement, partenaire, ou BoxVision envoyée préconfigurée à brancher soi-même), ou pose limitée au Grand Est avec envoi ailleurs ?
- **À revoir aussi** : la mention « Alsace / Grand Est » des coordonnées de contact et la page contact.
- **Appliqué le 10/11/2026** :
  - accueil : « Basée à Mulhouse, GR Stratégie accompagne les commerces, PME et collectivités du Haut-Rhin et de toute la France. » ;
  - création de sites, community management, GR Ads : meta description et introduction ouvertes à toute la France, avec « basé à Mulhouse » ;
  - areaServed : « France » ajouté sur l'accueil et les trois pages ;
  - title et H1 gardent « Mulhouse » ;
  - la mention « Alsace / Grand Est » n'existait plus ;
  - tests : 153/153 au vert, JSON-LD valide, aucune erreur console.
- **Décision de JP pour GR Vision** : pose sur place dans le Haut-Rhin, BoxVision envoyée préconfigurée, prête à brancher, ailleurs en France. Appliqué :
  - affichage-dynamique.html : meta et og:description, introduction, carte « La pose », étape 02, areaServed avec France, nouvelle question de FAQ « Vous intervenez en dehors du Haut-Rhin ? » (visible et JSON-LD) ;
  - index.html : carte « La pose » et étape « On installe » alignées ;
  - tests 153/153 au vert, aucune erreur console.
- **Statut** : fait

### 17. Remplacer « sans compétences techniques » par une promesse de simplicité
- **Constat** : « sans compétences techniques » (accueil, section #gr-vision, et page GR Vision) peut se lire comme si la solution manquait de compétences.
- **Demande de JP** : un message inspiré de Steve Jobs. Toute la technologie est dans la solution pour simplifier la vie du client, et aucune formation n'est nécessaire.
- **Appliqué le 10/11/2026** :
  - index.html et affichage-dynamique.html : « Nous avons concentré toute la technologie dans notre solution pour vous simplifier la vie. Vos écrans affichent vos promotions, vos horaires et vos informations, et aucune formation n'est nécessaire. » ;
  - cohérence : les mentions « formation incluse » de GR Vision deviennent « prise en main guidée » (carte Accompagnement, liste « Ce qui est inclus ») et « Il est si intuitif que vous le prenez en main tout de suite » (carte Logiciel). Carte « Simple à utiliser » de l'accueil : « Un logiciel intuitif, aucune formation n'est nécessaire. » ;
  - la formation courte WordPress (GR Connect) est conservée, elle concerne un autre service ;
  - tests 153/153 au vert, rendu vérifié dans le navigateur.
- **Statut** : fait

### 18. Retirer « L'offre réunit la BoxVision, la pose, le logiciel et notre accompagnement. »
- **Demande de JP** : supprimer cette phrase de l'introduction de la section GR Vision de l'accueil (index.html l. 268). Les quatre cartes juste en dessous présentent déjà ces éléments.
- **Appliqué le 10/11/2026**, une seule occurrence sur le site. Tests 153/153 au vert.
- **Statut** : fait

### 19. Plus de pose : la BoxVision est toujours envoyée prête à brancher
- **Décision de JP** : GR ne pose pas l'écran, et ne se déplace plus pour poser la BoxVision. Le matériel est toujours envoyé configuré, prêt à brancher. Si le client le souhaite, GR trouve un installateur en sous-traitance, avec un coût en plus. Remplace la règle « pose dans le Haut-Rhin » du point 16.
- **Formule retenue** : « Prête à brancher » en promesse principale, puis l'option « Vous préférez ne rien toucher ? Un installateur partenaire s'en charge, sur devis. »
- **Appliqué le 10/11/2026** :
  - accueil et page GR Vision : carte « La pose » devenue « Prête à brancher », étape « On installe. » devenue « On vous l'envoie, prête à brancher. », introductions, JSON-LD et meta sans « la pose » ;
  - FAQ « Vous intervenez en dehors du Haut-Rhin ? » remplacée par « Qui installe la BoxVision ? » (visible et JSON-LD) ;
  - « 1 à 2 semaines entre l'étude, la pose et la mise en service » devient « entre l'étude de votre besoin et la réception de la BoxVision, prête à brancher » ;
  - accueil : « jusqu'à l'installation » devient « jusqu'à la mise en service », « Des installations maîtrisées » devient « Des équipements maîtrisés » ;
  - mentions légales : « la location et l'installation d'affichage dynamique » devient « la location de solutions d'affichage dynamique ».

### 20. La BoxVision n'est jamais vendue
- **Décision de JP** : la BoxVision est uniquement louée, jamais vendue.
- **Appliqué le 10/11/2026** :
  - « achat possible » retiré de l'accueil (bloc « Ce qui est compris »), de la page GR Vision (astérisque du prix, carte prix remplacée par « Aucun matériel à acheter », JSON-LD de l'offre) et de la page Contact (texte et option du formulaire, aussi dans api/contact/index.php) ;
  - FAQ « Peut-on acheter la BoxVision ? » : « Non. La BoxVision est proposée uniquement en location. C'est ce qui nous permet de vous envoyer une BoxVision neuve, déjà configurée, en cas de panne. »
- **Contrôles points 19 et 20** : tests 153/153 au vert, PHP sans erreur de syntaxe, rendu vérifié dans le navigateur, aucune erreur console.
- **Statut** : fait

### 21. Section « Comment fonctionne la location » : retirer « vous gardez la main sur vos messages »
- **Demande de JP** : l'introduction se termine sur « Nous l'envoyons prête à brancher. ». La maîtrise de la diffusion est déjà dite plus bas (encart « Vous restez seul maître de votre diffusion »).
- **Appliqué le 10/11/2026** sur l'accueil (l. 304) et, pour la même raison, sur la page GR Vision (l. 341). Tests 153/153 au vert.
- **Statut** : fait

### 22. Community management : remplacer la référence franchise par la discrétion
- **Constat** : « nous accompagnons déjà le premier magasin de son réseau de franchise en France » est ambigu (il s'agit du magasin n° 1 de sa franchise en chiffre d'affaires) et n'afficher qu'un client dessert GR.
- **Demande de JP** : retirer la référence et la remplacer par un argument : GR Stratégie ne communique jamais sur le fait qu'elle gère les réseaux de ses clients, qui ont l'impression que tout est géré en interne.
- **Appliqué le 10/11/2026** :
  - accueil (#services) : « En community management, la discrétion est totale : nous ne disons jamais que nous gérons vos réseaux. Pour vos clients, c'est vous qui publiez. » ;
  - page community management : nouvelle carte « Une discrétion totale », introduction de la section franchises sans la référence (« Et nous restons invisibles : pour vos clients, ce sont vos équipes qui publient. »), FAQ franchise sans la référence, nouvelle question « Vos clients sauront-ils que vous gérez nos réseaux ? » (visible et JSON-LD) ;
  - plus aucune mention du « premier magasin » sur le site.
- **Statut** : fait

### 23. Retirer l'emplacement photo « l'équipe ou les locaux »
- **Demande de JP** : aucune photo ne sera fournie pour la section « Nos engagements » de l'accueil.
- **Appliqué le 10/11/2026** : emplacement retiré, la section passe sur une seule colonne (classe split retirée). Rendu vérifié.
- **Reste sur le site** : 7 autres emplacements photo (BoxVision derrière un écran sur l'accueil et sur GR Vision, 4 cas d'usage sur l'accueil, exemple de publication sur community management). Décision de JP : on les garde, il fournira les photos. Ne retirer un emplacement que sur sa demande explicite.
- **Contrôles points 22 et 23** : tests 153/153 au vert, aucune erreur console.
- **Statut** : fait

### 24. Supprimer le contenu dupliqué entre l'accueil et la page GR Vision
- **Constat de JP** : trop de contenu identique, pénalisant pour le référencement.
- **Mesure avant** : 24 des 79 phrases de la page GR Vision étaient copiées mot pour mot sur l'accueil (4 sections entières : offre GR Vision, étapes de la location, encart « seul maître de votre diffusion », section BoxVision). Trois répétitions internes à la page GR Vision (installateur partenaire 3 fois, « jamais exposée sur internet » 2 fois, phrase de démo 2 fois).
- **Décision de JP** : le détail reste uniquement sur la page GR Vision. L'accueil n'a plus qu'un bloc GR Vision court, rédigé autrement.
- **Appliqué le 10/11/2026** :
  - accueil : les sections #gr-vision, #location, #diffusion et #boxvision sont remplacées par un seul bloc #gr-vision. Il contient l'introduction « toute la technologie… », 4 points reformulés (« Livrée prête à brancher », « Dès 35 € TTC par mois », « Fermée à internet », « Zéro publicité imposée »), les boutons « Découvrir GR Vision » et « Voir les tarifs », et l'emplacement photo de la BoxVision (conservé) ;
  - page GR Vision : nouvelle introduction du hero (« Toute la complexité est de notre côté. Du vôtre, il ne reste que vos messages… »), installateur partenaire cité seulement dans l'étape 02 et la FAQ (reformulée), FAQ sécurité et FAQ démo reformulées ;
  - copies avant modification gardées dans le dossier temporaire de la session (index.avant-dedup.html, ad.avant-dedup.html).
- **Mesure après** : 4 phrases communes sur 82. Ce sont l'emplacement photo (2), le bloc démo commun et les horaires, volontairement partagés. Aucune répétition interne.
- **Contrôles** : tests 153/153 au vert, rendu vérifié, aucune erreur console.
- **Statut** : fait

### 25. Réalisations (création de sites) : montrer un rendu de chaque site
- **Demande de JP** : un rendu de chaque site cité, en iframe ou en capture. Puis : pourquoi pas quelque chose de dynamique, un carrousel ?
- **Choix** : des captures plutôt qu'une iframe (une iframe charge le site entier du client, ralentit la page, dépend de ses réglages de sécurité et n'apporte rien au référencement). Pas de carrousel classique pour 3 éléments : il cache deux sites sur trois et se lit mal au clavier et au lecteur d'écran. À la place, deux effets légers sans JavaScript :
  - sur ordinateur, les 3 captures côte à côte dans un cadre de navigateur. Au survol (ou au focus clavier), la page du site défile lentement de haut en bas ;
  - sur mobile, les cartes se font glisser horizontalement, comme un carrousel.
  - désactivé si le visiteur a demandé moins d'animations (prefers-reduced-motion).
- **Appliqué le 10/11/2026** :
  - captures prises le 10/11/2026, sans bandeau cookies, dans site/assets/img/realisations/ (alventus.webp 35 Ko, paulinek.webp 97 Ko, deployer.webp 59 Ko, chargement différé) ;
  - styles .shot, .shot-frame, .shot-bar et .cards.shots dans site.css ;
  - carte Alventus complétée : « Le site d'une société suisse de conseil en solutions low-code. »
- **Contrôles** : tests 153/153 au vert, images chargées, rendu vérifié en 1280 px et en 375 px (pas de débordement horizontal de la page), aucune erreur console.
- **À refaire** quand un client change son site : nouvelle capture.
- **Statut** : fait

### 26. Réalisations : retirer « Nos clients ont accepté que nous les citions »
- **Constat de JP** : la phrase n'intéresse pas le visiteur.
- **Appliqué le 10/11/2026** : l'introduction devient « Une société de conseil, une photographe, une coach : trois métiers, trois sites conçus à leur image. ». Tests 153/153 au vert.
- **Statut** : fait

### 27. Community management : limiter à 4 publications par semaine
- **Demande de JP** : encadrer le prix d'appel de 240 € TTC/mois. Texte validé : « Le community management à partir de 240 € TTC/mois* » et « *Jusqu'à 4 publications par semaine, au rythme de votre choix. Au-delà, sur devis. »
- **Appliqué le 10/11/2026** :
  - page community management : bloc prix du hero (avec astérisque), carte « Le rythme que vous choisissez », introduction de la section tarif, liste de l'offre (+ « Au-delà, sur devis »), FAQ rythme et FAQ prix (visibles et JSON-LD), description de l'offre JSON-LD ;
  - accueil : carte community management et JSON-LD de l'offre (« jusqu'à 4 publications par semaine »).
- **Contrôles** : tests 153/153 au vert, rendu vérifié, aucune erreur console.
- **Statut** : fait
