<?php

/* Bullet Feature
================================================== */

function themewing_bullet_feature( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(        
            'title'                   => '',
            'title_margin_top'        => '40px',
            'title_margin_bottom'     => '10px',
            'class'                   => '',
         ), $atts

      )
      
   );

   if ( isset($title_margin_top) || isset($title_margin_bottom) ) {
      $title_style =  'style="display:inline-block;margin-bottom:'.(int)esc_attr($title_margin_bottom).'px;margin-top:'.(int)esc_attr($title_margin_top).'px;"';
      
   }   

   $html  ='';

   $html  .= '<div class="tw-bullet-feature clearfix '.esc_attr($class).'" '.$title_style.'>';
      if ( isset($title) && $title ) 
      {
         $html  .= '<h4 class="title-bullet-feature">'.balanceTags($title).'</h4>';
      }         
   $html  .= '</div>'; //custom class

   return $html;
}

add_shortcode('bullet_feature', 'themewing_bullet_feature');
/*------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

   array(
      "name" => __("Bullet Feature", "themewing"),
      "base" => "bullet_feature",
      "category" => __('Themewing', "themewing"),
      "params" => array( 

         array(
            "type" => "textfield",
            "heading" => __("Title", "themewing"),
            "param_name" => "title",
            "value" => "",
         ),   
                   
         array(
            "type" => "textfield",
            "heading" => __("Title Margin Top", "themewing"),
            "param_name" => "title_margin_top",
            "value" => "",
         ),           

         array(
            "type" => "textfield",
            "heading" => __("Title Margin Bottom", "themewing"),
            "param_name" => "title_margin_bottom",
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
