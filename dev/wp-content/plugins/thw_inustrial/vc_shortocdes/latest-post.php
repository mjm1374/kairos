<?php
/* Latest Post
================================================== */

function themewing_latest_post( $atts, $content = null ) {

	extract(
		shortcode_atts(
			array(
			'category_list'  		=> '',
			'column' 		 		=> '2',
			'count_number' 	 		=> '4',
			'en_date'  	 	 		=> 'true',
			'auto_play'  	 		=> 'true',
			'intro_content'  	  	=> 'true',
			'intro_content_char'  	=> '100',
			'pagination'  			=> 'true',
			'class' 		 		=> '',  
			), $atts
		)
	);
 	global $post;
 	$posts= 0;
 	if (isset($category_list) && $category_list!='') {
 		$cat_item_list 	= get_category_by_slug( $category_list );
 		
 		if (isset($cat_item_list) && $cat_item_list!='') {
			$cat_item_list 	= get_category_by_slug( $category_list );
			$cat_id = $cat_item_list->term_id;

			$args = array( 
		    	'category' => $cat_id,
		        'posts_per_page' => esc_attr($count_number),
		    );
		    $posts = get_posts($args);
 		}else{
			$args = array( 
			    'posts_per_page' => esc_attr($count_number),
			);
			$posts = get_posts($args);	
 		}
 	}else{
		$args = array( 
		    'posts_per_page' => esc_attr($count_number),
		);
		$posts = get_posts($args);
	}
	$html     = '';
    if( isset($posts)>0 )
    {
    	$html .= '<div class="bizspeak-latest-post '.esc_attr($class).'">';
	    	$html .= '<div id="news-carousel" class="owl-carousel owl-theme news-slide">';
				foreach ($posts as $post): setup_postdata($post);
					$html .= '<div class="item">';
					$html .= '<div class="thw-latest-post">';
					    if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) 
					    {
					   		$html .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'small-size', array('class' => 'img-responsive')).'</a>';
						}
						if ( esc_attr($en_date) == 'true')
						{	

							$html .= '<div class="post-item-date">';
								$html .= '<span class="post-date-day">'.get_the_time('d').'</span>';
								$html .= '<span class="post-date-month">'.get_the_time('M').'</span>';
							$html .= '</div>';
						}
					    $html .= '<div class="post-body">';
							$html .= '<h4><a href="'.get_permalink().'">'. get_the_title() .'</a></h4>';
							if ( esc_attr($intro_content) == 'true')
							{	if (esc_attr($intro_content_char)) {
									$html .= '<p>'. themewing_excerpt_max_charlength(esc_attr($intro_content_char)) .'</p>';
								} else {
									$html .= '<p>'. themewing_excerpt_max_charlength(100) .'</p>';
								}
							}
						 	if ( get_permalink() ) {
						 		$html .= '<a href="'.get_permalink().'" class="read-more"> '.__('Read More', 'themewing').' <i class="fa fa fa-long-arrow-right"></i></a>';
						 	}
						$html .= '</div>'; // post-body
					$html .= '</div>'; // latest-post	
					$html .= '</div>'; // item
			    endforeach;
			    wp_reset_postdata();   
		    $html .= '</div>'; // news-carousel
	    $html .= '</div>'; // custom class

		$html .= '<script type="text/javascript">
			jQuery(document).ready(function($){
					$("#news-carousel").owlCarousel({
				    loop:true,
				    margin:20,
				    responsiveClass:true,
				    autoplay:'.esc_attr($auto_play).',
				    dots: '.esc_attr($pagination).',
				    animateOut:true,
				    responsive:{
				        0:{
				            items:1,
				        },
				        600:{
				            items:2,
				        },
				        1000:{
				            items:'.esc_attr($column).',
				            loop:false
				        }
				    }
				})	

			});
		</script>';

	}
	return $html;
}

function catlistitem()
{
	$category_item = get_categories('hide_empty=0&depth=1&type=post');
	$cats_item = array();
	$cats_item[] = 'Select a Category';
	foreach($category_item as $cats_items) {
		$cats_item[$cats_items->slug] = $cats_items->name;
	}

	return $cats_item;
}

add_shortcode('latest_post', 'themewing_latest_post');
	
/* Added Latest post
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

	array(
	"name" => __("Latest Post", "themewing"),
	"base" => "latest_post",
	"category" => __('Themewing', "themewing"),
	"params" => array(				

		array(
			"type" => "dropdown",
			"heading" => __("Category List", "themewing"),
			"param_name" => "category_list",
			"value" => catlistitem(),
			),

		array(
			"type" => "textfield",
			"heading" => __("Count Number Ex. 3", "themewing"),
			"param_name" => "count_number",
			"value" => "",
			),						

		array(
			"type" => "dropdown",
			"heading" => __("Select Column", "themewing"),
			"param_name" => "column",
			"value" => array('Select'=>'','1'=>'1','2'=>'2', '3'=>'3','4'=>'4','5'=>'5', '6'=>'6'),
			),

		array(
			"type" => "dropdown",
			"heading" => __("Display Intro Content", "themewing"),
			"param_name" => "intro_content",
			"value" => array(
               __("Select","themewing") => "",
               __("YES","themewing") => "true",
               __("NO","themewing") => "false",
            ),
		),	

		array(
			"type" => "textfield",
			"heading" => __("Intro Character Limit Ex. 100", "themewing"),
			"param_name" => "intro_content_char",
			"value" => "",
			"dependency" => Array("element" => "intro_content","value" => array("true")),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("Display Date", "themewing"),
			"param_name" => "en_date",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),	

		array(
			"type" => "dropdown",
			"heading" => __("autoPlay", "themewing"),
			"param_name" => "auto_play",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),			

		array(
			"type" => "dropdown",
			"heading" => __("Pagination", "themewing"),
			"param_name" => "pagination",
			"value" => array('Select'=>'','YES'=>'true','NO'=>'false'),
		),		

		array(
			"type" => "textfield",
			"heading" => __("Custom Class", "themewing"),
			"param_name" => "class",
			"value" => "",
			),	

		)
	)
);
}
