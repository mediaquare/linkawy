(() => {
const { Section, SectionHeading, Accent, Button, Card, CardText, IconTile, BrandTile, Tag, Stat, FAQ, CTABlock, Icon } = window.LinkawyDesignSystem_430d5e;
const A = window.LK_A, hl = window.lkHL, grid = window.lkGrid, Frame = window.LkFrame;

function Crumb({ items, go }) {
  return (
    <nav style={{ display: 'flex', alignItems: 'center', gap: 8, fontSize: 13, color: 'var(--text-muted)' }}>
      {items.map((it, i) => (
        <React.Fragment key={i}>
          {i > 0 && <Icon name="ChevronRight" size={14} />}
          {it.page ? <a href="#" onClick={(e) => { e.preventDefault(); go(it.page); }} style={{ color: 'var(--text-body)' }}>{it.label}</a> : <span style={{ color: 'var(--text-heading)' }}>{it.label}</span>}
        </React.Fragment>
      ))}
    </nav>
  );
}

function ServicePage({ t, go, lang }) {
  const g = t.geo;
  return (
    <>
      <Section bg="dark" padTop={72}>
        <div style={{ display: 'flex', flexWrap: 'wrap', gap: '48px 72px', alignItems: 'center' }}>
          <div style={{ flex: '1.3 1 440px', display: 'flex', flexDirection: 'column', gap: 24 }}>
            <Crumb go={go} items={[{ label: t.nav.home, page: 'home' }, { label: g.crumb, page: 'home' }, { label: g.title }]} />
            <SectionHeading level={1} display align="start" title={<>{g.title} <Accent>{g.accent}</Accent></>} subtitle={g.sub}
              actions={<><Button size="lg" icon="ArrowRight" onClick={() => go('home', 'contact')}>{g.primary}</Button><Button size="lg" variant="outline">{g.secondary}</Button></>} />
          </div>
          <div style={{ flex: '1 1 320px', display: 'flex', flexDirection: 'column', gap: 12 }}>
            {[['google', 'Google AI Overviews'], ['chatgpt', 'ChatGPT'], ['gemini', 'Gemini'], ['perplexity', 'Perplexity'], ['claude', 'Claude']].map(([k, l]) => <BrandTile key={k} brand={k} basePath={A + 'brands/'} label={l} style={{ width: '100%' }} />)}
          </div>
        </div>
      </Section>
      <Section bg="white">
        <SectionHeading title={hl(g.whatTitle, g.hl)} />
        <div style={{ ...grid(250, 20), marginTop: 'var(--space-block)' }}>
          {g.what.map(([icon, title, body], i) => <Card key={i} padding={28} variant={i === 1 ? 'highlight' : 'default'} style={{ gap: 20 }}><IconTile icon={icon} /><CardText title={title}>{body}</CardText></Card>)}
        </div>
      </Section>
      <Section bg="cream" size="sm">
        <div style={grid(240, 20)}>
          {g.stats.map(([v, l], i) => <Card key={i} padding={28}><Stat value={v} label={l} /></Card>)}
        </div>
      </Section>
      <Section bg="white">
        <FAQ title={t.faq.title} subtitle={t.faq.sub} items={t.faq.items.slice(0, 4).map(([q, a]) => ({ q, a }))} />
      </Section>
      <CTABlock title={t.ctaB.title} text={t.ctaB.text} actionLabel={t.ctaB.label} onAction={() => go('home', 'contact')} />
    </>
  );
}

function BlogPost({ t, go }) {
  const p = t.post;
  const [active, setActive] = React.useState(0);
  return (
    <>
      <Section bg="white" padTop={64}>
        <div style={{ maxWidth: 860, display: 'flex', flexDirection: 'column', gap: 20 }}>
          <Crumb go={go} items={[{ label: t.nav.home, page: 'home' }, { label: p.crumb, page: 'blog' }, { label: p.cat }]} />
          <Tag variant="accent" style={{ alignSelf: 'flex-start' }}>{p.cat}</Tag>
          <h1 style={{ fontSize: 44, lineHeight: 'var(--lh-display)', letterSpacing: 'var(--tracking-display)', fontWeight: 700 }}>{p.title}</h1>
          <span style={{ fontSize: 13, color: 'var(--text-muted)' }}>{p.meta}</span>
        </div>
        <Frame src="https://www.linkawy.io/wp-content/uploads/Search-KPIs-400x209.png" alt="" ratio="21/9" style={{ marginTop: 'var(--space-block)' }} />
        <div style={{ display: 'flex', flexWrap: 'wrap', gap: '40px 72px', marginTop: 'var(--space-block)', alignItems: 'flex-start' }}>
          <aside style={{ flex: '0 1 260px', position: 'sticky', top: 24 }}>
            <Card padding={20} style={{ gap: 6, background: 'var(--cream)', border: '1px solid var(--border-light)' }}>
              <span style={{ fontSize: 13, fontWeight: 600, color: 'var(--text-heading)', marginBottom: 6 }}>{p.toc}</span>
              {p.sections.map(([h], i) => (
                <a key={i} href="#" onClick={(e) => { e.preventDefault(); setActive(i); }} style={{ fontSize: 14, lineHeight: 1.5, padding: '6px 0', color: i === active ? 'var(--orange)' : 'var(--text-body)', fontWeight: i === active ? 600 : 400 }}>{h}</a>
              ))}
            </Card>
          </aside>
          <article style={{ flex: '1 1 480px', maxWidth: 720, display: 'flex', flexDirection: 'column', gap: 16 }}>
            {p.sections.map(([h, body], i) => (
              <React.Fragment key={i}>
                <h2 style={{ fontSize: 26, lineHeight: 'var(--lh-section)', letterSpacing: 'var(--tracking-section)', fontWeight: 700, marginTop: i ? 24 : 0 }}>{h}</h2>
                <p style={{ fontSize: 17, lineHeight: 1.8 }}>{body}</p>
              </React.Fragment>
            ))}
          </article>
        </div>
      </Section>
      <CTABlock title={t.ctaB.title} text={t.ctaB.text} actionLabel={t.ctaB.label} onAction={() => go('home', 'contact')} />
    </>
  );
}

Object.assign(window, { ServicePage, BlogPost });
})();
