#!/usr/bin/env node
/**
 * Build the LTR (English) stylesheets from the theme's RTL (Arabic) sources.
 *
 * The theme CSS is authored for Arabic (RTL). For the English version (/en/, Polylang)
 * every front-end stylesheet is flipped with rtlcss into assets/css/ltr/<same name>,
 * the Arabic font (Alexandria) is swapped for Sora, and relative asset URLs are re-pointed one
 * directory up. linkawy_get_asset_path() serves these files whenever !is_rtl().
 *
 * Usage (rtlcss is not a theme dependency; point RTLCSS_DIR at any folder that has it):
 *   RTLCSS_DIR=D:/Projects/linkawy-tools node tools/build-ltr-css.js
 *
 * Re-run after editing any file in assets/css/. Never edit assets/css/ltr/ by hand.
 */
const fs = require('fs');
const path = require('path');

const toolsDir = process.env.RTLCSS_DIR || path.resolve(__dirname, '..', '..', 'linkawy-tools');
const rtlcss = require(require.resolve('rtlcss', { paths: [toolsDir] }));

const cssDir = path.resolve(__dirname, '..', 'assets', 'css');
const outDir = path.join(cssDir, 'ltr');
// Editor-only styles are excluded (the block editor stays Arabic).
const skip = new Set(['editor-style.css']);

// English-only additions appended to ltr/style.css (never shipped to Arabic pages).
const ltrExtras = `
/* Directional icons: in RTL "forward" arrows point left; mirror them for LTR.
   The individual "scale" property composes with any existing transform. */
.fa-arrow-left,.fa-arrow-right,.fa-long-arrow-alt-left,.fa-long-arrow-alt-right,
.fa-angle-left,.fa-angle-right,.fa-chevron-left,.fa-chevron-right{scale:-1 1}
/* Inline SVG "forward" arrows */
/* (service hero arrows are Lucide .lk-icon-dir now: they follow the direction on their own) */
/* Language switcher: styled in assets/css/ds.css (redesign) for both languages. */
/* Home: the dark strategy section ends on a sub-pixel boundary in English, and while scrolling Chrome
   can show a white hairline (body background) between it and the partners strip. Overlap them by 1px
   and paint the partners strip on top so its own border stays visible. */
.strategy-section--dark{margin-bottom:-1px}
.strategy-section--dark+.partners-section{position:relative;z-index:1}
/* Desktop mega menu: open from the start of the nav (under "Home") instead of centring on "Services",
   so it does not cover the hero title. --mega-x is read by main-ar.js for the hover transform. */
@media (min-width:769px){
nav.main-nav{position:relative}
nav.main-nav li.has-dropdown{position:static}
html:not([dir="rtl"]) nav.main-nav .mega-menu{--mega-x:0px;left:0;right:auto;transform:translateY(10px)}
html:not([dir="rtl"]) nav.main-nav .has-dropdown:hover .mega-menu{transform:translateY(0)}
}
/* Desktop: sit the switcher right next to the header CTA at the same height. The nav keeps its
   position: its auto margins and the switcher's leading auto margin share the free space. */
@media (min-width:769px){
header .container>nav.main-nav{margin-inline:auto}
}
`;

fs.mkdirSync(outDir, { recursive: true });
let count = 0;
for (const name of fs.readdirSync(cssDir)) {
    if (!name.endsWith('.css') || skip.has(name)) {
        continue;
    }
    const src = fs.readFileSync(path.join(cssDir, name), 'utf8');
    // Rules written for LTR content inside the RTL page (phone/email/URL fields: `direction: ltr`
    // or an "ltr" selector) are already correct for an LTR page, so rtlcss must not flip them.
    const guarded = src.replace(/([^{}]+)\{([^{}]*)\}/g, (rule, selector, body) =>
        (/direction\s*:\s*ltr/i.test(body) || /ltr/i.test(selector)) && !/^\s*@/.test(selector.trim())
            ? `/*rtl:begin:ignore*/${rule}/*rtl:end:ignore*/`
            : rule);
    // Direction-neutral animations: the partners marquee runs inside a direction:ltr box and must
    // keep scrolling by -50% (seamless loop over the duplicated logo set) in both languages.
    const guardedAnim = guarded.replace(/@keyframes\s+partners-scroll\s*\{[\s\S]*?\}\s*\}/g,
        m => `/*rtl:begin:ignore*/${m}/*rtl:end:ignore*/`);
    let css = rtlcss.process(guardedAnim);
    // Source rules scoped to html[dir="rtl"] are the direction-specific adjustments; after flipping
    // they are exactly what the LTR page needs. WordPress prints no dir attribute for LTR,
    // so match "not RTL" rather than [dir="ltr"].
    css = css.replace(/html\[dir=("?)rtl\1\]/g, 'html:not([dir="rtl"])');
    // Files move one level down (assets/css/ltr/), so relative asset URLs go one level up.
    css = css.replace(/url\((['"]?)\.\.\//g, 'url($1../../');
    // Arabic font -> Sora (design system: one family per language version, never Sora in Arabic).
    // Each Alexandria @font-face (ds.css) becomes the Sora face of the same weight.
    css = css.replace(/@font-face\s*\{[^}]*Alexandria[^}]*\}/g, face => face
        .replace(/(['"])Alexandria\1/g, "'Sora'").replace(/alexandria-(\d+)\.woff2/g, 'sora-$1.woff2'));
    css = css.replace(/(['"])Alexandria\1/g, "'Sora'");
    const banner = `/* GENERATED from assets/css/${name} by tools/build-ltr-css.js. Do not edit. */\n`;
    fs.writeFileSync(path.join(outDir, name), banner + css + (name === 'style.css' ? ltrExtras : ''));
    count++;
}
console.log(`built ${count} LTR stylesheets in assets/css/ltr/`);
