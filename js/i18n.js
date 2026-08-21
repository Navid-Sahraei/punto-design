/* ============================================================
   PUNTO — i18n.js
   Language system (EN default + IT toggle).
   Loads translations from data/*.json, persists choice,
   applies static [data-i18n] text and notifies subscribers
   so dynamic sections can re-render.
   ============================================================ */

(function () {
  'use strict';

  var SUPPORTED = ['en', 'it'];
  var STORAGE_KEY = 'puntoLang';

  var translations = {}; // { en: {...}, it: {...} }
  var currentLang = localStorage.getItem(STORAGE_KEY) || 'en';
  if (SUPPORTED.indexOf(currentLang) === -1) currentLang = 'en';

  var subscribers = []; // functions called on every language change

  /* ---- Load both language files ---- */
  function loadTranslations() {
    return Promise.all(
      SUPPORTED.map(function (lang) {
        return fetch('data/' + lang + '.json')
          .then(function (res) {
            if (!res.ok) throw new Error('Failed to load ' + lang);
            return res.json();
          })
          .then(function (json) { translations[lang] = json; });
      })
    );
  }

  /* ---- Translate a nested key: t('hero.heading') ---- */
  function t(key) {
    var dict = translations[currentLang];
    if (!dict) return key;
    var parts = key.split('.');
    var value = dict;
    for (var i = 0; i < parts.length; i++) {
      if (value == null) return key;
      value = value[parts[i]];
    }
    return value == null ? key : value;
  }

  /* ---- Apply text to all static [data-i18n] elements ---- */
  function applyStaticText() {
    document.querySelectorAll('[data-i18n]').forEach(function (el) {
      var value = t(el.getAttribute('data-i18n'));
      if (typeof value === 'string') el.textContent = value;
    });

    // Simple bullet lists rendered from arrays: [data-i18n-list]
    document.querySelectorAll('[data-i18n-list]').forEach(function (el) {
      var value = t(el.getAttribute('data-i18n-list'));
      if (!Array.isArray(value)) return;
      el.innerHTML = '';
      value.forEach(function (item) {
        var li = document.createElement('li');
        li.textContent = item;
        el.appendChild(li);
      });
    });
  }

  /* ---- Reflect active language on toggle buttons ---- */
  function updateToggleButtons() {
    document.querySelectorAll('.lang-btn').forEach(function (btn) {
      var active = btn.dataset.lang === currentLang;
      btn.classList.toggle('active', active);
      btn.setAttribute('aria-pressed', active ? 'true' : 'false');
    });
  }

  /* ---- Set language and notify everyone ---- */
  function setLanguage(lang) {
    if (SUPPORTED.indexOf(lang) === -1) lang = 'en';
    currentLang = lang;
    localStorage.setItem(STORAGE_KEY, lang);
    document.documentElement.lang = lang;

    applyStaticText();
    updateToggleButtons();

    subscribers.forEach(function (fn) {
      try { fn(lang); } catch (e) { /* keep other subscribers alive */ }
    });
  }

  /* ---- Register a callback for language changes (e.g. re-render cards) ---- */
  function onChange(fn) {
    if (typeof fn === 'function') subscribers.push(fn);
  }

  /* ---- Wire toggle buttons ---- */
  function bindToggle() {
    document.querySelectorAll('.lang-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        setLanguage(btn.dataset.lang);
      });
    });
  }

  // Public API
  window.I18n = {
    load: loadTranslations,
    t: t,
    setLanguage: setLanguage,
    onChange: onChange,
    bindToggle: bindToggle,
    getLang: function () { return currentLang; }
  };
})();
