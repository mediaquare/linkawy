Labeled form field for the contact form and newsletter — pill input/select, 16px-radius textarea.

```jsx
<Input label="Name" placeholder="Your full name" />
<Input as="select" label="Monthly budget" placeholder="Select" options={['< $750', '$750 – $1,500']} />
<Input as="textarea" label="Goals & challenges" rows={4} />
```

- Height 52, 1px border; focus = orange border + 3px highlight-mark ring.
- On dark sections (`data-surface="dark"`) fields become #121212 with #262626 borders.
