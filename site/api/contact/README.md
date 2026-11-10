# Script d'envoi du formulaire de contact

`index.php` reçoit le formulaire de `/contact` (POST vers `/api/contact/`) et envoie un e-mail via `mail()`. PHP 8.4, sans dépendance. Aucune donnée personnelle n'est conservée sur le serveur.

## Configuration

En tête de `index.php` :

- `MAIL_TO` : destinataire des demandes (`contact@grstrategie.fr`).
- `MAIL_FROM` : expéditeur, **obligatoirement une adresse du domaine** (exigence IONOS). La réponse va au visiteur grâce à l'en-tête `Reply-To`.
- `RATE_MAX` / `RATE_WINDOW` : 5 envois par IP par 10 minutes.

Anti-abus : le compteur (empreinte sha256 salée de l'IP + heure, purgé après 10 min) est stocké dans `gr-contact-data/`, un niveau **au-dessus** de la racine web ; à défaut, dans le dossier temporaire du serveur. Variable d'environnement facultative `GR_CONTACT_DATA_DIR` pour forcer un autre dossier. Le script y dépose un `.htaccess` « Require all denied » et restreint les droits (dossier 0700, fichiers 0600). Seule `REMOTE_ADDR` est prise en compte (`X-Forwarded-For` ignoré) ; IPv6 regroupée par /64. Requête limitée à 64 Ko, sans fichier joint.

Le `.htaccess` n'autorise que `index.php` dans ce dossier. Ce README n'a pas besoin d'être téléversé.

## Réponses

- `Accept: application/json` (envoi JS) : 200 `{"ok":true}` ; 422 `{"ok":false,"errors":{"champ":"required|invalid|too_long"}}` ; 400 / 405 / 429 / 500 `{"ok":false}`.
- Sans JS : redirection 303 vers `/contact?envoi=ok#envoi-ok` ou `/contact?envoi=erreur#envoi-erreur`.

## Test local

```sh
cd "Nouveau Site GR Stratégie"
GR_CONTACT_DRY_RUN=1 php -S 127.0.0.1:8766 -t site
```

`GR_CONTACT_DRY_RUN=1` n'envoie rien : le mail composé est écrit dans `$TMPDIR/gr-contact-dry-run/*.eml`. **Ne jamais activer ce mode en production.** (Il n'est de toute façon pris en compte qu'avec le serveur intégré `php -S`.)

```sh
curl -i -H 'Accept: application/json' \
  -F nom='Marie Dupont' -F email='marie@exemple.fr' -F sujet=affichage \
  -F message='Bonjour' -F rgpd=oui http://127.0.0.1:8766/api/contact/
```
