<?php
    get_header();

    require_once(get_template_directory() . '/functions/imageInfo.php');
    require_once(get_template_directory() . '/functions/hrefSetting.php');

    $postTermIDs = array_map(function ($term) {
        return $term->term_id;
    }, get_the_terms($post->ID, 'category_product'));
    $parentTerms = get_terms(array( 'taxonomy' => 'category_product', 'parent' => 0, 'include' => $postTermIDs ));
    $termID = $parentTerms[0]->term_id;
?>

<?php
    /**
     * 画像付きリンクパーツ
     * 
     * @param int $imageID 画像ID
     * @param array $linkArray リンク情報
     */
    function linkWithImage($imageID, $linkArray) {
        $image = imageInfo($imageID);
        if($linkArray['target'] || strpos($linkArray['url'], 'manomi')){
            $href = 'href="' . $linkArray['url'] . '" target="_blank" rel="noopener noreferrer"';
        }else{
            $href = hrefSetting($linkArray['url']);
        }
        echo <<<EOD
            <a class="linkWithImage_item" $href>
                <div class="linkWithImage_item_img_box">
                    <img class="linkWithImage_item_img" src="{$image['src']}" alt="{$image['alt']}" width="{$image['width']}" height="{$image['height']}" loading="lazy">
                </div>
                <div class="linkWithImage_item_btn">{$linkArray['title']}</div>
            </a>
        EOD;
    }
?>

<section class="section_firstView">
    <div class="firstView_container">
        <div class="firstView_wrap">
            <?php
                $imageID = get_post_thumbnail_id() ? get_post_thumbnail_id() : 237;
                $image = imageInfo($imageID);
            ?>
            <div class="firstView_thumb_box">
                <img src="<?php echo $image['src'] ?>" alt="<?php echo $image['alt'] ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>">
            </div>

            <div class="firstView_info">
                <h2 class="firstView_title"><?php the_title(); ?></h2>

                <?php if( get_field('readtext') ): ?>
                    <p class="firstView_readtext"><?php echo get_field('readtext'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php if( get_field('features') ): ?>
    <section class="section_feature">
        <div class="feature_container">
            <h3 class="singleProduct_underlineHead">主な特徴</h3>

            <?php
                $iconHTML = ''; // アイコンHHTML格納用
                $cardHTML = ''; // カードHTML格納用
                foreach(get_field('features') as $feature){
                    // アイコンの処理
                    $iconHTML .= <<<EOD
                        <div class="feature_icon">
                            <div class="feature_icon_text">{$feature['title']}</div>
                        </div>
                    EOD;

                    // カードの処理
                    if($feature['text']){
                        $imageHTML = '';
                        $noticeHTML = '';

                        if( $feature['image'] ){
                            $image = imageInfo($feature['image']);

                            $imageHTML = <<<EOD
                                <div class="feature_img_box">
                                    <img class="feature_img" src="{$image['src']}" alt="{$image['alt']}" width="{$image['width']}" height="{$image['height']}" loading="lazy">
                                </div>
                            EOD;
                        }

                        if( $feature['notice'] ){
                            $noticeHTML = <<<EOD
                                <div class="feature_notice">{$feature['notice']}</div>
                            EOD;
                        }
                        
                        $cardHTML .= <<<EOD
                        <div class="feature_item">
                            <div class="feature_inner">
                                <div class="feature_info_box">
                                    <h4 class="feature_title">{$feature['title']}</h4>
                                    <div class="feature_text">{$feature['text']}</div>
                                </div>
                                $imageHTML
                            </div>
                            $noticeHTML
                        </div>
                        EOD;
                    }
                }
            ?>

            <div class="feature_icon_wrap">
                <?php echo $iconHTML ?>
            </div>

            <?php if($cardHTML): ?>
                <div class="feature_wrap">
                    <?php echo $cardHTML ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('product_video') ): ?>
    <section class="section_productVideo">
        <div class="productVideo_container">
            <div class="productVideo_wrap">
                <?php foreach(get_field('product_video') as $productVideo): ?>
                    <div class="productVideo_inner"><?php echo $productVideo['oembed'] ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('recipe_group')['recipe_content'] || get_field('recipe_group')['recipe_btn'] ): ?>
    <section class="section_recipe">
        <div class="recipe_container">
            <h3 class="singleProduct_head">Recipe</h3>
            <div class="recipe_wrap">
                <?php 
                    $recipeContent = get_field('recipe_group')['recipe_content'];
                    if( $recipeContent ):
                        foreach($recipeContent as $recipe):
                            $image = imageInfo($recipe['image']);

                            if($recipe['link']['target']){
                                $href = 'href="' . $recipe['link']['url'] . '" target="_blank" rel="noopener noreferrer"';
                            }else{
                                $href = hrefSetting($recipe['link']['url']);
                            } 
                ?>
                            <a class="recipe_inner" <?php echo $href; ?>>
                                <div class="recipe_img_box">
                                    <img class="recipe_img" src="<?php echo $image['src'] ?>" alt="<?php echo $image['alt'] ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" loading="lazy">
                                </div>
                                <p class="recipe_text"><?php echo $recipe['link']['title'] ?></p>
                            </a>
                <?php
                        endforeach;
                    endif;
                ?>
            </div>
            <?php
                $recipeBtn = get_field('recipe_group')['recipe_btn'];
                if( $recipeBtn ):
            ?>
                <div class="recipe_btn">
                    <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => $recipeBtn['title'], 'href' => $recipeBtn['url'], 'type' => 'outlineGreen'] ); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('product_info') ): ?>
    <section class="section_info">
        <div class="info_container">
            <div class="info_wrap">
                <div class="info_title_inner">
                    <h3 class="info_title">商品情報</h3>
                    <button class="info_title_plus"></button>
                </div>
                <div class="info_content_inner">
                    <div class="info_content_box">
                        <?php
                            foreach(get_field('product_info') as $productInfo) {
                                if($productInfo['acf_fc_layout'] == 'headline_layout') {
                                    echo '<h4 class="info_content_head">'.$productInfo['headline'].'</h4>';
                                }elseif($productInfo['acf_fc_layout'] == 'text_layout') {
                                    echo '<p class="info_content_text">'.$productInfo['text'].'</p>';
                                }elseif($productInfo['acf_fc_layout'] == 'notice_layout') {
                                    echo '<p class="info_content_notice">'.$productInfo['notice'].'</p>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('brandsite') ): ?>
    <section class="section_brandsite">
        <div class="brandsite_container">
            <div class="brandsite_wrap">
            <?php
                foreach(get_field('brandsite') as $brandsite) {
                    linkWithImage($brandsite['image'], $brandsite['link']);
                }
            ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('check') ): ?>
    <section class="section_check">
        <div class="check_container">
            <h3 class="singleProduct_head">Check !</h3>
            <div class="check_wrap">
                <?php
                    foreach(get_field('check') as $check) {
                        $imageHTML = '';
                        if($check['image']){
                            $image = imageInfo($check['image']);
                            $imageHTML = '<img class="check_img" src="'.$image['src'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$image['alt'].'" loading="lazy">';
                        }
                        $textHTML = $check['text'] ? '<p class="check_text">'.$check['text'].'</p>' : '';

                        echo <<<EOD
                            <div class="check_inner">
                                <h3 class="check_head">{$check['headline']}</h3>
                                $imageHTML
                                $textHTML
                            </div>
                        EOD;
                    }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section_goodTaste">
    <div class="goodTaste_container">
        <h3 class="singleProduct_head">What’s Farmind ?</h3>
        <div class="goodTaste_wrap">
            <p class="goodTaste_text">おいしい幸せを届ける<br>ファーマインドとは</p>
            <?php
                $imageID = get_field('icon', 'category_' . $termID) ? get_field('icon', 'category_' . $termID) : 197;
                $image = imageInfo($imageID);
            ?>
            <img class="goodTaste_icon" src="<?php echo $image['src'] ?>" alt="<?php echo $image['alt'] ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>">
            <div class="goodTaste_btn">
                <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => '詳しくはこちら', 'href' => get_page_link( 347 ), 'type' => 'outlineGreen'] ); ?>
            </div>
        </div>
    </div>
</section>

<section class="section_relatedArticle">
    <div class="relatedArticle_container">
        <div class="relatedArticle_wrap">
            <h3 class="relatedArticle_title">関連記事</h3>
            <div class="relatedArticle_inner">
                <a class="relatedArticle_link" href="<?php echo get_page_link( 343 ) ?>">企業情報</a>
                <a class="relatedArticle_link" href="<?php echo get_page_link( 349 ) ?>">サステナビリティ</a>
            </div>
        </div>
    </div>
</section>

<section class="section_relatedProduct">
    <div class="relatedProduct_container">
        <?php if( get_field('related_product') ): ?>
            <h3 class="singleProduct_underlineHead">関連商品</h3>
        <?php endif; ?>
        <div class="relatedProduct_wrap">
            <?php if( get_field('related_product') ): ?>
                <div class="relatedProduct_inner">
                    <?php 
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'post__in' => get_field('related_product'),
                        ];
                        $the_query = new WP_Query( $args );
                        while ( $the_query->have_posts() ){
                            $the_query->the_post();

                            get_template_part( 'page-templates/product-item' );
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
            <div class="relatedProduct_btn">
                <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => 'ほかの商品も見る', 'href' => get_post_type_archive_link('product'), 'type' => 'outlineGreen'] ); ?>
            </div>
        </div>
    </div>
</section>

<section class="section_contact">
    <div class="contact_container">
        <h3 class="contact_title">商品に関するお問い合わせ</h3>
        <p class="contact_text">よくお問い合わせいただく<br>ご質問と解決策</p>
        <div class="contact_btn">
            <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => 'FAQ', 'href' => get_page_link( 324 ), 'type' => 'outlineGreen'] ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>