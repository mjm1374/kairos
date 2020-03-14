<?php
/*
 Plugin Name: THW Partner
 Plugin URI: http://www.themewing.com/
 Description: Themewing thw partner Plugin
 Author: Themewing
 Version: 1.0.
 Author URI: http://www.themewing.com
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Language File Loaded.
add_action( 'plugins_loaded', 'mypartner_load_textdomain' );
function mypartner_load_textdomain(){
  load_plugin_textdomain( 'thw_partner', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
 

/* Partner Post Type
================================================== */

function themewing_client_plugin() {
	$labels = array( 
		'name'                	=> _x( 'Partners', 'Partners', 'thw_partner' ),
		'singular_name'       	=> _x( 'Partner', 'Partner', 'thw_partner' ),
		'menu_name'           	=> __( 'Partners', 'thw_partner' ),
		'parent_item_colon'   	=> __( 'Parent Partner:', 'thw_partner' ),
		'all_items'           	=> __( 'All Partner', 'thw_partner' ),
		'view_item'           	=> __( 'View Partner', 'thw_partner' ),
		'add_new_item'        	=> __( 'Add New Partner', 'thw_partner' ),
		'add_new'             	=> __( 'New Partner', 'thw_partner' ),
		'edit_item'           	=> __( 'Edit Partner', 'thw_partner' ),
		'update_item'         	=> __( 'Update Partner', 'thw_partner' ),
		'search_items'        	=> __( 'Search Partner', 'thw_partner' ),
		'not_found'           	=> __( 'No article found', 'thw_partner' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'thw_partner' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'supports'           	=> array( 'title')
		);

	register_post_type('thw_partner',$args);

}

add_action('init','themewing_client_plugin');


/* update message
================================================== */

function themewing_update_message_partner( $messages )
{
	global $post, $post_ID;

	$message['thw_partner'] = array(
		0 => '',
		1 => sprintf( __('Partner updated. <a href="%s">View Partner</a>', 'thw_partner' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'thw_partner' ),
		3 => __('Custom field deleted.', 'thw_partner' ),
		4 => __('Partner updated.', 'thw_partner' ),
		5 => isset($_GET['revision']) ? sprintf( __('Partner restored to revision from %s', 'thw_partner' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Partner published. <a href="%s">View Partner</a>', 'thw_partner' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Partner saved.', 'thw_partner' ),
		8 => sprintf( __('Partner submitted. <a target="_blank" href="%s">Preview Partner</a>', 'thw_partner' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Partner scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Partner</a>', 'thw_partner' ), date_i18n( __( 'M j, Y @ G:i','thw_partner'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Partner draft updated. <a target="_blank" href="%s">Preview Partner</a>', 'thw_partner' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themewing_update_message_partner' );


/* Carousel Client
================================================== */

function themewing_partner_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'count'			=> '10',
		'column'		=> '5',
		'en_nav' 		=> 'true',
		'auto_play'		=> 'true',
		'pagination'	=> 'true',
		'class'			=> '',
	), $atts));

	global $post;
	$args = array(
			'post_type'			=> 'thw_partner',
			'posts_per_page' 	=> esc_attr($count),

		);

	$html = '';

	$posts = get_posts($args);
	
   	$html .= '<div class="clients '.esc_attr($class).'">';
   	$html .= '<div class="row">';
   	$html .= '<div class="col-sm-12">';

		if (esc_attr($en_nav) == 'true') {
			$html .= '<div class="owl-controls client-course-control">';
			$html .= '<a class="owl-control clientPrev"><span><i class="fa fa-angle-left"></i></span></a>';
			$html .= '<a class="owl-control clientNext"><span><i class="fa fa-angle-right"></i></span></a>';
			$html .= '</div>';
		}
		
	   $html .= '<div id="client-carousel" class="owl-carousel owl-theme text-center client-carousel">';
	   foreach ($posts as $post)
	   {
	   		setup_postdata( $post );
	   		$img_client = get_post_meta($post->ID,'tw_partner_image', true);
			$client_src   = wp_get_attachment_image_src($img_client, 'small');
			$client_link =  get_post_meta( $post->ID,'tw_partner_url',true );

	        $html .= '<figure class="item client_logo">';
	          if ($client_link) { $html .= '<a href="'.esc_url($client_link).'" target="_blank">'; }
		        if(isset($client_src) && !empty($client_src)) {
					$html .= '<img src="'.esc_url($client_src[0]).'" alt="photo">';
				}
	         if ($client_link) { $html .= '</a>'; }
	        $html .= '</figure>';

	   }
	   wp_reset_postdata();
	   $html .= '</div>'; //Client carousel end
	$html .= '</div>'; // row
	$html .= '</div>'; // row
	$html .= '</div>'; // clients

	
	$html .= '<script type="text/javascript">
		jQuery(document).ready(function($){
				var $clientcarousel = $("#client-carousel")
				$clientcarousel.owlCarousel({
			    loop:true,
			    margin:20,
			    autoplay:'.esc_attr($auto_play).',
			    animateOut:true,
			    dots:'.esc_attr($pagination).',
			    responsiveClass:true,
			    responsive:{
			        0:{
			            items:1,
			        },
			        600:{
			            items:3,
			        },
			        1000:{
			            items:'.esc_attr($column).',
			            loop:false
			        }
			    }
			})	
			$(".clientPrev").click(function(){
				$clientcarousel.trigger("prev.owl.carousel", [400]);
			});

			$(".clientNext").click(function(){
				$clientcarousel.trigger("next.owl.carousel",[400]);
			});
		});
	</script>';

   return $html;

}

add_shortcode('themewing_partner','themewing_partner_shortcode');

/* Added Partner Shortcode
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

	array(
	"name" => __("Themewing Partner", "thw_partner"),
	"base" => "themewing_partner",
	"category" => __("Themewing", "thw_partner"),
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Count Number of Post", "thw_partner"),
			"param_name" => "count",
			"value" => "",
			),	

		array(
			"type" => "dropdown",
			"heading" => __("Select Columns", "thw_partner"),
			"param_name" => "column",
			"value" => array('Select'=>'','1'=>'1','2'=>'2', '3'=>'3','4'=>'4','5'=>'5', '6'=>'6'),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("autoPlay", "thw_partner"),
			"param_name" => "auto_play",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("Pagination", "thw_partner"),
			"param_name" => "pagination",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),			

        array(
            "type" => "dropdown",
            "heading" => __("Navigation Enable", "thw_partner"),
            "param_name" => "en_nav",
            "value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
        ),  		
	
         array(
            "type" => "textfield",
            "heading" => __("Add Custom Class", "thw_partner"),
            "param_name" => "class",
            "value" => "",
         ),

		)

	)

);

}


