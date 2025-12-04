<?php
/**
 * 楕円型ボタン
 * 
 * @param string text テキスト
 * @param string href リンク先
 * @param string type タイプ - default | outlineGreen | outlineWhite
 * default      - 枠線：黒、背景：透明、文字色：黒
 * outlineGreen - 枠線：緑、背景：白、文字色：緑
 * outlineWhite - 枠線：白、背景：透明、文字色：白
 */

require_once(get_template_directory() . '/functions/hrefSetting.php');
$href = hrefSetting($args['href']);
?>
<a class="roundFull_btn <?php echo $args['type'] ?>" <?php echo $href ?>><?php echo $args['text'] ?></a>