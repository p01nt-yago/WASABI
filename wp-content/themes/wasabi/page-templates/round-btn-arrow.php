<?php
/**
 * 角丸ボタン 円矢印
 * 
 * @param string text テキスト
 * @param string href リンク先
 * @param string type タイプ - default
 * default      - 枠線：黒、背景：透明、文字色：黒、矢印：緑
 */

require_once(get_template_directory() . '/functions/hrefSetting.php');
$href = hrefSetting($args['href']);
?>
<a class="round_btn_arrow <?php echo $args['type'] ?>" <?php echo $href ?>><?php echo $args['text'] ?></a>