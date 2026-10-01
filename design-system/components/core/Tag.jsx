import React from 'react';
import { Icon } from './Icon.jsx';

/** Category / meta pill. Always an outline pill — never gradient (gradient is only for buttons, the NEW badge and CTA block B). */
export function Tag({ variant = 'neutral', icon, children, style, ...rest }) {
  return (
    <span style={{
      display: 'inline-flex', alignSelf: 'flex-start', alignItems: 'center', gap: 6, height: 30, padding: '0 12px',
      borderRadius: 'var(--radius-pill)', fontFamily: 'var(--font-sans)', whiteSpace: 'nowrap', lineHeight: 1, fontSize: 13, fontWeight: 500,
      background: 'var(--tag-bg)', border: '1px solid var(--tag-border)', color: variant === 'accent' ? 'var(--orange)' : 'var(--tag-fg)', ...style,
    }} {...rest}>{icon && <Icon name={icon} size={14} />}{children}</span>
  );
}
