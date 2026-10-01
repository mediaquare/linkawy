import * as React from 'react';

/** Colored number background for steps, reasons and ranked lists (AutoBzns pattern). */
export interface NumberBadgeProps {
  /** gradient (white bold number) · dark (orange number on #0A0A0A) */
  variant?: 'gradient' | 'dark';
  /** Height in px (40 or 48) */
  size?: number;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function NumberBadge(props: NumberBadgeProps): JSX.Element;
