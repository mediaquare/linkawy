(function(wp) {
    const { registerBlockType } = wp.blocks;
    const { RichText, useBlockProps } = wp.blockEditor;
    const { Button } = wp.components;
    const { createElement: el } = wp.element;
    const { decodeEntities } = wp.htmlEntities;

    registerBlockType('linkawy/faq', {
        title: 'FAQ - الأسئلة الشائعة',
        description: 'مكون للأسئلة الشائعة مع Schema markup للسيو',
        icon: el('svg', { 
            xmlns: 'http://www.w3.org/2000/svg', 
            viewBox: '0 0 24 24',
            fill: 'none',
            stroke: 'currentColor',
            strokeWidth: '2'
        }, 
            el('circle', { cx: '12', cy: '12', r: '10' }),
            el('path', { d: 'M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3' }),
            el('line', { x1: '12', y1: '17', x2: '12.01', y2: '17' })
        ),
        category: 'text',
        keywords: ['faq', 'أسئلة', 'شائعة', 'سؤال', 'جواب'],
        
        attributes: {
            faqs: {
                type: 'array',
                default: [{ question: '', answer: '' }]
            }
        },

        edit: function(props) {
            const blockProps = useBlockProps({
                className: 'faq-block-editor'
            });
            const faqs = props.attributes.faqs || [{ question: '', answer: '' }];

            const updateFaq = (index, field, value) => {
                const newFaqs = [...faqs];
                newFaqs[index] = { ...newFaqs[index], [field]: value };
                props.setAttributes({ faqs: newFaqs });
            };

            const addFaq = () => {
                const newFaqs = [...faqs, { question: '', answer: '' }];
                props.setAttributes({ faqs: newFaqs });
            };

            const removeFaq = (index) => {
                if (faqs.length > 1) {
                    const newFaqs = faqs.filter((_, i) => i !== index);
                    props.setAttributes({ faqs: newFaqs });
                }
            };

            const moveFaq = (fromIndex, toIndex) => {
                if (toIndex < 0 || toIndex >= faqs.length || fromIndex === toIndex) {
                    return;
                }
                const newFaqs = [...faqs];
                const [movedItem] = newFaqs.splice(fromIndex, 1);
                newFaqs.splice(toIndex, 0, movedItem);
                props.setAttributes({ faqs: newFaqs });
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

            return el('div', blockProps,
                el('div', { className: 'faq-items-editor' },
                    faqs.map((faq, index) => 
                        el('div', { key: index, className: 'faq-item-editor' },
                            // Question Row
                            el('div', { className: 'faq-question-row' },
                                faqs.length > 1 && el('button', {
                                    type: 'button',
                                    onClick: () => removeFaq(index),
                                    className: 'faq-action-btn faq-delete-btn',
                                    title: 'حذف'
                                }, trashIcon),
                                el('div', { className: 'faq-move-actions' },
                                    index > 0 && el('button', {
                                        type: 'button',
                                        onClick: () => moveFaq(index, index - 1),
                                        className: 'faq-action-btn faq-move-btn faq-move-up-btn',
                                        title: 'تحريك لأعلى',
                                        'aria-label': 'تحريك السؤال لأعلى'
                                    }, '↑'),
                                    index < faqs.length - 1 && el('button', {
                                        type: 'button',
                                        onClick: () => moveFaq(index, index + 1),
                                        className: 'faq-action-btn faq-move-btn faq-move-down-btn',
                                        title: 'تحريك لأسفل',
                                        'aria-label': 'تحريك السؤال لأسفل'
                                    }, '↓')
                                ),
                                el(RichText, {
                                    tagName: 'div',
                                    className: 'faq-question-input',
                                    placeholder: 'اكتب السؤال هنا...',
                                    value: faq.question,
                                    onChange: (value) => updateFaq(index, 'question', value),
                                    allowedFormats: ['core/bold', 'core/italic']
                                })
                            ),
                            // Answer Row
                            el('div', { className: 'faq-answer-row' },
                                el(RichText, {
                                    tagName: 'div',
                                    className: 'faq-answer-input',
                                    placeholder: 'اكتب الإجابة هنا...',
                                    value: faq.answer,
                                    onChange: (value) => updateFaq(index, 'answer', value)
                                })
                            )
                        )
                    )
                ),
                el('div', { className: 'faq-footer' },
                    el(Button, {
                        variant: 'primary',
                        onClick: addFaq,
                        className: 'faq-add-btn'
                    }, 'إضافة سؤال جديد')
                )
            );
        },

        save: function(props) {
            const blockProps = useBlockProps.save({
                className: 'faq-block'
            });
            const faqs = props.attributes.faqs || [];
            
            // Filter out empty FAQs
            const validFaqs = faqs.filter(faq => faq.question && faq.answer);
            
            if (validFaqs.length === 0) {
                return null;
            }

            // Helper function to clean text for Schema (remove HTML tags + decode entities)
            const cleanTextForSchema = (html) => {
                // Remove HTML tags
                const withoutTags = html.replace(/<[^>]*>/g, '');
                // Decode HTML entities (fixes Arabic text encoding issues)
                return decodeEntities(withoutTags);
            };

            // Create Schema JSON-LD
            const schemaData = {
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "mainEntity": validFaqs.map(faq => ({
                    "@type": "Question",
                    "name": cleanTextForSchema(faq.question),
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": cleanTextForSchema(faq.answer)
                    }
                }))
            };

            return el('div', blockProps,
                // Schema JSON-LD
                el('script', {
                    type: 'application/ld+json',
                    dangerouslySetInnerHTML: { __html: JSON.stringify(schemaData) }
                }),
                // FAQ Title
                el('div', { className: 'faq-title', id: 'faqs' }, 'الأسئلة الشائعة'),
                // FAQ Content
                el('div', { className: 'faq-container' },
                    validFaqs.map((faq, index) => 
                        el('div', { 
                            key: index, 
                            className: 'faq-item',
                            'data-faq-index': index
                        },
                            el(RichText.Content, {
                                tagName: 'h2',
                                className: 'faq-question',
                                value: faq.question
                            }),
                            el('div', { className: 'faq-answer' },
                                el(RichText.Content, {
                                    tagName: 'div',
                                    className: 'faq-answer-content',
                                    value: faq.answer
                                })
                            )
                        )
                    )
                )
            );
        }
    });
})(window.wp);
