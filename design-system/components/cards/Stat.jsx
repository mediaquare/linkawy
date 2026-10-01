import React from 'react';

const SIZE = { sm: 'var(--fs-number-sm)', md: 'var(--fs-number-md)', lg: 'var(--fs-number-lg)' };

export function Stat({ value, label, size = 'lg', gradient = false, align = 'start', style }) {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 8, alignItems: align === 'center' ? 'center' : 'flex-start', textAlign: align === 'center' ? 'center' : 'start', ...style }}>
      <span className="lk-tnum" style={{
        fontSize: SIZE[size] || SIZE.lg, lineHeight: 'var(--lh-number)', fontWeight: 700, letterSpacing: 'var(--tracking-display)', direction: 'ltr', unicodeBidi: 'isolate',
        ...(gradient ? { background: 'var(--gradient-primary)', WebkitBackgroundClip: 'text', backgroundClip: 'text', color: 'transparent' } : { color: 'var(--text-accent)' }),
      }}>{value}</span>
      {label && <span style={{ fontSize: 15, lineHeight: 1.5, color: 'var(--text-body)' }}>{label}</span>}
    </div>
  );
}
