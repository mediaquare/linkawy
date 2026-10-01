import React from 'react';
import { IconTile } from './IconTile.jsx';

/**
 * Brand-logo registry (paths relative to assets/brands/). Files are copied, never redrawn:
 * AI platforms → LobeHub (@lobehub/icons-static-svg, MIT) in assets/brands/lobehub/;
 * search / commerce / social → Simple Icons in each brand's own color.
 */
export const BRAND_LOGOS = {
  chatgpt: 'lobehub/openai-white.svg', openai: 'lobehub/openai-white.svg', gemini: 'lobehub/gemini-color.svg',
  claude: 'lobehub/claude-color.svg', perplexity: 'lobehub/perplexity-color.svg', deepseek: 'lobehub/deepseek-color.svg',
  grok: 'lobehub/grok-white.svg', copilot: 'lobehub/copilot-color.svg', metaai: 'lobehub/metaai-color.svg', mistral: 'lobehub/mistral-color.svg',
  google: 'lobehub/google-color.svg', googlemaps: 'googlemaps.svg', googleanalytics: 'googleanalytics.svg', googlesearchconsole: 'googlesearchconsole.svg',
  googleads: 'googleads.svg', semrush: 'semrush.svg', applenews: 'applenews.svg', meta: 'meta.svg', shopify: 'shopify.svg',
  woocommerce: 'woocommerce.svg', wordpress: 'wordpress.svg', x: 'x.svg', youtube: 'youtube.svg', tiktok: 'tiktok.svg',
  facebook: 'facebook.svg', whatsapp: 'whatsapp.svg',
};

const MONO = { chatgpt: 1, openai: 1, grok: 1 };

/**
 * Third-party brand logo in the exact IconTile build (edge → inner → bottom-center glow at 8%).
 * Tone follows the surface: dark on dark sections, light on white/cream. With `label` it becomes a chip
 * (outline pill-card in the surface's card style) holding the tile + brand name.
 */
export function BrandTile({ brand, basePath = 'assets/brands/', src, icon, alt = '', label, size = 48, tone = 'auto', style, ...rest }) {
  const file = src || (brand && BRAND_LOGOS[brand] ? basePath + BRAND_LOGOS[brand] : undefined);
  const mono = !!(brand && MONO[brand]);
  const tile = <IconTile tone={tone} size={size} logo={file} logoAlt={label ? '' : alt} logoMono={mono} icon={file ? undefined : icon} iconSize={Math.round(size * 0.46)} />;
  if (!label) return <span style={{ display: 'inline-flex', ...style }} {...rest}>{tile}</span>;
  return (
    <span style={{
      display: 'inline-flex', alignItems: 'center', gap: 14, padding: 8, paddingInlineEnd: 22, borderRadius: 'var(--radius-card)',
      background: 'linear-gradient(var(--card-bg),var(--card-bg)) padding-box, var(--card-edge) border-box', border: '1px solid transparent',
      fontFamily: 'var(--font-sans)', fontSize: 16, fontWeight: 600, color: 'var(--text-heading)', whiteSpace: 'nowrap', ...style,
    }} {...rest}>{tile}<span>{label}</span></span>
  );
}
