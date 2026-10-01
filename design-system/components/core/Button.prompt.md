Pill-shaped call-to-action button; use for every clickable action on the Linkawy site.

```jsx
<Button variant="primary" icon="ArrowRight">Book a free consultation</Button>
<Button variant="dark">Request a quote</Button>          {/* on white/cream, or inside an orange block */}
<Button variant="outline">How we work</Button>           {/* on dark sections */}
```

- `variant`: `primary` (gradient-primary, white **bold** text — required for contrast), `dark`, `outline`.
- Inside an orange or gradient block (CTA block B) the button is always `dark`.
- `icon` / `iconStart` take a Lucide name; directional icons flip automatically under `dir="rtl"`.
- Sizes: `sm` 40px, `md` 48px, `lg` 56px tall. Press = scale .98 (primary also goes solid orange-deep).
