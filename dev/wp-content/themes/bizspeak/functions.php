<?php
/**
 * themewinter functions and definitions
 * @package bizspeak
 * @author tripples
 * @link http://www.themewinter.com
 */

/********************************
/*******   Define   ********
*********************************/

define( 'THEMEWING_DIR', get_template_directory() );
define( 'THEMEWING_URI', get_template_directory_uri() );
define( 'THEMENAME', 'bizspeak' );

/**************************************
/*******   Set Content Width   ********
***************************************/

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/*
 * Let WordPress manage the document title.
 */
add_theme_support( 'title-tag' );



/*********************************
/*******   Theme Setup  ********
**********************************/
require_once THEMEWING_DIR . '/includes/main/setup.php';

/*********************************
/*******  Register Widget  ********
**********************************/
require_once THEMEWING_DIR . '/includes/main/reg_widget.php';

/*********************************************
/*******  Enqueue scripts and styles  ********
**********************************************/
require_once THEMEWING_DIR . '/includes/main/reg_script.php';


/*************************************
/*******  Themewing Nav  ********
**************************************/
require_once THEMEWING_DIR . '/includes/main/pagination_nav.php';


/*************************************
/*******  register tgm Plugin  ********
**************************************/
require_once THEMEWING_DIR . '/includes/main/reg_tgm.php';

/*************************************
/*******  Breadcrumb  ********
**************************************/
require_once THEMEWING_DIR . '/includes/main/breadcrumb.php';

/*************************************
/*******  Custom Post Lenght  ********
**************************************/
require_once THEMEWING_DIR . '/includes/main/content_text_limit.php';


/*************************************
/*******  Comment  ********
**************************************/
require_once THEMEWING_DIR . '/includes/main/tw_comment.php';




// Industrial Post View Count
function themewing_wpb_get_post_views($postID){
    $count_key = '_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}


function bizspeak_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
        $classes[] = 'sidebar-active';
    }else{
        $classes[] = 'sidebar-inactive';
    }
    return $classes;
}
add_filter( 'body_class','bizspeak_body_classes' );

