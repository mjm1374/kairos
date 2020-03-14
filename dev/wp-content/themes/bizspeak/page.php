<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package themewing
 */

get_header(); ?>

<div class="main-content page-main-content">

	<?php get_template_part( 'header-banner-title' ); ?>

	<div class="container">

	<div class="row">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
