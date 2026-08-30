<?php
/**
 * Footer: the footer markup, wp_footer() and closing tags.
 *
 * @package Punto
 */

?>
	<!-- ===================== FOOTER ===================== -->
	<footer class="site-footer">
		<div class="container footer-inner">
			<div class="footer-brand">
				<span class="brand-dot" aria-hidden="true"></span>
				<span class="brand-name">Punto</span>
				<p class="footer-tag mono" data-i18n="hero.tagline">Fixed price. Fixed scope. No surprises.</p>
			</div>
			<nav class="footer-nav" aria-label="Footer">
				<a href="#design" data-i18n="navbar.design">Design</a>
				<a href="#social" data-i18n="navbar.social">Social Media</a>
				<a href="#pricing" data-i18n="navbar.pricing">Pricing</a>
				<a href="#process" data-i18n="navbar.process">Process</a>
				<a href="#portfolio" data-i18n="navbar.portfolio">Portfolio</a>
				<a href="#contact" data-i18n="navbar.contact">Contact</a>
			</nav>
			<div class="footer-legal">
				<a href="#" data-i18n="footer.privacy">Privacy</a>
				<a href="#" data-i18n="footer.terms">Terms</a>
				<a href="#" data-i18n="footer.cookies">Cookies</a>
				<p class="footer-copy mono">&copy; <span id="year">2026</span> Punto &middot; punto.design</p>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
