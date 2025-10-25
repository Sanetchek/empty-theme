<?php
/**
 * Comments Functions
 *
 * @package emptytheme
 */

/**
 * Custom comment callback function
 */
function emptytheme_comment_callback( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>
        <div class="comment-body">
            <div class="comment-meta">
                <div class="comment-author">
                    <?php
                    if ( 0 != $args['avatar_size'] ) {
                        echo get_avatar( $comment, $args['avatar_size'] );
                    }
                    ?>
                    <div class="comment-author-info">
                        <cite class="fn"><?php comment_author_link( $comment ); ?></cite>
                        <span class="says"><?php _e( 'says:', 'emptytheme' ); ?></span>
                    </div>
                </div>
                <div class="comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php
                            printf(
                                /* translators: 1: Comment date, 2: Comment time */
                                esc_html__( '%1$s at %2$s', 'emptytheme' ),
                                get_comment_date( '', $comment ),
                                get_comment_time()
                            );
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link( __( 'Edit', 'emptytheme' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
            </div>

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'emptytheme' ); ?></p>
            <?php endif; ?>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>

            <?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => 'comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<div class="reply">',
                        'after'     => '</div>',
                    )
                )
            );
            ?>
        </div>
    <?php
}
