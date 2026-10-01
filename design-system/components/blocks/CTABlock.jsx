import React from 'react';
import { Button } from '../core/Button.jsx';

const V = {
  gradient: { bg: 'var(--gradient-primary)', surface: 'orange', btn: 'dark' },
  orange: { bg: 'var(--orange)', surface: 'orange', btn: 'dark' },
  dark: { bg: 'var(--dark)', surface: 'dark', btn: 'primary' },
  cream: { bg: 'var(--cream)', surface: 'cream', btn: 'primary' },
};

export function CTABlock({ variant = 'gradient', title, text, actionLabel, actionHref, onAction, icon = 'ArrowRight', children, style }) {
  const v = V[variant] || V.gradient;
  return (
    <section data-surface={v.surface} style={{ background: v.bg, borderRadius: 0, padding: 'var(--space-section-sm) var(--gutter)', ...style }}>
      <div style={{ maxWidth: 760, marginInline: 'auto', display: 'flex', flexDirection: 'column', alignItems: 'center', textAlign: 'center', gap: 16 }}>
        <h2 style={{ fontSize: 'var(--fs-section)', lineHeight: 'var(--lh-section)', letterSpacing: 'var(--tracking-section)', fontWeight: 700, color: 'var(--text-heading)' }}>{title}</h2>
        {text && <p style={{ fontSize: 17, lineHeight: 'var(--lh-body)', color: 'var(--text-body)', fontWeight: v.surface === 'orange' ? 500 : 400 }}>{text}</p>}
        {(actionLabel || children) && <div style={{ marginTop: 8, display: 'flex', gap: 12, flexWrap: 'wrap', justifyContent: 'center' }}>
          {children || <Button variant={v.btn} size="lg" icon={icon} href={actionHref} onClick={onAction}>{actionLabel}</Button>}
        </div>}
      </div>
    </section>
  );
}
