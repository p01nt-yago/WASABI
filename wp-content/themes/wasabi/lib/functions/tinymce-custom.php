<?php
/**
 * TinyMCEのカスタム関連の処理
 */
?>

<?php
/**
 * TinyMCEのツールバーをカスタマイズ
 */
function original_toolbars($toolbars){
	$toolbars['custom_menu'] = array();
	$toolbars['custom_menu'][1] = array('link', 'unlink', 'bold', 'my_headline_button', 'my_body_button', 'my_note_button', 'my_cta_button');
	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'original_toolbars');

/**
 * SCFのWYSIWYGに独自メニュー（見出し / 本文 / 注釈）を追加
 */
function my_scf_add_custom_buttons($buttons) {
    array_push($buttons, 'my_headline_button', 'my_body_button', 'my_note_button', 'my_cta_button');
    return $buttons;
}
add_filter('mce_buttons', 'my_scf_add_custom_buttons');

function my_scf_register_custom_plugin($plugins) {
    $plugins['my_headline_button'] = get_template_directory_uri() . '/lib/js/tinymce-custom-menu.js';
    $plugins['my_body_button'] = get_template_directory_uri() . '/lib/js/tinymce-custom-menu.js';
    $plugins['my_note_button'] = get_template_directory_uri() . '/lib/js/tinymce-custom-menu.js';
    $plugins['my_cta_button'] = get_template_directory_uri() . '/lib/js/tinymce-custom-menu.js';
    return $plugins;
}
add_filter('mce_external_plugins', 'my_scf_register_custom_plugin');

/**
 * エディターにスタイルシートを適用
 */
add_action('admin_init', function() {
    add_editor_style('style.css');
});