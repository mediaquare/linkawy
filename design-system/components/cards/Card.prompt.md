The container for any content block — services, reasons, steps, blog posts, pricing.

```jsx
<Card><IconTile icon="Search" /><CardText title="Technical SEO">Speed, crawling, indexing…</CardText></Card>
<Card on="dark">…</Card>
<Card variant="highlight">…</Card>               {/* dark card on a light section */}
<Card on="dark" variant="highlight">…</Card>     {/* orange card on a dark section */}
<Card variant="exceptional">…</Card>             {/* pricing / main offer, once per page */}
```

- Light: white, 1px #E8E2D8, r16, no shadow. Dark: #121212 with the 1px `--dark-card-edge` gradient edge.
- The card sets `data-surface`, so `CardText`, `Tag`, `Stat`, `Accent` inside it recolor automatically.
- One highlighted card per section. `highlight-orange` on light only when explicitly requested.
- Put a gap of 24px between tile, text and actions inside the card (`style={{gap:24}}`).
