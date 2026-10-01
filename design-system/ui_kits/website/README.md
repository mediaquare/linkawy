# Website UI kit — linkawy.io

Click-through recreation of the Linkawy website in both versions (EN/LTR Sora, AR/RTL Alexandria), built from the brief's page structure and the live linkawy.io copy.

- `index.html` — app shell: language toggle (header), page routing, persists lang/page in localStorage
- `content.js` — all copy, `LK_CONTENT.ar` (from linkawy.io) and `LK_CONTENT.en` (translation)
- `Chrome.jsx` — `SiteHeader`, `SiteFooter` (Footer E), `LkFrame` image frame, `lkHL` highlight helper
- `HomeTop.jsx` — sections 1–5: Hero + platforms (dark) · Services (white) · SEO proof 270% (cream) + sunset · Strategy (dark) · Success partners (dark, continuous)
- `HomeBottom.jsx` — sections 6–13: Process (white) · 9 reasons (cream) · Benefits (white, tabbed) · Blog (cream) · Founder (white) · FAQ (white) · SEO results (cream-warm) · Contact form (dark) → Footer E
- `Pages.jsx` — `ServicePage` (GEO) and `BlogPost`, both ending on CTA block B

Interactions: header dropdown, language switch, service/blog navigation, benefits tabs, FAQ accordion, contact form → success state, scroll-to anchors.

Placeholders: client logos, the founder photo, blog images and result screenshots live on linkawy.io and block hotlinking — they render as labeled placeholders / plain-type names. Drop the real files into `assets/` and point `content.js` at them.
