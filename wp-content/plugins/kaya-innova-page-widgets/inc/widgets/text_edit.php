<?php
class Innova_Icons_Text_Widget extends WP_Widget {
  public function __construct() { 
    // widget actual processes
    parent::__construct(

      'Innova-Icons Text-widget', // Base ID

      __('Innova-Icons Text', innova), // Name

      array( 'description' => __( 'Use this widget to create Font Awesome icons', innova ), ) // Args
    );
  }
  public function widget( $args, $instance ) {

    echo $args['before_widget'];
  $instance = wp_parse_args( $instance, array(
        'awesome_icon_name' => '',
        'icon_bg_color'=>'',
        'icon_link_color' => '#ffffff',
        'icon_link_hover_color' =>'#dd9933',
        'icon_border_radius' => '100',
        'icon_border_color'=>'#ffffff',
        'title'=>__('Enter title here',innova),
        'description' =>__('Enter description here',innova),
        'title_color'=>'#a6afb5',
        'description_color'=>'#ffffff',
        'title_font_size'=>'18',
        'description_font_size'=>'10',
        'title_font_weight'  => 'bold',

    ) ); 
    $social_icon =rand(1,500); ?>
    <style type="text/css">
            .social_media_icons_<?php echo $social_icon; ?> a{
              background-color:<?php echo $instance['icon_bg_color']; ?>!important;
              color:<?php echo $instance['icon_link_color']; ?>!important;
            }
            .social_media_icons_<?php echo $social_icon; ?> a:hover{
              color:<?php echo $instance['icon_link_hover_color']; ?>!important;
            }     
            .social_media_icons_<?php echo $social_icon; ?> a{
              border:2px solid <?php echo $instance['icon_border_color'] ?>;
            }
      </style>
  <div class="social_icons social_media_icons_<?php echo $social_icon; ?>"> 
  <?php
    echo '<a href="'.esc_url($instance['link']).'" style="border-radius:'.$instance['icon_border_radius'].'%;" ><i class="fa '.$instance['awesome_icon_name'].'" > </i></a>'; ?>
     <div class="description">
    <?php echo '<h1 style="color:'.$instance['title_color'].'!important; font-size:'.$instance['title_font_size'].'px!important;font-weight:'.
    $instance['title_font_weight'].'">'.$instance['title'].'</h1>' ?>
     <?php echo '<p style="color:'.$instance['description_color'].'!important; font-size:'.$instance['description_font_size'].'px!important;">'.$instance['description'].'</p>' ?>
    </div>
  </div>
<?php echo $args['after_widget'];
  }
  public function form( $instance ) {
 
    $instance = wp_parse_args( $instance, array(
        'awesome_icon_name' => '',
        'icon_bg_color'=>'',
        'icon_link_color' => '#ffffff',
        'icon_link_hover_color' =>'#dd9933',
        'icon_border_radius' => '100',
        'icon_border_radius_color'=>'#ffffff',
        'title'=>__('Enter title here',innova),
        'description' =>__('Enter description here',innova),
        'title_color'=>'#a6afb5',
        'description_color'=>'#ffffff',
        'title_font_size'=>'18',
        'description_font_size'=>'10',
        'title_font_weight'  => 'bold',

    ) );
    ?>
   <script type='text/javascript'>
    (function( $ ) {
    "use strict";
      $('.pf_color_pickr').each(function(){
        $(this).wpColorPicker();
      });
    })(jQuery);
  </script>
  <div class="input-elements-wrapper">
    <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('awesome_icon_name') ?>">
    <?php _e('Awesome Icon Name',innova) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('awesome_icon_name') ?>" name="<?php echo $this->get_field_name('awesome_icon_name') ?>" value="<?php echo esc_attr($instance['awesome_icon_name']) ?>" />
    <small>
    <?php _e('Ex: fa-home, for More Awesome icons click',innova); ?>
    <a href='http://fontawesome.io/icons/' target='_blank'> click here </a></small> 
     </p>
    <p class="one_fourth">
  <label for="<?php echo $this->get_field_id('link') ?>">
  <?php _e('Link','') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" name="<?php echo $this->get_field_name('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" />
  <small>
  <?php _e('Ex:http://www.facebook.com','') ?>
  </small> 
   </p>
  </div>
  <div class="input-elements-wrapper">
  <p>
  <label for="<?php echo $this->get_field_id('icon_bg_color') ?>">
  <?php _e('Icon Bg Color','') ?>
  </label>
  <input type="text" class="pf_color_pickr" id="<?php echo $this->get_field_id('icon_bg_color') ?>" name="<?php echo $this->get_field_name('icon_bg_color') ?>" value="<?php echo esc_attr($instance['icon_bg_color']) ?>" />
  </p>
  </div>
<?php
  }
}
innova_kaya_register_widgets('Innova_Icons_Text_Widget', __FILE__);
?>