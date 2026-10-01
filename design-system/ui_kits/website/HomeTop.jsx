(() => {
const { Section, SectionHeading, NewLabel, Accent, Button, Card, CardText, IconTile, BrandTile, Tag, Sunset, NumberBadge, LogoMarquee, Icon } = window.LinkawyDesignSystem_430d5e;
const A = window.LK_A, hl = window.lkHL, grid = window.lkGrid;
// Client logo SVGs live on linkawy.io and can't be hotlinked — names in plain type until the files are supplied.
const clientLogos = ['Dinar', 'Asharq Bloomberg', 'Move', 'Alyom Digital', 'Inspire', 'Francis', 'Aswaq', 'Reef'].map((n) => ({ label: n, alt: n }));

function PlatformCard({ p, i }) {
  const [key, value, label] = p;
  return (
    <Card on="dark" variant={i === 0 ? 'highlight' : 'default'} padding={16} style={{ flexDirection: 'row', alignItems: 'center', gap: 14 }}>
      <BrandTile brand={key} basePath={A + 'brands/'} alt={label} size={44} />
      <div style={{ display: 'flex', flexDirection: 'column', minWidth: 0 }}>
        <span style={{ fontSize: 16, fontWeight: 600, color: 'var(--text-heading)', direction: 'ltr', unicodeBidi: 'isolate', textAlign: 'start' }}>{value}</span>
        <span style={{ fontSize: 13, color: 'var(--text-body)' }}>{label}</span>
      </div>
    </Card>
  );
}

function Hero({ t, scrollTo }) {
  const h = t.hero;
  return (
    <Section bg="dark" padTop={96}>
      <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 28 }}>
        <NewLabel badge={h.badge}>{h.label}</NewLabel>
        <SectionHeading level={1} display maxWidth={880} title={<>{h.pre}<Accent>{h.accent}</Accent>{h.post}</>} subtitle={h.sub}
          actions={<><Button icon="ArrowRight" size="lg" onClick={() => scrollTo('services')}>{h.primary}</Button><Button variant="outline" size="lg" onClick={() => scrollTo('process')}>{h.secondary}</Button></>} />
        <div style={{ display: 'flex', alignItems: 'center', gap: 28, flexWrap: 'wrap', justifyContent: 'center', marginTop: 8 }}>
          <span style={{ fontSize: 13, color: 'var(--text-muted)' }}>{h.clients}</span>
          {clientLogos.slice(0, 4).filter((l, i) => i !== 2).map((l) => <span key={l.alt} style={{ fontSize: 18, fontWeight: 700, color: 'var(--white)', opacity: 0.6 }}>{l.label}</span>)}
        </div>
      </div>
      <div style={{ ...grid(300, 16), marginTop: 72 }}>{h.platforms.map((p, i) => <PlatformCard key={i} p={p} i={i} />)}</div>
      <div style={{ marginTop: 40, display: 'flex', alignItems: 'center', justifyContent: 'center', gap: 12, flexWrap: 'wrap' }}>
        <span style={{ fontSize: 15, color: 'var(--text-body)', marginInlineEnd: 8 }}>{h.platformsTitle}</span>
        {['Shopify', 'Salla', 'Zid', 'WooCommerce'].map((p) => <Tag key={p}>{p + ' SEO'}</Tag>)}
      </div>
    </Section>
  );
}

function Services({ t, go, scrollTo }) {
  const s = t.services;
  return (
    <Section bg="white" id="services">
      <SectionHeading eyebrow={s.eyebrow} title={hl(s.title, s.hl)} subtitle={s.sub} />
      <div style={{ ...grid(250, 20), marginTop: 'var(--space-block)' }}>
        {s.items.map(([icon, title, tag, body], i) => {
          const key = i === s.items.length - 1;
          return (
            <Card key={i} variant={key ? 'highlight' : 'default'} interactive onClick={() => key && go('service')} padding={28} style={{ gap: 20, cursor: key ? 'pointer' : 'default' }}>
              <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 12 }}><IconTile icon={icon} /><Tag variant={key ? 'accent' : 'neutral'}>{tag}</Tag></div>
              <CardText title={title}>{body}</CardText>
              {key && <span style={{ display: 'inline-flex', alignItems: 'center', gap: 6, color: 'var(--orange)', fontWeight: 600, fontSize: 14, marginTop: 'auto' }}>{t.nav.services} <Icon name="ArrowRight" size={16} /></span>}
            </Card>
          );
        })}
      </div>
      <div style={{ display: 'flex', justifyContent: 'center', marginTop: 'var(--space-block)' }}><Button variant="dark" icon="ArrowRight" onClick={() => scrollTo('contact')}>{s.cta}</Button></div>
    </Section>
  );
}

function Proof({ t }) {
  const p = t.proof;
  return (
    <>
      <Section bg="cream" padBottom={24}>
        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', textAlign: 'center', gap: 20, maxWidth: 900, marginInline: 'auto' }}>
          <span style={{ fontSize: 13, fontWeight: 500, color: 'var(--text-accent)' }}>{p.label}</span>
          <h2 style={{ fontSize: 'var(--fs-section)', lineHeight: 'var(--lh-section)', letterSpacing: 'var(--tracking-section)', fontWeight: 700 }}>{p.pre}<Accent>{p.num}</Accent>{p.post}</h2>
          <div style={{ display: 'flex', gap: 12 }}><BrandTile brand="google" basePath={A + 'brands/'} label="Google" /><BrandTile brand="chatgpt" basePath={A + 'brands/'} label="ChatGPT" /></div>
        </div>
      </Section>
      <Sunset src={A + 'images/sunset-cream-to-dark.png'} />
    </>
  );
}

function Strategy({ t }) {
  const s = t.strategy;
  return (
    <Section bg="dark" padTop={24} padBottom={80}>
      <div style={{ display: 'flex', flexWrap: 'wrap', gap: '40px 72px', alignItems: 'flex-start' }}>
        <div style={{ flex: '1 1 320px', position: 'sticky', top: 24 }}><SectionHeading align="start" title={hl(s.title, s.hl)} subtitle={s.sub} /></div>
        <div style={{ flex: '1.5 1 460px', display: 'flex', flexDirection: 'column', gap: 14 }}>
          {s.steps.map(([title, body], i) => (
            <Card key={i} on="dark" variant={i === s.steps.length - 1 ? 'highlight' : 'default'} padding={24} style={{ flexDirection: 'row', gap: 20, alignItems: 'flex-start' }}>
              <NumberBadge variant={i === s.steps.length - 1 ? 'dark' : 'gradient'}>{String(i + 1).padStart(2, '0')}</NumberBadge>
              <CardText title={title}>{body}</CardText>
            </Card>
          ))}
        </div>
      </div>
    </Section>
  );
}

function Partners({ t, go }) {
  const p = t.partners, posts = t.blog.posts;
  return (
    <Section bg="dark" padTop={40}>
      <h2 style={{ textAlign: 'center', fontSize: 'var(--fs-section)', lineHeight: 'var(--lh-section)', letterSpacing: 'var(--tracking-section)', fontWeight: 700, marginBottom: 'var(--space-block)' }}>{p.title}</h2>
      <LogoMarquee tone="light" logos={clientLogos} />
      <div style={{ display: 'flex', alignItems: 'flex-end', justifyContent: 'space-between', gap: 16, marginTop: 'var(--space-section-sm)', marginBottom: 24, flexWrap: 'wrap' }}>
        <h3 style={{ fontSize: 24, fontWeight: 700, letterSpacing: 'var(--tracking-section)' }}>{p.stories}</h3>
        <Button variant="outline" size="sm" icon="ArrowRight" onClick={() => go('blog')}>{p.more}</Button>
      </div>
      <div style={grid(300, 16)}>
        {posts.map(([cat, title, , read], i) => (
          <Card key={i} on="dark" padding={24} interactive onClick={() => go('blog')} style={{ gap: 16, cursor: 'pointer' }}>
            <Tag>{cat}</Tag><CardText title={title} />
            <span style={{ display: 'inline-flex', alignItems: 'center', gap: 6, fontSize: 13, color: 'var(--text-muted)', marginTop: 'auto' }}><Icon name="Clock" size={14} />{read}</span>
          </Card>
        ))}
      </div>
    </Section>
  );
}

Object.assign(window, { HomeHero: Hero, HomeServices: Services, HomeProof: Proof, HomeStrategy: Strategy, HomePartners: Partners });
})();
