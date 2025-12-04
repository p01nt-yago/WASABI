<?php get_header(); ?>

<h2>パスワードリセット</h2>

<form method="post" action="<?php echo esc_url( wp_lostpassword_url() ); ?>">
    <input type="email" name="user_login" placeholder="メールアドレス" required>
    <button type="submit">パスワードリセットメール送信</button>
</form>

<a class="link" href="<?php echo get_page_link( 42 ); ?>">ログインページへ戻る</a>

<?php get_footer(); ?>