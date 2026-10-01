import * as React from 'react';

/** Big number (28–48px, tabular, bold, orange) with a short label. */
export interface StatProps {
  /** e.g. "270%", "+12", "3–6" — always rendered LTR-isolated so "%" stays put in Arabic */
  value: React.ReactNode;
  label?: React.ReactNode;
  /** sm 28 · md 36 · lg 48 */
  size?: 'sm' | 'md' | 'lg';
  /** Gradient-filled number — ONLY for the exceptional card's main number */
  gradient?: boolean;
  align?: 'start' | 'center';
  style?: React.CSSProperties;
}
export function Stat(props: StatProps): JSX.Element;
