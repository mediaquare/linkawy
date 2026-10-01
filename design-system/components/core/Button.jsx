import React, { useState } from 'react';
import { Icon } from './Icon.jsx';

const SIZES = { sm: { h: 40, px: 18, fs: 14, ic: 16 }, md: { h: 48, px: 24, fs: 15, ic: 18 }, lg: { h: 56, px: 30, fs: 16, ic: 20 } };

function variantStyle(variant, hover, press) {
  switch (variant) {
    case 'dark':
      return { background: hover ? 'var(--dark-border)' : 'var(--dark)', color: 'var(--white)', border: '1px solid transparent', fontWeight: 600 };
    case 'outline':
      return { background: hover ? 'var(--glass-dark)' : 'transparent', color: 'var(--white)', border: '1px solid ' + (hover ? 'var(--fg-on-dark-3)' : 'var(--dark-border)'), fontWeight: 600 };
    default:
      return {
        background: press ? 'var(--orange-deep)' : 'var(--gradient-primary)', color: 'var(--white)', border: '1px solid transparent', fontWeight: 700,
        boxShadow: hover && !press ? 'var(--shadow-exceptional)' : 'none',
      };
  }
}

export function Button({ variant = 'primary', size = 'md', icon, iconStart, href, disabled, fullWidth, type = 'button', children, style, onClick, ...rest }) {
  const [hover, setHover] = useState(false);
  const [press, setPress] = useState(false);
  const s = SIZES[size] || SIZES.md;
  const Tag = href ? 'a' : 'button';
  const css = {
    display: fullWidth ? 'flex' : 'inline-flex', width: fullWidth ? '100%' : undefined, alignItems: 'center', justifyContent: 'center', gap: 10,
    height: s.h, padding: '0 ' + s.px + 'px', borderRadius: 'var(--radius-pill)', fontFamily: 'var(--font-sans)', fontSize: s.fs, lineHeight: 1,
    letterSpacing: 0, whiteSpace: 'nowrap', cursor: disabled ? 'not-allowed' : 'pointer', textDecoration: 'none', opacity: disabled ? 0.45 : 1,
    transform: press && !disabled ? 'scale(.98)' : 'none',
    transition: 'background var(--dur-fast) var(--ease-out), box-shadow var(--dur-base) var(--ease-out), transform var(--dur-fast) var(--ease-out), border-color var(--dur-fast)',
    ...variantStyle(variant, hover && !disabled, press && !disabled), ...style,
  };
  return (
    <Tag href={href} type={href ? undefined : type} disabled={href ? undefined : disabled} onClick={disabled ? undefined : onClick} style={css}
      onMouseEnter={() => setHover(true)} onMouseLeave={() => { setHover(false); setPress(false); }}
      onMouseDown={() => setPress(true)} onMouseUp={() => setPress(false)} {...rest}>
      {iconStart && <Icon name={iconStart} size={s.ic} />}
      <span>{children}</span>
      {icon && <Icon name={icon} size={s.ic} />}
    </Tag>
  );
}
