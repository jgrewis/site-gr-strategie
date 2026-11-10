// GR Stratégie : menu mobile (toutes les pages) + formulaire de contact (page Contact seulement)
(() => {
  const bar = document.querySelector('.bar');
  const btn = bar && bar.querySelector('.menu');
  if (!btn) return;
  const icon = btn.querySelector('use');
  const label = btn.querySelector('span');
  const desktop = window.matchMedia('(min-width: 1200px)');

  // Ouvre ou ferme le menu et synchronise bouton, icône et libellé
  const setOpen = (open) => {
    bar.classList.toggle('is-open', open);
    btn.setAttribute('aria-expanded', String(open));
    icon.setAttribute('href', open ? '#i-x' : '#i-menu');
    label.textContent = open ? 'Fermer' : 'Menu';
  };
  const isOpen = () => bar.classList.contains('is-open');

  btn.addEventListener('click', () => setOpen(!isOpen()));

  // Échap : ferme et rend le focus au bouton
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isOpen()) {
      setOpen(false);
      btn.focus();
    }
  });

  // Clic sur un lien du menu, ou en dehors de la barre : ferme
  document.addEventListener('click', (e) => {
    if (!isOpen()) return;
    if (e.target.closest('.nav a') || !bar.contains(e.target)) setOpen(false);
  });

  // Passage en affichage large : ferme
  desktop.addEventListener('change', (e) => {
    if (e.matches) setOpen(false);
  });
})();

// Formulaire de contact : validation, case « rappel », envoi en fetch (repli : POST classique sans JS)
(() => {
  const form = document.getElementById('formulaire');
  if (!form || form.tagName !== 'FORM') return;
  form.noValidate = true; // la validation native reste active sans JS

  const NBSP = ' ';
  const MSG = {
    nom: { required: 'Indiquez votre nom ou celui de votre entreprise.' },
    email: { required: 'Indiquez votre adresse e-mail.', invalid: 'Adresse e-mail non valide, par ex. vous@exemple.fr.' },
    sujet: { required: 'Choisissez un sujet.' },
    message: { required: 'Écrivez votre message.', too_long: 'Message trop long (5' + NBSP + '000 caractères maximum).' },
    'tel': { required: 'Indiquez un numéro pour vous rappeler.', invalid: 'Numéro de téléphone français attendu, par ex. 06 12 34 56 78.' },
    creneau: { required: 'Choisissez un créneau de rappel.' },
    rgpd: { required: 'Cochez cette case pour que nous puissions vous répondre.' }
  };
  const MSG_OK = 'Merci' + NBSP + '! Votre demande a bien été envoyée.';
  const MSG_ERR = 'Oups, une erreur est survenue. Réessayez, ou écrivez-nous à <a href="mailto:contact@grstrategie.fr">contact@grstrategie.fr</a>.';
  const TEL_RX = /^(?:(?:\+|00)33\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/;
  const EMAIL_RX = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

  const el = (name) => form.elements[name];
  const rappel = el('rappel');
  const panel = document.getElementById('rappel-fields');
  const tel = el('tel');
  const radios = Array.from(form.querySelectorAll('input[name="creneau"]'));
  const submit = form.querySelector('button[type="submit"]');
  const status = document.getElementById('form-status');
  const controls = (key) => (key === 'creneau' ? radios : [el(key)]);
  const value = (key) => el(key).value.trim();

  // Règles : renvoient le message d'erreur, ou '' si le champ est valide
  const rules = {
    nom: () => (value('nom') ? '' : MSG.nom.required),
    email: () => {
      const v = value('email');
      if (!v) return MSG.email.required;
      return EMAIL_RX.test(v) && v.length <= 254 ? '' : MSG.email.invalid;
    },
    sujet: () => (el('sujet').value ? '' : MSG.sujet.required),
    message: () => {
      const v = value('message');
      if (!v) return MSG.message.required;
      return v.length > 5000 ? MSG.message.too_long : '';
    },
    'tel': () => {
      if (!rappel.checked) return '';
      const v = value('tel');
      if (!v) return MSG.tel.required;
      return TEL_RX.test(v) ? '' : MSG.tel.invalid;
    },
    creneau: () => (rappel.checked && !radios.some((r) => r.checked) ? MSG.creneau.required : ''),
    rgpd: () => (el('rgpd').checked ? '' : MSG.rgpd.required)
  };

  // Affiche ou efface l'erreur d'un champ (aria-invalid + aria-describedby)
  const setError = (key, message) => {
    const box = document.getElementById(key + '-err');
    controls(key).forEach((c) => {
      if (c.dataset.desc === undefined) c.dataset.desc = c.getAttribute('aria-describedby') || '';
      if (message) {
        c.setAttribute('aria-invalid', 'true');
        c.setAttribute('aria-describedby', (c.dataset.desc + ' ' + box.id).trim());
      } else {
        c.removeAttribute('aria-invalid');
        if (c.dataset.desc) c.setAttribute('aria-describedby', c.dataset.desc);
        else c.removeAttribute('aria-describedby');
      }
    });
    box.querySelector('span').textContent = message;
    box.hidden = !message;
  };
  const clearErrors = () => Object.keys(rules).forEach((k) => setError(k, ''));

  // Valide tout le formulaire ; renvoie le premier contrôle en erreur
  const validate = () => {
    let first = null;
    Object.keys(rules).forEach((key) => {
      const message = rules[key]();
      setError(key, message);
      if (message && !first) first = controls(key)[0];
    });
    return first;
  };

  // Case « rappel » : panneau, required, disabled, valeurs vidées
  const setRappel = (on, focus) => {
    rappel.checked = on;
    rappel.setAttribute('aria-expanded', String(on));
    panel.hidden = !on;
    tel.disabled = !on;
    tel.required = on;
    radios.forEach((r) => { r.disabled = !on; r.required = on; });
    panel.querySelectorAll('.req').forEach((r) => { r.hidden = !on; });
    if (!on) {
      tel.value = '';
      radios.forEach((r) => { r.checked = false; });
      setError('tel', '');
      setError('creneau', '');
    } else if (focus) {
      tel.focus();
    }
  };

  const clearStatus = () => { status.textContent = ''; };
  const showStatus = (kind) => {
    status.textContent = '';
    const box = document.createElement('div');
    box.className = 'form-msg is-shown form-msg--' + (kind === 'ok' ? 'ok' : 'err');
    box.innerHTML = '<svg class="ic" aria-hidden="true" focusable="false"><use href="' + (kind === 'ok' ? '#i-check' : '#i-circle-alert') + '"/></svg><p></p>';
    box.querySelector('p').innerHTML = kind === 'ok' ? MSG_OK : MSG_ERR;
    status.appendChild(box);
    box.scrollIntoView({ block: 'nearest' });
  };

  const setBusy = (busy) => {
    submit.disabled = busy;
    form.setAttribute('aria-busy', String(busy));
  };

  // Initialisation
  rappel.setAttribute('aria-controls', 'rappel-fields');
  setRappel(rappel.checked, false);

  rappel.addEventListener('change', () => setRappel(rappel.checked, rappel.checked));

  // Bouton « Demander à être rappelé » de l'en-tête
  const headBtn = document.getElementById('btn-rappel');
  if (headBtn) {
    headBtn.addEventListener('click', (e) => {
      if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return;
      e.preventDefault();
      setRappel(true, true);
    });
  }

  // Correction en direct : un champ en erreur est revalidé dès qu'on le modifie
  const recheck = (e) => {
    const key = e.target.name;
    if (!rules[key]) return;
    const box = document.getElementById(key + '-err');
    if (box && !box.hidden) setError(key, rules[key]());
  };
  form.addEventListener('input', recheck);
  form.addEventListener('change', recheck);

  // Effacer : retour à l'état masqué
  form.addEventListener('reset', () => {
    clearStatus();
    setTimeout(() => {
      setRappel(false, false);
      clearErrors();
    }, 0);
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (submit.disabled) return;
    clearStatus();
    const invalid = validate();
    if (invalid) {
      invalid.focus();
      return;
    }
    setBusy(true);
    try {
      const res = await fetch(form.getAttribute('action'), {
        method: 'POST',
        body: new FormData(form),
        headers: { Accept: 'application/json' }
      });
      const data = await res.json().catch(() => null);
      if (res.ok && data && data.ok === true) {
        form.reset();
        showStatus('ok');
      } else if (res.status === 422 && data && data.errors) {
        // Erreurs de validation côté serveur : messages du client
        let first = null;
        let unknown = false;
        Object.keys(data.errors).forEach((key) => {
          const message = MSG[key] && (MSG[key][data.errors[key]] || MSG[key].required);
          if (message && document.getElementById(key + '-err')) {
            setError(key, message);
            if (!first) first = controls(key)[0];
          } else {
            unknown = true;
          }
        });
        if (first) first.focus();
        if (unknown || !first) showStatus('err');
      } else {
        showStatus('err');
      }
    } catch (err) {
      showStatus('err');
    } finally {
      setBusy(false);
      if (document.activeElement === document.body) submit.focus({ preventScroll: true });
    }
  });
})();
