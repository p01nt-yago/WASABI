<?php get_header(); ?>
<?php
	require_once(get_template_directory() . '/lib/helpers/imageInfo.php');
	require_once(get_template_directory() . '/lib/helpers/getVideoId.php');

    $categories = get_the_category();
    $cateID = $categories[0]->term_id;
?>

<style>
.c-heading {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 1.5em 0 0.7em;
}

.c-body {
    font-size: 1rem;
    line-height: 1.8;
    margin: 1em 0;
}

.c-note {
    font-size: 0.8rem;
    color: #ccc;
    margin: 1em 0;
    padding-left: 1em;
    border-left: 3px solid #ccc;
}

.c-cta{
    display: inline-block;
    background-color: #000;
    color: #fff;
    padding: 0.8em 1.5em;
    text-decoration: none;
    margin: 1em 0;
}
</style>

<?php
if ( $cateID == 16 ) { // インタビューカテゴリー
    get_template_part('page-templates/news/news-content', 'interview');
// } elseif( $cateID == 17 ) { // セミナーカテゴリー
//     get_template_part('page-templates/news/news-content', 'seminar');
} else {
    get_template_part('page-templates/news/news-content', 'default');
}
?>


<?php get_footer(); ?>