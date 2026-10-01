import React from 'react';
import { Button } from '../core/Button.jsx';
import { Icon } from '../core/Icon.jsx';
import { Sunset } from '../layout/Sunset.jsx';

function Social({ s }) {
  return (
    <a href={s.href || '#'} aria-label={s.label} style={{ width: 40, height: 40, borderRadius: 999, border: '1px solid var(--divider-footer)', display: 'inline-flex', alignItems: 'center', justifyContent: 'center', color: 'var(--fg-on-light-2)', background: 'var(--white)' }}
      onMouseEnter={(e) => { e.currentTarget.style.color = 'var(--orange)'; }} onMouseLeave={(e) => { e.currentTarget.style.color = 'var(--fg-on-light-2)'; }}>
      <Icon name={s.icon} size={18} />
    </a>
  );
}

const colTitle = { fontSize: 14, fontWeight: 600, color: 'var(--text-heading)', marginBottom: 18 };
const linkCss = { fontSize: 15, lineHeight: 1.5, color: 'var(--text-body)', textDecoration: 'none' };

export function FooterE({ logoSrc, logoAlt = 'Linkawy', sunsetSrc, description, socials = [], columns = [], contact, cta, copyright, style }) {
  return (
    <footer data-surface="cream" style={{ background: 'var(--cream)', color: 'var(--text-body)', ...style }}>
      {sunsetSrc && <Sunset variant="dark-to-cream" src={sunsetSrc} />}
      {cta && (
        <div style={{ padding: 'var(--space-footer-cta) var(--gutter) var(--space-section)', display: 'flex', flexDirection: 'column', alignItems: 'center', textAlign: 'center', gap: 16 }}>
          <h2 style={{ fontSize: 'var(--fs-section)', lineHeight: 'var(--lh-section)', letterSpacing: 'var(--tracking-section)', fontWeight: 700, color: 'var(--text-heading)', maxWidth: 760 }}>{cta.title}</h2>
          {cta.text && <p style={{ fontSize: 17, color: 'var(--text-body)', maxWidth: 620 }}>{cta.text}</p>}
          <div style={{ marginTop: 8 }}><Button variant="dark" size="lg" icon="ArrowRight" href={cta.href} onClick={cta.onClick}>{cta.label}</Button></div>
        </div>
      )}
      <div style={{ maxWidth: 'var(--content-max)', marginInline: 'auto', paddingInline: 'var(--gutter)', boxSizing: 'content-box' }}>
        <div style={{ borderTop: '1px solid var(--divider-footer)', paddingTop: 64, display: 'flex', flexWrap: 'wrap', gap: '40px 48px' }}>
          <div style={{ flex: '1.6 1 280px', display: 'flex', flexDirection: 'column', gap: 20, maxWidth: 360 }}>
            <img src={logoSrc} alt={logoAlt} style={{ height: 34, width: 'auto', alignSelf: 'flex-start' }} />
            {description && <p style={{ fontSize: 15, lineHeight: 1.7 }}>{description}</p>}
            {socials.length > 0 && <div style={{ display: 'flex', gap: 10 }}>{socials.map((s, i) => <Social key={i} s={s} />)}</div>}
          </div>
          {columns.map((c, i) => (
            <div key={i} style={{ flex: '1 1 140px' }}>
              <div style={colTitle}>{c.title}</div>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 12 }}>
                {c.links.map((l, j) => <a key={j} href={l.href || '#'} style={linkCss}
                  onMouseEnter={(e) => { e.currentTarget.style.color = 'var(--text-heading)'; }} onMouseLeave={(e) => { e.currentTarget.style.color = 'var(--text-body)'; }}>{l.label}</a>)}
              </div>
            </div>
          ))}
          {contact && (
            <div style={{ flex: '1 1 160px' }}>
              <div style={colTitle}>{contact.title}</div>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 12 }}>
                {contact.items.map((it, j) => (
                  <a key={j} href={it.href || '#'} style={{ ...linkCss, display: 'inline-flex', alignItems: 'center', gap: 8 }}>
                    <Icon name={it.icon} size={16} color="var(--orange)" /><span>{it.label}</span>
                  </a>
                ))}
              </div>
            </div>
          )}
        </div>
        <div aria-hidden="true" style={{ marginTop: 72, WebkitMaskImage: 'linear-gradient(to bottom, #000, transparent 92%)', maskImage: 'linear-gradient(to bottom, #000, transparent 92%)' }}>
          <img src={logoSrc} alt="" style={{ display: 'block', width: '100%', height: 'auto', filter: 'brightness(0)', opacity: 0.09 }} />
        </div>
        <div style={{ padding: '24px 0 32px', fontSize: 'var(--fs-small)', color: 'var(--text-muted)', display: 'flex', justifyContent: 'space-between', flexWrap: 'wrap', gap: 12 }}>
          <span>{copyright}</span>
        </div>
      </div>
    </footer>
  );
}
