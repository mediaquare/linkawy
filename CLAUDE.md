# CLAUDE.md — linkawy theme

## Design system exceptions (deliberate)

- **Header = glass (deliberate exception).** The design system says glass is used only over glowing or busy art (`design-system/readme.md`). The site header is an intentional exception: it is glass on every page.
  - Dark variant (home page + service pages): `rgba(10,10,10,.72)` + `backdrop-filter: blur(20px) saturate(140%)`, bottom line `1px rgba(255,255,255,.06)`.
  - Light variant (all other pages): `rgba(255,255,255,.72)` + the same blur, bottom line `1px #EDE7DD`.
  - The glass is on `header::before` (never on `header` itself, which would trap the fixed mobile menu).
  - Without `backdrop-filter` support (`@supports`) it falls back to solid `#0A0A0A` / `#FFFFFF`.
  - Dropdowns (mega menu, sub-menus) and the mobile menu stay **solid**, never glass, so their text stays clear.
  - Code: `assets/css/ds.css` (Header section + "Light header").
