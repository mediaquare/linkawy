import * as React from 'react';

/**
 * CTA block B — full-width block for pages WITHOUT Footer E: heading, one line, one pill button.
 * @startingPoint section="Blocks" subtitle="Gradient CTA block with dark button" viewport="900x300"
 */
export interface CTABlockProps {
  /** gradient (default, dark button) · orange (solid, dark button) · dark (gradient button) · cream (gradient button) — variants on request only */
  variant?: 'gradient' | 'orange' | 'dark' | 'cream';
  title: React.ReactNode;
  /** One line */
  text?: React.ReactNode;
  actionLabel?: React.ReactNode;
  actionHref?: string;
  onAction?: () => void;
  /** Trailing Lucide icon on the button (default ArrowRight) */
  icon?: string;
  /** Custom actions instead of the default button */
  children?: React.ReactNode;
  style?: React.CSSProperties;
}
export function CTABlock(props: CTABlockProps): JSX.Element;
