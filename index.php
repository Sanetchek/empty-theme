<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

get_header();
?>

<div class="container">
    <?php if ( have_posts() ) : ?>

        <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
                <div class="archive-description">
                    <?php _e('Latest posts from our blog', 'emptytheme'); ?>
                </div>
            </header>
        <?php endif; ?>

        <section class="blog-content" aria-label="<?php esc_attr_e('Blog Posts', 'emptytheme'); ?>">
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

    <?php else :

        get_template_part( 'template-parts/content', 'none' );

    endif; ?>
</div>

<?php
get_sidebar();
get_footer();
