<?php

/* Title Classic
================================================== */

function themewing_title_classic( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(        
            'title'              => '',
            'style'              => 'style1',
            'title_size'         => '32',
            'title_color'        => '',
            'title_weight'       => '300',
            'title_margin'       => '25px auto 0px',
            'title_padding'      => '0px 0px 50px 0px',
            'transform'          => 'uppercase',
            'alignment'          => 'left',
            'class'              => '',
         ), $atts

      )
      
   );

   if ( isset($transform) || isset($title_padding) || isset($title_margin) || isset($title_weight) || isset($title_color) || isset($title_size) ) {
      $title_style = 'text-transform:'.esc_attr($transform).';padding:'.esc_attr($title_padding).';margin:'.esc_attr($title_margin).';font-weight:'.(int)esc_attr($title_weight).';font-size:'.(int)esc_attr($title_size).'px;color:'.esc_attr($title_color).';';
   }

   if ( isset($sub_color) || isset($sub_color) ) {
      $sub_title_style = 'color:'.esc_attr($sub_color).';';
   }      

  if ( isset($alignment) )
  {
   $align = 'style="text-align:'.esc_attr($alignment).'"';
  } 

   $html  = '';


   if (esc_attr($style) == 'style1') {
      $html .='<div class="bizspeak-title bizspeak-title-style1 '.esc_attr($class).'" '.$align.'>';
      if ( isset($title) && $title ) 
         {
            $html  .= '<h2 class="title-border" style="'.$title_style.'">'.esc_attr($title).'</h2>';
         }
      $html  .= '</div>';
   } elseif (esc_attr($style) == 'style2') {
      $html .='<div class="bizspeak-title bizspeak-title-style2 '.esc_attr($class).'" '.$align.'>';
      if ( isset($title) && $title ) 
         {
            $html  .= '<h2 style="'.$title_style.'">'.esc_attr($title).'</h2>';
         }
      $html  .= '</div>';
   } elseif (esc_attr($style) == 'style3') {
      $html .='<div class="bizspeak-title bizspeak-title-style3 '.esc_attr($class).'" '.$align.'>';
      if ( isset($title) && $title ) 
         {
            $html  .= '<h2 style="'.$title_style.'">'.esc_attr($title).'</h2>';
         }
      $html  .= '</div>';
   } else {
      $html .='<div class="bizspeak-title bizspeak-title-style1 '.esc_attr($class).'" '.$align.'>';
      if ( isset($title) && $title ) 
         {
            $html  .= '<h2 class="title-border" style="'.$title_style.'">'.esc_attr($title).'</h2>';
         }
      $html  .= '</div>';
   }



   return $html;
}

add_shortcode('title_classic', 'themewing_title_classic');
/*------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map(

   array(
      "name" => __("Title Style", "themewing"),
      "base" => "title_classic",
      "category" => __('Themewing', "themewing"),
      "params" => array(

      array(
         "type" => "dropdown",
         "heading" => __("Title Style", "themewing"),
         "param_name" => "style",
         "value" => array('Select'=>'','Style 1'=>'style1','Style 2'=>'style2','Style 3'=>'style3'),
         ),  

      array(
         "type" => "dropdown",
         "heading" => __("Alignment for Clasic Title", "themewing"),
         "param_name" => "alignment",
         "value" => array('Select'=>'','Left'=>'left','Center'=>'center','Right'=>'right'),
         ),   
 
         array(
            "type" => "textfield",
            "heading" => __("Title", "themewing"),
            "param_name" => "title",
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
            "heading" => __("Title Margin Ex. ex.0px 0px 50px 0px", "themewing"),
            "param_name" => "title_margin",
            "value" => "",
         ),          

         array(
            "type" => "textfield",
            "heading" => __("Title Padding Ex.0px 0px 50px 0px", "themewing"),
            "param_name" => "title_padding",
            "value" => "",
         ), 

         array(
            "type" => "dropdown",
            "heading" => __("Text Transfrom", "themewing"),
            "param_name" => "transform",
            "value" => array('Select'=>'','Uppercase'=>'uppercase','Capitalize'=>'capitalize','Lowercase'=>'lowercase'),
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
