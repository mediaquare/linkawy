# CLAUDE.md — linkawy theme

## Design system exceptions (deliberate)

- **Header = glass (deliberate exception).** The design system says glass is used only over glowing or busy art (`design-system/readme.md`). The site header is an intentional exception.
  - **Dark header** (home page, service pages, single posts): always dark. Logo, links and buttons never change colour.
    - Default and no-JS fallback: solid `#0A0A0A`.
    - While a dark section is behind it (`header.lk-glass`): `rgba(10,10,10,.72)` + `backdrop-filter: blur(20px)` (no saturate).
    - Over light sections (cream, white, photos on light sections): solid `#0A0A0A`, no blur.
    - The state is set by a small script in `header.php`: it reads `data-surface` ("dark" = dark, any other value = light), otherwise the luminance of the first opaque background behind the header.
    - Only `background-color` animates (200ms), and not at all with `prefers-reduced-motion`.
    - Bottom line `1px rgba(255,255,255,.06)`.
  - **Light header** (all other pages): always glass, no script: `rgba(255,255,255,.72)` + `blur(20px) saturate(140%)`, bottom line `1px #EDE7DD`.
  - The background is on `header::before` (never on `header` itself, which would trap the fixed mobile menu).
  - Without `backdrop-filter` support (`@supports`) everything is solid `#0A0A0A` / `#FFFFFF`.
  - Dropdowns (mega menu, sub-menus) and the mobile menu stay **solid**, never glass, so their text stays clear.
  - Code: `assets/css/ds.css` (Header section + "Light header"), script in `header.php`.
