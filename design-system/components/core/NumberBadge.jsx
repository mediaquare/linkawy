import React from 'react';

export function NumberBadge({ children, variant = 'gradient', size = 40, style, ...rest }) {
  const g = variant === 'gradient';
  return (
    <span className="lk-tnum" style={{
      display: 'inline-flex', alignItems: 'center', justifyContent: 'center', flexShrink: 0, alignSelf: 'flex-start', minWidth: size, height: size, padding: '0 10px',
      borderRadius: 'var(--radius-pill)', fontFamily: 'var(--font-sans)', fontWeight: 700, fontSize: size >= 48 ? 18 : 15, lineHeight: 1,
      background: g ? 'var(--gradient-primary)' : 'var(--dark)', color: g ? 'var(--white)' : 'var(--orange)',
      border: g ? 'none' : '1px solid var(--dark-border)', ...style,
    }} {...rest}>{children}</span>
  );
}
