<?php

/* Static Testimonial Shortcode
================================================== */

function static_testimonial_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title'				=>'',
		'name_testi'		=>'',
		'design_testi'		=>'',
		'quote_testi'		=>'',
		'image_testi'		=>'',
		'width'				=> '80',
		'height'			=> '80',
		'radius'			=> '100',
		'class'				=> '',
	), $atts));

	$html = '';

   if ( isset($width) || isset($height) || isset($radius) )
   {
      $testi_style = 'width:'. (int) esc_attr($width) . 'px;height:'. (int) esc_attr($height) . 'px;border-radius:'. (int) esc_attr($radius) . 'px;';
   }

	$src_img   = wp_get_attachment_image_src($image_testi, 'blog-full');

	if ($title) {
		$html .= '<h3 class="title">'. esc_attr($title) .'</h3>';
	}

	$html .= '<div class="testimonial-content '.esc_attr($class).'">';

		if( $quote_testi ){
			$html .= '<div class="testimonial-text-item">';
			    $html .= '<p class="testimonial-text">'.esc_attr($quote_testi).'</p>';
			$html .= '</div>';
		}

		$html .= '<div class="testimonial-info">';
			if( $src_img ) {
				$html .= '<img class="testimonial-thumb" style="'.$testi_style.'" src="'.esc_url($src_img[0]).'" alt="'.esc_attr($name_testi).'">';
			}
			if( $name_testi || $design_testi ){
				$html .= '<span class="testimonial-author">'.esc_attr($name_testi).'</span>';
				$html .= '<span class="testimonial-author-desg">'.esc_attr($design_testi).'</span>';
			}
		$html .= '</div>';

	$html .= '</div>';	

	return $html;
}

add_shortcode('static_testimonial','static_testimonial_shortcode');

/* Added Static Testimonial Shortcode
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

	array(
	"name" => __("Static Testimonial", "themewing"),
	"base" => "static_testimonial",
	"category" => __("Themewing", "themewing"),
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Title", "themewing"),
			"param_name" => "title",
			"value" => "",
			"admin_label"=>true,
			),	

		array(
			"type" => "textfield",
			"heading" => __("Name of the Testimony", "themewing"),
			"param_name" => "name_testi",
			"value" => "",
			),		

		array(
			"type" => "textfield",
			"heading" => __("Designation of the Testimony", "themewing"),
			"param_name" => "design_testi",
			"value" => "",
			),		

		array(
			"type" => "textarea",
			"heading" => __("Quote of the Testimony", "themewing"),
			"param_name" => "quote_testi",
			"value" => "",
			),

		array(
			"type" => "attach_image",
			"heading" => __("Image of Testimony", "themewing"),
			"param_name" => "image_testi",
			"value" => "",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Image Width Size", "themewing"),
			"param_name" => "width",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Image height Size", "themewing"),
			"param_name" => "height",
			"value" => "",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Image Radius", "themewing"),
			"param_name" => "radius",
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


