Frequently-asked-questions block with the question column on the leading side and a one-open-at-a-time accordion.

```jsx
<FAQ title="Frequently asked questions" subtitle="…" items={[{ q: 'How long does SEO take?', a: 'Usually 3–6 months…' }]} />
<FAQ on="dark" items={items} />
```

- Plus icon in the secondary text color rotates 45° into a close (×) when open.
- Wraps to one column under ~800px. The heading column is sticky on desktop.
