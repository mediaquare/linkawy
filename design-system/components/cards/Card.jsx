import React, { useState } from 'react';

function look(on, variant) {
  if (variant === 'exceptional') return { surface: 'white', css: { background: 'var(--white)', border: '1px solid var(--border-light)', boxShadow: 'var(--shadow-exceptional)' } };
  if (variant === 'highlight' && on === 'dark') return { surface: 'orange', css: { background: 'var(--gradient-highlight-card)', border: '1px solid transparent' } };
  if (variant === 'highlight-orange') return { surface: 'orange', css: { background: 'var(--gradient-highlight-card)', border: '1px solid transparent' } };
  if (variant === 'highlight') return { surface: 'dark', css: { background: 'var(--dark)', border: '1px solid var(--dark)' } };
  if (on === 'dark') return { surface: undefined, css: { background: 'linear-gradient(var(--dark-surface),var(--dark-surface)) padding-box, var(--dark-card-edge) border-box', border: '1px solid transparent' } };
  return { surface: undefined, css: { background: 'var(--white)', border: '1px solid var(--border-light)' } };
}

export function Card({ on = 'light', variant = 'default', padding = 32, interactive = false, href, children, style, ...rest }) {
  const [hover, setHover] = useState(false);
  const { surface, css } = look(on, variant);
  const Tag = href ? 'a' : 'div';
  return (
    <Tag href={href} data-surface={surface} onMouseEnter={interactive ? () => setHover(true) : undefined} onMouseLeave={interactive ? () => setHover(false) : undefined}
      style={{
        display: 'flex', flexDirection: 'column', position: 'relative', borderRadius: 'var(--radius-card)', padding, color: 'var(--text-body)',
        textDecoration: 'none', transition: 'transform var(--dur-base) var(--ease-out)', transform: hover ? 'translateY(-3px)' : 'none', ...css, ...style,
      }} {...rest}>{children}</Tag>
  );
}

/** Card title + body pair (20px/600 title, 16px body) — reads colors from the card's surface. */
export function CardText({ title, children, style }) {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 10, ...style }}>
      {title && <h3 style={{ fontSize: 'var(--fs-card)', lineHeight: 'var(--lh-card)', fontWeight: 600, letterSpacing: 'var(--tracking-card)', color: 'var(--text-heading)' }}>{title}</h3>}
      {children && <p style={{ fontSize: 'var(--fs-body)', lineHeight: 'var(--lh-body)', color: 'var(--text-body)' }}>{children}</p>}
    </div>
  );
}
