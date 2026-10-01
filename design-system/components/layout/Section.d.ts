import * as React from 'react';

/** Full-width, straight-edged page section (never rounded). Sets data-surface so every nested component recolors. */
export interface SectionProps {
  /** white (dominant) · cream (alternate) · cream-warm (1–2 special sections) · dark */
  bg?: 'white' | 'cream' | 'cream-warm' | 'dark';
  /** default 112px top/bottom · sm 80px · none */
  size?: 'default' | 'sm' | 'none';
  /** Adds the extra ~120px bottom padding a dark section needs before a sunset transition */
  beforeSunset?: boolean;
  /** Wrap children in the 1200px content container (default true) */
  contained?: boolean;
  maxWidth?: number | string;
  id?: string;
  padTop?: number | string;
  padBottom?: number | string;
  style?: React.CSSProperties;
  innerStyle?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Section(props: SectionProps): JSX.Element;
