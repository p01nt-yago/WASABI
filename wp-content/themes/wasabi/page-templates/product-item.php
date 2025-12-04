<?php
/**
 * 商品アイテムカード
 * 
 * ループ内でのみ使用可能
 */

require_once(get_template_directory() . '/functions/imageInfo.php');
$imageID = get_post_thumbnail_id() ? get_post_thumbnail_id() : 237;
$image = imageInfo($imageID);
?>
<a class="productItem_box" href="<?php the_permalink(); ?>">
    <div class="productItem_info">
        <h3 class="productItem_title"><?php the_title(); ?></h3>
        <?php
            if(get_field('description')){
                echo '<div class="productItem_desc">';
                foreach(get_field('description') as $itemDesc){
                    if($itemDesc['acf_fc_layout'] == 'text_layout'){
                        echo '<p class="productItem_desc_text">'. $itemDesc['text'] .'</p>';
                    }elseif($itemDesc['acf_fc_layout'] == 'notice_layout'){
                        echo '<p class="productItem_desc_notice">'. $itemDesc['notice'] .'</p>';
                    }
                }
                echo '</div>';
            }
        ?>
        <img class="productItem_img" src="<?php echo $image['src'] ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" alt="<?php echo $image['alt'] ?>" loading="lazy">
    </div>
    <div class="productItem_btn">詳しくはこちら</div>
</a>