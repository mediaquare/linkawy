import * as React from 'react';

/**
 * FAQ: heading column on the leading side, accordion of r16 cards on the other.
 * @startingPoint section="Content" subtitle="FAQ accordion, light or dark" viewport="900x520"
 */
export interface FAQProps {
  items: { q: React.ReactNode; a: React.ReactNode }[];
  /** Surface the FAQ sits on: dark → #121212 items with gradient edge; light → white items */
  on?: 'light' | 'dark';
  title?: React.ReactNode;
  subtitle?: React.ReactNode;
  eyebrow?: React.ReactNode;
  /** Button under the heading column */
  action?: React.ReactNode;
  /** Index open on mount (-1 for none). Default 0 */
  defaultOpen?: number;
  style?: React.CSSProperties;
}
export function FAQ(props: FAQProps): JSX.Element;
