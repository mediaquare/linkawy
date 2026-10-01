import React from 'react';

export function NewLabel({ badge = 'NEW', children, href, style, ...rest }) {
  const Tag = href ? 'a' : 'span';
  return (
    <Tag href={href} style={{
      display: 'inline-flex', alignItems: 'center', gap: 10, padding: 4, paddingInlineEnd: 16, background: 'var(--white)',
      border: '1.5px solid var(--border-light)', borderRadius: 'var(--radius-pill)', boxShadow: 'var(--shadow-new-label)',
      fontFamily: 'var(--font-sans)', fontSize: 15, fontWeight: 500, lineHeight: 1.6, color: 'var(--fg-on-light-1)', textDecoration: 'none', ...style,
    }} {...rest}>
      <span style={{ background: 'var(--gradient-primary)', color: 'var(--white)', fontSize: 14, fontWeight: 700, lineHeight: '22px', padding: '0 10px', borderRadius: 'var(--radius-pill)', letterSpacing: '.02em' }}>{badge}</span>
      <span>{children}</span>
    </Tag>
  );
}
