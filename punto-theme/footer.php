<?php
/**
 * Footer: closes the main content, prints the site footer and wp_footer().
 *
 * @package punto
 */

$punto_lang = punto_lang();
?>
</main>

<!-- ============ FOOTER ============ -->
<footer class="footer">
	<div class="footer__brand">Punto<span class="dot" aria-hidden="true"></span></div>

	<?php if ( 'en' === $punto_lang ) : ?>
		<p class="footer__tag">Design &amp; social at a fixed price. Made in Padua.</p>
		<nav class="footer__links" aria-label="Footer links">
			<a href="#packages">Packages</a>
			<a href="#how-it-works">How it works</a>
			<a href="#faq">FAQ</a>
			<a href="mailto:ciao@puntodesign.it">Email</a>
		</nav>
		<p class="footer__legal">&copy; <span id="year">2026</span> Punto Design &middot; VAT IT00000000000</p>
	<?php else : ?>
		<p class="footer__tag">Design &amp; social a prezzo fisso. Fatto a Padova.</p>
		<nav class="footer__links" aria-label="Link footer">
			<a href="#pacchetti">Pacchetti</a>
			<a href="#come-funziona">Come funziona</a>
			<a href="#faq">FAQ</a>
			<a href="mailto:ciao@puntodesign.it">Email</a>
		</nav>
		<p class="footer__legal">&copy; <span id="year">2026</span> Punto Design &middot; P.IVA IT00000000000</p>
	<?php endif; ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
