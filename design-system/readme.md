# Linkawy Design System

**Linkawy (لينكاوي)** is an SEO and AI-search (GEO) agency for Saudi and Gulf e-commerce stores and companies, based in Riyadh. It is founder-led: Eng. Ali Atwa, 10+ years of SEO across the UAE, Saudi Arabia and the US. Its pitch is business-first: *"SEO is our last step"*. It measures sales and ROAS, not rankings.

This system covers the **linkawy.io website** in two versions:

- **Arabic (RTL)**: the primary version, set in **Alexandria**
- **English (LTR)**: set in **Sora**

Landing pages, social media and video are out of scope and will get their own briefs (see "Deferred" at the bottom).

## Sources

- **Design brief**: "Linkawy Website Design Brief", Oct 1 2026, @Ali Atwa (pasted in chat). When the brief and a reference disagree, **the brief wins**.
- **Reference screenshots** (`uploads/`, named by source):
  - `accretion-01…08`: main reference. Orange/gradient values, dark sections, icon tiles, sunset, footer, glass, NEW label.
  - `trailblazer-01…09`: white-dominant pages, cream sections with white cards, simple footer columns.
  - `autobzns-01…05`: pill buttons, dark highlight card on light, highlighter mark, colored number backgrounds.
  - `old-design-system-01…06`: Linkawy's previous system. Superseded; its colors, fonts and radii are replaced.
- **Figma files** (not attached, screenshots only): `accretion.fig`, `trailblazermktg.fig`, `autobzns.fig`, `linkawy.fig`. The brief's asset folder was `D:\Downloads\fig-files\brief-assets\`.
- **Live site copy**: https://www.linkawy.io/ (Arabic homepage, fetched Oct 2026). The UI kit uses this copy verbatim or trimmed. English copy is a translation.
- **Assets supplied**: `linkawy-ar-logo.svg`, `linkawy-en-logo.svg` (both vector, #FF6207), `sunset-cream-to-dark.png`, `sunset-dark-to-cream.png`, and the Sora and Alexandria TTFs (OFL).

---

## Index

| Path | What |
|---|---|
| `styles.css` | Entry point. `@import`s only: fonts, tokens, base |
| `fonts/` | Sora + Alexandria TTFs (400/500/600/700), `fonts.css`, OFL licenses |
| `tokens/colors.css` | Brand, surface and text colors, semantic aliases, `data-surface` scopes |
| `tokens/typography.css` | Families, size/line-height/tracking scale, RTL overrides |
| `tokens/spacing.css` | Section rhythm, content width, radii, tile size |
| `tokens/effects.css` | Shadows (2 only), tile glow, glass, motion |
| `tokens/base.css` | Body reset, link colors, RTL icon mirroring, marquee keyframes |
| `components/` | React primitives (see list below) + one `*.card.html` per folder |
| `guidelines/` | Foundation specimen cards (colors, type, spacing, effects, brand) |
| `ui_kits/website/` | Click-through recreation of the site: homepage, GEO service page, blog post, EN/AR |
| `assets/logos/` | `linkawy-en-logo.svg`, `linkawy-ar-logo.svg` |
| `assets/images/` | `sunset-cream-to-dark.png`, `sunset-dark-to-cream.png` |
| `assets/icons/lucide/` | 68 Lucide SVGs (stroke 2.25, official file names), copied from lucide@0.469.0 |
| `assets/brands/` | Simple Icons brand SVGs in brand color; `lobehub/` holds the LobeHub AI-platform + Google logos |
| `SKILL.md` | Agent-skill entry point |

### Components

Namespace: `window.LinkawyDesignSystem_430d5e`

- **core/**: `Icon`, `Button`, `Tag`, `NewLabel`, `Highlight` (+ `Accent`), `NumberBadge`
- **tiles/**: `IconTile`, `BrandTile`
- **cards/**: `Card` (+ `CardText`), `Stat`, `Glass`
- **content/**: `SectionHeading`, `FAQ`, `LogoMarquee`
- **forms/**: `Input` (input / select / textarea)
- **layout/**: `Section`, `Sunset`, `Header`
- **blocks/**: `CTABlock` (CTA block B), `FooterE`

**Intentional additions** (not named as components in the brief):

- `Icon`: an offline Lucide wrapper, because prototypes can't import `lucide-react`.
- `Section`: encodes the brief's background, rhythm and straight-edge rules.
- `SectionHeading`, `Stat`, `CardText`, `Accent`: small typographic helpers for the brief's type roles.
- `Header`: the brief doesn't specify the nav, but every page needs one.

### UI kit

`ui_kits/website/index.html` is the Linkawy website. The header language switch toggles EN/AR. Nav → Services → any item opens the GEO service page, and Blog opens a blog post.

---

## CONTENT FUNDAMENTALS

**Voice.** A calm, consultative expert talking to a founder. Linkawy speaks as **"we" (نحن / نقدم / نحلل)** and addresses the reader as **"you" (موقعك، متجرك، عملاؤك)**. The founder is named directly when trust matters ("تتعامل مع المهندس علي عطوة مباشرة"). Nothing is hyped and nothing is promised that can't be kept. The FAQ says plainly that no honest agency can guarantee position #1.

**Business before search.** Copy always ties SEO to money: *زيارات مؤهلة تتحول إلى مبيعات* (qualified traffic that turns into sales), *قياس الربحية.. وليس الترتيب* (measuring profit, not rankings), *مؤشرات الغرور (Vanity Metrics)*. Reuse this framing and never sell rankings for their own sake.

**Arabic register.** Simplified Modern Standard Arabic. Not classical and not colloquial, with an occasional light Gulf/Egyptian-friendly turn ("تقدر تشوفها بنفسك تحت وتحكم!"). SEO terms pair the Arabic term with the English one in parentheses:

- السيو التقني (Technical SEO)
- الروابط الخلفية (Backlinks)
- سيو الذكاء الإصطناعي (GEO)

Latin words stay inline and are set in Alexandria. Put a space between "و" and a Latin word: *ChatGPT و Gemini*.

**English register.** Plain and direct, sentence case everywhere: headings, buttons and nav. No Title Case and no ALL CAPS except the "LIVE RESULTS" eyebrow and the "NEW" badge. Use contractions sparingly. Sora is wide, so keep headings short.

**Headings** make a claim or ask the reader's question:

- "SEO is our last step"
- "9 reasons to choose Linkawy"
- "How Linkawy gets your site to the first results"

Mark ONE key phrase per heading, either orange words (`Accent`) or the highlighter (`Highlight`).

**Numbers** are concrete and used as proof:

- 270% average organic sales growth
- 10+ years
- 3–6 months
- 24-hour reply
- 9 reasons, 6 steps, 5 strategy steps

Don't invent statistics; use the real ones.

**CTAs** are imperative and low-friction: *احجز استشارة مجانية / Book a free consultation*, *اطلب عرض سعر / Request a quote*, *اكتشف الخدمات / Discover services*, *ابدأ الآن / Start now*. Use one primary CTA per block.

**Emoji:** none. The only one on the current site is the 🇪🇬 flag in the phone-code picker; flags are acceptable only in that picker. No unicode-symbol icons either. Use Lucide.

---

## VISUAL FOUNDATIONS

**Overall vibe.** Premium, warm and calm. White pages with generous air, broken by warm cream and deep near-black sections, lit by one saturated orange. It is closer to Accretion's spaciousness than to the current Linkawy site.

### Color

- **One orange, #FF6207, everywhere.** Use it for key words in headings, big numbers, icon strokes, links and the highlight card on dark. Never use other oranges (#FF6B00, #F26833, #EE5921) or the old pink/peach tones.
- **gradient-primary** (`100deg, #CE3000 → #FF852F`) is only for buttons, the NEW badge and CTA block B. **Tags are never gradient.**
- **White is dominant.** Cream #F8F6F1 alternates with it. Cream-warm #F5EDE0 appears 1–2× only (SEO results).
- **One dark, #0A0A0A, for every dark section.** Cards on dark are #121212. Dark tile inners are #171717 (light tile inners #FBF9F5). Borders are #262626.
- **No cool grays** (#F4F4F4, #F9F9F9). No purple, green or blue except inside third-party logos.
- **Special gradients** (spectrum, coral) are on explicit request only, and both are always shown.
- **Contrast rule:** white on orange ≈ 3:1, so that text is always **bold and ≥ 14px**.

### Type

- **One family per version.** Sora for EN, Alexandria for AR, never mixed.
- **Weights:** 400 body, 500 labels, 600 card titles, 700 headings.
- **Sizes:** Display 48, section 32, card 20, body 16/1.7, small 13/1.5. Big numbers are 28–48, bold, tabular, orange, line-height 1.1.
- **Heading line-height:** 1.15/1.2 in EN, 1.35 in AR.
- **Tracking:** EN headings −1.5% to −2%, AR none. The tokens switch automatically under `[dir="rtl"]`.

### Spacing & layout

- Between sections: 112px (80 for small sections).
- Between blocks inside a section: 40. Between elements: 24. Tight: 16.
- Content width is 1200px max with a 24px gutter.
- A dark section before a sunset gets about 120px extra bottom padding.
- Sections are always full-width and **straight (radius 0)**. Never put section content in a big rounded panel.
- **Never put two cream sections back to back.**
- The header is static (not fixed). The FAQ, Strategy and blog-TOC heading columns are sticky on desktop.

### Backgrounds & imagery

- No patterns, textures or hand-drawn illustration.
- The only art is the **sunset PNG** (Accretion), a full-width transition used exactly twice on the homepage: cream→dark after SEO proof, and dark→cream at about 8vw into Footer E. **Never fake it with CSS.**
- Photography and screenshots are real: client dashboards, Search Console, the founder's portrait. They sit in r16 frames on cream or white.
- Imagery is warm and neutral. Never use purple, blue or green gradient art on blog or case-study images.

### Corners, borders, cards

- **Pill (999px)** for everything clickable or tagged: buttons, tags, inputs, the NEW label.
- **Tags** (Shopify, Audits, Analytics…) are gray outline pills: 1px border, 13px/500. On light: white fill, #E8E2D8 border. On dark: #121212 fill, #262626 border. The `accent` variant only turns the text orange.
- **16px** for everything that holds content: cards, FAQ items, image frames, icon tiles (15 inner).
- **Light cards:** white, 1px #E8E2D8, **no shadow**.
- **Dark cards:** #121212 with a 1px gradient edge (#262626 → #0F0F0F, lighter at the top), built with the `padding-box / border-box` trick.
- **Highlight rule:** one key card per section. It is **dark on light sections** and **orange gradient on dark sections** (orange-light → orange → orange-deep, top to bottom-left). Orange-on-light is an allowed variant, but only when requested.
- **Exceptional card** (once per page, pricing/main offer): white, with a gradient button and main number (its tag stays an outline pill), plus shadow `0 18px 40px -12px rgba(255,98,7,.35)`.

### Shadows

- Cards have none.
- There are only two shadows in the system: the exceptional-card orange shadow and the NEW label's faint orange bottom glow.
- The icon-tile glow is *inside* the tile: a radial #FF6207 from bottom-middle at 15% (dark tile) or 10% (light tile), and 8% when the tile holds a brand logo.

### Transparency & blur

- Glass is used **only over glowing or busy art** (the sunset, gradient art).
  - Dark glass: white 4% with 20px blur.
  - Light glass: white 55–72%.
- Never use glass on flat backgrounds.
- The highlighter mark is orange at 28%, filling the lower half of the line.

### Motion

- Calm and functional.
- Ease-out `cubic-bezier(.22,1,.36,1)`, with durations of 150ms (hover color), 250ms (card lift, icon rotate) and 400ms (accordion).
- No bounces and no scroll-jacking.
- The logo marquee is 40s linear, with a soft fade mask at both ends, and it stops under `prefers-reduced-motion`.

### States

- **Primary button:** hover adds the soft orange shadow; press turns solid orange-deep and scales .98.
- **Dark button:** hover goes to #262626.
- **Outline on dark:** hover gets a white-4% fill and a #737373 border.
- **Nav links:** #A1A1A1 → white.
- **Footer links:** body → heading color.
- **Social circles:** icon turns orange.
- **Clickable cards:** lift 3px.
- **Input focus:** orange border plus a 3px highlight-mark ring.
- **FAQ:** the plus icon rotates 45° into ×.

### RTL

Everything uses logical properties (`paddingInlineStart`, `insetInlineEnd`, `textAlign: start`). Directional Lucide icons (arrows, chevrons, send) mirror under `[dir="rtl"]`. Numbers render in an LTR isolate so "%" and "+" stay put.

---

## ICONOGRAPHY

- **UI icons: Lucide only.** Stroke width **2.25**, rounded caps and joins, everywhere (tiles, inline, buttons, FAQ, footer, forms), 24px inside tiles, 16–20px inline. There is no icon font and no other UI set, and icons are never drawn by hand.
  - Production uses `lucide-react` from npm, tree-shaken.
  - In this system, 68 icons were **copied programmatically** from `lucide@0.469.0` into `assets/icons/lucide/*.svg` and embedded in `components/core/Icon.jsx`. `ICON_NAMES` lists the subset. To add one, copy its node from the Lucide package; don't redraw it.
- **Icon tiles** follow the exact Accretion build, in two tones. From outside in:
  - **Dark** (dark sections, and inside dark/orange highlight cards): 56×56 outer r16 with `linear-gradient(180deg,#262626,#0F0F0F)` as the 1px edge → 54×54 inner r15 #171717 → orange radial glow from bottom-center at 15% → 24px #FF6207 icon, stroke 2.25.
  - **Light** (every white, cream or cream-warm section): edge `linear-gradient(180deg,#E8E2D8,#F3EEE6)` → inner #FBF9F5 → same glow at 10% → same icon.
  - `IconTile` picks the tone from the surrounding `data-surface` automatically.
  - **Glow opacity:** Lucide icons 15% (dark) / 10% (light); brand logos 8% in either tone.
- **Brand logos** are copied, never redrawn, and sit in the **same tile as Lucide icons** (`BrandTile`, or `IconTile logo=…`): same gradient edge, inner fill and bottom-center glow, with the glow lowered to **8%** so it doesn't compete with brand colors. Dark tile on dark sections, light tile on white/cream. Logos keep their own colors (OpenAI/Grok white on dark tiles, flipped to black on light tiles):
  - **AI platforms and Google → LobeHub** (`@lobehub/icons-static-svg@1.95.1`, MIT), in `assets/brands/lobehub/`: Google (`google-color.svg`, the multicolor G — use it everywhere Google appears), ChatGPT/OpenAI (`openai-white.svg`), Gemini (`gemini-color.svg`), Claude, Perplexity, DeepSeek, Grok (white), Copilot, Meta AI, Mistral. `openai.svg` and `grok.svg` ship as `currentColor`; the `-white` copies only set that fill to #FFFFFF. See `assets/brands/lobehub/NOTICE.md`.
  - **Everything else → Simple Icons** in brand color, in `assets/brands/`: Google Maps (#4285F4), Semrush (#FF642D), Apple News (#FD415E), GA, GSC, Google Ads, Meta, Shopify, WooCommerce, WordPress, X, YouTube, TikTok, Facebook, WhatsApp. The older Simple Icons `google.svg`, `googlegemini.svg`, `perplexity.svg` and `claude.svg` are superseded by the LobeHub versions.
  - `BrandTile brand="chatgpt"` etc. resolves the file from the `BRAND_LOGOS` registry.
  - **Still missing:** Ahrefs, LinkedIn, Salla, Zid — use each brand's official SVG when supplied. The footer LinkedIn circle uses the Lucide `Linkedin` glyph.
  - **Hero platform cards:** Google (Result #1), Gemini (AI Overview), ChatGPT (LLMO / GEO), Semrush (DR 80 +3), Google Maps (Maps ranking), Apple News (Media coverage).
- **Client logos** (Dinar, Asharq Bloomberg, Move, Alyom, Inspire, Francis, Aswaq, Reef) are shown in one flat dark tone on cream, with no color. The SVGs live on linkawy.io and could not be copied, so the kit sets the client names in plain type until the files are supplied.
- **No emoji, and no unicode characters as icons.**

## Logo rules

- Both logos are #FF6207 on white, cream and dark. Use white on orange or the gradient.
- Arabic logo in the Arabic version, English logo in the English version. Never put both in one header.
- When both appear together, match them **by width**, not height.
- The Arabic vector was traced from a small raster. Ask for the designer's original before any large print.

## Deferred (landing pages, not this system)

These are kept so they aren't lost:

- Cream hero with a soft warm radial (Accretion).
- A gradient video-card hero (AutoBzns).
- A white hero with a gray menu bar (Trailblazer).
- A thin gradient top offer bar.
- A big-number stats row in bordered cards.
- Social and video may use the Trailblazer darks (#141416, #1E1E22) and other creams.
