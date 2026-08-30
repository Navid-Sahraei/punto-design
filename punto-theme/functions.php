<?php
/**
 * Punto theme functions.
 *
 * @package Punto
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

if ( ! defined( 'PUNTO_VERSION' ) ) {
	define( 'PUNTO_VERSION', '1.0.0' );
}

/**
 * Theme setup.
 */
function punto_setup() {
	// Let WordPress manage the document <title>.
	add_theme_support( 'title-tag' );

	// Standard front-end feature support.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	// WooCommerce-ready. The theme works fine with Woo INACTIVE — every
	// Woo function call in the templates is guarded with function_exists().
	add_theme_support( 'woocommerce' );

	// One nav menu location. The header falls back to hard-coded anchor
	// links (see punto_primary_menu_fallback) when no menu is assigned,
	// so the header looks identical before you create a menu in the admin.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'punto' ),
		)
	);

	load_theme_textdomain( 'punto', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'punto_setup' );

/**
 * Enqueue styles, scripts and fonts.
 *
 * All assets are the SAME files the static site uses, loaded from the
 * theme's assets/ folder via get_template_directory_uri() so paths always
 * resolve correctly regardless of the site's URL structure.
 */
function punto_assets() {
	$uri = get_template_directory_uri();
	$dir = get_template_directory();

	// --- Google Fonts (identical to the static site) ---
	wp_enqueue_style(
		'punto-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// --- Main stylesheet (the real design CSS, byte-for-byte) ---
	wp_enqueue_style(
		'punto-main',
		$uri . '/assets/css/styles.css',
		array( 'punto-fonts' ),
		file_exists( $dir . '/assets/css/styles.css' ) ? filemtime( $dir . '/assets/css/styles.css' ) : PUNTO_VERSION
	);

	// WordPress requires the root style.css (theme header) to be enqueued.
	wp_enqueue_style( 'punto-style', get_stylesheet_uri(), array( 'punto-main' ), PUNTO_VERSION );

	// --- Scripts (load order matters, matching the static site) ---
	// i18n + pricing define globals, main orchestrates, interactive adds effects.
	$scripts = array( 'i18n', 'pricing', 'main', 'interactive' );
	$prev    = array();
	foreach ( $scripts as $name ) {
		$path = '/assets/js/' . $name . '.js';
		wp_enqueue_script(
			'punto-' . $name,
			$uri . $path,
			$prev, // depend on the previously-registered script to preserve order
			file_exists( $dir . $path ) ? filemtime( $dir . $path ) : PUNTO_VERSION,
			true // in footer
		);
		$prev = array( 'punto-' . $name );
	}

	// Tell i18n.js where the language JSON lives inside the theme.
	// Without this, its relative fetch('data/en.json') would 404 under WP.
	wp_localize_script(
		'punto-i18n',
		'PUNTO',
		array(
			'dataBase' => trailingslashit( $uri . '/assets/data' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'punto_assets' );

/**
 * Preconnect to the Google Fonts origins (matches the static site's
 * <link rel="preconnect"> hints).
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed for.
 * @return array
 */
function punto_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'punto_resource_hints', 10, 2 );

/**
 * Output the head meta the static site had: description, theme-color and the
 * inline SVG favicon (red dot on paper). Printed only on the front page to
 * keep the original meta description intact there.
 */
function punto_head_meta() {
	if ( is_front_page() ) {
		echo '<meta name="description" content="Punto — Fixed-price design &amp; social media services. Fixed price. Fixed scope. No surprises." />' . "\n";
	}
	echo '<meta name="theme-color" content="#0A0A0A" />' . "\n";
	echo '<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 32 32\'%3E%3Crect width=\'32\' height=\'32\' fill=\'%23FAFAF8\'/%3E%3Ccircle cx=\'16\' cy=\'16\' r=\'7\' fill=\'%23E4002B\'/%3E%3C/svg%3E" />' . "\n";
}
add_action( 'wp_head', 'punto_head_meta', 1 );

/**
 * Fallback for the primary nav menu.
 *
 * Renders the exact hard-coded anchor links (with their data-i18n hooks) so
 * the header looks and translates identically when no menu is assigned in
 * Appearance → Menus. Assigning a menu later replaces this output.
 */
function punto_primary_menu_fallback() {
	$items = array(
		'#design'    => array( 'navbar.design', 'Design' ),
		'#social'    => array( 'navbar.social', 'Social Media' ),
		'#pricing'   => array( 'navbar.pricing', 'Pricing' ),
		'#process'   => array( 'navbar.process', 'Process' ),
		'#portfolio' => array( 'navbar.portfolio', 'Portfolio' ),
		'#contact'   => array( 'navbar.contact', 'Contact' ),
	);
	echo '<nav class="main-nav" aria-label="Primary">';
	foreach ( $items as $href => $item ) {
		printf(
			'<a href="%1$s" data-i18n="%2$s">%3$s</a>',
			esc_attr( $href ),
			esc_attr( $item[0] ),
			esc_html( $item[1] )
		);
	}
	echo '</nav>';
}

/**
 * Print the primary navigation.
 *
 * Uses wp_nav_menu() wired to the 'primary' location, with the hard-coded
 * anchor links as fallback so the header is identical before a menu exists.
 *
 * @param string $menu_class Class for the generated <ul> when a real menu is set.
 */
function punto_primary_nav( $menu_class = 'main-nav' ) {
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => 'nav',
			'container_class' => $menu_class,
			'menu_class'     => $menu_class . '-list',
			'fallback_cb'    => 'punto_primary_menu_fallback',
			'depth'          => 1,
		)
	);
}
