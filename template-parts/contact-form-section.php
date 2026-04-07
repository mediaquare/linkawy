<?php
/**
 * Template part: Contact Form Section (full 7-field form)
 * Used on front page, service pages, and via [linkawy_contact_form] shortcode.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

global $linkawy_contact_form_suffix, $linkawy_contact_form_header_title, $linkawy_contact_form_header_desc;

$linkawy_cf_sfx = '';
if (!empty($linkawy_contact_form_suffix) && is_string($linkawy_contact_form_suffix)) {
    $linkawy_cf_sfx = '-' . preg_replace('/[^a-zA-Z0-9_-]/', '', $linkawy_contact_form_suffix);
}

$cf = array(
    'contact'            => 'contact' . $linkawy_cf_sfx,
    'form'               => 'contactRequestForm' . $linkawy_cf_sfx,
    'cf_name'            => 'cf_name' . $linkawy_cf_sfx,
    'cf_email'           => 'cf_email' . $linkawy_cf_sfx,
    'cf_phone'           => 'cf_phone' . $linkawy_cf_sfx,
    'cf_company'         => 'cf_company' . $linkawy_cf_sfx,
    'cf_website'         => 'cf_website' . $linkawy_cf_sfx,
    'cf_budget'          => 'cf_budget' . $linkawy_cf_sfx,
    'cf_goals'           => 'cf_goals' . $linkawy_cf_sfx,
    'phoneCountrySelect' => 'phoneCountrySelect' . $linkawy_cf_sfx,
    'phoneCountryBtn'    => 'phoneCountryBtn' . $linkawy_cf_sfx,
    'selectedFlag'       => 'selectedFlag' . $linkawy_cf_sfx,
    'selectedCode'       => 'selectedCode' . $linkawy_cf_sfx,
    'phoneDropdown'      => 'phoneDropdown' . $linkawy_cf_sfx,
    'countrySearch'      => 'countrySearch' . $linkawy_cf_sfx,
    'countryList'        => 'countryList' . $linkawy_cf_sfx,
    'cf_country_code'    => 'cf_country_code' . $linkawy_cf_sfx,
    'formGlobalError'    => 'formGlobalError' . $linkawy_cf_sfx,
    'formSuccessOverlay' => 'formSuccessOverlay' . $linkawy_cf_sfx,
);

$header_h2 = 'ابدأ رحلة تصدّر نتائج البحث';
$header_p  = 'أخبرنا عن مشروعك وسنتواصل معك خلال 24 ساعة بخطة عمل مخصصة.';
if (!empty($linkawy_contact_form_header_title)) {
    $header_h2 = $linkawy_contact_form_header_title;
}
if (!empty($linkawy_contact_form_header_desc)) {
    $header_p = $linkawy_contact_form_header_desc;
}
$linkawy_contact_form_header_title = null;
$linkawy_contact_form_header_desc  = null;

if (is_front_page()) {
    $linkawy_cf_source_title = 'الرئيسية';
} elseif (is_singular()) {
    $qid = (int) get_queried_object_id();
    $linkawy_cf_source_title = $qid ? get_the_title($qid) : get_bloginfo('name');
} else {
    $linkawy_cf_source_title = get_bloginfo('name');
}

$section_class = 'contact-form-section';
if ($linkawy_cf_sfx !== '') {
    $section_class .= ' contact-form-section--embed';
} else {
    $section_class .= ' fp-scroll-anchor';
}

?>
<section class="<?php echo esc_attr($section_class); ?>" id="<?php echo esc_attr($cf['contact']); ?>">
    <div class="contact-form-outer">
        <div class="contact-form-card">
            <div class="contact-form-header">
                <h2><?php echo esc_html($header_h2); ?></h2>
                <p><?php echo esc_html($header_p); ?></p>
            </div>

            <form id="<?php echo esc_attr($cf['form']); ?>" class="contact-form-grid" action="#" method="POST" novalidate>
                <div class="form-field">
                    <label for="<?php echo esc_attr($cf['cf_name']); ?>">الاسم</label>
                    <input type="text" id="<?php echo esc_attr($cf['cf_name']); ?>" name="full_name" placeholder="اسمك" required>
                </div>

                <div class="form-field">
                    <label for="<?php echo esc_attr($cf['cf_email']); ?>">البريد الإلكتروني</label>
                    <input type="email" id="<?php echo esc_attr($cf['cf_email']); ?>" name="email" placeholder="you@company.com" dir="ltr" class="form-input-ltr" required>
                </div>

                <div class="form-field">
                    <label for="<?php echo esc_attr($cf['cf_phone']); ?>">رقم الهاتف</label>
                    <div class="phone-field-group">
                        <div class="phone-country-select" id="<?php echo esc_attr($cf['phoneCountrySelect']); ?>">
                            <button type="button" class="phone-country-btn" id="<?php echo esc_attr($cf['phoneCountryBtn']); ?>">
                                <span class="country-flag" id="<?php echo esc_attr($cf['selectedFlag']); ?>">🇪🇬</span>
                                <span class="country-code" id="<?php echo esc_attr($cf['selectedCode']); ?>">+20</span>
                                <span class="dropdown-arrow">▾</span>
                            </button>
                            <div class="phone-country-dropdown" id="<?php echo esc_attr($cf['phoneDropdown']); ?>">
                                <input type="text" class="country-search" id="<?php echo esc_attr($cf['countrySearch']); ?>" placeholder="ابحث عن دولة...">
                                <div id="<?php echo esc_attr($cf['countryList']); ?>"></div>
                            </div>
                        </div>
                        <input type="tel" id="<?php echo esc_attr($cf['cf_phone']); ?>" name="phone" placeholder="رقم الهاتف">
                    </div>
                    <input type="hidden" id="<?php echo esc_attr($cf['cf_country_code']); ?>" name="country_code" value="+20">
                </div>

                <div class="form-field">
                    <label for="<?php echo esc_attr($cf['cf_company']); ?>">اسم الشركة</label>
                    <input type="text" id="<?php echo esc_attr($cf['cf_company']); ?>" name="company" placeholder="اسم شركتك / متجرك" required>
                </div>

                <div class="form-field">
                    <label for="<?php echo esc_attr($cf['cf_website']); ?>">رابط الموقع</label>
                    <input type="text" id="<?php echo esc_attr($cf['cf_website']); ?>" name="website" placeholder="example.com" dir="ltr" class="form-input-ltr">
                </div>

                <div class="form-field">
                    <label for="<?php echo esc_attr($cf['cf_budget']); ?>">الميزانية الشهرية</label>
                    <select id="<?php echo esc_attr($cf['cf_budget']); ?>" name="budget" required>
                        <option value="" disabled selected hidden>اختر الميزانية المتوقعة</option>
                        <option value="below-750">أقل من 750$</option>
                        <option value="750-1500">750$ - 1,500$</option>
                        <option value="1500-3000">1,500$ - 3,000$</option>
                        <option value="3000-5000">3,000$ - 5,000$</option>
                        <option value="5000-10000">5,000$ - 10,000$</option>
                        <option value="above-10000">أكثر من 10,000$</option>
                    </select>
                </div>

                <div class="form-field full-width">
                    <label for="<?php echo esc_attr($cf['cf_goals']); ?>">الأهداف والتحديات</label>
                    <textarea id="<?php echo esc_attr($cf['cf_goals']); ?>" name="goals" placeholder="زيادة المبيعات، تحسين الظهور في جوجل، اجابات الذكاء الإصطناعي، أو دخول أسواق جديدة..."></textarea>
                </div>

                <div class="full-width">
                    <button type="submit" class="contact-form-submit">إرسال الطلب</button>
                    <p class="form-global-error" id="<?php echo esc_attr($cf['formGlobalError']); ?>">يوجد خطأ في خانة واحدة أو أكثر. يرجى التحقق والمحاولة مرة أخرى.</p>
                </div>
            </form>

            <div class="form-success-overlay" id="<?php echo esc_attr($cf['formSuccessOverlay']); ?>">
                <div class="form-success-content">
                    <div class="form-success-icon">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <circle cx="32" cy="32" r="30" stroke="#2ecc71" stroke-width="3" fill="rgba(46,204,113,0.08)"/>
                            <path d="M20 33L28 41L44 23" stroke="#2ecc71" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                    </div>
                    <h3 class="form-success-title">تم إرسال طلبك بنجاح!</h3>
                    <p class="form-success-desc">شكراً لتواصلك معنا. سنراجع طلبك ونتواصل معك خلال 24 ساعة بخطة عمل مخصصة.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    var countries = [
        {name:'مصر',code:'+20',flag:'🇪🇬',iso:'EG'},
        {name:'السعودية',code:'+966',flag:'🇸🇦',iso:'SA'},
        {name:'الإمارات',code:'+971',flag:'🇦🇪',iso:'AE'},
        {name:'الكويت',code:'+965',flag:'🇰🇼',iso:'KW'},
        {name:'قطر',code:'+974',flag:'🇶🇦',iso:'QA'},
        {name:'البحرين',code:'+973',flag:'🇧🇭',iso:'BH'},
        {name:'عُمان',code:'+968',flag:'🇴🇲',iso:'OM'},
        {name:'الأردن',code:'+962',flag:'🇯🇴',iso:'JO'},
        {name:'العراق',code:'+964',flag:'🇮🇶',iso:'IQ'},
        {name:'لبنان',code:'+961',flag:'🇱🇧',iso:'LB'},
        {name:'فلسطين',code:'+970',flag:'🇵🇸',iso:'PS'},
        {name:'سوريا',code:'+963',flag:'🇸🇾',iso:'SY'},
        {name:'ليبيا',code:'+218',flag:'🇱🇾',iso:'LY'},
        {name:'تونس',code:'+216',flag:'🇹🇳',iso:'TN'},
        {name:'الجزائر',code:'+213',flag:'🇩🇿',iso:'DZ'},
        {name:'المغرب',code:'+212',flag:'🇲🇦',iso:'MA'},
        {name:'السودان',code:'+249',flag:'🇸🇩',iso:'SD'},
        {name:'اليمن',code:'+967',flag:'🇾🇪',iso:'YE'},
        {name:'تركيا',code:'+90',flag:'🇹🇷',iso:'TR'},
        {name:'الولايات المتحدة',code:'+1',flag:'🇺🇸',iso:'US'},
        {name:'المملكة المتحدة',code:'+44',flag:'🇬🇧',iso:'GB'},
        {name:'ألمانيا',code:'+49',flag:'🇩🇪',iso:'DE'},
        {name:'فرنسا',code:'+33',flag:'🇫🇷',iso:'FR'},
        {name:'كندا',code:'+1',flag:'🇨🇦',iso:'CA'}
    ];

    var selectedFlag = document.getElementById(<?php echo wp_json_encode($cf['selectedFlag']); ?>);
    var selectedCode = document.getElementById(<?php echo wp_json_encode($cf['selectedCode']); ?>);
    var hiddenCode = document.getElementById(<?php echo wp_json_encode($cf['cf_country_code']); ?>);
    var countryBtn = document.getElementById(<?php echo wp_json_encode($cf['phoneCountryBtn']); ?>);
    var dropdown = document.getElementById(<?php echo wp_json_encode($cf['phoneDropdown']); ?>);
    var countryList = document.getElementById(<?php echo wp_json_encode($cf['countryList']); ?>);
    var countrySearch = document.getElementById(<?php echo wp_json_encode($cf['countrySearch']); ?>);

    function renderList(filter) {
        if (!countryList) return;
        var html = '';
        var q = (filter || '').toLowerCase();
        countries.forEach(function(c) {
            if (q && c.name.indexOf(q) === -1 && c.code.indexOf(q) === -1 && c.iso.toLowerCase().indexOf(q) === -1) return;
            html += '<div class="country-option" data-code="' + c.code + '" data-flag="' + c.flag + '" data-iso="' + c.iso + '">' +
                '<span class="country-flag">' + c.flag + '</span>' +
                '<span class="country-name">' + c.name + '</span>' +
                '<span class="country-dial">' + c.code + '</span>' +
                '</div>';
        });
        countryList.innerHTML = html;

        countryList.querySelectorAll('.country-option').forEach(function(opt) {
            opt.addEventListener('click', function() {
                selectCountry(this.dataset.flag, this.dataset.code);
                closeDropdown();
            });
        });
    }

    function selectCountry(flag, code) {
        if (selectedFlag) selectedFlag.textContent = flag;
        if (selectedCode) selectedCode.textContent = code;
        if (hiddenCode) hiddenCode.value = code;
    }

    function closeDropdown() {
        if (dropdown) dropdown.classList.remove('open');
    }

    if (countryBtn) {
        countryBtn.addEventListener('click', function(e) {
            e.preventDefault();
            var isOpen = dropdown && dropdown.classList.contains('open');
            if (isOpen) {
                closeDropdown();
            } else {
                renderList('');
                if (dropdown) dropdown.classList.add('open');
                if (countrySearch) {
                    countrySearch.value = '';
                    countrySearch.focus();
                }
            }
        });
    }

    if (countrySearch) {
        countrySearch.addEventListener('input', function() {
            renderList(this.value);
        });
    }

    document.addEventListener('click', function(e) {
        var el = document.getElementById(<?php echo wp_json_encode($cf['phoneCountrySelect']); ?>);
        if (el && !el.contains(e.target)) {
            closeDropdown();
        }
    });

    function detectCountry() {
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
                                selectCountry(countries[i].flag, countries[i].code);
                                return;
                            }
                        }
                    }
                }
            };
            xhr.onerror = function() {};
            xhr.ontimeout = function() {};
            xhr.send();
        } catch(e) {}
    }

    detectCountry();
    renderList('');

    var budgetSelect = document.getElementById(<?php echo wp_json_encode($cf['cf_budget']); ?>);
    if (budgetSelect) {
        budgetSelect.classList.add('placeholder-active');
        budgetSelect.addEventListener('change', function() {
            budgetSelect.classList.remove('placeholder-active');
        });
    }
})();
</script>

<?php
$recaptcha_site_key = get_theme_mod('linkawy_recaptcha_site_key', '');
if (!empty($recaptcha_site_key)) :
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr($recaptcha_site_key); ?>"></script>
<?php endif; ?>
<script src="https://unpkg.com/just-validate@4.3.0/dist/just-validate.production.min.js"></script>
<script>
(function() {
    var formId = <?php echo wp_json_encode($cf['form']); ?>;
    var formSel = '#' + formId;
    var globalError = document.getElementById(<?php echo wp_json_encode($cf['formGlobalError']); ?>);
    var ajaxUrl = <?php echo wp_json_encode(admin_url('admin-ajax.php')); ?>;
    var emailNonce = <?php echo wp_json_encode(wp_create_nonce('linkawy_email_check')); ?>;
    var recaptchaSiteKey = <?php echo wp_json_encode((string) get_theme_mod('linkawy_recaptcha_site_key', '')); ?>;
    var contactNonce = <?php echo wp_json_encode(wp_create_nonce('linkawy_contact_form')); ?>;
    var submitBtn = document.querySelector(formSel + ' button[type="submit"]');
    var submitBtnText = submitBtn ? submitBtn.innerHTML : '';
    var sourceTitle = <?php echo wp_json_encode($linkawy_cf_source_title); ?>;

    var formEl = document.getElementById(formId);
    if (!formEl) return;

    var validator = new JustValidate(formSel, {
        errorFieldCssClass: ['just-validate-error-field'],
        errorLabelCssClass: ['just-validate-error-label'],
        focusInvalidField: true,
        lockForm: false,
        validateBeforeSubmitting: false
    });

    validator
        .addField(formSel + ' [name="full_name"]', [
            { rule: 'required', errorMessage: 'هذه الخانة مطلوبة.' }
        ])
        .addField(formSel + ' [name="email"]', [
            { rule: 'required', errorMessage: 'هذه الخانة مطلوبة.' },
            { rule: 'email', errorMessage: 'يرجى إدخال بريد إلكتروني صحيح.' },
            {
                validator: function(value) {
                    return new Promise(function(resolve) {
                        var formData = new FormData();
                        formData.append('action', 'linkawy_validate_email');
                        formData.append('nonce', emailNonce);
                        formData.append('email', value);

                        fetch(ajaxUrl, { method: 'POST', body: formData })
                            .then(function(r) { return r.json(); })
                            .then(function(data) {
                                resolve(data.success === true);
                            })
                            .catch(function() {
                                resolve(true);
                            });
                    });
                },
                errorMessage: 'يرجى استخدام بريد إلكتروني حقيقي (لا نقبل البريد المؤقت).'
            }
        ])
        .addField(formSel + ' [name="company"]', [
            { rule: 'required', errorMessage: 'هذه الخانة مطلوبة.' }
        ])
        .addField(formSel + ' [name="website"]', [
            {
                validator: function(value) {
                    if (!value || !value.trim()) return true;
                    return /^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+/.test(value.trim());
                },
                errorMessage: 'يرجى إدخال رابط صحيح (مثال: example.com).'
            }
        ])
        .addField(formSel + ' [name="budget"]', [
            { rule: 'required', errorMessage: 'هذه الخانة مطلوبة.' }
        ])
        .onFail(function() {
            if (globalError) globalError.classList.add('visible');
        })
        .onSuccess(function(e) {
            if (e && typeof e.preventDefault === 'function') e.preventDefault();
            if (globalError) globalError.classList.remove('visible');

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-loading"></span> جاري الإرسال...';
            }

            function submitForm(recaptchaToken) {
                var form = document.getElementById(formId);
                if (!form) return;
                var countryCodeSelect = document.getElementById(<?php echo wp_json_encode($cf['cf_country_code']); ?>);
                var countryCode = countryCodeSelect ? countryCodeSelect.value : '';

                var formData = new FormData();
                formData.append('action', 'linkawy_submit_contact');
                formData.append('nonce', contactNonce);
                formData.append('full_name', form.querySelector('[name="full_name"]').value);
                formData.append('email', form.querySelector('[name="email"]').value);
                formData.append('phone', form.querySelector('[name="phone"]').value);
                formData.append('country_code', countryCode);
                formData.append('company', form.querySelector('[name="company"]').value);
                formData.append('website', form.querySelector('[name="website"]').value);
                formData.append('budget', form.querySelector('[name="budget"]').value);
                formData.append('goals', form.querySelector('[name="goals"]').value);
                formData.append('source_url', window.location.href);
                formData.append('source_title', sourceTitle);

                if (recaptchaToken) {
                    formData.append('recaptcha_token', recaptchaToken);
                }

                fetch(ajaxUrl, { method: 'POST', body: formData })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (data.success) {
                            var overlay = document.getElementById(<?php echo wp_json_encode($cf['formSuccessOverlay']); ?>);
                            if (overlay) overlay.classList.add('visible');
                            form.reset();
                        } else {
                            if (globalError) {
                                globalError.textContent = data.data && data.data.message
                                    ? data.data.message
                                    : 'حدث خطأ أثناء إرسال الطلب. يرجى المحاولة مرة أخرى.';
                                globalError.classList.add('visible');
                            }
                        }
                    })
                    .catch(function() {
                        if (globalError) {
                            globalError.textContent = 'حدث خطأ في الاتصال. يرجى التحقق من اتصالك بالإنترنت والمحاولة مرة أخرى.';
                            globalError.classList.add('visible');
                        }
                    })
                    .finally(function() {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = submitBtnText;
                        }
                    });
            }

            if (recaptchaSiteKey && typeof grecaptcha !== 'undefined') {
                grecaptcha.ready(function() {
                    grecaptcha.execute(recaptchaSiteKey, { action: 'contact_form' })
                        .then(function(token) {
                            submitForm(token);
                        })
                        .catch(function() {
                            submitForm(null);
                        });
                });
            } else {
                submitForm(null);
            }
        });
})();
</script>
