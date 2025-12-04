<?php get_header(); ?>

<?php
	require_once(get_template_directory() . '/lib/helpers/imageInfo.php');
?>

<?php
	$object = get_queried_object();
	$cateName = $object->name;
?>

	<h2 class="newsCate_title">PICKUP</h2>

	<div class="pickup_wrap">
		<div class="pickup_inner">
			<?php 
				$args = [
					'post_type' => 'interview',
					'posts_per_page' => 6,
					'meta_query' => [
						'relation' => 'AND',
						[
							'key' => 'pickup',
							'value' => true,
							'type' => 'BOOLEAN',
							'compare' => '='
						],
					],
				];
				$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ) :
			?>
					<div class="pickup_list">
						<?php 
							while ( $the_query->have_posts() ){
								$the_query->the_post();
								get_template_part('page-templates/news/item');
							}
						?>
					</div>
			<?php
				else:
				wp_reset_postdata();
			?>
				<p>ニュースリリースはまだありません。</p>
			<?php
				endif;
			?>
		</div>
	</div>


	<h2 class="newsCate_title"><?php echo $cateName; ?> ARTICLE</h2>

	<?php 
		$args = [
			'post_type' => 'interview',
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

			<button id="load-more" data-page="1" data-post-type="interview">もっと見る</button>
	<?php
		else:
		wp_reset_postdata();
	?>
		<p>ニュースリリースはまだありません。</p>
	<?php
		endif;
	?>

<?php get_footer(); ?>
