/* ============================================================
   PUNTO — main.js
   Orchestrator: loads translations, renders dynamic sections,
   wires navigation and the contact form. Re-renders on language
   change via I18n.onChange.
   ============================================================ */

(function () {
  'use strict';

  var t = function (key) { return window.I18n.t(key); };

  /* ---------- Dynamic renderers ---------- */

  var DESIGN_KEYS = ['spark', 'amplify', 'dominate'];

  function renderDesignPackages() {
    var grid = document.getElementById('design-packages');
    if (!grid) return;
    grid.innerHTML = '';

    DESIGN_KEYS.forEach(function (key) {
      var p = t('packages.' + key);
      if (!p || typeof p !== 'object') return;

      var card = document.createElement('article');
      card.className = 'package-card' + (key === 'amplify' ? ' featured' : '');

      var html = '';
      if (p.tag) html += '<span class="package-tag">' + esc(p.tag) + '</span>';
      html += '<h3 class="package-name">' + esc(p.name) + '</h3>';
      html += '<p class="price package-price mono">' + esc(p.price) + '</p>';
      html += '<div class="package-meta">'
            + '<span>' + esc(p.delivery) + '</span>'
            + '<span>' + esc(p.revisions) + '</span>'
            + '</div>';
      html += '<p class="package-desc">' + esc(p.desc) + '</p>';

      if (Array.isArray(p.features)) {
        html += '<ul class="package-features">';
        p.features.forEach(function (f) { html += '<li>' + esc(f) + '</li>'; });
        html += '</ul>';
      }
      // WOOCOMMERCE TODO: to sell packages through WooCommerce, replace the
      // href below with a per-package add-to-cart / product URL, e.g.
      //   var href = { spark: '/?add-to-cart=101', amplify: '/?add-to-cart=102', dominate: '/?add-to-cart=103' }[key] || '#contact';
      // then use `href` in place of '#contact'. Leave as '#contact' until
      // the products exist. (See front-page.php — "WOOCOMMERCE TODO".)
      html += '<a href="#contact" class="btn btn-primary">' + esc(t('design.cta')) + '</a>';

      card.innerHTML = html;
      grid.appendChild(card);
    });
  }

  function renderPricingTable() {
    var body = document.getElementById('pricing-table-body');
    if (!body) return;
    body.innerHTML = '';

    // Design group header
    appendGroupRow(body, t('pricing.groups.design'));
    DESIGN_KEYS.forEach(function (key) {
      var p = t('packages.' + key);
      appendRow(body, p.name, p.price, p.delivery, p.revisions);
    });

    // Social group header
    appendGroupRow(body, t('pricing.groups.social'));
    ['kit', 'graphics', 'reels'].forEach(function (key) {
      var r = t('pricing.rows.' + key);
      if (r && typeof r === 'object') appendRow(body, r.name, r.price, r.delivery, r.revisions);
    });
  }

  function appendGroupRow(body, label) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td class="pt-group" colspan="4">' + esc(label) + '</td>';
    body.appendChild(tr);
  }

  function appendRow(body, name, price, delivery, revisions) {
    var tr = document.createElement('tr');
    tr.innerHTML =
      '<td class="pt-name">' + esc(name) + '</td>' +
      '<td class="pt-price">' + esc(price) + '</td>' +
      '<td>' + esc(delivery) + '</td>' +
      '<td>' + esc(revisions) + '</td>';
    body.appendChild(tr);
  }

  function renderProcess() {
    var list = document.getElementById('process-steps');
    if (!list) return;
    var steps = t('process.steps');
    if (!Array.isArray(steps)) return;
    list.innerHTML = '';
    steps.forEach(function (step, i) {
      var li = document.createElement('li');
      li.className = 'process-step';
      li.innerHTML =
        '<span class="process-num mono">0' + (i + 1) + '</span>' +
        '<h3>' + esc(step.title) + '</h3>' +
        '<p>' + esc(step.desc) + '</p>';
      list.appendChild(li);
    });
  }

  function renderPortfolio() {
    var grid = document.getElementById('portfolio-grid');
    if (!grid) return;
    var cases = t('portfolio.cases');
    if (!Array.isArray(cases)) return;
    var beforeLabel = t('portfolio.before');
    var afterLabel = t('portfolio.after');
    grid.innerHTML = '';

    cases.forEach(function (c) {
      var card = document.createElement('article');
      card.className = 'portfolio-card';
      card.innerHTML =
        '<div class="portfolio-media">' +
          '<div class="portfolio-half before">' + esc(beforeLabel) + '</div>' +
          '<div class="portfolio-half after"><span class="dot"></span>' + esc(afterLabel) + '</div>' +
        '</div>' +
        '<div class="portfolio-body">' +
          '<span class="portfolio-tag">' + esc(c.tag) + '</span>' +
          '<h3>' + esc(c.title) + '</h3>' +
          '<p>' + esc(c.desc) + '</p>' +
          '<p class="portfolio-result">→ ' + esc(c.result) + '</p>' +
        '</div>';
      grid.appendChild(card);
    });
  }

  function renderAll() {
    renderDesignPackages();
    renderPricingTable();
    renderProcess();
    renderPortfolio();
    if (window.Pricing) window.Pricing.refresh();
  }

  /* ---------- Small HTML escape helper ---------- */
  function esc(str) {
    if (str == null) return '';
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  /* ---------- Navigation ---------- */
  function initNav() {
    var toggle = document.querySelector('.nav-toggle');
    var mobileNav = document.getElementById('mobile-nav');
    if (toggle && mobileNav) {
      toggle.addEventListener('click', function () {
        var open = mobileNav.classList.toggle('open');
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
      mobileNav.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
          mobileNav.classList.remove('open');
          toggle.setAttribute('aria-expanded', 'false');
        });
      });
    }
  }

  /* ---------- Contact form (mailto fallback, no backend in Phase 1) ---------- */
  function initForm() {
    var form = document.getElementById('contact-form');
    var status = document.getElementById('form-status');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var data = new FormData(form);
      var name = (data.get('name') || '').toString().trim();
      var email = (data.get('email') || '').toString().trim();
      var message = (data.get('message') || '').toString().trim();
      var service = (data.get('service') || '').toString();

      if (!name || !email || !message) {
        status.textContent = t('contact.form.error');
        status.className = 'form-status err';
        return;
      }

      var subject = 'Punto enquiry — ' + service;
      var body = 'Name: ' + name + '\nEmail: ' + email + '\nService: ' + service + '\n\n' + message;
      var mailto = 'mailto:hello@punto.design?subject=' +
        encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);

      window.location.href = mailto;
      status.textContent = t('contact.form.success');
      status.className = 'form-status ok';
      form.reset();
    });
  }

  /* ---------- Footer year ---------- */
  function initYear() {
    var el = document.getElementById('year');
    if (el) el.textContent = new Date().getFullYear();
  }

  /* ---------- Boot ---------- */
  document.addEventListener('DOMContentLoaded', function () {
    initNav();
    initForm();
    initYear();
    window.I18n.bindToggle();

    // Re-render dynamic content whenever language changes
    window.I18n.onChange(function () {
      renderAll();
    });

    window.I18n.load()
      .then(function () {
        window.I18n.setLanguage(window.I18n.getLang()); // applies static text + fires onChange (renders)
        if (window.Pricing) window.Pricing.initSliders();
      })
      .catch(function () {
        // Translations failed to load (e.g. opened via file:// without a server)
        var main = document.getElementById('main');
        if (main) {
          var note = document.createElement('p');
          note.className = 'mono';
          note.style.cssText = 'padding:1rem 24px;color:#E4002B;';
          note.textContent = 'Content requires a local server. Run: python3 -m http.server';
          main.prepend(note);
        }
        if (window.Pricing) window.Pricing.initSliders();
      });
  });
})();
