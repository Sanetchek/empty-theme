<?php
/**
 * Template part for displaying the hero section
 *
 * @package emptytheme
 */
?>

<section id="hero" class="hero">
    <div class="container">
        <div class="hero__inner">
            <?php $image_id = get_field('feature_background_image'); ?>
            <?php if ($image_id) : ?>
                <div class="hero__image_container">
                    <?php
                    $image_mobile_id = get_field('feature_background_image_mobile');
                    echo function_exists('liteimage') ? liteimage($image_id, [
                        'thumb' => [1200, 600],
                        'max' => [
                            '1240' => [962, 0],
                            '992' => [738, 0],
                            '768' => [738, 0],
                            '576' => [546, 0],
                        ],
                        'args' => ['alt' => get_bloginfo('name'), 'fetchpriority' => 'high', 'loading' => 'eager', 'class' => 'hero__image']
                    ], $image_mobile_id) : get_image($image_id, [1200, 600], ['alt' => get_bloginfo('name'), 'fetchpriority' => 'high', 'loading' => 'eager', 'class' => 'hero__image']);
                    ?>
                </div>
            <?php endif; ?>

            <?php $group = get_field('feature_content'); ?>
            <?php if ($group) : ?>
                <div class="hero__content">
                    <?php if ($group['title']) : ?>
                        <h1 class="hero__title"><?php echo $group['title']; ?></h1>
                    <?php endif; ?>

                    <?php if ($group['content']) : ?>
                        <div class="hero__description"><?php echo $group['content']; ?></div>
                    <?php endif; ?>

                    <?php if ($group['button']) : ?>
                        <?php show_button($group['button']['title'], $group['button']['url'], 'yellow', 'hero__button'); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
