import * as React from 'react';

/** Outline pill for categories and meta (Shopify, Audits, Analytics, "13 min read"). Colors follow data-surface. Never gradient. */
export interface TagProps {
  /** neutral (gray text) · accent (orange text) — both are outline pills */
  variant?: 'neutral' | 'accent';
  /** Optional leading Lucide icon */
  icon?: string;
  style?: React.CSSProperties;
  children?: React.ReactNode;
}
export function Tag(props: TagProps): JSX.Element;
