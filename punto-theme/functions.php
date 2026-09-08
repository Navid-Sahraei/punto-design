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
	define( 'PUNTO_VERSION', '1.1.0' );
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
 * loaded here so nothing about the design changes. The i18n script powers the
 * in-place EN/IT toggle and receives the JSON base path via wp_localize_script.
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
		true
	);

	// Client-side language toggle (in-place text swap, no navigation).
	wp_enqueue_script(
		'punto-i18n',
		get_template_directory_uri() . '/assets/js/i18n.js',
		array(),
		PUNTO_VERSION,
		true
	);

	// Inject the JSON base path so i18n.js fetches
	// /wp-content/themes/<theme>/assets/data/{it,en}.json — and the default language.
	wp_localize_script(
		'punto-i18n',
		'PUNTO',
		array(
			'dataBase'    => get_template_directory_uri() . '/assets/data/',
			'defaultLang' => 'it',
		)
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
 * Prints the exact anchor markup from the static site (with data-i18n keys) so
 * the header looks identical before any menu is created, and stays translatable
 * by the client-side toggle.
 */
function punto_primary_menu_fallback() {
	echo '<nav class="nav__links" aria-label="Navigazione principale" data-i18n-aria-label="nav.navAria">';
	echo '<a href="#pacchetti" data-i18n="nav.packages">Pacchetti</a>';
	echo '<a href="#come-funziona" data-i18n="nav.how">Come funziona</a>';
	echo '<a href="#faq" data-i18n="nav.faq">FAQ</a>';
	echo '</nav>';
}

/**
 * The homepage renders Italian by default (matching the static site), so pin the
 * front page's <html> lang to "it". i18n.js updates it live when toggled. Other
 * pages keep WordPress's normal locale behavior.
 *
 * @param string $output The already-built language attributes string.
 * @return string
 */
function punto_language_attributes( $output ) {
	if ( is_front_page() ) {
		return 'lang="it"';
	}
	return $output;
}
add_filter( 'language_attributes', 'punto_language_attributes' );

/**
 * Preserve the static site's exact Italian <title> on the homepage (the default
 * language). i18n.js updates document.title when the visitor switches to English.
 *
 * @param array $parts The document title parts.
 * @return array
 */
function punto_document_title_parts( $parts ) {
	if ( is_front_page() ) {
		return array( 'title' => 'Punto — Design & social a prezzo fisso' );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'punto_document_title_parts' );

/* =========================================================
   WooCommerce — package buttons: add to cart, straight to checkout
   ========================================================= */

/**
 * Resolve a WooCommerce product ID from its slug (post_name).
 *
 * @param string $slug Product slug, e.g. "identita", "social", "sito".
 * @return int Product ID, or 0 if not found / WooCommerce inactive.
 */
function punto_product_id_by_slug( $slug ) {
	if ( ! function_exists( 'WC' ) ) {
		return 0;
	}
	$product_post = get_page_by_path( sanitize_title( $slug ), OBJECT, 'product' );
	return $product_post ? (int) $product_post->ID : 0;
}

/**
 * Build the add-to-cart URL for a package, resolved dynamically from its slug so
 * it keeps working even if product IDs change. When WooCommerce is inactive or
 * the product is missing, return the original in-page anchor so the button still
 * looks and behaves exactly as before (no fatals, no design change).
 *
 * Combined with the woocommerce_add_to_cart_redirect filter below, clicking the
 * button adds THAT product and lands the visitor straight on checkout.
 *
 * @param string $slug     Product slug: identita | social | sito.
 * @param string $fallback Href to use when Woo/product is unavailable.
 * @return string URL (add-to-cart) or the fallback anchor.
 */
function punto_add_to_cart_url( $slug, $fallback = '#prenota' ) {
	$product_id = punto_product_id_by_slug( $slug );
	if ( ! $product_id ) {
		return $fallback;
	}

	// Prefer WooCommerce's own builder (handles simple/variable products).
	if ( function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product_id );
		if ( $product && is_callable( array( $product, 'add_to_cart_url' ) ) ) {
			$url = $product->add_to_cart_url();
			if ( $url ) {
				return $url;
			}
		}
	}

	// Fallback: plain add-to-cart query on the site URL (punto.center).
	return add_query_arg( 'add-to-cart', $product_id, home_url( '/' ) );
}

/**
 * After a successful add-to-cart, send the visitor straight to checkout
 * ("Option B") instead of the cart page or the referring page.
 *
 * @param string $url Default redirect URL from WooCommerce.
 * @return string
 */
function punto_add_to_cart_redirect( $url ) {
	if ( function_exists( 'wc_get_checkout_url' ) ) {
		return wc_get_checkout_url();
	}
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'punto_add_to_cart_redirect' );
