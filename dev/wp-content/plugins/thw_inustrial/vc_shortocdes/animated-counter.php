<?php

/* Feature Animated Counter
================================================== */

function themewing_animated_counter( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array( 
            'alignment'       => 'left',   
            'icon_name'       => 'home',
            'icon_size'       => '30',
            'icon_color'      => '',         
            'counter'         => '',
            'counter_size'    => '30',
            'counter_color'   => '',
            'feature_title'   => '',
            'title_size'      => '24',
            'title_color'     => '',
            'title_weight'    => '400',
            'title_margin'    => '10px 0px 5px 0px',
            'class'           => '',
         ), $atts

      )
      
   );

   if ( isset($feature_bg) || isset($alignment) )
   {
      $feature_style = 'text-align:'.esc_attr($alignment).';';
   }

   if ( isset($counter_color) || isset($counter_size) ) {
      $counter_style = 'font-size:'.(int)esc_attr($counter_size).'px;line-height:'.(int)esc_attr($counter_size).'px;color:'.$counter_color.';';
   }   

   if ( isset($title_margin) || isset($title_weight) || isset($title_color) || isset($title_size) ) {
      $title_style = 'margin:'.esc_attr($title_margin).';font-weight:'.(int)esc_attr($title_weight).';font-size:'.(int)esc_attr($title_size).'px;line-height:'.(int)esc_attr($title_size).'px;color:'.esc_attr($title_color).';';
   }


   if ( isset($icon_size) || isset($icon_color) || isset($alignment) ) {
      $icon_style = 'display: block;font-size:'.(int)esc_attr($icon_size).'px;line-height:'.(int)esc_attr($icon_size).'px;color:'.esc_attr($icon_color).';text-align:'.esc_attr($alignment).';';
   }      

    $html  = '<div class="thw-facts-wraper '.esc_attr($class).'">';

        $html  .= '<div class="thw-facts" style="'.$feature_style.'">';

		   if ( isset($icon_name) && $icon_name ) 
		   {
		      $html  .= '<div class="thw-facts-icon" style="'.$icon_style.'"><i class="fa fa-'.esc_attr($icon_name).'"></i></div>';//facts-icon
		   }      

        $html  .= '<div class="thw-facts-content">';
            if ( isset($counter) && $counter ) {
            $html  .= '<h2 class="thw-facts-num counter" style="'.$counter_style.'">'.esc_attr($counter).'</h2>';
            }
	        if ( isset($feature_title) && $feature_title ) 
	        {
	            $html  .= '<h3 class="thw-facts-title" style="'.$title_style.'">'.esc_attr($feature_title).'</h3>';
	        }
        $html  .= '</div>';//facts-content
        
      $html  .= '</div>'; // facts

   $html  .= '</div>'; //facts-wraper

   return $html;
}

add_shortcode('animated_counter', 'themewing_animated_counter');
/*------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

   array(
      "name" => __("Animated Counter", "themewing"),
      "base" => "animated_counter",
      "category" => __('Themewing', "themewing"),
      "params" => array(
         
         array(
            "type" => "dropdown",
            "heading" => __("Alignment", "themewing"),
            "param_name" => "alignment",
            "value" => array('Select'=>'','Left'=>'left','Center'=>'center'),
         ),  

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
            "value" => "30",
         ),

         array(
            "type" => "textfield",
            "heading" => __("Counter Digit ex. 555", "themewing"),
            "param_name" => "counter",
            "value" => "",
         ),

         array(
            "type" => "colorpicker",
            "heading" => __("Counter Color", "themewing"),
            "param_name" => "counter_color",
            "value" => "",
         ),  

         array(
            "type" => "textfield",
            "heading" => __("Counter Font Size", "themewing"),
            "param_name" => "counter_size",
            "value" => "",
         ),

         array(
            "type" => "textfield",
            "heading" => __("Feature Title", "themewing"),
            "param_name" => "feature_title",
            "value" => "",
         ),   

         array(
            "type" => "colorpicker",
            "heading" => __("Title Text Color", "themewing"),
            "param_name" => "title_color",
            "value" => "",
         ),          

         array(
            "type" => "textfield",
            "heading" => __("Title Font Size", "themewing"),
            "param_name" => "title_size",
            "value" => "",
         ),                

         array(
            "type" => "textfield",
            "heading" => __("Title Font Weight", "themewing"),
            "param_name" => "title_weight",
            "value" => "",
         ),            

         array(
            "type" => "textfield",
            "heading" => __("Title Margin Ex. 10px 0px 5px 0px", "themewing"),
            "param_name" => "title_margin",
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
