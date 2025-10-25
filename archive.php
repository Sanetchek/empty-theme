<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

get_header();
?>

<div class="archive-wrapper">
    <div class="container">
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <section class="archive-content" aria-label="<?php esc_attr_e('Archive Posts', 'emptytheme'); ?>">
                <div class="row row__30">
                    <?php
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part( 'template-parts/posts/more', get_post_type() );

                        endwhile; ?>
                </div>

                <nav class="pagination" aria-label="<?php esc_attr_e('Posts navigation', 'emptytheme'); ?>">
                    <?php
                    // Custom pagination
                    $pagination_args = array(
                        'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> ' . __('Previous', 'emptytheme'),
                        'next_text' => __('Next', 'emptytheme') . ' <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'emptytheme') . ' </span>',
                        'class' => 'posts-pagination'
                    );
                    the_posts_pagination($pagination_args);
                    ?>
                </nav>
            </section>

        <?php
        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
    </div>
</div>

<?php
get_sidebar();
get_footer();
