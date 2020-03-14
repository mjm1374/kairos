<?php

/* Pricing Table
================================================== */

function themewing_pricing_table( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(
			'title' 			=> '',
			'subtitle' 			=> '',
			'currency'			=> '',
			'price'				=> '',
			'price_fraction'	=> '',
			'price_details' 	=> '',
			'btn_url' 			=> '',
			'btn_text' 			=> '',
			'featured' 			=> ''
			), $atts
		)
	);

	$output  = '<ul class="pricing plan '. esc_attr($featured) .'">';
	if ($title) {
		$output .= '<li class="plan-name">';
			$output .= '<h2>';
				$output .= esc_attr($title) . ' <small class="plan_time">'.esc_attr($subtitle).'</small>';
			$output .= '</h2>';
		$output .= '</li>';
	}
	if ($price) {
		$output .= '<li class="plan-price">';
			$output .= '<h2>';
				$output .= '<sub class="currency">'.$currency.'</sub><strong>' . $price . '</strong><sup>' . $price_fraction . '</sup>';
			$output .= '</h2>';
		$output .= '</li>';
	}

	if ($price_details) {
		$output .= '<li class="plan-details">';
		$output .= $price_details;
		$output .= '</li>';
	}

	if ($btn_url) {
		$output .= '<li class="plan-action">';
		$output .= '<a href="' . esc_url($btn_url) . '" class="btn btn-primary btn-pricing">' . esc_attr($btn_text) . '</a>';
		$output .= '</li>';
	}
	
	$output .= '</ul>';//thw-pricing

	return $output;

};

add_shortcode('thw_pricing_table', 'themewing_pricing_table');
/*------------------------------------------------*/

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {

	vc_map(

		array(
		"name" => __("Pricing Table", "themewing"),
		"base" => "thw_pricing_table",
		'icon' => 'icon-thw-pricing-table',
		"class" => "",
		"description" => __("Widget Title Heading", "themewing"),
		"category" => __('Themewing', "themewing"),
		"params" => array(

			array(
				"type" => "checkbox",
				"heading" => __("Featured Pricing Table", "themewing"),
				"param_name" => "featured",
				"value" => Array(__("Featured", "themewing") => "featured")
				),

			array(
				"type" => "textfield",
				"heading" => __("Title", "themewing"),
				"param_name" => "title",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Sub Title", "themewing"),
				"param_name" => "subtitle",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Currency", "themewing"),
				"param_name" => "currency",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Price", "themewing"),
				"param_name" => "price",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Price Fraction", "themewing"),
				"param_name" => "price_fraction",
				"value" => "",
				),

			array(
				"type" => "textarea_html",
				"heading" => __("Pricing Details", "themewing"),
				"param_name" => "price_details",
				"value" => ""
				),

			array(
				"type" => "textfield",
				"heading" => __("Button URL", "themewing"),
				"param_name" => "btn_url",
				"value" => ""
				),

			array(
				"type" => "textfield",
				"heading" => __("Button Text", "themewing"),
				"param_name" => "btn_text",
				"value" => ""
				),

			)
		)
	);
}