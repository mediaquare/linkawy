import React from 'react';

/** Marker behind the key phrase of a heading — fills the lower half of the line. */
export function Highlight({ children, style, ...rest }) {
  return (
    <mark style={{
      background: 'linear-gradient(to bottom, transparent 52%, var(--highlight-mark) 52%, var(--highlight-mark) 92%, transparent 92%)',
      color: 'inherit', padding: '0 .08em', WebkitBoxDecorationBreak: 'clone', boxDecorationBreak: 'clone', ...style,
    }} {...rest}>{children}</mark>
  );
}

/** Brand-orange key words inside a heading. */
export function Accent({ children, style, ...rest }) {
  return <span style={{ color: 'var(--text-accent)', ...style }} {...rest}>{children}</span>;
}
