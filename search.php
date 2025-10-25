<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package emptytheme
 */

get_header();
?>

<div class="container">
    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: Search query */
                printf( esc_html__( 'Search Results for: %s', 'emptytheme' ), '<span class="search-query">' . get_search_query() . '</span>' );
                ?>
            </h1>
            <div class="archive-description">
                <?php
                /* translators: %d: Number of search results */
                printf( esc_html__( 'Found %d results', 'emptytheme' ), $wp_query->found_posts );
                ?>
            </div>
        </header><!-- .page-header -->

        <section class="search-content" aria-label="<?php esc_attr_e('Search Results', 'emptytheme'); ?>">
            <div class="row row__30">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
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
