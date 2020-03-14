<?php
/**
 * The Header for our theme
 * Displays all of the <head> section and everything up till <div id="main">
 * @package themewing
 */
global $themewing_options;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {    
	 if(isset($themewing_options['favicon']) ) { ?>
		<link rel="shortcut icon" href="<?php echo esc_url( $themewing_options['favicon']['url'] ); ?>" type="image/x-icon"/>
	<?php } 
} ?>
<!-- set faviocn-->

<?php wp_head(); ?>
</head>

<?php 

 	if ( isset($themewing_options['theme_layout']) && $themewing_options['theme_layout'] ){

		$layout = $themewing_options['theme_layout'];

	    switch ($layout) {

	        case 'bizboxw':
	        	$layout = esc_attr($themewing_options['theme_layout']) ;
	        break;

	        case 'bizfullw':
	        	$layout = esc_attr($themewing_options['theme_layout']) ;
	        break;

	        default:
	        	$layout = esc_attr($themewing_options['theme_layout']) ;
	        break;
	    }
	}else {
		$layout = 'bizfullw';
	}

?>


<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

<div id="body-inner" class="<?php echo esc_attr($layout);?>">
    <?php 

	    if ( isset( $_REQUEST['topbar_bg']) == 'topbar_bg'  ) {
	        get_template_part( 'includes/topbar' );
	    }else {
	    	if (isset($themewing_options['topbar_en']) && esc_attr($themewing_options['topbar_en'] )) {
		        get_template_part( 'includes/topbar' );
		    }
	    }
  
	 	if ( isset($themewing_options['header_layout']) && $themewing_options['header_layout'] ){

			if ( isset( $_REQUEST['header-layout'] ) ) {
				$header_layout = sanitize_text_field($_REQUEST['header-layout']);
			} else {
				$header_layout = $themewing_options['header_layout'];
			}

		    switch ($header_layout) {

		        case 'headerdefault':
		        	get_template_part( 'includes/header-default' );
		        break;

		        case 'header2':
		        	get_template_part( 'includes/header2' );
		        break;	        

		        default:
		        	get_template_part( 'includes/header-default' );
		        break;
		    }
		}else { 
			get_template_part( 'includes/header-default' );
		 }

	?>


	




