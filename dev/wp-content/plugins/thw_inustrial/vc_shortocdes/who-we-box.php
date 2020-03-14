<?php

/* Who We Box
================================================== */

function themewing_who_we_box( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(        
            'title'              => '',
            'width'              => '160',
            'height'             => '160',
            'radius'             => '100',
            'pulse_interval'     => 'one',
            'margintop'          => '40',
            'bx_bg_color'        => '',
            'class'              => '',
         ), $atts

      )
      
   );

   if ( isset($width) || isset($height) || isset($bx_bg_color) || isset($radius) ) {
      $title_style =  'style="display:inline-block;margin-top:'.(int)esc_attr($margintop).'px;border-radius:'.(int)esc_attr($radius).'px;background:'.esc_attr($bx_bg_color).';width:'.(int)esc_attr($width).'px;height:'.(int)esc_attr($height).'px;"';
      
   }   

   $html  ='';

   $html  .= '<div class="who-we-box pulse '.esc_attr($pulse_interval).' '.esc_attr($class).'" '.$title_style.'>';
      if ( isset($title) && $title ) 
      {
         $html  .= '<h4 class="box-title">'.balanceTags($title).'</h4>';
      }         
   $html  .= '</div>'; //custom class

   return $html;
}

add_shortcode('who_we_box', 'themewing_who_we_box');
/*------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

   array(
      "name" => __("Who We Box", "themewing"),
      "base" => "who_we_box",
      "category" => __('Themewing', "themewing"),
      "params" => array( 

         array(
            "type" => "colorpicker",
            "heading" => __("Box background color", "themewing"),
            "param_name" => "bx_bg_color",
            "value" => "",          
         ),               

         array(
            "type" => "textfield",
            "heading" => __("Title", "themewing"),
            "param_name" => "title",
            "value" => "",
         ), 

         array(
            "type" => "textfield",
            "heading" => __("Box margin top ex. 40", "themewing"),
            "param_name" => "margintop",
            "value" => "",
         ),          
        
         array(
            "type" => "textfield",
            "heading" => __("Box Width ex. 160", "themewing"),
            "param_name" => "width",
            "value" => "",
         ),          

         array(
            "type" => "textfield",
            "heading" => __("Box Height ex. 160", "themewing"),
            "param_name" => "height",
            "value" => "",
         ),         

         array(
            "type" => "textfield",
            "heading" => __("Box Radius ex. 100", "themewing"),
            "param_name" => "radius",
            "value" => "",
         ), 

         array(
            "type" => "dropdown",
            "heading" => __("Pulse Interval", "themewing"),
            "param_name" => "pulse_interval",
            "value" => array('Select'=>'','1'=>'one','2'=>'two','3'=>'three','4'=>'four','5'=>'five','6'=>'six','7'=>'seven','8'=>'eight'),
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
