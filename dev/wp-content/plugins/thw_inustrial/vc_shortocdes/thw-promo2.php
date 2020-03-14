<?php

/* Themewing Promo2
================================================== */

function themewing_promo2( $atts, $content = null ) {

   extract(

      shortcode_atts(

         array(          
            'icon_type'       => 'icon_select',
            'icon_name'       => '',
            'icon_img'        => '',
            'icon_bg_color'   => '',
            'icon_size'       => '',
            'width'           => '',
            'border'          => '',
            'border_style'    => '',
            'height'          => '',
            'radius'          => '',
            'border_color'    => '',
            'icon_color'      => '',
            'icon_margin'     => '10px 0px 5px 0px',
            'feature_title'   => '',
            'title_size'      => '20',
            'letter_spacing'  => '',
            'title_color'     => '',
            'title_weight'    => '400',
            'title_margin'    => '10px 0px 5px 0px',
            'feature_desc'    => '',
            'desc_size'       => '14',
            'desc_color'      => '',
            'link'            => '',
            'btn'             => '',
            'target'          => '_self',
            'class'           => '',
         ), $atts

      )
      
   );

   $src_img   = wp_get_attachment_image_src($icon_img, 'full');

   if ( isset($icon_margin) ) {
      $icon_style = 'style="margin:'.esc_attr($icon_margin).';"';
   }   

   if ( isset($letter_spacing) || isset($title_margin) || isset($title_weight) || isset($title_color) || isset($title_size) ) {
      $title_style = 'style="letter-spacing:'.(int)esc_attr($letter_spacing).'px;margin:'.esc_attr($title_margin).';font-weight:'.(int)esc_attr($title_weight).';font-size:'.(int)esc_attr($title_size).'px;color:'.esc_attr($title_color).';"';
   }

   if ( isset($desc_size) || isset($desc_color) ) {
      $desc_style = 'style="font-size:'.(int)esc_attr($desc_size).'px;color:'.esc_attr($desc_color).';"';
   } 

   $iconstyle = ''; 

   if ( isset($icon_color) && $icon_color ){
      $iconstyle .= 'text-align:center;color:'.esc_attr($icon_color).';';
   }    
   if ( isset($icon_size) && $icon_size ){
      $iconstyle .= 'font-size:'.(int)esc_attr($icon_size).'px;';
   }    
   if ( isset($width) && $width ){
      $iconstyle .= 'width:'.(int)esc_attr($width).'px;';
   }    
   if ( isset($height) && $height ){
      $iconstyle .= 'height:'.(int)esc_attr($height).'px;line-height:'.(int)esc_attr($height).'px;';
   }    
   if ( isset($radius) && $radius ){
      $iconstyle .= 'border-radius:'.(int)esc_attr($radius).'px;';
   }     
   if ( isset($icon_bg_color) && $icon_bg_color ){
      $iconstyle .= 'background:'.esc_attr($icon_bg_color).';';
   }   
   if ( isset($border) && $border ){
      $iconstyle .= 'border-width:'.(int)esc_attr($border).'px;';
   }    
   if ( isset($border_style) && $border_style ){
      $iconstyle .= 'border-style:'.esc_attr($border_style).';';
   } 
   if ( isset($border_color) && $border_color ){
      $iconstyle .= 'border-color:'.esc_attr($border_color).';';
   }  

   $imgstyle = '';

   if ( isset($width) && $width ){
      $imgstyle .= 'text-align:center;width:'.(int)esc_attr($width).'px;';
   }    
   if ( isset($height) && $height ){
      $imgstyle .= 'height:'.(int)esc_attr($height).'px;line-height:'.(int)esc_attr($height).'px;';
   }  
   if ( isset($radius) && $radius ){
      $imgstyle .= 'border-radius:'.(int)esc_attr($radius).'px;';
   } 
   if ( isset($border) && $border ){
      $imgstyle .= 'border-width:'.(int)esc_attr($border).'px;';
   }    
   if ( isset($border_style) && $border_style ){
      $imgstyle .= 'border-style:'.esc_attr($border_style).';';
   } 
   if ( isset($border_color) && $border_color ){
      $imgstyle .= 'border-color:'.esc_attr($border_color).';';
   }      

   $html  = '<div class="shortcode-promo2 '.esc_attr($class).'">';
      $html  .= '<div class="promo2 clearfix">';
         $html  .= '<div class="media">';

            if ($icon_type == 'icon_select') {
               if ( isset($icon_name) && $icon_name ) 
               {
                  $html  .= '<div class="pull-left" '.$icon_style.'><i class="fa fa-'.esc_attr($icon_name).'" style="'.$iconstyle.'"></i></div>';
               }
            }
            elseif($icon_type == 'image_select'){
               if (isset($src_img) && $src_img) 
               {
                 $html  .= '<div class="pull-left"><img style="'.$imgstyle.'" src="'.$src_img[0].'" alt="'.esc_attr($feature_title).'"></div>';
               }
            }else{
               $html  .= __('Select Icon Type','themewing');
            }

            $html  .= '<div class="media-body">';

               if ( isset($feature_title) && $feature_title ) 
               {
                  $html  .= '<h3 '.$title_style.'>'.esc_attr($feature_title).'</h3>';
               }   

               if ( isset($feature_desc) && $feature_desc ) 
               {
                  $html  .= '<p '.$desc_style.'>'.esc_attr($feature_desc).'</p>';
               }

               if ( isset($link) && $link )
               {
                  $html  .= '<p><a class="box-read-more" href="'.esc_url($link).'" target="'. esc_attr($target) .'">'.esc_attr($btn).' <i class="fa fa-long-arrow-right"> </i></a></p>';
               }

            $html  .= '</div>'; // media-body
         $html  .= '</div>'; // media
      $html  .= '</div>'; // thw-promo1
   $html  .= '</div>'; // shortcode-thw-promo1

   return $html;
}

add_shortcode('thw_promo2', 'themewing_promo2');
/*------------------------------------------------*/

vc_map(

   array(
      "name" => __("Themewing Promo 2", "themewing"),
      "base" => "thw_promo2",
      "category" => __('Themewing', "themewing"),
      "params" => array(

         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon to display", "themewing"),
            "param_name" => "icon_type",
            "value" => array(
               __("Select","themewing") => "",
               __("Font Awesome Icon","themewing") => "icon_select",
               __("Custom Image Icon","themewing") => "image_select",
            ),
            "description" => __("Use an existing font icon or upload a custom image.", "themewing")
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Select Icon ","themewing"),
            "param_name" => "icon_name",
            "value" => "",
            "description" => __("Put the Font Awesome Name Ex. <strong>home</strong> . Here is Icon List URL: <strong> http://fortawesome.github.io/Font-Awesome/icons/ </strong>", "themewing"),
            "dependency" => Array("element" => "icon_type","value" => array("icon_select")),
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __("Upload Image Icon", "themewing"),
            "param_name" => "icon_img",
            "value" => "",
            "description" => __("Upload the custom image icon.", "themewing"),
            "dependency" => Array("element" => "icon_type","value" => array("image_select")),
         ),           

         array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "themewing"),
            "param_name" => "icon_color",
            "value" => "",
            "dependency" => Array("element" => "icon_type","value" => array("icon_select")),            
         ),          

         array(
            "type" => "colorpicker",
            "heading" => __("Icon background Color", "themewing"),
            "param_name" => "icon_bg_color",
            "value" => "",
            "dependency" => Array("element" => "icon_type","value" => array("icon_select")),            
         ),  

         array(
            "type" => "textfield",
            "heading" => __("Icon Font Size", "themewing"),
            "param_name" => "icon_size",
            "value" => "",
            "dependency" => Array("element" => "icon_type","value" => array("icon_select")),            
         ),

         array(
            "type" => "textfield",
            "heading" => __("Icon Margin", "themewing"),
            "param_name" => "icon_margin",
            "value" => "",
            "dependency" => Array("element" => "icon_type","value" => array("icon_select")),            
         ),   

         array(
            "type" => "textfield",
            "heading" => __("Width Ex. 50px", "themewing"),
            "param_name" => "width",
            "value" => "",
         ),          

         array(
            "type" => "textfield",
            "heading" => __("Height Ex. 50px", "themewing"),
            "param_name" => "height",
            "value" => "",
         ),                  

         array(
            "type" => "textfield",
            "heading" => __("Border Width Ex. 1px", "themewing"),
            "param_name" => "border",
            "value" => "",
         ),         

         array(
            "type" => "dropdown",
            "heading" => __("Border Style", "themewing"),
            "param_name" => "border_style",
            "value" => array('Select'=>'','None'=>'','Solid'=>'solid','Dotted'=>'dotted' ,'Dashed'=>'dashed'),
         ), 

         array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "themewing"),
            "param_name" => "border_color",
            "value" => "",
         ),           


         array(
            "type" => "textfield",
            "heading" => __("Border Radius Ex. 100px", "themewing"),
            "param_name" => "radius",
            "value" => "",
         ),   

         array(
            "type" => "textfield",
            "heading" => __("Promo Title", "themewing"),
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
            "heading" => __("Title letter Spacing Ex. 1px", "themewing"),
            "param_name" => "letter_spacing",
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
            "heading" => __("Title Margin", "themewing"),
            "param_name" => "title_margin",
            "value" => "",
         ),          

         array(
            "type" => "textarea",
            "heading" => __("Feature Description", "themewing"),
            "param_name" => "feature_desc",
            "value" => "",
         ),    

         array(
            "type" => "colorpicker",
            "heading" => __("Description Text Color", "themewing"),
            "param_name" => "desc_color",
            "value" => "",
         ),          

         array(
            "type" => "textfield",
            "heading" => __("Description Font Size", "themewing"),
            "param_name" => "desc_size",
            "value" => "",
         ), 

         array(
            "type" => "textfield",
            "heading" => __("Button URL", "themewing"),
            "param_name" => "link",
            "value" => "",
         ),          

         array(
            "type" => "textfield",
            "heading" => __("Button Name", "themewing"),
            "param_name" => "btn",
            "value" => "",
         ), 

         array(
            "type" => "dropdown",
            "heading" => __("Target URL", "themewing"),
            "param_name" => "target",
            "value" => array('Select'=>'','Self'=>'_self','Blank'=>'_blank','Parent'=>'_parent'),
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
