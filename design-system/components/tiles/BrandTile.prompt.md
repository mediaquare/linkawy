Shows a third-party platform logo in its own color inside a dark tile — hero platform cards, "we rank you on…" rows, AI-search pages.

```jsx
<BrandTile brand="chatgpt" label="ChatGPT" basePath="../../assets/brands/" />
<BrandTile brand="gemini" />
<BrandTile src="assets/brands/semrush.svg" alt="Semrush" />
```

- **AI platforms → LobeHub** (`@lobehub/icons-static-svg@1.95.1`, MIT), copied into `assets/brands/lobehub/`: Google (multicolor G), ChatGPT/OpenAI (white), Gemini, Claude, Perplexity, DeepSeek, Grok (white), Copilot, Meta AI, Mistral.
- **Search, SEO tools, commerce, social → Simple Icons**, in each brand's own color: Google Maps (#4285F4), Semrush (#FF642D), Apple News (#FD415E), GA, GSC, Google Ads, Meta, Shopify, WooCommerce, WordPress, X, YouTube, TikTok, Facebook, WhatsApp.
- Never recolor a logo orange and never redraw one. Still missing: Ahrefs, LinkedIn, Salla, Zid — use their official SVGs when supplied.
- Same tile as Lucide icons (`IconTile` build): gradient 1px edge, inner fill, bottom-center orange glow — but the glow is **8%** for logos (icons: 15% dark / 10% light).
- Tone follows the surface: dark tile on dark sections, light tile on white/cream. With `label`, the chip takes the surface's card style.
- Logos keep their brand colors. Single-color OpenAI/Grok stay white on dark tiles and flip to black on light tiles (`--logo-mono-filter`).
- You can also write `<IconTile logo="…/google-color.svg" />` directly.
