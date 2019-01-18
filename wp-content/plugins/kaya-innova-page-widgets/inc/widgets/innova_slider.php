<?php
class innova_Slider_Widget extends WP_Widget{
       public function __construct(){
  global $innova_plugin_name; 
   parent::__construct(  'kaya-slider',
      __('Innova-Slider (PB)',innova),
      array( 'description' => __('Displays slider from Kaya slider category', innova) ,'class' => 'kaya_slider' )
    );

   }
   public function widget( $args , $instance ){
      global $innova_plugin_name; 
          wp_enqueue_script('jquery_owlcarousel');
      wp_enqueue_style('css_owl.carousel');
      echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
              'slide_caption' => '',
              'slider_height' =>'450',
              'slider_cat' => '',
              'slide_link' => '',
              'slider_navigation_color' =>'',
              'slider_pause_time' => '4000',
              'slider_navigation_bg_color' =>'#ed4e6e',
              'slider_navigation_text_color' =>'#ffffff',
              'slider_navigation_bg_hover_color' =>'#ffffff',
              'slider_navigation_text_hover_color' =>'#ed4e6e',
              'adaptive_height' => __('false',innova),
              'slide_auto_play' => __('true',innova),
              'slider_width' => '1100'
         ) );       

  $slide_random = rand(1,50);  ?>
  <style type="text/css">
        .owlslider<?php echo $slide_random; ?>{
          display: none;
        }
        #kaya_slider_wrapper .owl-prev{
        background-color: <?php echo $instance['slider_navigation_bg_color']; ?>!important;
        color: <?php echo $instance['slider_navigation_text_color']; ?>!important;
        }
        #kaya_slider_wrapper .owl-prev:hover{
        background-color: <?php echo $instance['slider_navigation_bg_hover_color']; ?>!important;
        color: <?php echo $instance['slider_navigation_text_hover_color']; ?>!important;
        }
        #kaya_slider_wrapper .owl-next{
        background-color: <?php echo $instance['slider_navigation_bg_color']; ?>!important;
        color: <?php echo $instance['slider_navigation_text_color']; ?>!important;
        }
        #kaya_slider_wrapper .owl-next:hover{
        background-color: <?php echo $instance['slider_navigation_bg_hover_color']; ?>!important;
        color: <?php echo $instance['slider_navigation_text_hover_color']; ?>!important;
        }
  </style>
  <script type="text/javascript">
  (function($) {
    "use strict";
    $(window).load(function() {
      $('.owlslider<?php echo $slide_random; ?>').owlCarousel({
      nav : true,
      navText : ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
      stopOnHover : true,
      margin : 15,
      autoplay : <?php echo $instance['slide_auto_play']; ?>,
      slideSpeed :1500 ,
      items : 1,
        onInitialized: function() { 
         $('.owlslider<?php echo $slide_random; ?>').css('display', 'block');
          $('.slider_bg_loading_img').hide();
         },
      });
      });
    })(jQuery);  
     
  </script> 
  <div id="kaya_slider_wrapper">
    <?php echo '<span class="slider_bg_loading_img container" style="height:400px; background:url('.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/bx_loader.gif)"></span>'; ?>
     <ul class="owlslider<?php echo $slide_random; ?>"  class="slider_wrap">
      <?php
      
 $array_val = ( !empty( $instance['slider_cat'] )) ? explode(',',  $instance['slider_cat']) : '';
if( $array_val ) {
          $loop = new WP_Query(array( 'post_type' => 'slider',  'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC',  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'slider_category',   'field' => 'id', 'terms' => $array_val  ), )));
          }else{
             $loop = new WP_Query(array('post_type' => 'slider', 'taxonomy' => 'slider_category','term' => $instance['slider_cat'], 'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC'));
          }
      if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <li>
            <?php
            global $post;

  $slider_link=get_post_meta(get_the_ID(),'customlink' ,true);
  $slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
  $slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
  $slider_target_link= get_post_meta($post->ID,'slider_target_link',true);
  $slide_description= get_post_meta($post->ID,'slide_description',true);
  $slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
  $disable_slide_content = get_post_meta($post->ID,'disable_slide_content',true);
  if( $slider_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
    if($slider_link){
           echo '<a href="'.$slider_imglink.'" '.$target_link_class.' >';
    }
             global $post;
             $slider_img_width =  $instance['slider_width'] ? $instance['slider_width'] : '1160';       
             $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL
             if( $img_url ):
                 $height = ( $instance['adaptive_height'] == 'true' ) ? '' : $instance['slider_height'];
                 echo '<img src="'.kaya_image_resize( $img_url, $slider_img_width, $height, true ).'" class="" alt="'.get_the_title().'"  />';
             else:
                  echo '<img src="'.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/widget_slider_img.jpg" style="width:'.$slider_img_width.'px; height:'.$instance['slider_height'].'px;" alt="'.get_the_title().'" >';
             endif;
           echo '</a>';
         if($disable_slide_content == "0") { ?>
               <div class="caption">
                    <h4 style="color:<?php echo $slide_text_color; ?>"><?php echo the_title(); ?></h4>
              </div>
          <?php } ?>
         <?php endwhile; // End the loop. Whew. ?>
      </li>
      <?php else :
          echo '<li><img src="'.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/widget_slider_img.jpg" width="100%" height="400"  alt="'.get_the_title().'" ></li>';
       endif; ?>
      </ul>
    </div>
    <?php wp_reset_query(); ?>
    <div class="clear"></div>
    <?php     echo  $args['after_widget'];
       }

public function form( $instance ){
        $kaya_terms=  get_terms('slider_category','');
     if( $kaya_terms ){   
      foreach ($kaya_terms as $kaya_term) { 
        $kaya_cats_name[] = $kaya_term->name.'- '. $kaya_term->term_id;
        $kaya_cats_id[] = $kaya_term->term_id;
      } $slider_items = implode(',', $kaya_cats_id); }else{ $kaya_cats_name[] = '';  $slider_items = '';}
        $instance = wp_parse_args( $instance, array(
              'slide_caption' => '',
              'slider_height' =>'450',
              'slider_cat' => $slider_items,
              'slide_link' => '',
              'slider_navigation_color' =>'',
              'slider_pause_time' => '4000',
              'slider_navigation_bg_color' =>'#ed4e6e',
              'slider_navigation_text_color' =>'#ffffff',
              'slider_navigation_bg_hover_color' =>'#ffffff',
              'slider_navigation_text_hover_color' =>'#ed4e6e',
              'adaptive_height' => __('false',innova),
              'slide_auto_play' => __('true',innova),
              'slider_width' => '1100'
        ) );
        ?>
  <script type='text/javascript'>
    jQuery(document).ready(function($) {
      jQuery('.owlslider_color_pickr').each(function(){
      jQuery(this).wpColorPicker();
      }); 
    });
  </script> 
    <div class="input-elements-wrapper"> 
    <p>
    <label for="<?php echo $this->get_field_id('slider_cat') ?>">   <?php _e('Enter Kaya Slider Category IDs : ',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_cat') ?>" id="<?php echo $this->get_field_id('slider_cat') ?>" class="widefat" value="<?php echo $instance['slider_cat'] ?>" />
    <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong> <?php echo implode(', ', $kaya_cats_name); ?></em><br />
    <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
    </p>
  </div>
   <div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_width') ?>">
    <?php _e('Slider Width',innova) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_width') ?>" id="<?php echo $this->get_field_id('slider_width') ?>" class="small-text" value="<?php echo $instance['slider_width'] ?>" />
  <small><?php _e('px') ?></small></p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_height') ?>">
    <?php _e('Slider Height (px)',innova) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_height') ?>" id="<?php echo $this->get_field_id('slider_height') ?>" class="widefat" value="<?php echo $instance['slider_height'] ?>" />
    <small>
    <?php _e('Ex: 400<br /> Note: It works only when auto height is false',innova); ?>
    </small> </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slide_auto_play') ?>">
    <?php _e('Auto Play',innova)?>
    </label>
    <select id="<?php echo $this->get_field_id('slide_auto_play') ?>" name="<?php echo $this->get_field_name('slide_auto_play') ?>">
      <option value="true" <?php selected('true', $instance['slide_auto_play']) ?>>
      <?php esc_html(_e('True', innova)); ?>
      </option>
      <option value="false" <?php selected('false', $instance['slide_auto_play']) ?>>
      <?php esc_html(_e('False', innova)); ?>
      </option>
    </select>
  </p>
  <p class="one_fourth_last">
  <label for="<?php echo $this->get_field_id('slider_pause_time') ?>">
  <?php _e('Slide Pause Time',innova) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('slider_pause_time') ?>" id="<?php echo $this->get_field_id('slider_pause_time') ?>" class="widefat" value="<?php echo $instance['slider_pause_time'] ?>" />
  <small>
  <?php _e('The amount of time (in ms) between each auto transition , Ex: 4000',innova); ?>
  </small>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_navigation_bg_color'); ?>"><?php  _e('Slider Navigation Bg Color',innova); ?></label>
    <input id="<?php echo $this->get_field_id('slider_navigation_bg_color'); ?>" name="<?php echo $this->get_field_name
    ('slider_navigation_bg_color'); ?>" type="text" class="owlslider_color_pickr" value="<?php echo $instance
    ['slider_navigation_bg_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_navigation_text_color'); ?>"><?php  _e('Slider Navigation Text Color',innova); ?></label>
    <input id="<?php echo $this->get_field_id('slider_navigation_text_color'); ?>" name="<?php echo $this->get_field_name
    ('slider_navigation_text_color'); ?>" type="text" class="owlslider_color_pickr" value="<?php echo $instance
    ['slider_navigation_text_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_navigation_text_hover_color'); ?>"><?php  _e('Slider Navigation Text Hover Color',innova); ?></label>
    <input id="<?php echo $this->get_field_id('slider_navigation_text_hover_color'); ?>" name="<?php echo $this->get_field_name
    ('slider_navigation_text_hover_color'); ?>" type="text" class="owlslider_color_pickr" value="<?php echo $instance
    ['slider_navigation_text_hover_color'] ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('slider_navigation_bg_hover_color'); ?>"><?php  _e('Slider Navigation Bg Hover Color',innova); ?></label>
    <input id="<?php echo $this->get_field_id('slider_navigation_bg_hover_color'); ?>" name="<?php echo $this->get_field_name
    ('slider_navigation_bg_hover_color'); ?>" type="text" class="owlslider_color_pickr" value="<?php echo $instance
    ['slider_navigation_bg_hover_color'] ?>" />
  </p>
  </div>
  <div class="input-elements-wrapper">
  <p class="one_third">
    <label for="<?php echo $this->get_field_id('adaptive_height') ?>">
    <?php _e('Auto Height',innova)?>
    </label>
    <select id="<?php echo $this->get_field_id('adaptive_height') ?>" name="<?php echo $this->get_field_name('adaptive_height') ?>">
      <option value="true" <?php selected('true', $instance['adaptive_height']) ?>>
      <?php esc_html(_e('True', innova)); ?>
      </option>
      <option value="false" <?php selected('false', $instance['adaptive_height']) ?>>
      <?php esc_html(_e('False', innova)); ?>
      </option>
    </select>
  </p>
  </div>
<?php  }
 }
 innova_kaya_register_widgets('innova_Slider_Widget', __FILE__);
?>