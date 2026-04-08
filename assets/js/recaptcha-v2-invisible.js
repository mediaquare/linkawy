/**
 * Google reCAPTCHA v2 Invisible — single widget, shared across forms.
 */
(function (w, d) {
    function runWithToken(fn, token) {
        if (typeof fn === 'function') {
            fn(typeof token === 'string' ? token : '');
        }
    }

    function noopExecute(cb) {
        runWithToken(cb, '');
    }

    var cfg = w.linkawyRecaptchaV2Cfg || {};
    var siteKey = typeof cfg.siteKey === 'string' ? cfg.siteKey.trim() : '';

    w.linkawyWithRecaptcha = function (fn) {
        var api = w.linkawyRecaptchaV2;
        if (!api || typeof api.execute !== 'function') {
            runWithToken(fn, '');
            return;
        }
        api.execute(function (token) {
            runWithToken(fn, token);
        });
    };

    if (!siteKey) {
        w.linkawyRecaptchaV2 = { execute: noopExecute };
        return;
    }

    function Manager() {
        this.siteKey = siteKey;
        this.widgetId = null;
        this.ready = false;
        this.pendingCb = null;
        this.execQueue = [];
        this.apiLoading = false;
    }

    Manager.prototype._ensureAnchor = function () {
        var el = d.getElementById('linkawy-recaptcha-v2-anchor');
        if (!el) {
            el = d.createElement('div');
            el.id = 'linkawy-recaptcha-v2-anchor';
            el.className = 'linkawy-recaptcha-v2-anchor';
            el.setAttribute('aria-hidden', 'true');
            d.body.appendChild(el);
        }
        return el;
    };

    Manager.prototype._finishToken = function (token) {
        var cb = this.pendingCb;
        this.pendingCb = null;
        if (cb) {
            runWithToken(cb, token);
        }
        if (this.execQueue.length > 0) {
            var self = this;
            w.setTimeout(function () {
                self._flushQueue();
            }, 20);
        }
    };

    Manager.prototype._onApiLoad = function () {
        var self = this;
        if (self.ready) {
            return;
        }
        self._ensureAnchor();
        try {
            self.widgetId = w.grecaptcha.render('linkawy-recaptcha-v2-anchor', {
                sitekey: self.siteKey,
                size: 'invisible',
                callback: function (token) {
                    self._finishToken(token || '');
                },
                'error-callback': function () {
                    self._finishToken('');
                },
            });
            self.ready = true;
            self._flushQueue();
        } catch (err) {
            self.pendingCb = null;
            self.execQueue = [];
            if (typeof console !== 'undefined' && console.error) {
                console.error('Linkawy reCAPTCHA render error', err);
            }
        }
    };

    Manager.prototype._flushQueue = function () {
        if (!this.ready || this.execQueue.length === 0) {
            return;
        }
        var cb = this.execQueue.shift();
        this._executeNow(cb);
    };

    Manager.prototype._executeNow = function (callback) {
        if (!this.ready || this.widgetId === null) {
            runWithToken(callback, '');
            return;
        }
        this.pendingCb = callback;
        try {
            w.grecaptcha.reset(this.widgetId);
            w.grecaptcha.execute(this.widgetId);
        } catch (e) {
            this.pendingCb = null;
            runWithToken(callback, '');
        }
    };

    Manager.prototype.execute = function (callback) {
        if (!this.siteKey) {
            noopExecute(callback);
            return;
        }
        if (!this.ready) {
            this.execQueue.push(callback);
            this._loadApi();
            return;
        }
        if (this.pendingCb !== null) {
            this.execQueue.push(callback);
            return;
        }
        this._executeNow(callback);
    };

    Manager.prototype._loadApi = function () {
        if (this.apiLoading || this.ready) {
            return;
        }
        if (typeof w.grecaptcha !== 'undefined') {
            this._onApiLoad();
            return;
        }
        this.apiLoading = true;
        w.linkawyRecaptchaV2Onload = (function (self) {
            return function () {
                self._onApiLoad();
            };
        })(this);
        var s = d.createElement('script');
        s.src = 'https://www.google.com/recaptcha/api.js?onload=linkawyRecaptchaV2Onload&render=explicit';
        s.async = true;
        s.defer = true;
        d.body.appendChild(s);
    };

    var mgr = new Manager();
    w.linkawyRecaptchaV2 = mgr;

    function boot() {
        mgr._loadApi();
    }
    if (d.readyState === 'loading') {
        d.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})(window, document);
