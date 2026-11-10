// Contrôles navigateur d'une page du site GR Stratégie (à exécuter dans la page, après chargement).
// À lancer à 375, 768 et 1280 px. Renvoie un objet { ok, echecs, details }.
(() => {
  const echecs = [];
  const res = performance.getEntriesByType('resource').map(e => e.name);
  const externes = res.filter(u => new URL(u).origin !== location.origin);
  if (externes.length) echecs.push('Requêtes externes : ' + externes.join(', '));

  const de = document.documentElement;
  if (de.scrollWidth > de.clientWidth) echecs.push(`Défilement horizontal : ${de.scrollWidth} > ${de.clientWidth}`);

  const cassees = [...document.images].filter(i => i.complete && !i.naturalWidth).map(i => i.src);
  if (cassees.length) echecs.push('Images cassées : ' + cassees.join(', '));

  // Cibles tactiles visibles < 44 px (liens dans un paragraphe exclus)
  const petites = [...document.querySelectorAll('a, button, input, select, textarea, summary')]
    .filter(el => {
      const r = el.getBoundingClientRect();
      if (!r.width || !r.height || getComputedStyle(el).visibility === 'hidden') return false;
      if (el.closest('p, li, address, .foot-links, .foot-addr') && el.tagName === 'A') return false;
      if (el.classList.contains('skip')) return false;
      // Case ou bouton radio : la cible réelle est le libellé associé (clic sur le label)
      if (el.tagName === 'INPUT' && /^(checkbox|radio)$/.test(el.type)) {
        const l = el.closest('label') || (el.id && document.querySelector(`label[for="${el.id}"]`));
        if (l) { const lr = l.getBoundingClientRect(); if (lr.height >= 44 || lr.width >= 44) return false; }
      }
      return r.height < 44 && r.width < 44;
    })
    .map(el => (el.className || el.tagName) + ' ' + Math.round(el.getBoundingClientRect().height) + 'px');
  if (petites.length) echecs.push('Cibles < 44 px : ' + petites.join(', '));

  // Texte blanc sur fond orange interdit
  const orange = [...document.querySelectorAll('.btn-p')].filter(b => getComputedStyle(b).color === 'rgb(255, 255, 255)');
  if (orange.length) echecs.push('Texte blanc sur orange : ' + orange.length);

  // Polices locales chargées
  const familles = new Set([...document.fonts].filter(f => f.status === 'loaded').map(f => f.family.replace(/"/g, '')));
  ['Inter', 'Plus Jakarta Sans'].forEach(f => { if (!familles.has(f)) echecs.push('Police non chargée : ' + f); });

  return { ok: echecs.length === 0, largeur: innerWidth, echecs, ressources: res.length };
})();
