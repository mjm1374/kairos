<?php
/*
 Plugin Name: THW Slider
 Plugin URI: http://www.themewing.com/
 Description: Themewing thw Slider Plugin
 Author: Themewing
 Version: 1.0
 Author URI: http://www.themewing.com
 */


 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Language File Loaded.
add_action( 'plugins_loaded', 'mythwslider_load_textdomain' );
function mythwslider_load_textdomain(){
  load_plugin_textdomain( 'thw_slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
 

/* Register Slider Post Type
================================================== */

function themewing_slider_plugin()
{
	$labels = array( 
		'name'                	=> _x( 'Sliders', 'Sliders', 'thw_slider' ),
		'singular_name'       	=> _x( 'Slider', 'Slider', 'thw_slider' ),
		'menu_name'           	=> __( 'Sliders', 'thw_slider' ),
		'parent_item_colon'   	=> __( 'Parent Slider:', 'thw_slider' ),
		'all_items'           	=> __( 'All Sliders', 'thw_slider' ),
		'view_item'           	=> __( 'View Slider', 'thw_slider' ),
		'add_new_item'        	=> __( 'Add New Slider', 'thw_slider' ),
		'add_new'             	=> __( 'New Slider', 'thw_slider' ),
		'edit_item'           	=> __( 'Edit Slider', 'thw_slider' ),
		'update_item'         	=> __( 'Update Slider', 'thw_slider' ),
		'search_items'        	=> __( 'Search Slider', 'thw_slider' ),
		'not_found'           	=> __( 'No article found', 'thw_slider' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'thw_slider' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_ui'            	=> true,
		'show_in_menu'       	=> true,
		'query_var'          	=> true,
		'rewrite' 				=> true,
		'capability_type'    	=> 'post',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> true,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'supports'           	=> array( 'title', 'editor', 'thumbnail')
		);

	register_post_type('thwslider',$args);

}

add_action('init','themewing_slider_plugin');


/* update message
================================================== */

function themewing_update_message_slider( $messages )
{
	global $post, $post_ID;

	$message['thwslider'] = array(
		0 => '',
		1 => sprintf( __('Slider updated. <a href="%s">View Slider</a>', 'thw_slider' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'thw_slider' ),
		3 => __('Custom field deleted.', 'thw_slider' ),
		4 => __('Slider updated.', 'thw_slider' ),
		5 => isset($_GET['revision']) ? sprintf( __('Slider restored to revision from %s', 'thw_slider' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Slider published. <a href="%s">View Slider</a>', 'thw_slider' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Slider saved.', 'thw_slider' ),
		8 => sprintf( __('Slider submitted. <a target="_blank" href="%s">Preview Slider</a>', 'thw_slider' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Slider scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slider</a>', 'thw_slider' ), date_i18n( __( 'M j, Y @ G:i','thw_slider'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Slider draft updated. <a target="_blank" href="%s">Preview Slider</a>', 'thw_slider' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themewing_update_message_slider' );


/* Carousel Slider
================================================== */

function themewing_slider_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'count'			=> '10',
		'class'			=> '',
	), $atts));

	global $post;
	$args = array(
			'post_type'			=> 'thwslider',
			'orderby' 			=> 'menu_order',
			'order' 			=> 'ASC',
			'posts_per_page' 	=> esc_attr($count),

		);

	$html = '';

	$slides = get_posts($args);
	
	if(count($slides))
	{
		$html .= '<div id="main-slide" class="carousel slide slide3" data-ride="carousel">';
			$html .= '<ol class="carousel-indicators visible-lg visible-md">';
			  	$html .= '<li data-target="#main-slide" data-slide-to="0" class="active"></li>';
			    $html .= '<li data-target="#main-slide" data-slide-to="1"></li>';
			    $html .= '<li data-target="#main-slide" data-slide-to="2"></li>';
			$html .= '</ol>';
		$html .= '<div class="carousel-inner">';
		
		foreach ($slides as $active => $post)
		{
			setup_postdata($post);
			$slider_title =  get_post_meta( $post->ID,'tw_slider_title',true );
			$slider_btn =  get_post_meta( $post->ID,'tw_slider_text',true );
			$slider_link =  get_post_meta( $post->ID,'tw_slider_url',true );

			$html .= '<div class="item '.(($active == 0)?"active":"").'">';

			if (has_post_thumbnail($post->ID)) {
				$html .= get_the_post_thumbnail($post->ID,'full',array('class'=>'img-responsive'));
			}

	        $html .= '<div class="slider-content slider2-content">';
            	$html .= '<div class="col-md-12">';
            		$html .= '<div class="slider-text">';
                    	$html .= '<h2 class="slider-title title-normal">'.$slider_title.'</h2>';
                    	$html .= '<p class="desc">'.get_the_content().'</p>';
                    	if ($slider_link) {
                    		$html .= '<a href="'.esc_url($slider_link).'" class="btn btn-primary">'.esc_attr($slider_btn).' <i class="fa fa-long-arrow-right"></i></a>';
                    	}
                	$html .= '</div>';
            	$html .= '</div>';
            $html .= '</div>'; //end of .slider-content
			$html .= '</div>'; // end of .item
		}

		wp_reset_postdata();

		$html .= '</div>'; //end of .carousel-inner

		$html .= '<a class="left carousel-control" href="#main-slide" data-slide="prev">';
	    	$html .= '<span><i class="fa fa-angle-left"></i></span>';
		$html .= '</a>';
		$html .= '<a class="right carousel-control" href="#main-slide" data-slide="next">';
	    	$html .= '<span><i class="fa fa-angle-right"></i></span>';
		$html .= '</a>';

		$html .= '</div>'; // end of #main-slide
	}
	return $html;

}

add_shortcode('themewing_slider','themewing_slider_shortcode');

/* Added Partner Shortcode
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(
		array(
		"name" => __("Themewing Slider", "thw_slider"),
		"base" => "themewing_slider",
		"category" => __("Themewing", "thw_slider"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Count Number of Post", "thw_slider"),
				"param_name" => "count",
				"value" => "",
				),		
		
	         array(
	            "type" => "textfield",
	            "heading" => __("Add Custom Class", "thw_slider"),
	            "param_name" => "class",
	            "value" => "",
	         ),

			)
		)
	);
}



