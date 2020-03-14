<?php

/* Static Team Shortcode
================================================== */

function static_team_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title'				=>'',
		'design_team'		=>'',
		'image_team'		=>'',
		'fb_url'			=>'',
		'tw_url'			=>'',
		'gplus_url'			=>'',
		'linkedin_url'		=>'',
		'instagram_url'		=>'',
		'pinterest_url'		=>'',
		'flickr_url'		=>'',
		'youtube_url'		=>'',
		'class'				=> '',
	), $atts));

	$html = '';

	$src_img   = wp_get_attachment_image_src($image_team, 'blog-full');
	if( $src_img ) {
		$html .= '<img src="'.esc_url($src_img[0]).'" alt="'.esc_attr($title).'">';
	}
	$html .= '<div class="team-content '.esc_attr($class).'">';
		if ($title) {
			$html .= '<h3 class="ts-name">'.esc_attr($title).'</h3>';
		}
		if ($design_team) {
			$html .= '<p class="ts-designation">'.esc_attr($design_team).'</p>';
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
	$html .= '</div>';	

	return $html;
}

add_shortcode('static_team','static_team_shortcode');

/* Added Static Testimonial Shortcode
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

	array(
	"name" => __("Static Team", "themewing"),
	"base" => "static_team",
	"category" => __("Themewing", "themewing"),
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Name of the Person", "themewing"),
			"param_name" => "title",
			"value" => "",
			"admin_label"=>true,
			),	

		array(
			"type" => "textfield",
			"heading" => __("Designation of the Person", "themewing"),
			"param_name" => "design_team",
			"value" => "",
			),

		array(
			"type" => "attach_image",
			"heading" => __("Image of Person", "themewing"),
			"param_name" => "image_team",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Facebook URL", "themewing"),
			"param_name" => "fb_url",
			"value" => "",
		),		

		array(
			"type" => "textfield",
			"heading" => __("Twitter URL", "themewing"),
			"param_name" => "tw_url",
			"value" => "",
		),

		array(
			"type" => "textfield",
			"heading" => __("Google Plus URL", "themewing"),
			"param_name" => "gplus_url",
			"value" => "",
		),							

		array(
			"type" => "textfield",
			"heading" => __("Linkedin URL", "themewing"),
			"param_name" => "linkedin_url",
			"value" => "",
		),	

		array(
			"type" => "textfield",
			"heading" => __("Pinterest URL", "themewing"),
			"param_name" => "pinterest_url",
			"value" => "",
		),							

		array(
			"type" => "textfield",
			"heading" => __("Instagram URL", "themewing"),
			"param_name" => "instagram_url",
			"value" => "",
		),

		array(
			"type" => "textfield",
			"heading" => __("Flickr URL", "themewing"),
			"param_name" => "flickr_url",
			"value" => "",
		),							

		array(
			"type" => "textfield",
			"heading" => __("Youtube URL", "themewing"),
			"param_name" => "youtube_url",
			"value" => "",
		),							

         array(
            "type" => "textfield",
            "heading" => __("Add Custom Class", "themewing"),
            "param_name" => "class",
            "value" => "",
         ),

		)

	)

);

}


