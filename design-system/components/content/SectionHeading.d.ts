import * as React from 'react';

/** Eyebrow + section title (32px) or display (48px) + subtitle + actions. Colors follow data-surface. */
export interface SectionHeadingProps {
  /** Small orange label with a dot, e.g. "LIVE RESULTS" / "أهلًا بالمؤسس" */
  eyebrow?: React.ReactNode;
  /** Put <Highlight> or <Accent> around the key phrase */
  title: React.ReactNode;
  subtitle?: React.ReactNode;
  align?: 'center' | 'start';
  /** Heading level (default 2) */
  level?: 1 | 2 | 3;
  /** 48px display size — hero headings */
  display?: boolean;
  maxWidth?: number | string;
  /** Buttons row under the subtitle */
  actions?: React.ReactNode;
  style?: React.CSSProperties;
}
export function SectionHeading(props: SectionHeadingProps): JSX.Element;
