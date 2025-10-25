<?php
/**
 * Template part for displaying testimonials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

$group = get_field('testimonials_content');

if ($group) :
?>
<section id="testimonials" class="testimonials">
    <div class="container">
        <div class="testimonials__inner">
            <?php if ($group['title']) : ?>
                <h2 class="testimonials__title"><?php echo $group['title']; ?></h2>
            <?php endif; ?>

            <?php if ($group['content']) : ?>
                <div class="testimonials__description"><?php echo $group['content']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    $list = $group['list'];

    $args = [
        'post_type' => 'testimonials',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ];
    $query = get_posts($args);

    if (!empty($query)): ?>
        <div class="testimonials__slider_container">
            <div class="testimonials__list testimonials__slider">
                <?php $list = $list ? $list : $query; ?>
                <?php foreach ($list as $item_id): ?>
                    <div class="testimonials__item">
                        <div class="testimonials__item_content">
                            <?php if ($image_id = get_post_thumbnail_id($item_id)): ?>
                                <div class="testimonials__image_container">
                                    <?= function_exists('liteimage') ? liteimage($image_id, [
                                        'thumb' => [40, 40],
                                        'args' => ['alt' => get_the_title($item_id), 'class' => 'testimonials__image'],
                                    ]) : get_image($image_id, [40, 40], ['alt' => get_the_title($item_id), 'class' => 'testimonials__image']); ?>
                                </div>
                            <?php endif; ?>

                            <div class="testimonials__item_user">
                                <?php if ($title = get_the_title($item_id)): ?>
                                    <h3 class="testimonials__item_title"><?= esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php
                                $star_rating = get_post_meta($item_id, '_emptytheme_star_rating', true);
                                if ($star_rating): ?>
                                    <div class="testimonials__rating" role="img" aria-label="<?php echo esc_attr($star_rating . ' out of 5 stars'); ?>">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $star_rating): ?>
                                                <svg class="testimonials__star testimonials__star_filled" width="13" height="13" viewBox="0 0 13 13" aria-hidden="true">
                                                    <use href="<?php echo sprite('star-filled') ?>"></use>
                                                </svg>
                                            <?php else: ?>
                                                <svg class="testimonials__star testimonials__star_empty" width="13" height="13" viewBox="0 0 13 13" aria-hidden="true">
                                                    <use href="<?php echo sprite('star') ?>"></use>
                                                </svg>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php
                        $raw_content = get_post_field('post_content', $item_id);
                        $content = apply_filters('the_content', $raw_content);

                        if (!empty(trim($content))): ?>
                            <div class="testimonials__item_description"><?= $content; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="testimonials__navigation">
                <button class="testimonials__nav-btn testimonials__nav-btn--prev"
                        type="button"
                        aria-label="<?php esc_attr_e('Previous testimonial', 'emptytheme'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <use href="<?php echo sprite('arrow-left') ?>"></use>
                    </svg>
                </button>
                <button class="testimonials__nav-btn testimonials__nav-btn--next"
                        type="button"
                        aria-label="<?php esc_attr_e('Next testimonial', 'emptytheme'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <use href="<?php echo sprite('arrow-right') ?>"></use>
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php endif; ?>