The site header that sits on top of the dark hero.

```jsx
<Header logoSrc="assets/logos/linkawy-en-logo.svg"
  links={[{ label: 'Home', active: true }, { label: 'Services', items: [{ label: 'SEO services' }, { label: 'GEO / AI SEO' }] }, { label: 'Blog' }]}
  langSwitch={{ label: 'العربية', href: '/' }} cta={{ label: 'Request a quote' }} />
```

- Logo is orange (#FF6207) on dark. Arabic version → Arabic logo only; English → English only.
- 80px tall, #0A0A0A with a 1px #262626 bottom line. Nav links #A1A1A1 → white on hover / active.
