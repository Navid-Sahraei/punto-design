<?php
/**
 * Punto theme functions.
 *
 * @package punto
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

	// Output valid HTML5 markup for core features.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// WooCommerce support — harmless when WooCommerce is not installed.
	add_theme_support( 'woocommerce' );

	// One nav menu, wired to the header navigation.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'punto' ),
		)
	);

	// Translation-ready.
	load_theme_textdomain( 'punto', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'punto_setup' );

/**
 * Enqueue styles, scripts, and fonts.
 *
 * The exact same Google Fonts URL and the site's real stylesheet/script are
 * loaded here so nothing about the design or behavior changes.
 */
function punto_assets() {
	// Google Fonts — identical to the static site (Bricolage Grotesque, DM Mono, Instrument Sans).
	wp_enqueue_style(
		'punto-fonts',
		'https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=DM+Mono:wght@400;500&family=Instrument+Sans:opsz,wght@20..48,400..600&display=swap',
		array(),
		null
	);

	// The site's real stylesheet (kept verbatim in assets/css/style.css).
	wp_enqueue_style(
		'punto-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array( 'punto-fonts' ),
		PUNTO_VERSION
	);

	// The site's real script (footer year + single-open FAQ accordion).
	wp_enqueue_script(
		'punto-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		PUNTO_VERSION,
		true // In the footer, same as the original placement before </body>.
	);
}
add_action( 'wp_enqueue_scripts', 'punto_assets' );

/**
 * Add rel=preconnect for the Google Fonts hosts, matching the static <head>.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function punto_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type && wp_style_is( 'punto-fonts', 'enqueued' ) ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'punto_resource_hints', 10, 2 );

/**
 * Which language is the current view rendering?
 *
 * The English homepage uses the "English Home" page template
 * (template-english.php). Everything else defaults to Italian, exactly like
 * the static site (index.html = IT, en.html = EN).
 *
 * @return string 'en' or 'it'.
 */
function punto_lang() {
	if ( is_page_template( 'template-english.php' ) ) {
		return 'en';
	}
	return 'it';
}

/**
 * Emit the inline SVG favicon used by the static site (cobalt dot on paper).
 * Kept identical so the browser-tab icon does not change.
 */
function punto_favicon() {
	echo '<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 32 32\'%3E%3Crect width=\'32\' height=\'32\' fill=\'%23FBFAF6\'/%3E%3Ccircle cx=\'16\' cy=\'23\' r=\'6\' fill=\'%231E2AEA\'/%3E%3C/svg%3E" />' . "\n";
}
add_action( 'wp_head', 'punto_favicon' );

/**
 * Fallback header navigation.
 *
 * Prints the exact anchor markup from the static site so the header looks
 * identical before any menu is created in Appearance → Menus. Language-aware
 * so the Italian and English homepages read the same as index.html / en.html.
 */
function punto_primary_menu_fallback() {
	if ( 'en' === punto_lang() ) {
		echo '<nav class="nav__links" aria-label="Main navigation">';
		echo '<a href="#packages">Packages</a>';
		echo '<a href="#how-it-works">How it works</a>';
		echo '<a href="#faq">FAQ</a>';
		echo '</nav>';
	} else {
		echo '<nav class="nav__links" aria-label="Navigazione principale">';
		echo '<a href="#pacchetti">Pacchetti</a>';
		echo '<a href="#come-funziona">Come funziona</a>';
		echo '<a href="#faq">FAQ</a>';
		echo '</nav>';
	}
}

/**
 * Force the <html> lang attribute to match the static site exactly
 * ("it" on the Italian home, "en" on the English page), instead of the
 * site's full locale (e.g. it-IT). language_attributes() still drives it.
 *
 * @param string $output The already-built language attributes string.
 * @return string
 */
function punto_language_attributes( $output ) {
	return 'lang="' . esc_attr( punto_lang() ) . '"';
}
add_filter( 'language_attributes', 'punto_language_attributes' );

/**
 * Preserve the static site's exact <title> strings on the two homepages.
 * Other pages keep WordPress's normal title behavior.
 *
 * @param array $parts The document title parts.
 * @return array
 */
function punto_document_title_parts( $parts ) {
	if ( is_page_template( 'template-english.php' ) ) {
		return array( 'title' => 'Punto — Design & social at a fixed price' );
	}
	if ( is_front_page() ) {
		return array( 'title' => 'Punto — Design & social a prezzo fisso' );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'punto_document_title_parts' );
