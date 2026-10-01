import * as React from 'react';

/** Client-logo marquee: every logo in one flat tone, soft fade at both ends, infinite scroll. */
export interface LogoMarqueeProps {
  /** Logo image, or `label` only → the client name set in plain type (when no logo file is available) */
  logos: { src?: string; alt: string; label?: string; height?: number }[];
  /** dark = flat dark logos (on cream/white) · light = flat white logos (on dark sections) */
  tone?: 'dark' | 'light';
  /** Logo height in px (default 30) */
  height?: number;
  gap?: number;
  /** Seconds per loop (default 40) */
  duration?: number;
  style?: React.CSSProperties;
}
export function LogoMarquee(props: LogoMarqueeProps): JSX.Element;
