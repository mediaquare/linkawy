import React from 'react';

/** Sunset transition — the Accretion PNG, never a CSS gradient. */
export function Sunset({ variant = 'cream-to-dark', src, alt = '', style }) {
  const down = variant === 'dark-to-cream';
  return (
    <div aria-hidden={alt ? undefined : 'true'} style={{ background: 'var(--cream)', lineHeight: 0, ...style }}>
      <img src={src} alt={alt} style={{ display: 'block', width: '100%', height: down ? '8vw' : 'auto', objectFit: 'fill', marginBottom: down ? 0 : -1, marginTop: down ? -1 : 0 }} />
    </div>
  );
}
