(function(wp) {
    const { registerBlockType } = wp.blocks;
    const { RichText, useBlockProps } = wp.blockEditor;
    const { Button, TextControl, Spinner } = wp.components;
    const { createElement: el, useState } = wp.element;
    
    // Get localized data
    const { ajaxUrl, nonce, strings } = window.linkawyReferences || {};

    registerBlockType('linkawy/references', {
        title: 'المراجع - References',
        description: 'قسم المراجع والمصادر في نهاية المقال',
        icon: el('svg', { 
            xmlns: 'http://www.w3.org/2000/svg', 
            viewBox: '0 0 24 24',
            fill: 'none',
            stroke: 'currentColor',
            strokeWidth: '2'
        }, 
            el('path', { d: 'M4 19.5A2.5 2.5 0 0 1 6.5 17H20' }),
            el('path', { d: 'M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z' }),
            el('line', { x1: '8', y1: '7', x2: '16', y2: '7' }),
            el('line', { x1: '8', y1: '11', x2: '16', y2: '11' }),
            el('line', { x1: '8', y1: '15', x2: '12', y2: '15' })
        ),
        category: 'text',
        keywords: ['references', 'مراجع', 'مصادر', 'sources', 'citations'],
        
        attributes: {
            title: {
                type: 'string',
                default: 'المراجع'
            },
            references: {
                type: 'array',
                default: [{ text: '', url: '', fetchedTitle: '', siteName: '', accessedDate: '' }]
            },
            isCollapsed: {
                type: 'boolean',
                default: false
            }
        },

        edit: function(props) {
            const blockProps = useBlockProps({
                className: 'references-block-editor'
            });
            const references = props.attributes.references || [{ text: '', url: '' }];
            const title = props.attributes.title || 'المراجع';
            
            // State for URL fetch
            const [fetchingIndex, setFetchingIndex] = useState(null);
            const [urlInputVisible, setUrlInputVisible] = useState(null);
            const [urlInputValue, setUrlInputValue] = useState('');
            const [fetchError, setFetchError] = useState(null);

            const updateReference = (index, field, value) => {
                const newRefs = [...references];
                newRefs[index] = { ...newRefs[index], [field]: value };
                props.setAttributes({ references: newRefs });
            };

            const addReference = () => {
                const newRefs = [...references, { text: '', url: '', fetchedTitle: '', siteName: '', accessedDate: '' }];
                props.setAttributes({ references: newRefs });
            };

            const removeReference = (index) => {
                if (references.length > 1) {
                    const newRefs = references.filter((_, i) => i !== index);
                    props.setAttributes({ references: newRefs });
                }
            };
            
            // Fetch metadata from URL
            const fetchFromUrl = async (index) => {
                if (!urlInputValue || !urlInputValue.trim()) return;
                
                setFetchingIndex(index);
                setFetchError(null);
                
                try {
                    const formData = new FormData();
                    formData.append('action', 'linkawy_fetch_reference');
                    formData.append('nonce', nonce);
                    formData.append('url', urlInputValue.trim());
                    
                    const response = await fetch(ajaxUrl, {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (data.success && data.data) {
                        const { title: fetchedTitle, site_name, accessed_date, url } = data.data;
                        
                        // Format the display text for editor (English format like Wikipedia)
                        let displayText = '';
                        if (fetchedTitle) {
                            displayText = `"${fetchedTitle}"`;
                        }
                        if (site_name) {
                            displayText += displayText ? `, <em>${site_name}</em>` : `<em>${site_name}</em>`;
                        }
                        if (accessed_date) {
                            displayText += `, Retrieved ${accessed_date}. Edited`;
                        }
                        
                        // Update the reference with structured data
                        const newRefs = [...references];
                        newRefs[index] = { 
                            text: displayText, 
                            url: url,
                            fetchedTitle: fetchedTitle || '',
                            siteName: site_name || '',
                            accessedDate: accessed_date || ''
                        };
                        props.setAttributes({ references: newRefs });
                        
                        // Close URL input
                        setUrlInputVisible(null);
                        setUrlInputValue('');
                    } else {
                        setFetchError(data.data?.message || strings?.fetchError || 'فشل في جلب البيانات');
                    }
                } catch (error) {
                    setFetchError(strings?.fetchError || 'فشل في جلب البيانات');
                }
                
                setFetchingIndex(null);
            };

            // Trash icon SVG
            const trashIcon = el('svg', { 
                xmlns: 'http://www.w3.org/2000/svg', 
                width: '16', 
                height: '16', 
                viewBox: '0 0 24 24', 
                fill: 'none', 
                stroke: 'currentColor', 
                strokeWidth: '2',
                strokeLinecap: 'round',
                strokeLinejoin: 'round'
            },
                el('polyline', { points: '3 6 5 6 21 6' }),
                el('path', { d: 'M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2' })
            );
            
            // Link icon SVG
            const linkIcon = el('svg', { 
                xmlns: 'http://www.w3.org/2000/svg', 
                width: '16', 
                height: '16', 
                viewBox: '0 0 24 24', 
                fill: 'none', 
                stroke: 'currentColor', 
                strokeWidth: '2',
                strokeLinecap: 'round',
                strokeLinejoin: 'round'
            },
                el('path', { d: 'M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71' }),
                el('path', { d: 'M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71' })
            );

            return el('div', blockProps,
                // Header
                el('div', { className: 'references-header-editor' },
                    el(RichText, {
                        tagName: 'span',
                        className: 'references-title-input',
                        placeholder: 'عنوان القسم...',
                        value: title,
                        onChange: (value) => props.setAttributes({ title: value }),
                        allowedFormats: []
                    })
                ),
                // References List
                el('div', { className: 'references-items-editor' },
                    references.map((ref, index) => 
                        el('div', { key: index, className: 'reference-item-editor' },
                            el('span', { className: 'reference-number' }, (index + 1) + '.'),
                            el('div', { className: 'reference-content-wrapper' },
                                el(RichText, {
                                    tagName: 'div',
                                    className: 'reference-text-input',
                                    placeholder: 'اكتب المرجع هنا... أو استخدم زر الرابط لجلبه تلقائياً',
                                    value: ref.text,
                                    onChange: (value) => updateReference(index, 'text', value)
                                }),
                                // Show URL if exists
                                ref.url && el('div', { className: 'reference-url-display' },
                                    el('a', { href: ref.url, target: '_blank', rel: 'noopener' }, ref.url)
                                ),
                                // URL Input (shown when urlInputVisible === index)
                                urlInputVisible === index && el('div', { className: 'reference-url-input-wrapper' },
                                    el('input', {
                                        type: 'url',
                                        className: 'reference-url-input',
                                        placeholder: strings?.enterUrl || 'أدخل رابط المصدر...',
                                        value: urlInputValue,
                                        onChange: (e) => setUrlInputValue(e.target.value),
                                        onKeyPress: (e) => {
                                            if (e.key === 'Enter') {
                                                fetchFromUrl(index);
                                            }
                                        }
                                    }),
                                    el('div', { className: 'reference-url-actions' },
                                        el(Button, {
                                            variant: 'primary',
                                            onClick: () => fetchFromUrl(index),
                                            disabled: fetchingIndex === index,
                                            className: 'reference-fetch-btn'
                                        }, 
                                            fetchingIndex === index 
                                                ? el(Spinner) 
                                                : (strings?.fetch || 'جلب')
                                        ),
                                        el(Button, {
                                            variant: 'secondary',
                                            onClick: () => {
                                                setUrlInputVisible(null);
                                                setUrlInputValue('');
                                                setFetchError(null);
                                            },
                                            className: 'reference-cancel-btn'
                                        }, strings?.cancel || 'إلغاء')
                                    ),
                                    fetchError && el('div', { className: 'reference-fetch-error' }, fetchError)
                                )
                            ),
                            el('div', { className: 'reference-actions' },
                                // Fetch from URL button
                                el('button', {
                                    type: 'button',
                                    onClick: () => {
                                        setUrlInputVisible(urlInputVisible === index ? null : index);
                                        setUrlInputValue('');
                                        setFetchError(null);
                                    },
                                    className: 'reference-link-btn' + (urlInputVisible === index ? ' active' : ''),
                                    title: strings?.fetchFromUrl || 'جلب من رابط'
                                }, linkIcon),
                                // Delete button
                                references.length > 1 && el('button', {
                                    type: 'button',
                                    onClick: () => removeReference(index),
                                    className: 'reference-delete-btn',
                                    title: 'حذف'
                                }, trashIcon)
                            )
                        )
                    )
                ),
                // Footer
                el('div', { className: 'references-footer' },
                    el(Button, {
                        variant: 'primary',
                        onClick: addReference,
                        className: 'reference-add-btn'
                    }, 'إضافة مرجع جديد')
                )
            );
        },

        save: function(props) {
            const blockProps = useBlockProps.save({
                className: 'references-section'
            });
            const references = props.attributes.references || [];
            const title = props.attributes.title || 'المراجع';
            
            // Filter out empty references
            const validRefs = references.filter(ref => ref.text && ref.text.trim());
            
            if (validRefs.length === 0) {
                return null;
            }

            // Helper function to render reference with link
            const renderReference = (ref, index) => {
                // If we have structured data with URL, render with link
                if (ref.url && ref.fetchedTitle) {
                    return el('li', { key: index },
                        el('a', { 
                            href: ref.url, 
                            target: '_blank', 
                            rel: 'noopener noreferrer',
                            className: 'reference-link'
                        }, `"${ref.fetchedTitle}"`),
                        ref.siteName && el('span', null, ', '),
                        ref.siteName && el('em', null, ref.siteName),
                        ref.accessedDate && el('span', null, `, Retrieved ${ref.accessedDate}. Edited`)
                    );
                }
                
                // Fallback: if URL exists but no structured data, wrap all text in link
                if (ref.url && !ref.fetchedTitle) {
                    return el('li', { key: index },
                        el('a', { 
                            href: ref.url, 
                            target: '_blank', 
                            rel: 'noopener noreferrer',
                            className: 'reference-link'
                        },
                            el(RichText.Content, {
                                tagName: 'span',
                                value: ref.text
                            })
                        )
                    );
                }
                
                // No URL: render plain text
                return el('li', { key: index },
                    el(RichText.Content, {
                        tagName: 'span',
                        value: ref.text
                    })
                );
            };

            return el('div', blockProps,
                el('div', { 
                    className: 'references-header',
                    'data-toggle': 'true'
                },
                    el('h2', { className: 'references-title' }, title),
                    el('button', { 
                        type: 'button', 
                        className: 'references-toggle',
                        'aria-label': 'طي/توسيع المراجع'
                    }, '[+]')
                ),
                el('div', { className: 'references-content' },
                    el('ol', { className: 'references-list' },
                        validRefs.map((ref, index) => renderReference(ref, index))
                    )
                )
            );
        }
    });
})(window.wp);
