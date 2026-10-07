# CLAUDE.md — linkawy theme

## Design system exceptions (deliberate)

- **Light header = glass (deliberate exception).** The design system says glass is used only over glowing or busy art (`design-system/readme.md`). The light site header is an intentional exception.
  - **Light header** (every page except the home page, the service pages and single posts): `rgba(255,255,255,.72)` + `backdrop-filter: blur(20px) saturate(140%)`, bottom line `1px #EDE7DD`. Solid `#FFFFFF` without `backdrop-filter` support (`@supports`).
  - **Dark header** (home page, service pages, single posts): **no glass** — always solid `#0A0A0A`, bottom line `1px rgba(255,255,255,.06)`.
  - The background is on `header::before` (never on `header` itself, which would trap the fixed mobile menu).
  - Dropdowns under the **dark** header and the mobile menu stay **solid**, never glass, so their text stays clear.
  - Dropdowns under the **light** header (mega menu + sub-menus) use the **same glass** as the light header: `rgba(255,255,255,.72)` + `blur(20px) saturate(140%)`, border `#EDE7DD`, soft shadow; solid `#FFFFFF` without `backdrop-filter` support.
  - Dropdowns open `40px` below the nav link (as in the old design); the hover delay in `assets/js/main-ar.js` bridges the gap.
  - Code: `assets/css/ds.css` (Header section + "Light header").
