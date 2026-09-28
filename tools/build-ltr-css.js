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

fs.mkdirSync(outDir, { recursive: true });
let count = 0;
for (const name of fs.readdirSync(cssDir)) {
    if (!name.endsWith('.css') || skip.has(name)) {
        continue;
    }
    const src = fs.readFileSync(path.join(cssDir, name), 'utf8');
    let css = rtlcss.process(src);
    // Files move one level down (assets/css/ltr/), so relative asset URLs go one level up.
    css = css.replace(/url\((['"]?)\.\.\//g, 'url($1../../');
    // Arabic font -> Inter (Somar Sans has no Latin design we want to use).
    css = css.replace(/@font-face\s*\{[^}]*Somar Sans[^}]*\}/g, interFace);
    css = css.replace(/(['"])Somar Sans\1/g, "'Inter'");
    const banner = `/* GENERATED from assets/css/${name} by tools/build-ltr-css.js. Do not edit. */\n`;
    fs.writeFileSync(path.join(outDir, name), banner + css);
    count++;
}
console.log(`built ${count} LTR stylesheets in assets/css/ltr/`);
