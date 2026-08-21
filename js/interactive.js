/* ============================================================
   PUNTO — interactive.js
   Mouse-tracking red dot, hero grid glow, card hover states.
   Disabled on touch / small screens and when the user prefers
   reduced motion.
   ============================================================ */

(function () {
  'use strict';

  var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var isTouch = window.matchMedia('(hover: none)').matches || 'ontouchstart' in window;
  var isSmall = window.innerWidth < 768;

  var enableEffects = !prefersReduced && !isTouch && !isSmall;

  /* ---------- 1. Mouse-tracking red dot ---------- */
  function initMouseDot() {
    var dot = document.createElement('div');
    dot.className = 'mouse-dot';
    document.body.appendChild(dot);
    document.body.classList.add('has-mouse-dot');

    var x = window.innerWidth / 2;
    var y = window.innerHeight / 2;
    var raf = null;

    function render() {
      dot.style.transform = 'translate(' + x + 'px, ' + y + 'px) translate(-50%, -50%)';
      raf = null;
    }

    document.addEventListener('mousemove', function (e) {
      x = e.clientX;
      y = e.clientY;
      if (raf == null) raf = requestAnimationFrame(render);
    });

    // Enlarge over interactive elements
    var interactiveSel = 'a, button, input, select, textarea, .package-card, .calc-card, .portfolio-card';
    document.addEventListener('mouseover', function (e) {
      if (e.target.closest(interactiveSel)) dot.classList.add('hovering');
    });
    document.addEventListener('mouseout', function (e) {
      if (e.target.closest(interactiveSel)) dot.classList.remove('hovering');
    });

    // Hide when the cursor leaves the window
    document.addEventListener('mouseleave', function () { dot.style.opacity = '0'; });
    document.addEventListener('mouseenter', function () { dot.style.opacity = ''; });
  }

  /* ---------- 2. Hero grid glow ---------- */
  function initGridGlow() {
    var hero = document.querySelector('.hero');
    if (!hero) return;

    hero.addEventListener('mousemove', function (e) {
      var rect = hero.getBoundingClientRect();
      var px = ((e.clientX - rect.left) / rect.width) * 100;
      var py = ((e.clientY - rect.top) / rect.height) * 100;
      hero.style.setProperty('--mouse-x', px + '%');
      hero.style.setProperty('--mouse-y', py + '%');
    });

    hero.addEventListener('mouseleave', function () {
      hero.style.setProperty('--mouse-x', '50%');
      hero.style.setProperty('--mouse-y', '50%');
    });
  }

  /* ---------- Boot ---------- */
  document.addEventListener('DOMContentLoaded', function () {
    if (!enableEffects) return;
    initMouseDot();
    initGridGlow();
  });
})();
