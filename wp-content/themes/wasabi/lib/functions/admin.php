<?php
/**
 * 管理画面関連の処理
 */
?>

<?php
/**
 * アドミンバーを非表示
 */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Gutenberg無効化
 */
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * 管理画面アドミンバーメニュー削除
 */
function remove_admin_bar_menus( $wp_admin_bar ) {
    $currentUser = wp_get_current_user();

    if ($currentUser->user_login !== 'point' && $currentUser->user_login !== 'tonton'){
        $wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressロゴ.
        $wp_admin_bar->remove_menu( 'view-site' ); // サイト名 / サイトを表示.
        $wp_admin_bar->remove_menu( 'comments' ); // コメント.
        $wp_admin_bar->remove_menu( 'new-content' ); // 新規投稿
        $wp_admin_bar->remove_menu( 'archive' ); // 投稿一覧
        $wp_admin_bar->remove_menu( 'updates' ); // 更新情報
        $wp_admin_bar->remove_menu( 'wpseo-menu' ); // Yoast SEO
    }

    // global $wp_admin_bar;
    // echo '<pre>';
    // var_dump( $wp_admin_bar );
    // echo '</pre>';
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menus', 999 );
add_filter( 'aioseo_show_in_admin_bar', '__return_false' ); // All in One SEO Pack.

/**
 * 管理画面サイドメニュー削除
 */
function remove_menu() {
    $currentUser = wp_get_current_user();

    if ($currentUser->user_login !== 'point' && $currentUser->user_login !== 'tonton'){
        remove_menu_page('index.php'); // ダッシュボード
        // remove_menu_page('upload.php'); // メディア
        remove_menu_page('edit.php?post_type=page'); // 固定ページ
        remove_menu_page('edit-comments.php'); // コメント
        remove_menu_page('themes.php'); // 外観
        remove_menu_page('plugins.php'); // プラグイン
        remove_menu_page('tools.php'); // ツール
        remove_menu_page('options-general.php'); // 設定
        remove_menu_page('wpseo_dashboard'); // Yoast SEO
        remove_menu_page('edit.php?post_type=acf-field-group'); // SCF
        remove_menu_page('wpcf7'); // Contact From 7
        remove_menu_page('siteguard'); // SiteGuard
    }

    // if ($currentUser->user_login == 'point' ){
    //     global $menu;
    //     echo '<pre>';
    //     var_dump( $menu );
    //     echo '</pre>';
    // }
}
add_action('admin_menu', 'remove_menu');

/**
 * 管理画面にマニュアルへのリンクを記述
 */
add_action( 'admin_menu', 'add_manual_menu' );
function add_manual_menu() {
    add_menu_page( '', 'マニュアル', 'read', 'manual', 'setting_manual_menu', 'dashicons-editor-help', 4);
}
add_action( 'admin_head', 'setting_manual_menu' );
function setting_manual_menu() {
?>
<script>
    window.addEventListener('load', () => {
        const toplevelPageaManualDOM = document.querySelector('a.toplevel_page_manual');
        toplevelPageaManualDOM.setAttribute('href', '<?php echo get_theme_file_uri( 'assets/manual/manual.pdf' ); ?>');
        toplevelPageaManualDOM.setAttribute('target', '_blank');
    });
</script>
<?php
}

/**
 * アイキャッチ画像を有効にする。
 */
add_theme_support('post-thumbnails');

/**
 * アイキャッチ画像の説明文を追加
 */
function my_admin_post_thumbnail_html( $content ) {
    $screen = get_current_screen();
    if ( $screen->post_type == 'product' ) {
      $content .= '<p>画像サイズはW1500px H1500px（72dpi）で作成してください。<br>画像ファイル名は半角英数字でthumbnail_{パーマリンクの値}で設定してください。<br>ページ表示速度に影響するので画像ファイルサイズを300kB以下に圧縮を実施してからアップロードしてください。<br><a href="https://www.iloveimg.com/ja/compress-image" target=_blank>画像圧縮サイト</a></p>';
    }
    if ( $screen->post_type == 'post' ) {
      $content .= '<p>OGP画像に使用されます。<br>※サイトには使用されません。<br>設定されない場合はデフォルト画像が使用されます。</p>';
    }
    return $content;
}
add_filter( 'admin_post_thumbnail_html', 'my_admin_post_thumbnail_html');

/**
 * タイトル下に説明文を追加
 */
add_action('edit_form_after_title', 'precautions');
function precautions($post){
    echo '<p style="color: #999; font-size: 0.9em;">パーマリンクは英数字で設定することをオススメします。</p>';
}

/**
 * 管理画面の投稿の名前を"投稿（NEWS）"に変更
 */
function Change_menulabel() {
    global $menu;
    global $submenu;
    $name = '投稿（NEWS）';
    $menu[5][0] = $name;
    $submenu['edit.php'][5][0] = $name.'一覧';
    $submenu['edit.php'][10][0] = '新しい'.$name;
}
function Change_objectlabel() {
    global $wp_post_types;
    $name = '投稿（NEWS）';
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $name;
    $labels->singular_name = $name;
    $labels->add_new = _x('追加', $name);
    $labels->add_new_item = $name.'の新規追加';
    $labels->edit_item = $name.'の編集';
    $labels->new_item = '新規'.$name;
    $labels->view_item = $name.'を表示';
    $labels->search_items = $name.'を検索';
    $labels->not_found = $name.'が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に'.$name.'は見つかりませんでした';
}
add_action( 'init', 'Change_objectlabel' );
add_action( 'admin_menu', 'Change_menulabel' );


/**
 * カテゴリー1つ制限
 */
function limit_category_to_single_select() {
    echo '<script>
        jQuery(function($) {
            let categoryList = $("#categorychecklist input[type=checkbox]");
            categoryList.each(function() {
                $(this).on("change", function() {
                    let checked = $(this).prop("checked");

                    categoryList.prop("checked", false);

                    if (checked) {
                        $(this).prop("checked", true);
                    }
                });
            });
        });
    </script>';
}
add_action('admin_footer', 'limit_category_to_single_select');