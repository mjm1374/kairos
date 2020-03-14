<?php
//google font
if(!function_exists('bizspeak_google_fonts_url')){
	function bizspeak_google_fonts_url() {
	$fonts_url = '';
	$roboto = _x( 'on', 'Roboto font: on or off', 'bizspeak' );
	$robotSlab = _x( 'on', 'Roboto Slab font: on or off', 'bizspeak' );

	if ( 'off' !== $roboto || 'off' !== $robotSlab ) {
		 $font_families = array();

		 if ( 'off' !== $roboto ) {
		 $font_families[] = 'Roboto:300,400,500,600,700';
		 }

		 if ( 'off' !== $robotSlab ) {
		 $font_families[] = 'Roboto Slab:300,400,500,600,700';
		 }

		 $query_args = array(
		 'family' => urlencode( implode( '|', $font_families ) ),
		 'subset' => urlencode( 'latin,latin-ext' ),
		 );
		 $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
	}
}
function themewing_scripts() {
	// google fonts
	wp_enqueue_style( 'google-fonts', bizspeak_google_fonts_url(), array(), null );


	// Register Styles
	wp_register_style( 'bootstrap', THEMEWING_URI . '/css/bootstrap.min.css' );
	wp_register_style( '-bootstrap-wp', THEMEWING_URI . '/css/bootstrap-wp.css' );	// load Font Awesome css
	wp_register_style( 'font-awesome', THEMEWING_URI . '/css/font-awesome.min.css');
	wp_register_style( 'owl.theme-min', THEMEWING_URI . '/css/owl.theme-min.css');
	wp_register_style( 'magnific-popup', THEMEWING_URI . '/css/magnific-popup.css');
	wp_register_style( 'owl.carousel', THEMEWING_URI . '/css/owl.carousel.css');
	wp_register_style( 'lightbox', THEMEWING_URI . '/css/lightbox.css');
	wp_register_style( 'icomoon', THEMEWING_URI . '/css/icomoon.css');
	wp_register_style( 'responsive', THEMEWING_URI . '/css/responsive.css');
	wp_register_style( 'bizspeak-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bizspeak-gutenberg-custom', get_template_directory_uri(). '/css/gutenberg-custom.css', null );



	// Enqueue Styles
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('bootstrap-wp');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('owl.theme-min');
	wp_enqueue_style('magnific-popup');
	wp_enqueue_style('owl.carousel');
	wp_enqueue_style('lightbox');
	wp_enqueue_style('icomoon');
	wp_enqueue_style('bizspeak-style');
	wp_enqueue_style('responsive');

   wp_add_inline_style( 'bizspeak-style', bizspeak_css_generator() );
   


	// Register Scripts
	wp_register_script('bootstrapjs', THEMEWING_URI .'/js/bootstrap.min.js', array('jquery'),false,true );
	wp_register_script('custom', THEMEWING_URI .'/js/custom.js', array('jquery'),false,true);
	wp_register_script( 'bootstrapwp', THEMEWING_URI . '/js/bootstrap-wp.js', array('jquery'),false,true );
	wp_register_script( 'jquery.counterup.min', THEMEWING_URI . '/js/jquery.counterup.min.js', array('jquery'),false,true );
	wp_register_script( 'jquery.magnific-popup.min', THEMEWING_URI . '/js/jquery.magnific-popup.min.js', array('jquery'),false,true );
	wp_register_script( 'waypoints', THEMEWING_URI . '/js/waypoints.min.js', array(),false,true );
	wp_register_script( 'owl-carousel', THEMEWING_URI . '/js/owl.carousel.min.js', array('jquery'),false,true );
	wp_register_script( 'ini.isotope', THEMEWING_URI . '/js/ini.isotope.js', array('jquery'),false,true );
	wp_register_script( 'isotope', THEMEWING_URI . '/js/isotope.js', array('jquery'),false,true );
	wp_register_script( 'lightbox', THEMEWING_URI . '/js/lightbox.min.js', array('jquery'),false,true );
	wp_register_script( 'skip-link-focus-fix', THEMEWING_URI . '/js/skip-link-focus-fix.js', array(), '20130115', false,true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_register_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202',false,true );
	}


	// Enqueue Scripts
	wp_enqueue_script('bootstrapjs');
	wp_enqueue_script('bootstrapwp');
	wp_enqueue_script('jquery.counterup.min');
	wp_enqueue_script('jquery.magnific-popup.min');
	wp_enqueue_script('waypoints');
	wp_enqueue_script('ini.isotope');
	wp_enqueue_script('isotope');
	wp_enqueue_script('owl-carousel');
	wp_enqueue_script('lightbox');
	wp_enqueue_script('skip-link-focus-fix');
	wp_enqueue_script('keyboard-image-navigation');
	wp_enqueue_script('custom');

}
add_action( 'wp_enqueue_scripts', 'themewing_scripts' );


// gutenberg style 
add_action('enqueue_block_editor_assets', 'bizspeak_action_enqueue_block_editor_assets' );
function bizspeak_action_enqueue_block_editor_assets() {
	wp_enqueue_style( 'google-fonts', bizspeak_google_fonts_url(), array(), null );
    wp_enqueue_style( 'bizspeak-gutenberg-editor-font-awesome-styles', get_template_directory_uri() . '/css/font-awesome.min.css', null );
    wp_enqueue_style( 'bizspeak-gutenberg-editor-customizer-styles', get_template_directory_uri() . '/css/gutenberg-editor-custom.css', null );
    wp_enqueue_style( 'bizspeak-gutenberg-editor-styles', get_template_directory_uri(). '/css/gutenberg-custom.css', null );
	 wp_register_style( 'bizspeak-style', get_stylesheet_uri() );

}





if(!function_exists('bizspeak_css_generator')){
    function bizspeak_css_generator(){

global $themewing_options;

$output = '';

if (esc_attr($themewing_options['sticky-header'])){
    $output .= '.menubar.sticky-header{padding:0;  transition: padding 400ms linear;-webkit-transition: padding 400ms linear;-moz-transition: padding 400ms linear; position:fixed;
    z-index:999;margin:0 auto 30px; width:100%;top:0;opacity: .97;
    -webkit-animation: fadeInDown 500ms;-moz-animation: fadeInDown 500ms;webkit-box-shadow: 0px 1px 6px 0px rgba(68,68,68,0.1);
    box-shadow: 0px 1px 6px 0px rgba(68,68,68,0.1);
    -ms-animation: fadeInDown 500ms;
    -o-animation: fadeInDown 500ms;
    animation: fadeInDown 500ms;}';
    $output .= '.admin-bar .menubar.sticky-header{top:30px;}';
}

$linkcolor = esc_attr($themewing_options['link_color']);
if(isset($linkcolor)){
		    $output .= 'a,.page-header h2.page-title i,
		    .social-buttons ul li a:hover,a.icon-search-btn:hover,
		    .widget ul.nav>li>a:hover,
		    .page-header h2.page-title a:hover,
		    .meta-category a:hover,
		    .page-header span.author,
		    .entry-meta li a:hover,
		    .blog-share-button ul li a:hover,
		    .search-header .span-search,
		    #recentcomments .recentcomments a:hover,.related-title h2,.site-info a,.title-bullet-feature:before,
		    .services-list-content h4 a:hover,.thw-service-btn,.services-list-content h2,
		    .thw-specialist-outer2:hover .thw-specialist-content .name a,
		    .thw-companion-outer .thw-companion-content h3 a:hover,
		    .thw-companion-outer:hover .thw-companion-content a.btn-companion,
		    .thw-companion-outer-layout2:hover .thw-companion-content a,
		    .themewing-intro .themewing-title h2,.pet-gallery-intro .themewing-title h2,
		    .specility-content .themewing-title h2,.tp-caption a.slide-btn-style,
		    .top-social .top-social-link a:hover,.tp-caption a.slide-btn-transparent,
		    .footer-area span.to-top a,.form-submit .btn.btn-primary,
		    .latest-post-content h4 a:hover,.services-list-content:hover h4 a,.post-title a:hover,
		    .isotope-nav ul a.active,
		.isotope-nav ul a:hover,.isotop-readmore:hover,.isotope-item-title h3 a:hover,.testimonial-text:before,
		.thw-latest-post .post-body h4 a:hover,.footer-menu ul li a:hover,.latest-post .latest-post-title a:hover,
		h4.panel-title a,.list-arrow li:hover, .list-arrow li a:hover,.list-arrow.style2 li:before,
		.owl-theme .owl-controls .owl-nav [class*=owl-]:hover,.top-menu li a:hover,ul.navbar-nav > li:hover > a,
		ul.navbar-nav > li.active > a,.dropdown-menu > li.active > a,.dropdown-menu > li>a:hover,
		.dropdown-menu > li>a:focus,.current-menu-parent  a.dropdown-toggle,
		.vc_toggle.vc_toggle_active>.vc_toggle_title h4,
		        .vc_general.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a,.top-menu li a:hover,
		        .off-canvas-list li a:hover,.woocommerce ul.products li.product .price,.woocommerce ul.products li.product .woocommerce-loop-product__title:hover{ color:'. $linkcolor .'; }';

		    $output .= '.entry-image .quote-link,
		    .themewing-about-widget .about-widget-btn,
		    .themewing-about-social li a:hover,
		    .related-title h3:after,
		    .navbar-header .navbar-toggle:hover .icon-bar,.site-search,ul.main-menu > li:before,
		    ul.main-menu > li:after,.services-list-title:after,
		    .services-list-item .img-overlay .img-overlay-in,.specialist-course-control .owl-control,
		    .emergency-action h2 strong,.emergency-action2 h2 strong,.pet-information li span,
		    .wpb_wrapper .vc_images_carousel .vc_carousel-indicators li,
		    .tp-caption a.slide-btn-transparent:hover,
		    .footer-area span.to-top a:hover,.widget.widget_tag_cloud .tagcloud a:hover,ul.top-info li .info-box span.info-icon,
		    .post-item-date,.plan.featured .plan-price,.plan.featured a.btn,.btn-primary,
		.pager li>a, .pager li>span, .post-navigation ul.pager li>a,
		.post-navigation ul.pager li>span, .wpcf7-form-control.wpcf7-submit,
		.form-submit .btn.btn-primary, .common-btn,.btn-primary,
		.vc_btn3-container.btn-preset .vc_btn3.vc_btn3-color-default.vc_btn3-style-3d,.readmore-blog,
		.title-border:before,ul.navbar-nav > li:hover > a:after,
		ul.navbar-nav > li.active > a:after,.navbar-toggle,.vc_tta.vc_general.feature-tab .vc_tta-tab.vc_active > a,
		.vc_tta.vc_general.feature-tab .vc_tta-tab > a:hover,
		.vc_tta.vc_general.feature-tab .vc_tta-tab > a:focus,.service-box i,.service-bg-row,.widget .widget_title span:before,

		        .woocommerce ul.products li.product .button,.woocommerce ul.products li.product .added_to_cart,
		            .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
		            .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color:'. $linkcolor .'!important; }';

		    $output .= 'input:focus, textarea:focus,
		    keygen:focus, select:focus,
		    .meta-category:hover,
		    .widget.widget_search .form-control:focus,.thw-specialist-outer2:before,
		    .wpb_wrapper .vc_images_carousel .vc_carousel-indicators li,
		    .wpb_wrapper .vc_images_carousel .vc_carousel-indicators .vc_active,.slide-btn-transparent,
		    .services-vc-accordion.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header,
		    .footer-area span.to-top a,.readmore-blog,
		    .wpcf7-form-control.wpcf7-submit,
		    .form-submit .btn.btn-primary,.common-btn,.isotope-nav ul a.active,
		.isotope-nav ul a:hover{ border-color:'. $linkcolor .'; }';

		$output .= '.vc_tta.vc_general.feature-tab .vc_tta-tab > a:hover,
		.vc_tta.vc_general.feature-tab .vc_tta-tab > a:focus{ background:'. $linkcolor .'!important; }';

		    $output .= '.title-border:after,ul.navbar-nav > li:hover > a:before,
		ul.navbar-nav > li.active > a:before,.vc_tta.vc_general.feature-tab .vc_tta-tab.vc_active > a:after,
		.vc_tta-tabs.feature-tab:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active > a::after,
		.vc_tta.vc_general.feature-tab .vc_tta-tab > a:hover:after,
		.vc_tta.vc_general.feature-tab .vc_tta-tab > a:focus:after,.widget .widget_title span:after{  border-color: '. $linkcolor .' rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0); }';

		}

		$hovercolor = esc_attr($themewing_options['hover_color']);
		if(isset($hovercolor)){
		    $output .= 'a:hover{ color:'. $hovercolor .'; }';
		    $output .= '.themewing-about-widget .about-widget-btn:hover,.specialist-course-control .owl-control:hover,

		    .woocommerce ul.products li.product .button:hover,
		            .woocommerce ul.products li.product .added_to_cart:hover,
		            .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{ background-color:'. $hovercolor .'; }';
		}


		$menubg = esc_attr($themewing_options['menu_bg']);
		if(isset($menubg)){
		    $output .= '.menubar{ background:'. $menubg .'; }';
		}

		$headerbg = esc_attr($themewing_options['header_bg']);
		if(isset($headerbg)){
		    $output .= '.site-header{ background:'. $headerbg .'; }';
		}

		$topbar = esc_attr($themewing_options['topbar_bg']);
		if(isset($headerbg)){
		    $output .= '.top-bar{ background:'. $topbar .'; }';
      }
      if(isset($themewing_options['custom_css'])){
         $output .= esc_attr($themewing_options['custom_css']);
      }
      

		return $output;
    }
}
