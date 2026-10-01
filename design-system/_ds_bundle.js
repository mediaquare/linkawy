/* @ds-bundle: {"format":4,"namespace":"LinkawyDesignSystem_430d5e","components":[{"name":"CTABlock","sourcePath":"components/blocks/CTABlock.jsx"},{"name":"FooterE","sourcePath":"components/blocks/FooterE.jsx"},{"name":"Card","sourcePath":"components/cards/Card.jsx"},{"name":"CardText","sourcePath":"components/cards/Card.jsx"},{"name":"Glass","sourcePath":"components/cards/Glass.jsx"},{"name":"Stat","sourcePath":"components/cards/Stat.jsx"},{"name":"FAQ","sourcePath":"components/content/FAQ.jsx"},{"name":"LogoMarquee","sourcePath":"components/content/LogoMarquee.jsx"},{"name":"SectionHeading","sourcePath":"components/content/SectionHeading.jsx"},{"name":"Button","sourcePath":"components/core/Button.jsx"},{"name":"Highlight","sourcePath":"components/core/Highlight.jsx"},{"name":"Accent","sourcePath":"components/core/Highlight.jsx"},{"name":"Icon","sourcePath":"components/core/Icon.jsx"},{"name":"ICON_NAMES","sourcePath":"components/core/Icon.jsx"},{"name":"NewLabel","sourcePath":"components/core/NewLabel.jsx"},{"name":"NumberBadge","sourcePath":"components/core/NumberBadge.jsx"},{"name":"Tag","sourcePath":"components/core/Tag.jsx"},{"name":"Input","sourcePath":"components/forms/Input.jsx"},{"name":"Header","sourcePath":"components/layout/Header.jsx"},{"name":"Section","sourcePath":"components/layout/Section.jsx"},{"name":"Sunset","sourcePath":"components/layout/Sunset.jsx"},{"name":"BRAND_LOGOS","sourcePath":"components/tiles/BrandTile.jsx"},{"name":"BrandTile","sourcePath":"components/tiles/BrandTile.jsx"},{"name":"IconTile","sourcePath":"components/tiles/IconTile.jsx"}],"sourceHashes":{"components/blocks/CTABlock.jsx":"b10e0cd21311","components/blocks/FooterE.jsx":"af9efa01ee74","components/cards/Card.jsx":"b72d87fffe9b","components/cards/Glass.jsx":"a9c7e05e8bcf","components/cards/Stat.jsx":"3bd785f1fa0a","components/content/FAQ.jsx":"ace9d5917315","components/content/LogoMarquee.jsx":"a6a1c82ff57c","components/content/SectionHeading.jsx":"2d79017925e1","components/core/Button.jsx":"f3bb127e2e68","components/core/Highlight.jsx":"fe1cf41ed811","components/core/Icon.jsx":"703bf58d47f6","components/core/NewLabel.jsx":"3b80ea1e9a3c","components/core/NumberBadge.jsx":"40784fd6c399","components/core/Tag.jsx":"20bf055c23df","components/forms/Input.jsx":"0c37958e358f","components/layout/Header.jsx":"fd4b1f6aab82","components/layout/Section.jsx":"143dfb186daa","components/layout/Sunset.jsx":"0925a8fb9aa7","components/tiles/BrandTile.jsx":"15cb048a94f4","components/tiles/IconTile.jsx":"280266ed3656","ui_kits/website/Chrome.jsx":"bca84a61f9a6","ui_kits/website/HomeBottom.jsx":"c481256f50b3","ui_kits/website/HomeTop.jsx":"2251080a99d3","ui_kits/website/Pages.jsx":"ff88cdf2177d","ui_kits/website/content.js":"f37bf413c6c2"},"inlinedExternals":[],"unexposedExports":[]} */

(() => {

const __ds_ns = (window.LinkawyDesignSystem_430d5e = window.LinkawyDesignSystem_430d5e || {});

const __ds_scope = {};

(__ds_ns.__errors = __ds_ns.__errors || []);

// components/cards/Card.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const {
  useState
} = React;
function look(on, variant) {
  if (variant === 'exceptional') return {
    surface: 'white',
    css: {
      background: 'var(--white)',
      border: '1px solid var(--border-light)',
      boxShadow: 'var(--shadow-exceptional)'
    }
  };
  if (variant === 'highlight' && on === 'dark') return {
    surface: 'orange',
    css: {
      background: 'var(--gradient-highlight-card)',
      border: '1px solid transparent'
    }
  };
  if (variant === 'highlight-orange') return {
    surface: 'orange',
    css: {
      background: 'var(--gradient-highlight-card)',
      border: '1px solid transparent'
    }
  };
  if (variant === 'highlight') return {
    surface: 'dark',
    css: {
      background: 'var(--dark)',
      border: '1px solid var(--dark)'
    }
  };
  if (on === 'dark') return {
    surface: undefined,
    css: {
      background: 'linear-gradient(var(--dark-surface),var(--dark-surface)) padding-box, var(--dark-card-edge) border-box',
      border: '1px solid transparent'
    }
  };
  return {
    surface: undefined,
    css: {
      background: 'var(--white)',
      border: '1px solid var(--border-light)'
    }
  };
}
function Card({
  on = 'light',
  variant = 'default',
  padding = 32,
  interactive = false,
  href,
  children,
  style,
  ...rest
}) {
  const [hover, setHover] = useState(false);
  const {
    surface,
    css
  } = look(on, variant);
  const Tag = href ? 'a' : 'div';
  return /*#__PURE__*/React.createElement(Tag, _extends({
    href: href,
    "data-surface": surface,
    onMouseEnter: interactive ? () => setHover(true) : undefined,
    onMouseLeave: interactive ? () => setHover(false) : undefined,
    style: {
      display: 'flex',
      flexDirection: 'column',
      position: 'relative',
      borderRadius: 'var(--radius-card)',
      padding,
      color: 'var(--text-body)',
      textDecoration: 'none',
      transition: 'transform var(--dur-base) var(--ease-out)',
      transform: hover ? 'translateY(-3px)' : 'none',
      ...css,
      ...style
    }
  }, rest), children);
}

/** Card title + body pair (20px/600 title, 16px body) — reads colors from the card's surface. */
function CardText({
  title,
  children,
  style
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 10,
      ...style
    }
  }, title && /*#__PURE__*/React.createElement("h3", {
    style: {
      fontSize: 'var(--fs-card)',
      lineHeight: 'var(--lh-card)',
      fontWeight: 600,
      letterSpacing: 'var(--tracking-card)',
      color: 'var(--text-heading)'
    }
  }, title), children && /*#__PURE__*/React.createElement("p", {
    style: {
      fontSize: 'var(--fs-body)',
      lineHeight: 'var(--lh-body)',
      color: 'var(--text-body)'
    }
  }, children));
}
Object.assign(__ds_scope, { Card, CardText });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/cards/Card.jsx", error: String((e && e.message) || e) }); }

// components/cards/Glass.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Glass panel — ONLY over glowing or busy art (the sunset, gradient art). Never on flat backgrounds. */
function Glass({
  tone = 'dark',
  strong = false,
  padding = 28,
  children,
  style,
  ...rest
}) {
  const dark = tone === 'dark';
  return /*#__PURE__*/React.createElement("div", _extends({
    "data-surface": dark ? 'dark' : 'white',
    style: {
      position: 'relative',
      borderRadius: 'var(--radius-card)',
      padding,
      background: dark ? 'var(--glass-dark)' : strong ? 'var(--glass-light-strong)' : 'var(--glass-light)',
      border: '1px solid ' + (dark ? 'var(--glass-dark-border)' : 'var(--glass-light-strong)'),
      backdropFilter: 'blur(var(--glass-blur))',
      WebkitBackdropFilter: 'blur(var(--glass-blur))',
      ...style
    }
  }, rest), children);
}
Object.assign(__ds_scope, { Glass });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/cards/Glass.jsx", error: String((e && e.message) || e) }); }

// components/cards/Stat.jsx
try { (() => {
const SIZE = {
  sm: 'var(--fs-number-sm)',
  md: 'var(--fs-number-md)',
  lg: 'var(--fs-number-lg)'
};
function Stat({
  value,
  label,
  size = 'lg',
  gradient = false,
  align = 'start',
  style
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 8,
      alignItems: align === 'center' ? 'center' : 'flex-start',
      textAlign: align === 'center' ? 'center' : 'start',
      ...style
    }
  }, /*#__PURE__*/React.createElement("span", {
    className: "lk-tnum",
    style: {
      fontSize: SIZE[size] || SIZE.lg,
      lineHeight: 'var(--lh-number)',
      fontWeight: 700,
      letterSpacing: 'var(--tracking-display)',
      direction: 'ltr',
      unicodeBidi: 'isolate',
      ...(gradient ? {
        background: 'var(--gradient-primary)',
        WebkitBackgroundClip: 'text',
        backgroundClip: 'text',
        color: 'transparent'
      } : {
        color: 'var(--text-accent)'
      })
    }
  }, value), label && /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 15,
      lineHeight: 1.5,
      color: 'var(--text-body)'
    }
  }, label));
}
Object.assign(__ds_scope, { Stat });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/cards/Stat.jsx", error: String((e && e.message) || e) }); }

// components/content/LogoMarquee.jsx
try { (() => {
function LogoMarquee({
  logos = [],
  tone = 'dark',
  height = 30,
  gap = 72,
  duration = 40,
  style
}) {
  const filter = tone === 'light' ? 'brightness(0) invert(1)' : 'brightness(0)';
  const opacity = tone === 'light' ? 0.6 : 0.55;
  const group = k => /*#__PURE__*/React.createElement("div", {
    key: k,
    "aria-hidden": k === 1 ? 'true' : undefined,
    style: {
      display: 'flex',
      alignItems: 'center',
      gap,
      paddingRight: gap,
      flexShrink: 0
    }
  }, logos.map((l, i) => l.src ? /*#__PURE__*/React.createElement("img", {
    key: i,
    src: l.src,
    alt: k === 1 ? '' : l.alt,
    style: {
      height: l.height || height,
      width: 'auto',
      filter,
      opacity,
      display: 'block'
    }
  }) : /*#__PURE__*/React.createElement("span", {
    key: i,
    style: {
      fontFamily: 'var(--font-sans)',
      fontSize: Math.round((l.height || height) * 0.8),
      fontWeight: 700,
      letterSpacing: '-0.01em',
      whiteSpace: 'nowrap',
      color: tone === 'light' ? 'var(--white)' : 'var(--dark)',
      opacity
    }
  }, l.label || l.alt)));
  return /*#__PURE__*/React.createElement("div", {
    style: {
      overflow: 'hidden',
      width: '100%',
      WebkitMaskImage: 'linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent)',
      maskImage: 'linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent)',
      ...style
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "lk-marquee-track",
    style: {
      display: 'flex',
      width: 'max-content',
      direction: 'ltr',
      animation: 'lk-marquee ' + duration + 's linear infinite'
    }
  }, group(0), group(1)));
}
Object.assign(__ds_scope, { LogoMarquee });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/content/LogoMarquee.jsx", error: String((e && e.message) || e) }); }

// components/content/SectionHeading.jsx
try { (() => {
function SectionHeading({
  eyebrow,
  title,
  subtitle,
  align = 'center',
  level = 2,
  display = false,
  maxWidth = 760,
  actions,
  style
}) {
  const H = 'h' + level;
  const center = align === 'center';
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      alignItems: center ? 'center' : 'flex-start',
      textAlign: center ? 'center' : 'start',
      maxWidth,
      marginInline: center ? 'auto' : undefined,
      ...style
    }
  }, eyebrow && /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 8,
      fontSize: 'var(--fs-small)',
      lineHeight: 'var(--lh-small)',
      fontWeight: 500,
      color: 'var(--text-accent)',
      marginBottom: 16
    }
  }, /*#__PURE__*/React.createElement("span", {
    "aria-hidden": "true",
    style: {
      width: 6,
      height: 6,
      borderRadius: 999,
      background: 'currentColor'
    }
  }), eyebrow), /*#__PURE__*/React.createElement(H, {
    style: {
      fontSize: display ? 'var(--fs-display)' : 'var(--fs-section)',
      lineHeight: display ? 'var(--lh-display)' : 'var(--lh-section)',
      letterSpacing: display ? 'var(--tracking-display)' : 'var(--tracking-section)',
      fontWeight: 700,
      color: 'var(--text-heading)',
      textWrap: 'balance'
    }
  }, title), subtitle && /*#__PURE__*/React.createElement("p", {
    style: {
      marginTop: 16,
      fontSize: display ? 18 : 'var(--fs-body)',
      lineHeight: 'var(--lh-body)',
      color: 'var(--text-body)',
      textWrap: 'pretty'
    }
  }, subtitle), actions && /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      gap: 12,
      marginTop: 'var(--space-element)',
      justifyContent: center ? 'center' : 'flex-start'
    }
  }, actions));
}
Object.assign(__ds_scope, { SectionHeading });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/content/SectionHeading.jsx", error: String((e && e.message) || e) }); }

// components/core/Highlight.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Marker behind the key phrase of a heading — fills the lower half of the line. */
function Highlight({
  children,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("mark", _extends({
    style: {
      background: 'linear-gradient(to bottom, transparent 52%, var(--highlight-mark) 52%, var(--highlight-mark) 92%, transparent 92%)',
      color: 'inherit',
      padding: '0 .08em',
      WebkitBoxDecorationBreak: 'clone',
      boxDecorationBreak: 'clone',
      ...style
    }
  }, rest), children);
}

/** Brand-orange key words inside a heading. */
function Accent({
  children,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      color: 'var(--text-accent)',
      ...style
    }
  }, rest), children);
}
Object.assign(__ds_scope, { Highlight, Accent });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Highlight.jsx", error: String((e && e.message) || e) }); }

// components/core/Icon.jsx
try { (() => {
// Lucide 0.469.0 icon nodes, copied programmatically from the lucide package (not hand-drawn).
// In production use lucide-react (tree-shaken); this subset keeps prototypes offline.
const NODES = {
  "ArrowRight": [["path", {
    "d": "M5 12h14"
  }], ["path", {
    "d": "m12 5 7 7-7 7"
  }]],
  "ArrowLeft": [["path", {
    "d": "m12 19-7-7 7-7"
  }], ["path", {
    "d": "M19 12H5"
  }]],
  "ArrowUpRight": [["path", {
    "d": "M7 7h10v10"
  }], ["path", {
    "d": "M7 17 17 7"
  }]],
  "ChevronDown": [["path", {
    "d": "m6 9 6 6 6-6"
  }]],
  "ChevronRight": [["path", {
    "d": "m9 18 6-6-6-6"
  }]],
  "ChevronLeft": [["path", {
    "d": "m15 18-6-6 6-6"
  }]],
  "Plus": [["path", {
    "d": "M5 12h14"
  }], ["path", {
    "d": "M12 5v14"
  }]],
  "Minus": [["path", {
    "d": "M5 12h14"
  }]],
  "X": [["path", {
    "d": "M18 6 6 18"
  }], ["path", {
    "d": "m6 6 12 12"
  }]],
  "Check": [["path", {
    "d": "M20 6 9 17l-5-5"
  }]],
  "Search": [["circle", {
    "cx": "11",
    "cy": "11",
    "r": "8"
  }], ["path", {
    "d": "m21 21-4.3-4.3"
  }]],
  "Sparkles": [["path", {
    "d": "M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"
  }], ["path", {
    "d": "M20 3v4"
  }], ["path", {
    "d": "M22 5h-4"
  }], ["path", {
    "d": "M4 17v2"
  }], ["path", {
    "d": "M5 18H3"
  }]],
  "TrendingUp": [["polyline", {
    "points": "22 7 13.5 15.5 8.5 10.5 2 17"
  }], ["polyline", {
    "points": "16 7 22 7 22 13"
  }]],
  "ChartLine": [["path", {
    "d": "M3 3v16a2 2 0 0 0 2 2h16"
  }], ["path", {
    "d": "m19 9-5 5-4-4-3 3"
  }]],
  "ChartColumn": [["path", {
    "d": "M3 3v16a2 2 0 0 0 2 2h16"
  }], ["path", {
    "d": "M18 17V9"
  }], ["path", {
    "d": "M13 17V5"
  }], ["path", {
    "d": "M8 17v-3"
  }]],
  "Target": [["circle", {
    "cx": "12",
    "cy": "12",
    "r": "10"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "6"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "2"
  }]],
  "Link": [["path", {
    "d": "M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"
  }], ["path", {
    "d": "M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"
  }]],
  "Link2": [["path", {
    "d": "M9 17H7A5 5 0 0 1 7 7h2"
  }], ["path", {
    "d": "M15 7h2a5 5 0 1 1 0 10h-2"
  }], ["line", {
    "x1": "8",
    "x2": "16",
    "y1": "12",
    "y2": "12"
  }]],
  "FileText": [["path", {
    "d": "M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"
  }], ["path", {
    "d": "M14 2v4a2 2 0 0 0 2 2h4"
  }], ["path", {
    "d": "M10 9H8"
  }], ["path", {
    "d": "M16 13H8"
  }], ["path", {
    "d": "M16 17H8"
  }]],
  "Code": [["polyline", {
    "points": "16 18 22 12 16 6"
  }], ["polyline", {
    "points": "8 6 2 12 8 18"
  }]],
  "Gauge": [["path", {
    "d": "m12 14 4-4"
  }], ["path", {
    "d": "M3.34 19a10 10 0 1 1 17.32 0"
  }]],
  "ShoppingCart": [["circle", {
    "cx": "8",
    "cy": "21",
    "r": "1"
  }], ["circle", {
    "cx": "19",
    "cy": "21",
    "r": "1"
  }], ["path", {
    "d": "M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"
  }]],
  "ShoppingBag": [["path", {
    "d": "M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"
  }], ["path", {
    "d": "M3 6h18"
  }], ["path", {
    "d": "M16 10a4 4 0 0 1-8 0"
  }]],
  "Store": [["path", {
    "d": "m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"
  }], ["path", {
    "d": "M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"
  }], ["path", {
    "d": "M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"
  }], ["path", {
    "d": "M2 7h20"
  }], ["path", {
    "d": "M22 7v3a2 2 0 0 1-2 2a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12a2 2 0 0 1-2-2V7"
  }]],
  "Globe": [["circle", {
    "cx": "12",
    "cy": "12",
    "r": "10"
  }], ["path", {
    "d": "M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"
  }], ["path", {
    "d": "M2 12h20"
  }]],
  "MapPin": [["path", {
    "d": "M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"
  }], ["circle", {
    "cx": "12",
    "cy": "10",
    "r": "3"
  }]],
  "Mail": [["rect", {
    "width": "20",
    "height": "16",
    "x": "2",
    "y": "4",
    "rx": "2"
  }], ["path", {
    "d": "m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"
  }]],
  "Phone": [["path", {
    "d": "M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
  }]],
  "Linkedin": [["path", {
    "d": "M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
  }], ["rect", {
    "width": "4",
    "height": "12",
    "x": "2",
    "y": "9"
  }], ["circle", {
    "cx": "4",
    "cy": "4",
    "r": "2"
  }]],
  "Youtube": [["path", {
    "d": "M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"
  }], ["path", {
    "d": "m10 15 5-3-5-3z"
  }]],
  "Facebook": [["path", {
    "d": "M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
  }]],
  "MessageCircle": [["path", {
    "d": "M7.9 20A9 9 0 1 0 4 16.1L2 22Z"
  }]],
  "Clock": [["circle", {
    "cx": "12",
    "cy": "12",
    "r": "10"
  }], ["polyline", {
    "points": "12 6 12 12 16 14"
  }]],
  "Bot": [["path", {
    "d": "M12 8V4H8"
  }], ["rect", {
    "width": "16",
    "height": "12",
    "x": "4",
    "y": "8",
    "rx": "2"
  }], ["path", {
    "d": "M2 14h2"
  }], ["path", {
    "d": "M20 14h2"
  }], ["path", {
    "d": "M15 13v2"
  }], ["path", {
    "d": "M9 13v2"
  }]],
  "Brain": [["path", {
    "d": "M12 5a3 3 0 1 0-5.997.125 4 4 0 0 0-2.526 5.77 4 4 0 0 0 .556 6.588A4 4 0 1 0 12 18Z"
  }], ["path", {
    "d": "M12 5a3 3 0 1 1 5.997.125 4 4 0 0 1 2.526 5.77 4 4 0 0 1-.556 6.588A4 4 0 1 1 12 18Z"
  }], ["path", {
    "d": "M15 13a4.5 4.5 0 0 1-3-4 4.5 4.5 0 0 1-3 4"
  }], ["path", {
    "d": "M17.599 6.5a3 3 0 0 0 .399-1.375"
  }], ["path", {
    "d": "M6.003 5.125A3 3 0 0 0 6.401 6.5"
  }], ["path", {
    "d": "M3.477 10.896a4 4 0 0 1 .585-.396"
  }], ["path", {
    "d": "M19.938 10.5a4 4 0 0 1 .585.396"
  }], ["path", {
    "d": "M6 18a4 4 0 0 1-1.967-.516"
  }], ["path", {
    "d": "M19.967 17.484A4 4 0 0 1 18 18"
  }]],
  "Lightbulb": [["path", {
    "d": "M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"
  }], ["path", {
    "d": "M9 18h6"
  }], ["path", {
    "d": "M10 22h4"
  }]],
  "Layers": [["path", {
    "d": "M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z"
  }], ["path", {
    "d": "M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12"
  }], ["path", {
    "d": "M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17"
  }]],
  "Settings": [["path", {
    "d": "M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "3"
  }]],
  "Wrench": [["path", {
    "d": "M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"
  }]],
  "ShieldCheck": [["path", {
    "d": "M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
  }], ["path", {
    "d": "m9 12 2 2 4-4"
  }]],
  "Users": [["path", {
    "d": "M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
  }], ["circle", {
    "cx": "9",
    "cy": "7",
    "r": "4"
  }], ["path", {
    "d": "M22 21v-2a4 4 0 0 0-3-3.87"
  }], ["path", {
    "d": "M16 3.13a4 4 0 0 1 0 7.75"
  }]],
  "Rocket": [["path", {
    "d": "M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"
  }], ["path", {
    "d": "m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"
  }], ["path", {
    "d": "M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"
  }], ["path", {
    "d": "M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"
  }]],
  "Menu": [["line", {
    "x1": "4",
    "x2": "20",
    "y1": "12",
    "y2": "12"
  }], ["line", {
    "x1": "4",
    "x2": "20",
    "y1": "6",
    "y2": "6"
  }], ["line", {
    "x1": "4",
    "x2": "20",
    "y1": "18",
    "y2": "18"
  }]],
  "Send": [["path", {
    "d": "M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"
  }], ["path", {
    "d": "m21.854 2.147-10.94 10.939"
  }]],
  "Play": [["polygon", {
    "points": "6 3 20 12 6 21 6 3"
  }]],
  "PenLine": [["path", {
    "d": "M12 20h9"
  }], ["path", {
    "d": "M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z"
  }]],
  "Newspaper": [["path", {
    "d": "M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"
  }], ["path", {
    "d": "M18 14h-8"
  }], ["path", {
    "d": "M15 18h-5"
  }], ["path", {
    "d": "M10 6h8v4h-8V6Z"
  }]],
  "Zap": [["path", {
    "d": "M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"
  }]],
  "Award": [["path", {
    "d": "m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"
  }], ["circle", {
    "cx": "12",
    "cy": "8",
    "r": "6"
  }]],
  "Compass": [["path", {
    "d": "m16.24 7.76-1.804 5.411a2 2 0 0 1-1.265 1.265L7.76 16.24l1.804-5.411a2 2 0 0 1 1.265-1.265z"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "10"
  }]],
  "Eye": [["path", {
    "d": "M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "3"
  }]],
  "CircleCheck": [["circle", {
    "cx": "12",
    "cy": "12",
    "r": "10"
  }], ["path", {
    "d": "m9 12 2 2 4-4"
  }]],
  "Quote": [["path", {
    "d": "M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"
  }], ["path", {
    "d": "M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"
  }]],
  "BookOpen": [["path", {
    "d": "M12 7v14"
  }], ["path", {
    "d": "M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"
  }]],
  "GraduationCap": [["path", {
    "d": "M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"
  }], ["path", {
    "d": "M22 10v6"
  }], ["path", {
    "d": "M6 12.5V16a6 3 0 0 0 12 0v-3.5"
  }]],
  "Handshake": [["path", {
    "d": "m11 17 2 2a1 1 0 1 0 3-3"
  }], ["path", {
    "d": "m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"
  }], ["path", {
    "d": "m21 3 1 11h-2"
  }], ["path", {
    "d": "M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"
  }], ["path", {
    "d": "M3 4h8"
  }]],
  "Route": [["circle", {
    "cx": "6",
    "cy": "19",
    "r": "3"
  }], ["path", {
    "d": "M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"
  }], ["circle", {
    "cx": "18",
    "cy": "5",
    "r": "3"
  }]],
  "RefreshCw": [["path", {
    "d": "M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"
  }], ["path", {
    "d": "M21 3v5h-5"
  }], ["path", {
    "d": "M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"
  }], ["path", {
    "d": "M8 16H3v5"
  }]],
  "ClipboardCheck": [["rect", {
    "width": "8",
    "height": "4",
    "x": "8",
    "y": "2",
    "rx": "1",
    "ry": "1"
  }], ["path", {
    "d": "M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"
  }], ["path", {
    "d": "m9 14 2 2 4-4"
  }]],
  "FileSearch": [["path", {
    "d": "M14 2v4a2 2 0 0 0 2 2h4"
  }], ["path", {
    "d": "M4.268 21a2 2 0 0 0 1.727 1H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"
  }], ["path", {
    "d": "m9 18-1.5-1.5"
  }], ["circle", {
    "cx": "5",
    "cy": "14",
    "r": "3"
  }]],
  "Megaphone": [["path", {
    "d": "m3 11 18-5v12L3 14v-3z"
  }], ["path", {
    "d": "M11.6 16.8a3 3 0 1 1-5.8-1.6"
  }]],
  "Star": [["path", {
    "d": "M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"
  }]],
  "Calendar": [["path", {
    "d": "M8 2v4"
  }], ["path", {
    "d": "M16 2v4"
  }], ["rect", {
    "width": "18",
    "height": "18",
    "x": "3",
    "y": "4",
    "rx": "2"
  }], ["path", {
    "d": "M3 10h18"
  }]],
  "MousePointerClick": [["path", {
    "d": "M14 4.1 12 6"
  }], ["path", {
    "d": "m5.1 8-2.9-.8"
  }], ["path", {
    "d": "m6 12-1.9 2"
  }], ["path", {
    "d": "M7.2 2.2 8 5.1"
  }], ["path", {
    "d": "M9.037 9.69a.498.498 0 0 1 .653-.653l11 4.5a.5.5 0 0 1-.074.949l-4.349 1.041a1 1 0 0 0-.74.739l-1.04 4.35a.5.5 0 0 1-.95.074z"
  }]],
  "Monitor": [["rect", {
    "width": "20",
    "height": "14",
    "x": "2",
    "y": "3",
    "rx": "2"
  }], ["line", {
    "x1": "8",
    "x2": "16",
    "y1": "21",
    "y2": "21"
  }], ["line", {
    "x1": "12",
    "x2": "12",
    "y1": "17",
    "y2": "21"
  }]],
  "ScanSearch": [["path", {
    "d": "M3 7V5a2 2 0 0 1 2-2h2"
  }], ["path", {
    "d": "M17 3h2a2 2 0 0 1 2 2v2"
  }], ["path", {
    "d": "M21 17v2a2 2 0 0 1-2 2h-2"
  }], ["path", {
    "d": "M7 21H5a2 2 0 0 1-2-2v-2"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "3"
  }], ["path", {
    "d": "m16 16-1.9-1.9"
  }]],
  "Radar": [["path", {
    "d": "M19.07 4.93A10 10 0 0 0 6.99 3.34"
  }], ["path", {
    "d": "M4 6h.01"
  }], ["path", {
    "d": "M2.29 9.62A10 10 0 1 0 21.31 8.35"
  }], ["path", {
    "d": "M16.24 7.76A6 6 0 1 0 8.23 16.67"
  }], ["path", {
    "d": "M12 18h.01"
  }], ["path", {
    "d": "M17.99 11.66A6 6 0 0 1 15.77 16.67"
  }], ["circle", {
    "cx": "12",
    "cy": "12",
    "r": "2"
  }], ["path", {
    "d": "m13.41 10.59 5.66-5.66"
  }]],
  "Languages": [["path", {
    "d": "m5 8 6 6"
  }], ["path", {
    "d": "m4 14 6-6 2-3"
  }], ["path", {
    "d": "M2 5h12"
  }], ["path", {
    "d": "M7 2h1"
  }], ["path", {
    "d": "m22 22-5-10-5 10"
  }], ["path", {
    "d": "M14 18h6"
  }]]
};

// Directional glyphs mirror automatically under [dir="rtl"] (see tokens/base.css .lk-icon-dir)
const DIRECTIONAL = {
  ArrowRight: 1,
  ArrowLeft: 1,
  ArrowUpRight: 1,
  ChevronRight: 1,
  ChevronLeft: 1,
  Send: 1,
  Route: 1
};
function Icon({
  name,
  size = 20,
  strokeWidth = 2.25,
  color = 'currentColor',
  mirror,
  style,
  ...rest
}) {
  const kids = NODES[name];
  if (!kids) return null;
  const dir = mirror === undefined ? DIRECTIONAL[name] : mirror;
  return React.createElement('svg', {
    xmlns: 'http://www.w3.org/2000/svg',
    width: size,
    height: size,
    viewBox: '0 0 24 24',
    fill: 'none',
    stroke: color,
    strokeWidth,
    strokeLinecap: 'round',
    strokeLinejoin: 'round',
    className: dir ? 'lk-icon-dir' : undefined,
    'aria-hidden': true,
    style: {
      flexShrink: 0,
      display: 'block',
      ...style
    },
    ...rest
  }, kids.map(([tag, attrs], i) => React.createElement(tag, {
    key: i,
    ...attrs
  })));
}
const ICON_NAMES = Object.keys(NODES);
Object.assign(__ds_scope, { Icon, ICON_NAMES });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Icon.jsx", error: String((e && e.message) || e) }); }

// components/content/FAQ.jsx
try { (() => {
const {
  useState
} = React;
function Item({
  q,
  a,
  open,
  onToggle,
  on
}) {
  const dark = on === 'dark';
  return /*#__PURE__*/React.createElement("div", {
    style: {
      borderRadius: 'var(--radius-card)',
      border: '1px solid ' + (dark ? 'transparent' : 'var(--border-light)'),
      background: dark ? 'linear-gradient(var(--dark-surface),var(--dark-surface)) padding-box, var(--dark-card-edge) border-box' : 'var(--white)'
    }
  }, /*#__PURE__*/React.createElement("button", {
    type: "button",
    onClick: onToggle,
    "aria-expanded": open,
    style: {
      display: 'flex',
      width: '100%',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 16,
      padding: '20px 24px',
      background: 'none',
      border: 0,
      cursor: 'pointer',
      textAlign: 'start',
      fontFamily: 'var(--font-sans)',
      fontSize: 17,
      lineHeight: 1.5,
      fontWeight: 600,
      color: 'var(--text-heading)'
    }
  }, /*#__PURE__*/React.createElement("span", null, q), /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      color: 'var(--faq-icon)',
      transform: open ? 'rotate(45deg)' : 'none',
      transition: 'transform var(--dur-base) var(--ease-out)'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "Plus",
    size: 20
  }))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateRows: open ? '1fr' : '0fr',
      transition: 'grid-template-rows var(--dur-slow) var(--ease-out)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      overflow: 'hidden'
    }
  }, /*#__PURE__*/React.createElement("p", {
    style: {
      padding: '0 24px 22px',
      fontSize: 15,
      lineHeight: 'var(--lh-body)',
      color: 'var(--text-body)'
    }
  }, a))));
}
function FAQ({
  items = [],
  on = 'light',
  title,
  subtitle,
  eyebrow,
  action,
  defaultOpen = 0,
  style
}) {
  const [open, setOpen] = useState(defaultOpen);
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      gap: 'var(--space-block) 64px',
      alignItems: 'flex-start',
      ...style
    }
  }, (title || subtitle) && /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '1 1 300px',
      display: 'flex',
      flexDirection: 'column',
      gap: 16,
      position: 'sticky',
      top: 24
    }
  }, eyebrow && /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 'var(--fs-small)',
      fontWeight: 500,
      color: 'var(--text-accent)'
    }
  }, eyebrow), title && /*#__PURE__*/React.createElement("h2", {
    style: {
      fontSize: 'var(--fs-section)',
      lineHeight: 'var(--lh-section)',
      letterSpacing: 'var(--tracking-section)',
      fontWeight: 700,
      color: 'var(--text-heading)'
    }
  }, title), subtitle && /*#__PURE__*/React.createElement("p", {
    style: {
      color: 'var(--text-body)'
    }
  }, subtitle), action && /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 8
    }
  }, action)), /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '1.7 1 460px',
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, items.map((it, i) => /*#__PURE__*/React.createElement(Item, {
    key: i,
    q: it.q,
    a: it.a,
    on: on,
    open: open === i,
    onToggle: () => setOpen(open === i ? -1 : i)
  }))));
}
Object.assign(__ds_scope, { FAQ });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/content/FAQ.jsx", error: String((e && e.message) || e) }); }

// components/core/Button.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const {
  useState
} = React;
const SIZES = {
  sm: {
    h: 40,
    px: 18,
    fs: 14,
    ic: 16
  },
  md: {
    h: 48,
    px: 24,
    fs: 15,
    ic: 18
  },
  lg: {
    h: 56,
    px: 30,
    fs: 16,
    ic: 20
  }
};
function variantStyle(variant, hover, press) {
  switch (variant) {
    case 'dark':
      return {
        background: hover ? 'var(--dark-border)' : 'var(--dark)',
        color: 'var(--white)',
        border: '1px solid transparent',
        fontWeight: 600
      };
    case 'outline':
      return {
        background: hover ? 'var(--glass-dark)' : 'transparent',
        color: 'var(--white)',
        border: '1px solid ' + (hover ? 'var(--fg-on-dark-3)' : 'var(--dark-border)'),
        fontWeight: 600
      };
    default:
      return {
        background: press ? 'var(--orange-deep)' : 'var(--gradient-primary)',
        color: 'var(--white)',
        border: '1px solid transparent',
        fontWeight: 700,
        boxShadow: hover && !press ? 'var(--shadow-exceptional)' : 'none'
      };
  }
}
function Button({
  variant = 'primary',
  size = 'md',
  icon,
  iconStart,
  href,
  disabled,
  fullWidth,
  type = 'button',
  children,
  style,
  onClick,
  ...rest
}) {
  const [hover, setHover] = useState(false);
  const [press, setPress] = useState(false);
  const s = SIZES[size] || SIZES.md;
  const Tag = href ? 'a' : 'button';
  const css = {
    display: fullWidth ? 'flex' : 'inline-flex',
    width: fullWidth ? '100%' : undefined,
    alignItems: 'center',
    justifyContent: 'center',
    gap: 10,
    height: s.h,
    padding: '0 ' + s.px + 'px',
    borderRadius: 'var(--radius-pill)',
    fontFamily: 'var(--font-sans)',
    fontSize: s.fs,
    lineHeight: 1,
    letterSpacing: 0,
    whiteSpace: 'nowrap',
    cursor: disabled ? 'not-allowed' : 'pointer',
    textDecoration: 'none',
    opacity: disabled ? 0.45 : 1,
    transform: press && !disabled ? 'scale(.98)' : 'none',
    transition: 'background var(--dur-fast) var(--ease-out), box-shadow var(--dur-base) var(--ease-out), transform var(--dur-fast) var(--ease-out), border-color var(--dur-fast)',
    ...variantStyle(variant, hover && !disabled, press && !disabled),
    ...style
  };
  return /*#__PURE__*/React.createElement(Tag, _extends({
    href: href,
    type: href ? undefined : type,
    disabled: href ? undefined : disabled,
    onClick: disabled ? undefined : onClick,
    style: css,
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => {
      setHover(false);
      setPress(false);
    },
    onMouseDown: () => setPress(true),
    onMouseUp: () => setPress(false)
  }, rest), iconStart && /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: iconStart,
    size: s.ic
  }), /*#__PURE__*/React.createElement("span", null, children), icon && /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: s.ic
  }));
}
Object.assign(__ds_scope, { Button });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Button.jsx", error: String((e && e.message) || e) }); }

// components/blocks/CTABlock.jsx
try { (() => {
const V = {
  gradient: {
    bg: 'var(--gradient-primary)',
    surface: 'orange',
    btn: 'dark'
  },
  orange: {
    bg: 'var(--orange)',
    surface: 'orange',
    btn: 'dark'
  },
  dark: {
    bg: 'var(--dark)',
    surface: 'dark',
    btn: 'primary'
  },
  cream: {
    bg: 'var(--cream)',
    surface: 'cream',
    btn: 'primary'
  }
};
function CTABlock({
  variant = 'gradient',
  title,
  text,
  actionLabel,
  actionHref,
  onAction,
  icon = 'ArrowRight',
  children,
  style
}) {
  const v = V[variant] || V.gradient;
  return /*#__PURE__*/React.createElement("section", {
    "data-surface": v.surface,
    style: {
      background: v.bg,
      borderRadius: 0,
      padding: 'var(--space-section-sm) var(--gutter)',
      ...style
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 760,
      marginInline: 'auto',
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      textAlign: 'center',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      fontSize: 'var(--fs-section)',
      lineHeight: 'var(--lh-section)',
      letterSpacing: 'var(--tracking-section)',
      fontWeight: 700,
      color: 'var(--text-heading)'
    }
  }, title), text && /*#__PURE__*/React.createElement("p", {
    style: {
      fontSize: 17,
      lineHeight: 'var(--lh-body)',
      color: 'var(--text-body)',
      fontWeight: v.surface === 'orange' ? 500 : 400
    }
  }, text), (actionLabel || children) && /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 8,
      display: 'flex',
      gap: 12,
      flexWrap: 'wrap',
      justifyContent: 'center'
    }
  }, children || /*#__PURE__*/React.createElement(__ds_scope.Button, {
    variant: v.btn,
    size: "lg",
    icon: icon,
    href: actionHref,
    onClick: onAction
  }, actionLabel))));
}
Object.assign(__ds_scope, { CTABlock });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/blocks/CTABlock.jsx", error: String((e && e.message) || e) }); }

// components/core/NewLabel.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function NewLabel({
  badge = 'NEW',
  children,
  href,
  style,
  ...rest
}) {
  const Tag = href ? 'a' : 'span';
  return /*#__PURE__*/React.createElement(Tag, _extends({
    href: href,
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 10,
      padding: 4,
      paddingInlineEnd: 16,
      background: 'var(--white)',
      border: '1.5px solid var(--border-light)',
      borderRadius: 'var(--radius-pill)',
      boxShadow: 'var(--shadow-new-label)',
      fontFamily: 'var(--font-sans)',
      fontSize: 15,
      fontWeight: 500,
      lineHeight: 1.6,
      color: 'var(--fg-on-light-1)',
      textDecoration: 'none',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("span", {
    style: {
      background: 'var(--gradient-primary)',
      color: 'var(--white)',
      fontSize: 14,
      fontWeight: 700,
      lineHeight: '22px',
      padding: '0 10px',
      borderRadius: 'var(--radius-pill)',
      letterSpacing: '.02em'
    }
  }, badge), /*#__PURE__*/React.createElement("span", null, children));
}
Object.assign(__ds_scope, { NewLabel });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/NewLabel.jsx", error: String((e && e.message) || e) }); }

// components/core/NumberBadge.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function NumberBadge({
  children,
  variant = 'gradient',
  size = 40,
  style,
  ...rest
}) {
  const g = variant === 'gradient';
  return /*#__PURE__*/React.createElement("span", _extends({
    className: "lk-tnum",
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      justifyContent: 'center',
      flexShrink: 0,
      alignSelf: 'flex-start',
      minWidth: size,
      height: size,
      padding: '0 10px',
      borderRadius: 'var(--radius-pill)',
      fontFamily: 'var(--font-sans)',
      fontWeight: 700,
      fontSize: size >= 48 ? 18 : 15,
      lineHeight: 1,
      background: g ? 'var(--gradient-primary)' : 'var(--dark)',
      color: g ? 'var(--white)' : 'var(--orange)',
      border: g ? 'none' : '1px solid var(--dark-border)',
      ...style
    }
  }, rest), children);
}
Object.assign(__ds_scope, { NumberBadge });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/NumberBadge.jsx", error: String((e && e.message) || e) }); }

// components/core/Tag.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Category / meta pill. Always an outline pill — never gradient (gradient is only for buttons, the NEW badge and CTA block B). */
function Tag({
  variant = 'neutral',
  icon,
  children,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      display: 'inline-flex',
      alignSelf: 'flex-start',
      alignItems: 'center',
      gap: 6,
      height: 30,
      padding: '0 12px',
      borderRadius: 'var(--radius-pill)',
      fontFamily: 'var(--font-sans)',
      whiteSpace: 'nowrap',
      lineHeight: 1,
      fontSize: 13,
      fontWeight: 500,
      background: 'var(--tag-bg)',
      border: '1px solid var(--tag-border)',
      color: variant === 'accent' ? 'var(--orange)' : 'var(--tag-fg)',
      ...style
    }
  }, rest), icon && /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 14
  }), children);
}
Object.assign(__ds_scope, { Tag });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Tag.jsx", error: String((e && e.message) || e) }); }

// components/forms/Input.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const {
  useState
} = React;
function Input({
  as = 'input',
  label,
  options = [],
  placeholder,
  rows = 4,
  id,
  hint,
  error,
  value,
  defaultValue,
  onChange,
  type = 'text',
  style,
  inputStyle,
  ...rest
}) {
  const [focus, setFocus] = useState(false);
  const fid = id || (label ? 'f-' + String(label).replace(/\s+/g, '-') : undefined);
  const base = {
    width: '100%',
    fontFamily: 'var(--font-sans)',
    fontSize: 15,
    lineHeight: 1.5,
    color: 'var(--input-fg)',
    background: 'var(--input-bg)',
    border: '1px solid ' + (error ? 'var(--orange)' : focus ? 'var(--orange)' : 'var(--input-border)'),
    outline: 'none',
    boxShadow: focus ? '0 0 0 3px var(--highlight-mark)' : 'none',
    transition: 'border-color var(--dur-fast), box-shadow var(--dur-fast)',
    ...inputStyle
  };
  const pill = {
    ...base,
    height: 52,
    padding: '0 22px',
    borderRadius: 'var(--radius-pill)'
  };
  const ev = {
    onFocus: () => setFocus(true),
    onBlur: () => setFocus(false),
    onChange,
    value,
    defaultValue,
    id: fid
  };
  let field;
  if (as === 'textarea') field = /*#__PURE__*/React.createElement("textarea", _extends({
    className: "lk-input",
    rows: rows,
    placeholder: placeholder,
    style: {
      ...base,
      padding: '16px 22px',
      borderRadius: 'var(--radius-card)',
      resize: 'vertical'
    }
  }, ev, rest));else if (as === 'select') field = /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative'
    }
  }, /*#__PURE__*/React.createElement("select", _extends({
    className: "lk-input",
    style: {
      ...pill,
      appearance: 'none',
      WebkitAppearance: 'none',
      paddingInlineEnd: 48,
      cursor: 'pointer'
    }
  }, ev, rest), placeholder && /*#__PURE__*/React.createElement("option", {
    value: ""
  }, placeholder), options.map(o => /*#__PURE__*/React.createElement("option", {
    key: o.value ?? o,
    value: o.value ?? o
  }, o.label ?? o))), /*#__PURE__*/React.createElement("span", {
    style: {
      position: 'absolute',
      insetInlineEnd: 20,
      top: '50%',
      transform: 'translateY(-50%)',
      pointerEvents: 'none',
      color: 'var(--input-placeholder)'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "ChevronDown",
    size: 18
  })));else field = /*#__PURE__*/React.createElement("input", _extends({
    className: "lk-input",
    type: type,
    placeholder: placeholder,
    style: pill
  }, ev, rest));
  return /*#__PURE__*/React.createElement("label", {
    htmlFor: fid,
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 8,
      ...style
    }
  }, label && /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 'var(--fs-small)',
      fontWeight: 500,
      color: 'var(--text-heading)'
    }
  }, label), field, (error || hint) && /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 'var(--fs-small)',
      color: error ? 'var(--orange)' : 'var(--text-muted)'
    }
  }, error || hint));
}
Object.assign(__ds_scope, { Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Input.jsx", error: String((e && e.message) || e) }); }

// components/layout/Header.jsx
try { (() => {
const {
  useState
} = React;
function NavItem({
  item,
  onNavigate
}) {
  const [open, setOpen] = useState(false);
  const [hover, setHover] = useState(false);
  const has = item.items && item.items.length;
  return /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative'
    },
    onMouseEnter: () => {
      setHover(true);
      has && setOpen(true);
    },
    onMouseLeave: () => {
      setHover(false);
      setOpen(false);
    }
  }, /*#__PURE__*/React.createElement("a", {
    href: item.href || '#',
    onClick: e => {
      if (onNavigate) {
        e.preventDefault();
        onNavigate(item);
      }
    },
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 6,
      height: 40,
      padding: '0 14px',
      borderRadius: 'var(--radius-pill)',
      fontSize: 15,
      fontWeight: 500,
      whiteSpace: 'nowrap',
      color: item.active || hover ? 'var(--fg-on-dark-1)' : 'var(--fg-on-dark-2)',
      background: item.active ? 'var(--dark-surface)' : 'transparent',
      textDecoration: 'none',
      transition: 'color var(--dur-fast)'
    }
  }, item.label, has ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "ChevronDown",
    size: 16
  }) : null), has && open && /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      top: '100%',
      insetInlineStart: 0,
      paddingTop: 10,
      zIndex: 20
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      minWidth: 260,
      padding: 8,
      borderRadius: 'var(--radius-card)',
      background: 'linear-gradient(var(--dark-surface),var(--dark-surface)) padding-box, var(--dark-card-edge) border-box',
      border: '1px solid transparent',
      display: 'flex',
      flexDirection: 'column'
    }
  }, item.items.map((s, i) => /*#__PURE__*/React.createElement("a", {
    key: i,
    href: s.href || '#',
    onClick: e => {
      if (onNavigate) {
        e.preventDefault();
        onNavigate(s);
      }
    },
    style: {
      padding: '10px 14px',
      borderRadius: 10,
      fontSize: 14,
      color: 'var(--fg-on-dark-2)',
      textDecoration: 'none'
    },
    onMouseEnter: e => {
      e.currentTarget.style.color = 'var(--fg-on-dark-1)';
      e.currentTarget.style.background = 'var(--dark-tile-inner)';
    },
    onMouseLeave: e => {
      e.currentTarget.style.color = 'var(--fg-on-dark-2)';
      e.currentTarget.style.background = 'transparent';
    }
  }, s.label)))));
}
function Header({
  logoSrc,
  logoAlt = 'Linkawy',
  logoHref = '#',
  links = [],
  cta,
  langSwitch,
  onNavigate,
  style
}) {
  return /*#__PURE__*/React.createElement("header", {
    "data-surface": "dark",
    style: {
      position: 'relative',
      zIndex: 10,
      background: 'var(--dark)',
      borderBottom: '1px solid var(--dark-border)',
      ...style
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 'var(--content-max)',
      marginInline: 'auto',
      paddingInline: 'var(--gutter)',
      boxSizing: 'content-box',
      height: 80,
      display: 'flex',
      alignItems: 'center',
      gap: 32
    }
  }, /*#__PURE__*/React.createElement("a", {
    href: logoHref,
    onClick: e => {
      if (onNavigate) {
        e.preventDefault();
        onNavigate({
          href: logoHref,
          home: true
        });
      }
    },
    style: {
      display: 'flex',
      flexShrink: 0
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: logoSrc,
    alt: logoAlt,
    style: {
      height: 34,
      width: 'auto',
      display: 'block'
    }
  })), /*#__PURE__*/React.createElement("nav", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 2,
      flex: 1,
      minWidth: 0
    }
  }, links.map((l, i) => /*#__PURE__*/React.createElement(NavItem, {
    key: i,
    item: l,
    onNavigate: onNavigate
  }))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 12,
      flexShrink: 0
    }
  }, langSwitch && /*#__PURE__*/React.createElement("a", {
    href: langSwitch.href || '#',
    onClick: e => {
      if (langSwitch.onClick) {
        e.preventDefault();
        langSwitch.onClick();
      }
    },
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 6,
      fontSize: 14,
      fontWeight: 500,
      color: 'var(--fg-on-dark-2)',
      textDecoration: 'none'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "Languages",
    size: 18
  }), langSwitch.label), cta && /*#__PURE__*/React.createElement(__ds_scope.Button, {
    size: "sm",
    href: cta.href,
    onClick: cta.onClick
  }, cta.label))));
}
Object.assign(__ds_scope, { Header });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/layout/Header.jsx", error: String((e && e.message) || e) }); }

// components/layout/Section.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const BG = {
  white: 'var(--white)',
  cream: 'var(--cream)',
  'cream-warm': 'var(--cream-warm)',
  dark: 'var(--dark)'
};
function Section({
  bg = 'white',
  size = 'default',
  beforeSunset = false,
  contained = true,
  maxWidth,
  id,
  padTop,
  padBottom,
  children,
  style,
  innerStyle,
  ...rest
}) {
  const pad = size === 'sm' ? 'var(--space-section-sm)' : size === 'none' ? '0px' : 'var(--space-section)';
  const bottom = beforeSunset ? 'calc(' + pad + ' + var(--space-sunset-pad))' : pad;
  return /*#__PURE__*/React.createElement("section", _extends({
    id: id,
    "data-surface": bg,
    style: {
      position: 'relative',
      background: BG[bg] || BG.white,
      color: 'var(--text-body)',
      borderRadius: 0,
      paddingTop: padTop ?? pad,
      paddingBottom: padBottom ?? bottom,
      ...style
    }
  }, rest), contained ? /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: maxWidth || 'var(--content-max)',
      marginInline: 'auto',
      paddingInline: 'var(--gutter)',
      boxSizing: 'content-box',
      ...innerStyle
    }
  }, children) : children);
}
Object.assign(__ds_scope, { Section });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/layout/Section.jsx", error: String((e && e.message) || e) }); }

// components/layout/Sunset.jsx
try { (() => {
/** Sunset transition — the Accretion PNG, never a CSS gradient. */
function Sunset({
  variant = 'cream-to-dark',
  src,
  alt = '',
  style
}) {
  const down = variant === 'dark-to-cream';
  return /*#__PURE__*/React.createElement("div", {
    "aria-hidden": alt ? undefined : 'true',
    style: {
      background: 'var(--cream)',
      lineHeight: 0,
      ...style
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: src,
    alt: alt,
    style: {
      display: 'block',
      width: '100%',
      height: down ? '8vw' : 'auto',
      objectFit: 'fill',
      marginBottom: down ? 0 : -1,
      marginTop: down ? -1 : 0
    }
  }));
}
Object.assign(__ds_scope, { Sunset });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/layout/Sunset.jsx", error: String((e && e.message) || e) }); }

// components/blocks/FooterE.jsx
try { (() => {
function Social({
  s
}) {
  return /*#__PURE__*/React.createElement("a", {
    href: s.href || '#',
    "aria-label": s.label,
    style: {
      width: 40,
      height: 40,
      borderRadius: 999,
      border: '1px solid var(--divider-footer)',
      display: 'inline-flex',
      alignItems: 'center',
      justifyContent: 'center',
      color: 'var(--fg-on-light-2)',
      background: 'var(--white)'
    },
    onMouseEnter: e => {
      e.currentTarget.style.color = 'var(--orange)';
    },
    onMouseLeave: e => {
      e.currentTarget.style.color = 'var(--fg-on-light-2)';
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: s.icon,
    size: 18
  }));
}
const colTitle = {
  fontSize: 14,
  fontWeight: 600,
  color: 'var(--text-heading)',
  marginBottom: 18
};
const linkCss = {
  fontSize: 15,
  lineHeight: 1.5,
  color: 'var(--text-body)',
  textDecoration: 'none'
};
function FooterE({
  logoSrc,
  logoAlt = 'Linkawy',
  sunsetSrc,
  description,
  socials = [],
  columns = [],
  contact,
  cta,
  copyright,
  style
}) {
  return /*#__PURE__*/React.createElement("footer", {
    "data-surface": "cream",
    style: {
      background: 'var(--cream)',
      color: 'var(--text-body)',
      ...style
    }
  }, sunsetSrc && /*#__PURE__*/React.createElement(__ds_scope.Sunset, {
    variant: "dark-to-cream",
    src: sunsetSrc
  }), cta && /*#__PURE__*/React.createElement("div", {
    style: {
      padding: 'var(--space-footer-cta) var(--gutter) var(--space-section)',
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      textAlign: 'center',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      fontSize: 'var(--fs-section)',
      lineHeight: 'var(--lh-section)',
      letterSpacing: 'var(--tracking-section)',
      fontWeight: 700,
      color: 'var(--text-heading)',
      maxWidth: 760
    }
  }, cta.title), cta.text && /*#__PURE__*/React.createElement("p", {
    style: {
      fontSize: 17,
      color: 'var(--text-body)',
      maxWidth: 620
    }
  }, cta.text), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 8
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Button, {
    variant: "dark",
    size: "lg",
    icon: "ArrowRight",
    href: cta.href,
    onClick: cta.onClick
  }, cta.label))), /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 'var(--content-max)',
      marginInline: 'auto',
      paddingInline: 'var(--gutter)',
      boxSizing: 'content-box'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      borderTop: '1px solid var(--divider-footer)',
      paddingTop: 64,
      display: 'flex',
      flexWrap: 'wrap',
      gap: '40px 48px'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '1.6 1 280px',
      display: 'flex',
      flexDirection: 'column',
      gap: 20,
      maxWidth: 360
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: logoSrc,
    alt: logoAlt,
    style: {
      height: 34,
      width: 'auto',
      alignSelf: 'flex-start'
    }
  }), description && /*#__PURE__*/React.createElement("p", {
    style: {
      fontSize: 15,
      lineHeight: 1.7
    }
  }, description), socials.length > 0 && /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 10
    }
  }, socials.map((s, i) => /*#__PURE__*/React.createElement(Social, {
    key: i,
    s: s
  })))), columns.map((c, i) => /*#__PURE__*/React.createElement("div", {
    key: i,
    style: {
      flex: '1 1 140px'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: colTitle
  }, c.title), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, c.links.map((l, j) => /*#__PURE__*/React.createElement("a", {
    key: j,
    href: l.href || '#',
    style: linkCss,
    onMouseEnter: e => {
      e.currentTarget.style.color = 'var(--text-heading)';
    },
    onMouseLeave: e => {
      e.currentTarget.style.color = 'var(--text-body)';
    }
  }, l.label))))), contact && /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '1 1 160px'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: colTitle
  }, contact.title), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, contact.items.map((it, j) => /*#__PURE__*/React.createElement("a", {
    key: j,
    href: it.href || '#',
    style: {
      ...linkCss,
      display: 'inline-flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: it.icon,
    size: 16,
    color: "var(--orange)"
  }), /*#__PURE__*/React.createElement("span", null, it.label)))))), /*#__PURE__*/React.createElement("div", {
    "aria-hidden": "true",
    style: {
      marginTop: 72,
      WebkitMaskImage: 'linear-gradient(to bottom, #000, transparent 92%)',
      maskImage: 'linear-gradient(to bottom, #000, transparent 92%)'
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: logoSrc,
    alt: "",
    style: {
      display: 'block',
      width: '100%',
      height: 'auto',
      filter: 'brightness(0)',
      opacity: 0.09
    }
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      padding: '24px 0 32px',
      fontSize: 'var(--fs-small)',
      color: 'var(--text-muted)',
      display: 'flex',
      justifyContent: 'space-between',
      flexWrap: 'wrap',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("span", null, copyright))));
}
Object.assign(__ds_scope, { FooterE });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/blocks/FooterE.jsx", error: String((e && e.message) || e) }); }

// components/tiles/IconTile.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const TONES = {
  dark: {
    edge: 'var(--tile-edge-dark)',
    inner: 'var(--tile-inner-dark)',
    glow: 'var(--tile-glow-opacity-dark)'
  },
  light: {
    edge: 'var(--tile-edge-light)',
    inner: 'var(--tile-inner-light)',
    glow: 'var(--tile-glow-opacity-light)'
  },
  auto: {
    edge: 'var(--tile-edge)',
    inner: 'var(--tile-inner)',
    glow: 'var(--tile-glow-opacity)'
  }
};

/**
 * Accretion build: 1px gradient edge → inner fill → orange radial glow from bottom-middle → 24px orange Lucide icon.
 * tone="auto" follows the surrounding data-surface; `logo` puts a brand SVG in the same tile (glow 8%): light build on white/cream, dark build on dark and inside dark/orange cards.
 */
function IconTile({
  icon,
  logo,
  logoAlt = '',
  logoMono = false,
  tone = 'auto',
  size = 56,
  glow = true,
  glowOpacity,
  iconColor = 'var(--orange)',
  iconSize,
  children,
  style,
  ...rest
}) {
  const t = TONES[tone] || TONES.auto;
  // Logo tiles use the same build with a softer glow (8%) so it doesn't compete with brand colors
  const op = glowOpacity ?? (logo ? 'var(--tile-glow-opacity-logo)' : t.glow);
  const ls = Math.round(size * 0.5);
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      display: 'inline-block',
      flexShrink: 0,
      width: size,
      height: size,
      padding: 1,
      borderRadius: 'var(--radius-tile)',
      background: t.edge,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("span", {
    style: {
      position: 'relative',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      width: '100%',
      height: '100%',
      borderRadius: 'var(--radius-tile-inner)',
      background: t.inner,
      overflow: 'hidden'
    }
  }, glow && /*#__PURE__*/React.createElement("span", {
    "aria-hidden": "true",
    style: {
      position: 'absolute',
      inset: 0,
      background: 'radial-gradient(' + size + 'px circle at 50% 100%, var(--orange), transparent)',
      opacity: op
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      position: 'relative',
      display: 'flex'
    }
  }, logo ? /*#__PURE__*/React.createElement("img", {
    src: logo,
    alt: logoAlt,
    width: ls,
    height: ls,
    style: {
      display: 'block',
      filter: logoMono ? 'var(--logo-mono-filter, none)' : undefined
    }
  }) : icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: iconSize || Math.round(size * 0.43),
    color: iconColor
  }) : children)));
}
Object.assign(__ds_scope, { IconTile });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/tiles/IconTile.jsx", error: String((e && e.message) || e) }); }

// components/tiles/BrandTile.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Brand-logo registry (paths relative to assets/brands/). Files are copied, never redrawn:
 * AI platforms → LobeHub (@lobehub/icons-static-svg, MIT) in assets/brands/lobehub/;
 * search / commerce / social → Simple Icons in each brand's own color.
 */
const BRAND_LOGOS = {
  chatgpt: 'lobehub/openai-white.svg',
  openai: 'lobehub/openai-white.svg',
  gemini: 'lobehub/gemini-color.svg',
  claude: 'lobehub/claude-color.svg',
  perplexity: 'lobehub/perplexity-color.svg',
  deepseek: 'lobehub/deepseek-color.svg',
  grok: 'lobehub/grok-white.svg',
  copilot: 'lobehub/copilot-color.svg',
  metaai: 'lobehub/metaai-color.svg',
  mistral: 'lobehub/mistral-color.svg',
  google: 'lobehub/google-color.svg',
  googlemaps: 'googlemaps.svg',
  googleanalytics: 'googleanalytics.svg',
  googlesearchconsole: 'googlesearchconsole.svg',
  googleads: 'googleads.svg',
  semrush: 'semrush.svg',
  applenews: 'applenews.svg',
  meta: 'meta.svg',
  shopify: 'shopify.svg',
  woocommerce: 'woocommerce.svg',
  wordpress: 'wordpress.svg',
  x: 'x.svg',
  youtube: 'youtube.svg',
  tiktok: 'tiktok.svg',
  facebook: 'facebook.svg',
  whatsapp: 'whatsapp.svg'
};
const MONO = {
  chatgpt: 1,
  openai: 1,
  grok: 1
};

/**
 * Third-party brand logo in the exact IconTile build (edge → inner → bottom-center glow at 8%).
 * Tone follows the surface: dark on dark sections, light on white/cream. With `label` it becomes a chip
 * (outline pill-card in the surface's card style) holding the tile + brand name.
 */
function BrandTile({
  brand,
  basePath = 'assets/brands/',
  src,
  icon,
  alt = '',
  label,
  size = 48,
  tone = 'auto',
  style,
  ...rest
}) {
  const file = src || (brand && BRAND_LOGOS[brand] ? basePath + BRAND_LOGOS[brand] : undefined);
  const mono = !!(brand && MONO[brand]);
  const tile = /*#__PURE__*/React.createElement(__ds_scope.IconTile, {
    tone: tone,
    size: size,
    logo: file,
    logoAlt: label ? '' : alt,
    logoMono: mono,
    icon: file ? undefined : icon,
    iconSize: Math.round(size * 0.46)
  });
  if (!label) return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      display: 'inline-flex',
      ...style
    }
  }, rest), tile);
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 14,
      padding: 8,
      paddingInlineEnd: 22,
      borderRadius: 'var(--radius-card)',
      background: 'linear-gradient(var(--card-bg),var(--card-bg)) padding-box, var(--card-edge) border-box',
      border: '1px solid transparent',
      fontFamily: 'var(--font-sans)',
      fontSize: 16,
      fontWeight: 600,
      color: 'var(--text-heading)',
      whiteSpace: 'nowrap',
      ...style
    }
  }, rest), tile, /*#__PURE__*/React.createElement("span", null, label));
}
Object.assign(__ds_scope, { BRAND_LOGOS, BrandTile });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/tiles/BrandTile.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/Chrome.jsx
try { (() => {
(() => {
  const {
    Header,
    FooterE,
    Highlight
  } = window.LinkawyDesignSystem_430d5e;
  const A = '../../assets/';

  // Wrap one key phrase of a heading in the highlighter mark
  function hl(title, phrase) {
    if (!phrase || title.indexOf(phrase) < 0) return title;
    const i = title.indexOf(phrase);
    return /*#__PURE__*/React.createElement(React.Fragment, null, title.slice(0, i), /*#__PURE__*/React.createElement(Highlight, null, phrase), title.slice(i + phrase.length));
  }
  const grid = (min, gap = 24) => ({
    display: 'grid',
    gridTemplateColumns: `repeat(auto-fit, minmax(min(100%, ${min}px), 1fr))`,
    gap
  });

  // Image frame (r16). Real photos/screenshots live on linkawy.io; when they can't load, a labeled placeholder shows instead.
  function Frame({
    src,
    alt = '',
    label,
    ratio = '16/10',
    bg = 'var(--cream)',
    style,
    fit = 'cover'
  }) {
    // Remote linkawy.io images block hotlinking, so they render as labeled placeholders; local files load normally.
    const [failed, setFailed] = React.useState(!src || /^https?:/.test(src));
    return /*#__PURE__*/React.createElement("div", {
      style: {
        position: 'relative',
        borderRadius: 'var(--radius-card)',
        overflow: 'hidden',
        background: bg,
        border: '1px solid var(--border-card)',
        aspectRatio: ratio,
        ...style
      }
    }, !failed && /*#__PURE__*/React.createElement("img", {
      src: src,
      alt: alt,
      onError: () => setFailed(true),
      style: {
        width: '100%',
        height: '100%',
        objectFit: fit,
        display: 'block'
      }
    }), failed && /*#__PURE__*/React.createElement("div", {
      style: {
        position: 'absolute',
        inset: 0,
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        padding: 16,
        textAlign: 'center',
        fontSize: 13,
        color: 'var(--text-muted)',
        backgroundImage: 'repeating-linear-gradient(135deg, transparent 0 14px, rgba(0,0,0,.025) 14px 15px)'
      }
    }, label || alt || 'Image'));
  }
  function SiteHeader({
    t,
    lang,
    page,
    go,
    toggleLang
  }) {
    const n = t.nav;
    return /*#__PURE__*/React.createElement(Header, {
      logoSrc: A + 'logos/linkawy-' + lang + '-logo.svg',
      logoAlt: lang === 'ar' ? 'لينكاوي' : 'Linkawy',
      onNavigate: it => go(it.page || 'home'),
      links: [{
        label: n.home,
        page: 'home',
        active: page === 'home'
      }, {
        label: n.services,
        active: page === 'service',
        items: n.serviceItems.map((s, i) => ({
          label: s,
          page: i === 2 ? 'service' : 'service'
        }))
      }, {
        label: n.blog,
        page: 'blog',
        active: page === 'blog'
      }, {
        label: n.resources,
        page: 'home'
      }, {
        label: n.learn,
        page: 'home'
      }],
      langSwitch: {
        label: n.lang,
        onClick: toggleLang
      },
      cta: {
        label: n.quote,
        onClick: () => go('home', 'contact')
      }
    });
  }
  function SiteFooter({
    t,
    lang,
    withCta = true,
    go
  }) {
    const f = t.footer;
    return /*#__PURE__*/React.createElement(FooterE, {
      logoSrc: A + 'logos/linkawy-' + lang + '-logo.svg',
      sunsetSrc: withCta ? A + 'images/sunset-dark-to-cream.png' : undefined,
      cta: withCta ? {
        title: f.ctaTitle,
        text: f.ctaText,
        label: f.ctaLabel,
        onClick: () => go('home', 'contact')
      } : undefined,
      description: f.desc,
      socials: [{
        icon: 'Linkedin',
        label: 'LinkedIn'
      }, {
        icon: 'Youtube',
        label: 'YouTube'
      }, {
        icon: 'Facebook',
        label: 'Facebook'
      }, {
        icon: 'MessageCircle',
        label: 'WhatsApp'
      }],
      columns: f.cols.map(([title, links]) => ({
        title,
        links: links.map(l => ({
          label: l
        }))
      })),
      contact: {
        title: f.contactTitle,
        items: [{
          icon: 'MapPin',
          label: f.location
        }, {
          icon: 'Mail',
          label: f.email,
          href: 'mailto:info@linkawy.io'
        }]
      },
      copyright: f.copyright,
      style: withCta ? undefined : {
        paddingTop: 64
      }
    });
  }
  Object.assign(window, {
    lkHL: hl,
    lkGrid: grid,
    LkFrame: Frame,
    SiteHeader,
    SiteFooter,
    LK_A: A
  });
})();
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/Chrome.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/HomeBottom.jsx
try { (() => {
(() => {
  const {
    Section,
    SectionHeading,
    Button,
    Card,
    CardText,
    IconTile,
    Tag,
    NumberBadge,
    FAQ,
    Input,
    Icon
  } = window.LinkawyDesignSystem_430d5e;
  const hl = window.lkHL,
    grid = window.lkGrid,
    Frame = window.LkFrame;
  function Process({
    t,
    scrollTo
  }) {
    const p = t.process;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "white",
      id: "process"
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      title: hl(p.title, p.hl),
      subtitle: p.sub,
      maxWidth: 820
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(320, 20),
        marginTop: 'var(--space-block)'
      }
    }, p.steps.map(([label, title, body], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      padding: 28,
      style: {
        gap: 18
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        alignItems: 'center',
        gap: 12
      }
    }, /*#__PURE__*/React.createElement(NumberBadge, null, i + 1), /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        fontWeight: 500,
        color: 'var(--text-accent)'
      }
    }, label)), /*#__PURE__*/React.createElement(CardText, {
      title: title
    }, body)))), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        justifyContent: 'center',
        marginTop: 'var(--space-block)'
      }
    }, /*#__PURE__*/React.createElement(Button, {
      icon: "ArrowRight",
      onClick: () => scrollTo('contact')
    }, p.cta)));
  }
  function Reasons({
    t
  }) {
    const r = t.reasons;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "cream"
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      title: hl(r.title, r.hl)
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(320, 20),
        marginTop: 'var(--space-block)'
      }
    }, r.items.map(([title, body], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      variant: i === r.highlight ? 'highlight' : 'default',
      padding: 28,
      style: {
        gap: 18
      }
    }, /*#__PURE__*/React.createElement(NumberBadge, {
      variant: i === r.highlight ? 'gradient' : 'dark'
    }, i + 1), /*#__PURE__*/React.createElement(CardText, {
      title: title
    }, body)))));
  }
  function Benefits({
    t
  }) {
    const b = t.benefits;
    const [active, setActive] = React.useState(0);
    return /*#__PURE__*/React.createElement(Section, {
      bg: "white"
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      title: hl(b.title, b.hl),
      maxWidth: 820
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexWrap: 'wrap',
        gap: 48,
        marginTop: 'var(--space-block)',
        alignItems: 'center'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1 1 320px',
        display: 'flex',
        flexDirection: 'column'
      }
    }, b.items.map(([title, body], i) => {
      const on = i === active;
      return /*#__PURE__*/React.createElement("button", {
        key: i,
        type: "button",
        onClick: () => setActive(i),
        style: {
          textAlign: 'start',
          background: 'none',
          border: 0,
          cursor: 'pointer',
          padding: '22px 0',
          fontFamily: 'var(--font-sans)',
          position: 'relative',
          borderTop: '1px solid var(--border-light)'
        }
      }, on && /*#__PURE__*/React.createElement("span", {
        style: {
          position: 'absolute',
          top: -1,
          insetInline: 0,
          height: 2,
          background: 'var(--gradient-primary)'
        }
      }), /*#__PURE__*/React.createElement("span", {
        style: {
          display: 'flex',
          alignItems: 'center',
          gap: 12,
          fontSize: 'var(--fs-card)',
          lineHeight: 'var(--lh-card)',
          fontWeight: 600,
          color: on ? 'var(--text-heading)' : 'var(--text-muted)'
        }
      }, /*#__PURE__*/React.createElement("span", {
        className: "lk-tnum",
        style: {
          color: on ? 'var(--orange)' : 'var(--text-muted)',
          fontSize: 15
        }
      }, "0", i + 1), title), /*#__PURE__*/React.createElement("div", {
        style: {
          display: 'grid',
          gridTemplateRows: on ? '1fr' : '0fr',
          transition: 'grid-template-rows var(--dur-slow) var(--ease-out)'
        }
      }, /*#__PURE__*/React.createElement("p", {
        style: {
          overflow: 'hidden',
          margin: 0,
          paddingTop: on ? 10 : 0,
          fontSize: 'var(--fs-body)',
          lineHeight: 'var(--lh-body)',
          color: 'var(--text-body)'
        }
      }, body)));
    })), /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1.4 1 440px'
      }
    }, /*#__PURE__*/React.createElement(Frame, {
      src: window.LK_IMG + b.items[active][2],
      alt: b.items[active][0],
      ratio: "4/3",
      fit: "contain"
    }))));
  }
  function Blog({
    t,
    go
  }) {
    const b = t.blog;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "cream"
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        alignItems: 'flex-end',
        justifyContent: 'space-between',
        gap: 24,
        flexWrap: 'wrap'
      }
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      align: "start",
      title: b.title,
      subtitle: b.sub
    }), /*#__PURE__*/React.createElement(Button, {
      variant: "dark",
      icon: "ArrowRight",
      onClick: () => go('blog')
    }, b.all)), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(300, 20),
        marginTop: 'var(--space-block)'
      }
    }, b.posts.map(([cat, title, excerpt, read, img], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      padding: 12,
      interactive: true,
      onClick: () => go('blog'),
      style: {
        gap: 0,
        cursor: 'pointer'
      }
    }, /*#__PURE__*/React.createElement(Frame, {
      src: img,
      alt: "",
      label: title,
      ratio: "16/9"
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        padding: '20px 12px 12px',
        display: 'flex',
        flexDirection: 'column',
        gap: 12,
        flex: 1
      }
    }, /*#__PURE__*/React.createElement(Tag, {
      variant: "accent",
      style: {
        alignSelf: 'flex-start'
      }
    }, cat), /*#__PURE__*/React.createElement(CardText, {
      title: title
    }, excerpt), /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        color: 'var(--text-muted)',
        marginTop: 'auto'
      }
    }, b.author, " \xB7 ", read))))));
  }
  function Founder({
    t,
    scrollTo
  }) {
    const f = t.founder;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "white"
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexWrap: 'wrap',
        gap: '40px 72px',
        alignItems: 'center'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1 1 360px'
      }
    }, /*#__PURE__*/React.createElement(Frame, {
      src: window.LK_IMG + 'ali-atwa-seo-consulting.webp',
      alt: f.name,
      ratio: "1/1"
    })), /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1.2 1 400px',
        display: 'flex',
        flexDirection: 'column',
        gap: 24
      }
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      align: "start",
      eyebrow: f.eyebrow,
      title: hl(f.title, f.hl),
      subtitle: f.body
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexDirection: 'column'
      }
    }, /*#__PURE__*/React.createElement("strong", {
      style: {
        color: 'var(--text-heading)',
        fontWeight: 600
      }
    }, f.name), /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        color: 'var(--text-muted)'
      }
    }, f.role)), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement(Button, {
      icon: "ArrowRight",
      onClick: () => scrollTo('contact')
    }, f.cta)))));
  }
  function Faq({
    t,
    scrollTo
  }) {
    const f = t.faq;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "white",
      padTop: 0
    }, /*#__PURE__*/React.createElement(FAQ, {
      title: f.title,
      subtitle: f.sub,
      items: f.items.map(([q, a]) => ({
        q,
        a
      })),
      action: /*#__PURE__*/React.createElement(Button, {
        variant: "dark",
        icon: "ArrowRight",
        onClick: () => scrollTo('contact')
      }, f.cta)
    }));
  }
  function Results({
    t,
    scrollTo
  }) {
    const r = t.results;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "cream-warm"
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      eyebrow: r.eyebrow,
      title: r.title,
      subtitle: r.sub
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(320, 16),
        marginTop: 'var(--space-block)'
      }
    }, [1, 2, 3, 4, 5, 6].map(n => /*#__PURE__*/React.createElement(Frame, {
      key: n,
      src: window.LK_IMG + 'results/result-' + n + '.webp',
      alt: "",
      label: (n % 2 ? 'Search Console' : 'Salla analytics') + ' screenshot',
      ratio: "16/10",
      bg: "var(--white)"
    }))), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        justifyContent: 'center',
        marginTop: 'var(--space-block)'
      }
    }, /*#__PURE__*/React.createElement(Button, {
      icon: "ArrowRight",
      onClick: () => scrollTo('contact')
    }, r.cta)));
  }
  function Contact({
    t
  }) {
    const c = t.contact;
    const [sent, setSent] = React.useState(false);
    return /*#__PURE__*/React.createElement(Section, {
      bg: "dark",
      id: "contact",
      beforeSunset: true
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexWrap: 'wrap',
        gap: '40px 72px',
        alignItems: 'flex-start'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1 1 320px',
        display: 'flex',
        flexDirection: 'column',
        gap: 32
      }
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      align: "start",
      title: c.title,
      subtitle: c.sub
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexDirection: 'column',
        gap: 16
      }
    }, c.perks.map(([icon, label]) => /*#__PURE__*/React.createElement("div", {
      key: label,
      style: {
        display: 'flex',
        alignItems: 'center',
        gap: 14,
        color: 'var(--text-heading)',
        fontWeight: 500
      }
    }, /*#__PURE__*/React.createElement(IconTile, {
      icon: icon,
      size: 44,
      iconSize: 20
    }), label)))), /*#__PURE__*/React.createElement(Card, {
      on: "dark",
      padding: 32,
      style: {
        flex: '1.4 1 460px'
      }
    }, sent ? /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        textAlign: 'center',
        gap: 16,
        padding: '48px 0'
      }
    }, /*#__PURE__*/React.createElement(IconTile, {
      icon: "CircleCheck"
    }), /*#__PURE__*/React.createElement(CardText, {
      title: c.ok
    }, c.okSub), /*#__PURE__*/React.createElement(Button, {
      variant: "outline",
      size: "sm",
      onClick: () => setSent(false)
    }, c.send)) : /*#__PURE__*/React.createElement("form", {
      onSubmit: e => {
        e.preventDefault();
        setSent(true);
      },
      style: {
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fit, minmax(min(100%, 220px), 1fr))',
        gap: 16
      }
    }, /*#__PURE__*/React.createElement(Input, {
      label: c.name,
      required: true
    }), /*#__PURE__*/React.createElement(Input, {
      label: c.email,
      type: "email",
      required: true
    }), /*#__PURE__*/React.createElement(Input, {
      label: c.phone,
      type: "tel",
      inputStyle: {
        direction: 'ltr',
        textAlign: 'start'
      }
    }), /*#__PURE__*/React.createElement(Input, {
      label: c.company
    }), /*#__PURE__*/React.createElement(Input, {
      label: c.site,
      placeholder: "https://",
      inputStyle: {
        direction: 'ltr'
      }
    }), /*#__PURE__*/React.createElement(Input, {
      as: "select",
      label: c.budget,
      placeholder: c.budgetPh,
      options: c.budgets
    }), /*#__PURE__*/React.createElement(Input, {
      as: "textarea",
      label: c.goals,
      rows: 4,
      style: {
        gridColumn: '1 / -1'
      }
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        gridColumn: '1 / -1'
      }
    }, /*#__PURE__*/React.createElement(Button, {
      type: "submit",
      size: "lg",
      fullWidth: true,
      icon: "Send"
    }, c.send))))));
  }
  Object.assign(window, {
    HomeProcess: Process,
    HomeReasons: Reasons,
    HomeBenefits: Benefits,
    HomeBlog: Blog,
    HomeFounder: Founder,
    HomeFaq: Faq,
    HomeResults: Results,
    HomeContact: Contact
  });
})();
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/HomeBottom.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/HomeTop.jsx
try { (() => {
(() => {
  const {
    Section,
    SectionHeading,
    NewLabel,
    Accent,
    Button,
    Card,
    CardText,
    IconTile,
    BrandTile,
    Tag,
    Sunset,
    NumberBadge,
    LogoMarquee,
    Icon
  } = window.LinkawyDesignSystem_430d5e;
  const A = window.LK_A,
    hl = window.lkHL,
    grid = window.lkGrid;
  // Client logo SVGs live on linkawy.io and can't be hotlinked — names in plain type until the files are supplied.
  const clientLogos = ['Dinar', 'Asharq Bloomberg', 'Move', 'Alyom Digital', 'Inspire', 'Francis', 'Aswaq', 'Reef'].map(n => ({
    label: n,
    alt: n
  }));
  function PlatformCard({
    p,
    i
  }) {
    const [key, value, label] = p;
    return /*#__PURE__*/React.createElement(Card, {
      on: "dark",
      variant: i === 0 ? 'highlight' : 'default',
      padding: 16,
      style: {
        flexDirection: 'row',
        alignItems: 'center',
        gap: 14
      }
    }, /*#__PURE__*/React.createElement(BrandTile, {
      brand: key,
      basePath: A + 'brands/',
      alt: label,
      size: 44
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexDirection: 'column',
        minWidth: 0
      }
    }, /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 16,
        fontWeight: 600,
        color: 'var(--text-heading)',
        direction: 'ltr',
        unicodeBidi: 'isolate',
        textAlign: 'start'
      }
    }, value), /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        color: 'var(--text-body)'
      }
    }, label)));
  }
  function Hero({
    t,
    scrollTo
  }) {
    const h = t.hero;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "dark",
      padTop: 96
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        gap: 28
      }
    }, /*#__PURE__*/React.createElement(NewLabel, {
      badge: h.badge
    }, h.label), /*#__PURE__*/React.createElement(SectionHeading, {
      level: 1,
      display: true,
      maxWidth: 880,
      title: /*#__PURE__*/React.createElement(React.Fragment, null, h.pre, /*#__PURE__*/React.createElement(Accent, null, h.accent), h.post),
      subtitle: h.sub,
      actions: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Button, {
        icon: "ArrowRight",
        size: "lg",
        onClick: () => scrollTo('services')
      }, h.primary), /*#__PURE__*/React.createElement(Button, {
        variant: "outline",
        size: "lg",
        onClick: () => scrollTo('process')
      }, h.secondary))
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        alignItems: 'center',
        gap: 28,
        flexWrap: 'wrap',
        justifyContent: 'center',
        marginTop: 8
      }
    }, /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        color: 'var(--text-muted)'
      }
    }, h.clients), clientLogos.slice(0, 4).filter((l, i) => i !== 2).map(l => /*#__PURE__*/React.createElement("span", {
      key: l.alt,
      style: {
        fontSize: 18,
        fontWeight: 700,
        color: 'var(--white)',
        opacity: 0.6
      }
    }, l.label)))), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(300, 16),
        marginTop: 72
      }
    }, h.platforms.map((p, i) => /*#__PURE__*/React.createElement(PlatformCard, {
      key: i,
      p: p,
      i: i
    }))), /*#__PURE__*/React.createElement("div", {
      style: {
        marginTop: 40,
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        gap: 12,
        flexWrap: 'wrap'
      }
    }, /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 15,
        color: 'var(--text-body)',
        marginInlineEnd: 8
      }
    }, h.platformsTitle), ['Shopify', 'Salla', 'Zid', 'WooCommerce'].map(p => /*#__PURE__*/React.createElement(Tag, {
      key: p
    }, p + ' SEO'))));
  }
  function Services({
    t,
    go,
    scrollTo
  }) {
    const s = t.services;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "white",
      id: "services"
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      eyebrow: s.eyebrow,
      title: hl(s.title, s.hl),
      subtitle: s.sub
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(250, 20),
        marginTop: 'var(--space-block)'
      }
    }, s.items.map(([icon, title, tag, body], i) => {
      const key = i === s.items.length - 1;
      return /*#__PURE__*/React.createElement(Card, {
        key: i,
        variant: key ? 'highlight' : 'default',
        interactive: true,
        onClick: () => key && go('service'),
        padding: 28,
        style: {
          gap: 20,
          cursor: key ? 'pointer' : 'default'
        }
      }, /*#__PURE__*/React.createElement("div", {
        style: {
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'space-between',
          gap: 12
        }
      }, /*#__PURE__*/React.createElement(IconTile, {
        icon: icon
      }), /*#__PURE__*/React.createElement(Tag, {
        variant: key ? 'accent' : 'neutral'
      }, tag)), /*#__PURE__*/React.createElement(CardText, {
        title: title
      }, body), key && /*#__PURE__*/React.createElement("span", {
        style: {
          display: 'inline-flex',
          alignItems: 'center',
          gap: 6,
          color: 'var(--orange)',
          fontWeight: 600,
          fontSize: 14,
          marginTop: 'auto'
        }
      }, t.nav.services, " ", /*#__PURE__*/React.createElement(Icon, {
        name: "ArrowRight",
        size: 16
      })));
    })), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        justifyContent: 'center',
        marginTop: 'var(--space-block)'
      }
    }, /*#__PURE__*/React.createElement(Button, {
      variant: "dark",
      icon: "ArrowRight",
      onClick: () => scrollTo('contact')
    }, s.cta)));
  }
  function Proof({
    t
  }) {
    const p = t.proof;
    return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Section, {
      bg: "cream",
      padBottom: 24
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        textAlign: 'center',
        gap: 20,
        maxWidth: 900,
        marginInline: 'auto'
      }
    }, /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        fontWeight: 500,
        color: 'var(--text-accent)'
      }
    }, p.label), /*#__PURE__*/React.createElement("h2", {
      style: {
        fontSize: 'var(--fs-section)',
        lineHeight: 'var(--lh-section)',
        letterSpacing: 'var(--tracking-section)',
        fontWeight: 700
      }
    }, p.pre, /*#__PURE__*/React.createElement(Accent, null, p.num), p.post), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        gap: 12
      }
    }, /*#__PURE__*/React.createElement(BrandTile, {
      brand: "google",
      basePath: A + 'brands/',
      label: "Google"
    }), /*#__PURE__*/React.createElement(BrandTile, {
      brand: "chatgpt",
      basePath: A + 'brands/',
      label: "ChatGPT"
    })))), /*#__PURE__*/React.createElement(Sunset, {
      src: A + 'images/sunset-cream-to-dark.png'
    }));
  }
  function Strategy({
    t
  }) {
    const s = t.strategy;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "dark",
      padTop: 24,
      padBottom: 80
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexWrap: 'wrap',
        gap: '40px 72px',
        alignItems: 'flex-start'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1 1 320px',
        position: 'sticky',
        top: 24
      }
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      align: "start",
      title: hl(s.title, s.hl),
      subtitle: s.sub
    })), /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1.5 1 460px',
        display: 'flex',
        flexDirection: 'column',
        gap: 14
      }
    }, s.steps.map(([title, body], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      on: "dark",
      variant: i === s.steps.length - 1 ? 'highlight' : 'default',
      padding: 24,
      style: {
        flexDirection: 'row',
        gap: 20,
        alignItems: 'flex-start'
      }
    }, /*#__PURE__*/React.createElement(NumberBadge, {
      variant: i === s.steps.length - 1 ? 'dark' : 'gradient'
    }, String(i + 1).padStart(2, '0')), /*#__PURE__*/React.createElement(CardText, {
      title: title
    }, body))))));
  }
  function Partners({
    t,
    go
  }) {
    const p = t.partners,
      posts = t.blog.posts;
    return /*#__PURE__*/React.createElement(Section, {
      bg: "dark",
      padTop: 40
    }, /*#__PURE__*/React.createElement("h2", {
      style: {
        textAlign: 'center',
        fontSize: 'var(--fs-section)',
        lineHeight: 'var(--lh-section)',
        letterSpacing: 'var(--tracking-section)',
        fontWeight: 700,
        marginBottom: 'var(--space-block)'
      }
    }, p.title), /*#__PURE__*/React.createElement(LogoMarquee, {
      tone: "light",
      logos: clientLogos
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        alignItems: 'flex-end',
        justifyContent: 'space-between',
        gap: 16,
        marginTop: 'var(--space-section-sm)',
        marginBottom: 24,
        flexWrap: 'wrap'
      }
    }, /*#__PURE__*/React.createElement("h3", {
      style: {
        fontSize: 24,
        fontWeight: 700,
        letterSpacing: 'var(--tracking-section)'
      }
    }, p.stories), /*#__PURE__*/React.createElement(Button, {
      variant: "outline",
      size: "sm",
      icon: "ArrowRight",
      onClick: () => go('blog')
    }, p.more)), /*#__PURE__*/React.createElement("div", {
      style: grid(300, 16)
    }, posts.map(([cat, title,, read], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      on: "dark",
      padding: 24,
      interactive: true,
      onClick: () => go('blog'),
      style: {
        gap: 16,
        cursor: 'pointer'
      }
    }, /*#__PURE__*/React.createElement(Tag, null, cat), /*#__PURE__*/React.createElement(CardText, {
      title: title
    }), /*#__PURE__*/React.createElement("span", {
      style: {
        display: 'inline-flex',
        alignItems: 'center',
        gap: 6,
        fontSize: 13,
        color: 'var(--text-muted)',
        marginTop: 'auto'
      }
    }, /*#__PURE__*/React.createElement(Icon, {
      name: "Clock",
      size: 14
    }), read)))));
  }
  Object.assign(window, {
    HomeHero: Hero,
    HomeServices: Services,
    HomeProof: Proof,
    HomeStrategy: Strategy,
    HomePartners: Partners
  });
})();
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/HomeTop.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/Pages.jsx
try { (() => {
(() => {
  const {
    Section,
    SectionHeading,
    Accent,
    Button,
    Card,
    CardText,
    IconTile,
    BrandTile,
    Tag,
    Stat,
    FAQ,
    CTABlock,
    Icon
  } = window.LinkawyDesignSystem_430d5e;
  const A = window.LK_A,
    hl = window.lkHL,
    grid = window.lkGrid,
    Frame = window.LkFrame;
  function Crumb({
    items,
    go
  }) {
    return /*#__PURE__*/React.createElement("nav", {
      style: {
        display: 'flex',
        alignItems: 'center',
        gap: 8,
        fontSize: 13,
        color: 'var(--text-muted)'
      }
    }, items.map((it, i) => /*#__PURE__*/React.createElement(React.Fragment, {
      key: i
    }, i > 0 && /*#__PURE__*/React.createElement(Icon, {
      name: "ChevronRight",
      size: 14
    }), it.page ? /*#__PURE__*/React.createElement("a", {
      href: "#",
      onClick: e => {
        e.preventDefault();
        go(it.page);
      },
      style: {
        color: 'var(--text-body)'
      }
    }, it.label) : /*#__PURE__*/React.createElement("span", {
      style: {
        color: 'var(--text-heading)'
      }
    }, it.label))));
  }
  function ServicePage({
    t,
    go,
    lang
  }) {
    const g = t.geo;
    return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Section, {
      bg: "dark",
      padTop: 72
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexWrap: 'wrap',
        gap: '48px 72px',
        alignItems: 'center'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1.3 1 440px',
        display: 'flex',
        flexDirection: 'column',
        gap: 24
      }
    }, /*#__PURE__*/React.createElement(Crumb, {
      go: go,
      items: [{
        label: t.nav.home,
        page: 'home'
      }, {
        label: g.crumb,
        page: 'home'
      }, {
        label: g.title
      }]
    }), /*#__PURE__*/React.createElement(SectionHeading, {
      level: 1,
      display: true,
      align: "start",
      title: /*#__PURE__*/React.createElement(React.Fragment, null, g.title, " ", /*#__PURE__*/React.createElement(Accent, null, g.accent)),
      subtitle: g.sub,
      actions: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Button, {
        size: "lg",
        icon: "ArrowRight",
        onClick: () => go('home', 'contact')
      }, g.primary), /*#__PURE__*/React.createElement(Button, {
        size: "lg",
        variant: "outline"
      }, g.secondary))
    })), /*#__PURE__*/React.createElement("div", {
      style: {
        flex: '1 1 320px',
        display: 'flex',
        flexDirection: 'column',
        gap: 12
      }
    }, [['google', 'Google AI Overviews'], ['chatgpt', 'ChatGPT'], ['gemini', 'Gemini'], ['perplexity', 'Perplexity'], ['claude', 'Claude']].map(([k, l]) => /*#__PURE__*/React.createElement(BrandTile, {
      key: k,
      brand: k,
      basePath: A + 'brands/',
      label: l,
      style: {
        width: '100%'
      }
    }))))), /*#__PURE__*/React.createElement(Section, {
      bg: "white"
    }, /*#__PURE__*/React.createElement(SectionHeading, {
      title: hl(g.whatTitle, g.hl)
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        ...grid(250, 20),
        marginTop: 'var(--space-block)'
      }
    }, g.what.map(([icon, title, body], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      padding: 28,
      variant: i === 1 ? 'highlight' : 'default',
      style: {
        gap: 20
      }
    }, /*#__PURE__*/React.createElement(IconTile, {
      icon: icon
    }), /*#__PURE__*/React.createElement(CardText, {
      title: title
    }, body))))), /*#__PURE__*/React.createElement(Section, {
      bg: "cream",
      size: "sm"
    }, /*#__PURE__*/React.createElement("div", {
      style: grid(240, 20)
    }, g.stats.map(([v, l], i) => /*#__PURE__*/React.createElement(Card, {
      key: i,
      padding: 28
    }, /*#__PURE__*/React.createElement(Stat, {
      value: v,
      label: l
    }))))), /*#__PURE__*/React.createElement(Section, {
      bg: "white"
    }, /*#__PURE__*/React.createElement(FAQ, {
      title: t.faq.title,
      subtitle: t.faq.sub,
      items: t.faq.items.slice(0, 4).map(([q, a]) => ({
        q,
        a
      }))
    })), /*#__PURE__*/React.createElement(CTABlock, {
      title: t.ctaB.title,
      text: t.ctaB.text,
      actionLabel: t.ctaB.label,
      onAction: () => go('home', 'contact')
    }));
  }
  function BlogPost({
    t,
    go
  }) {
    const p = t.post;
    const [active, setActive] = React.useState(0);
    return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Section, {
      bg: "white",
      padTop: 64
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        maxWidth: 860,
        display: 'flex',
        flexDirection: 'column',
        gap: 20
      }
    }, /*#__PURE__*/React.createElement(Crumb, {
      go: go,
      items: [{
        label: t.nav.home,
        page: 'home'
      }, {
        label: p.crumb,
        page: 'blog'
      }, {
        label: p.cat
      }]
    }), /*#__PURE__*/React.createElement(Tag, {
      variant: "accent",
      style: {
        alignSelf: 'flex-start'
      }
    }, p.cat), /*#__PURE__*/React.createElement("h1", {
      style: {
        fontSize: 44,
        lineHeight: 'var(--lh-display)',
        letterSpacing: 'var(--tracking-display)',
        fontWeight: 700
      }
    }, p.title), /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        color: 'var(--text-muted)'
      }
    }, p.meta)), /*#__PURE__*/React.createElement(Frame, {
      src: "https://www.linkawy.io/wp-content/uploads/Search-KPIs-400x209.png",
      alt: "",
      ratio: "21/9",
      style: {
        marginTop: 'var(--space-block)'
      }
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        flexWrap: 'wrap',
        gap: '40px 72px',
        marginTop: 'var(--space-block)',
        alignItems: 'flex-start'
      }
    }, /*#__PURE__*/React.createElement("aside", {
      style: {
        flex: '0 1 260px',
        position: 'sticky',
        top: 24
      }
    }, /*#__PURE__*/React.createElement(Card, {
      padding: 20,
      style: {
        gap: 6,
        background: 'var(--cream)',
        border: '1px solid var(--border-light)'
      }
    }, /*#__PURE__*/React.createElement("span", {
      style: {
        fontSize: 13,
        fontWeight: 600,
        color: 'var(--text-heading)',
        marginBottom: 6
      }
    }, p.toc), p.sections.map(([h], i) => /*#__PURE__*/React.createElement("a", {
      key: i,
      href: "#",
      onClick: e => {
        e.preventDefault();
        setActive(i);
      },
      style: {
        fontSize: 14,
        lineHeight: 1.5,
        padding: '6px 0',
        color: i === active ? 'var(--orange)' : 'var(--text-body)',
        fontWeight: i === active ? 600 : 400
      }
    }, h)))), /*#__PURE__*/React.createElement("article", {
      style: {
        flex: '1 1 480px',
        maxWidth: 720,
        display: 'flex',
        flexDirection: 'column',
        gap: 16
      }
    }, p.sections.map(([h, body], i) => /*#__PURE__*/React.createElement(React.Fragment, {
      key: i
    }, /*#__PURE__*/React.createElement("h2", {
      style: {
        fontSize: 26,
        lineHeight: 'var(--lh-section)',
        letterSpacing: 'var(--tracking-section)',
        fontWeight: 700,
        marginTop: i ? 24 : 0
      }
    }, h), /*#__PURE__*/React.createElement("p", {
      style: {
        fontSize: 17,
        lineHeight: 1.8
      }
    }, body)))))), /*#__PURE__*/React.createElement(CTABlock, {
      title: t.ctaB.title,
      text: t.ctaB.text,
      actionLabel: t.ctaB.label,
      onAction: () => go('home', 'contact')
    }));
  }
  Object.assign(window, {
    ServicePage,
    BlogPost
  });
})();
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/Pages.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/content.js
try { (() => {
// Linkawy site copy — AR is from linkawy.io (Oct 2026); EN is a faithful translation for the English version.
window.LK_IMG = 'https://www.linkawy.io/wp-content/themes/linkawy/assets/images/';
window.LK_CONTENT = {
  ar: {
    nav: {
      home: 'الرئيسية',
      services: 'خدماتنا',
      blog: 'المدونة',
      resources: 'الموارد',
      learn: 'تعلم السيو',
      quote: 'اطلب عرض سعر',
      lang: 'English',
      serviceItems: ['التسويق الالكتروني', 'تحسين محركات البحث (SEO)', 'SEO الذكاء الإصطناعي (GEO)', 'تصميم متجر إلكتروني', 'خدمات الباك لينك', 'خدمة كتابة المحتوى']
    },
    hero: {
      label: 'نهيّئ متجرك لإجابات ChatGPT و Gemini',
      badge: 'جديد',
      pre: 'أفضل شركة سيو ',
      accent: 'للمتاجر الإلكترونية',
      post: ' والشركات',
      sub: 'اختيارك شركة سيو مناسبة لا يعني تحسين الترتيب فقط، بل بناء قناة نمو تربط محركات البحث بالمبيعات. نقدم استراتيجيات سيو تساعدك على تصدر النتائج وجذب زيارات مؤهلة تتحول إلى إيرادات مستدامة.',
      primary: 'اكتشف الخدمات',
      secondary: 'كيف نعمل؟',
      clients: 'عملاء تشرفنا بمعاونتهم:',
      platforms: [['google', 'Result #1', 'Google SERP'], ['gemini', 'AI Overview', 'Gemini'], ['chatgpt', 'LLMO / GEO', 'ChatGPT'], ['semrush', 'DR 80 +3', 'Authority Score'], ['googlemaps', 'Maps ranking', 'Local SEO'], ['applenews', 'Media coverage', 'Digital PR']],
      platformsTitle: 'شركة سيو رائدة في تحويل الزيارات إلى أرباح حقيقية عبر مختلف المنصات'
    },
    services: {
      eyebrow: 'خدماتنا',
      title: 'خدمات السيو التي نقدمها',
      hl: 'السيو',
      sub: 'استكشف استراتيجياتنا المخصصة التي تقدم التوجيه والدعم لمساعدتك على تصدر نتائج البحث وتحقيق النمو المستدام بثقة.',
      cta: 'أطلب استشارة مجانية',
      items: [['ShoppingBag', 'سيو شوبيفاي', 'Shopify SEO', 'نحسن الصفحات والمنتجات وبنية المحتوى في متجر شوبيفاي لرفع فرص الظهور وزيادة الزيارات المستهدفة.'], ['Store', 'سيو سلة', 'Salla SEO', 'تحسين الصفحات والأقسام والمنتجات والمحتوى الداخلي لمتاجر سلة لزيادة الزيارات العضوية والمبيعات.'], ['FileText', 'السيو الداخلي', 'On-Page SEO', 'العناوين والمحتوى والروابط الداخلية وهيكلة الصفحات، حتى تفهم محركات البحث صفحاتك بشكل أفضل.'], ['Link', 'السيو الخارجي', 'Off-Page SEO', 'روابط خلفية عالية الجودة من مواقع موثوقة وذات صلة ترفع موثوقية موقعك وترتيبه.'], ['ScanSearch', 'فحص مشاكل الموقع', 'SEO Audits', 'تدقيق شامل يكشف المشكلات التقنية ومشاكل السرعة والفهرسة والمحتوى، مع توصيات عملية.'], ['Lightbulb', 'استشارات SEO', 'SEO Consulting', 'رؤية واضحة وأولويات محددة تناسب مرحلة نمو مشروعك، سواء بدأت من الصفر أو تطوّر نتائجك.'], ['Code', 'السيو التقني', 'Technical SEO', 'سرعة الموقع وتجربة الجوال والأمان وبنية الروابط لضمان سهولة الزحف والفهرسة.'], ['Sparkles', 'سيو الذكاء الإصطناعي', 'GEO', 'محتوى واضح وموثوق ومنظم يسهل اقتباسه في محركات الإجابة وتجارب البحث بالذكاء الاصطناعي.']]
    },
    proof: {
      pre: 'في المتوسط ساعدنا عملاءنا في زيادة المبيعات العضوية لأكثر من ',
      num: '270%',
      post: ' عن طريق الزيارات المستهدفة من Google و ChatGPT',
      label: 'متوسط نمو المبيعات العضوية'
    },
    strategy: {
      title: 'تحسين محركات البحث... هو آخر خطوة عندنا',
      hl: 'آخر خطوة',
      sub: 'لأن أولويتنا هي زيادة مبيعاتك، خطوات عملنا تبدأ من البيزنس وتنتهي بالتسويق.',
      steps: [['تحليل السوق، والمنافسين، ونوايا الشراء', 'نبدأ بفهم السوق وتحليل الكلمات التي تعكس نية شراء حقيقية، والأسئلة التي يبحث عنها العميل قبل القرار.'], ['هندسة صفحات البيع ورفع معدلات التحويل', 'نحسن صفحات الهبوط لتكون مقنعة بصرياً ونصياً، فترتفع نسبة تحويل الزوار إلى مشترين.'], ['صناعة محتوى يبيع القيمة', 'محتوى يجيب على أسئلة العملاء ويعالج اعتراضاتهم، بدلاً من جذب زيارات غير مفيدة.'], ['التحسين لمحركات البحث والذكاء الاصطناعي', 'نحسن البنية التقنية وملاءمة الموقع لمعايير SEO وأنظمة الذكاء الاصطناعي لأقصى وصول عضوي.'], ['قياس الربحية.. وليس الترتيب', 'تقاريرنا تركز على ما يترجم إلى أرباح مثل ROAS، لا على مؤشرات الغرور كالترتيب أو حجم الزيارات.']]
    },
    partners: {
      title: 'شركاء النجاح',
      stories: 'قصص نجاح المتاجر',
      more: 'المزيد من قصص النجاح'
    },
    process: {
      title: 'كيف يتصدر موقعك النتائج الأولى على محركات البحث مع لينكاوي؟',
      hl: 'النتائج الأولى',
      sub: 'نتبع خطوات مدروسة لضمان تحسين ترتيب موقعك في محركات البحث وتحقيق نتائج ملموسة.',
      cta: 'ابدأ الآن',
      steps: [['الخطوة الأولى', 'نحلل موقعك لنكتشف فرص النمو', 'نراجع موقعك بالكامل، ونكتشف أين تضيع عليك الزيارات والفرص قبل منافسيك.'], ['الخطوة الثانية', 'نختار الكلمات التي تجذب عملاء حقيقيين', 'لا نطارد كلمات بلا قيمة، بل نستهدف ما يبحث عنه عملاؤك عندما يكونون مستعدين للشراء.'], ['الخطوة الثالثة', 'نبني استراتيجية سيو مصممة لك', 'خطة واضحة تشمل المحتوى والصفحات والبنية التقنية — بدون حلول جاهزة.'], ['الخطوة الرابعة', 'ننفّذ التحسينات ونحرّك النتائج', 'تنفيذ عملي خطوة بخطوة حتى يتحول موقعك إلى قناة جذب فعّالة.'], ['الخطوة الخامسة', 'نراقب الأداء ونحسّن باستمرار', 'نقيس النتائج ونعدّل الاستراتيجية باستمرار لضمان أفضل نمو ممكن.'], ['الخطوة السادسة', 'نتابع النتائج ونبني نموًا مستدامًا', 'تقارير واضحة وخطة طويلة المدى تضمن استمرار تفوّقك في نتائج البحث.']]
    },
    reasons: {
      title: '9 أسباب لاختيار لينكاوي',
      hl: '9 أسباب',
      highlight: 7,
      items: [['خبرة عابرة للقارات', 'أكثر من 10 أعوام من خدمات السيو في أسواق تنافسية مثل الإمارات والسعودية وأمريكا.'], ['الكلمات المفتاحية الأكثر ربحية', 'نستهدف العبارات التي تجلب لك عملاء وليس مجرد زيارات، لأعلى عائد على الاستثمار.'], ['نتائج موثقة في الظهور الرقمي', 'قصص نجاح في زيادة الزيارات العضوية لشركات كبرى والقفز إلى الصفحة الأولى.'], ['سيو تقني بالكامل', 'سرعة الموقع و Schema Markup وتجربة المستخدم لضمان الزحف والأرشفة بأفضل صورة.'], ['تقارير دورية وشفافية مطلقة', 'تقارير مفصلة وتواصل مباشر مع فريق العمل دون تعقيدات إدارية.'], ['مواكبة تحديثات الخوارزميات', 'نراقب خوارزميات Google باستمرار ونلتزم بـ White Hat SEO لحماية موقعك.'], ['روابط قوية واستراتيجية محتوى', 'بناء روابط من مواقع ذات سلطة عالية بالتوازي مع تسويق بالمحتوى يجعلك مرجعاً.'], ['استشارات مباشرة من المؤسس', 'تتعامل مع المهندس علي عطوة مباشرة، بقرارات مبنية على بيانات حقيقية.'], ['تدريب فريقك على السيو المستدام', 'ندرب فريقك على كتابة محتوى متوافق مع السيو والحفاظ على النتائج على المدى الطويل.']]
    },
    benefits: {
      title: 'نقود مشروعك نحو صدارة محركات البحث في 3 خطوات',
      hl: 'صدارة محركات البحث',
      items: [['فهم السوق والجمهور', 'نكتشف الفرص الأقوى ونحدد ما يبحث عنه عملاؤك المحتملون، لنبني أساساً يجعل الزيارات أكثر قيمة.', 'growth/seo-product-research.png'], ['خطة سيو واضحة الأهداف', 'لا نسعى إلى زيادة الأرقام شكليًا، بل نجذب زيارات مؤهلة تحمل نية شراء حقيقية.', 'growth/seo-marketing-plan.webp'], ['نتائج تنمو يومًا بعد يوم', 'السيو مسار نمو تراكمي؛ نحقق نمواً شهرياً مستمراً في الزيارات العضوية وفرص التحويل.', 'growth/sales-growth-dashboard.png']]
    },
    blog: {
      title: 'أحدث المقالات من المدونة',
      sub: 'نشارك معكم آخر التحديثات والاستراتيجيات في عالم تحسين محركات البحث.',
      all: 'تصفح كل المقالات',
      author: 'علي عطوة',
      posts: [['تحليلات', 'شرح جوجل أناليتكس: دليل شامل للمبتدئين', 'أي قرار تسويقي بدون قراءة سلوك الزوار قد يقودك إلى استنتاجات خاطئة.', '17 دقيقة قراءة', null], ['تحسين محركات البحث', 'قياس مؤشرات أداء الـ SEO في عصر الذكاء الاصطناعي', 'أهم مؤشرات أداء الـ SEO وكيف تربطها بأهدافك لنتائج ملموسة.', '13 دقيقة قراءة', 'https://www.linkawy.io/wp-content/uploads/Search-KPIs-400x209.png'], ['السيو الداخلي', 'تحسين عناوين URL موقعك لمحركات البحث', 'التفاصيل الصغيرة تصنع فارقاً كبيراً، وعناوين URL واحدة منها.', '9 دقائق قراءة', 'https://www.linkawy.io/wp-content/uploads/optimize-url-for-seo-400x211.png']]
    },
    founder: {
      eyebrow: 'أهلًا بالمؤسس',
      title: 'استشارات سيو برؤية بيزنس',
      hl: 'برؤية بيزنس',
      body: 'ندرك حجم الضغط الذي تواجهه كمؤسس وأنت ترى ميزانيتك تُستنزف في الإعلانات. صممنا هذه الاستشارات لتخرجك من مصيدة الدفع مقابل الظهور: تعمل مباشرة مع خبير سيو يمتلك رؤية بيزنس، بمنهجية نقلت شركات ناشئة من مجرد التواجد إلى الهيمنة عبر الزيارات المجانية.',
      cta: 'اطلب استشارة سيو',
      name: 'م. علي عطوة',
      role: 'مؤسس لينكاوي · 10+ سنوات في السيو'
    },
    faq: {
      title: 'الأسئلة الشائعة',
      sub: 'إجابات مباشرة عن الوقت والتكلفة والنتائج.',
      cta: 'تواصل معنا',
      items: [['ما هي خدمات SEO التي تقدمونها؟', 'السيو الداخلي والخارجي وبناء الروابط، السيو التقني، تحسين المحتوى، تحليل الكلمات المفتاحية، سيو المتاجر على شوبيفاي وسلة وزد، واستشارات السيو المتخصصة.'], ['كم من الوقت يستغرق تحسين ترتيب موقعي؟', 'السيو عملية تراكمية. تبدأ النتائج الملموسة عادةً خلال 3 إلى 6 أشهر وتتحسن باستمرار، حسب حالة الموقع والمنافسة وحجم العمل.'], ['هل تقدمون خدمات السيو للمتاجر الإلكترونية؟', 'نعم، نحن متخصصون في متاجر شوبيفاي وسلة وزد وووكومرس: صفحات المنتجات والتصنيفات والبنية التقنية.'], ['كيف يتم تحديد سعر خدمة السيو؟', 'حسب حجم الموقع، والمنافسة، والحالة التقنية، والأهداف، ونطاق العمل. نقدم عرض سعر مخصص بعد تحليل موقعك.'], ['هل يمكنكم ضمان المرتبة الأولى؟', 'لا يمكن لأي شركة سيو محترفة ضمان المرتبة الأولى، لكننا نضمن أفضل الممارسات ونمواً ملموساً في الترتيب والزيارات والمبيعات.'], ['كيف يتم قياس نجاح استراتيجية السيو؟', 'بنمو الزيارات العضوية، وتحسن ترتيب الكلمات المستهدفة، وزيادة التحويلات والمبيعات، والعائد على الاستثمار ROI.']]
    },
    results: {
      eyebrow: 'نتائج حقيقية',
      title: 'نتائج SEO',
      sub: 'شاهد النتائج من داخل الحسابات والمتاجر',
      cta: 'ابدأ قصة نجاحك الآن'
    },
    contact: {
      title: 'ابدأ رحلة تصدّر موقعك',
      sub: 'أخبرنا عن مشروعك وسنتواصل معك خلال 24 ساعة بخطة عمل مخصصة.',
      name: 'الاسم',
      email: 'البريد الإلكتروني',
      phone: 'رقم الهاتف',
      company: 'اسم الشركة',
      site: 'رابط الموقع',
      budget: 'الميزانية الشهرية',
      budgetPh: 'اختر الميزانية',
      goals: 'الأهداف والتحديات',
      send: 'إرسال الطلب',
      budgets: ['أقل من 750$', '750$ - 1,500$', '1,500$ - 3,000$', '3,000$ - 5,000$', '5,000$ - 10,000$', 'أكثر من 10,000$'],
      ok: 'تم إرسال طلبك بنجاح!',
      okSub: 'شكراً لتواصلك معنا. سنراجع طلبك ونتواصل معك خلال 24 ساعة بخطة عمل مخصصة.',
      perks: [['Clock', 'رد خلال 24 ساعة'], ['ClipboardCheck', 'تحليل مجاني لموقعك'], ['Users', 'تواصل مباشر مع المؤسس']]
    },
    footer: {
      ctaTitle: 'مستعد لتصدر نتائج البحث؟',
      ctaText: 'دعنا نستكشف الفرص معًا — سيحلل خبراؤنا موقعك ويقدمون خطة مخصصة لأهدافك.',
      ctaLabel: 'احجز استشارة مجانية',
      desc: 'شريكك الاستراتيجي في النمو الرقمي. نقدم حلول سيو وتصميم مواقع مبتكرة لضمان تصدرك النتائج.',
      cols: [['خدماتنا', ['شركة تسويق الكتروني', 'خدمات سيو', 'خدمات GEO / AI SEO', 'تصميم متاجر إلكترونية', 'خدمات باك لينك', 'شركة كتابة محتوى']], ['المصادر', ['المدونة', 'قاموس المصطلحات', 'شرح السيو للمبتدئين', 'مكتبة القوالب والأدوات', 'أوامر ومطالبات AI']], ['الشركة', ['من نحن', 'تواصل معنا', 'سياسة الخصوصية']]],
      contactTitle: 'اتصل بنا',
      location: 'الرياض، السعودية',
      email: 'info@linkawy.io',
      copyright: '© 2026 لينكاوي. جميع الحقوق محفوظة.'
    },
    ctaB: {
      title: 'مستعد لتصدر نتائج البحث؟',
      text: 'سيقوم خبراؤنا بتحليل موقعك وتقديم خطة مخصصة لتحقيق أهدافك.',
      label: 'احجز استشارة مجانية'
    },
    geo: {
      crumb: 'خدماتنا',
      title: 'سيو الذكاء الاصطناعي',
      accent: '(GEO)',
      sub: 'نهيّئ محتوى موقعك ليظهر ويُقتبس في محركات الإجابة: ChatGPT و Gemini و Perplexity و AI Overviews في Google.',
      primary: 'اطلب استشارة مجانية',
      secondary: 'شاهد النتائج',
      whatTitle: 'ماذا تشمل خدمة GEO؟',
      hl: 'GEO',
      what: [['Brain', 'فهم نوايا الأسئلة', 'نحدد الأسئلة التي يطرحها عملاؤك على أدوات الذكاء الاصطناعي قبل الشراء.'], ['FileText', 'محتوى قابل للاقتباس', 'إجابات واضحة ومنظمة وموثوقة تسهل على النماذج فهمها واقتباسها.'], ['Code', 'بيانات منظمة Schema', 'نعلّم صفحاتك ببيانات منظمة تربط علامتك بالكيانات والمنتجات.'], ['Radar', 'تتبع الظهور في الإجابات', 'نقيس ظهور علامتك في إجابات ChatGPT و Gemini ونحسّن باستمرار.']],
      stats: [['3x', 'ظهور أعلى في AI Overviews'], ['60%', 'من عمليات البحث تنتهي دون نقرة'], ['24h', 'للرد بخطة مبدئية']]
    },
    post: {
      crumb: 'المدونة',
      cat: 'تحسين محركات البحث',
      title: 'قياس مؤشرات أداء الـ SEO في عصر الذكاء الاصطناعي',
      meta: 'علي عطوة · 13 دقيقة قراءة · 29 أبريل 2026',
      toc: 'محتوى المقال',
      sections: [['لماذا تغيّرت مؤشرات الأداء؟', 'مع ظهور AI Overviews ومحركات الإجابة، لم تعد النقرات وحدها كافية لقياس نجاح السيو. أصبح الظهور داخل الإجابة نفسها مؤشراً مستقلاً يجب تتبعه.'], ['المؤشرات التي تترجم إلى أرباح', 'ركّز على الزيارات العضوية المؤهلة، ومعدل التحويل من البحث، والإيراد لكل زيارة، والعائد على الاستثمار. هذه الأرقام تخبرك إن كان السيو يبيع فعلاً.'], ['كيف تقيس الظهور في الذكاء الاصطناعي؟', 'راقب ذكر علامتك في إجابات ChatGPT و Gemini لأسئلة الشراء الأساسية، وتابع الزيارات القادمة من هذه المنصات في Google Analytics.']]
    }
  },
  en: {
    nav: {
      home: 'Home',
      services: 'Services',
      blog: 'Blog',
      resources: 'Resources',
      learn: 'Learn SEO',
      quote: 'Request a quote',
      lang: 'العربية',
      serviceItems: ['Digital marketing', 'Search engine optimization (SEO)', 'AI search optimization (GEO)', 'E-commerce store design', 'Backlink services', 'Content writing']
    },
    hero: {
      label: 'Now optimizing stores for ChatGPT & Gemini answers',
      badge: 'NEW',
      pre: 'The SEO agency for ',
      accent: 'e-commerce stores',
      post: ' and companies',
      sub: "Choosing the right SEO agency isn't just about rankings — it's building a growth channel that connects search to sales. Our strategies put you at the top of results and bring qualified traffic that turns into lasting revenue.",
      primary: 'Discover services',
      secondary: 'How we work',
      clients: "Clients we've had the honor to help:",
      platforms: [['google', 'Result #1', 'Google SERP'], ['gemini', 'AI Overview', 'Gemini'], ['chatgpt', 'LLMO / GEO', 'ChatGPT'], ['semrush', 'DR 80 +3', 'Authority Score'], ['googlemaps', 'Maps ranking', 'Local SEO'], ['applenews', 'Media coverage', 'Digital PR']],
      platformsTitle: 'An SEO agency that turns traffic into real profit, on every platform'
    },
    services: {
      eyebrow: 'Our services',
      title: 'The SEO services we deliver',
      hl: 'SEO services',
      sub: 'Custom strategies with the guidance and support to help you top search results and grow with confidence.',
      cta: 'Book a free consultation',
      items: [['ShoppingBag', 'Shopify SEO', 'Shopify', 'Pages, products and content structure tuned for search, so your Shopify store is found by more of the right buyers.'], ['Store', 'Salla SEO', 'Salla', 'Pages, categories, products and internal content for Salla stores — more organic visits, more sales.'], ['FileText', 'On-page SEO', 'On-page', 'Titles, content, internal links and page structure, so search engines understand every page.'], ['Link', 'Off-page SEO', 'Off-page', 'High-quality backlinks from trusted, relevant sites that lift your authority and rankings.'], ['ScanSearch', 'SEO audits', 'Audits', 'A full audit of technical, speed, indexing and content issues — with practical fixes, in order.'], ['Lightbulb', 'SEO consulting', 'Consulting', 'A clear view and sharp priorities for your stage — whether you start from zero or scale results.'], ['Code', 'Technical SEO', 'Technical', 'Speed, mobile, security and URL structure, so your site is easy to crawl and index.'], ['Sparkles', 'AI search SEO', 'GEO', 'Clear, trusted, structured content that answer engines and AI search can understand and cite.']]
    },
    proof: {
      pre: 'On average we grew our clients’ organic sales by more than ',
      num: '270%',
      post: ' through targeted traffic from Google and ChatGPT',
      label: 'Average organic sales growth'
    },
    strategy: {
      title: 'Search engine optimization is our last step',
      hl: 'last step',
      sub: 'Our priority is growing your sales, so our work starts with the business and ends with marketing.',
      steps: [['Market, competitor and buying-intent analysis', 'We start by understanding the market, the keywords with real buying intent and the questions buyers ask before they decide.'], ['Sales-page engineering and conversion lift', 'We make landing pages persuasive in copy and design, so more visitors become buyers.'], ['Content that sells the value', 'Content that answers buyers’ questions and handles objections — not traffic that goes nowhere.'], ['Optimization for search and AI', 'Technical structure tuned for SEO standards and modern AI systems, for maximum organic reach.'], ['Measuring profit, not rankings', 'Our reports track what turns into profit, like ROAS — not vanity metrics like rank or raw traffic.']]
    },
    partners: {
      title: 'Success partners',
      stories: 'Store success stories',
      more: 'More success stories'
    },
    process: {
      title: 'How Linkawy gets your site to the first results',
      hl: 'first results',
      sub: 'A deliberate set of steps to lift your rankings and deliver results you can measure.',
      cta: 'Start now',
      steps: [['Step one', 'We analyze your site to find growth', 'A full review of your site to find where traffic and opportunities leak to competitors.'], ['Step two', 'We pick keywords that bring real buyers', 'No chasing empty keywords — we target what your buyers search when they are ready to act.'], ['Step three', 'We build an SEO strategy made for you', 'A clear plan for content, pages and technical structure — no off-the-shelf fixes.'], ['Step four', 'We ship improvements and move results', 'Hands-on execution, step by step, until your site becomes a real acquisition channel.'], ['Step five', 'We monitor and keep improving', 'We measure, review and adjust the strategy continuously for the best possible growth.'], ['Step six', 'We follow through and build lasting growth', 'Clear reports and a long-term plan that keeps you ahead in search.']]
    },
    reasons: {
      title: '9 reasons to choose Linkawy',
      hl: '9 reasons',
      highlight: 7,
      items: [['Cross-continental expertise', '10+ years of SEO in competitive markets like the UAE, Saudi Arabia and the US.'], ['The most profitable keywords', 'We target phrases that bring customers, not just visits — for the highest return.'], ['Documented visibility results', 'Success stories growing organic traffic for major companies and reaching page one.'], ['Complete technical SEO', 'Speed, schema markup and UX, so crawlers index your pages in the best shape.'], ['Regular reports, full transparency', 'Detailed reports and direct contact with the team — no admin layers.'], ['On top of algorithm updates', 'We watch Google’s algorithms closely and stay strictly white-hat.'], ['Strong backlinks and content', 'Links from high-authority sites alongside content that makes you the reference.'], ['Direct consulting with the founder', 'You work with Eng. Ali Atwa directly, on decisions backed by real data.'], ['Training your team', 'We train your team on SEO-ready content so results last for the long term.']]
    },
    benefits: {
      title: 'We lead your project to the top of search in 3 steps',
      hl: 'top of search',
      items: [['Understand the market and audience', 'We find the strongest opportunities and what your buyers search for, so every visit is worth more.', 'growth/seo-product-research.png'], ['An SEO plan with clear goals', 'We don’t inflate numbers. We bring qualified visits with real intent to buy.', 'growth/seo-marketing-plan.webp'], ['Results that grow every day', 'SEO compounds. We deliver steady monthly growth in organic traffic and conversions.', 'growth/sales-growth-dashboard.png']]
    },
    blog: {
      title: 'Latest from the blog',
      sub: 'The latest updates and strategies from the world of search.',
      all: 'Browse all articles',
      author: 'Ali Atwa',
      posts: [['Analytics', 'Google Analytics explained: a complete beginner’s guide', 'Any marketing decision made without reading visitor behavior can lead you to the wrong conclusions.', '17 min read', null], ['SEO', 'Measuring SEO KPIs in the age of AI', 'The SEO KPIs that matter and how to tie them to your goals for tangible results.', '13 min read', 'https://www.linkawy.io/wp-content/uploads/Search-KPIs-400x209.png'], ['On-page SEO', 'Optimizing your URLs for search engines', 'In SEO, small details make a big difference — and URLs are one of them.', '9 min read', 'https://www.linkawy.io/wp-content/uploads/optimize-url-for-seo-400x211.png']]
    },
    founder: {
      eyebrow: 'Hello, founder',
      title: 'SEO consulting with a business lens',
      hl: 'business lens',
      body: 'We know the pressure of watching your budget drain into ads. These consultations get you out of the pay-to-be-seen trap: you work directly with an SEO expert who thinks in business terms, using a method that has taken startups from simply existing to dominating through free traffic.',
      cta: 'Request SEO consulting',
      name: 'Eng. Ali Atwa',
      role: 'Founder, Linkawy · 10+ years in SEO'
    },
    faq: {
      title: 'Frequently asked questions',
      sub: 'Straight answers on timelines, pricing and results.',
      cta: 'Contact us',
      items: [['What SEO services do you offer?', 'On-page and off-page SEO, link building, technical SEO, content optimization, keyword research, store SEO on Shopify, Salla and Zid, and specialist consulting.'], ['How long does it take to improve my rankings?', 'SEO compounds. Tangible results usually show within 3 to 6 months and keep improving, depending on your site, competition and scope.'], ['Do you work with e-commerce stores?', 'Yes — we specialize in Shopify, Salla, Zid and WooCommerce: product pages, categories and technical structure.'], ['How is SEO pricing decided?', 'By site size, competition, technical state, goals and scope. We send a custom quote after analyzing your site.'], ['Can you guarantee the #1 position?', 'No honest SEO agency can. We guarantee best practice and measurable growth in rankings, traffic and sales.'], ['How do you measure SEO success?', 'Organic traffic growth, target-keyword rankings, conversions and sales, and return on investment.']]
    },
    results: {
      eyebrow: 'LIVE RESULTS',
      title: 'SEO results',
      sub: 'Straight from inside client accounts and stores',
      cta: 'Start your success story'
    },
    contact: {
      title: 'Start your climb to the top',
      sub: 'Tell us about your project and we’ll reply within 24 hours with a custom plan.',
      name: 'Name',
      email: 'Email',
      phone: 'Phone',
      company: 'Company',
      site: 'Website',
      budget: 'Monthly budget',
      budgetPh: 'Select a range',
      goals: 'Goals & challenges',
      send: 'Send request',
      budgets: ['Under $750', '$750 – $1,500', '$1,500 – $3,000', '$3,000 – $5,000', '$5,000 – $10,000', 'Over $10,000'],
      ok: 'Your request is in!',
      okSub: 'Thanks for reaching out. We’ll review it and reply within 24 hours with a custom plan.',
      perks: [['Clock', 'Reply within 24 hours'], ['ClipboardCheck', 'Free site analysis'], ['Users', 'Direct line to the founder']]
    },
    footer: {
      ctaTitle: 'Ready to top the search results?',
      ctaText: 'Let’s explore the opportunities together — our experts will analyze your site and send a custom plan.',
      ctaLabel: 'Book a free consultation',
      desc: 'Your strategic partner in digital growth — SEO and store design built to rank.',
      cols: [['Services', ['Digital marketing', 'SEO services', 'GEO / AI SEO', 'Store design', 'Backlinks', 'Content writing']], ['Resources', ['Blog', 'SEO glossary', 'Learn SEO', 'Templates & tools', 'AI prompts']], ['Company', ['About', 'Contact', 'Privacy policy']]],
      contactTitle: 'Contact',
      location: 'Riyadh, Saudi Arabia',
      email: 'info@linkawy.io',
      copyright: '© 2026 Linkawy. All rights reserved.'
    },
    ctaB: {
      title: 'Ready to top the search results?',
      text: 'Our experts will analyze your site and send a custom plan for your goals.',
      label: 'Book a free consultation'
    },
    geo: {
      crumb: 'Services',
      title: 'AI search optimization',
      accent: '(GEO)',
      sub: 'We shape your content to be found and cited by answer engines: ChatGPT, Gemini, Perplexity and Google AI Overviews.',
      primary: 'Book a free consultation',
      secondary: 'See results',
      whatTitle: 'What GEO covers',
      hl: 'GEO',
      what: [['Brain', 'Question intent', 'We map the questions your buyers ask AI tools before they buy.'], ['FileText', 'Citable content', 'Clear, structured, trustworthy answers that models understand and quote.'], ['Code', 'Structured data', 'Schema that ties your brand to entities and products.'], ['Radar', 'Answer tracking', 'We track your brand in ChatGPT and Gemini answers and keep improving.']],
      stats: [['3x', 'More AI Overview visibility'], ['60%', 'Of searches end without a click'], ['24h', 'To your first plan']]
    },
    post: {
      crumb: 'Blog',
      cat: 'SEO',
      title: 'Measuring SEO KPIs in the age of AI',
      meta: 'Ali Atwa · 13 min read · Apr 29, 2026',
      toc: 'In this article',
      sections: [['Why KPIs changed', 'With AI Overviews and answer engines, clicks alone no longer measure SEO success. Visibility inside the answer itself is now a metric of its own.'], ['The metrics that turn into profit', 'Focus on qualified organic traffic, search conversion rate, revenue per visit and ROI. These tell you whether SEO actually sells.'], ['How to measure AI visibility', 'Track brand mentions in ChatGPT and Gemini answers for your core buying questions, and the traffic those platforms send in Google Analytics.']]
    }
  }
};
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/content.js", error: String((e && e.message) || e) }); }

__ds_ns.CTABlock = __ds_scope.CTABlock;

__ds_ns.FooterE = __ds_scope.FooterE;

__ds_ns.Card = __ds_scope.Card;

__ds_ns.CardText = __ds_scope.CardText;

__ds_ns.Glass = __ds_scope.Glass;

__ds_ns.Stat = __ds_scope.Stat;

__ds_ns.FAQ = __ds_scope.FAQ;

__ds_ns.LogoMarquee = __ds_scope.LogoMarquee;

__ds_ns.SectionHeading = __ds_scope.SectionHeading;

__ds_ns.Button = __ds_scope.Button;

__ds_ns.Highlight = __ds_scope.Highlight;

__ds_ns.Accent = __ds_scope.Accent;

__ds_ns.Icon = __ds_scope.Icon;

__ds_ns.ICON_NAMES = __ds_scope.ICON_NAMES;

__ds_ns.NewLabel = __ds_scope.NewLabel;

__ds_ns.NumberBadge = __ds_scope.NumberBadge;

__ds_ns.Tag = __ds_scope.Tag;

__ds_ns.Input = __ds_scope.Input;

__ds_ns.Header = __ds_scope.Header;

__ds_ns.Section = __ds_scope.Section;

__ds_ns.Sunset = __ds_scope.Sunset;

__ds_ns.BRAND_LOGOS = __ds_scope.BRAND_LOGOS;

__ds_ns.BrandTile = __ds_scope.BrandTile;

__ds_ns.IconTile = __ds_scope.IconTile;

})();
