<?php
	require_once(get_template_directory() . '/lib/helpers/imageInfo.php');

    $imageID = get_post_thumbnail_id() ? get_post_thumbnail_id() : 234;
    $image = imageinfo($imageID);
?>

<a class="news_item" href="<?php the_permalink(); ?>">
    <div class="news_item_thumb_box">
        <img class="news_item_thumb" src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" loading="lazy">
    </div>
    <div class="news_item_info">
        <?php
            $categories = get_the_category();
            if($categories) :
                echo '<div class="news_item_category_box">';
                foreach($categories as $category) :
        ?>
                    <h4 data-link="<?php echo get_category_link($category->term_id); ?>" class="news_item_category"><?php echo $category->cat_name; ?></h4>
        <?php
                endforeach;
                echo '</div>';
            endif;
        ?>
        <h3 class="news_item_title"><?php the_title(); ?></h3>
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
        <p class="news_item_date"><?php echo get_the_date('Y.m.d'); ?></p>
    </div>
</a>