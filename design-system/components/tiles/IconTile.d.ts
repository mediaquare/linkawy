import * as React from 'react';

/**
 * Icon tile with inner orange glow — dark build on dark sections, light build on white/cream sections.
 * @startingPoint section="Tiles" subtitle="Accretion-build icon tiles + brand tiles" viewport="700x420"
 */
export interface IconTileProps {
  /** Lucide icon name */
  icon?: string;
  /** Brand logo SVG path — same tile build, glow drops to 8% */
  logo?: string;
  logoAlt?: string;
  /** Single-color white logo (e.g. OpenAI): stays white on dark tiles, flips to black on light tiles */
  logoMono?: boolean;
  /** Override glow layer opacity (default: 15% dark / 10% light / 8% logo) */
  glowOpacity?: number | string;
  /** auto (default) follows data-surface · dark · light */
  tone?: 'auto' | 'dark' | 'light';
  /** Outer size in px (default 56 → 54 inner) */
  size?: number;
  /** Inner radial glow (default true) */
  glow?: boolean;
  iconColor?: string;
  iconSize?: number;
  style?: React.CSSProperties;
  /** Custom content instead of an icon */
  children?: React.ReactNode;
}
export function IconTile(props: IconTileProps): JSX.Element;
