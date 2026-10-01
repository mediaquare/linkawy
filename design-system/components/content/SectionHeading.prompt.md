Standard section intro: optional eyebrow, heading, one-paragraph subtitle, optional buttons.

```jsx
<SectionHeading eyebrow="Our services" title={<>SEO services that <Highlight>sell</Highlight></>} subtitle="Custom strategies…" />
<SectionHeading level={1} display align="start" title="…" actions={<Button>Get started</Button>} />
```

- Section title 32px / display 48px, bold. English gets -1.5% / -2% tracking; Arabic none (handled by tokens under `dir="rtl"`).
- Sora is wide: give long English headings `maxWidth` ≥ 820 or drop to the section size.
- 40px between this block and the content below it (`--space-block`).
