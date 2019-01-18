<?php
 class Innova_Testimonial_Slider_Widget extends WP_Widget{
   public function __construct(){
    global $innova_plugin_name;
   parent::__construct(  'kaya-testimonials_slider',
      __('innova Testimonial Slider',innova),
      array( 'description' => __('Displays testimonial slider',innova), 'class' => 'kaya_testimonial_widget' )
    );
    }
   public function widget( $args , $instance ){
        global $innova_plugin_name;
        wp_enqueue_script('jquery_owlcarousel');
        wp_enqueue_style('css_owl.carousel');
        $instance = wp_parse_args($instance, array(         
            'testimonial_slide_items' => '2',
            'link' => '#',
            'tm_bg_color' => '#EAEAEA',
            'tm_client_name_color' => '#73bf45',
            'tm_description_color' => '#757575',
            'testimonial_slide_autoplay' => 'true',
            'tm_border_color' => '#333333',
            'tm_border_icon_color' => '#333333',
            'kaya_testimonial_cat' => '',
            'tm_slider_nav_active_color' => '#73bf45',
            'tm_slider_nav_inactive_color' => '#333333',
            'animation_names' => '',
             ));
              echo $args['before_widget'];
                $tm_rand = rand(1,20);
             ?>
             <style type="text/css">
            .testimonial_wrapper-<?php echo $tm_rand; ?> h5:before{
              background:<?php echo $instance['tm_client_name_color'] ?>;
            }
           .testimonial_wrapper-<?php echo $tm_rand; ?> .owl-pagination .owl-page > span{
              border-color:<?php echo $instance['tm_slider_nav_inactive_color']; ?>
           }
            .testimonial_wrapper-<?php echo $tm_rand; ?> .owl-page.active span{
              border-color:<?php echo $instance['tm_slider_nav_active_color']; ?>
           } 
            </style>
            <?php 
            $animation = !empty($instance['animation_names']) ? 'wow '.$instance['animation_names'].'' : '';
            
             echo '<div class="'.$animation.'">';
           ?>
          <div class="clear"> </div>
          <?php
          echo '<div class="testimonial_wrapper testimonial_wrapper-'.$tm_rand.'" data-columns="'.$instance['testimonial_slide_items'].'" data-autoplay="'.$instance['testimonial_slide_autoplay'].'">';
              $array_val = ( !empty( $instance['kaya_testimonial_cat'] )) ? explode(',', $instance['kaya_testimonial_cat']) : '';
              if( $array_val ) {
                $loop = new WP_Query(array( 'post_type' => 'testimonial',  'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC',  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'testimonial_category',   'field' => 'id', 'terms' => $array_val  ), )));
                }else{
                   $loop = new WP_Query(array('post_type' => 'testimonial', 'taxonomy' => 'testimonial_category','term' => $instance['kaya_testimonial_cat'], 'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC'));
                }
              if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
              global $post;
              $t_client_link=get_post_meta(get_the_ID(),'t_client_link' ,true);
              $testimonial_description=get_post_meta(get_the_ID(),'testimonial_description',true);
              $testimonial_target_link= get_post_meta($post->ID,'testimonial_target_link',true);
              if( $testimonial_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
              echo '<div class="testimonal testimonial-'.$tm_rand.'" >';
              if( $t_client_link ): echo '<a href="'.$t_client_link.'" target="'.$target_link_class.'">'; endif;
               $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL
             if( $img_url ):
                 echo '<img src="'.kaya_image_resize( $img_url, 100, 100, 't' ).'" class="testimonial_img" alt="'.get_the_title().'"  />';
             else:        ?>
              <div class="testimonial_quote">
                <i style="border: 2px solid <?php echo $instance['tm_border_color'] ?>; color:<?php echo $instance['tm_border_icon_color'] ?>" class="fa fa-quote-left"> </i>
              </div>
            <?php endif; ?>
                   <?php if( $t_client_link ): echo '</a>'; endif;
               //echo '<div class="slider_content_wrapper">';
               echo '<div class="description">';
                if( $testimonial_description): echo '<p style="color:'.$instance['tm_description_color'].'">" '.$testimonial_description.' "</p>'; endif;
              //echo '</div> ';
              echo '<h5 style="color:'.$instance['tm_client_name_color'].'">-- '.get_the_title().'</h5>';
          echo '</div></div>';
          endwhile; wp_reset_query();  endif;
          echo '</div>';
          echo '</div>';
          echo $args['after_widget'];

    }
    public function form( $instance ){
     global $innova_plugin_name;
      $kaya_terms=  get_terms('testimonial_category','');
      if( $kaya_terms ){   
      foreach ($kaya_terms as $kaya_term) { 
        $kaya_cat_ids[] = $kaya_term->term_id;
        $kaya_cats_name[] = $kaya_term->name.' - '.$kaya_term->term_id;
      } $slider_items = implode(',', $kaya_cat_ids); }else{ $slider_items = '';  $kaya_cats_name[] =''; }
        $instance = wp_parse_args( $instance, array(
      
            'testimonial_slide_items' => '2',
            'link' => '#',
            'tm_bg_color' => '#EAEAEA',
            'tm_client_name_color' => '#73bf45',
            'tm_description_color' => '#757575',
            'testimonial_slide_autoplay' => '',
            'tm_border_color' => '#333333',
            'tm_border_icon_color' => '#333333',
            'kaya_testimonial_cat' => $slider_items,
            'tm_slider_nav_active_color' => '#73bf45',
            'tm_slider_nav_inactive_color' => '#333333',
            'animation_names' => '',
        ) );
        ?>
<script type='text/javascript'>
  jQuery(document).ready(function($) {
  jQuery('.testimonial_slider_color_pickr').each(function(){
  jQuery(this).wpColorPicker();
  });
      
  });
</script> 

<div class="input-elements-wrapper">   
  <p class="three_fourth">
    <label for="<?php echo $this->get_field_id('kaya_testimonial_cat') ?>">   <?php _e('Enter Testimonial Slider Category IDs : ',innova) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('kaya_testimonial_cat') ?>" id="<?php echo $this->get_field_id
    ('kaya_testimonial_cat') ?>" class="widefat" value="<?php echo $instance['kaya_testimonial_cat'] ?>" />
    <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?>  </strong> <?php echo implode
    (',', $kaya_cats_name); ?></em><br />
    <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('testimonial_slide_items') ?>"> <?php _e('Testimonial Slide Items',innova); ?>    </label>
    <select id="<?php echo $this->get_field_id('testimonial_slide_items') ?>" name="<?php echo $this->get_field_name
     ('testimonial_slide_items') ?>">
      <option value="1" <?php selected('1', $instance['testimonial_slide_items']) ?>>  <?php esc_html_e('1 Item', innova); ?>   </option>
      <option value="2" <?php selected('2', $instance['testimonial_slide_items']) ?>>   <?php esc_html_e('2 Items', innova); ?>  </option>
      <option value="3" <?php selected('3', $instance['testimonial_slide_items']) ?>>   <?php esc_html_e('3 Items', innova); ?>  </option>
      <option value="4" <?php selected('4', $instance['testimonial_slide_items']) ?>>   <?php esc_html_e('4 Items', innova); ?>  </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tm_border_icon_color') ?>"><?php _e('Blockquote Icon Color',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tm_border_icon_color') ?>" id="<?php echo $this->get_field_id
    ('tm_border_icon_color') ?>" class="testimonial_slider_color_pickr" value="<?php echo $instance['tm_border_icon_color'] ?>" />
    <small><?php _e('Note:It works only when featured image not set Kaya Slider (CPT)',innova) ?></small>
 </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('testimonial_slide_autoplay') ?>">   <?php _e('Auto Play',innova)?>    </label>
    <select id="<?php echo $this->get_field_id('testimonial_slide_autoplay') ?>" name="<?php echo $this->get_field_name
     ('testimonial_slide_autoplay') ?>">
      <option value="true" <?php selected('true', $instance['testimonial_slide_autoplay']) ?>> <?php esc_html_e('True', '') ?></option>
      <option value="false" <?php selected('false', $instance['testimonial_slide_autoplay']) ?>>  <?php esc_html_e('False', '') ?></option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tm_border_color') ?>"><?php _e('Border Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tm_border_color') ?>" id="<?php echo $this->get_field_id('tm_border_color') ?>" class="testimonial_slider_color_pickr" value="<?php echo $instance['tm_border_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('tm_description_color') ?>"><?php _e('Client Description Color',innova); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('tm_description_color') ?>" id="<?php echo $this->get_field_id
  ('tm_description_color') ?>" class="testimonial_slider_color_pickr" value="<?php echo $instance['tm_description_color'] ?>"  />
  <small><?php _e('Note:It works only when featured image not set from "Kaya Slider (CPT)"',innova) ?></small>
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('tm_client_name_color') ?>"><?php _e('Client Name Color',innova); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('tm_client_name_color') ?>" id="<?php echo $this->get_field_id
  ('tm_client_name_color') ?>" class="testimonial_slider_color_pickr" value="<?php echo $instance['tm_client_name_color'] ?>" 
  />
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('tm_slider_nav_inactive_color') ?>"><?php _e('Slider Navigation Inactive Border Color',innova); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('tm_slider_nav_inactive_color') ?>" id="<?php echo $this
  ->get_field_id('tm_slider_nav_inactive_color') ?>" class="testimonial_slider_color_pickr" value="<?php echo $instance['tm_slider_nav_inactive_color'] ?>"  />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('tm_slider_nav_active_color') ?>"><?php _e('Slider Navigation Active Border Color',innova); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('tm_slider_nav_active_color') ?>" id="<?php echo $this->get_field_id('tm_slider_nav_active_color') ?>" class="testimonial_slider_color_pickr" value="<?php echo $instance['tm_slider_nav_active_color'] ?>" />
</p>
</div>
<p>
  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',innova) ?> 
  </label>
 <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
 <p>
<?php  }
 }
 innova_kaya_register_widgets('Innova_Testimonial_Slider_Widget', __FILE__);
?>