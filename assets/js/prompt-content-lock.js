/**
 * Content lock on single prompt: newsletter form unlocks the prompt text + copy button.
 */
(function () {
    'use strict';

    var cfg = typeof linkawyPromptContentLock !== 'undefined' ? linkawyPromptContentLock : {};
    var ajaxUrl = cfg.ajaxUrl || '';
    var postId = cfg.postId || 0;

    function escapeHtml(str) {
        if (!str) {
            return '';
        }
        var d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function unlockPromptBox() {
        var box = document.querySelector('.prompt-box--content-locked');
        if (box) {
            box.classList.remove('prompt-box--content-locked');
        }
        var content = document.getElementById('prompt-copy-source');
        if (content) {
            content.classList.remove('prompt-box-content--locked');
        }
        var lock = document.querySelector('.prompt-content-lock');
        if (lock) {
            lock.remove();
        }
        var copyBtn = document.querySelector('.prompt-box .prompt-copy-btn');
        if (copyBtn) {
            copyBtn.disabled = false;
            copyBtn.removeAttribute('aria-disabled');
            copyBtn.removeAttribute('title');
            copyBtn.removeAttribute('aria-label');
            copyBtn.removeAttribute('aria-describedby');
            copyBtn.classList.remove('prompt-copy-btn--locked');
            var icon = copyBtn.querySelector('.prompt-copy-btn-icon');
            if (icon) {
                icon.className = 'far fa-copy prompt-copy-btn-icon';
            }
        }
        var hint = document.getElementById('prompt-copy-locked-hint');
        if (hint) {
            hint.remove();
        }
        if (typeof window.syncPromptPreviewHeight === 'function') {
            window.syncPromptPreviewHeight();
        }
    }

    function renderFeedback(el, heading, subtitle) {
        if (!el) {
            return;
        }
        var html = '<span class="prompt-content-lock-feedback__title">' + escapeHtml(heading) + '</span>';
        if (subtitle) {
            html += '<span class="prompt-content-lock-feedback__sub">' + escapeHtml(subtitle) + '</span>';
        }
        el.innerHTML = html;
        el.classList.remove('prompt-content-lock-feedback--error');
        el.style.display = 'block';
    }

    function renderError(el, msg) {
        if (!el) {
            return;
        }
        el.textContent = msg || '';
        el.classList.add('prompt-content-lock-feedback--error');
        el.style.display = 'block';
    }

    var form = document.querySelector('.js-prompt-content-lock-form');
    if (!form || !ajaxUrl) {
        return;
    }

    var feedback = document.querySelector('.prompt-content-lock-feedback');
    var submitBtn = form.querySelector('button[type="submit"]');
    var defaultBtnHtml = submitBtn ? submitBtn.innerHTML : '';

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var emailInput = form.querySelector('input[name="email"]');
        if (feedback) {
            feedback.innerHTML = '';
            feedback.textContent = '';
            feedback.classList.remove('prompt-content-lock-feedback--error');
            feedback.style.display = 'none';
        }

        var emailVal = emailInput ? emailInput.value.trim() : '';
        if (!emailInput || !emailVal || !emailInput.checkValidity()) {
            renderError(feedback, 'يرجى إدخال بريد إلكتروني صحيح.');
            return;
        }

        var formData = new FormData(form);
        formData.append('action', 'linkawy_submit_newsletter');
        formData.set('source', 'single-prompt');
        formData.set('source_kind', cfg.sourceKind || 'prompt');
        if (postId) {
            formData.set('source_post_id', String(postId));
            formData.set('unlock_prompt_id', String(postId));
        }
        formData.append('source_url', cfg.sourceUrl || window.location.href);
        formData.append('source_title', cfg.sourceTitle || '');

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<span class="prompt-content-lock-submit-loading" aria-live="polite">' +
                '<span class="prompt-content-lock-spinner" aria-hidden="true"></span>' +
                '<span>جاري الإرسال…</span>' +
                '</span>';
        }

        fetch(ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
            .then(function (r) {
                return r.json();
            })
            .then(function (data) {
                if (data && data.success) {
                    var d = data.data || {};
                    renderFeedback(feedback, d.heading || 'تم التأكيد', d.subtitle || '');
                    window.setTimeout(function () {
                        unlockPromptBox();
                        if (emailInput && emailInput.isConnected) {
                            emailInput.value = '';
                        }
                    }, 700);
                } else {
                    var msg =
                        data && data.data && data.data.message
                            ? data.data.message
                            : 'تعذّر إتمام الطلب. حاول مرة أخرى.';
                    renderError(feedback, msg);
                }
            })
            .catch(function () {
                renderError(feedback, 'حدث خطأ في الاتصال. حاول مرة أخرى.');
            })
            .finally(function () {
                if (submitBtn && submitBtn.isConnected) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = defaultBtnHtml;
                }
            });
    });
})();
