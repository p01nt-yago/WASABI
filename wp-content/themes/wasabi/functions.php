<?php
require_once get_theme_file_path('/lib/functions/admin.php');
require_once get_theme_file_path('/lib/functions/add-link-files.php');
require_once get_theme_file_path('/lib/functions/auth.php');
require_once get_theme_file_path('/lib/functions/tinymce-custom.php');
require_once get_theme_file_path('/lib/functions/load-more-posts.php');
require_once get_theme_file_path('/lib/functions/post-ranking.php');



// /**
//  * 商品カテゴリーのある投稿タイプの保存時に親タームのチェック
//  */
// function check_parent_term_required($post_id, $post, $update) {
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return; // 自動保存や新規投稿の初期保存は無視
//     if (!$update) return; // 新規投稿時はスキップ
//     if ($post->post_status === 'trash') return; // ゴミ箱へ移動ならスキップ
//     if ($post->post_type !== 'product') return; // 対象の投稿タイプ以外ならスキップ

//     $terms = wp_get_post_terms($post_id, 'category_product');
//     $has_parent = false;

//     foreach ($terms as $term) {
//         if ($term->parent == 0) {
//             $has_parent = true;
//             break;
//         }
//     }

//     if (!$has_parent) {
//         // 投稿の保存をキャンセル（上書き防止のためロック）
//         remove_action('save_post', 'check_parent_term_required');

//         // 下書きに戻して保存
//         wp_update_post([
//             'ID' => $post_id,
//             'post_status' => 'draft'
//         ]);

//         // エラーをURLに含めてリダイレクト
//         wp_redirect(add_query_arg('parent_term_error', '1', get_edit_post_link($post_id, 'raw')));
//         exit;
//     }
// }
// add_action('save_post', 'check_parent_term_required', 10, 3);

// // 投稿画面でエラーメッセージを表示
// function show_parent_term_error_notice() {
//     global $pagenow;
//     if ($pagenow === 'post.php' && isset($_GET['parent_term_error'])) {
//         echo '<div class="notice notice-error"><p><strong>商品カテゴリーで親カテゴリー（ターム）を1つ以上選択してください。</strong></p></div>';
//     }
// }
// add_action('admin_notices', 'show_parent_term_error_notice');




// /**
//  * barba.jsのdata-barba-namespace属性に渡す値のための関数
//  */
// function get_barba_namespace() {
//     if ( is_front_page() ) {
//         return 'top';
//     } elseif ( is_singular('product') ) {
//         return 'single-product';
//     } elseif ( is_singular('post') ) {
//         return 'single-news';
//     } elseif ( is_page() ) {
//         return 'page-' . get_post_field( 'post_name', get_post() );
//     } elseif ( is_post_type_archive('product') ) {
//         return 'archive-product';
//     } elseif ( is_tax('category_product') ) {
//         return 'taxonomy-category_product';
//     } elseif ( is_archive() ) {
//         return 'archive';
//     } elseif ( is_home() ) {
//         return 'news';
//     } elseif ( is_404() ) {
//         return 'notFound';
//     } else {
//         return 'default';
//     }
// }

// /**
//  * Yoastパンくずリンクを書き換える
//  */
// function custom_breadcrumb_change_child_term_url( $links ) {
//     // ニュースリリースのタームを英語対応
//     if ( is_archive() || is_singular('post') ) {
//         foreach ( $links as &$link ) {
//             if ( isset( $link['term_id'] ) ) {
//                 $term = get_term( $link['term_id'] );
//                 $termLink = get_term_link($link['term_id']);
//                 $link['text'] = $term->name;
//                 $link['url'] = $termLink;
//             }
//         }
//     }

//     if ( is_singular('product') ) {
//         global $post;

//         // カテゴリ情報取得（投稿に紐づくカテゴリー）
//         $terms = get_the_terms( $post->ID, 'category_product' );

//         if ( $terms ) {
//             // 改行文字を排除
//             foreach ( $links as &$link ) {
//                 $link['text'] = str_replace(
//                     [ '[br]', '[br-pc]', '[br-sp]' ],
//                     '',
//                     $link['text']
//                 );
//             }

//             foreach ( $terms as $term ) {
//                 if ( $term->parent != 0 ) {
//                     // 親ターム取得
//                     $parent = get_term( $term->parent, 'category_product' );
//                     $parent_slug = $parent->slug;
//                     $child_slug  = $term->slug;

//                     // Yoastパンくずリンクを書き換える
//                     foreach ( $links as &$link ) {
//                         if ( $link['url'] === get_term_link( $term ) ) {
//                             $link['url'] = home_url( "/category_product/{$parent_slug}#{$child_slug}" );
//                         }
//                     }
//                     break; // 最初の子カテゴリだけ処理
//                 }
//             }
//         }
//     }

//     return $links;
// }
// add_filter( 'wpseo_breadcrumb_links', 'custom_breadcrumb_change_child_term_url' );


// /**
//  * ターム名を<br>で置き換えする
//  */
// function custom_term_name_break( $term ) {
//     if ( isset( $term->name ) ) {
//         $term->name = str_replace(
//             [ '[br]', '[br-pc]', '[br-sp]' ],
//             [ '<br>', '<br class="pc">', '<br class="sp">' ],
//             $term->name
//         );
//     }
//     return $term;
// }
// add_filter( 'get_term', 'custom_term_name_break', 10, 1 );


// /**
//  * Contact Form 7の自動整形を無効化
//  */
// function wpcf7_autop_return_false() {
//     return false;
// }
// add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');

// /**
//  * メールアドレスフィールドのバリデーションを追加
//  */
// function custom_email_confirmation_validation($result, $tag) {
//     // フォームタグの名前を確認して、確認用メールアドレスフィールドのバリデーションを行う
//     if ($tag->name == 'confirm-email') {
//         // メインのメールアドレスと確認用メールアドレスを取得
//         $your_email = isset($_POST['your-email']) ? trim($_POST['your-email']) : '';
//         $confirm_email = isset($_POST['confirm-email']) ? trim($_POST['confirm-email']) : '';

//         // メールアドレスが一致しない場合、エラーメッセージを追加
//         if ($your_email !== $confirm_email) {
//             $result->invalidate($tag, 'メールアドレスが一致しません');
//         }
//     }

//     return $result;
// }
// add_filter('wpcf7_validate_email', 'custom_email_confirmation_validation', 10, 2);
// add_filter('wpcf7_validate_email*', 'custom_email_confirmation_validation', 10, 2);

// // ひらがなのみを許可するバリデーション
// function custom_hiragana_validation($result, $tag) {
//     $name = $tag['name'];
//     if ($name == 'your-name-hiragana') {
//         $value = isset($_POST[$name]) ? trim($_POST[$name]) : '';
//         if (!preg_match('/^[ぁ-んー\s　]+$/u', $value)) {
//             $result->invalidate($tag, 'ひらがなのみで入力してください。');
//         }
//     }

//     if($name == 'your-company-yomi') {
//         $value = isset($_POST[$name]) ? trim($_POST[$name]) : '';
//         if (preg_match('/[一-龠]/u', $value)) {
//             $result->invalidate($tag, '漢字以外で入力してください。');
//         }
//     }
//     return $result;
// }
// add_filter('wpcf7_validate_text*', 'custom_hiragana_validation', 20, 2);

// /**
//  * お問い合わせの種別によって送信先のメールアドレス変更
//  */
// function custom_cf7_dynamic_recipient($contact_form) {
//     $submission = WPCF7_Submission::get_instance();
//     if (!$submission) return $contact_form;

//     $data = $submission->get_posted_data();

//     // 必須項目の一つでも空なら送信中止
//     if (empty($data['your-name-kanji']) || empty($data['your-email'])) {
//         wp_die('不正な送信が検出されました。ページを再読み込みしてください。');
//         exit;
//     }

//     // フォームIDチェック（個人フォーム）
//     if ($contact_form->id() == 548) {
//         $recipient = '';

//         // selectのvalueによってアドレス変更
//         switch ($data['contact-type'][0]) {
//             case '1.商品に関するお問い合わせ':
//                 // $recipient = 'yagou@p01nt.com';
//                 $recipient = 'inquiry@farmind.co.jp';
//                 break;
//             case '2.キャンペーンに関するお問い合わせ':
//                 // $recipient = 'yagou0730.p01nt@gmail.com';
//                 $recipient = 'inquiry@farmind.co.jp';
//                 break;
//             case '3.採用に関するお問い合わせ':
//                 // $recipient = 'yagokake@me.com';
//                 $recipient = 'inquiry-jinji@farmind.co.jp';
//                 break;
//             default:
//                 // $recipient = 'yagou@p01nt.com';
//                 $recipient = 'inquiry@farmind.co.jp';
//         }

//         // メール設定を上書き
//         $mail = $contact_form->prop('mail');
//         $mail['recipient'] = $recipient;
//         // $mail['bcc'] = 'dnsadmin@farmind.co.jp';

//         $contact_form->set_properties(['mail' => $mail]);
//     }

//     // フォームIDチェック（法人フォーム）
//     if ($contact_form->id() == 556) {
//         $recipient = '';

//         // selectのvalueによってアドレス変更
//         switch ($data['contact-type'][0]) {
//             case '1.青果物・包装資材・パッケージなどに関するご提案':
//                 // $recipient = 'yagou@p01nt.com, yagou0730.p01nt@gmail.com';
//                 $recipient = 'okamura@farmind.co.jp, teshima.f@farmind.co.jp, watanabe.m@farmind.co.jp, sato.ko@farmind.co.jp, uchiyama.s@farmind.co.jp, inquiry-shokan@farmind.co.jp, endo@farmind.co.jp, suzuki.k@farmind.co.jp, wakaba@farmind.co.jp, yoshioka.r@farmind.co.jp, akiyama.t@farmind.co.jp, eguchi.t@farmind.co.jp, maruyama@farmind.co.jp, uchimura@farmind.co.jp, ishi@farmind.co.jp, fukai@farmind.co.jp';
//                 break;
//             case '2.弊社商品に関するお問い合わせ':
//                 // $recipient = 'yagou0730.p01nt@gmail.com';
//                 $recipient = 'om-all@farmind.co.jp';
//                 break;
//             case '3.広告・宣伝、マーケティング、制作、取材などに関するご提案':
//                 // $recipient = 'yagokake@me.com';
//                 $recipient = 'nagata.h@farmind.co.jp, hayashi.n@farmind.co.jp, huang@farmind.co.jp, mori@farmind.co.jp, kunichika@farmind.co.jp';
//                 break;
//             case '4.人材紹介・派遣、研修など人事に関するご提案':
//                 // $recipient = 'yagokake@me.com';
//                 $recipient = 'inquiry-jinji@farmind.co.jp';
//                 break;
//             default:
//                 // $recipient = 'yagou@p01nt.com';
//                 $recipient = 'inquiry-soumu@farmind.co.jp';
//         }

//         // メール設定を上書き
//         $mail = $contact_form->prop('mail');
//         $mail['recipient'] = $recipient;
//         // $mail['bcc'] = 'dnsadmin@farmind.co.jp';
//         // $mail['bcc'] = 'yagou@p01nt.com';

//         $contact_form->set_properties(['mail' => $mail]);
//     }

//     return $contact_form;
// }
// add_action('wpcf7_before_send_mail', 'custom_cf7_dynamic_recipient');




// /**
//  * 英語ページではタイトルの企業名を英語表記に変更
//  */
// add_filter( 'wpseo_title', function( $title ) {
//     $lang = get_locale(); // 現在の言語を取得

//     // サイト名を言語ごとに切り替え
//     $site_name = $lang === 'en_US' ? 'Farmind Corporation' : '株式会社ファーマインド';

//     // 「|」で分割して最後の部分をサイト名に置き換える
//     $parts = explode(' | ', $title);
//     if ( count($parts) > 1 ) {
//         $parts[count($parts)-1] = $site_name; // 最後の部分をサイト名に変更
//         $title = implode(' | ', $parts);
//     } else {
//         // 投稿タイトルだけの場合は末尾にサイト名を追加
//         $title .= ' | ' . $site_name;
//     }
    
//     return $title;
// });

// /**
//  * ディスクリプションの変更処理
//  */
// add_filter( 'wpseo_metadesc', function( $desc ) {
//     global $post;
//     $lang = get_locale(); // 現在の言語を取得
//     if ( empty( $desc ) && function_exists('get_field') && is_singular('post')) {
//         // ニュースリリースのディスクリプションをテキストコンテンツから抽出（日本語＆英語）
//         $flex = get_field('news_content', $post->ID);
//         if ( $flex && is_array($flex) ) {
//             foreach ( $flex as $block ) {
//                 if ( $block['acf_fc_layout'] === 'text_layout' && !empty($block['text']) ) {
//                     $content = strip_tags( strip_shortcodes( $block['text'] ) );
//                     $desc = mb_substr( trim($content), 0, 160 );
//                     break; // 最初のテキストだけ抽出
//                 }
//             }
//         }
//     }elseif($lang === 'en_US' && is_archive()){
//         // ニュースリリース(英語）アーカイブページのディスクリプションを英語で設定
//         $desc = 'News releases';
//     }
//     return $desc;
// }, 10, 2 );