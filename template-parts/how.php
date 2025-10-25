<?php
/**
 * Template part for displaying the how section
 *
 * @package emptytheme
 */

 $group = get_field('how_it_works_content');
 if ($group) :
?>
    <section id="how" class="how">
        <div class="container">
            <div class="how__inner">
                <?php if ($group['title']) : ?>
                    <h2 class="how__title"><?php echo $group['title']; ?></h2>
                <?php endif; ?>

                <?php if ($group['content']) : ?>
                    <div class="how__description"><?php echo $group['content']; ?></div>
                <?php endif; ?>

                <?php
                $list = $group['list'];

                $args = [
                    'post_type' => 'how_it_works',
                    'posts_per_page' => -1,
                    'fields' => 'ids'
                ];
                $query = get_posts($args);
                ?>
                <?php if (!empty($query)) : ?>
                    <ul class="how__list">
                        <?php $list = $list ? $list : $query; ?>
                        <?php foreach ($list as $item_id) : ?>
                            <li class="how__item">
                            <?php
                            if ($image_id = get_post_thumbnail_id($item_id)): ?>
                                <div class="how__image_container">
                                    <?= function_exists('liteimage') ? liteimage($image_id, [
                                        'thumb' => [84, 84],
                                        'args' => ['alt' => get_the_title($item_id), 'class' => 'how__image'],
                                    ]) : get_image($image_id, [84, 84], ['alt' => get_the_title($item_id), 'class' => 'how__image']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($title = get_the_title($item_id)): ?>
                                <h3 class="how__item_title"><?= esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php
                                $raw_content = get_post_field('post_content', $item_id);
                                $content = apply_filters('the_content', $raw_content);

                                if (!empty(trim($content))): ?>
                                <div class="how__item_description"><?= $content; ?></div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if ($group['button']) : ?>
                    <?php show_button($group['button']['title'], $group['button']['url'], 'yellow', 'how__button'); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>