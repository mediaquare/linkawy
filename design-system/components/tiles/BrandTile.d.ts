import * as React from 'react';

export type BrandKey =
  | 'chatgpt' | 'openai' | 'gemini' | 'claude' | 'perplexity' | 'deepseek' | 'grok' | 'copilot' | 'metaai' | 'mistral'
  | 'google' | 'googlemaps' | 'googleanalytics' | 'googlesearchconsole' | 'googleads' | 'semrush' | 'applenews'
  | 'meta' | 'shopify' | 'woocommerce' | 'wordpress' | 'x' | 'youtube' | 'tiktok' | 'facebook' | 'whatsapp';

/** Brand logo in the IconTile build (glow 8%) — dark tile on dark surfaces, light tile on white/cream. AI platforms + Google from LobeHub, the rest from Simple Icons. */
export interface BrandTileProps {
  /** Registry key → assets/brands/… (see BRAND_LOGOS) */
  brand?: BrandKey;
  /** Folder that holds assets/brands/ relative to the page (default "assets/brands/") */
  basePath?: string;
  /** Explicit SVG path — overrides `brand` */
  src?: string;
  /** Lucide fallback only for a brand with no available SVG */
  icon?: string;
  alt?: string;
  /** When set, renders a dark chip: tile + brand name */
  label?: string;
  /** auto (default) follows data-surface · dark · light */
  tone?: 'auto' | 'dark' | 'light';
  /** Tile size in px (default 48) */
  size?: number;
  style?: React.CSSProperties;
}
export function BrandTile(props: BrandTileProps): JSX.Element;
export const BRAND_LOGOS: Record<BrandKey, string>;
