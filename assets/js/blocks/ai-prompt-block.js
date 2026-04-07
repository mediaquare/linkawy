(function(wp) {
    const { registerBlockType } = wp.blocks;
    const { RichText, useBlockProps, BlockControls } = wp.blockEditor;
    const { createElement: el } = wp.element;
    const { ToolbarGroup, ToolbarButton } = wp.components;

    registerBlockType('linkawy/ai-prompt', {
        title: 'AI Prompt',
        description: 'مكون لعرض نصوص AI Prompts بتنسيق مميز',
        icon: el('svg', { 
            xmlns: 'http://www.w3.org/2000/svg', 
            viewBox: '0 0 24 24',
            fill: 'currentColor'
        }, el('path', { 
            d: 'M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z'
        })),
        category: 'text',
        keywords: ['ai', 'prompt', 'chatgpt', 'gemini', 'بروموبت'],
        
        attributes: {
            content: {
                type: 'string',
                source: 'html',
                selector: '.ai-prompt-content'
            },
            textDirection: {
                type: 'string',
                default: 'rtl'
            }
        },

        edit: function(props) {
            const blockProps = useBlockProps({
                className: 'ai-prompt-box-editor'
            });
            const textDirection = props.attributes.textDirection || 'rtl';
            const isRTL = textDirection === 'rtl';

            return el(wp.element.Fragment, {},
                el(BlockControls, {},
                    el(ToolbarGroup, {},
                        el(ToolbarButton, {
                            icon: 'editor-ltr',
                            title: 'من اليسار لليمين (LTR)',
                            isPressed: !isRTL,
                            onClick: function() {
                                props.setAttributes({ textDirection: 'ltr' });
                            }
                        }),
                        el(ToolbarButton, {
                            icon: 'editor-rtl',
                            title: 'من اليمين لليسار (RTL)',
                            isPressed: isRTL,
                            onClick: function() {
                                props.setAttributes({ textDirection: 'rtl' });
                            }
                        })
                    )
                ),
                el('div', blockProps,
                    el('div', { className: 'ai-prompt-header-editor' },
                        el('span', { className: 'ai-prompt-label-editor' },
                            el('img', { 
                                className: 'ai-prompt-icon',
                                src: (typeof linkawyBlockData !== 'undefined') ? linkawyBlockData.aiSparkIcon : '',
                                alt: 'AI',
                                width: '18',
                                height: '18',
                                style: { marginLeft: '8px' }
                            }),
                            'ai prompt'
                        )
                    ),
                    el(RichText, {
                        tagName: 'div',
                        className: 'ai-prompt-content-editor dir-' + textDirection,
                        placeholder: 'اكتب الـ Prompt هنا...',
                        value: props.attributes.content,
                        onChange: function(content) {
                            props.setAttributes({ content: content });
                        }
                    })
                )
            );
        },

        save: function(props) {
            const blockProps = useBlockProps.save({
                className: 'ai-prompt-box'
            });
            const textDirection = props.attributes.textDirection || 'rtl';

            return el('div', blockProps,
                el('div', { className: 'ai-prompt-header' },
                    el('span', { className: 'ai-prompt-label' },
                        el('img', { 
                            className: 'ai-prompt-icon',
                            src: '{{AI_SPARK_ICON}}',
                            alt: 'AI',
                            width: '18',
                            height: '18'
                        }),
                        ' ai prompt'
                    ),
                    el('button', { 
                        type: 'button', 
                        className: 'ai-prompt-copy',
                        title: 'نسخ'
                    }, el('i', { className: 'far fa-copy' }))
                ),
                el(RichText.Content, {
                    tagName: 'div',
                    className: 'ai-prompt-content dir-' + textDirection,
                    value: props.attributes.content
                })
            );
        }
    });
})(window.wp);
