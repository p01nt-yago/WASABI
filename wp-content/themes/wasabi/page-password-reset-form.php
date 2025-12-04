<?php
/* Template Name: Password Reset Form */

// URLパラメータ取得
$login = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';
$key   = isset($_GET['key'])   ? sanitize_text_field($_GET['key'])   : '';

get_header();
?>

<h2>新しいパスワードを設定完了</h2>

<p>パスワードの再設定が完了しました。</p>
<a href="<?php echo get_page_link( 42 ); ?>">ログインページへ戻る</a>


<?php get_footer(); ?>
