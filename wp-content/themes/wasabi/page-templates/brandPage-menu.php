<?php
/**
 * ブランドページのページ内遷移用メニュー
 *
 * @param array { text: string, href: string }[]
 */
?>
<div class="brandPage_menu_wrap">
    <?php foreach( $args as $value ): ?>
        <a class="brandPage_menu_item" href="<?php echo $value['href'] ?>"><?php echo $value['text'] ?></a>
    <?php endforeach; ?>
</div>