# Punto — WordPress Theme (Install & Setup)

A faithful WordPress port of the static Punto site. Same markup, CSS, fonts,
and interactions — one bilingual homepage with a **client-side EN/IT toggle**
(no `/en/` page, no reload), Italian by default, WooCommerce-ready but not
WooCommerce-dependent.

---

## 1. Zip the theme

From the folder that **contains** `punto-theme/` (i.e. the repo root):

```bash
zip -r punto-theme.zip punto-theme -x "*/.git*"
```

You should now have `punto-theme.zip` next to the folder.

> Tip: the zip must contain a single top-level **folder** `punto-theme/` with
> `style.css` inside it — WordPress rejects a zip whose files sit at the root.
> The command above does that correctly (run it from the parent folder, not
> from inside `punto-theme/`).

## 2. Upload & activate

In WordPress admin:

1. **Appearance → Themes → Add New → Upload Theme**
2. Choose `punto-theme.zip` → **Install Now**
3. **Activate**

## 3. Make the homepage show the Italian design

`front-page.php` renders automatically once a static homepage is set:

1. Create a new page called **Home** (leave the content empty — all the copy
   lives in the template).
2. **Settings → Reading → “Your homepage displays” → A static page**
3. Set **Homepage: Home** → **Save Changes**

Visit the site — it should look identical to the Italian static site.

## 4. Language toggle — nothing to set up

The **EN/IT** button in the header is a **client-side toggle**: it swaps the
on-page text instantly, with no navigation and no `/en/` page. There is nothing
to configure — it works as soon as the theme is active.

How it works:
- Italian is the default and is what the server renders.
- `assets/js/i18n.js` fetches `assets/data/it.json` / `assets/data/en.json`
  (base path injected by `functions.php` via `wp_localize_script` as
  `window.PUNTO.dataBase`, resolving to
  `/wp-content/themes/punto-theme/assets/data/`).
- The visitor's choice is remembered in `localStorage` (`punto_lang`).

To edit copy in either language, edit the matching strings in
`assets/data/it.json` and `assets/data/en.json` (keys mirror each other).

> Do **not** create an `/en/` page — it isn't used and isn't needed.

## 5. Header menu (optional)

The header navigation already looks identical out of the box — it uses a
hard-coded fallback with the same anchor links as the static site.

If you later create a menu under **Appearance → Menus** and assign it to the
**Primary Menu** location, WordPress will render that menu instead. Note that a
real WP menu outputs `<ul><li>` markup, so if you go that route you may want to
add a little CSS for `.nav__links ul`/`li`. Until then, the fallback keeps the
header pixel-identical — you don’t need to create a menu.

---

## WooCommerce — where the button TODOs are (for later)

The theme declares `add_theme_support('woocommerce')` and guards everything, so
it works perfectly **before** WooCommerce is installed (no fatal errors).

The three package buttons still point at their current in-page anchors. When you
add WooCommerce and create the products, swap each button’s `href`. Search the
templates for **`TODO (WooCommerce)`** — there is one comment directly above each
button:

| Package (IT / EN)      | File             | Button text            |
|------------------------|------------------|------------------------|
| Identità / Identity    | `front-page.php` | Prenota Identità / Book Identity |
| Social                 | `front-page.php` | Prenota Social / Book Social     |
| Sito / Website         | `front-page.php` | Prenota Sito / Book Website      |

The button label text lives in `assets/data/{it,en}.json` (`pkg.*.cta`); the
`href` lives in `front-page.php`. Swap the `href` per the TODO; keep the
`data-i18n` attribute so the label still translates.

Each TODO shows the exact swap, e.g.:

```php
href="<?php echo esc_url( home_url( '/?add-to-cart=IDENTITA_PRODUCT_ID' ) ); ?>"
```

Keep the `class="btn ... pkg__cta"` and the button text unchanged so the design
stays the same.

### Suggested plugin order (test after each)

1. **WooCommerce** — create three products: Identità €490, Social €390, Sito €890.
2. **WooCommerce Stripe Gateway** — connect your Stripe keys.
3. **WFatture (Fatture in Cloud)** — automatic SDI e-invoices (needs your real
   P.IVA; keep it in test mode until then).
4. Follow the `TODO (WooCommerce)` comments to point each button at its product.

---

## File tree

```
punto-theme/
├── style.css              WordPress theme header (real CSS is enqueued from assets/)
├── functions.php          enqueue styles/scripts/fonts, theme setup, menu, WooCommerce support, i18n localize
├── header.php             <!DOCTYPE> → opening <main> (nav + EN/IT toggle button)
├── footer.php             </main> → footer, wp_footer(), closing tags
├── front-page.php         the single bilingual homepage (Italian default, data-i18n hooks)
├── index.php              generic fallback template
├── page.php               standard interior pages
├── screenshot.png         theme thumbnail
├── INSTALL.md             this file
└── assets/
    ├── css/style.css      the site's real stylesheet (verbatim, + button reset for .nav__lang)
    ├── js/main.js         footer year + single-open FAQ accordion
    ├── js/i18n.js         client-side EN/IT toggle (fetches data/*.json, localStorage)
    ├── data/it.json       Italian strings
    ├── data/en.json       English strings
    ├── fonts/             (empty — fonts load from Google Fonts, as on the static site)
    └── img/               (empty — the static site uses no image files)
```

## Notes

- **One bilingual page, client-side toggle.** Both languages live on the same
  homepage; `i18n.js` swaps `data-i18n` nodes in place from `data/{it,en}.json`.
  No `/en/` page, no Polylang/WPML. Add one later if you want per-URL pages with
  hreflang.
- **Fonts stay on Google Fonts.** The theme enqueues the exact same URL the
  static site used. `assets/fonts/` is empty on purpose. To self-host (GDPR),
  drop WOFF2 files there and add `@font-face` rules — hosting only, not design.
- **No images to port.** The favicon is an inline SVG data-URI, reproduced via
  `wp_head` so the tab icon is unchanged.
- **Contact email** is `r.sahraei88@gmail.com` (CTA buttons + footer, both
  languages). Domain references use `punto.center` / WordPress URL functions.
