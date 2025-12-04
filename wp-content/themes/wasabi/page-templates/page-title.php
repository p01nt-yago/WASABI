<?php
/**
 * 下層ページタイトル
 * 
 * 背景画像があれば背景画像ありのタイトルを
 * なければタイトルのみを表示する
 * 
 * @param string bg_img 背景画像
 * @param string bg_img_sp 背景画像（スマートフォン用）
 * @param string title_en 英語タイトル
 * @param string title_ja 日本語タイトル
 */
?>

<?php if( $args['bg_img'] ): ?>
    <?php
        // 簡易的なユーザーエージェント判定（スマホ判定）
        $isMobile = preg_match('/iPhone|iPad|iPod|Android/i', $_SERVER['HTTP_USER_AGENT']);
        $bgImg = $isMobile ? $args['bg_img_sp'] : $args['bg_img'];
    ?>
    <div class="page_title_wrap" style="background-image: url(<?php echo $bgImg ?>);">
        <h2 class="page_title_en"><?php echo $args['title_en'] ?></h2>
        <?php if($args['title_ja']): ?>
            <h3 class="page_title_ja"><?php echo $args['title_ja'] ?></h3>
        <?php endif; ?>
    </div>
<?php else: ?>
    <h2 class="page_title_en -green"><?php echo $args['title_en'] ?></h2>
    <?php if($args['title_ja']): ?>
        <h3 class="page_title_ja -green"><?php echo $args['title_ja'] ?></h3>
    <?php endif; ?>
<?php endif; ?>
