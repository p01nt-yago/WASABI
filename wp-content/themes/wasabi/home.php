<?php get_header(); ?>

<?php
	require_once(get_template_directory() . '/lib/helpers/imageInfo.php');
?>

	<?php 
		$args = [
			'post_type' => array('post','interview','seminar'),
			'posts_per_page' => 2,
			'paged' => 1,
		];
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :
	?>
			<div class="news_list" id="posts-container">
				<?php 
					while ( $the_query->have_posts() ){
						$the_query->the_post();
						get_template_part('page-templates/news/item');
					}
				?>
			</div>

			<button id="load-more" data-page="1" data-post-type="post,interview,seminar">もっと見る</button>
	<?php
		else:
		wp_reset_postdata();
	?>
		<p>ニュースリリースはまだありません。</p>
	<?php
		endif;
	?>

<?php get_footer(); ?>
