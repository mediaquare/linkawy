Renders a Lucide UI icon as inline SVG; the only UI icon set allowed on the site.

```jsx
<Icon name="ArrowRight" size={18} />
<Icon name="Search" size={24} color="var(--orange)" />
```

- Stroke is always 2.25 with rounded caps/joins — tiles, inline, buttons, FAQ, footer, forms. 24px inside tiles, 16–20px inline.
- `ArrowRight`, `ArrowLeft`, `ArrowUpRight`, `ChevronRight`, `ChevronLeft`, `Send`, `Route` get class `lk-icon-dir` and mirror under `[dir="rtl"]`.
- The bundled subset lives in `assets/icons/lucide/` (SVG, official Lucide file names, stroke 2.25) — `ICON_NAMES` lists it. Production: `lucide-react`, tree-shaken.
- Brand logos are NOT Lucide — use `BrandTile` with Simple Icons from `assets/brands/`.
