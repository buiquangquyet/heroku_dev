<?php
 class innova_Imageboxes_Widget extends WP_Widget
 {
   function __construct()
   {
     parent::__construct( 'kaya-image-boxes',

        __('Innova-Image Box (PB)',innova),
       array('description' => __('Displays image boxes',innova)  )
      );
   }
function widget( $args, $instance ){
global $innova_plugin_name;
      $instance = wp_parse_args($instance,array(
        'title' => __('Enter Title Here',innova),
        'link' => '',
        'description' => __('Enter Description Here',innova),
        "image_uri" => '',
        'description_color' => '',
        'title_color' => '',
        'title_font_size' => '',
        'title_font_weight' => '',
        'description_font_weight' =>'',
        'border_color' => '#6E6E6E',
        'imagebox_align' => '',
        'image_width' => '100',
        'image_height' => '100',
        'image_border_radius' => '',
         'readmore_text' => '',
         'animation_names' => '',

        ));
        echo $args['before_widget'];
          $animation = !empty($instance['animation_names']) ? 'wow '.$instance['animation_names'].'' : '';
            echo "<div class='".$animation." image-boxes'>"; ?>
         <div class="figure align<?php echo $instance['imagebox_align']; ?>">
        <?php 
          if( !empty($instance['link'])){ 
             echo '<a href="'.$instance['link'].'">'; 
           }  ?>
            <?php 
             $default_img_url = constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/image_box_default_img.jpg';
              if( $instance['image_uri'] ){
                echo '<img src="'.kaya_image_resize( $instance['image_uri'], $instance['image_width'], $instance['image_height'], true ).'" class="" style="border-radius:'.$instance['image_border_radius'].'px;" alt="'.$instance['title'].'"  />';
               }else{
               if (is_multisite()){
                     $image_url = $default_img_url;
                  }else{                  
                    $image_url = kaya_image_resize( $default_img_url, $instance['image_width'],  $instance['image_height'], true );
                  }
                  echo '<img src="'.$image_url.'" width="'.$instance['image_width'].'"  height="'.$instance['image_height'].'" class="" style="border-radius:'.$instance['image_border_radius'].'px;" alt="'.$instance['title'].'"  />';
               }

          if( !empty($instance['link'])){ 
            echo '</a>';
          }
          ?>
        </div>
      <?php //endif; ?>
         <?php  echo '<div class="description" style="text-align:'.$instance['imagebox_align'].'">';
          if( !empty($instance['link'])){ 
             echo '<a href="'.$instance['link'].'">'; 
           }  
           if( $instance['title'] ): echo '<h3 style="color:'.$instance['title_color'].'; font-weight:'.$instance['title_font_weight'].'; font-size:'.$instance['title_font_size'].'px!important;">'.$instance['title'].'</h3>'; endif;
            if( !empty($instance['link'])){ 
            echo '</a>';
          }
            if( $instance['description'] ):  echo '<p style="color:'.$instance['description_color'].'; font-weight:'.$instance['description_font_weight'].';">'.$instance['description'].'</p>'; endif;
           if($instance['readmore_text']){ ?>
              <a href="<?php echo $instance['link'] ?>" class="readmore readmore-1" /><?php echo $instance['readmore_text']; ?></a>
            <?php }
           echo '</div>'; 
           echo "</div>";

        echo $args['after_widget'];
    }
    function form( $instance ){
      $instance = wp_parse_args($instance, array(
        'title' => __('Image Title',innova),
        'description' => __('Enter Image Block Description here.',innova),
        'link' => '', 
        "image_uri" => '',
        'description_color' => '#666666',
        'title_color' => '#333333',
        'title_font_size' => '',
        'title_font_weight' => '',
        'description_font_weight' =>'',
        'border_color' => '#6E6E6E',
        'imagebox_align' => '',
        'image_width' => '100',
        'image_height' => '100',
        'image_border_radius' => '',
        'readmore_text' => '',
        'animation_names' => '',
        ));
        ?> 
        <script type='text/javascript'>
    (function( $ ) {
    "use strict";
      $('.imagebox_color_pickr').each(function(){
        $(this).wpColorPicker();
      });
    })(jQuery);
  </script>
         <p><?php $i = rand(1,100); ?>
      <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
      <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
      <input type="button" value="<?php _e( 'Upload Image', 'themename' ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
      <script type="text/javascript">
        jQuery(document).ready( function(){
          jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
              e.preventDefault();
              var custom_uploader = wp.media({
                  title: 'Image Box Uploading',
                  button: {
                      text: 'Upload Image'
                  },
                  multiple: false  // Set this to true to allow multiple files to be selected
              })
              .on('select', function() {
                  var attachment = custom_uploader.state().get('selection').first().toJSON();
                  jQuery('.custom_media_image_<?php echo $i; ?>').attr('src', attachment.url);
                  jQuery('.custom_media_url_<?php echo $i; ?>').val(attachment.url);
              })
              .open();
          });
          });

      </script>
  </p>
  <div class="input-elements-wrapper">
          <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('image_width') ?>"><?php _e('Image Width (px)',innova)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_width') ?>" value="<?php echo esc_attr($instance['image_width']) ?>" name="<?php echo $this->get_field_name('image_width') ?>" />
        </p>

         <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('image_height') ?>"><?php _e('Image Height (px)',innova)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_height') ?>" value="<?php echo esc_attr($instance['image_height']) ?>" name="<?php echo $this->get_field_name('image_height') ?>" />
        </p>
        <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('imagebox_align') ?>"><?php _e('Image Position',innova)?></label>
            <select id="<?php echo $this->get_field_id('imagebox_align') ?>" name="<?php echo $this->get_field_name('imagebox_align') ?>">
              <option value="left" <?php selected('left', $instance['imagebox_align']) ?>>
              <?php esc_html(_e('Position Left', innova)); ?></option>
              <option value="right" <?php selected('right', $instance['imagebox_align']) ?>>
              <?php esc_html(_e('Position Right', innova)); ?></option>
              <option value="center" <?php selected('center', $instance['imagebox_align']) ?>>
              <?php esc_html(_e('Position Center', innova)); ?></option>
              <option value="none" <?php selected('none', $instance['imagebox_align']) ?>>
              <?php esc_html(_e('None', innova)); ?></option>
            </select>
        </p>
         <p class="one_fourth_last">
            <label for="<?php echo $this->get_field_id('image_border_radius') ?>"><?php _e('Image Border Radius',innova)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_border_radius') ?>" value="<?php echo esc_attr($instance['image_border_radius']) ?>" name="<?php echo $this->get_field_name('image_border_radius') ?>" />
        </p>
      </div>
      <div class="input-elements-wrapper">
       <p class="one_fourth">
            <lable for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',innova); ?></label>
             <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
        </p>
        <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('title_colortitle_color') ?>"><?php _e('Title Color',innova)?></label>
            <input type="text" class="imagebox_color_pickr" id="<?php echo $this->get_field_id('title_colortitle_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" name="<?php echo $this->get_field_name('title_color') ?>" />
        </p>
        <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('title_font_size'); ?>"> <?php _e('Title Font Size',innova) ?> </label>
          <input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-text" value="<?php echo esc_attr( $instance['title_font_size'] ) ?>" />
          <small><?php _e('px',innova); ?></small>
        </p>
        <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('title_font_weight') ?>"> <?php _e('Title Font Weight',innova) ?></label>
    <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
      <option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>> <?php esc_html_e('Normal',innova) ?>   </option>
      <option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>>  <?php esc_html_e('Bold',innova) ?></option>
    </select>
  </p>
      </div>
      <div class="input-elements-wrapper">
        <p class="two_fourth">
            <label for="<?php echo $this->get_field_id('description') ?>"><?php _e('Description',innova)?></label>
            <textarea cols="10" class="widefat" id="<?php echo $this->get_field_id('description') ?>" value="<?php echo esc_attr($instance['description']) ?>" name="<?php echo $this->get_field_name('description') ?>" ><?php echo esc_attr($instance['description']) ?></textarea>
        </p>
        <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('description_color') ?>"><?php _e('Description Color',innova)?></label>
            <input type="text" class="imagebox_color_pickr" id="<?php echo $this->get_field_id('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" name="<?php echo $this->get_field_name('description_color') ?>" />
        </p>
     <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('description_font_weight') ?>"> <?php _e('Description Font Weight',innova) ?></label>
    <select id="<?php echo $this->get_field_id('description_font_weight') ?>" name="<?php echo $this->get_field_name('description_font_weight') ?>">
      <option value="normal" <?php selected('normal', $instance['description_font_weight']) ?>> <?php esc_html_e('Normal',innova) ?>   </option>
      <option value="bold" <?php selected('bold', $instance['description_font_weight']) ?>>  <?php esc_html_e('Bold',innova) ?></option>
    </select>
  </p>
      </div>
      <div class="input-elements-wrapper">
       <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('readmore_text') ?>"><?php _e('Readmore Button Text',innova)?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_text') ?>" value="<?php echo esc_attr($instance['readmore_text']) ?>" name="<?php echo $this->get_field_name('readmore_text') ?>" />
      </p>
       <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('link') ?>"><?php _e('Image Link',innova) ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" name="<?php echo $this->get_field_name('link') ?>" />
      </p>     
     </div>
     <p>
   <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',innova) ?>  </label>
    <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
  <p> 
<?php }
 }
innova_kaya_register_widgets('innova_Imageboxes_Widget', __FILE__);
?>