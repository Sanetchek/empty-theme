<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'emptytheme' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'emptytheme' ) ),
                    number_format_i18n( $comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 50,
                    'callback'   => 'emptytheme_comment_callback',
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'emptytheme' ); ?></p>
            <?php
        endif;

    else :
        ?>
        <div class="no-comments">
            <p><?php esc_html_e( 'No comments yet. Be the first to share your thoughts!', 'emptytheme' ); ?></p>
        </div>
        <?php
    endif; // Check for have_comments().

    // Custom comment form
    $commenter = wp_get_current_commenter();

    // Create fieldset wrapper for contact information
    $fieldset_start = '<fieldset><legend>' . esc_html__( 'Contact Information', 'emptytheme' ) . '</legend>';
    $fieldset_end = '</fieldset>';

    $comment_form_args = array(
        'title_reply'          => __( 'Leave a Reply', 'emptytheme' ),
        /* translators: %s: Name of person being replied to */
        'title_reply_to'       => __( 'Leave a Reply to %s', 'emptytheme' ),
        'cancel_reply_link'    => __( 'Cancel Reply', 'emptytheme' ),
        'label_submit'         => __( 'Post Comment', 'emptytheme' ),
        'comment_field'        => '<div class="comment-form-comment"><label for="comment">' . __( 'Comment', 'emptytheme' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></div>',
        'fields'               => array(
            'author' => $fieldset_start . '<div class="comment-form-author"><label for="author">' . __( 'Name', 'emptytheme' ) . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></div>',
            'email'  => '<div class="comment-form-email"><label for="email">' . __( 'Email', 'emptytheme' ) . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></div>',
            'url'    => '<div class="comment-form-url"><label for="url">' . __( 'Website', 'emptytheme' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>' . $fieldset_end,
        ),
        'class_form'           => 'comment-form',
        'class_submit'         => 'form-submit',
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    );

    comment_form( $comment_form_args );
    ?>
</div><!-- #comments -->
