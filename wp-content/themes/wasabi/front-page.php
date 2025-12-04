<?php
    get_header();

    require_once(get_template_directory() . '/lib/helpers/imageInfo.php');
    require_once(get_template_directory() . '/lib/helpers/hrefSetting.php');
?>

<p>トップページ</p>

<ul>
    <li>
        ・パスワードリセットページ<br>
        独自UIで実装する。
    </li>
    <li>
        ・会員削除機能
    </li>
</ul>
<ul>
    <li>
        ・記事のランキング機能
    </li>
</ul>

<?php get_footer(); ?>