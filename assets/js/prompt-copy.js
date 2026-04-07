/**
 * Single Prompt: Copy button + AJAX copy count tracking.
 * On success the button becomes disabled and shows "تم النسخ".
 */
(function () {
    'use strict';

    var config = typeof linkawyPromptCopy !== 'undefined' ? linkawyPromptCopy : {};
    var ajaxUrl = config.ajaxUrl || '';
    var nonce = config.nonce || '';
    var postId = config.postId || 0;
    var copiedLabel = config.copiedLabel || 'تم النسخ';

    var sourceEl = document.getElementById('prompt-copy-source');
    var copyBtn = document.querySelector('.prompt-box .prompt-copy-btn');
    var statEl = document.querySelector('.prompt-stat strong');

    function getTextToCopy() {
        if (!sourceEl) {
            return '';
        }
        return sourceEl.textContent.replace(/\s+/g, ' ').trim();
    }

    function setButtonCopied() {
        if (!copyBtn) {
            return;
        }
        copyBtn.disabled = true;
        copyBtn.classList.add('is-copied');
        copyBtn.setAttribute('aria-label', copiedLabel);
        var icon = copyBtn.querySelector('.prompt-copy-btn-icon') || copyBtn.querySelector('i');
        if (icon) {
            icon.className = 'fas fa-check-circle prompt-copy-btn-icon';
        }
        var textSpan = copyBtn.querySelector('.prompt-copy-btn-text');
        if (textSpan) {
            textSpan.textContent = copiedLabel;
        } else {
            copyBtn.appendChild(document.createTextNode(' ' + copiedLabel));
        }
    }

    function updateCount(count) {
        if (statEl) {
            statEl.textContent = typeof count === 'number' ? String(count) : count;
        }
    }

    function trackCopy() {
        if (!ajaxUrl || !nonce || !postId) {
            return;
        }
        var formData = new FormData();
        formData.append('action', 'linkawy_track_prompt_copy');
        formData.append('nonce', nonce);
        formData.append('post_id', postId);

        fetch(ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.success && data.data && typeof data.data.copies_count === 'number') {
                    updateCount(data.data.copies_count);
                }
            })
            .catch(function () {});
    }

    function copyText(text, onSuccess, onFail) {
        if (!text) {
            return;
        }
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(onSuccess).catch(onFail);
            return;
        }
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.position = 'absolute';
        ta.style.left = '-9999px';
        document.body.appendChild(ta);
        ta.select();
        try {
            document.execCommand('copy');
            onSuccess();
        } catch (e) {
            onFail();
        }
        document.body.removeChild(ta);
    }

    function markCardButtonCopied(btn) {
        var cardCopiedLabel = btn.getAttribute('data-copied-label') || copiedLabel;
        var defaultLabel = btn.getAttribute('data-copy-label') || 'نسخ';
        btn.classList.add('is-copied');
        btn.setAttribute('aria-label', cardCopiedLabel);
        var icon = btn.querySelector('i');
        if (icon) {
            icon.className = 'fas fa-check-circle';
        }
        var textSpan = btn.querySelector('.prompt-copy-btn-text');
        if (textSpan) {
            textSpan.textContent = cardCopiedLabel;
        }
        window.setTimeout(function () {
            btn.classList.remove('is-copied');
            btn.setAttribute('aria-label', defaultLabel);
            if (icon) {
                icon.className = 'far fa-copy';
            }
            if (textSpan) {
                textSpan.textContent = defaultLabel;
            }
        }, 1300);
    }

    if (copyBtn) {
        copyBtn.addEventListener('click', function () {
            if (copyBtn.disabled) {
                return;
            }
            var text = getTextToCopy();
            if (!text) {
                return;
            }

            function onCopySuccess() {
                setButtonCopied();
                trackCopy();
            }

            copyText(text, onCopySuccess, function () {
                trackCopy();
            });
        });
    }

    document.addEventListener('click', function (e) {
        var cardBtn = e.target.closest('.prompt-card-copy-btn');
        if (!cardBtn) {
            return;
        }
        e.preventDefault();
        e.stopPropagation();
        var text = (cardBtn.getAttribute('data-prompt-text') || '').trim();
        if (!text) {
            return;
        }
        copyText(text, function () {
            markCardButtonCopied(cardBtn);
        }, function () {});
    });

    /* كروت «أوامر مشابهه قد تهمك»: الأرشيف يستخدم prompt-archive على #prompts-grid-wrap؛ الصفحة الفردية لا تحتويه */
    function relatedPromptsInteractiveTarget(el) {
        return !!(el && el.closest('button, a, input, textarea, select, label'));
    }

    document.addEventListener('click', function (e) {
        var section = e.target.closest('.related-prompts-section');
        if (!section) {
            return;
        }
        if (e.target.closest('.prompt-card-copy-btn')) {
            return;
        }
        var card = e.target.closest('.prompt-card-clickable');
        if (!card || !section.contains(card)) {
            return;
        }
        if (relatedPromptsInteractiveTarget(e.target)) {
            return;
        }
        var permalink = card.getAttribute('data-permalink') || '';
        if (permalink) {
            window.location.href = permalink;
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter' && e.key !== ' ') {
            return;
        }
        var card = e.target.closest('.prompt-card-clickable');
        if (!card || !card.closest('.related-prompts-section')) {
            return;
        }
        if (relatedPromptsInteractiveTarget(e.target)) {
            return;
        }
        e.preventDefault();
        var permalink = card.getAttribute('data-permalink') || '';
        if (permalink) {
            window.location.href = permalink;
        }
    });
})();
