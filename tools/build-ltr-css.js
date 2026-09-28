#!/usr/bin/env node
/**
 * Build the LTR (English) stylesheets from the theme's RTL (Arabic) sources.
 *
 * The theme CSS is authored for Arabic (RTL). For the English version (/en/, Polylang)
 * every front-end stylesheet is flipped with rtlcss into assets/css/ltr/<same name>,
 * the Arabic font is swapped for Inter, and relative asset URLs are re-pointed one
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

const interFace = "@font-face{font-family:'Inter';font-style:normal;font-weight:100 900;font-display:optional;" +
    "src:url('../../fonts/inter/inter-latin-var.woff2') format('woff2')}";

// English-only additions appended to ltr/style.css (never shipped to Arabic pages).
const ltrExtras = `
/* Directional icons: in RTL "forward" arrows point left; mirror them for LTR.
   The individual "scale" property composes with any existing transform. */
.fa-arrow-left,.fa-arrow-right,.fa-long-arrow-alt-left,.fa-long-arrow-alt-right,
.fa-angle-left,.fa-angle-right,.fa-chevron-left,.fa-chevron-right{scale:-1 1}
/* Inline SVG "forward" arrows */
.blog-posts-btn svg,.service-hero-btn-arrow,.sh-btn-arrow svg{scale:-1 1}
/* English home hero title: Plus Jakarta Sans 800 (latin, self-hosted, preloaded on the English front page) */
@font-face{font-family:'Plus Jakarta Sans';font-style:normal;font-weight:800;font-display:swap;
src:url('../../fonts/plus-jakarta-sans/plus-jakarta-sans-latin-800.woff2') format('woff2')}
.hero-header h1{font-family:'Plus Jakarta Sans','Inter',sans-serif}
/* Language switcher (header, English pages) */
.lang-switch{display:inline-flex;align-items:center;justify-content:center;padding:.45rem 1rem;margin-inline-end:.75rem;
border:1px solid currentColor;border-radius:999px;font-size:.9rem;font-weight:600;line-height:1;color:inherit;text-decoration:none;opacity:.9}
.lang-switch:hover{opacity:1}
.home .lang-switch,.front-page .lang-switch{color:rgba(255,255,255,.9)}
/* Desktop: sit the switcher right next to the header CTA at the same height. The nav keeps its
   position: its auto margins and the switcher's leading auto margin share the free space. */
@media (min-width:769px){
header .container>nav.main-nav{margin-inline:auto}
.lang-switch{margin-inline-start:auto;margin-inline-end:12px;min-height:44px;padding:0 1.35rem;font-size:.95rem}
}
@media (max-width:991px){.lang-switch{padding:.35rem .75rem;font-size:.8rem;margin-inline-end:.5rem}}
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
    let css = rtlcss.process(guarded);
    // Source rules scoped to html[dir="rtl"] are the direction-specific adjustments; after flipping
    // they are exactly what the LTR page needs. WordPress prints no dir attribute for LTR,
    // so match "not RTL" rather than [dir="ltr"].
    css = css.replace(/html\[dir=("?)rtl\1\]/g, 'html:not([dir="rtl"])');
    // Files move one level down (assets/css/ltr/), so relative asset URLs go one level up.
    css = css.replace(/url\((['"]?)\.\.\//g, 'url($1../../');
    // Arabic font -> Inter (Somar Sans has no Latin design we want to use).
    css = css.replace(/@font-face\s*\{[^}]*Somar Sans[^}]*\}/g, interFace);
    css = css.replace(/(['"])Somar Sans\1/g, "'Inter'");
    const banner = `/* GENERATED from assets/css/${name} by tools/build-ltr-css.js. Do not edit. */\n`;
    fs.writeFileSync(path.join(outDir, name), banner + css + (name === 'style.css' ? ltrExtras : ''));
    count++;
}
console.log(`built ${count} LTR stylesheets in assets/css/ltr/`);
