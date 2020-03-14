<?php

/* Dropcap
================================================== */

function themewing_dropcap( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(        
            'title'              => '',
            'class'              => '',
         ), $atts

      )
      
   );


   $html  = '';

   $html .='<div class="bizspeak-dropcap '.esc_attr($class).'">';
   if ( isset($title) && $title ) 
      {
         $html  .= '<div class="thw-dropcap">'.esc_html($title).'</div>';
      }
   $html  .= '</div>';

   return $html;
}

add_shortcode('thw_dropcap', 'themewing_dropcap');
/*------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

   array(
      "name" => __("Dropcap", "themewing"),
      "base" => "thw_dropcap",
      "category" => __('Themewing', "themewing"),
      "params" => array(

         array(
            "type" => "textarea",
            "heading" => __("Content", "themewing"),
            "param_name" => "title",
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
