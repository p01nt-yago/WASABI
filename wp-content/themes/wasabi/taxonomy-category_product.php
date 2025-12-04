<?php
    get_header();

    require_once(get_template_directory() . '/functions/imageInfo.php');
?>

<?php 
    $term_object = get_queried_object();

    $termID = $term_object->term_id;
    $postCount = $term_object->count;
    $termTaxonomy = $term_object->taxonomy;
    $termBgImgURL = get_field('bg_img', 'category_' . $termID) ? imageInfo(get_field('bg_img', 'category_' . $termID))['src'] : wp_get_attachment_url(215);
    $termBgImgSpURL = get_field('bg_img_sp', 'category_' . $termID) ? imageInfo(get_field('bg_img_sp', 'category_' . $termID))['src'] : wp_get_attachment_url(215);
    $termNameEn = get_field('name_en', 'category_' . $termID);
    $termNameJa = $term_object->name;
    $termReadText = get_field('cate_desc', 'category_' . $termID);
    $termChildren = get_terms('category_product', ['parent'=>$termID]);
    $termIDs = array_map(function($term) { return $term->term_id; }, $termChildren);
?>

<?php get_template_part( 'page-templates/page-title', null, ['bg_img' => $termBgImgURL, 'bg_img_sp' => $termBgImgSpURL, 'title_en' => $termNameEn, 'title_ja' => $termNameJa] ); ?>

<p class="read_text"><?php echo $termReadText; ?></p>

<section class="section_cateList">
    <div class="cateList_container">
        <ul class="cateList_wrap">
            <?php
                foreach($termChildren as $term):
            ?>      
                <li class="cateList_line"><a class="cateList_link" href="<?php echo '#'.$term->slug; ?>"><?php echo $term->name; ?></a></li>
            <?php endforeach; ?>
            <?php
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'tax_query' => [
                        'relation' => 'AND',
                        [
                            'taxonomy' => $termTaxonomy,
                            'terms' => $termID,
                        ],
                        [
                            'taxonomy' => $termTaxonomy,
                            'terms' => $termIDs,
                        ]
                    ]
                ];
                $the_query = new WP_Query( $args );

                if($postCount - $the_query->post_count): // 小カテゴリーに含まれない記事がある場合
            ?>
                    <li class="cateList_line"><a class="cateList_link" href="#others">その他</a></li>
            <?php
                endif;
            ?>
        </ul>
    </div>
</section>

<section class="section_product">
    <div class="product_container">
        <?php
            $exceptTermID = [];
            foreach($termChildren as $term):
                $exceptTermID[] = $term->term_id;
                $childTermID = $term->term_id;
        ?>
                <div class="product_cateTitle" id="<?php echo $term->slug; ?>">
                    <?php get_template_part( 'page-templates/headline-bg', null, ['title' => $term->name] ); ?>
                </div>

                <div class="product_wrap">
                    <?php
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'tax_query' => [
                                'relation' => 'AND',
                                [
                                    'taxonomy' => $termTaxonomy,
                                    'terms' => $termID,
                                ],
                                [
                                    'taxonomy' => $termTaxonomy,
                                    'terms'=> $childTermID,
                                ]
                            ]
                        ];
                        $the_query = new WP_Query( $args );

                        if ( $the_query->have_posts() ) :
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                                $imageID = get_post_thumbnail_id() ? get_post_thumbnail_id() : 237;
                                $image = imageInfo($imageID);
                    ?>
                                <?php get_template_part( 'page-templates/product-item' ); ?>
                    <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
        <?php endforeach; ?>

        <?php 
            $args = [
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => $termTaxonomy,
                        'terms' => $termID,
                    ],
                    [
                        'taxonomy' => $termTaxonomy,
                        'terms' => $exceptTermID,
                        'operator' => 'NOT IN',
                    ]
                ]
            ];
            $the_query = new WP_Query( $args );
            
            if ( $the_query->have_posts() ) :
        ?>
                <div class="product_cateTitle" id="others">
                    <?php get_template_part( 'page-templates/headline-bg', null, ['title' => 'その他'] ); ?>
                </div>

                <div class="product_wrap">
        <?php 
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    get_template_part( 'page-templates/product-item' );
                }
        ?>
                </div>
        <?php
            endif;
            wp_reset_postdata();
        ?>

        <div class="product_archive_btn">
            <?php get_template_part( 'page-templates/roundFull-btn', null, ['text' => 'ほかの商品も見る', 'href' => get_post_type_archive_link('product'), 'type' => 'outlineGreen'] ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>