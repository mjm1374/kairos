<?php
/*
 Plugin Name: THW Team
 Plugin URI: http://www.themewing.com/
 Description: Themewing thw team Plugin
 Author: Themewing
 Version: 1.0.
 Author URI: http://www.themewing.com
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Language File Loaded.
add_action( 'plugins_loaded', 'mythwteam_load_textdomain' );
function mythwteam_load_textdomain(){
  load_plugin_textdomain( 'thw_team', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
 

/* Team Post Type
================================================== */

function themewing_team_plugin() {
	$labels = array( 
		'name'                	=> _x( 'Teams', 'Teams', 'thw_team' ),
		'singular_name'       	=> _x( 'Team', 'Team', 'thw_team' ),
		'menu_name'           	=> __( 'Teams', 'thw_team' ),
		'parent_item_colon'   	=> __( 'Parent Team:', 'thw_team' ),
		'all_items'           	=> __( 'All Team', 'thw_team' ),
		'view_item'           	=> __( 'View Team', 'thw_team' ),
		'add_new_item'        	=> __( 'Add New Team', 'thw_team' ),
		'add_new'             	=> __( 'New Team', 'thw_team' ),
		'edit_item'           	=> __( 'Edit Team', 'thw_team' ),
		'update_item'         	=> __( 'Update Team', 'thw_team' ),
		'search_items'        	=> __( 'Search Team', 'thw_team' ),
		'not_found'           	=> __( 'No article found', 'thw_team' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'thw_team' )
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
		'supports'           	=> array( 'title','editor','thumbnail')
	);

	register_post_type('thw_team',$args);

}

add_action('init','themewing_team_plugin');


/* update message
================================================== */

function themewing_update_message_team( $messages )
{
	global $post, $post_ID;

	$message['thw_team'] = array(
		0 => '',
		1 => sprintf( __('Team updated. <a href="%s">View Team</a>', 'thw_team' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'thw_team' ),
		3 => __('Custom field deleted.', 'thw_team' ),
		4 => __('Team updated.', 'thw_team' ),
		5 => isset($_GET['revision']) ? sprintf( __('Team restored to revision from %s', 'thw_team' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Team published. <a href="%s">View Team</a>', 'thw_team' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Team saved.', 'thw_team' ),
		8 => sprintf( __('Team submitted. <a target="_blank" href="%s">Preview Team</a>', 'thw_team' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Team scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team</a>', 'thw_team' ), date_i18n( __( 'M j, Y @ G:i','thw_team'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Team draft updated. <a target="_blank" href="%s">Preview Team</a>', 'thw_team' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
	return $message;
}

add_filter( 'post_updated_messages', 'themewing_update_message_team' );


/* Carousel Team
================================================== */

function themewing_team_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'count'			=> '10',
		'column'		=> '5',
		'en_nav' 		=> 'true',
		'auto_play'		=> 'true',
		'pagination'	=> 'false',
		'mouse_drag'	=> 'true',
		'class'			=> '',
	), $atts));

	global $post;
	$args = array(
			'post_type'			=> 'thw_team',
			'posts_per_page' 	=> esc_attr($count),

		);

	$html = '';

	$posts = get_posts($args);
	
   	$html .= '<div class="teams '.esc_attr($class).'">';
   	$html .= '<div class="row">';
   	$html .= '<div class="col-sm-12">';

		if (esc_attr($en_nav) == 'true') {
			$html .= '<div class="owl-controls client-course-control">';
			$html .= '<a class="owl-control clientPrev"><span><i class="fa fa-angle-left"></i></span></a>';
			$html .= '<a class="owl-control clientNext"><span><i class="fa fa-angle-right"></i></span></a>';
			$html .= '</div>';
		}
		
	   $html .= '<div id="team-carousel" class="owl-carousel owl-theme text-center team-carousel">';
	   foreach ($posts as $post)
	   {
	   		setup_postdata( $post );
			$team_desg =  get_post_meta( $post->ID,'tw_team_desg',true );
			$fb_url =  get_post_meta( $post->ID,'tw_team_fb_url',true );
			$tw_url =  get_post_meta( $post->ID,'tw_team_tw_url',true );
			$gplus_url =  get_post_meta( $post->ID,'tw_team_gplus_url',true );
			$linkedin_url =  get_post_meta( $post->ID,'tw_team_linkedin_url',true );
			$pinterest_url =  get_post_meta( $post->ID,'tw_team_pinterest_url',true );
			$instagram_url =  get_post_meta( $post->ID,'tw_team_instagram_url',true );
			$flickr_url =  get_post_meta( $post->ID,'tw_team_flickr_url',true );
			$youtube_url =  get_post_meta( $post->ID,'tw_team_youtube_url',true );

	        $html .= '<div class="item">';
	        $html .= '<div class="team-wrapper">';
			$html .= '<div class="team-img-wrapper">';
		   		if (has_post_thumbnail($post->ID)) {
					$html .= get_the_post_thumbnail($post->ID,'full',array('class'=>'img-responsive'));
				}
			$html .= '</div>';
			$html .= '<div class="team-content">';
			$html .= '<h3 class="ts-name">'.get_the_title($post->ID).'</h3>';
			if ($team_desg) {
				$html .= '<p class="ts-designation">'.esc_attr($team_desg).'</p>';
			}
			if ( $fb_url || $tw_url || $gplus_url || $linkedin_url || $pinterest_url || $instagram_url || $flickr_url || $youtube_url ) 
			{
			$html .= '<div class="team-social">';
			if ($fb_url) {
				$html .= '<a href="'.esc_url($fb_url).'"><i class="fa fa-facebook"></i></a>';
			}			
			if ($tw_url) {
				$html .= '<a href="'.esc_url($tw_url).'"><i class="fa fa-twitter"></i></a>';
			}			
			if ($gplus_url) {
				$html .= '<a href="'.esc_url($gplus_url).'"><i class="fa fa-google-plus"></i></a>';
			}			
			if ($linkedin_url) {
				$html .= '<a href="'.esc_url($linkedin_url).'"><i class="fa fa-linkedin"></i></a>';
			}			
			if ($pinterest_url) {
				$html .= '<a href="'.esc_url($pinterest_url).'"><i class="fa fa-pinterest"></i></a>';
			}			
			if ($instagram_url) {
				$html .= '<a href="'.esc_url($instagram_url).'"><i class="fa fa-instagram"></i></a>';
			}			
			if ($flickr_url) {
				$html .= '<a href="'.esc_url($flickr_url).'"><i class="fa fa-flickr"></i></a>';
			}			
			if ($youtube_url) {
				$html .= '<a href="'.esc_url($youtube_url).'"><i class="fa fa-youtube"></i></a>';
			}
	
			$html .= '</div>';
			}

	        $html .= '</div>'; // team-content
	        $html .= '</div>'; // team-wrapper
	        $html .= '</div>'; // item

	   }
	   wp_reset_postdata();
	   $html .= '</div>'; //Client carousel end
	$html .= '</div>'; // row
	$html .= '</div>'; // row
	$html .= '</div>'; // teams

	
	$html .= '<script type="text/javascript">
		jQuery(document).ready(function($){
				var $teamcarousel = $("#team-carousel")
				$teamcarousel.owlCarousel({
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
				$teamcarousel.trigger("prev.owl.carousel", [400]);
			});

			$(".clientNext").click(function(){
				$teamcarousel.trigger("next.owl.carousel",[400]);
			});
		});
	</script>';

   return $html;

}

add_shortcode('themewing_team','themewing_team_shortcode');

/* Added Team Shortcode
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

	array(
	"name" => __("Team Carousel", "thw_team"),
	"base" => "themewing_team",
	"category" => __("Themewing", "thw_team"),
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Count Number of Post", "thw_team"),
			"param_name" => "count",
			"value" => "",
			),	

		array(
			"type" => "dropdown",
			"heading" => __("Select Columns", "thw_team"),
			"param_name" => "column",
			"value" => array('Select'=>'','1'=>'1','2'=>'2', '3'=>'3','4'=>'4','5'=>'5', '6'=>'6'),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("autoPlay", "thw_team"),
			"param_name" => "auto_play",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("Pagination", "thw_team"),
			"param_name" => "pagination",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("Mouse Drag Move Effect", "thw_team"),
			"param_name" => "mouse_drag",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),			

        array(
            "type" => "dropdown",
            "heading" => __("Navigation Enable", "thw_team"),
            "param_name" => "en_nav",
            "value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
        ),  		
	
         array(
            "type" => "textfield",
            "heading" => __("Add Custom Class", "thw_team"),
            "param_name" => "class",
            "value" => "",
         ),

		)

	)

);

}


