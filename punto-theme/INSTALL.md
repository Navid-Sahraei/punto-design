# Punto — WordPress Theme (Install & Setup)

A faithful WordPress port of the static Punto site. Same markup, CSS, fonts,
and interactions — Italian homepage by default, English on a page template,
WooCommerce-ready but not WooCommerce-dependent.

---

## 1. Zip the theme

From the folder that contains `punto-theme/`:

```bash
cd punto-theme
zip -r ../punto-theme.zip . -x ".*"
cd ..
```

You should now have `punto-theme.zip` next to the folder.

> Tip: the zip must contain the theme files at its **root** (i.e. `style.css`
> is directly inside the zip, inside the `punto-theme/` folder). The command
> above does that correctly.

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

## 4. Create the English page at `/en/`

1. **Pages → Add New**, title it **English** (or anything you like).
2. In the page settings sidebar, set the **URL slug** to `en` so it lives at
   `/en/`. (The IT/EN toggle links point at `home_url('/en/')`.)
3. In the sidebar under **Template**, choose **“English Home”**.
4. **Publish**. Leave the editor content empty — the template holds the copy.

Now the header **EN** button goes to `/en/`, and the **IT** button there goes
back to the Italian home. Behaviour matches the static `index.html` / `en.html`.

> If `/en/` shows a 404, go to **Settings → Permalinks** and click **Save**
> once to flush the rewrite rules.

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

| Package (IT / EN)      | File                     | Button text            |
|------------------------|--------------------------|------------------------|
| Identità / Identity    | `front-page.php`, `template-english.php` | Prenota Identità / Book Identity |
| Social                 | `front-page.php`, `template-english.php` | Prenota Social / Book Social     |
| Sito / Website         | `front-page.php`, `template-english.php` | Prenota Sito / Book Website      |

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
├── functions.php          enqueue styles/scripts/fonts, theme setup, menu, WooCommerce support, helpers
├── header.php             <!DOCTYPE> → opening <main> (language-aware nav)
├── footer.php             </main> → footer, wp_footer(), closing tags (language-aware)
├── front-page.php         Italian homepage (from index.html)
├── template-english.php   "English Home" page template (from en.html)
├── index.php              generic fallback template
├── page.php               standard interior pages
├── screenshot.png         theme thumbnail
├── INSTALL.md             this file
└── assets/
    ├── css/style.css      the site's real stylesheet (verbatim)
    ├── js/main.js         the site's real script (footer year + FAQ accordion)
    ├── fonts/             (empty — fonts load from Google Fonts, as on the static site)
    └── img/               (empty — the static site uses no image files)
```

## Notes / what could not be “ported” as-is

- **Fonts stay on Google Fonts.** The static site loads Bricolage Grotesque,
  DM Mono, and Instrument Sans from `fonts.googleapis.com`; the theme enqueues
  the exact same URL. `assets/fonts/` is left empty on purpose. If you ever need
  fully self-hosted fonts (GDPR), download the WOFF2 files into `assets/fonts/`
  and add `@font-face` rules — this changes hosting only, not the design.
- **No images to port.** The static site has no image assets; the favicon is an
  inline SVG data-URI, reproduced via `wp_head` so the tab icon is unchanged.
- **Language switching is the simple two-page setup** requested — no Polylang or
  WPML. Add one later if you want proper hreflang and per-string translation.
