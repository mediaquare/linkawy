<?php
/**
 * Template part for article newsletter subscription section (clean-site design)
 *
 * @package Linkawy
 */

$linkawy_nl_article_id = is_singular('post') ? (int) get_queried_object_id() : 0;
$linkawy_nl_article_title = $linkawy_nl_article_id ? get_the_title($linkawy_nl_article_id) : '';
?>

<!-- Newsletter Subscription -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-layout">
            <div class="newsletter-box">
                <div class="newsletter-content">
                    <div class="newsletter-text">
                        <span class="newsletter-title"><?php _e('اشترك لتتعلم المزيد', 'linkawy'); ?><br><?php _e('عن المحتوى والسيو', 'linkawy'); ?></span>
                    </div>
                    <div class="newsletter-form-wrapper">
                        <form class="newsletter-form js-newsletter-form-article" action="#" method="post" novalidate>
                            <input type="email" name="email" class="newsletter-input" placeholder="<?php esc_attr_e('بريدك الإلكتروني', 'linkawy'); ?>" required>
                            <input type="hidden" name="source" value="single-article">
                            <input type="hidden" name="source_post_id" value="<?php echo esc_attr((string) $linkawy_nl_article_id); ?>">
                            <input type="hidden" name="source_kind" value="post">
                            <input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce('linkawy_newsletter_form')); ?>">
                            <input type="text" name="hp_field" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;opacity:0;pointer-events:none;">
                            <button type="submit" class="newsletter-btn"><i class="fas fa-paper-plane"></i> <?php _e('اشترك', 'linkawy'); ?></button>
                        </form>
                        <p class="newsletter-feedback" role="status" aria-live="polite"></p>
                        <p class="newsletter-disclaimer"><?php printf(
                            __('بالنقر على "اشترك" فإنك توافق على %s الخاصة بـ Linkawy واستخدام بياناتك لأغراض النشرة البريدية', 'linkawy'),
                            '<a href="' . esc_url(get_privacy_policy_url()) . '">' . __('سياسة الخصوصية', 'linkawy') . '</a>'
                        ); ?></p>
                    </div>
                </div>
            </div>
            <div class="newsletter-spacer"></div>
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

    var forms = document.querySelectorAll('.js-newsletter-form-article');
    if (!forms.length) return;

    forms.forEach(function(form) {
        var emailInput = form.querySelector('input[name="email"]');
        var submitBtn = form.querySelector('button[type="submit"]');
        var feedback = form.parentElement ? form.parentElement.querySelector('.newsletter-feedback') : null;
        var box = form.closest('.newsletter-box');
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

            function sendNewsletterArticle(recaptchaToken) {
                var formData = new FormData(form);
                formData.append('action', 'linkawy_submit_newsletter');
                formData.append('source_url', window.location.href);
                formData.append('source_title', '<?php echo esc_js($linkawy_nl_article_title); ?>');
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
                    sendNewsletterArticle(token || '');
                });
            } else {
                sendNewsletterArticle('');
            }
        });
    });
})();
</script>
