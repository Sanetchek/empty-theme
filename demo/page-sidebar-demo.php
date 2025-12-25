<?php
/**
 * Template Name: Sidebar Demo
 *
 * Demo page to show different sidebar widgets
 *
 * @package emptytheme
 */

get_header();
?>

<div class="container">
    <article class="page-content-wrapper">
        <div class="page-wrapper">
            <header class="entry-header">
                <div class="container">
                    <h1 class="entry-title"><?php esc_html_e('Sidebar Widgets Demo', 'emptytheme'); ?></h1>
                    <div class="entry-excerpt">
                        <?php esc_html_e('Beautiful sidebar widgets displayed at the bottom of the page', 'emptytheme'); ?>
                    </div>
                </div>
            </header>

            <div class="entry-content">
                <div class="container">
                    <div class="sidebar-demo-content">
                        <h2><?php esc_html_e('Main Page Content', 'emptytheme'); ?></h2>
                        <p><?php esc_html_e('This is a demo page to show sidebar widgets. The sidebar is displayed at the bottom of the page in beautiful cards with various widgets.', 'emptytheme'); ?></p>

                        <h3><?php esc_html_e('Design Features:', 'emptytheme'); ?></h3>
                        <ul>
                            <li><?php esc_html_e('Sidebar is displayed at the bottom of the page', 'emptytheme'); ?></li>
                            <li><?php esc_html_e('Widgets are displayed in cards', 'emptytheme'); ?></li>
                            <li><?php esc_html_e('Adaptive grid for different screen sizes', 'emptytheme'); ?></li>
                            <li><?php esc_html_e('Beautiful hover effects', 'emptytheme'); ?></li>
                            <li><?php esc_html_e('Uniform style for all widgets', 'emptytheme'); ?></li>
                        </ul>

                        <p><?php esc_html_e('Scroll down to see the sidebar widgets.', 'emptytheme'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<style>
.sidebar-demo-content {
    padding: 2rem 0;
    min-height: 60vh;
}

.sidebar-demo-content h2 {
    font-size: 2rem;
    color: var(--color-dark);
    margin-bottom: 1.5rem;
    font-family: var(--font-urbanist);
}

.sidebar-demo-content h3 {
    font-size: 1.5rem;
    color: var(--color-dark);
    margin: 2rem 0 1rem 0;
    font-family: var(--font-urbanist);
}

.sidebar-demo-content p {
    font-size: 1.125rem;
    line-height: 1.7;
    color: var(--color-text);
    margin-bottom: 1.5rem;
}

.sidebar-demo-content ul {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.sidebar-demo-content li {
    font-size: 1.125rem;
    line-height: 1.6;
    color: var(--color-text);
    margin-bottom: 0.5rem;
}
</style>

<?php
get_sidebar();
get_footer();
