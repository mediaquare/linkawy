The default Linkawy footer — every page that ends on a dark section closes with it.

```jsx
<FooterE logoSrc="assets/logos/linkawy-en-logo.svg" sunsetSrc="assets/images/sunset-dark-to-cream.png"
  cta={{ title: 'Ready to top the search results?', text: '…', label: 'Book a free consultation' }}
  description="Your strategic partner in digital growth." socials={[{ icon: 'Linkedin', label: 'LinkedIn' }]}
  columns={[{ title: 'Services', links: [{ label: 'SEO services' }] }]}
  contact={{ title: 'Contact', items: [{ icon: 'MapPin', label: 'Riyadh, Saudi Arabia' }, { icon: 'Mail', label: 'info@linkawy.io' }] }}
  copyright="© 2026 Linkawy. All rights reserved." />
```

- Order is fixed: sunset → CTA (≈176px above) → 1px #DDD7CC divider → columns → giant logo (black at 9%, faded to 0) → copyright.
- Plain cream behind the CTA — no extra glow. CTA button is dark.
