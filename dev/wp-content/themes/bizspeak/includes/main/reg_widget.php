<?php

function themewing_widgets_init() {

	register_sidebar(array( 
					'name' 			=> __( 'Sidebar', 'bizspeak' ),
				  	'id' 			=> 'sidebar',
				  	'description' 	=> __( 'Widgets in this area will be shown on Sidebar.', 'bizspeak' ),
				  	'before_title' 	=> '<h3  class="widget_title">',
				  	'after_title' 	=> '</h3>',
				  	'before_widget' => '<div id="%1$s" class="widget %2$s" >',
				  	'after_widget' 	=> '</div>'
				)
	);

	register_sidebar(array( 
					'name' 			=> __( 'Footer', 'bizspeak' ),
					'id' 			=> 'footer',
					'description' 	=> __( 'Widgets in this area will be shown before Footer.' , 'bizspeak'),
					'before_title' 	=> '<h3 class="widget_title">',
					'after_title' 	=> '</h3>',
					'before_widget' => '<div class="col-sm-3 footer-widget"><div id="%1$s" class="widget %2$s" >',
					'after_widget' 	=> '</div></div>'
				)
	);
}
add_action( 'widgets_init', 'themewing_widgets_init' );
