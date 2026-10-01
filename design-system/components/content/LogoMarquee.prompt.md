Scrolling strip of client logos ("Success partners", "Clients we've had the honor to help").

```jsx
<LogoMarquee logos={[{ src: 'https://www.linkawy.io/wp-content/themes/linkawy/assets/images/clients/dinar.svg', alt: 'Dinar' }]} />
<LogoMarquee tone="light" logos={logos} />   {/* on the dark partners section */}
```

- Logos are forced to one flat tone (`brightness(0)` at 55%) — never in color.
- Needs `tokens/base.css` (ships via styles.css) for the `lk-marquee` keyframes; respects reduced motion.
