import * as React from 'react';

/** Highlighter mark (#FF6207 at 28%) behind ONE key phrase per heading, lower half of the line. */
export interface HighlightProps {
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Highlight(props: HighlightProps): JSX.Element;

/** Orange key words inside a heading (white inside orange cards). */
export interface AccentProps {
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Accent(props: AccentProps): JSX.Element;
