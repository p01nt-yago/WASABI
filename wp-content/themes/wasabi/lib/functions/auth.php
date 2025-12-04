<?php
/**
 * 会員関連の処理
 */
?>

<?php
/**
 * ダッシュボードリダイレクト - 管理画面サイドメニュー削除でダッシュボードを非表示にしたため
 */
function login_redirect( $user_login ) {
    $user = get_user_by( 'login', $user_login );

    if ( in_array( 'subscriber', (array) $user->roles, true ) ) {
        // 購読者 → マイページ
        wp_safe_redirect( home_url('/mypage/') );
    } else {
        // それ以外 → 管理画面
        wp_safe_redirect( admin_url() );
    }
    exit();
}
add_action('wp_login', 'login_redirect');

/**
 * 購読者の管理画面アクセスをブロック
 */
function block_admin_for_subscribers() {

    if ( is_admin() ) {

        $user = wp_get_current_user();

        // 購読者のみ制限（Ajax は除外）
        if ( in_array( 'subscriber', (array) $user->roles, true ) && 
             !( defined('DOING_AJAX') && DOING_AJAX ) ) {

            wp_redirect( home_url('/mypage/') );
            exit;
        }
    }

}
add_action( 'admin_init', 'block_admin_for_subscribers' );

/**
 * パスワードリセットメールのURLを書き換え
 */
function custom_reset_url( $message, $key, $user_login, $user ) {

    // 自作リセットページのURL
    $custom_reset_url = home_url( "/password-reset-form/?key={$key}&login=" . rawurlencode( $user_login ) );

    $message  = "パスワードリセットのご案内です。\n\n";
    $message .= "以下のURLを開いてパスワードを再設定してください。\n\n";
    $message .= $custom_reset_url . "\n\n";

    return $message;
}
add_filter( 'retrieve_password_message', 'custom_reset_url', 10, 4 );

/**
 * パスワードリセットの処理
 */
function custom_reset_password_handler() {

    if (!isset($_POST['reset_password_submit'])) return;

    $login = sanitize_text_field($_POST['login']);
    $key   = sanitize_text_field($_POST['key']);
    $pass  = $_POST['new_password'];

    // ユーザー取得
    $user = get_user_by('login', $login);
    if ( ! $user ) {
        return; // エラー処理は必要なら書く
    }

    // キーの検証（WP標準、安全）
    $check = check_password_reset_key($key, $login);

    if ( is_wp_error($check) ) {
        wp_die('このパスワードリセットリンクは無効です。');
    }

    // パスワード更新（WP標準、安全）
    reset_password($user, $pass);

    // 完了ページへ遷移
    wp_redirect( home_url('/password-reset-complete/') );
    exit;
}
add_action('init', 'custom_reset_password_handler');