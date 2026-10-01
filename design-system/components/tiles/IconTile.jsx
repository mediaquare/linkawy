import React from 'react';
import { Icon } from '../core/Icon.jsx';

const TONES = {
  dark: { edge: 'var(--tile-edge-dark)', inner: 'var(--tile-inner-dark)', glow: 'var(--tile-glow-opacity-dark)' },
  light: { edge: 'var(--tile-edge-light)', inner: 'var(--tile-inner-light)', glow: 'var(--tile-glow-opacity-light)' },
  auto: { edge: 'var(--tile-edge)', inner: 'var(--tile-inner)', glow: 'var(--tile-glow-opacity)' },
};

/**
 * Accretion build: 1px gradient edge → inner fill → orange radial glow from bottom-middle → 24px orange Lucide icon.
 * tone="auto" follows the surrounding data-surface; `logo` puts a brand SVG in the same tile (glow 8%): light build on white/cream, dark build on dark and inside dark/orange cards.
 */
export function IconTile({ icon, logo, logoAlt = '', logoMono = false, tone = 'auto', size = 56, glow = true, glowOpacity, iconColor = 'var(--orange)', iconSize, children, style, ...rest }) {
  const t = TONES[tone] || TONES.auto;
  // Logo tiles use the same build with a softer glow (8%) so it doesn't compete with brand colors
  const op = glowOpacity ?? (logo ? 'var(--tile-glow-opacity-logo)' : t.glow);
  const ls = Math.round(size * 0.5);
  return (
    <span style={{ display: 'inline-block', flexShrink: 0, width: size, height: size, padding: 1, borderRadius: 'var(--radius-tile)', background: t.edge, ...style }} {...rest}>
      <span style={{ position: 'relative', display: 'flex', alignItems: 'center', justifyContent: 'center', width: '100%', height: '100%', borderRadius: 'var(--radius-tile-inner)', background: t.inner, overflow: 'hidden' }}>
        {glow && <span aria-hidden="true" style={{ position: 'absolute', inset: 0, background: 'radial-gradient(' + size + 'px circle at 50% 100%, var(--orange), transparent)', opacity: op }} />}
        <span style={{ position: 'relative', display: 'flex' }}>
          {logo ? <img src={logo} alt={logoAlt} width={ls} height={ls} style={{ display: 'block', filter: logoMono ? 'var(--logo-mono-filter, none)' : undefined }} />
            : icon ? <Icon name={icon} size={iconSize || Math.round(size * 0.43)} color={iconColor} /> : children}
        </span>
      </span>
    </span>
  );
}
