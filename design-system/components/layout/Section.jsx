import React from 'react';

const BG = { white: 'var(--white)', cream: 'var(--cream)', 'cream-warm': 'var(--cream-warm)', dark: 'var(--dark)' };

export function Section({ bg = 'white', size = 'default', beforeSunset = false, contained = true, maxWidth, id, padTop, padBottom, children, style, innerStyle, ...rest }) {
  const pad = size === 'sm' ? 'var(--space-section-sm)' : size === 'none' ? '0px' : 'var(--space-section)';
  const bottom = beforeSunset ? 'calc(' + pad + ' + var(--space-sunset-pad))' : pad;
  return (
    <section id={id} data-surface={bg} style={{
      position: 'relative', background: BG[bg] || BG.white, color: 'var(--text-body)', borderRadius: 0,
      paddingTop: padTop ?? pad, paddingBottom: padBottom ?? bottom, ...style,
    }} {...rest}>
      {contained
        ? <div style={{ maxWidth: maxWidth || 'var(--content-max)', marginInline: 'auto', paddingInline: 'var(--gutter)', boxSizing: 'content-box', ...innerStyle }}>{children}</div>
        : children}
    </section>
  );
}
