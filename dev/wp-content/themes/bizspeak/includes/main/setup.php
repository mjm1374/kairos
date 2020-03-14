<?php

if ( ! function_exists( 'themewing_setup' ) ) :

function themewing_setup() {

	// Load text domain
	load_theme_textdomain( 'bizspeak', get_template_directory() . '/languages' );

	// Editor-style.css to match the theme style.
	add_editor_style();

	if ( function_exists( 'add_theme_support' ) ) {

		add_theme_support( 'automatic-feed-links' );

		//Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'full-size', 1140, 580, true );
		add_image_size( 'small-size', 600, 450, true );
		add_image_size( 'x-small-size', 250, 160, true );
		add_image_size( 'thumb', 70, 60, true );

		//Post Formats
		add_theme_support( 'post-formats', array('standard', 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery' ) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );

	}

	//Menu Register
	register_nav_menus(
		array(
		'primary'  => __( 'Main Menu', 'bizspeak' ),
		'footer'  => __( 'Footer Menu', 'bizspeak' ),
		'topmenu'  => __( 'Top Menu', 'bizspeak' ),
	) );
}
endif;
// themewing_setup
add_action( 'after_setup_theme', 'themewing_setup' );

// Register mavwalker
require_once (get_template_directory() .'/includes/wp_bootstrap_navwalker.php');