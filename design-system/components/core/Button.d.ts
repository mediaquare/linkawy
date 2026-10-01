import * as React from 'react';

/**
 * Pill button. primary = gradient-primary + white bold text; dark = secondary on light AND the button
 * inside any orange/gradient block; outline = on dark sections.
 * @startingPoint section="Core" subtitle="Pill buttons — gradient, dark, outline" viewport="700x300"
 */
export interface ButtonProps {
  /** primary (gradient) · dark (on light, or inside orange/gradient blocks) · outline (on dark) */
  variant?: 'primary' | 'dark' | 'outline';
  size?: 'sm' | 'md' | 'lg';
  /** Trailing Lucide icon name, e.g. "ArrowRight" (auto-mirrors in RTL) */
  icon?: string;
  /** Leading Lucide icon name */
  iconStart?: string;
  /** Renders an <a> when set */
  href?: string;
  disabled?: boolean;
  fullWidth?: boolean;
  type?: 'button' | 'submit' | 'reset';
  onClick?: (e: React.MouseEvent) => void;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Button(props: ButtonProps): JSX.Element;
