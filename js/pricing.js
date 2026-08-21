/* ============================================================
   PUNTO — pricing.js
   Dynamic pricing calculator for scalable social packages.
   Exact tier prices interpolate linearly between tiers.
   ============================================================ */

(function () {
  'use strict';

  // Anchor tiers from the brief (quantity → { min, max } in €/month)
  var TABLES = {
    graphics: {
      4:  { min: 80,  max: 100 },
      8:  { min: 200, max: 240 },
      12: { min: 300, max: 360 }
    },
    reels: {
      1: { min: 120, max: 150 },
      2: { min: 220, max: 280 },
      4: { min: 400, max: 480 }
    }
  };

  // Per-unit add-on rate for quantities above the top tier
  var ADDON = { graphics: 22, reels: 95 };

  /* ---- Core: price for a given service + quantity ---- */
  function calculatePrice(service, quantity) {
    var table = TABLES[service];
    if (!table) return { min: 0, max: 0 };

    quantity = parseInt(quantity, 10);

    // Exact tier match
    if (table[quantity]) {
      return { min: table[quantity].min, max: table[quantity].max };
    }

    var tiers = Object.keys(table).map(Number).sort(function (a, b) { return a - b; });
    var lowest = tiers[0];
    var highest = tiers[tiers.length - 1];

    // Below the smallest tier — clamp to it
    if (quantity <= lowest) {
      return { min: table[lowest].min, max: table[lowest].max };
    }

    // Above the largest tier — extend with per-unit add-on rate
    if (quantity > highest) {
      var extra = quantity - highest;
      var rate = ADDON[service] || 0;
      return {
        min: table[highest].min + extra * rate,
        max: table[highest].max + extra * rate
      };
    }

    // Between two tiers — linear interpolation
    var lower = lowest, upper = highest;
    for (var i = 0; i < tiers.length - 1; i++) {
      if (quantity >= tiers[i] && quantity < tiers[i + 1]) {
        lower = tiers[i];
        upper = tiers[i + 1];
        break;
      }
    }
    var ratio = (quantity - lower) / (upper - lower);
    return {
      min: table[lower].min + (table[upper].min - table[lower].min) * ratio,
      max: table[lower].max + (table[upper].max - table[lower].max) * ratio
    };
  }

  /* ---- Format helpers ---- */
  function formatMonthly(price) {
    return '€' + Math.round(price.min) + '–' + Math.round(price.max) + '/month';
  }

  function formatPerUnit(price, quantity, label) {
    if (!quantity) return '';
    var per = { min: price.min / quantity, max: price.max / quantity };
    return '≈ €' + Math.round(per.min) + '–' + Math.round(per.max) + ' ' + label;
  }

  /* ---- Update the DOM for one service ---- */
  function updateDisplay(service, quantity) {
    var price = calculatePrice(service, quantity);

    var priceEl = document.querySelector('[data-price-display="' + service + '"]');
    if (priceEl) priceEl.textContent = formatMonthly(price);

    var qtyEl = document.querySelector('[data-qty-display="' + service + '"]');
    if (qtyEl) qtyEl.textContent = quantity;

    var perEl = document.querySelector('[data-price-per="' + service + '"]');
    if (perEl) {
      var label = (window.I18n && window.I18n.t('social.' + service + '.per')) || 'per unit';
      perEl.textContent = formatPerUnit(price, quantity, label);
    }
  }

  /* ---- Wire up sliders / number inputs ---- */
  function initSliders() {
    document.querySelectorAll('[data-pricing-input]').forEach(function (input) {
      var service = input.dataset.service;

      function handle() {
        var qty = parseInt(input.value, 10);
        input.setAttribute('aria-valuenow', qty);
        updateDisplay(service, qty);
      }

      input.addEventListener('input', handle);
      handle(); // set initial state
    });
  }

  // Public API
  window.Pricing = {
    calculate: calculatePrice,
    updateDisplay: updateDisplay,
    initSliders: initSliders,
    refresh: function () {
      // Re-run all displays (e.g. after a language change updates the "per unit" label)
      document.querySelectorAll('[data-pricing-input]').forEach(function (input) {
        updateDisplay(input.dataset.service, parseInt(input.value, 10));
      });
    }
  };
})();
