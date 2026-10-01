(() => {
const { Header, FooterE, Highlight } = window.LinkawyDesignSystem_430d5e;
const A = '../../assets/';

// Wrap one key phrase of a heading in the highlighter mark
function hl(title, phrase) {
  if (!phrase || title.indexOf(phrase) < 0) return title;
  const i = title.indexOf(phrase);
  return <>{title.slice(0, i)}<Highlight>{phrase}</Highlight>{title.slice(i + phrase.length)}</>;
}

const grid = (min, gap = 24) => ({ display: 'grid', gridTemplateColumns: `repeat(auto-fit, minmax(min(100%, ${min}px), 1fr))`, gap });

// Image frame (r16). Real photos/screenshots live on linkawy.io; when they can't load, a labeled placeholder shows instead.
function Frame({ src, alt = '', label, ratio = '16/10', bg = 'var(--cream)', style, fit = 'cover' }) {
  // Remote linkawy.io images block hotlinking, so they render as labeled placeholders; local files load normally.
  const [failed, setFailed] = React.useState(!src || /^https?:/.test(src));
  return (
    <div style={{ position: 'relative', borderRadius: 'var(--radius-card)', overflow: 'hidden', background: bg, border: '1px solid var(--border-card)', aspectRatio: ratio, ...style }}>
      {!failed && <img src={src} alt={alt} onError={() => setFailed(true)} style={{ width: '100%', height: '100%', objectFit: fit, display: 'block' }} />}
      {failed && <div style={{ position: 'absolute', inset: 0, display: 'flex', alignItems: 'center', justifyContent: 'center', padding: 16, textAlign: 'center', fontSize: 13, color: 'var(--text-muted)', backgroundImage: 'repeating-linear-gradient(135deg, transparent 0 14px, rgba(0,0,0,.025) 14px 15px)' }}>{label || alt || 'Image'}</div>}
    </div>
  );
}

function SiteHeader({ t, lang, page, go, toggleLang }) {
  const n = t.nav;
  return (
    <Header logoSrc={A + 'logos/linkawy-' + lang + '-logo.svg'} logoAlt={lang === 'ar' ? 'لينكاوي' : 'Linkawy'}
      onNavigate={(it) => go(it.page || 'home')}
      links={[
        { label: n.home, page: 'home', active: page === 'home' },
        { label: n.services, active: page === 'service', items: n.serviceItems.map((s, i) => ({ label: s, page: i === 2 ? 'service' : 'service' })) },
        { label: n.blog, page: 'blog', active: page === 'blog' },
        { label: n.resources, page: 'home' },
        { label: n.learn, page: 'home' },
      ]}
      langSwitch={{ label: n.lang, onClick: toggleLang }}
      cta={{ label: n.quote, onClick: () => go('home', 'contact') }} />
  );
}

function SiteFooter({ t, lang, withCta = true, go }) {
  const f = t.footer;
  return (
    <FooterE logoSrc={A + 'logos/linkawy-' + lang + '-logo.svg'} sunsetSrc={withCta ? A + 'images/sunset-dark-to-cream.png' : undefined}
      cta={withCta ? { title: f.ctaTitle, text: f.ctaText, label: f.ctaLabel, onClick: () => go('home', 'contact') } : undefined}
      description={f.desc}
      socials={[{ icon: 'Linkedin', label: 'LinkedIn' }, { icon: 'Youtube', label: 'YouTube' }, { icon: 'Facebook', label: 'Facebook' }, { icon: 'MessageCircle', label: 'WhatsApp' }]}
      columns={f.cols.map(([title, links]) => ({ title, links: links.map((l) => ({ label: l })) }))}
      contact={{ title: f.contactTitle, items: [{ icon: 'MapPin', label: f.location }, { icon: 'Mail', label: f.email, href: 'mailto:info@linkawy.io' }] }}
      copyright={f.copyright}
      style={withCta ? undefined : { paddingTop: 64 }} />
  );
}

Object.assign(window, { lkHL: hl, lkGrid: grid, LkFrame: Frame, SiteHeader, SiteFooter, LK_A: A });
})();
