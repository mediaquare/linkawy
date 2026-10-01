import React from 'react';

export function SectionHeading({ eyebrow, title, subtitle, align = 'center', level = 2, display = false, maxWidth = 760, actions, style }) {
  const H = 'h' + level;
  const center = align === 'center';
  return (
    <div style={{ display: 'flex', flexDirection: 'column', alignItems: center ? 'center' : 'flex-start', textAlign: center ? 'center' : 'start', maxWidth, marginInline: center ? 'auto' : undefined, ...style }}>
      {eyebrow && (
        <span style={{ display: 'inline-flex', alignItems: 'center', gap: 8, fontSize: 'var(--fs-small)', lineHeight: 'var(--lh-small)', fontWeight: 500, color: 'var(--text-accent)', marginBottom: 16 }}>
          <span aria-hidden="true" style={{ width: 6, height: 6, borderRadius: 999, background: 'currentColor' }} />{eyebrow}
        </span>
      )}
      <H style={{
        fontSize: display ? 'var(--fs-display)' : 'var(--fs-section)', lineHeight: display ? 'var(--lh-display)' : 'var(--lh-section)',
        letterSpacing: display ? 'var(--tracking-display)' : 'var(--tracking-section)', fontWeight: 700, color: 'var(--text-heading)', textWrap: 'balance',
      }}>{title}</H>
      {subtitle && <p style={{ marginTop: 16, fontSize: display ? 18 : 'var(--fs-body)', lineHeight: 'var(--lh-body)', color: 'var(--text-body)', textWrap: 'pretty' }}>{subtitle}</p>}
      {actions && <div style={{ display: 'flex', flexWrap: 'wrap', gap: 12, marginTop: 'var(--space-element)', justifyContent: center ? 'center' : 'flex-start' }}>{actions}</div>}
    </div>
  );
}
