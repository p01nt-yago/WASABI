<?php
/**
 * もっと見るボタンで記事を非同期読み込みする処理
 */
function load_more_posts() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) + 1 : 1;
    $post_type = explode(',', $_POST['post_type']);

    $args = [
        'post_type' => $post_type,
        'posts_per_page' => 2,
        'paged' => $paged,
    ];

    $query = new WP_Query($args);

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            get_template_part('page-templates/news/item');
        endwhile;
    endif;

    wp_reset_postdata();
    wp_die();
}
// ログインユーザー用
add_action('wp_ajax_load_more_posts', 'load_more_posts');
// 非ログインユーザー用
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');