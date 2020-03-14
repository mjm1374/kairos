<?php
/**
 * Registering Post metaboxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'themewing_register_meta_boxes' );
 
function themewing_register_meta_boxes( $meta_boxes )
{
    $prefix = 'tw_';
    

    // Post Quote 
    $meta_boxes[]   = array(
        'id'        => 'post-metaboxes-quote',
        'title' 	=> __( 'Post Quote', 'bizspeak' ),
        'pages' => array( 'post'),
        'context'   => 'normal',
        'priority'  => 'high',
        'autosave' => true,
 
        'fields' => array(
            array(
                'name'  => __( 'Post Quote Introtext', 'bizspeak' ),
                'desc'  => __( 'Add Your Quote', 'bizspeak' ),
                'id'    => $prefix . 'postquoteintro',
                'type'  => 'textarea',
                'std'   => '',
            ),

            array(
                'name'  => __( 'Post Quote Author Name', 'bizspeak' ),
                'desc'  => __( 'Add Your Author Name', 'bizspeak' ),
                'id'    => $prefix . 'postquoteauthor',
                'type'  => 'text',
                'std'   => '',
            ),
        )
    ); 

       // Post Link 
    $meta_boxes[]   = array(
        'id'        => 'post-metaboxes-link',
        'title' 	=> __( 'Post Link', 'bizspeak' ),
        'pages' => array( 'post'),
        'context'   => 'normal',
        'priority'  => 'high',
        'autosave' => true,
 
        'fields' => array(
            array(
                'name'  => __( 'Link URL', 'bizspeak' ),
                'desc'  => __( 'Add Your Link', 'bizspeak' ),
                'id'    => $prefix . 'postlink',
                'type'  => 'url',
                'std'   => '',
            ),
        )
    ); 


    // Post Audio
	$meta_boxes[] = array(
		'id' => 'post-metaboxes-audio',
		'title' 	=> __( 'Post Audio', 'bizspeak' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,


		'fields' => array(
			array(
				'name'  => __( 'Post Audio Embed Code', 'bizspeak' ),
				'id'    => $prefix . 'postaudio',
				'desc'  => __( 'Add Your Audio Embed Code', 'bizspeak' ),
				'type'  => 'textarea',
				'std'   => ''
			)
			
		)
	);


	// Post Video
	$meta_boxes[] = array(
		'id' => 'post-metaboxes-video',
		'title' 	=> __( 'Post Video', 'bizspeak' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		'fields' => array(

			array(
				'name'     => __( 'Select Vedio Type', 'bizspeak' ),
				'id'       => $prefix . 'video_type',
				'type'     => 'select',
				'options'  => array(
					'1' => __( 'YouTube', 'bizspeak' ),
					'2' => __( 'Vimeo', 'bizspeak' ),
				),
				'multiple'    => false,
				'std'         => '1'
			),

			array(

				'name'  => __( 'Video ID', 'bizspeak' ),
				'id'    => $prefix . 'postvideo',
				'desc'  => __( 'the id is the bold text eg. http://vimeo.com/<strong>27299212</strong>, https://www.youtube.com/watch?v=<strong>HkMNOlYcpHg</strong>', 'bizspeak' ),
				'type'  => 'textarea',
				'std'   => ''
			),
			
		)
	);	

	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',
		'title' => __( 'Post Gallery', 'bizspeak' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		'fields' => array(
			array(
				'name'             => __( 'Upload Gallery Image', 'bizspeak' ),
				'id'    => $prefix . 'postgallery',
				'type'             => 'plupload_image',
				'max_file_uploads' => 6,
			)			
		)
	);	
	

	/* Partner Post Type
	================================================== */

	$meta_boxes[] = array(
		'id' => 'ttw_partner_post_meta',
		'title' => __( 'Partner Info', 'bizspeak' ),
		'pages' => array( 'thw_partner'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'             => __( 'Upload Partner Image', 'bizspeak' ),
				'id'               => "{$prefix}partner_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array(
				'name'  => __( 'Partner Button URL', 'bizspeak' ),
				'id'    => "{$prefix}partner_url",
				'type'  => 'text',
				'std'   => '',
			),									
		)
	);		

	/* Slider Post Type
	================================================== */

	$meta_boxes[] = array(
		'id' => 'thw_slider_post_meta',
		'title' => __( 'Slider Info', 'bizspeak' ),
		'pages' => array( 'thwslider'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => __( 'Slider Custom Title', 'bizspeak' ),
				'id'    => "{$prefix}slider_title",
				'type'  => 'textarea',
				'std'   => '',
			),						

			array(
				'name'  => __( 'Slider Button Text', 'bizspeak' ),
				'id'    => "{$prefix}slider_text",
				'type'  => 'text',
				'std'   => '',
			),			
			array(
				'name'  => __( 'Slider Button URL', 'bizspeak' ),
				'id'    => "{$prefix}slider_url",
				'type'  => 'text',
				'std'   => '',
			),									
		)
	);	

	/* Team Post Type
	================================================== */

	$meta_boxes[] = array(
		'id' => 'tw_team_post_meta',
		'title' => __( 'Team Infomation', 'bizspeak' ),
		'pages' => array( 'thw_team'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => __( 'Team Designation', 'bizspeak' ),
				'id'    => "{$prefix}team_desg",
				'type'  => 'text',
				'std'   => ''
			),

			array(
				'name'  => __( 'Facebook URL', 'bizspeak' ),
				'id'    => "{$prefix}team_fb_url",
				'type'  => 'text',
				'std'   => ''
			),
			
			array(
				'name'  => __( 'Twitter URL', 'bizspeak' ),
				'id'    => "{$prefix}team_tw_url",
				'type'  => 'text',
				'std'   => ''
			),	
					
			array(
				'name'  => __( 'Google Plus URL', 'bizspeak' ),
				'id'    => "{$prefix}team_gplus_url",
				'type'  => 'text',
				'std'   => ''
			),			

			array(
				'name'  => __( 'Linkedin URL', 'bizspeak' ),
				'id'    => "{$prefix}team_linkedin_url",
				'type'  => 'text',
				'std'   => ''
			),				

			array(
				'name'  => __( 'Pinterest URL', 'bizspeak' ),
				'id'    => "{$prefix}team_pinterest_url",
				'type'  => 'text',
				'std'   => ''
			),			

			array(
				'name'  => __( 'Instagram URL', 'bizspeak' ),
				'id'    => "{$prefix}team_instagram_url",
				'type'  => 'text',
				'std'   => ''
			),	

			array(
				'name'  => __( 'Flickr URL', 'bizspeak' ),
				'id'    => "{$prefix}team_flickr_url",
				'type'  => 'text',
				'std'   => ''
			),				

			array(
				'name'  => __( 'YouTube URL', 'bizspeak' ),
				'id'    => "{$prefix}team_youtube_url",
				'type'  => 'text',
				'std'   => ''
			),									

		)
	);	

 
    return $meta_boxes;
}
?>