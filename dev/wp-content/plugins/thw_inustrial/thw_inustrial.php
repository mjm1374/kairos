<?php
/*
 Plugin Name: THW Industrial
 Description: Bizspeak Inustrial Plugin for showing all Inustrial
 Author: Themewinter
 Version: 1.1
 Author URI: http://www.themewinter.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Language File Loaded.
add_action( 'plugins_loaded', 'myindustrial_load_textdomain' );
function myindustrial_load_textdomain(){
  load_plugin_textdomain( 'thw_inustrial', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}


require_once('widgets/about_widget.php');
require_once('widgets/ads_banner_widget.php');
require_once('widgets/contact_information_widget.php');
require_once('widgets/latest_post_widget.php');

/*********************************
/*******  Admin  ********
**********************************/
require_once('reg_admin.php');
require_once('vc_shortocdes/reg_addons.php');


/*-------------------------------------------------------
 *				Metabox
 *-------------------------------------------------------*/

// Re-define meta box path and URL
// Metabox Include
if ( !class_exists( 'RWMB_Loader' ) ) {
require_once ( 'meta-box/meta-box.php' );
}
require_once ( 'post-metaboxes.php' );




/* Industrial Post Type
================================================== */

function themewing_inustrial_area() {
	$labels = array(
		'name'                	=> _x( 'Industrials', 'Industrials', 'thw_inustrial' ),
		'singular_name'       	=> _x( 'Industrial', 'Industrial', 'thw_inustrial' ),
		'menu_name'           	=> __( 'Industrials', 'thw_inustrial' ),
		'parent_item_colon'   	=> __( 'Parent Industrial:', 'thw_inustrial' ),
		'all_items'           	=> __( 'All Industrial', 'thw_inustrial' ),
		'view_item'           	=> __( 'View Industrial', 'thw_inustrial' ),
		'add_new_item'        	=> __( 'Add New Industrial', 'thw_inustrial' ),
		'add_new'             	=> __( 'New Industrial', 'thw_inustrial' ),
		'edit_item'           	=> __( 'Edit Industrial', 'thw_inustrial' ),
		'update_item'         	=> __( 'Update Industrial', 'thw_inustrial' ),
		'search_items'        	=> __( 'Search Industrial', 'thw_inustrial' ),
		'not_found'           	=> __( 'No article found', 'thw_inustrial' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'thw_inustrial' )
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

	register_post_type('thw_inustrial',$args);

}

add_action('init','themewing_inustrial_area');


/* update message
================================================== */

function themewing_update_message_inustrial_area( $messages )
{
	global $post, $post_ID;

	$message['thw_inustrial'] = array(
		0 => '',
		1 => sprintf( __('Industrial updated. <a href="%s">View Industrial</a>', 'thw_inustrial' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'thw_inustrial' ),
		3 => __('Custom field deleted.', 'thw_inustrial' ),
		4 => __('Industrial updated.', 'thw_inustrial' ),
		5 => isset($_GET['revision']) ? sprintf( __('Industrial restored to revision from %s', 'thw_inustrial' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Industrial published. <a href="%s">View Industrial</a>', 'thw_inustrial' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Industrial saved.', 'thw_inustrial' ),
		8 => sprintf( __('Industrial submitted. <a target="_blank" href="%s">Preview Industrial</a>', 'thw_inustrial' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Industrial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Industrial</a>', 'thw_inustrial' ), date_i18n( __( 'M j, Y @ G:i','thw_inustrial' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Industrial draft updated. <a target="_blank" href="%s">Preview Industrial</a>', 'thw_inustrial' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themewing_update_message_inustrial_area' );


/* Inustrial Category Post Type
================================================== */

function themewing_inustrial_area_taxonomy()
{
	$labels = array(	'name'              => _x( 'Categories', 'Categories','thw_inustrial'),
						'singular_name'     => _x( 'Category', 'Categories','thw_inustrial' ),
						'search_items'      => __( 'Search Category','thw_inustrial'),
						'all_items'         => __( 'All Category','thw_inustrial'),
						'parent_item'       => __( 'Parent Category','thw_inustrial'),
						'parent_item_colon' => __( 'Parent Category:','thw_inustrial'),
						'edit_item'         => __( 'Edit Category','thw_inustrial'),
						'update_item'       => __( 'Update Category','thw_inustrial'),
						'add_new_item'      => __( 'Add New Category','thw_inustrial'),
						'new_item_name'     => __( 'New Category Name','thw_inustrial'),
						'menu_name'         => __( 'Category','thw_inustrial')
		);

	$args = array(	'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
		);

	register_taxonomy('thw_inustrial_tag',array( 'thw_inustrial' ),$args);

}

add_action('init','themewing_inustrial_area_taxonomy');


/* Inustrial Single Template
================================================== */

function thw_inustrial_template($single_template) {
	global $post;

	if ($post->post_type == 'thw_inustrial') {
		$single_template = dirname( __FILE__ ) . '/thw_inustrial-template.php';
	}

	return $single_template;
}

add_filter( "single_template", "thw_inustrial_template" ) ;

/* Inustrial Shortcode
================================================== */

function themewing_thw_inustrial_area_shortocde($atts, $content) {
	extract(shortcode_atts(array(
		'count' 			=> 8,
		'column' 			=> 3,
		'layout_option' 	=> 'isotope',
		'en_filter' 		=> 'true',
		'class'				=> '',
	), $atts));

	global $post;


	$html = '';

if ( $layout_option == 'isotope' )
{

   	$html .= '<div id="practice-area" class="practice-area '.esc_attr($class).'">';

   		$html .= '<div class="container">';

			if ( esc_attr($en_filter) == 'true') {
				//Isotope filter start
				$terms = get_terms( 'thw_inustrial_tag' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

					$html .= '<div class="row text-center">';
					$html .= '<div class="isotope-nav" data-isotope-nav="isotope">';

					$html .= '<ul>';
					$html .= '<li><a class="active" href="#" data-filter="*">'.__('All', 'thw_inustrial').'</a></li>';

					foreach ($terms as $term)
					{
						$html .= '<li><a href="#" data-filter=".'.$term->slug.'">'.$term->slug.'</a></li>';
					}

					$html .= '</ul>';

					$html .= '</div>';
					$html .= '</div>'; //Isotope filter end
				} //Isotope filter End
			}

			$args = array(
					'post_type'			=> 'thw_inustrial',
					'posts_per_page' 	=> esc_attr($count),

				);

			$posts = get_posts($args);

			$html .= '<div class="row">';

			    $html .= '<div id="isotope" class="isotope">';

			   foreach ($posts as $post)
			   {
			   		setup_postdata( $post );

			   		$filters = get_the_terms( $post->ID, 'thw_inustrial_tag' );

					$filters_name = '';

					if ($filters)
					{
						foreach ( $filters as $filter )
						{
							$filters_name .= ' '.$filter->slug;
						}
					}

			   		$html .= '<div class="col-sm-'.$column.' '.$filters_name.' isotope-item text-center">';


						$html .= '<div class="isotop-img-conatiner">';
							if( has_post_thumbnail($post->ID) ) {
								$html .= get_the_post_thumbnail($post->ID, 'small-size', array('class' => 'img-responsive'));
							}
							$html .= '<a class="isotop-readmore" href="'.get_permalink( $post->ID ).'"><i class="fa fa-link"></i></a>';
						$html .= '</div>'; // end of isotop-img-conatiner
						$html .= '<div class="isotope-item-title">';
							$html .= '<h3><a href="'.get_permalink( $post->ID ).'">'.get_the_title().'</a></h3>';
						$html .= '</div>';

						$html .= '<div class="isotope-item-bottom">';
							$html .= '<i class="fa fa-folder-open-o">&nbsp;</i>';
							$html .= '<ul class="isotope-item-tags">';
								$html .= '<li>'.$filters_name.'</li>';
							$html .= '</ul>';
							$html .= '<span class="isotope-item-hits">';
								$html .= '<i class="fa fa-heart-o">&nbsp;</i>'.themewing_wpb_get_post_views($post->ID);
							$html .= '</span>';
						$html .= '</div>';

					$html .= '</div>'; // end of isotope-item
			   }

			   wp_reset_postdata();

			   $html .= '</div>'; // isotope

		   $html .= '</div>'; // row

		$html .= '</div>'; // container

	$html .= '</div>'; // practice-area

} elseif ( esc_attr($layout_option) == 'clasic' )	{

	$args = array(
			'post_type'			=> 'thw_inustrial',
			'posts_per_page' 	=> esc_attr($count),

		);

	$posts = get_posts($args);

	$html .= '<div id="practice-area" class="practice-area practice-area-classic '.esc_attr($class).'">';

	$html .= '<div class="row">';

	   foreach ($posts as $post)
	   {
	   		setup_postdata( $post );

	   		$html .= '<div class="col-sm-'.esc_attr($column).'">';

	   		$html .= '<div class="grid">';

	   			if( has_post_thumbnail($post->ID) ) {
					$html .= get_the_post_thumbnail($post->ID, 'small-size', array('class' => 'img-responsive'));
				}

		   		$html .= '<div class="hover-wrapper">';

					$html .= '<div class="hover-content">';
						$html .= '<h3 class="text-center"><a href="'.get_permalink( $post->ID ).'">'.get_the_title().'</a></h3>';
						$html .= '<p>'.themewing_excerpt_max_charlength(150).'</p>';
						$html .= '<a class="btn btn-primary link" href="'.get_permalink( $post->ID ).'">'.__('Learn More','thw_inustrial').'</a>';
					$html .= '</div>'; //hover-content

		   		$html .= '</div>'; //hover-wrapper

		   	$html .= '</div>'; //grid

		   	$html .= '</div>'; //col-sm
	   }

	   wp_reset_postdata();

    $html .= '</div>'; // row
    $html .= '</div>'; // practice area


}else {
	$html  .= 'Select Layout Style';
}


   return $html;

}

add_shortcode('themewing_inustrial','themewing_thw_inustrial_area_shortocde');

/* Added client_carousel Shortcode
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

	array(
	"name" => __("Industrial Area", "thw_inustrial"),
	"base" => "themewing_inustrial",
	"category" => __("Themewing", "thw_inustrial"),
	"params" => array(

        array(
	         "type" => "dropdown",
	         "heading" => __("Layout", "thw_inustrial"),
	         "param_name" => "layout_option",
	         "value" => array('Select'=>'','Isotope Layout'=>'isotope','Classic Layout'=>'clasic'),
	         ),

		array(
			"type" => "textfield",
			"heading" => __("Count Number", "thw_inustrial"),
			"param_name" => "count",
			"value" => "8",
			),

		array(
			"type" => "dropdown",
			"heading" => __("Select Columns", "thw_inustrial"),
			"param_name" => "column",
			"value" => array('Select'=>'','column 4'=>'3','column 3'=>'4', 'column 2'=>'6'),
		),

		array(
			"type" => "dropdown",
			"heading" => __("Display Filter", "thw_inustrial"),
			"param_name" => "en_filter",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),

         array(
            "type" => "textfield",
            "heading" => __("Add Custom Class", "thw_inustrial"),
            "param_name" => "class",
            "value" => "",
         ),

		)

	)

);

}
