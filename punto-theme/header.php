<?php
/**
 * Header: everything from <!DOCTYPE> through the site header / nav.
 *
 * @package Punto
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

	<!-- Skip link for accessibility -->
	<a href="#main" class="skip-link" data-i18n="a11y.skip"><?php esc_html_e( 'Skip to content', 'punto' ); ?></a>

	<!-- ===================== HEADER / NAV ===================== -->
	<header class="site-header" id="site-header">
		<div class="container header-inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="Punto home">
				<span class="brand-dot" aria-hidden="true"></span>
				<span class="brand-name">Punto</span>
			</a>

			<?php punto_primary_nav( 'main-nav' ); ?>

			<div class="header-actions">
				<div class="language-toggle" role="group" aria-label="Language">
					<button class="lang-btn" data-lang="en" aria-pressed="true">EN</button>
					<span class="divider" aria-hidden="true">|</span>
					<button class="lang-btn" data-lang="it" aria-pressed="false">IT</button>
				</div>
				<button class="nav-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-nav">
					<span></span><span></span><span></span>
				</button>
			</div>
		</div>

		<!-- Mobile nav (kept hard-coded so its markup stays identical to the static site) -->
		<nav class="mobile-nav" id="mobile-nav" aria-label="Mobile">
			<a href="#design" data-i18n="navbar.design">Design</a>
			<a href="#social" data-i18n="navbar.social">Social Media</a>
			<a href="#pricing" data-i18n="navbar.pricing">Pricing</a>
			<a href="#process" data-i18n="navbar.process">Process</a>
			<a href="#portfolio" data-i18n="navbar.portfolio">Portfolio</a>
			<a href="#contact" data-i18n="navbar.contact">Contact</a>
		</nav>
	</header>
