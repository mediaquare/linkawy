<?php
/**
 * Template part for newsletter subscription section
 *
 * Optional: set global $linkawy_newsletter_inline_args before including (e.g. single prompts).
 *
 * @package Linkawy
 */

global $linkawy_newsletter_inline_args;

$linkawy_nl = wp_parse_args(
    (isset($linkawy_newsletter_inline_args) && is_array($linkawy_newsletter_inline_args)) ? $linkawy_newsletter_inline_args : array(),
    array(
        'source'                => 'blog-home',
        'source_kind'           => null,
        'source_post_id'        => 0,
        'source_title_for_ajax' => null,
    )
);
$linkawy_newsletter_inline_args = null;

$linkawy_nl['source'] = sanitize_key((string) $linkawy_nl['source']);
if (!in_array($linkawy_nl['source'], array('blog-home', 'single-prompt'), true)) {
    $linkawy_nl['source'] = 'blog-home';
}

if ($linkawy_nl['source_title_for_ajax'] === null || $linkawy_nl['source_title_for_ajax'] === '') {
    $linkawy_nl['source_title_for_ajax'] = linkawy_get_newsletter_page_source_title();
}

$linkawy_nl_source_kind = ($linkawy_nl['source_kind'] !== null && $linkawy_nl['source_kind'] !== '')
    ? (string) $linkawy_nl['source_kind']
    : linkawy_get_newsletter_source_kind();

$linkawy_nl_post_id = absint($linkawy_nl['source_post_id']);
?>

<!-- Subscription Box -->
<section class="container">
    <div class="subscription-box">
        <div class="sub-content">
            <div class="sub-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h3><?php _e('اشترك لتعلم المزيد عن المحتوى والسيو', 'linkawy'); ?></h3>
            <p><?php _e('انضم لأكثر من 5,000 مشترك واستقبل أحدث الاستراتيجيات والنصائح مباشرة في بريدك الإلكتروني.', 'linkawy'); ?></p>
            <div class="sub-stats">
                <i class="fas fa-check-circle"></i>
                <span><?php _e('يمكنك إلغاء الاشتراك في أي وقت', 'linkawy'); ?></span>
            </div>
        </div>
        <div class="subscription-form-wrapper">
            <form class="sub-form js-newsletter-form" action="#" method="post" novalidate>
                <input type="email" name="email" placeholder="<?php esc_attr_e('أدخل بريدك الإلكتروني', 'linkawy'); ?>" required>
                <input type="hidden" name="source" value="<?php echo esc_attr($linkawy_nl['source']); ?>">
                <input type="hidden" name="source_kind" value="<?php echo esc_attr($linkawy_nl_source_kind); ?>">
                <?php if ($linkawy_nl_post_id > 0) : ?>
                    <input type="hidden" name="source_post_id" value="<?php echo esc_attr((string) $linkawy_nl_post_id); ?>">
                <?php endif; ?>
                <input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce('linkawy_newsletter_form')); ?>">
                <input type="text" name="hp_field" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;opacity:0;pointer-events:none;">
                <button type="submit"><i class="fas fa-paper-plane"></i> <?php _e('اشترك الآن', 'linkawy'); ?></button>
            </form>
            <p class="newsletter-feedback" role="status" aria-live="polite"></p>
        </div>
    </div>
</section>
<script>
(function() {
    function linkawyEscapeHtml(str) {
        if (!str) return '';
        var d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function linkawyClearNewsletterInputError(input) {
        if (!input) return;
        input.classList.remove('newsletter-email--error');
        input.removeAttribute('aria-invalid');
    }

    function linkawySetNewsletterInputError(input) {
        if (!input) return;
        input.classList.add('newsletter-email--error');
        input.setAttribute('aria-invalid', 'true');
    }

    function linkawyRenderNewsletterSuccess(feedback, data) {
        feedback.classList.remove('newsletter-feedback--error');
        var heading = (data && data.heading) ? data.heading : '';
        var subtitle = (data && data.subtitle) ? data.subtitle : '';
        if (!subtitle && data && data.message) {
            subtitle = data.message;
        }
        if (!heading && subtitle) {
            heading = subtitle;
            subtitle = '';
        }
        var html = '<span class="newsletter-feedback__title">' + linkawyEscapeHtml(heading) + '</span>';
        if (subtitle) {
            html += '<span class="newsletter-feedback__subtitle">' + linkawyEscapeHtml(subtitle) + '</span>';
        }
        feedback.innerHTML = html;
    }

    var forms = document.querySelectorAll('.js-newsletter-form');
    if (!forms.length) return;

    forms.forEach(function(form) {
        var emailInput = form.querySelector('input[name="email"]');
        var submitBtn = form.querySelector('button[type="submit"]');
        var feedback = form.parentElement ? form.parentElement.querySelector('.newsletter-feedback') : null;
        var box = form.closest('.subscription-box');
        var defaultBtnHtml = submitBtn ? submitBtn.innerHTML : '';

        if (emailInput) {
            emailInput.addEventListener('input', function() {
                linkawyClearNewsletterInputError(emailInput);
                if (feedback) {
                    feedback.style.display = 'none';
                    feedback.innerHTML = '';
                    feedback.classList.remove('newsletter-feedback--error');
                    feedback.style.color = '';
                }
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (box) {
                box.classList.remove('linkawy-newsletter-success');
            }
            if (feedback) {
                feedback.style.display = 'none';
                feedback.innerHTML = '';
                feedback.classList.remove('newsletter-feedback--error');
                feedback.style.color = '';
            }
            linkawyClearNewsletterInputError(emailInput);

            var emailVal = emailInput ? emailInput.value.trim() : '';
            if (!emailInput || !emailVal || !emailInput.checkValidity()) {
                if (feedback) {
                    feedback.innerHTML = '';
                    feedback.textContent = 'يرجى إدخال بريد إلكتروني صحيح.';
                    feedback.classList.add('newsletter-feedback--error');
                    feedback.style.removeProperty('color');
                    feedback.style.display = 'block';
                }
                linkawySetNewsletterInputError(emailInput);
                return;
            }

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-loading"></span> جاري الاشتراك...';
            }

            function sendNewsletter(recaptchaToken) {
                var formData = new FormData(form);
                formData.append('action', 'linkawy_submit_newsletter');
                formData.append('source_url', window.location.href);
                formData.append('source_title', '<?php echo esc_js((string) $linkawy_nl['source_title_for_ajax']); ?>');
                if (recaptchaToken) {
                    formData.append('recaptcha_token', recaptchaToken);
                }

                fetch('<?php echo esc_js(admin_url('admin-ajax.php')); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (!feedback) return;
                    if (data && data.success) {
                        linkawyRenderNewsletterSuccess(feedback, data.data || {});
                        feedback.style.color = '';
                        feedback.style.removeProperty('display');
                        linkawyClearNewsletterInputError(emailInput);
                        if (box) {
                            box.classList.add('linkawy-newsletter-success');
                        }
                        if (emailInput) {
                            emailInput.value = '';
                        }
                    } else {
                        if (box) {
                            box.classList.remove('linkawy-newsletter-success');
                        }
                        feedback.innerHTML = '';
                        feedback.textContent = (data && data.data && data.data.message) ? data.data.message : 'تعذر الاشتراك حاليًا.';
                        feedback.classList.add('newsletter-feedback--error');
                        feedback.style.removeProperty('color');
                        feedback.style.display = 'block';
                        linkawySetNewsletterInputError(emailInput);
                    }
                })
                .catch(function() {
                    if (box) {
                        box.classList.remove('linkawy-newsletter-success');
                    }
                    if (feedback) {
                        feedback.innerHTML = '';
                        feedback.textContent = 'حدث خطأ في الاتصال. حاول مرة أخرى.';
                        feedback.classList.add('newsletter-feedback--error');
                        feedback.style.removeProperty('color');
                        feedback.style.display = 'block';
                        linkawySetNewsletterInputError(emailInput);
                    }
                })
                .finally(function() {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = defaultBtnHtml;
                    }
                });
            }

            if (typeof linkawyWithRecaptcha === 'function') {
                linkawyWithRecaptcha(function(token) {
                    sendNewsletter(token || '');
                });
            } else {
                sendNewsletter('');
            }
        });
    });
})();
</script>
