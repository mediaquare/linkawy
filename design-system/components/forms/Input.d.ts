import * as React from 'react';

/**
 * Form field: pill input / pill select / r16 textarea, with label. Colors follow data-surface (contact form sits on dark).
 * @startingPoint section="Forms" subtitle="Contact-form fields, light and dark" viewport="700x380"
 */
export interface InputProps {
  as?: 'input' | 'select' | 'textarea';
  label?: React.ReactNode;
  type?: string;
  placeholder?: string;
  /** For as="select": strings or {value,label} */
  options?: (string | { value: string; label: string })[];
  rows?: number;
  id?: string;
  hint?: React.ReactNode;
  error?: React.ReactNode;
  value?: string;
  defaultValue?: string;
  onChange?: (e: React.ChangeEvent<any>) => void;
  style?: React.CSSProperties;
  inputStyle?: React.CSSProperties;
}
export function Input(props: InputProps): JSX.Element;
