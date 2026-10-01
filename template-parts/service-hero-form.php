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
            <div class="sh-step active"><span class="sh-step-num">1</span><span><?php esc_html_e('رابط موقعك', 'linkawy'); ?></span></div>
            <div class="sh-step-line"></div>
            <div class="sh-step"><span class="sh-step-num">2</span><span><?php esc_html_e('تحليل فوري', 'linkawy'); ?></span></div>
            <div class="sh-step-line"></div>
            <div class="sh-step"><span class="sh-step-num">3</span><span><?php esc_html_e('تقرير مفصل', 'linkawy'); ?></span></div>
        </div>

        <div class="form-field sh-field">
            <label for="sh_cf_website" class="sh-label"><?php esc_html_e('رابط الموقع', 'linkawy'); ?></label>
            <div class="sh-input-wrapper">
                <span class="sh-input-icon" aria-hidden="true">
                    <?php echo linkawy_icon('Globe', 20); ?>
                </span>
                <input type="text" id="sh_cf_website" name="website" placeholder="example.com" class="service-hero-form-input" autocomplete="url">
            </div>
            <span class="sh-field-error" aria-live="polite"></span>
        </div>

        <div class="sh-field-row">
            <div class="form-field sh-field">
                <label for="sh_cf_email" class="sh-label"><?php esc_html_e('بريدك الإلكتروني', 'linkawy'); ?></label>
                <div class="sh-input-wrapper">
                    <span class="sh-input-icon" aria-hidden="true">
                        <?php echo linkawy_icon('Mail', 20); ?>
                    </span>
                    <input type="email" id="sh_cf_email" name="email" placeholder="you@company.com" class="service-hero-form-input" required autocomplete="email">
                </div>
                <span class="sh-field-error" aria-live="polite"></span>
            </div>
            <div class="form-field sh-field">
                <label for="sh_cf_name" class="sh-label"><?php esc_html_e('اسمك', 'linkawy'); ?></label>
                <div class="sh-input-wrapper">
                    <span class="sh-input-icon" aria-hidden="true">
                        <?php echo linkawy_icon('Users', 20); ?>
                    </span>
                    <input type="text" id="sh_cf_name" name="full_name" placeholder="<?php esc_attr_e('اسمك', 'linkawy'); ?>" class="service-hero-form-input" required autocomplete="name">
                </div>
                <span class="sh-field-error" aria-live="polite"></span>
            </div>
        </div>

        <div class="form-field sh-field">
            <label for="sh_cf_phone" class="sh-label"><?php esc_html_e('رقم الهاتف', 'linkawy'); ?></label>
            <div class="phone-field-group sh-phone-wrapper">
                <span class="sh-input-icon sh-phone-icon" aria-hidden="true">
                    <?php echo linkawy_icon('Phone', 20); ?>
                </span>
                <div class="phone-country-select" id="sh_phoneCountrySelect">
                    <button type="button" class="phone-country-btn" id="sh_phoneCountryBtn">
                        <span class="country-flag" id="sh_selectedFlag">🇪🇬</span>
                        <span class="country-code" id="sh_selectedCode">+20</span>
                        <span class="dropdown-arrow">▾</span>
                    </button>
                    <div class="phone-country-dropdown" id="sh_phoneDropdown">
                        <input type="text" class="country-search" id="sh_countrySearch" placeholder="<?php esc_attr_e('ابحث عن دولة...', 'linkawy'); ?>">
                        <div id="sh_countryList"></div>
                    </div>
                </div>
                <div class="sh-phone-input-wrap">
                    <input type="tel" id="sh_cf_phone" name="phone" placeholder="<?php esc_attr_e('رقم الهاتف', 'linkawy'); ?>" class="service-hero-form-input" autocomplete="tel">
                </div>
            </div>
            <span class="sh-field-error" aria-live="polite"></span>
        </div>

        <div class="form-field">
            <button type="submit" class="sh-submit-btn" id="serviceHeroSubmitBtn">
                <span class="sh-btn-arrow" aria-hidden="true">
                    <?php echo linkawy_icon('ArrowRight', 20); ?>
                </span>
                <span class="sh-btn-text"><?php esc_html_e('ابدأ تحليل موقعك', 'linkawy'); ?></span>
            </button>
            <p class="form-global-error" id="serviceHeroFormError"><?php esc_html_e('يوجد خطأ في خانة واحدة أو أكثر. يرجى التحقق والمحاولة مرة أخرى.', 'linkawy'); ?></p>
        </div>
    </form>

    <div class="sh-trust-bar">
        <div class="sh-trust-item">
            <?php echo linkawy_icon('ChartColumn', 18); ?>
            <span><?php esc_html_e('أكثر من 600 موقع تم تحليله', 'linkawy'); ?></span>
        </div>
        <div class="sh-trust-item">
            <?php echo linkawy_icon('Zap', 18); ?>
            <span><?php esc_html_e('التقارير تصلك خلال أقل من 30 دقيقة', 'linkawy'); ?></span>
        </div>
    </div>

    <div class="form-success-overlay" id="serviceHeroFormSuccess">
        <div class="form-success-content">
            <div class="form-success-icon">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/rocket.svg' ); ?>" alt="" width="64" height="64" class="form-success-rocket">
            </div>
            <div class="form-success-title"><?php esc_html_e('تحليل موقعك قيد التنفيذ', 'linkawy'); ?></div>
            <p class="form-success-desc"><?php esc_html_e('نعمل الآن على تحليل موقعك واكتشاف فرص النمو والتطوير، وسيصلك تقرير شامل خلال الساعات القادمة عبر بريدك الإلكتروني.', 'linkawy'); ?></p>
        </div>
    </div>
</div>

<script>
(function() {
    var countries = [
        {name:<?php echo wp_json_encode(__('مصر', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+20',flag:'🇪🇬',iso:'EG'},{name:<?php echo wp_json_encode(__('السعودية', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+966',flag:'🇸🇦',iso:'SA'},{name:<?php echo wp_json_encode(__('الإمارات', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+971',flag:'🇦🇪',iso:'AE'},
        {name:<?php echo wp_json_encode(__('الكويت', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+965',flag:'🇰🇼',iso:'KW'},{name:<?php echo wp_json_encode(__('قطر', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+974',flag:'🇶🇦',iso:'QA'},{name:<?php echo wp_json_encode(__('البحرين', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+973',flag:'🇧🇭',iso:'BH'},
        {name:<?php echo wp_json_encode(__('عُمان', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+968',flag:'🇴🇲',iso:'OM'},{name:<?php echo wp_json_encode(__('الأردن', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+962',flag:'🇯🇴',iso:'JO'},{name:<?php echo wp_json_encode(__('العراق', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+964',flag:'🇮🇶',iso:'IQ'},
        {name:<?php echo wp_json_encode(__('لبنان', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+961',flag:'🇱🇧',iso:'LB'},{name:<?php echo wp_json_encode(__('فلسطين', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+970',flag:'🇵🇸',iso:'PS'},{name:<?php echo wp_json_encode(__('سوريا', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+963',flag:'🇸🇾',iso:'SY'},
        {name:<?php echo wp_json_encode(__('ليبيا', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+218',flag:'🇱🇾',iso:'LY'},{name:<?php echo wp_json_encode(__('تونس', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+216',flag:'🇹🇳',iso:'TN'},{name:<?php echo wp_json_encode(__('الجزائر', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+213',flag:'🇩🇿',iso:'DZ'},
        {name:<?php echo wp_json_encode(__('المغرب', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+212',flag:'🇲🇦',iso:'MA'},{name:<?php echo wp_json_encode(__('السودان', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+249',flag:'🇸🇩',iso:'SD'},{name:<?php echo wp_json_encode(__('اليمن', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+967',flag:'🇾🇪',iso:'YE'},
        {name:<?php echo wp_json_encode(__('تركيا', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+90',flag:'🇹🇷',iso:'TR'},{name:<?php echo wp_json_encode(__('الولايات المتحدة', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+1',flag:'🇺🇸',iso:'US'},{name:<?php echo wp_json_encode(__('المملكة المتحدة', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+44',flag:'🇬🇧',iso:'GB'},
        {name:<?php echo wp_json_encode(__('ألمانيا', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+49',flag:'🇩🇪',iso:'DE'},{name:<?php echo wp_json_encode(__('فرنسا', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+33',flag:'🇫🇷',iso:'FR'},{name:<?php echo wp_json_encode(__('كندا', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,code:'+1',flag:'🇨🇦',iso:'CA'}
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
            errEl.textContent = <?php echo wp_json_encode(__('يوجد خطأ في خانة واحدة أو أكثر. يرجى التحقق والمحاولة مرة أخرى.', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
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
            if (errorEl) errorEl.textContent = <?php echo wp_json_encode(__('هذه الخانة مطلوبة.', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        } else if (input.type === 'email' && input.value.trim()) {
            var emailVal = input.value.trim();
            var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRe.test(emailVal)) {
                wrapper.classList.add('sh-error');
                if (errorEl) errorEl.textContent = <?php echo wp_json_encode(__('يرجى إدخال بريد إلكتروني صحيح.', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
            } else {
                wrapper.classList.add('sh-valid');
                if (errorEl) errorEl.textContent = '';
            }
        } else if (input.id === 'sh_cf_website' && input.value.trim()) {
            if (!websiteRe.test(input.value.trim())) {
                wrapper.classList.add('sh-error');
                if (errorEl) errorEl.textContent = <?php echo wp_json_encode(__('يرجى إدخال رابط صحيح (مثال: example.com).', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
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
            submitBtn.innerHTML = <?php echo wp_json_encode(__('<span class="spinner-loading"></span> جاري التحليل...', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
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
                        if (errEl) { errEl.textContent = (data.data && data.data.message) ? data.data.message : <?php echo wp_json_encode(__('حدث خطأ. يرجى المحاولة مرة أخرى.', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>; errEl.classList.add('visible'); }
                    }
                })
                .catch(function() {
                    if (errEl) { errEl.textContent = <?php echo wp_json_encode(__('حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.', 'linkawy'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>; errEl.classList.add('visible'); }
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
