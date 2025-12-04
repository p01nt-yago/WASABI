<?php

// 閲覧数をカウント
function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if($count == ''){
        $count = 1;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, $count);
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// シングルページ読み込み時にカウント
function count_post_views() {
    if (is_singular()) {
        global $post;
        set_post_views($post->ID);
    }
}
add_action('wp_head', 'count_post_views');