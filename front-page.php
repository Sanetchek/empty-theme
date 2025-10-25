<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package emptytheme
 */

get_header(); ?>

<section id="front-page-content" class="front-page-content">

    <?php get_template_part('template-parts/hero'); ?>

    <?php get_template_part('template-parts/how'); ?>

    <?php get_template_part('template-parts/testimonials'); ?>

    <?php get_template_part('template-parts/faq'); ?>

</section>

<?php get_footer(); ?>
