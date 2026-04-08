<?php
/**
 * Template part: Service Hero simplified form (4 fields)
 * Used in service page hero when no featured image is set.
 * Order: رابط الموقع → البريد الإلكتروني → الاسم → رقم الهاتف
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="service-hero-form-card" id="serviceHeroFormCard">
    <form id="serviceHeroForm" class="service-hero-form-fields" action="#" method="POST" novalidate>
        <input type="hidden" name="form_source" value="service_hero">
        <input type="hidden" id="sh_cf_country_code" name="country_code" value="+20">

        <div class="sh-steps">
            <div class="sh-step active"><span class="sh-step-num">1</span><span>رابط موقعك</span></div>
            <div class="sh-step-line"></div>
            <div class="sh-step"><span class="sh-step-num">2</span><span>تحليل فوري</span></div>
            <div class="sh-step-line"></div>
            <div class="sh-step"><span class="sh-step-num">3</span><span>تقرير مفصل</span></div>
        </div>

        <div class="form-field sh-field">
            <label for="sh_cf_website" class="sh-label">رابط الموقع</label>
            <div class="sh-input-wrapper">
                <span class="sh-input-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </span>
                <input type="text" id="sh_cf_website" name="website" placeholder="example.com" class="service-hero-form-input" autocomplete="url">
            </div>
            <span class="sh-field-error" aria-live="polite"></span>
        </div>

        <div class="sh-field-row">
            <div class="form-field sh-field">
                <label for="sh_cf_email" class="sh-label">بريدك الإلكتروني</label>
                <div class="sh-input-wrapper">
                    <span class="sh-input-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </span>
                    <input type="email" id="sh_cf_email" name="email" placeholder="you@company.com" class="service-hero-form-input" required autocomplete="email">
                </div>
                <span class="sh-field-error" aria-live="polite"></span>
            </div>
            <div class="form-field sh-field">
                <label for="sh_cf_name" class="sh-label">اسمك</label>
                <div class="sh-input-wrapper">
                    <span class="sh-input-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <input type="text" id="sh_cf_name" name="full_name" placeholder="اسمك" class="service-hero-form-input" required autocomplete="name">
                </div>
                <span class="sh-field-error" aria-live="polite"></span>
            </div>
        </div>

        <div class="form-field sh-field">
            <label for="sh_cf_phone" class="sh-label">رقم الهاتف</label>
            <div class="phone-field-group sh-phone-wrapper">
                <span class="sh-input-icon sh-phone-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </span>
                <div class="phone-country-select" id="sh_phoneCountrySelect">
                    <button type="button" class="phone-country-btn" id="sh_phoneCountryBtn">
                        <span class="country-flag" id="sh_selectedFlag">🇪🇬</span>
                        <span class="country-code" id="sh_selectedCode">+20</span>
                        <span class="dropdown-arrow">▾</span>
                    </button>
                    <div class="phone-country-dropdown" id="sh_phoneDropdown">
                        <input type="text" class="country-search" id="sh_countrySearch" placeholder="ابحث عن دولة...">
                        <div id="sh_countryList"></div>
                    </div>
                </div>
                <div class="sh-phone-input-wrap">
                    <input type="tel" id="sh_cf_phone" name="phone" placeholder="رقم الهاتف" class="service-hero-form-input" autocomplete="tel">
                </div>
            </div>
            <span class="sh-field-error" aria-live="polite"></span>
        </div>

        <div class="form-field">
            <button type="submit" class="sh-submit-btn" id="serviceHeroSubmitBtn">
                <span class="sh-btn-arrow" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5m7 7l-7-7 7-7"/></svg>
                </span>
                <span class="sh-btn-text">ابدأ تحليل موقعك</span>
            </button>
            <p class="form-global-error" id="serviceHeroFormError">يوجد خطأ في خانة واحدة أو أكثر. يرجى التحقق والمحاولة مرة أخرى.</p>
        </div>
    </form>

    <div class="sh-trust-bar">
        <div class="sh-trust-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            <span>أكثر من 600 موقع تم تحليله</span>
        </div>
        <div class="sh-trust-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            <span>التقارير تصلك خلال أقل من 30 دقيقة</span>
        </div>
    </div>

    <div class="form-success-overlay" id="serviceHeroFormSuccess">
        <div class="form-success-content">
            <div class="form-success-icon">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/rocket.svg' ); ?>" alt="" width="64" height="64" class="form-success-rocket">
            </div>
            <h3 class="form-success-title">تحليل موقعك قيد التنفيذ</h3>
            <p class="form-success-desc">نعمل الآن على تحليل موقعك واكتشاف فرص النمو والتطوير، وسيصلك تقرير شامل خلال الساعات القادمة عبر بريدك الإلكتروني.</p>
        </div>
    </div>
</div>

<script>
(function() {
    var countries = [
        {name:'مصر',code:'+20',flag:'🇪🇬',iso:'EG'},{name:'السعودية',code:'+966',flag:'🇸🇦',iso:'SA'},{name:'الإمارات',code:'+971',flag:'🇦🇪',iso:'AE'},
        {name:'الكويت',code:'+965',flag:'🇰🇼',iso:'KW'},{name:'قطر',code:'+974',flag:'🇶🇦',iso:'QA'},{name:'البحرين',code:'+973',flag:'🇧🇭',iso:'BH'},
        {name:'عُمان',code:'+968',flag:'🇴🇲',iso:'OM'},{name:'الأردن',code:'+962',flag:'🇯🇴',iso:'JO'},{name:'العراق',code:'+964',flag:'🇮🇶',iso:'IQ'},
        {name:'لبنان',code:'+961',flag:'🇱🇧',iso:'LB'},{name:'فلسطين',code:'+970',flag:'🇵🇸',iso:'PS'},{name:'سوريا',code:'+963',flag:'🇸🇾',iso:'SY'},
        {name:'ليبيا',code:'+218',flag:'🇱🇾',iso:'LY'},{name:'تونس',code:'+216',flag:'🇹🇳',iso:'TN'},{name:'الجزائر',code:'+213',flag:'🇩🇿',iso:'DZ'},
        {name:'المغرب',code:'+212',flag:'🇲🇦',iso:'MA'},{name:'السودان',code:'+249',flag:'🇸🇩',iso:'SD'},{name:'اليمن',code:'+967',flag:'🇾🇪',iso:'YE'},
        {name:'تركيا',code:'+90',flag:'🇹🇷',iso:'TR'},{name:'الولايات المتحدة',code:'+1',flag:'🇺🇸',iso:'US'},{name:'المملكة المتحدة',code:'+44',flag:'🇬🇧',iso:'GB'},
        {name:'ألمانيا',code:'+49',flag:'🇩🇪',iso:'DE'},{name:'فرنسا',code:'+33',flag:'🇫🇷',iso:'FR'},{name:'كندا',code:'+1',flag:'🇨🇦',iso:'CA'}
    ];
    var selectedFlag = document.getElementById('sh_selectedFlag');
    var selectedCode = document.getElementById('sh_selectedCode');
    var hiddenCode = document.getElementById('sh_cf_country_code');
    var countryBtn = document.getElementById('sh_phoneCountryBtn');
    var dropdown = document.getElementById('sh_phoneDropdown');
    var countryList = document.getElementById('sh_countryList');
    var countrySearch = document.getElementById('sh_countrySearch');

    function renderList(filter) {
        var html = '', q = (filter || '').toLowerCase();
        countries.forEach(function(c) {
            if (q && c.name.indexOf(q) === -1 && c.code.indexOf(q) === -1 && c.iso.toLowerCase().indexOf(q) === -1) return;
            html += '<div class="country-option" data-code="' + c.code + '" data-flag="' + c.flag + '">' +
                '<span class="country-flag">' + c.flag + '</span><span class="country-name">' + c.name + '</span><span class="country-dial">' + c.code + '</span></div>';
        });
        countryList.innerHTML = html;
        countryList.querySelectorAll('.country-option').forEach(function(opt) {
            opt.addEventListener('click', function() {
                selectedFlag.textContent = this.dataset.flag;
                selectedCode.textContent = this.dataset.code;
                hiddenCode.value = this.dataset.code;
                dropdown.classList.remove('open');
            });
        });
    }
    function closeDropdown() { dropdown.classList.remove('open'); }
    if (countryBtn) {
        countryBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (dropdown.classList.contains('open')) closeDropdown();
            else { renderList(''); dropdown.classList.add('open'); countrySearch.value = ''; countrySearch.focus(); }
        });
    }
    if (countrySearch) countrySearch.addEventListener('input', function() { renderList(this.value); });
    document.addEventListener('click', function(e) {
        var el = document.getElementById('sh_phoneCountrySelect');
        if (el && !el.contains(e.target)) closeDropdown();
    });
    renderList('');
    try {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://ip2c.org/s', true);
        xhr.timeout = 4000;
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText) {
                var parts = xhr.responseText.split(';');
                if (parts[0] === '1' && parts[1]) {
                    var iso = parts[1].toUpperCase();
                    for (var i = 0; i < countries.length; i++) {
                        if (countries[i].iso === iso) {
                            selectedFlag.textContent = countries[i].flag;
                            selectedCode.textContent = countries[i].code;
                            hiddenCode.value = countries[i].code;
                            return;
                        }
                    }
                }
            }
        };
        xhr.send();
    } catch(e) {}

    var form = document.getElementById('serviceHeroForm');
    var errEl = document.getElementById('serviceHeroFormError');
    var successEl = document.getElementById('serviceHeroFormSuccess');
    var card = document.getElementById('serviceHeroFormCard');
    var submitBtn = form ? form.querySelector('button[type="submit"]') : null;
    var defaultBtnHtml = submitBtn ? submitBtn.innerHTML : '';

    function getWrapper(input) {
        if (input.closest('.sh-phone-wrapper')) return input.closest('.sh-phone-wrapper');
        return input.closest('.sh-input-wrapper');
    }
    var websiteRe = /^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+/;
    function showValidationError(inputOrNull, showGlobalMessage) {
        if (showGlobalMessage && errEl) {
            errEl.textContent = 'يوجد خطأ في خانة واحدة أو أكثر. يرجى التحقق والمحاولة مرة أخرى.';
            errEl.classList.add('visible');
        }
        if (inputOrNull) {
            updateFieldState(inputOrNull);
            inputOrNull.focus();
            var firstError = form.querySelector('.sh-field-error');
            if (firstError && firstError.textContent) firstError.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }
    function updateFieldState(input) {
        var wrapper = getWrapper(input);
        var field = input.closest('.sh-field');
        var errorEl = field ? field.querySelector('.sh-field-error') : null;
        if (!wrapper) return;
        wrapper.classList.remove('sh-error', 'sh-valid');
        if (input.hasAttribute('required') && !input.value.trim()) {
            wrapper.classList.add('sh-error');
            if (errorEl) errorEl.textContent = 'هذه الخانة مطلوبة.';
        } else if (input.type === 'email' && input.value.trim()) {
            var emailVal = input.value.trim();
            var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRe.test(emailVal)) {
                wrapper.classList.add('sh-error');
                if (errorEl) errorEl.textContent = 'يرجى إدخال بريد إلكتروني صحيح.';
            } else {
                wrapper.classList.add('sh-valid');
                if (errorEl) errorEl.textContent = '';
            }
        } else if (input.id === 'sh_cf_website' && input.value.trim()) {
            if (!websiteRe.test(input.value.trim())) {
                wrapper.classList.add('sh-error');
                if (errorEl) errorEl.textContent = 'يرجى إدخال رابط صحيح (مثال: example.com).';
            } else {
                wrapper.classList.add('sh-valid');
                if (errorEl) errorEl.textContent = '';
            }
        } else if (input.value.trim()) {
            wrapper.classList.add('sh-valid');
            if (errorEl) errorEl.textContent = '';
        } else if (errorEl) errorEl.textContent = '';
    }

    if (form) {
        form.querySelectorAll('.service-hero-form-input').forEach(function(input) {
            input.addEventListener('focus', function() {
                var w = getWrapper(this);
                if (w) w.classList.add('sh-typing');
            });
            input.addEventListener('blur', function() {
                var w = getWrapper(this);
                if (w) w.classList.remove('sh-typing');
            });
            input.addEventListener('input', function() {
                var w = getWrapper(this);
                var field = this.closest('.sh-field');
                var errorEl = field ? field.querySelector('.sh-field-error') : null;
                if (w) w.classList.remove('sh-error');
                if (errorEl) errorEl.textContent = '';
            });
        });
        form.addEventListener('reset', function() {
            form.querySelectorAll('.sh-input-wrapper, .sh-phone-wrapper').forEach(function(w) {
                w.classList.remove('sh-error', 'sh-valid');
            });
            form.querySelectorAll('.sh-field-error').forEach(function(el) { el.textContent = ''; });
        });
    }

    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var nameEl = document.getElementById('sh_cf_name');
        var emailEl = document.getElementById('sh_cf_email');
        var name = nameEl ? nameEl.value.trim() : '';
        var email = emailEl ? emailEl.value.trim() : '';
        var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (errEl) errEl.classList.remove('visible');
        form.querySelectorAll('.sh-input-wrapper, .sh-phone-wrapper').forEach(function(w) { w.classList.remove('sh-error', 'sh-valid'); });
        form.querySelectorAll('.sh-field-error').forEach(function(el) { el.textContent = ''; });

        if (!name) {
            showValidationError(nameEl, true);
            return;
        }
        if (!email) {
            showValidationError(emailEl, true);
            return;
        }
        if (!emailRe.test(email)) {
            showValidationError(emailEl, true);
            return;
        }
        var websiteEl = document.getElementById('sh_cf_website');
        var websiteVal = websiteEl ? websiteEl.value.trim() : '';
        if (websiteVal && !websiteRe.test(websiteVal)) {
            showValidationError(websiteEl, true);
            return;
        }

        if (errEl) errEl.classList.remove('visible');
        if (card) card.classList.add('sh-loading');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-loading"></span> جاري التحليل...';
        }
        function sendServiceHeroContact(recaptchaToken) {
            var formData = new FormData(form);
            formData.append('action', 'linkawy_submit_contact');
            formData.append('nonce', '<?php echo esc_js(wp_create_nonce("linkawy_contact_form")); ?>');
            formData.append('source_url', window.location.href);
            formData.append('source_title', '<?php echo esc_js(get_the_title()); ?>');
            if (recaptchaToken) {
                formData.append('recaptcha_token', recaptchaToken);
            }
            fetch('<?php echo esc_js(admin_url("admin-ajax.php")); ?>', { method: 'POST', body: formData })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success && successEl) {
                        successEl.classList.add('visible');
                        form.reset();
                    } else {
                        if (errEl) { errEl.textContent = (data.data && data.data.message) ? data.data.message : 'حدث خطأ. يرجى المحاولة مرة أخرى.'; errEl.classList.add('visible'); }
                    }
                })
                .catch(function() {
                    if (errEl) { errEl.textContent = 'حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.'; errEl.classList.add('visible'); }
                })
                .finally(function() {
                    if (card) card.classList.remove('sh-loading');
                    if (submitBtn) { submitBtn.disabled = false; submitBtn.innerHTML = defaultBtnHtml; }
                });
        }
        if (typeof linkawyWithRecaptcha === 'function') {
            linkawyWithRecaptcha(function(token) {
                sendServiceHeroContact(token || '');
            });
        } else {
            sendServiceHeroContact('');
        }
    });
})();
</script>
