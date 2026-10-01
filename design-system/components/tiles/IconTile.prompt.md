The 56×56 icon tile (Accretion build) that heads every feature, service and reason card — dark on dark sections, light on white/cream.

```jsx
<IconTile icon="Search" />              {/* auto: follows the section's data-surface */}
<IconTile icon="ChartLine" tone="light" />
<IconTile icon="Code" tone="dark" size={48} />
```

- **Dark build** (dark sections, and inside dark/orange highlight cards): outer 56 r16 `linear-gradient(180deg,#262626,#0F0F0F)` as the 1px edge → inner 54 r15 `#171717` → radial #FF6207 glow from bottom-center at 15% → 24px icon, stroke 2.25, #FF6207.
- **Light build** (white / cream / cream-warm sections): edge `linear-gradient(180deg,#E8E2D8,#F3EEE6)` → inner `#FBF9F5` → same glow at 10% → same icon.
- `tone="auto"` (default) reads `--tile-edge / --tile-inner / --tile-glow-opacity` from the nearest `data-surface`, so a dark highlight card on a cream section still gets a dark tile.
- **Logo tiles:** `<IconTile logo="assets/brands/lobehub/gemini-color.svg" />` (or `BrandTile`) — same build in the same tone, glow lowered to **8%** so it doesn't compete with brand colors.
- The glow stays inside the tile. Never add an orange border or an outer glow.
