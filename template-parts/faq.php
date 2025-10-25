<?php
/**
 * FAQ Template
 *
 * @package emptytheme
 */

$group = get_field('faqs_content');

if ($group):
?>
    <section id="faq" class="faq">
        <div class="container">
            <div class="faq__inner">
                <?php if ($group['title']): ?>
                    <h2 class="faq__title"><?php echo $group['title']; ?></h2>
                <?php endif; ?>

                <?php
                    $list = $group['list'];

                    $args = [
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                        'fields' => 'ids'
                    ];
                    $query = get_posts($args);

                    if (!empty($query)): ?>
                    <?php $list = $list ? $list : $query; ?>
                    <?php if ($list): ?>
                        <?php $items = create_accordion_items($list); ?>
                        <?php if ($items) : ?>
                            <div class="faq__content">
                                <?php echo show_accordion($items); ?>
                            </div>
                        <?php endif ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>