<?php
/**
 * Template part for displaying post content
 *
 * @package emptytheme
 */

?>

<div class="post-content">
    <?php
    the_content(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'emptytheme' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post( get_the_title() )
        )
    );

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emptytheme' ),
            'after'  => '</div>',
        )
    );
    ?>
</div>

<?php
// Display post tags
$tags = get_the_tags();
if ($tags) :
?>
    <div class="post-tags">
        <h4><?php _e('Tags:', 'emptytheme'); ?></h4>
        <div class="tags-list">
            <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-link">
                    <?php echo esc_html($tag->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php
// Display author bio if available
if (get_the_author_meta('description')) :
?>
    <div class="author-bio">
        <div class="author-bio__avatar">
            <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
        </div>
        <div class="author-bio__content">
            <h4 class="author-bio__name">
                <?php _e('About', 'emptytheme'); ?> <?php the_author(); ?>
            </h4>
            <div class="author-bio__description">
                <?php the_author_meta('description'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
