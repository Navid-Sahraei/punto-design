<?php
/**
 * Footer: closes the main content, prints the site footer and wp_footer().
 *
 * Single bilingual page — Italian is server-rendered; i18n.js swaps text via
 * the data-i18n keys below.
 *
 * @package punto
 */
?>
</main>

<!-- ============ FOOTER ============ -->
<footer class="footer">
	<div class="footer__brand">Punto<span class="dot" aria-hidden="true"></span></div>
	<p class="footer__tag" data-i18n="footer.tag">Design &amp; social a prezzo fisso. Fatto a Padova.</p>
	<nav class="footer__links" aria-label="Link footer" data-i18n-aria-label="footer.navAria">
		<a href="#pacchetti" data-i18n="footer.packages">Pacchetti</a>
		<a href="#come-funziona" data-i18n="footer.how">Come funziona</a>
		<a href="#faq" data-i18n="footer.faq">FAQ</a>
		<a href="mailto:r.sahraei88@gmail.com">Email</a>
	</nav>
	<p class="footer__legal">&copy; <span id="year">2026</span> <span data-i18n="footer.legal">Punto Design &middot; P.IVA IT00000000000</span></p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
