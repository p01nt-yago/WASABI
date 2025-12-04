<?php
/**
 * CSS,JavaScriptの読み込み関連の処理
 */
?>

<?php
/**
 * CSS,JavaScriptの読み込み
 */
function add_link_files() {
    // CSSの読み込み
    wp_enqueue_style('font-NotoSansJP', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap');
    wp_enqueue_style('font-Inter', 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    wp_enqueue_style('font-InknutAntiqua', 'https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@700&display=swap');
    wp_enqueue_style('font-Oswald', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
    wp_enqueue_style('font-Others', 'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700;900&family=Zen+Maru+Gothic:wght@400;500;700;900&display=swap');
    wp_enqueue_style('yakuhanjp-css', 'https://cdn.jsdelivr.net/npm/yakuhanjp@4.1.1/dist/css/yakuhanjp.css');
    wp_enqueue_style('reset-css', 'https://unpkg.com/destyle.css@4.0.1/destyle.min.css');
    wp_enqueue_style('splide-css', 'https://unpkg.com/@splidejs/splide@4.1.4/dist/css/splide-core.min.css');
    wp_enqueue_style('common-css', get_stylesheet_directory_uri().'/assets/css/common.css');

    // JavaScriptの読み込み
    wp_enqueue_script('jquery-custom', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', array('in_footer' => true, 'strategy' => 'defer'));
    wp_enqueue_script('gsap', 'https://unpkg.com/gsap@3.12.5/dist/gsap.min.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    wp_enqueue_script('scrollTrigger', 'https://unpkg.com/gsap@3.12.5/dist/ScrollTrigger.min.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    wp_enqueue_script('splide-js', 'https://unpkg.com/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    wp_enqueue_script('splide-extension-auto-scroll-js', 'https://unpkg.com/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    wp_enqueue_script('common-js', get_template_directory_uri().'/assets/js/common.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));

    // ページごとの読み込み
    if( is_front_page() ) { // HOMEのスタイル
        wp_enqueue_style('top-css', get_stylesheet_directory_uri().'/assets/css/top.css');
        wp_enqueue_script('top-js', get_template_directory_uri().'/assets/js/top.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    }
    if( is_404() ) { // 404ページのスタイル
        wp_enqueue_style('notFound-css', get_stylesheet_directory_uri().'/assets/css/notFound.css');
    }
    if( is_category('seminar') ) { // セミナーのスタイル
        wp_enqueue_style('archive-seminar-css', get_stylesheet_directory_uri().'/assets/css/archive-seminar.css');
        wp_enqueue_script('archive-news-js', get_template_directory_uri().'/assets/js/archive-news.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
        // admin-ajax.php の URL を JS に渡す
        wp_localize_script('archive-news-js', 'my_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
    if( is_tax('category_product') ) { // 商品ラインナップカテゴリーのスタイル
        wp_enqueue_style('taxonomy-category_product-css', get_stylesheet_directory_uri().'/assets/css/taxonomy-category_product.css');
    }
    if( is_archive() || is_home() ) { // ニュースリリースのスタイル
        wp_enqueue_style('archive-news-css', get_stylesheet_directory_uri().'/assets/css/archive-news.css');
        wp_enqueue_script('archive-news-js', get_template_directory_uri().'/assets/js/archive-news.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
        // admin-ajax.php の URL を JS に渡す
        wp_localize_script('archive-news-js', 'my_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
    if( is_singular('post') || is_singular('seminar') || is_singular('interview') ) { // ニュースリリース詳細のスタイル
        wp_enqueue_style('single-news-css', get_stylesheet_directory_uri().'/assets/css/single-news.css');
        wp_enqueue_style('modal-css', 'https://unpkg.com/modal-video@2.4.8/css/modal-video.min.css');
        wp_enqueue_script('modal-js', 'https://unpkg.com/modal-video@2.4.8/js/modal-video.min.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    }
    if( is_singular('product') ) { // 商品ラインナップ詳細のスタイル
        wp_enqueue_style('single-product-css', get_stylesheet_directory_uri().'/assets/css/single-product.css');
        wp_enqueue_script('single-product-js', get_template_directory_uri().'/assets/js/single-product.js', array(), '1.0.0', array('in_footer' => true, 'strategy' => 'defer'));
    }
    if( is_page('login') ) { // ログインのスタイル
        wp_enqueue_style('login-css', get_stylesheet_directory_uri().'/assets/css/page-login.css');
    }
    if( is_page('register') ) { // 新規登録のスタイル
        wp_enqueue_style('register-css', get_stylesheet_directory_uri().'/assets/css/page-register.css');
    }
    if( is_page('mypage') ) { // マイページのスタイル
        wp_enqueue_style('mypage-css', get_stylesheet_directory_uri().'/assets/css/page-mypage.css');
    }
}
add_action('wp_enqueue_scripts', 'add_link_files');