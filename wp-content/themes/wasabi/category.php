<?php get_header(); ?>

<?php
	require_once(get_template_directory() . '/lib/helpers/imageInfo.php');
?>

<?php
	$object = get_queried_object();
	$cateName = $object->name;
?>

		<h2 class="newsCate_title"><?php echo $cateName; ?> ARTICLE</h2>

		<?php
			if (have_posts()) :
		?>
			<div class="news_list">
				<?php
					while ( have_posts() ){
						the_post();
						get_template_part('page-templates/news/item');
					}
				?>
			</div>

		<?php
			else:
		?>
				<p class="noPost_notice">まだ、ニュースリリースはありません</p>
		<?php
			endif;
		?>

<?php get_footer(); ?>
