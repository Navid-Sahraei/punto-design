# Punto

**Fixed price. Fixed scope. No surprises.**

A fixed-price design & social media services website. Concept A — *Precision Grid*: minimal, structured, blueprint-like, with a mouse-tracking red dot, hover card lifts, a subtle grid glow, dynamic pricing calculators, and an EN/IT language toggle.

- **Domain:** punto.design
- **Stack:** Vanilla HTML / CSS / JavaScript — no frameworks, no build step
- **Deployment:** GitHub Pages (Phase 1)

---

## Features

- **Mouse-tracking red dot** — a custom cursor (`#E4002B`) that follows the pointer and grows over interactive elements. Automatically disabled on touch devices, small screens, and when `prefers-reduced-motion` is set.
- **Hero grid glow** — a radial red glow follows the mouse across the blueprint grid.
- **Package card hover lifts** — cards rise `12px` with a red shadow and border on hover.
- **Dynamic pricing calculators** — sliders for social graphics (posts/month) and reels (reels/month); prices interpolate linearly between the published tiers and update in real time, with per-unit breakdowns.
- **EN / IT language toggle** — content loads from JSON, the choice persists in `localStorage`, and every dynamic section re-renders on switch.
- **Accessible** — semantic HTML, visible focus states, a skip link, ARIA on the slider and toggle, and full `prefers-reduced-motion` support.
- **Responsive** — breakpoints at 900px, 768px, 560px and 480px.

---

## Project structure

```
punto-design/
├── index.html          # Single page, all sections
├── css/
│   └── styles.css      # All styles + responsive + reduced-motion
├── js/
│   ├── i18n.js         # Language system (loads data/*.json, persists choice)
│   ├── pricing.js      # Dynamic pricing calculator (interpolation)
│   ├── main.js         # Orchestrator: renders sections, nav, form
│   └── interactive.js  # Mouse dot, grid glow, hover states
├── data/
│   ├── en.json         # English content
│   └── it.json         # Italian content
├── .gitignore
└── README.md
```

The JSON content files are loaded with `fetch()`, so the site must be served
over HTTP (not opened directly from the file system).

---

## Running locally

Because the language files are fetched at runtime, open the site through a
local server rather than `file://`:

```bash
# Python 3
python3 -m http.server 8000

# or Node
npx serve .
```

Then visit <http://localhost:8000>.

---

## Deployment — GitHub Pages

1. Push this repository to GitHub (public).
2. **Settings → Pages → Source:** `main` branch, root folder.
3. Wait 2–3 minutes.
4. Live at `https://<username>.github.io/punto-design`.

---

## Editing content

All copy lives in `data/en.json` and `data/it.json` — the two files share the
same key structure. Update a value in both to keep the languages in sync. Static
text is bound via `data-i18n="path.to.key"` attributes in `index.html`; dynamic
sections (design packages, pricing table, process steps, portfolio) are rendered
from the JSON by `js/main.js`.

### Pricing

Tier anchors live in `js/pricing.js` (`TABLES`). Quantities between anchors are
interpolated linearly; quantities above the top tier use the per-unit add-on
rate (`ADDON`).

| Service  | Tiers (qty → €/month)                        | Add-on |
|----------|----------------------------------------------|--------|
| Graphics | 4 → 80–100, 8 → 200–240, 12 → 300–360        | €22/post |
| Reels    | 1 → 120–150, 2 → 220–280, 4 → 400–480        | €95/reel |

---

## Roadmap

- **Phase 1 (this repo):** static site on GitHub Pages.
- **Phase 2:** WordPress migration — WooCommerce + Stripe checkout, invoicing.

---

## Notes

No personal information appears on the site by design — credibility comes from
the portfolio and transparent pricing. Legal identity (name, P.IVA, address)
appears on invoices only.
