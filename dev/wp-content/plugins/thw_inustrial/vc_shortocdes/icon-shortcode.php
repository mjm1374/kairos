<?php

/* Icon
================================================== */

function themewing_icon( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(             
            'icon_name'       => 'home',
            'icon_size'       => '30',
            'icon_color'      => '',
            'alignment'       => 'left',
            'class'           => '',
         ), $atts

      )
      
   );


   if ( isset($icon_size) || isset($icon_color) || isset($alignment) ) {
      $icon_style = 'display: block;font-size:'.(int)esc_attr($icon_size).'px;line-height:'.(int)esc_attr($icon_size).'px;color:'.esc_attr($icon_color).';text-align:'.esc_attr($alignment).';';
   }   

   $html  = '<div class="'.esc_attr($class).'">';
   $html  .= '<div class="icon-shortcode">';
   if ( isset($icon_name) && $icon_name ) 
   {
      $html  .= '<span style="'.$icon_style.'"><i class="fa fa-'.esc_attr($icon_name).'"></i></span>';
   }

   $html  .= '</div>';
   $html  .= '</div>';

   return $html;
}

add_shortcode('icon_shortcode', 'themewing_icon');
/*------------------------------------------------*/

vc_map(

   array(
      "name" => __("Icon", "themewing"),
      "base" => "icon_shortcode",
      "category" => __('Themewing', "themewing"),
      "params" => array(

         array(
            "type" => "textfield",
            "heading" => __("Icon Name", "themewing"),
            "param_name" => "icon_name",
            "description" => __("Put the Font Awesome Name Ex. <strong>home</strong> . Here is Icon List URL: <strong> http://fortawesome.github.io/Font-Awesome/icons/ </strong>", "themewing"),
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
            "heading" => __("Icon Font Size", "themewing"),
            "param_name" => "icon_size",
            "value" => "",
         ),

         array(
            "type" => "dropdown",
            "heading" => __("Feature Alignment", "themewing"),
            "param_name" => "alignment",
            "value" => array('Select'=>'','Left'=>'left','Center'=>'center','Right'=>'right'),
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
