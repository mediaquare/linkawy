import * as React from 'react';

/** Lucide icon (inline SVG, stroke 2.25, rounded caps and joins). Directional icons mirror in RTL. */
export interface IconProps {
  /** Lucide PascalCase name, e.g. "ArrowRight", "Search", "ChartLine". See ICON_NAMES. */
  name: string;
  /** 16–20 inline, 24 inside icon tiles */
  size?: number;
  /** Default 2.25 — the brand uses one stroke weight everywhere */
  strokeWidth?: number;
  color?: string;
  /** Force (true) or disable (false) RTL mirroring. Default: auto for arrows/chevrons/send. */
  mirror?: boolean;
  style?: React.CSSProperties;
}
export function Icon(props: IconProps): JSX.Element | null;
export const ICON_NAMES: string[];
