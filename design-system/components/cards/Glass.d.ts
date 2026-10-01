import * as React from 'react';

/** Frosted panel for content sitting on top of the sunset or gradient art. */
export interface GlassProps {
  /** dark: white 4% + 20px blur · light: white 55% (72% when strong) */
  tone?: 'dark' | 'light';
  strong?: boolean;
  padding?: number | string;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Glass(props: GlassProps): JSX.Element;
