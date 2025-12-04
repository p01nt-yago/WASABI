<?php
$url_encode = urlencode( get_permalink() );
$title_encode = urlencode( get_the_title() );
?>

<section class="section_news">
    <div class="news_container">
        <div class="news_wrap">
            <div class="news_info_wrap">
                <?php
                    $categories = get_the_category();
                    if($categories) :
                        echo '<ul class="news_info_cate_box">';
                        foreach($categories as $category) :
                ?>
                            <a class="news_info_cate_cate" href="<?php echo get_category_link($category->term_id); ?>"><li><?php echo $category->cat_name; ?></li></a>
                <?php
                        endforeach;
                        echo '</ul>';
                    endif;
                ?>
                <h2 class="news_title"><?php the_title(); ?></h2>
                <?php
                    $tags = get_the_tags();
                    if($tags) :
                        echo '<div class="news_item_tag_box">';
                        foreach($tags as $tag) :
                ?>
                            <h4 data-link="<?php echo get_tag_link($tag->term_id); ?>" class="news_item_tag">#<?php echo $tag->name; ?></h4>
                <?php
                        endforeach;
                        echo '</div>';
                    endif;
                ?>

                <?php $timestamp = get_post_time('U', true); ?>
                <p class="news_info_date"><?php echo date('Y.m.d D', $timestamp); ?></p>
            </div>

            <?php
                $imageID = get_post_thumbnail_id() ? get_post_thumbnail_id() : 234;
                $image = imageinfo($imageID);
            ?>
            <div class="news_main_img_box">
                <img class="news_main_img" src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" loading="lazy">
            </div>
            <p class="news_main_img_caption"><?php echo $image['caption']; ?></p>

            <?php if( get_field('summary') ): ?>
                <div class="news_summary">
                    <?php echo get_field('summary') ?>
                </div>
            <?php endif; ?>

            <?php if( get_field('contents') ): ?>
                <div class="news_content_inner">
                    <?php
                        foreach(get_field('contents') as $content) {
                            $contentLayout = $content['acf_fc_layout'];

                            if($contentLayout == 'slide_layout') {
                                echo '<section class="splide">
                                        <div class="splide__track">
                                            <ul class="splide__list">';
                                                foreach($content['slide_images'] as $slideImage) {
                                                    $image = imageInfo($slideImage['img']);

                                                    echo <<<EOD
                                                        <div class="splide__slide">
                                                            <img class="news_content_img" src="{$image['src']}" alt="{$image['alt']}" width="{$image['width']}" height="{$image['height']}" loading="lazy">
                                                            <p>{$image['caption']}</p>
                                                        </div>
                                                    EOD;
                                                }
                                echo '       </ul>
                                        </div>
                                    </section>';
                            }elseif($contentLayout == 'text_layout') {
                                echo '<div>'.$content['text'].'</div>';
                            }elseif($contentLayout == 'img_layout') {
                                $image = imageInfo($content['img']);
                                echo <<<EOD
                                    <div>
                                        <img class="news_content_img" src="{$image['src']}" alt="{$image['alt']}" width="{$image['width']}" height="{$image['height']}" loading="lazy">
                                        <p>{$image['caption']}</p>
                                    </div>
                                EOD;
                            }elseif($contentLayout == 'img-video_layout') {
                                $image = imageInfo($content['img']);
                                $icon_url = get_template_directory_uri() . '/assets/images/common/videoStart_btn_white.svg';
                                $video_id = extract_video_id($content['video_id']);
                                echo <<<EOD
                                    <div>
                                        <img class="news_content_img" src="{$image['src']}" alt="{$image['alt']}" width="{$image['width']}" height="{$image['height']}" loading="lazy">
                                        <p>{$image['caption']}</p>
                                        <img class="js-modal-btn" src="{$icon_url}" data-video-id="{$video_id['id']}" alt="動画アイコン" width="50" height="50" loading="lazy">
                                    </div>
                                EOD;
                            }elseif($contentLayout == 'profile_layout') {
                                $image = imageInfo($content['img']);
                                echo <<<EOD
                                    <div>
                                        <img class="news_content_img" src="{$image['src']}" alt="{$image['alt']}" width="{$image['width']}" height="{$image['height']}" loading="lazy">
                                        <div>{$content['text']}</div>
                                    </div>
                                EOD;
                            }
                        }
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if( get_field('related_links') ): ?>
                <div class="news_related_links">
                    <h3 class="news_related_links_title">関連リンク</h3>
                    <ul class="news_related_links_list">
                        <?php
                            foreach(get_field('related_links') as $relatedLink) {
                                echo <<<EOD
                                    <li class="news_related_links_item">
                                        <a href="{$relatedLink['link']['url']}" target="{$relatedLink['link']['target']}">{$relatedLink['link']['title']}</a>
                                    </li>
                                EOD;
                            }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="news_contact_wrap">
                <div>
                    ◆お問い合わせ申込み先<br>
                    　株式会社TonTon<br>
                    　TEL：000-000-0000<br>
                    　受付時間：平日00:00〜00:00（休業日：土日、祝祭日、年末年始）<br>
                    　MAIL：000xxx@xxxx.xx
                </div>
            </div>

            <div class="news_shareLink_wrap">
                <a href="https://www.facebook.com/sharer.php?u=<?php echo $url_encode; ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/common/share_icon_facebook.svg'; ?>" alt="facebook" width="50" height="50" loading="lazy">
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo $url_encode; ?>&text=<?php echo $title_encode; ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/common/share_icon_x.svg'; ?>" alt="facebook" width="50" height="50" loading="lazy">
                </a>
                <div>
                    <button data-url="<?php echo get_permalink(); ?>" class="copyLinkBtn">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/common/share_icon_link.svg'; ?>" alt="facebook" width="50" height="50" loading="lazy">
                    </button>
                    <span class="copyLinkMsg" style="display:none; margin-left:6px; color:green;">コピーしました！</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener( 'DOMContentLoaded', function () {
        new Splide( '.splide', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            gap: '20px',
            arrows: false,
            breakpoints: {
                768: {
                    perPage: 1,
                },
                1024: {
                    perPage: 2,
                },
            },
        } ).mount();


        new ModalVideo('.js-modal-btn', {
            youtube: {
                autoplay: 1,
                rel: 0,
                showinfo: 0
            },
            vimeo: {
                autoplay: 1
            }
        });

        // URLコピー処理
        const btn = document.querySelector('.copyLinkBtn');
        const message = document.querySelector('.copyLinkMsg');

        btn.addEventListener("click", () => {
            const url = btn.dataset.url;

            navigator.clipboard.writeText(url)
                .then(() => {
                    message.style.display = "inline";
                    setTimeout(() => message.style.display = "none", 2000);
                })
                .catch(() => {
                    alert("コピーできませんでした");
                });
        });
    });
</script>