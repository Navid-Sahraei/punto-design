<?php
/**
 * Header: <!DOCTYPE> through the opening of the main content.
 *
 * Single bilingual page: the server renders Italian (the default), and
 * assets/js/i18n.js swaps text in place when the visitor toggles the language.
 * Text nodes carry data-i18n keys; aria-labels carry data-i18n-aria-label.
 *
 * @package punto
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Studio di design e social media a prezzo fisso. Un pacchetto, un numero, nessuna sorpresa in fattura. Punto." />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#pacchetti" data-i18n="nav.skip">Salta ai pacchetti</a>

<!-- ============ NAV ============ -->
<header class="nav" id="top">
	<a class="nav__brand" href="#top" data-i18n-aria-label="nav.brandAria" aria-label="Punto — torna su">
		Punto<span class="dot" aria-hidden="true"></span>
	</a>

	<?php
	// Header navigation. Uses a menu assigned to the "primary" location if one
	// exists; otherwise falls back to the exact static anchor links (with
	// data-i18n keys) so the header looks identical and stays translatable.
	wp_nav_menu(
		array(
			'theme_location'       => 'primary',
			'container'            => 'nav',
			'container_class'      => 'nav__links',
			'container_aria_label' => 'Navigazione principale',
			'menu_class'           => 'nav__menu',
			'depth'                => 1,
			'fallback_cb'          => 'punto_primary_menu_fallback',
		)
	);
	?>

	<!-- Client-side language toggle (no navigation). i18n.js manages its label. -->
	<button class="nav__lang" type="button" id="langToggle" aria-label="Switch to English">EN</button>

	<a class="btn btn--ink nav__cta" href="#prenota" data-i18n="nav.cta">Prenota una call</a>
</header>

<main>
