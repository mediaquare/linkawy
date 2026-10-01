import * as React from 'react';

/**
 * Footer E (default footer): sunset dark→cream line, centered CTA on cream, divider, link columns,
 * giant faded logo, copyright. Must follow a dark section.
 * @startingPoint section="Blocks" subtitle="Footer E — sunset, CTA, columns, faded logo" viewport="1200x900"
 */
export interface FooterEProps {
  /** The version's own logo (EN or AR) — also used for the giant faded mark */
  logoSrc: string;
  logoAlt?: string;
  /** assets/images/sunset-dark-to-cream.png */
  sunsetSrc?: string;
  /** One-line brand description */
  description?: React.ReactNode;
  /** Social circles — Lucide icon names: Linkedin, Youtube, Facebook, MessageCircle… */
  socials?: { icon: string; href?: string; label: string }[];
  /** Services · Resources · Company */
  columns?: { title: React.ReactNode; links: { label: React.ReactNode; href?: string }[] }[];
  /** Contact column (location, email) */
  contact?: { title: React.ReactNode; items: { icon: string; label: React.ReactNode; href?: string }[] };
  cta?: { title: React.ReactNode; text?: React.ReactNode; label: React.ReactNode; href?: string; onClick?: () => void };
  copyright?: React.ReactNode;
  style?: React.CSSProperties;
}
export function FooterE(props: FooterEProps): JSX.Element;
