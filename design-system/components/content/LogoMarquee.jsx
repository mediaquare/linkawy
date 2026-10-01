import React from 'react';

export function LogoMarquee({ logos = [], tone = 'dark', height = 30, gap = 72, duration = 40, style }) {
  const filter = tone === 'light' ? 'brightness(0) invert(1)' : 'brightness(0)';
  const opacity = tone === 'light' ? 0.6 : 0.55;
  const group = (k) => (
    <div key={k} aria-hidden={k === 1 ? 'true' : undefined} style={{ display: 'flex', alignItems: 'center', gap, paddingRight: gap, flexShrink: 0 }}>
      {logos.map((l, i) => l.src
        ? <img key={i} src={l.src} alt={k === 1 ? '' : l.alt} style={{ height: l.height || height, width: 'auto', filter, opacity, display: 'block' }} />
        : <span key={i} style={{ fontFamily: 'var(--font-sans)', fontSize: Math.round((l.height || height) * 0.8), fontWeight: 700, letterSpacing: '-0.01em', whiteSpace: 'nowrap', color: tone === 'light' ? 'var(--white)' : 'var(--dark)', opacity }}>{l.label || l.alt}</span>)}
    </div>
  );
  return (
    <div style={{
      overflow: 'hidden', width: '100%',
      WebkitMaskImage: 'linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent)', maskImage: 'linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent)', ...style,
    }}>
      <div className="lk-marquee-track" style={{ display: 'flex', width: 'max-content', direction: 'ltr', animation: 'lk-marquee ' + duration + 's linear infinite' }}>
        {group(0)}{group(1)}
      </div>
    </div>
  );
}
