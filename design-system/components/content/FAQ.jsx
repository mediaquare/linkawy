import React, { useState } from 'react';
import { Icon } from '../core/Icon.jsx';

function Item({ q, a, open, onToggle, on }) {
  const dark = on === 'dark';
  return (
    <div style={{
      borderRadius: 'var(--radius-card)', border: '1px solid ' + (dark ? 'transparent' : 'var(--border-light)'),
      background: dark ? 'linear-gradient(var(--dark-surface),var(--dark-surface)) padding-box, var(--dark-card-edge) border-box' : 'var(--white)',
    }}>
      <button type="button" onClick={onToggle} aria-expanded={open} style={{
        display: 'flex', width: '100%', alignItems: 'center', justifyContent: 'space-between', gap: 16, padding: '20px 24px', background: 'none', border: 0,
        cursor: 'pointer', textAlign: 'start', fontFamily: 'var(--font-sans)', fontSize: 17, lineHeight: 1.5, fontWeight: 600, color: 'var(--text-heading)',
      }}>
        <span>{q}</span>
        <span style={{ display: 'flex', color: 'var(--faq-icon)', transform: open ? 'rotate(45deg)' : 'none', transition: 'transform var(--dur-base) var(--ease-out)' }}><Icon name="Plus" size={20} /></span>
      </button>
      <div style={{ display: 'grid', gridTemplateRows: open ? '1fr' : '0fr', transition: 'grid-template-rows var(--dur-slow) var(--ease-out)' }}>
        <div style={{ overflow: 'hidden' }}>
          <p style={{ padding: '0 24px 22px', fontSize: 15, lineHeight: 'var(--lh-body)', color: 'var(--text-body)' }}>{a}</p>
        </div>
      </div>
    </div>
  );
}

export function FAQ({ items = [], on = 'light', title, subtitle, eyebrow, action, defaultOpen = 0, style }) {
  const [open, setOpen] = useState(defaultOpen);
  return (
    <div style={{ display: 'flex', flexWrap: 'wrap', gap: 'var(--space-block) 64px', alignItems: 'flex-start', ...style }}>
      {(title || subtitle) && (
        <div style={{ flex: '1 1 300px', display: 'flex', flexDirection: 'column', gap: 16, position: 'sticky', top: 24 }}>
          {eyebrow && <span style={{ fontSize: 'var(--fs-small)', fontWeight: 500, color: 'var(--text-accent)' }}>{eyebrow}</span>}
          {title && <h2 style={{ fontSize: 'var(--fs-section)', lineHeight: 'var(--lh-section)', letterSpacing: 'var(--tracking-section)', fontWeight: 700, color: 'var(--text-heading)' }}>{title}</h2>}
          {subtitle && <p style={{ color: 'var(--text-body)' }}>{subtitle}</p>}
          {action && <div style={{ marginTop: 8 }}>{action}</div>}
        </div>
      )}
      <div style={{ flex: '1.7 1 460px', display: 'flex', flexDirection: 'column', gap: 12 }}>
        {items.map((it, i) => <Item key={i} q={it.q} a={it.a} on={on} open={open === i} onToggle={() => setOpen(open === i ? -1 : i)} />)}
      </div>
    </div>
  );
}
