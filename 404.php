<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package emptytheme
 */

get_header();
?>


<div class="container">
	<section class="error-404 not-found">

		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'emptytheme' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p dir="ltr"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'emptytheme' ); ?></p>

				<?php get_search_form(); ?>

				<div class="recent row row__70_30">
					<div class="col-2">
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					</div>

					<div class="widget widget_categories col-2">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'emptytheme' ); ?></h2>
						<ul>
							<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->

					<div class="col-2">
						<?php
							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'emptytheme' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
						?>
					</div>

					<div class="col-2 category">
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>
				</div>

		</div><!-- .page-content -->

	</section><!-- .error-404 -->
</div><!-- .container -->

<?php
get_footer();
