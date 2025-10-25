<?php
/**
 * Template part for displaying post cards in archives
 *
 * @package emptytheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <div class="post-card__wrapper">
        <div class="post-card__image">
            <a href="<?php the_permalink(); ?>" class="post-card__link">
                <?php if (has_post_thumbnail() && function_exists('liteimage')) : ?>
                    <?php echo liteimage(get_post_thumbnail_id(), [
                        'thumb' => 'medium',
                        'args' => ['class' => 'post-card__thumb']
                    ]); ?>
                <?php else : ?>
                    <div class="post-card__placeholder">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z" fill="currentColor"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </a>
        </div>

        <div class="post-card__content">
            <div class="post-card__meta">
                <time class="post-card__date" datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('d.m.Y'); ?>
                </time>
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                ?>
                    <span class="post-card__category">
                        <?php echo esc_html($categories[0]->name); ?>
                    </span>
                <?php endif; ?>
            </div>

            <h3 class="post-card__title">
                <a href="<?php the_permalink(); ?>" class="post-card__link">
                    <?php the_title(); ?>
                </a>
            </h3>

            <div class="post-card__excerpt">
                <?php the_excerpt(); ?>
            </div>

            <div class="post-card__footer">
                <a href="<?php the_permalink(); ?>" class="post-card__read-more">
                    <?php _e('Read more', 'emptytheme'); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</article>
