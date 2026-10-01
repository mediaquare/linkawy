import * as React from 'react';

export interface NavLink {
  label: React.ReactNode;
  href?: string;
  active?: boolean;
  /** Dropdown entries (e.g. the Services menu) */
  items?: { label: React.ReactNode; href?: string }[];
}

/** Dark site header: one logo (the version's own language), nav with dropdowns, language switch, gradient CTA. */
export interface HeaderProps {
  /** assets/logos/linkawy-en-logo.svg or linkawy-ar-logo.svg — never both */
  logoSrc: string;
  logoAlt?: string;
  logoHref?: string;
  links?: NavLink[];
  cta?: { label: React.ReactNode; href?: string; onClick?: () => void };
  langSwitch?: { label: React.ReactNode; href?: string; onClick?: () => void };
  /** Intercepts clicks for click-through prototypes */
  onNavigate?: (item: any) => void;
  style?: React.CSSProperties;
}
export function Header(props: HeaderProps): JSX.Element;
