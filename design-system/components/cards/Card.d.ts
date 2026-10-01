import * as React from 'react';

/**
 * Content card, radius 16, no shadow. Highlight rule: ONE key card per section —
 * dark on light sections, orange gradient on dark sections.
 * @startingPoint section="Cards" subtitle="Light, dark, highlight and exceptional cards" viewport="700x420"
 */
export interface CardProps {
  /** The section the card sits on */
  on?: 'light' | 'dark';
  /**
   * default · highlight (dark on light / orange on dark) · highlight-orange (orange on light — only on request)
   * · exceptional (once per page: pricing / main offer — gradient button + number, soft orange shadow)
   */
  variant?: 'default' | 'highlight' | 'highlight-orange' | 'exceptional';
  /** Inner padding in px (default 32) */
  padding?: number | string;
  /** Lift 3px on hover (clickable cards) */
  interactive?: boolean;
  href?: string;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Card(props: CardProps): JSX.Element;

export interface CardTextProps {
  title?: React.ReactNode;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function CardText(props: CardTextProps): JSX.Element;
