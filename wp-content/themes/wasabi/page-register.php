<?php

if ( isset($_POST['register']) ) {
    $username = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    $user_id = wp_create_user($username, $password, $username);

    if (!is_wp_error($user_id)) {
        wp_redirect('/login');
        exit;
    } else {
        $error = $user_id->get_error_message();
    }
}
?>

<?php get_header(); ?>

<section class="section_register">
    <div class="register_container">
        <h2>Register</h2>
        <form method="post">
            <input type="email" name="email" placeholder="メールアドレス">
            <input type="password" name="password" placeholder="パスワード">
            <button type="submit" name="register">新規登録</button>
        </form>
        <a class="link" href="<?php echo get_page_link( 42 ); ?>">アカウントをお持ちですか？</a>
    </div>
</section>

<?= isset($error) ? $error : '' ?>

<?php get_footer(); ?>