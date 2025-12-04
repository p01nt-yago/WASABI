<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login/'));
    exit;
}

$user = wp_get_current_user();
?>

<?php get_header(); ?>

<section class="section_mypage">
    <div class="mypage_container">
        <h2>My Page</h2>
 
        <p class="mypage_text"><?php echo $user->display_name; ?> さん、こんにちは👋</p>

        <a class="mypage_link" href="<?php echo wp_logout_url(home_url('/login/')); ?>">ログアウト</a>
    </div>
</section>

<?php get_footer(); ?>