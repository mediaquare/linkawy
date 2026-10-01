import * as React from 'react';

/** Full-width sunset PNG between cream and dark. Exactly two per homepage. */
export interface SunsetProps {
  /** cream-to-dark: between SEO proof (cream) and Strategy (dark) · dark-to-cream: under the contact form into Footer E (≈8vw tall) */
  variant?: 'cream-to-dark' | 'dark-to-cream';
  /** assets/images/sunset-cream-to-dark.png or assets/images/sunset-dark-to-cream.png */
  src: string;
  alt?: string;
  style?: React.CSSProperties;
}
export function Sunset(props: SunsetProps): JSX.Element;
