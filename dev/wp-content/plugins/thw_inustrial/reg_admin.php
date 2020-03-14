<?php

/*-------------------------------------------------------
 *				Redux Framework Options Added
 *-------------------------------------------------------*/

global $themewing_options;

if ( !class_exists( 'ReduxFramework' ) ) {
    require_once('framework/framework.php');
}

if ( !isset( $redux_demo ) ) {
    require_once('themewing-options/themewing-options-config.php');
    require_once('themewing-options/demo-import.php');
}
