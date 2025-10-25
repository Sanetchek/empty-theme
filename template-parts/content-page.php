<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content-wrapper'); ?>>
    <div class="page-wrapper">
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php if (get_the_excerpt()) : ?>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
        </header><!-- .entry-header -->

        <?php if (has_post_thumbnail()) : ?>
            <div class="page-featured-image">
                <div class="featured-image-wrapper">
                    <?php echo function_exists('liteimage') ? liteimage(get_post_thumbnail_id(), [
                        'thumb' => 'large',
                        'args' => ['class' => 'featured-image']
                    ]) : get_image(get_post_thumbnail_id(), 'large', ['class' => 'featured-image']); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emptytheme' ),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <?php if ( get_edit_post_link() ) : ?>
            <footer class="entry-footer">
                <?php
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'emptytheme' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
                ?>
            </footer><!-- .entry-footer -->
        <?php endif; ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
