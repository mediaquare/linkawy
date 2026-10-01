(() => {
const { Section, SectionHeading, Button, Card, CardText, IconTile, Tag, NumberBadge, FAQ, Input, Icon } = window.LinkawyDesignSystem_430d5e;
const hl = window.lkHL, grid = window.lkGrid, Frame = window.LkFrame;

function Process({ t, scrollTo }) {
  const p = t.process;
  return (
    <Section bg="white" id="process">
      <SectionHeading title={hl(p.title, p.hl)} subtitle={p.sub} maxWidth={820} />
      <div style={{ ...grid(320, 20), marginTop: 'var(--space-block)' }}>
        {p.steps.map(([label, title, body], i) => (
          <Card key={i} padding={28} style={{ gap: 18 }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}><NumberBadge>{i + 1}</NumberBadge><span style={{ fontSize: 13, fontWeight: 500, color: 'var(--text-accent)' }}>{label}</span></div>
            <CardText title={title}>{body}</CardText>
          </Card>
        ))}
      </div>
      <div style={{ display: 'flex', justifyContent: 'center', marginTop: 'var(--space-block)' }}><Button icon="ArrowRight" onClick={() => scrollTo('contact')}>{p.cta}</Button></div>
    </Section>
  );
}

function Reasons({ t }) {
  const r = t.reasons;
  return (
    <Section bg="cream">
      <SectionHeading title={hl(r.title, r.hl)} />
      <div style={{ ...grid(320, 20), marginTop: 'var(--space-block)' }}>
        {r.items.map(([title, body], i) => (
          <Card key={i} variant={i === r.highlight ? 'highlight' : 'default'} padding={28} style={{ gap: 18 }}>
            <NumberBadge variant={i === r.highlight ? 'gradient' : 'dark'}>{i + 1}</NumberBadge>
            <CardText title={title}>{body}</CardText>
          </Card>
        ))}
      </div>
    </Section>
  );
}

function Benefits({ t }) {
  const b = t.benefits;
  const [active, setActive] = React.useState(0);
  return (
    <Section bg="white">
      <SectionHeading title={hl(b.title, b.hl)} maxWidth={820} />
      <div style={{ display: 'flex', flexWrap: 'wrap', gap: 48, marginTop: 'var(--space-block)', alignItems: 'center' }}>
        <div style={{ flex: '1 1 320px', display: 'flex', flexDirection: 'column' }}>
          {b.items.map(([title, body], i) => {
            const on = i === active;
            return (
              <button key={i} type="button" onClick={() => setActive(i)} style={{ textAlign: 'start', background: 'none', border: 0, cursor: 'pointer', padding: '22px 0', fontFamily: 'var(--font-sans)', position: 'relative', borderTop: '1px solid var(--border-light)' }}>
                {on && <span style={{ position: 'absolute', top: -1, insetInline: 0, height: 2, background: 'var(--gradient-primary)' }} />}
                <span style={{ display: 'flex', alignItems: 'center', gap: 12, fontSize: 'var(--fs-card)', lineHeight: 'var(--lh-card)', fontWeight: 600, color: on ? 'var(--text-heading)' : 'var(--text-muted)' }}>
                  <span className="lk-tnum" style={{ color: on ? 'var(--orange)' : 'var(--text-muted)', fontSize: 15 }}>0{i + 1}</span>{title}
                </span>
                <div style={{ display: 'grid', gridTemplateRows: on ? '1fr' : '0fr', transition: 'grid-template-rows var(--dur-slow) var(--ease-out)' }}>
                  <p style={{ overflow: 'hidden', margin: 0, paddingTop: on ? 10 : 0, fontSize: 'var(--fs-body)', lineHeight: 'var(--lh-body)', color: 'var(--text-body)' }}>{body}</p>
                </div>
              </button>
            );
          })}
        </div>
        <div style={{ flex: '1.4 1 440px' }}><Frame src={window.LK_IMG + b.items[active][2]} alt={b.items[active][0]} ratio="4/3" fit="contain" /></div>
      </div>
    </Section>
  );
}

function Blog({ t, go }) {
  const b = t.blog;
  return (
    <Section bg="cream">
      <div style={{ display: 'flex', alignItems: 'flex-end', justifyContent: 'space-between', gap: 24, flexWrap: 'wrap' }}>
        <SectionHeading align="start" title={b.title} subtitle={b.sub} />
        <Button variant="dark" icon="ArrowRight" onClick={() => go('blog')}>{b.all}</Button>
      </div>
      <div style={{ ...grid(300, 20), marginTop: 'var(--space-block)' }}>
        {b.posts.map(([cat, title, excerpt, read, img], i) => (
          <Card key={i} padding={12} interactive onClick={() => go('blog')} style={{ gap: 0, cursor: 'pointer' }}>
            <Frame src={img} alt="" label={title} ratio="16/9" />
            <div style={{ padding: '20px 12px 12px', display: 'flex', flexDirection: 'column', gap: 12, flex: 1 }}>
              <Tag variant="accent" style={{ alignSelf: 'flex-start' }}>{cat}</Tag>
              <CardText title={title}>{excerpt}</CardText>
              <span style={{ fontSize: 13, color: 'var(--text-muted)', marginTop: 'auto' }}>{b.author} · {read}</span>
            </div>
          </Card>
        ))}
      </div>
    </Section>
  );
}

function Founder({ t, scrollTo }) {
  const f = t.founder;
  return (
    <Section bg="white">
      <div style={{ display: 'flex', flexWrap: 'wrap', gap: '40px 72px', alignItems: 'center' }}>
        <div style={{ flex: '1 1 360px' }}><Frame src={window.LK_IMG + 'ali-atwa-seo-consulting.webp'} alt={f.name} ratio="1/1" /></div>
        <div style={{ flex: '1.2 1 400px', display: 'flex', flexDirection: 'column', gap: 24 }}>
          <SectionHeading align="start" eyebrow={f.eyebrow} title={hl(f.title, f.hl)} subtitle={f.body} />
          <div style={{ display: 'flex', flexDirection: 'column' }}><strong style={{ color: 'var(--text-heading)', fontWeight: 600 }}>{f.name}</strong><span style={{ fontSize: 13, color: 'var(--text-muted)' }}>{f.role}</span></div>
          <div><Button icon="ArrowRight" onClick={() => scrollTo('contact')}>{f.cta}</Button></div>
        </div>
      </div>
    </Section>
  );
}

function Faq({ t, scrollTo }) {
  const f = t.faq;
  return (
    <Section bg="white" padTop={0}>
      <FAQ title={f.title} subtitle={f.sub} items={f.items.map(([q, a]) => ({ q, a }))} action={<Button variant="dark" icon="ArrowRight" onClick={() => scrollTo('contact')}>{f.cta}</Button>} />
    </Section>
  );
}

function Results({ t, scrollTo }) {
  const r = t.results;
  return (
    <Section bg="cream-warm">
      <SectionHeading eyebrow={r.eyebrow} title={r.title} subtitle={r.sub} />
      <div style={{ ...grid(320, 16), marginTop: 'var(--space-block)' }}>
        {[1, 2, 3, 4, 5, 6].map((n) => <Frame key={n} src={window.LK_IMG + 'results/result-' + n + '.webp'} alt="" label={(n % 2 ? 'Search Console' : 'Salla analytics') + ' screenshot'} ratio="16/10" bg="var(--white)" />)}
      </div>
      <div style={{ display: 'flex', justifyContent: 'center', marginTop: 'var(--space-block)' }}><Button icon="ArrowRight" onClick={() => scrollTo('contact')}>{r.cta}</Button></div>
    </Section>
  );
}

function Contact({ t }) {
  const c = t.contact;
  const [sent, setSent] = React.useState(false);
  return (
    <Section bg="dark" id="contact" beforeSunset>
      <div style={{ display: 'flex', flexWrap: 'wrap', gap: '40px 72px', alignItems: 'flex-start' }}>
        <div style={{ flex: '1 1 320px', display: 'flex', flexDirection: 'column', gap: 32 }}>
          <SectionHeading align="start" title={c.title} subtitle={c.sub} />
          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            {c.perks.map(([icon, label]) => <div key={label} style={{ display: 'flex', alignItems: 'center', gap: 14, color: 'var(--text-heading)', fontWeight: 500 }}><IconTile icon={icon} size={44} iconSize={20} />{label}</div>)}
          </div>
        </div>
        <Card on="dark" padding={32} style={{ flex: '1.4 1 460px' }}>
          {sent ? (
            <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', textAlign: 'center', gap: 16, padding: '48px 0' }}>
              <IconTile icon="CircleCheck" />
              <CardText title={c.ok}>{c.okSub}</CardText>
              <Button variant="outline" size="sm" onClick={() => setSent(false)}>{c.send}</Button>
            </div>
          ) : (
            <form onSubmit={(e) => { e.preventDefault(); setSent(true); }} style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(min(100%, 220px), 1fr))', gap: 16 }}>
              <Input label={c.name} required />
              <Input label={c.email} type="email" required />
              <Input label={c.phone} type="tel" inputStyle={{ direction: 'ltr', textAlign: 'start' }} />
              <Input label={c.company} />
              <Input label={c.site} placeholder="https://" inputStyle={{ direction: 'ltr' }} />
              <Input as="select" label={c.budget} placeholder={c.budgetPh} options={c.budgets} />
              <Input as="textarea" label={c.goals} rows={4} style={{ gridColumn: '1 / -1' }} />
              <div style={{ gridColumn: '1 / -1' }}><Button type="submit" size="lg" fullWidth icon="Send">{c.send}</Button></div>
            </form>
          )}
        </Card>
      </div>
    </Section>
  );
}

Object.assign(window, { HomeProcess: Process, HomeReasons: Reasons, HomeBenefits: Benefits, HomeBlog: Blog, HomeFounder: Founder, HomeFaq: Faq, HomeResults: Results, HomeContact: Contact });
})();
