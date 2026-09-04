/**
 * Punto — client-side language toggle.
 *
 * Swaps on-page text in place (no navigation, no reload) between Italian and
 * English by fetching assets/data/it.json and assets/data/en.json. The base
 * URL is injected by functions.php via wp_localize_script as window.PUNTO.dataBase,
 * so it resolves to /wp-content/themes/<theme>/assets/data/.
 *
 * - Italian is the default and is what the server renders, so no fetch is needed
 *   on first load unless the visitor previously chose English.
 * - The chosen language is remembered in localStorage ("punto_lang").
 * - Elements carry data-i18n="dot.path" (innerHTML) or
 *   data-i18n-aria-label="dot.path" (aria-label attribute).
 */
(function () {
  'use strict';

  var CFG     = window.PUNTO || {};
  var BASE    = CFG.dataBase || '';
  var DEFAULT = CFG.defaultLang || 'it';
  var STORAGE = 'punto_lang';
  var cache   = {};

  // The toggle button always shows the language you'd switch TO.
  var TOGGLE_LABEL = { it: 'EN', en: 'IT' };
  var TOGGLE_ARIA  = { it: 'Switch to English', en: "Passa all'italiano" };

  function getStored() {
    try { return localStorage.getItem(STORAGE); } catch (e) { return null; }
  }
  function setStored(v) {
    try { localStorage.setItem(STORAGE, v); } catch (e) { /* private mode: ignore */ }
  }

  // Resolve a dotted key ("pkg.id.name") against the dictionary object.
  function resolve(dict, path) {
    return path.split('.').reduce(function (o, k) {
      return (o && o[k] != null) ? o[k] : null;
    }, dict);
  }

  function applyDict(dict) {
    if (!dict) return;

    document.querySelectorAll('[data-i18n]').forEach(function (el) {
      var v = resolve(dict, el.getAttribute('data-i18n'));
      if (v != null) { el.innerHTML = v; }
    });

    document.querySelectorAll('[data-i18n-aria-label]').forEach(function (el) {
      var v = resolve(dict, el.getAttribute('data-i18n-aria-label'));
      if (v != null) { el.setAttribute('aria-label', v); }
    });

    var meta = resolve(dict, 'meta');
    if (meta) {
      if (meta.title) { document.title = meta.title; }
      var md = document.querySelector('meta[name="description"]');
      if (md && meta.description) { md.setAttribute('content', meta.description); }
    }
  }

  function fetchDict(lang) {
    if (cache[lang]) { return Promise.resolve(cache[lang]); }
    return fetch(BASE + lang + '.json', { credentials: 'same-origin' })
      .then(function (r) {
        if (!r.ok) { throw new Error('HTTP ' + r.status); }
        return r.json();
      })
      .then(function (d) { cache[lang] = d; return d; });
  }

  function updateToggle(lang) {
    var btn = document.getElementById('langToggle');
    if (!btn) { return; }
    btn.textContent = TOGGLE_LABEL[lang] || TOGGLE_LABEL[DEFAULT];
    btn.setAttribute('aria-label', TOGGLE_ARIA[lang] || TOGGLE_ARIA[DEFAULT]);
  }

  // opts.force = fetch + apply even for the default language (used when the
  // visitor toggles back to Italian, so text is restored from it.json).
  function setLang(lang, opts) {
    opts = opts || {};
    document.documentElement.setAttribute('lang', lang);
    updateToggle(lang);
    setStored(lang);

    if (lang === DEFAULT && !opts.force) { return; }

    fetchDict(lang).then(applyDict).catch(function () {
      /* Network/JSON error: keep whatever text is on screen. */
    });
  }

  function init() {
    setLang(getStored() || DEFAULT);

    var btn = document.getElementById('langToggle');
    if (btn) {
      btn.addEventListener('click', function () {
        var cur  = document.documentElement.getAttribute('lang') || DEFAULT;
        var next = cur === 'en' ? 'it' : 'en';
        setLang(next, { force: true });
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
