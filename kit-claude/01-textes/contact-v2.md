# Contact grstrategie.fr — proposition de textes v2

> Brouillon non publié. Aligné sur `accueil-v2.md`, `solutions-v1.md` et `confidentialite-v2.md`.
> Nom produit : **Box Vision** (féminin). Alterner avec « le boîtier » / « la box ». Ne pas utiliser l’ancien libellé produit (jugé daté).
> Aucun numéro de téléphone GR affiché sur le site : contact par e-mail ou formulaire.
> Site cible : **HTML / CSS / JS pur** (pas WordPress). Fonctionnement backend du formulaire : à brancher par le développeur ; ce document décrit textes, champs et comportement attendu côté interface.
> La v1 est archivée dans `/workspace/grs/archive/contact-v1.md`.

---

## Balises SEO

- **Méta-title (48 car.)** : Contactez GR Stratégie à Mulhouse | Démo & devis
- **Méta-description (119 car.)** : Parlez-nous de votre projet à Mulhouse : Box Vision dès 35 € TTC/mois, site web, print ou réseaux sociaux. Démo 15 min.

*(Distinct des métas accueil / solutions : ici l’angle est la prise de contact et la démo.)*

---

## Section 1 — En-tête

**H1 : Contactez GR Stratégie**

Dites-nous en quelques mots votre besoin. Nous revenons vers vous rapidement. Une démo de 15 minutes est possible, sur place ou en visio, au choix. Vous pouvez aussi demander à être rappelé(e) via le formulaire.

---

## Section 2 — Coordonnées

**H2 : Nos coordonnées**

GR Stratégie  
26 rue Victor Schoelcher  
68200 Mulhouse  

- E-mail : contact@grstrategie.fr  
- Horaires : lun–ven · 9h–18h · Alsace / Grand Est  
- Lien carte : https://maps.google.com/?q=26+rue+Victor+Schoelcher+68200+Mulhouse (« Nous trouver »)

*(Pas de numéro de téléphone affiché. Pour un rappel : case dédiée dans le formulaire.)*

**Pourquoi nous écrire ?**
- Affichage dynamique : location ou achat de la Box Vision dès 35 € TTC/mois, écran du catalogue si besoin
- Site web, print ou réseaux sociaux
- Démo de 15 minutes : logiciel et modèle de contenu, sur place ou en visio
- Demander à être rappelé(e) sur le créneau qui vous convient

**Boutons utiles (hors formulaire) :**
- « Réserver une démo » → ancre formulaire `#formulaire` (ou rester sur la page)
- « Demander à être rappelé » → ancre formulaire `#formulaire` (prépare l’usage de la case rappel)

---

## Section 3 — Formulaire

**H2 : Parlez-nous de votre projet**  
**H3 : Formulaire de contact** `<form id="formulaire" …>`

> Conserver un envoi `method="post"` vers l’endpoint que le développeur mettra en place (ex. `/api/contact`). Ne pas inventer ici l’implémentation serveur.

### Champs

| # | Champ | name / id | Statut | Obligatoire | Libellé | Texte d’aide / placeholder | Options / remarques |
|---|---|---|---|---|---|---|---|
| 1 | Nom / Entreprise | `nom` | Existant | Oui | Nom / Entreprise | Ex. Marie Dupont, Hôtel des Vosges | — |
| 2 | E-mail | `email` | Existant | Oui | E-mail | vous@exemple.fr | — |
| 3 | Sujet | `sujet` | Existant (options MAJ) | Oui | Sujet | — | Voir liste |
| 4 | Format de démo | `demo_format` | Nouveau (déjà prévu v1) | Non | Format de démo (si vous en souhaitez une) | — | Sur place / En visio / Pas pour le moment |
| 5 | Message | `message` | Existant | Oui | Message | Décrivez votre contexte, le nombre d’écrans envisagé, vos objectifs | — |
| 6 | Délai souhaité | `delai` | Existant (options corrigées) | Non | Délai souhaité (optionnel) | — | Indifférent / Cette semaine / Ce mois-ci / Ce trimestre |
| 7 | Je préfère être rappelé(e) | `rappel` | **Nouveau** (remplace le `tel` toujours visible) | Non | Je préfère être rappelé(e) | — | `type="checkbox"` |
| 8 | Téléphone | `tel` | **Conditionnel** (existant, plus toujours visible) | **Oui si `rappel` coché**, sinon absent | Téléphone | +33 6 12 34 56 78 | Affiché seulement si rappel coché |
| 9 | Créneau de rappel | `creneau` | **Nouveau** | **Oui si `rappel` coché**, sinon absent | Créneau souhaité | — | Radio : `matin` = Matin · `apres_midi` = Après-midi |
| 10 | Consentement RGPD | `rgpd` | Existant (texte MAJ) | Oui | Case à cocher | Voir texte ci-dessous | — |

**Boutons**  
- « Envoyer » (`type="submit"`)  
- « Effacer » (`type="reset"`) — conserver si utile ; au reset, masquer à nouveau tel/créneau

### Options du sujet (`sujet`)

1. — Choisir —  
2. Affichage dynamique (location ou achat)  
3. Écran du catalogue  
4. Site web  
5. Print  
6. Réseaux sociaux  
7. Autre  

### Options du délai (`delai`)

1. — Indifférent —  
2. Cette semaine  
3. Ce mois-ci  
4. Ce trimestre  

### Texte de la case RGPD

> J’accepte que GR Stratégie me contacte au sujet de ma demande. Vos données ne servent qu’à vous répondre. Un numéro de téléphone n’est demandé que si vous souhaitez être rappelé(e).

Lien : « politique de confidentialité » → `/confidentialite`.

### Message de succès

> Merci ! Votre demande a bien été envoyée.

### Message d’erreur

> Oups, une erreur est survenue. Réessayez, ou écrivez-nous à contact@grstrategie.fr.

---

## Note pour le développeur (HTML / CSS / JS pur)

Le site sera refait en **HTML, CSS et JavaScript** (pas WordPress). Cette note décrit le **comportement attendu** ; elle n’impose ni framework, ni langage serveur.

### Comportement de la case « Je préfère être rappelé(e) » (`rappel`)

1. **Par défaut** (`rappel` décochée) :
   - les champs `tel` et `creneau` sont **masqués** (ex. conteneur `#rappel-fields` avec `hidden` ou classe CSS) ;
   - ils n’ont **pas** l’attribut `required` ;
   - leurs valeurs sont **vidées** ;
   - ils **ne doivent pas être envoyés** (désactiver les contrôles avec `disabled`, ou les retirer du DOM, ou les omettre côté sérialisation — au choix, du moment que le POST ne les contient pas).

2. **Quand `rappel` est cochée** :
   - afficher `#rappel-fields` ;
   - rendre `tel` et `creneau` **obligatoires** (`required`) ;
   - placer le focus sur le champ téléphone ;
   - mettre à jour l’accessibilité : `aria-expanded="true"` sur la case (ou le bouton qui contrôle le panneau), `aria-controls="rappel-fields"` ; labels visibles associés (`for` / `id`).

3. **Quand `rappel` est décochée à nouveau** :
   - masquer le panneau ;
   - retirer `required` ;
   - vider `tel` et `creneau` (décocher les radios) ;
   - `aria-expanded="false"` ;
   - ne plus envoyer ces champs.

4. **Validation** :
   - côté navigateur : `required` dynamique + format téléphone FR raisonnable (ex. accepter `0X XX XX XX XX`, `+33…` ; message d’erreur clair) ;
   - **côté serveur aussi** : si `rappel` est présent/vrai, exiger `tel` et `creneau` non vides et un `tel` plausible ; si `rappel` absent, ignorer / refuser d’enregistrer un téléphone collé autrement.

5. **Créneau** : radios mutuellement exclusives, name=`creneau`, valeurs `matin` / `apres_midi`. **Obligatoire dès que le rappel est demandé** (choix retenu pour ce brief).

6. **Reset du formulaire** : revenir à l’état masqué (équivalent décoché).

7. **Endpoint** : brancher l’envoi selon l’architecture choisie (script serveur, service d’e-mail, etc.). Le HTML actuel pointait vers `/api/contact` (404) : à réparer ou remplacer, sans contrainte imposée ici.

### Tableau des changements de champs (pour intégration)

| Action | Champ | Détail |
|---|---|---|
| Conserver | `nom`, `email`, `sujet`, `message`, `delai`, `rgpd`, Envoyer / Effacer | Libellés ci-dessus |
| Conserver / MAJ | `demo_format` | Sur place / En visio / Pas pour le moment |
| **Retirer de l’affichage permanent** | `tel` | N’apparaît plus en champ libre optionnel permanent |
| **Ajouter** | `rappel` | Case « Je préfère être rappelé(e) », facultative |
| **Conditionnel** | `tel` | Visible + obligatoire seulement si `rappel` coché |
| **Ajouter** | `creneau` | Radio Matin / Après-midi, obligatoire si `rappel` coché |
| MAJ texte | `rgpd` | Précise que le téléphone n’est demandé que pour un rappel · lien `/confidentialite` |
| Remplacer | message d’erreur | Uniquement `contact@grstrategie.fr` (pas de téléphone GR) |

---

## Points restants à valider
1. Publier `/confidentialite` et lier formulaire + pied de page.
2. Brancher l’endpoint d’envoi du formulaire (HTML/CSS/JS + serveur au choix du développeur).

## Éléments retirés vs contact-v1
- Affichage d’un numéro de téléphone GR dans les coordonnées et le message d’erreur
- Champ `tel` toujours visible / optionnel en permanence
- Renvoi d’erreur vers un téléphone
