import React from 'react';

/** Glass panel — ONLY over glowing or busy art (the sunset, gradient art). Never on flat backgrounds. */
export function Glass({ tone = 'dark', strong = false, padding = 28, children, style, ...rest }) {
  const dark = tone === 'dark';
  return (
    <div data-surface={dark ? 'dark' : 'white'} style={{
      position: 'relative', borderRadius: 'var(--radius-card)', padding,
      background: dark ? 'var(--glass-dark)' : (strong ? 'var(--glass-light-strong)' : 'var(--glass-light)'),
      border: '1px solid ' + (dark ? 'var(--glass-dark-border)' : 'var(--glass-light-strong)'),
      backdropFilter: 'blur(var(--glass-blur))', WebkitBackdropFilter: 'blur(var(--glass-blur))', ...style,
    }} {...rest}>{children}</div>
  );
}
