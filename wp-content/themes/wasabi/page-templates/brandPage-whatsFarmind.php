<?php
/**
 * ブランドページのWhat's Farmindと関連記事パート
 *
 * @param number termID 商品カテゴリーの親タームID
 */
?>
<?php
    require_once(get_template_directory() . '/functions/imageInfo.php');

    $termID = $args['termID'];
?>
<section class="section_blandWhatsFarmind">
    <div class="blandWhatsFarmind_container">
        <h3 class="blandWhatsFarmind_head">What’s Farmind ?</h3>
        <div class="blandWhatsFarmind_wrap">
            <p class="blandWhatsFarmind_text">おいしい幸せを届ける<br>ファーマインドとは</p>
            <?php
                $imageID = get_field('icon', 'category_' . $termID) ? get_field('icon', 'category_' . $termID) : 197;
                $image = imageInfo($imageID);
            ?>
            <img class="blandWhatsFarmind_icon" src="<?php echo $image['src'] ?>" alt="<?php echo $image['alt'] ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>">
            <div class="blandWhatsFarmind_btn">
                <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => '詳しくはこちら', 'href' => get_page_link( 347 ), 'type' => 'outlineGreen'] ); ?>
            </div>
        </div>
    </div>
</section>

<section class="section_blandRelatedArticle">
    <div class="blandRelatedArticle_container">
        <div class="blandRelatedArticle_wrap">
            <h3 class="blandRelatedArticle_title">関連記事</h3>
            <div class="blandRelatedArticle_inner">
                <a class="blandRelatedArticle_link" href="<?php echo get_page_link( 343 ) ?>">企業情報</a>
                <a class="blandRelatedArticle_link" href="<?php echo get_page_link( 349 ) ?>">サステナビリティ</a>
            </div>
        </div>
    </div>
</section>