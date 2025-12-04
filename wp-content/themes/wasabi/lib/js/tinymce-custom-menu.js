(function() {
    tinymce.PluginManager.add('my_headline_button', function(editor) {
        editor.addButton('my_headline_button', {
            text: '見出し',
            icon: false,
            onclick: function() {
                editor.insertContent('<h2 class="c-heading">' + editor.selection.getContent() + '</h2>');
            }
        });
    });

    tinymce.PluginManager.add('my_body_button', function(editor) {
        editor.addButton('my_body_button', {
            text: '本文',
            icon: false,
            onclick: function() {
                editor.insertContent('<p class="c-body">' + editor.selection.getContent() + '</p>');
            }
        });
    });

    tinymce.PluginManager.add('my_note_button', function(editor) {
        editor.addButton('my_note_button', {
            text: '注釈',
            icon: false,
            onclick: function() {
                editor.insertContent('<p class="c-note">' + editor.selection.getContent() + '</p>');
            }
        });
    });

    // tinymce.PluginManager.add('my_cta_button', function (editor) {
    //     editor.addButton('my_cta_button', {
    //         text: 'ボタンリンク',
    //         icon: false,
    //         onclick: function () {

    //             wpLink.open();

    //             wpLink.textarea = {
    //                 get: function () {
    //                     // 選択中のテキストを取得
    //                     return editor.selection.getContent({ format: 'text' });
    //                 },
    //                 set: function (html) {
    //                     // CTAリンクとして挿入
    //                     editor.execCommand('mceInsertContent', false, html);
    //                 }
    //             };

    //             // リンク適用時
    //             jQuery('#wp-link-submit').off('click').on('click', function (event) {
    //                 event.preventDefault();

    //                 const attrs = wpLink.getAttrs();
    //                 const url = attrs.href || '';
    //                 const target = attrs.target || '_self';
    //                 const text = attrs.text || editor.selection.getContent({ format: 'text' });

    //                 const html = `<a href="${url}" class="c-cta" target="${target}">${text}</a>`;

    //                 wpLink.textarea.set(html);
    //                 wpLink.close();
    //             });

    //             // キャンセル
    //             jQuery('#wp-link-cancel').off('click').on('click', function (e) {
    //                 e.preventDefault();
    //                 wpLink.close();
    //             });

    //         }
    //     });

    // });

tinymce.PluginManager.add('my_cta_button', function (editor) {

    let ctaMode = false; // 今のリンク挿入がCTAボタン由来か判定

    editor.addButton('my_cta_button', {
        text: 'CTAボタン',
        icon: false,
        onclick: function () {

            // CTAボタンからリンク挿入することを記録
            ctaMode = true;

            // WordPress 標準のリンク UI を開く
            wpLink.open();

            // 提出ボタンクリック
            jQuery('#wp-link-submit')
                .off('click.my_cta')
                .on('click.my_cta', function (event) {
                    event.preventDefault();

                    // WordPress標準の挙動でリンクを挿入
                    wpLink.update();
                    wpLink.close();
                });
        }
    });

    // ★ リンクが挿入された後の変化を拾う
    editor.on('NodeChange', function (e) {

        if (!ctaMode) return; // CTA起因のときだけ class を付与

        const node = editor.selection.getNode();

        if (node && node.nodeName === 'A') {
            node.classList.add('c-cta');
            ctaMode = false; // 一度だけ実行する
        }
    });

});





})();
