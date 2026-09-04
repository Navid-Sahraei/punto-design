<?php
/**
 * Header: <!DOCTYPE> through the opening of the main content.
 *
 * @package punto
 */

$punto_lang = punto_lang();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php if ( 'en' === $punto_lang ) : ?>
		<meta name="description" content="Design and social media studio at a fixed price. One package, one number, no surprises on the invoice. Punto." />
	<?php else : ?>
		<meta name="description" content="Studio di design e social media a prezzo fisso. Un pacchetto, un numero, nessuna sorpresa in fattura. Punto." />
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( 'en' === $punto_lang ) : ?>
	<a class="skip-link" href="#packages">Skip to packages</a>
<?php else : ?>
	<a class="skip-link" href="#pacchetti">Salta ai pacchetti</a>
<?php endif; ?>

<!-- ============ NAV ============ -->
<header class="nav" id="top">
	<a class="nav__brand" href="#top" aria-label="<?php echo 'en' === $punto_lang ? 'Punto — back to top' : 'Punto — torna su'; ?>">
		Punto<span class="dot" aria-hidden="true"></span>
	</a>

	<?php
	// Header navigation. Uses a menu assigned to the "primary" location if one
	// exists; otherwise falls back to the exact static anchor links so the
	// header looks identical before any menu is created.
	wp_nav_menu(
		array(
			'theme_location'       => 'primary',
			'container'            => 'nav',
			'container_class'      => 'nav__links',
			'container_aria_label' => ( 'en' === $punto_lang ? 'Main navigation' : 'Navigazione principale' ),
			'menu_class'           => 'nav__menu',
			'depth'                => 1,
			'fallback_cb'          => 'punto_primary_menu_fallback',
		)
	);
	?>

	<?php if ( 'en' === $punto_lang ) : ?>
		<a class="nav__lang" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Passa all'italiano">IT</a>
		<a class="btn btn--ink nav__cta" href="#book">Book a call</a>
	<?php else : ?>
		<a class="nav__lang" href="<?php echo esc_url( home_url( '/en/' ) ); ?>" aria-label="Switch to English">EN</a>
		<a class="btn btn--ink nav__cta" href="#prenota">Prenota una call</a>
	<?php endif; ?>
</header>

<main>
