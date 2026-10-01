import React, { useState } from 'react';
import { Icon } from '../core/Icon.jsx';

export function Input({ as = 'input', label, options = [], placeholder, rows = 4, id, hint, error, value, defaultValue, onChange, type = 'text', style, inputStyle, ...rest }) {
  const [focus, setFocus] = useState(false);
  const fid = id || (label ? 'f-' + String(label).replace(/\s+/g, '-') : undefined);
  const base = {
    width: '100%', fontFamily: 'var(--font-sans)', fontSize: 15, lineHeight: 1.5, color: 'var(--input-fg)', background: 'var(--input-bg)',
    border: '1px solid ' + (error ? 'var(--orange)' : focus ? 'var(--orange)' : 'var(--input-border)'), outline: 'none',
    boxShadow: focus ? '0 0 0 3px var(--highlight-mark)' : 'none', transition: 'border-color var(--dur-fast), box-shadow var(--dur-fast)', ...inputStyle,
  };
  const pill = { ...base, height: 52, padding: '0 22px', borderRadius: 'var(--radius-pill)' };
  const ev = { onFocus: () => setFocus(true), onBlur: () => setFocus(false), onChange, value, defaultValue, id: fid };
  let field;
  if (as === 'textarea') field = <textarea className="lk-input" rows={rows} placeholder={placeholder} style={{ ...base, padding: '16px 22px', borderRadius: 'var(--radius-card)', resize: 'vertical' }} {...ev} {...rest} />;
  else if (as === 'select') field = (
    <div style={{ position: 'relative' }}>
      <select className="lk-input" style={{ ...pill, appearance: 'none', WebkitAppearance: 'none', paddingInlineEnd: 48, cursor: 'pointer' }} {...ev} {...rest}>
        {placeholder && <option value="">{placeholder}</option>}
        {options.map((o) => <option key={o.value ?? o} value={o.value ?? o}>{o.label ?? o}</option>)}
      </select>
      <span style={{ position: 'absolute', insetInlineEnd: 20, top: '50%', transform: 'translateY(-50%)', pointerEvents: 'none', color: 'var(--input-placeholder)' }}><Icon name="ChevronDown" size={18} /></span>
    </div>
  );
  else field = <input className="lk-input" type={type} placeholder={placeholder} style={pill} {...ev} {...rest} />;
  return (
    <label htmlFor={fid} style={{ display: 'flex', flexDirection: 'column', gap: 8, ...style }}>
      {label && <span style={{ fontSize: 'var(--fs-small)', fontWeight: 500, color: 'var(--text-heading)' }}>{label}</span>}
      {field}
      {(error || hint) && <span style={{ fontSize: 'var(--fs-small)', color: error ? 'var(--orange)' : 'var(--text-muted)' }}>{error || hint}</span>}
    </label>
  );
}
