<?php
/* Template Name: Password Reset Form */

// URLパラメータ取得
$login = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';
$key   = isset($_GET['key'])   ? sanitize_text_field($_GET['key'])   : '';

get_header();
?>

<h2>新しいパスワードを設定</h2>

<form method="post">
    <input type="hidden" name="login" value="<?php echo esc_attr($login); ?>">
    <input type="hidden" name="key" value="<?php echo esc_attr($key); ?>">

    <input type="password" name="new_password" placeholder="新しいパスワード" required>
    <button type="submit" name="reset_password_submit">変更する</button>
</form>

<?php get_footer(); ?>
