<?php
class Innova_Gallery_Images_Widget extends WP_Widget{ 
  public function __construct(){
   global $innova_plugin_name; 
     parent::__construct( 'kaya-gallery-images-boxes',
        __('Innova Gallery Images (PB) ',innova).'&nbsp; <a class="widget_video_tutorials" target="_blank" href="https://youtu.be/Yp6z7wBcGPc">'.__('Watch this video', $innova_plugin_name).'</a>',
       array('description' => __('Displays Gallery Image Columns ',innova)  )
      );
   }
  function widget( $args, $instance ){
      global $innova_plugin_name;
      wp_enqueue_script('jquery_owlcarousel');
      wp_enqueue_style('css_owl.carousel');
      $instance = wp_parse_args($instance,array(        
        'upload_images_ids' => '',
        'gallery_columns' => '4',
        'gallery_type' =>'',
        'slider_transition_time' => '2000',
        'enable_image_title' => '',
        'enable_grayscale_images' => '',
        'image_title_bg_color' => '#333333',
        'image_title_color' => '#ffffff',
        'image_bg_hover_color' => '',
        'gallery_images_space' => '',
        'image_radius' => '0',
        'gallery_image_shadow' => '',
        'animation_names' => '',
        'slider_auto_play' => 'true',
        'image_width' => '',
        'image_height' => '',
        'enable_image_zoom_hover' => '',
        'disable_light_box' => '',
        'slider_arrows_bg_color' => '#333333',
        'slider_arrows_color' => '#ffffff',
        'enable_slider_dots_buttons' => '',
        'disable_slider_arrow_buttons' => '',
        'slide_animation_in' => '',
        'slide_animation_out' => '',        
      ));

    echo $args['before_widget'];
    ?>
    <?php
    $gallery_rand=rand(1,500); 
    $enable_slider_dots_buttons = ($instance['enable_slider_dots_buttons'] == 'on' ) ? 'block' :'none';
    echo '<style>.gallery_image_wrapper_'.$gallery_rand.' .owl-next, .gallery_image_wrapper_'.$gallery_rand.' .owl-prev, .gallery_image_wrapper_'.$gallery_rand.' #gallery_widget_slider .owl-dots{ background-color:'.$instance['slider_arrows_bg_color'].'; color:'.$instance['slider_arrows_color'].';  }
      .gallery_image_wrapper_'.$gallery_rand.'  #gallery_widget_slider .owl-dots::after { border-color: transparent '.$instance['slider_arrows_bg_color'].' '.$instance['slider_arrows_bg_color'].' transparent; }
      .gallery_image_wrapper_'.$gallery_rand.'  #gallery_widget_slider .owl-dots { display:'.$enable_slider_dots_buttons.'!important; }
       .gallery_image_wrapper_'.$gallery_rand.' #gallery_widget_slider .owl-dot{ border:2px solid'.$instance['slider_arrows_color'].';  }
        .gallery_image_wrapper_'.$gallery_rand.' #gallery_widget_slider .owl-dot.active{ background:'.$instance['slider_arrows_color'].';  }
    </style>';
    //echo '<style> border-radius:'.$instance['image_radius'].'%; </style>';
    $gallery_image_shadow = ($instance['gallery_image_shadow'] == 'on') ? 'box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);' : '';
    $slider_auto_play = ($instance['gallery_type'] == 'gallery_slider') ? 'data-autoplay="'.$instance['slider_auto_play'].'"' : '';
    $slider_transition_time = ($instance['gallery_type'] == 'gallery_slider') ? 'data-slidespeed="'.$instance['slider_transition_time'].'"' : '2000';
    $grid_columns = ($instance['gallery_type'] == 'list_gallery_images') ? 'gallery_list_images' : 'gallery_image_columns_'.$instance['gallery_columns'].'';
    $image_height = $instance['image_height'] ? $instance['image_height']  : '650';
    $slider_radius = ($instance['gallery_type'] == 'gallery_slider') ? 'border-radius:0 0 '.$instance['image_radius'].'px '.$instance['image_radius'].'%;'  : '';
    $image_zoom_hover = ( $instance['enable_image_zoom_hover'] == 'on' ) ? 'img_zoom_hover' : '';
    $gray_scale = ($instance['enable_grayscale_images'] == 'on' ) ? 'on' :'off';
    $enable_slider_dots_buttons = ($instance['enable_slider_dots_buttons'] == 'on' ) ? 'off' :'on';
    $disable_slider_arrow_buttons = ($instance['disable_slider_arrow_buttons'] == 'on' ) ? 'false' :'true';
    $gallery_animation =   ( trim( $instance['animation_names'] ) )  ? 'wow '. $instance['animation_names'] : '';
    $gallery_image_sapce = ($instance['gallery_images_space'] == 'on') ? 'gallery_with_sapce' : 'gallery_no_space';
    $gallery_image_margin = ($instance['gallery_images_space'] == 'on') ? '20' : '0';
    $upload_image_ids = explode(',', trim( $instance['upload_images_ids']));
    if( trim( !empty($instance['upload_images_ids']) ) ){
      $upload_image_ids = array_unique( array_combine(range(1, count($upload_image_ids)), $upload_image_ids));
        echo '<div class="'. $gallery_animation .' '.$gallery_image_sapce.' gallery_image_wrapper '.$grid_columns.' gallery_image_wrapper_'.$gallery_rand.' '.$image_zoom_hover.'" data-radius="'.$instance['image_radius'].'" data-columns="'.$instance['gallery_columns'].'" data-grayscale="'.$gray_scale.'" data-margin="'.$gallery_image_margin.'"  '.$slider_auto_play.' '.$slider_transition_time.'>';
      if( $instance['gallery_type'] == 'gallery_slider'){ // Slider
         echo '<div class="image_gallery_slider_wrapper " style="height:400px;">';
         echo '<span class="slider_bg_loading_img container" style="height:400px; background:url('.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/bx_loader.gif)"></span>';
        echo '<div  class="" id="gallery_widget_slider" data-buttons="'.$disable_slider_arrow_buttons.'" data-animationin="'.$instance['slide_animation_in'].'" data-animationout="'.$instance['slide_animation_out'].'">';
          foreach ($upload_image_ids as $upload_image_id) {
          $attachment = get_post( $upload_image_id );

          $values =  array(
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
            );
            $upload_img_url = wp_get_attachment_image_src($upload_image_id, "full");
            $src = $upload_img_url[0];;
            $width = $upload_img_url[1];
            $height = $upload_img_url[2];
            $image_width = $instance['image_width'] ? $instance['image_width'] : $width;
            $image_height = $instance['image_height'] ? $instance['image_height'] : $height;
            $image_bg_color = $instance['image_bg_hover_color'] ? 'background-color:'.$instance['image_bg_hover_color'].';' : 'background-color:transparent';
            $data_img_bg =  $instance['image_bg_hover_color']  ?  $instance['image_bg_hover_color']  : 'transparent';
            $image_custom_link= get_post_meta( $upload_image_id, '_image_custom_link', true ) ? get_post_meta( $upload_image_id, '_image_custom_link', true ) : '';
           $link_new_window= get_post_meta( $upload_image_id, '_link_new_window', true ) ? get_post_meta( $upload_image_id, '_link_new_window', true ) : '';
            $image_custom_description= get_post_meta( $upload_image_id, '_image_custom_description', true ) ? get_post_meta( $upload_image_id, '_image_custom_description', true ) : '';
          $customlink = $image_custom_link ? $image_custom_link : $src;
          $link_open = $image_custom_link ? 'target="'.$link_new_window.'"' : 'data-gal="prettyPhoto[gallery_images_'.$gallery_rand.']"';
            echo "<div class='image_gallery_slider ".$gallery_image_sapce."'  style=' border-radius:".$instance['image_radius']."px; ".$gallery_image_shadow."'>";
            echo '<div class="image_hover_bg_color" data-img-bg='.$data_img_bg.' style="'.$image_bg_color.'; border-radius:'.$instance['image_radius'].'px;"> </div>';
            if( $instance['disable_light_box'] != 'on' ){
              echo "<a href=\" $customlink \"  $link_open style='border-radius:".$instance['image_radius']."px;'>";
            } 
            echo "<img src='".kaya_image_resize( $src, $image_width, $image_height , 't' )."' style='border-radius:".$instance['image_radius']."px;' alt='".$values['title']."'>";
            if( $instance['disable_light_box'] != 'on' ){
              echo "</a>";
            }
            if( $instance['enable_image_title'] == 'custom_text' ){
              //if( $image_custom_description ): 
               echo '<div class="custom_text">';   echo $image_custom_description;   echo '</div>';
            //endif; 
            }
            elseif( $instance['enable_image_title'] !='none' ){
              echo '<span class="gallery_caption '.$instance['enable_image_title'].'" style="background-color:'.$instance['image_title_bg_color'].'; color:'.$instance['image_title_color'].'; '.$slider_radius.'"><strong style="color:'.$instance['image_title_color'].';">'.$values['title'].'</strong>';
              echo '<p>'.$values['description'].'</p></span>'; 
            }else{ 
              }
            echo "</div>";
           }
          echo '</div></div>'; // end
      }else{
        echo '<ul class="gallery-images">';
        foreach ($upload_image_ids as $upload_image_id) {
        $attachment = get_post( $upload_image_id );
        $values =  array(
          'caption' => $attachment->post_excerpt,
          'description' => $attachment->post_content,
          'href' => get_permalink( $attachment->ID ),
          'src' => $attachment->guid,
          'title' => $attachment->post_title
          );
         // $image_array_values = wp_get_attachment_image_src($upload_image_id, $size, false);
          $upload_img_url = wp_get_attachment_image_src($upload_image_id, "full");
          $src = $upload_img_url[0];;
          $width = $upload_img_url[1];
          $height = $upload_img_url[2];
          $image_custom_link= get_post_meta( $upload_image_id, '_image_custom_link', true ) ? get_post_meta( $upload_image_id, '_image_custom_link', true ) : '';
          $link_new_window= get_post_meta( $upload_image_id, '_link_new_window', true ) ? get_post_meta( $upload_image_id, '_link_new_window', true ) : '';
          $image_custom_description= get_post_meta( $upload_image_id, '_image_custom_description', true ) ? get_post_meta( $upload_image_id, '_image_custom_description', true ) : '';
          $target_link = ( $link_new_window == 'on' ) ? '_blank' : '_self';
          $customlink = $image_custom_link ? $image_custom_link : $src;
          $link_open = $image_custom_link ? 'target="'.$link_new_window.'"' : 'data-gal="prettyPhoto[gallery_images_'.$gallery_rand.']"';
          $image_width = $instance['image_width'] ? $instance['image_width'] : $width;
          $image_height = $instance['image_height'] ? $instance['image_height'] : $height;
          $image_bg_color = $instance['image_bg_hover_color'] ? 'background-color:'.$instance['image_bg_hover_color'].';' : '';
          echo "<li class='isotope-ready' style=' border-radius:".$instance['image_radius']."px; ".$gallery_image_shadow."'>";
          if($instance['gallery_type'] =='grid_gallery'){
            echo '<div class="image_hover_bg_color" style="'.$image_bg_color.'; width:'.$image_width.'px!important; height:'.$image_height.'px!important;"> </div>';

            if( $instance['disable_light_box'] != 'on' ){
              echo "<a href=\" $customlink \"  $link_open style='border-radius:".$instance['image_radius']."px;'>";
            } 
            echo "<img style='border-radius:".$instance['image_radius']."px;' src='".kaya_image_resize( $src, $image_width, $image_height , 't' )."' alt='".esc_html($values['title'])."'>";
            if( $instance['disable_light_box'] != 'on' ){
              echo "</a>";
            }
          }
          if( $instance['enable_image_title'] == 'custom_text' ){
            if( !empty($image_custom_description) ):  echo '<div class="custom_text">';   echo $image_custom_description;   echo '</div>'; endif;
          }
          elseif( $instance['enable_image_title'] == 'custom_text_bottom' ){
              if( $values['description'] ):  echo '<div class="custon_text_bottom">';   echo $values['description'];   echo '</div>';
            endif; 
           }
          elseif( $instance['enable_image_title'] !='none' ){
              echo '<span class="gallery_caption '.$instance['enable_image_title'].'" style="background-color:'.$instance['image_title_bg_color'].'; color:'.$instance['image_title_color'].'; '.$slider_radius.'"><strong style="color:'.$instance['image_title_color'].';">'.$values['title'].'</strong>';
              echo '<p>'.$values['description'].'</p></span>'; 
          }else{ 
          }
          echo "</li>";
         }
        echo '</ul>';
      } 
      echo '</div>';
    }
    else{
       echo '<img src="'.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/image_gallery.jpg" style="width:'.$instance['image_width'].'px; border-radius:'.$instance['image_radius'].'px; height:'.$instance['image_height'].'px;">';

         global $post; 
        $post_id = $post->ID;
        $post_url = admin_url( 'post.php?post=' . $post_id ) . '&action=edit';
        echo '<p style="text-align:center;">This is default image, To upload your own images <a target="_blank" href="'.$post_url.'">"Click Here"</a> &  edit "'.strtoupper($innova_plugin_name).' Images Gallery > Upload Gallery Images " select images and click on "Done" button.</p>';
       
      }
    
        echo $args['after_widget'];
    }

    function form( $instance ){
      global $innova_plugin_name;
      $instance = wp_parse_args($instance, array(    
        'upload_images_ids' => '',
        'gallery_columns' => '4',
        'gallery_type' =>'',
        'enable_image_title' => '',
        'slider_transition_time' => '2000',
        'enable_grayscale_images' => '',
        'image_title_bg_color' => '#333333',
        'image_title_color' => '#ffffff',
        'image_bg_hover_color' => '',
        'gallery_images_space' => '',
        'image_radius' => '0',
        'gallery_image_shadow' => '',
        'animation_names' => '',
        'slider_auto_play' => 'true',
        'enable_image_zoom_hover' => '',
        'image_height' => '',
        'image_width' => '',
        'disable_light_box' => '',
        'slider_arrows_bg_color' => '',
        'slider_arrows_color' => '',
        'slider_arrows_bg_color' => '#333333',
        'slider_arrows_color' => '#ffffff',
        'enable_slider_dots_buttons' => '',
        'disable_slider_arrow_buttons' => '',
        'slide_animation_in' => '',
        'slide_animation_out' => '',
        ));

        ?>
  <script type='text/javascript'>
    (function($) {
      "use strict";
      $(function() {
      $('.image_gallery_color_pickr').each(function(){
        $(this).wpColorPicker();
      });
      $("#<?php echo $this->get_field_id('gallery_type') ?>").change(function () {
        $("#<?php echo $this->get_field_id('gallery_columns') ?>").parent().show();
        $("#<?php echo $this->get_field_id('slider_auto_play') ?>").parent().hide();
        $(".gallery_slider_settings").hide();
        var select_gallery_type = $("#<?php echo $this->get_field_id('gallery_type') ?> option:selected").val(); 
        switch(select_gallery_type){
          case 'gallery_slider':
            $("#<?php echo $this->get_field_id('slider_auto_play') ?>").parent().show();
             $(".gallery_slider_settings").show();
            break;
          case 'list_gallery_images':
            $("#<?php echo $this->get_field_id('gallery_columns') ?>").parent().hide();
            break;    
        }
      }).change();
      $("#<?php echo $this->get_field_id('enable_image_title') ?>").change(function () {
          $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().show();
          $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().show();
          $(".custom_text_desciption").hide();
          $(".custom_text_desciption_bottom").hide();
          var enable_image_title = $("#<?php echo $this->get_field_id('enable_image_title') ?> option:selected").val(); 
          switch(enable_image_title){
          case 'none':
            $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().hide();
            $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().hide();   
            break;
          case 'custom_text':
            $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().hide();
            $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().hide();
            $(".custom_text_desciption").show();
            break;            
        case 'custom_text_bottom':
            $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().hide();
            $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().hide();
            $(".custom_text_desciption_bottom").show();
            break;            
        }
      }).change();


    $("#<?php echo $this->get_field_id('gallery_columns') ?>").change(function () {
        $("#<?php echo $this->get_field_id('slide_animation_in') ?>").parent().hide();
        $("#<?php echo $this->get_field_id('slide_animation_out') ?>").parent().hide();
        var select_gallery_type = $("#<?php echo $this->get_field_id('gallery_columns') ?> option:selected").val(); 
        switch(select_gallery_type){
          case '1':
            $("#<?php echo $this->get_field_id('slide_animation_in') ?>").parent().show();
            $("#<?php echo $this->get_field_id('slide_animation_out') ?>").parent().show();
            break;
              
        }
      }).change();
   });
  })(jQuery);
  </script>
<?php $animationins = array( 'bounceIn'=> 'BounceIn','bounceInLeft' => 'BounceInLeft', 'bounceInUp' => 'BounceInUp','bounceInDown' => 'BounceInDown', 'bounceInRight' => 'BounceInRight', 'fadeIn'=> 'fadeIn', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUpBig' => 'fadeInUpBig','fadeInDown'=> 'fadeInDown', 'fadeInLeft' => 'fadeInLeft','fadeInRight' => 'fadeInRight','fadeInUp' => 'fadeInUp', 'rotateIn'=> 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight','rotateInUpLeft' => 'rotateInUpLeft');

$animationouts = array( 'bounceOut'=> 'BounceOut', 'bounceOutLeft' => 'BounceOutLeft', 'bounceOutUp' => 'BounceOutUp', 'bounceOutDown' => 'BounceOutDown', 'bounceOutRight' => 'BounceOutRight', 'fadeOut'=> 'fadeOut','fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeftBig' => 'fadeOutLeftBig','fadeOutRightBig' => 'faceOutRightBig','fadeOutUpBig' => 'fadeOutUpBig', 'fadeOutDown'=> 'fadeOutDown','fadeOutLeft' => 'fadeOutLeft', 'fadeOutRight' => 'fadeOutRight', 'fadeOutUp' => 'fadeOutUp', 'rotateOut'=> 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft','rotateOutDownRight' => 'rotateOutDownRight','rotateOutUpLeft' => 'rotateOutUpLeft','rotateOutUpRight' => 'rotateOutUpRight');
?>
<div class="input-elements-wrapper">    
  <p><?php $i = rand(1,100); ?>
        <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('upload_images_ids'); ?>" id="<?php echo $this->get_field_id('upload_images_ids'); ?>" value="<?php echo $instance['upload_images_ids']; ?>">
        <input type="button" value="<?php _e( 'Upload Gallery Images', innova ); ?>" class="button button-primary  custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
        <script type="text/javascript">
          jQuery(document).ready( function(){
            var file_frame;
            jQuery('.custom_media_upload_<?php echo $i; ?>').live('click', function( event ){
             event.preventDefault();
            if ( file_frame ) {
            file_frame.open();
            return;
            }
             // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Upload Gallery Images',
            button: {
            text: 'Upload Gallery Images',
            },
            multiple: true // Set to true to allow multiple files to be selected
            });

          file_frame.on( 'select', function() {
          var selection = file_frame.state().get('selection');
          var attachment_ids = selection.map( function( attachment ) {
              attachment = attachment.toJSON();
              return attachment.id;
            }).join();
              if( attachment_ids.charAt(0) === ',' ) { attachment_ids = attachment_ids.substring(1); }
              jQuery('.custom_media_url_<?php echo $i; ?>').val( attachment_ids );
          });
            // Finally, open the modal
            file_frame.open();
            });
            });

        </script><br />
        <small><?php _e('Note:Comma separated attachment IDs',innova) ?></small>
  </p>
   <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_type') ?>">  <?php _e('Select Gallery Type',innova)?>  </label>
    <select id="<?php echo $this->get_field_id('gallery_type') ?>" name="<?php echo $this->get_field_name('gallery_type') ?>">
      <option value="grid_gallery" <?php selected('grid_gallery', $instance['gallery_type']) ?>>  <?php _e('Grid Gallery', innova) ?> </option>
      <option value="gallery_slider" <?php selected('gallery_slider', $instance['gallery_type']) ?>>  <?php _e('Slider', innova) ?>    </option>
      
    </select>
  </p>
    <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_columns') ?>">  <?php _e('Select Columns',innova)?>  </label>
    <select id="<?php echo $this->get_field_id('gallery_columns') ?>" name="<?php echo $this->get_field_name('gallery_columns') ?>">
      <option value="5" <?php selected('5', $instance['gallery_columns']) ?>>  <?php _e('Column 5', innova) ?>    </option>
      <option value="4" <?php selected('4', $instance['gallery_columns']) ?>>  <?php _e('Column 4', innova) ?>    </option>
      <option value="3" <?php selected('3', $instance['gallery_columns']) ?>>  <?php _e('Column 3', innova) ?>    </option>
      <option value="2" <?php selected('2', $instance['gallery_columns']) ?>>    <?php _e('Column 2', innova) ?>    </option>
      <option value="1" <?php selected('1', $instance['gallery_columns']) ?>>    <?php _e('Column 1', innova) ?>    </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_width'); ?>"> <?php _e('Image Width & Height',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_width') ?>" id="<?php echo $this->get_field_id('image_width') ?>" class="small-text" value="<?php echo $instance['image_width'] ?>" /> X
    <input type="text" name="<?php echo $this->get_field_name('image_height') ?>" id="<?php echo $this->get_field_id('image_height') ?>" class="small-text" value="<?php echo $instance['image_height'] ?>" />
    <small><?php _e('PX',innova); ?></small>
  </p>
<p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('slider_auto_play') ?>">  <?php _e('Auto Play',innova)?>  </label>
    <select id="<?php echo $this->get_field_id('slider_auto_play') ?>" name="<?php echo $this->get_field_name('slider_auto_play') ?>">
      <option value="true" <?php selected('True', $instance['slider_auto_play']) ?>>  <?php _e('True', innova) ?>    </option>
      <option value="false" <?php selected('false', $instance['slider_auto_play']) ?>>  <?php _e('False', innova) ?>    </option>
    </select>
  </p> 
</div>
<div class="input-elements-wrapper gallery_slider_settings">
  <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('slider_transition_time') ?>"><?php _e('Autoplay Transition time',innova) ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('slider_transition_time') ?>" value="<?php echo esc_attr($instance['slider_transition_time']) ?>" name="<?php echo $this->get_field_name('slider_transition_time') ?>" />
      </p> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slide_animation_in') ?>">  <?php _e('Slide AnimateIn',innova)?>  </label>
    <select id="<?php echo $this->get_field_id('slide_animation_in') ?>" name="<?php echo $this->get_field_name('slide_animation_in') ?>">
      <?php  echo '<option value="fadeIn">Choose Animation</option>';
      foreach ($animationins as $k => $animationin) {
        echo  '<option value='.$k.'  '.selected($k, $instance['slide_animation_in']).' >'.$animationin.'</option>';
      } ?>
     
    </select>
  </p>
  <p class="three_fourth_last">
    <label for="<?php echo $this->get_field_id('slide_animation_out') ?>">  <?php _e('Slide AnimateOut',innova)?>  </label>
    <select id="<?php echo $this->get_field_id('slide_animation_out') ?>" name="<?php echo $this->get_field_name('slide_animation_out') ?>">
      <?php echo '<option value="fadeOut">Choose Animation</option>'; 
      foreach ($animationouts as $k => $animationout) {
      echo  '<option value="'.$k.'"  '.selected($k, $instance['slide_animation_out']).' >'.$animationout.'</option>';
      } ?>     
    </select>
  </p>
   <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('disable_slider_arrow_buttons') ?>">  <?php _e('Disable Slider Arrow Buttons',innova) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_slider_arrow_buttons"); ?>" name="<?php echo $this->get_field_name("disable_slider_arrow_buttons"); ?>"<?php checked( (bool) $instance["disable_slider_arrow_buttons"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_slider_dots_buttons') ?>">  <?php _e('Slider Dots Buttons',innova) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_slider_dots_buttons"); ?>" name="<?php echo $this->get_field_name("enable_slider_dots_buttons"); ?>"<?php checked( (bool) $instance["enable_slider_dots_buttons"], true ); ?> />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('slider_arrows_bg_color') ?>">  <?php _e('Slider Navigation Background Color',innova)?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_arrows_bg_color') ?>" id="<?php echo $this->get_field_id('slider_arrows_bg_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['slider_arrows_bg_color'] ?>" />
  </p>
</div> 
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_arrows_color') ?>">  <?php _e('Slider Navigation Color',innova)?>  </label>
   <input type="text" name="<?php echo $this->get_field_name('slider_arrows_color') ?>" id="<?php echo $this->get_field_id('slider_arrows_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['slider_arrows_color'] ?>" />
  </p>
    <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_bg_hover_color'); ?>"> <?php _e('Image Hover BG Opacity Color',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_bg_hover_color') ?>" id="<?php echo $this->get_field_id('image_bg_hover_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['image_bg_hover_color'] ?>" />
  </p> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_image_zoom_hover') ?>">  <?php _e('Image Zoom On Hover ',innova)?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_image_zoom_hover"); ?>" name="<?php echo $this->get_field_name("enable_image_zoom_hover"); ?>"<?php checked( (bool) $instance["enable_image_zoom_hover"], true ); ?> />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('image_radius'); ?>"> <?php _e('Image Radius',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_radius') ?>" id="<?php echo $this->get_field_id('image_radius') ?>" class="small-text" value="<?php echo $instance['image_radius'] ?>" />
    <small><?php _e('px',innova); ?></small>
  </p>  
</div> 
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_image_title') ?>">  <?php _e('Attachment Image',innova)?>  </label>
    <select id="<?php echo $this->get_field_id('enable_image_title') ?>" name="<?php echo $this->get_field_name('enable_image_title') ?>">
      <option value="none" <?php selected('none', $instance['enable_image_title']) ?>>  <?php _e('TItle & Description None', innova) ?>    </option>
      <option value="mouse_over_on_image" <?php selected('mouse_over_on_image', $instance['enable_image_title']) ?>>  <?php _e('TItle & Description On Mouseover', innova) ?>    </option>
      <option value="fixed_on_image" <?php selected('fixed_on_image', $instance['enable_image_title']) ?>>  <?php _e('TItle & Description Fixed', innova) ?> </option>
      <option value="image_bottom" <?php selected('image_bottom', $instance['enable_image_title']) ?>>  <?php _e('TItle & Description Under Image', innova) ?> </option>
       <option value="custom_text" <?php selected('custom_text', $instance['enable_image_title']) ?>>  <?php _e('Custom Description', innova) ?> </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_title_bg_color'); ?>"> <?php _e('Image Title Background Color',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_title_bg_color') ?>" id="<?php echo $this->get_field_id('image_title_bg_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['image_title_bg_color'] ?>" />
  </p>
  <p class="three_fourth_last custom_text_desciption">
    <strong>Add content in <em>"Attachment Details > custom description"</em> text area like below format:</strong><br />
    &lt;div style="background:rgba(0,0,0,.3);position:absolute; bottom:0; right:0; width:88%;  padding:6%; "&gt;
    &lt;h3 style="color:#ffffff;"&gt;This is Title&lt;/h3&gt;
    &lt;p style="color:#666666;"&gt;Image attachment details description&lt;/p&gt;
    &lt;/div&gt;
    <br />
    for more details <a href="<?php echo constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/attachment-details-description.jpg' ?>" target="_blank">click here</a>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_title_color'); ?>"> <?php _e('Image Title Color',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_title_color') ?>" id="<?php echo $this->get_field_id('image_title_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['image_title_color'] ?>" />
  </p>

</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_grayscale_images') ?>">  <?php _e('Gray Scale Images',innova)?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_grayscale_images"); ?>" name="<?php echo $this->get_field_name("enable_grayscale_images"); ?>"<?php checked( (bool) $instance["enable_grayscale_images"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_images_space') ?>">  <?php _e('Gutter',innova)?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("gallery_images_space"); ?>" name="<?php echo $this->get_field_name("gallery_images_space"); ?>"<?php checked( (bool) $instance["gallery_images_space"], true ); ?> />
  </p>

  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_image_shadow') ?>">  <?php _e('Image Shadow',innova) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("gallery_image_shadow"); ?>" name="<?php echo $this->get_field_name("gallery_image_shadow"); ?>"<?php checked( (bool) $instance["gallery_image_shadow"], true ); ?> />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('disable_light_box') ?>">  <?php _e('Disable Lightbox',innova) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_light_box"); ?>" name="<?php echo $this->get_field_name("disable_light_box"); ?>"<?php checked( (bool) $instance["disable_light_box"], true ); ?> />
  </p>
</div> 

<p>
   <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',innova) ?>  </label>
    <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
  </p> 
<?php }
 }
 innova_kaya_register_widgets('Innova_Gallery_Images_Widget', __FILE__);
?>