<?php

/* List Item
================================================== */

function themewing_list_item( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(        
            'title'                 => '',
            'title_color'           => '',
            'font_size'             => '14',
            'icon_name'             => '',
            'icon_color'            => '',
            'title_margin_top'      => '5px',
            'title_margin_bottom'   => '5px',
            'class'                 => '',
         ), $atts

      )
      
   );

   if ( isset($title_margin_top) || isset($title_margin_bottom) ) {
      $title_style =  'style="display:block;margin-bottom:'.(int)esc_attr($title_margin_bottom).'px;margin-top:'.(int)esc_attr($title_margin_top).'px;"';
      
   }    

   if ( isset($title_color)) {
      $title_color_style =  'style="color:'.esc_attr($title_color).';font-size:'.(int)esc_attr($font_size).'px"';
      
   }     

   if ( isset($icon_name)) {
      
      if ( isset($icon_color)) {
         $icon_color_style =  'style="color:'.esc_attr($icon_color).';"'; 
      } 
      $icon_name_list =  '<i '.$icon_color_style.' class="fa fa-'.esc_attr($icon_name).'"></i>'; 
   }   


   $html  ='';

   $html  .= '<div class="thw-list-item '.$class.'" '.$title_style.'>';
      if ( isset($title) && $title ) 
      {
         $html  .= '<div class="list-item-title" '.$title_color_style.'><span>'.$icon_name_list.' '.esc_attr($title).'</span></div>';
      }         
   $html  .= '</div>'; //custom class

   return $html;
}

add_shortcode('thw_list_item', 'themewing_list_item');
/*------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

   array(
      "name" => __("List Item", "themewing"),
      "base" => "thw_list_item",
      "category" => __('Themewing', "themewing"),
      "params" => array( 

         array(
            "type" => "textfield",
            "heading" => __("List Title", "themewing"),
            "param_name" => "title",
            "value" => "",
         ), 

         array(
            "type" => "textfield",
            "heading" => __("List Title Font Size Ex. 14px", "themewing"),
            "param_name" => "font_size",
            "value" => "14",
         ),          

         array(
            "type" => "colorpicker",
            "heading" => __("List Title Text Color", "themewing"),
            "param_name" => "title_color",
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
            "heading" => __("List Icon Name Ex. dot-circle-o", "themewing"),
            "param_name" => "icon_name",
            "description" => __("Put the Font Fontawesome Name Ex. <strong>dot-circle-o</strong> . Here is Icon List URL: <strong> http://fortawesome.github.io/Font-Awesome/icons/ </strong>", "themewing"),
            "value" => "",
         ),

         array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "themewing"),
            "param_name" => "icon_color",
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
