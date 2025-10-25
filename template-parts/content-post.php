<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>

	<div class="article-wrapper">
		<header class="entry-header article-header">
			<div class="container">
				<div class="article-wrapper-inner">
					<div class="article-row-title">

						<div class="article-title">
							<h1><?= get_the_title() ?></h1>
						</div>

						<div class="article-date">
							<p><?= get_the_date('d/m/Y'); ?></p>
						</div>

					</div>
					<div class="article-row-image">

						<div class="article-image">
							<div class="articles__thumb">
								<?php if (has_post_thumbnail()) : ?>
									<?php echo liteimage(get_post_thumbnail_id(), [
										'thumb' => 'large',
										'args' => ['class' => 'br-25 articles__thumb_image']
									]); ?>
								<?php else : ?>
									<?php get_template_part( 'template-parts/thumb', 'placer', ['size' => '-1045-475'] ) ?>
								<?php endif; ?>
							</div>
						</div>

						<?= emptytheme_social_share( get_the_permalink(), get_the_title() ) ?>

					</div>
				</div>
			</div>
		</header>
		<div class="article-content">
			<div class="container">

				<?php get_template_part( 'template-parts/posts/content' ); ?>

			</div>
		</div>
	</div>

	<?php
	// Get related posts
	$category = get_the_terms( get_the_ID(), 'category' );
	if (!empty($category) && !is_wp_error($category)) {
		$array_id = [];
		foreach ( $category as $cat){
			$array_id[] = $cat->term_id;
		}
		$args = [
			'post_type' => 'post',
			'tax_query' => array(
				array(
					 'taxonomy' => 'category',
					 'field' => 'term_id',
					 'terms' => $array_id,
			 	),
			),
			'post__not_in' => array(get_the_ID()),
			'posts_per_page' => 4,
			'orderby' => 'rand',
		];

		$related_query = new WP_Query($args);
	} else {
		$related_query = new WP_Query(['post__in' => []]);
	}
	?>

	<?php if ($related_query->have_posts()) : ?>
		<section class="more-articles" aria-labelledby="more-articles-heading">
			<div class="container">
				<header class="section-header">
					<h2 id="more-articles-heading">
						<?= __('More articles', 'emptytheme') ?>
					</h2>
				</header>
				<div class="row row__30">
					<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
						<?php get_template_part('template-parts/posts/more', 'post'); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

</article><!-- #post-<?php the_ID(); ?> -->