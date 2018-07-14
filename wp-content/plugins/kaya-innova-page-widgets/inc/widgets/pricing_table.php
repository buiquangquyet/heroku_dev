<?php
class Innova_Pricing_Table extends WP_Widget{
  public function __construct(){
    parent::__construct(
      'innova-pricing-table',
      __('Innova Pricing Table',innova),
      array('description' => __('Pricing Table ',innova))
      );
  }
  public function widget($args, $instance){
      $instance = wp_parse_args($instance, array(
          'pricing_content' => __('<ul><li>Price Text-1</li><li>Price Text-2</li></ul>',innova),
          'pricing_title' => __('Price Title',innova),
          'price' => '$45',
          'price_description' => __('Per Month',innova),
          'button_text' => __('Signup',innova),
          'button_link' => '#',
          'pricing_bg_color' => '#FF9D01',
          'pricing_text_color' => '#333333',
          'pricing_content_li_odd_bg' => '#F8F7DC ',
          'pricing_content_li_odd_color' => '#333333',
          'pricing_content_li_even_bg' => '#ffffff',
          'pricing_content_li_even_color' => '#333333', 
           'animation_names' => '',           
        ));
      $li_rand_color = rand(1,100); ?>
        <style>
        .even-odd-li-<?php echo $li_rand_color; ?> li:nth-child(odd){
              background-color: <?php echo $instance['pricing_content_li_odd_bg'] ?>;
              color: <?php echo $instance['pricing_content_li_odd_color'] ?>;
        }
        .even-odd-li-<?php echo $li_rand_color; ?> li:nth-child(even){
              background-color: <?php echo $instance['pricing_content_li_even_bg'] ?>;
              color: <?php echo $instance['pricing_content_li_even_color'] ?>;
        }
        </style>
      <?php echo $args['before_widget'];
       $pricing_table_animation = (trim($instance['animation_names'])) ? 'wow '.$instance['animation_names'].' ' : '';
      echo '<div class="'.$pricing_table_animation.'">';
       // echo 'testing pricing table content'; 
        echo '<div class="pricing_table">';
            if( $instance['pricing_title'] ): 
              echo '<div class="pricing_header" style="background-color:'.$instance['pricing_bg_color'].';">';
                echo '<h3><strong style="color:'.$instance['pricing_text_color'].';">'.$instance['pricing_title'] .'</strong></h3>';
              echo '</div>'; 
            endif; 
            if( $instance['price'] || $instance['price_description'] ):
              echo '<div class="price" style="background-color:'.$instance['pricing_bg_color'].';">';
                if( $instance['price'] ): echo '<h1 style="color:'.$instance['pricing_text_color'].';">'.$instance['price'].'</h1>'; endif;
                if( $instance['price_description'] ): echo '<em style="color:'.$instance['pricing_text_color'].';">'.$instance['price_description'].'</em>'; endif;
              echo '</div>'; 
            endif;
            if( $instance['pricing_content'] ):
                echo '<div class="pricing_content even-odd-li-'.$li_rand_color.'">';
                  echo $instance['pricing_content']; 
                echo '</div>';
            endif;    
            if( $instance['button_text'] ):
              echo '<div class="pricing_footer" style="background-color:'.$instance['pricing_bg_color'].';"><a class="read_more" href="'.$instance['button_link'].'">'.$instance['button_text'].'</a></div>';
            endif;
          echo '</div>';
          echo '</div>';
          echo $args['after_widget'];
  }
  public function form($instance){
         $instance = wp_parse_args($instance, array(
          'pricing_content' => __('<ul><li>Price List-1</li><li>Price List-2</li></ul>',innova),
          'pricing_title' => __('Price Title',innova),
          'price' => '$45',
          'price_description' => __('Per Month',innova),
          'button_text' => __('Signup',innova),
          'button_link' => '#',
          'pricing_bg_color' => '#FF9D01',
          'pricing_text_color' => '#333333',
          'pricing_content_li_odd_bg' => '#F8F7DC ',
          'pricing_content_li_odd_color' => '#333333',
          'pricing_content_li_even_bg' => '#ffffff',
          'pricing_content_li_even_color' => '#333333',
           'animation_names' => '',
        )); ?>
        <script type='text/javascript'>
    jQuery(document).ready(function($) {
      jQuery('.pricing_table_color_pickr').each(function(){
      jQuery(this).wpColorPicker();
      }); 
    });
  </script>
  <div class="input-elements-wrapper">
    <p class="one_third">
      <label for="<?php echo $this->get_field_id('pricing_title') ?>"><?php _e('Pricing Title',innova) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_title') ?>" name="<?php echo $this->get_field_name('pricing_title') ?>" value="<?php echo esc_attr($instance['pricing_title']) ?>">
      <small><?php _e('Ex:Basic, Premium, Standard',innova) ?></small>     
    </p>  
    <p class="one_third">
      <label for="<?php echo $this->get_field_id('price') ?>"><?php _e('Price',innova) ?></label>
      <input class="small-text" type="text" id="<?php echo $this->get_field_id('price') ?>" name="<?php echo $this->get_field_name('price') ?>" value="<?php echo esc_attr($instance['price']) ?>"> 
      <small><?php _e('Ex:$45, $61.5',innova) ?></small>     
    </p> 
    <p class="one_third_last">
      <label for="<?php echo $this->get_field_id('price_description') ?>"><?php _e('Price Description',innova) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('price_description') ?>" name="<?php echo $this->get_field_name('price_description') ?>" value="<?php echo esc_attr($instance['price_description']) ?>">
      <small><?php _e('Ex:Per Month, Per Year',innova) ?></small>    
    </p>
  </div>
    <p>
      <label for="<?php echo $this->get_field_id('pricing_content') ?>"><?php _e('Pricing Content',innova) ?></label>
      <textarea cols="10" class="widefat" id="<?php echo $this->get_field_id('pricing_content') ?>" value="<?php echo esc_attr($instance['pricing_content']) ?>" name="<?php echo $this->get_field_name('pricing_content') ?>" ><?php echo esc_attr($instance['pricing_content']) ?></textarea>
      <small><?php _e('Note: Pricing content add ul li only',innova) ?></small>
    </p>
    <div class="input-elements-wrapper">
    <p class="one_half">
      <label for="<?php echo $this->get_field_id('button_text') ?>"><?php _e('Signup Button Text',innova) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('button_text') ?>" name="<?php echo $this->get_field_name('button_text') ?>" value="<?php echo esc_attr($instance['button_text']) ?>">    
      <small><?php _e('Ex: Signup',innova) ?></small>  
    </p>
    <p class="one_half_last">
      <label for="<?php echo $this->get_field_id('button_link') ?>"><?php _e('Signup Button Link',innova) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('button_link') ?>" name="<?php echo $this->get_field_name('button_link') ?>" value="<?php echo esc_attr($instance['button_link']) ?>">
      <small><?php _e('Ex: http://www.google.com',innova) ?></small>     
    </p>
    </div>
    <div class="input-elements-wrapper">
    <p class="one_third">
      <label for="<?php echo $this->get_field_id('pricing_bg_color') ?>"><?php _e('Pricing Box BG Color',innova) ?></label>
      <input class="pricing_table_color_pickr" type="text" id="<?php echo $this->get_field_id('pricing_bg_color') ?>" name="<?php echo $this->get_field_name('pricing_bg_color') ?>" value="<?php echo esc_attr($instance['pricing_bg_color']) ?>">    
    </p>
    <p class="one_third">
      <label for="<?php echo $this->get_field_id('pricing_text_color') ?>"><?php _e('Pricing Box Text Color',innova) ?></label>
      <input class="pricing_table_color_pickr" type="text" id="<?php echo $this->get_field_id('pricing_text_color') ?>" name="<?php echo $this->get_field_name('pricing_text_color') ?>" value="<?php echo esc_attr($instance['pricing_text_color']) ?>">
    </p>
    <p class="one_third_last">
      <label for="<?php echo $this->get_field_id('pricing_content_li_odd_bg') ?>"><?php _e('Price Content Odd BG Color',innova) ?></label>
      <input class="pricing_table_color_pickr" type="text" id="<?php echo $this->get_field_id('pricing_content_li_odd_bg') ?>" name="<?php echo $this->get_field_name('pricing_content_li_odd_bg') ?>" value="<?php echo esc_attr($instance['pricing_content_li_odd_bg']) ?>">    
    </p>
  </div>
  <div class="input-elements-wrapper">
        <p class="one_third">
      <label for="<?php echo $this->get_field_id('pricing_content_li_odd_color') ?>"><?php _e('Price Content Odd Text Color',innova) ?></label>
      <input class="pricing_table_color_pickr" type="text" id="<?php echo $this->get_field_id('pricing_content_li_odd_color') ?>" name="<?php echo $this->get_field_name('pricing_content_li_odd_color') ?>" value="<?php echo esc_attr($instance['pricing_content_li_odd_color']) ?>">    
    </p>
        <p class="one_third">
      <label for="<?php echo $this->get_field_id('pricing_content_li_even_bg') ?>"><?php _e('Price Content Even BG Color',innova) ?></label>
      <input class="pricing_table_color_pickr" type="text" id="<?php echo $this->get_field_id('pricing_content_li_even_bg') ?>" name="<?php echo $this->get_field_name('pricing_content_li_even_bg') ?>" value="<?php echo esc_attr($instance['pricing_content_li_even_bg']) ?>">    
  
    </p>
      <p class="one_third_last">
      <label for="<?php echo $this->get_field_id('pricing_content_li_even_color') ?>"><?php _e('Price Content Even Text Color',innova) ?></label>
      <input class="pricing_table_color_pickr" type="text" id="<?php echo $this->get_field_id('pricing_content_li_even_color') ?>" name="<?php echo $this->get_field_name('pricing_content_li_even_color') ?>" value="<?php echo esc_attr($instance['pricing_content_li_even_color']) ?>">      
    </p>
  </div>
    <p>
  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',
  innova) ?>  </label>
   <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
</p>
<?php }
}
innova_kaya_register_widgets('Innova_Pricing_Table', __FILE__);
?>