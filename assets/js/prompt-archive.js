/**
 * Prompts Archive: AJAX filter, search, tags, pagination
 * Uses linkawyPromptArchive (localized).
 */
(function () {
    'use strict';

    var config = typeof linkawyPromptArchive !== 'undefined' ? linkawyPromptArchive : {};
    var ajaxUrl = config.ajaxUrl || '';
    var nonce = config.nonce || '';

    var gridWrap = document.getElementById('prompts-grid-wrap');
    var grid = document.getElementById('prompts-grid');
    var paginationWrap = document.getElementById('prompts-pagination');
    var loadingEl = document.getElementById('prompts-loading');
    var searchForm = document.getElementById('prompts-search-form');
    var searchInput = document.getElementById('prompts-search-input');
    var tagFiltersWrap = document.getElementById('prompts-tag-filters');

    if (!gridWrap || !grid || !paginationWrap || !ajaxUrl || !nonce) {
        return;
    }

    var state = {
        promptType: '',
        promptTag: '',
        promptTagId: 0,
        search: '',
        page: 1
    };

    var activeFilterBtn = document.querySelector('.prompt-filter.active');
    if (activeFilterBtn) {
        state.promptType = activeFilterBtn.getAttribute('data-prompt-type') || '';
    }
    if (config.initialPromptTag) {
        state.promptTag = config.initialPromptTag;
    }
    if (config.initialPromptTagId) {
        state.promptTagId = parseInt(config.initialPromptTagId, 10) || 0;
    }

    function setLoading(visible) {
        if (loadingEl) {
            loadingEl.classList.toggle('is-visible', !!visible);
            loadingEl.setAttribute('aria-hidden', !visible);
        }
    }

    function setFilterActive(slug) {
        var buttons = gridWrap.querySelectorAll('.prompt-filter');
        buttons.forEach(function (btn) {
            var s = btn.getAttribute('data-prompt-type') || '';
            btn.classList.toggle('active', s === slug);
        });
    }

    function setTagActive(slug) {
        if (!tagFiltersWrap) {
            return;
        }
        tagFiltersWrap.querySelectorAll('.prompt-tag-capsule').forEach(function (btn) {
            var s = btn.getAttribute('data-prompt-tag') || '';
            btn.classList.toggle('active', s === slug);
        });
    }

    function refreshPreviewFade() {
        grid.querySelectorAll('.prompt-card-preview').forEach(function (previewEl) {
            previewEl.classList.remove('is-truncated');
            if (previewEl.scrollHeight > previewEl.clientHeight + 2) {
                previewEl.classList.add('is-truncated');
            }
        });
    }

    function fetchPrompts(skipScroll) {
        if (searchInput) {
            state.search = (searchInput.value || '').trim();
        }
        setLoading(true);

        var formData = new FormData();
        formData.append('action', 'linkawy_filter_prompts');
        formData.append('nonce', nonce);
        formData.append('prompt_type', state.promptType);
        formData.append('prompt_tag', state.promptTag);
        formData.append('prompt_tag_id', state.promptTagId ? String(state.promptTagId) : '');
        formData.append('search', state.search);
        formData.append('paged', state.page);

        fetch(ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                setLoading(false);
                if (data.success && data.data) {
                    grid.innerHTML = data.data.html || '<p class="no-posts">لا توجد برومبتات تطابق البحث.</p>';
                    paginationWrap.innerHTML = data.data.pagination_html || '';
                    refreshPreviewFade();
                    setFilterActive(state.promptType);
                    setTagActive(state.promptTag);
                    if (!skipScroll) {
                        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            })
            .catch(function () {
                setLoading(false);
            });
    }

    function applyFilter(slug) {
        state.promptType = slug || '';
        state.page = 1;
        fetchPrompts();
    }

    function applySearch(term, skipScroll) {
        state.search = term || '';
        state.page = 1;
        fetchPrompts(!!skipScroll);
    }

    function goToPage(page) {
        state.page = page;
        fetchPrompts();
    }

    function copyText(text) {
        if (!text) {
            return Promise.reject(new Error('empty_text'));
        }
        if (navigator.clipboard && navigator.clipboard.writeText) {
            return navigator.clipboard.writeText(text);
        }
        return new Promise(function (resolve, reject) {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.setAttribute('readonly', '');
            ta.style.position = 'absolute';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            try {
                document.execCommand('copy');
                resolve();
            } catch (err) {
                reject(err);
            }
            document.body.removeChild(ta);
        });
    }

    function setCardCopyBtnCopied(btn) {
        var copiedLabel = btn.getAttribute('data-copied-label') || 'تم النسخ';
        btn.classList.add('is-copied');
        btn.setAttribute('aria-label', copiedLabel);
        var icon = btn.querySelector('i');
        if (icon) {
            icon.className = 'fas fa-check-circle';
        }
        var textSpan = btn.querySelector('.prompt-copy-btn-text');
        if (textSpan) {
            textSpan.textContent = copiedLabel;
        }
        window.setTimeout(function () {
            var defaultLabel = btn.getAttribute('data-copy-label') || 'نسخ البرومبت';
            btn.classList.remove('is-copied');
            btn.setAttribute('aria-label', defaultLabel);
            if (icon) {
                icon.className = 'far fa-copy';
            }
            if (textSpan) {
                textSpan.textContent = defaultLabel;
            }
        }, 1400);
    }

    function isInteractiveTarget(el) {
        return !!(el && el.closest('button, a, input, textarea, select, label'));
    }

    var searchDebounceTimer = null;
    var searchDebounceMs = 350;

    if (searchForm && searchInput) {
        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
        });

        searchInput.addEventListener('input', function () {
            var val = searchInput.value.trim();
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(function () {
                applySearch(val, true);
            }, searchDebounceMs);
        });
    }

    if (tagFiltersWrap) {
        tagFiltersWrap.addEventListener('click', function (e) {
            var cap = e.target.closest('.prompt-tag-capsule');
            if (!cap) {
                return;
            }
            e.preventDefault();
            var slug = cap.getAttribute('data-prompt-tag') || '';
            var tid = parseInt(cap.getAttribute('data-prompt-tag-id') || '0', 10) || 0;
            state.promptTag = slug;
            state.promptTagId = tid;
            state.page = 1;
            fetchPrompts(true);
        });
    }

    gridWrap.addEventListener('click', function (e) {
        var filterBtn = e.target.closest('.prompt-filter');
        if (filterBtn) {
            e.preventDefault();
            state.promptType = filterBtn.getAttribute('data-prompt-type') || '';
            state.page = 1;
            fetchPrompts();
            return;
        }

        var quickTag = e.target.closest('.prompt-quick-tag');
        if (quickTag) {
            e.preventDefault();
            applyFilter(quickTag.getAttribute('data-prompt-type') || '');
            return;
        }

        var pageLink = e.target.closest('.page-link');
        if (pageLink && !pageLink.classList.contains('active')) {
            e.preventDefault();
            var page = pageLink.getAttribute('data-page');
            if (page) {
                goToPage(parseInt(page, 10));
            }
            return;
        }

        var copyBtn = e.target.closest('.prompt-card-copy-btn');
        if (copyBtn) {
            e.preventDefault();
            e.stopPropagation();
            var text = (copyBtn.getAttribute('data-prompt-text') || '').trim();
            copyText(text).then(function () {
                setCardCopyBtnCopied(copyBtn);
            }).catch(function () {});
            return;
        }

        var card = e.target.closest('.prompt-card-clickable');
        if (card && !isInteractiveTarget(e.target)) {
            var permalink = card.getAttribute('data-permalink') || '';
            if (permalink) {
                window.location.href = permalink;
            }
        }
    });

    gridWrap.addEventListener('keydown', function (e) {
        var card = e.target.closest('.prompt-card-clickable');
        if (!card) {
            return;
        }
        if (e.key !== 'Enter' && e.key !== ' ') {
            return;
        }
        if (isInteractiveTarget(e.target)) {
            return;
        }
        e.preventDefault();
        var permalink = card.getAttribute('data-permalink') || '';
        if (permalink) {
            window.location.href = permalink;
        }
    });

    refreshPreviewFade();
    window.addEventListener('resize', refreshPreviewFade);
})();
