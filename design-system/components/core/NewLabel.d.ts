import * as React from 'react';

/** Accretion-style hero label: white pill, 1.5px light border, gradient badge on the leading side, faint orange glow along the bottom. */
export interface NewLabelProps {
  /** Badge text — "NEW" in English, "جديد" in Arabic */
  badge?: string;
  href?: string;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function NewLabel(props: NewLabelProps): JSX.Element;
