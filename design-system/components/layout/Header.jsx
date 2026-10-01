import React, { useState } from 'react';
import { Icon } from '../core/Icon.jsx';
import { Button } from '../core/Button.jsx';

function NavItem({ item, onNavigate }) {
  const [open, setOpen] = useState(false);
  const [hover, setHover] = useState(false);
  const has = item.items && item.items.length;
  return (
    <div style={{ position: 'relative' }} onMouseEnter={() => { setHover(true); has && setOpen(true); }} onMouseLeave={() => { setHover(false); setOpen(false); }}>
      <a href={item.href || '#'} onClick={(e) => { if (onNavigate) { e.preventDefault(); onNavigate(item); } }} style={{
        display: 'inline-flex', alignItems: 'center', gap: 6, height: 40, padding: '0 14px', borderRadius: 'var(--radius-pill)', fontSize: 15, fontWeight: 500, whiteSpace: 'nowrap',
        color: item.active || hover ? 'var(--fg-on-dark-1)' : 'var(--fg-on-dark-2)', background: item.active ? 'var(--dark-surface)' : 'transparent', textDecoration: 'none', transition: 'color var(--dur-fast)',
      }}>{item.label}{has ? <Icon name="ChevronDown" size={16} /> : null}</a>
      {has && open && (
        <div style={{ position: 'absolute', top: '100%', insetInlineStart: 0, paddingTop: 10, zIndex: 20 }}>
          <div style={{ minWidth: 260, padding: 8, borderRadius: 'var(--radius-card)', background: 'linear-gradient(var(--dark-surface),var(--dark-surface)) padding-box, var(--dark-card-edge) border-box', border: '1px solid transparent', display: 'flex', flexDirection: 'column' }}>
            {item.items.map((s, i) => (
              <a key={i} href={s.href || '#'} onClick={(e) => { if (onNavigate) { e.preventDefault(); onNavigate(s); } }} style={{ padding: '10px 14px', borderRadius: 10, fontSize: 14, color: 'var(--fg-on-dark-2)', textDecoration: 'none' }}
                onMouseEnter={(e) => { e.currentTarget.style.color = 'var(--fg-on-dark-1)'; e.currentTarget.style.background = 'var(--dark-tile-inner)'; }}
                onMouseLeave={(e) => { e.currentTarget.style.color = 'var(--fg-on-dark-2)'; e.currentTarget.style.background = 'transparent'; }}>{s.label}</a>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}

export function Header({ logoSrc, logoAlt = 'Linkawy', logoHref = '#', links = [], cta, langSwitch, onNavigate, style }) {
  return (
    <header data-surface="dark" style={{ position: 'relative', zIndex: 10, background: 'var(--dark)', borderBottom: '1px solid var(--dark-border)', ...style }}>
      <div style={{ maxWidth: 'var(--content-max)', marginInline: 'auto', paddingInline: 'var(--gutter)', boxSizing: 'content-box', height: 80, display: 'flex', alignItems: 'center', gap: 32 }}>
        <a href={logoHref} onClick={(e) => { if (onNavigate) { e.preventDefault(); onNavigate({ href: logoHref, home: true }); } }} style={{ display: 'flex', flexShrink: 0 }}>
          <img src={logoSrc} alt={logoAlt} style={{ height: 34, width: 'auto', display: 'block' }} />
        </a>
        <nav style={{ display: 'flex', alignItems: 'center', gap: 2, flex: 1, minWidth: 0 }}>
          {links.map((l, i) => <NavItem key={i} item={l} onNavigate={onNavigate} />)}
        </nav>
        <div style={{ display: 'flex', alignItems: 'center', gap: 12, flexShrink: 0 }}>
          {langSwitch && (
            <a href={langSwitch.href || '#'} onClick={(e) => { if (langSwitch.onClick) { e.preventDefault(); langSwitch.onClick(); } }} style={{ display: 'inline-flex', alignItems: 'center', gap: 6, fontSize: 14, fontWeight: 500, color: 'var(--fg-on-dark-2)', textDecoration: 'none' }}>
              <Icon name="Languages" size={18} />{langSwitch.label}
            </a>
          )}
          {cta && <Button size="sm" href={cta.href} onClick={cta.onClick}>{cta.label}</Button>}
        </div>
      </div>
    </header>
  );
}
