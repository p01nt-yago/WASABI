
<?php

if ( isset($_POST['login']) ) {
    $creds = array(
        'user_login'    => $_POST['username'],
        'user_password' => $_POST['password'],
        'remember'      => true
    );
    $user = wp_signon( $creds, false );

    if ( !is_wp_error($user) ) {
        wp_redirect(site_url('/mypage'));
        exit;
    } else {
        $error = $user->get_error_message();
    }
}
?>

<?php get_header(); ?>

<section class="section_login">
    <div class="login_container">
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="メールアドレス">
            <input type="password" name="password" placeholder="パスワード">
            <button type="submit" name="login">ログイン</button>
        </form>

        <a class="link" href="<?php echo get_page_link( 46 ); ?>">パスワードを忘れた方はこちら</a>
        <a class="link" href="<?php echo get_page_link( 44 ); ?>">アカウントをお持ちでないですか？</a>

        <?= isset($error) ? $error : '' ?>
    </div>
</section>

<?php get_footer(); ?>