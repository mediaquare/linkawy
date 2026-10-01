/**
 * linkawy/icon — a Lucide icon in the design-system icon tile (rendered by PHP: linkawy_render_icon_block).
 */
(function (blocks, element, blockEditor, components, serverSideRender) {
    var el = element.createElement;
    blocks.registerBlockType('linkawy/icon', {
        apiVersion: 3,
        title: 'أيقونة (Lucide)',
        icon: 'star-filled',
        category: 'design',
        attributes: { name: { type: 'string', default: 'Sparkles' } },
        edit: function (props) {
            var blockProps = blockEditor.useBlockProps();
            return el('div', blockProps,
                el(blockEditor.InspectorControls, null,
                    el(components.PanelBody, { title: 'الأيقونة' },
                        el(components.TextControl, {
                            label: 'اسم أيقونة Lucide (مثال: Search)',
                            value: props.attributes.name,
                            onChange: function (v) { props.setAttributes({ name: v }); }
                        })
                    )
                ),
                el(serverSideRender, { block: 'linkawy/icon', attributes: props.attributes })
            );
        },
        save: function () { return null; }
    });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.serverSideRender);
