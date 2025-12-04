<?php
    get_header();

    require_once(get_template_directory() . '/functions/imageInfo.php');
?>

    <?php get_template_part( 'page-templates/page-title', null, ['bg_img' => get_stylesheet_directory_uri().'/assets/images/archive-product/title_bg_pc.jpg', 'bg_img_sp' => get_stylesheet_directory_uri().'/assets/images/archive-product/title_bg.jpg', 'title_en' => 'Our Products', 'title_ja' => '商品ラインナップ'] ); ?>

    <section class="section_product">
        <div class="product_container">
            <p class="product_readText">おいしい幸せのつまったファーマインドの商品をご紹介します。</p>

            <?php 
                $terms = get_terms('category_product',['hide_empty'=>1, 'parent'=>0]);
                if($terms) :
            ?>
                    <div class="product_wrap">
            <?php 
                        foreach( $terms as $term ) :
                            $termID = $term->term_id;
                            $thumbID = get_field('thumbnail', 'category_product_' . $termID);
                            if($thumbID){
                                $thumbURL = imageInfo($thumbID)["src"];
                            }else{
                                $thumbURL = wp_get_attachment_url(214);
                            }
            ?>
                            <a class="product_item" href="<?php echo get_category_link( $termID ); ?>">
                                <div class="product_item_info" style="background-image: url(<?php echo $thumbURL; ?>);">
                                    <?php if(get_field('name_en', 'category_' . $termID)): ?>
                                        <h2 class="product_item_titleEn"><?php echo get_field('name_en', 'category_' . $termID) ?></h2>
                                    <?php endif; ?>
                                    <h3 class="product_item_titleJa"><?php echo $term->name ?></h3>

                                    <?php if($termID == 37): ?>
                                        <picture class="product_item_teamFIcon">
                                            <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/common/teamF_icon.webp" type="image/webp">
                                            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/common/teamF_icon.png" alt="Team the F" width="1" height="1" loading="lazy">
                                        </picture>
                                    <?php endif; ?>
                                </div>
                                <div class="product_item_btn">詳しくはこちら</div>
                            </a>
            <?php endforeach; ?>
                    </div>
            <?php else: ?>
                <p>現在、掲載できる商品はありません</p>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>