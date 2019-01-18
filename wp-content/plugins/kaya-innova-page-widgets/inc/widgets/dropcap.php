<?php
class innova_Dropcap_Widget extends WP_Widget {
  public function __construct() {
    // widget actual processes
    parent::__construct(
      'dropcap-widget', // Base ID
      __('Innova-Dropcap (PB)', innova), // Name
      array( 'description' => __( 'Use this widget to create drop cap with text or Font Awesome icons', innova ), ) // Args
    );
  }
  public function widget( $args, $instance ) {
  echo $args['before_widget'];
  $instance = wp_parse_args( $instance, array(
        'title' => __('Dropcap Title',innova),
        'dropcap_text' => 'A',
        'dropcap_bg_color' => '#ffffff',
        'description' => __('Enter Description Here',innova),
        'readmore_text' => '',
        'link' => '#',
        'disable_dropcap_link' => '',
        'dropcap_color' => '#333333',
        'title_color' => '#333333',
        'description_color' => '#787878',
        'dropap_align' => __('center',innova),
        'awesome_icon_name' => '',
        'dropap_font_size' => '',
        'text_wrap' => __('false',innova),
        'border_radius' => '',
        'border_color' => '#000000',
        'animation_names' => '',
    ) ); 
  $dropcap_rand = rand(1,500);
  if( $instance['dropcap_bg_color'] ):
    ?>
      <style type="text/css">
            .dropca-<?php echo $dropcap_rand; ?> .dropcap_bg:hover, .dropca-<?php echo $dropcap_rand; ?> .dropcap_bg:hover {
                background-color: <?php echo $instance['dropcap_color']; ?>!important;
                color: <?php echo $instance['dropcap_bg_color']; ?>!important;
            }
          .dropcap a:hover{
            opacity: 0.8!important;
          }
      </style>
  <?php 
  endif;
 if($instance['dropcap_bg_color'] || $instance['border_color'] ): 

  $padding = round($instance['dropap_font_size'] / 4).'px';
else:
  $padding = '0';

endif;

if($instance['border_color']){

  $border_color = '1px solid '.$instance['border_color'];

  $border_shadow = '0px 3px 0px 0px '.$instance['border_color'];

}else{ $border_color = '0px solid '.$instance['border_color']; $border_shadow =''; }

 $line_height = round($instance['dropap_font_size'] /2 ).'px';

 $text_wrap = $instance['text_wrap'] == 'true' ? 'inherit' : 'hidden';

 $icon_size = round($instance['dropap_font_size'] / 2);

  $dropcap_data = array(

      'width' => round( $instance['dropap_font_size'] / 2 ).'px',

      'height' => round( $instance['dropap_font_size'] / 2).'px',
     'line-height' => $line_height,
      'font-size' => $icon_size.'px',
      'background-color' => $instance['dropcap_bg_color'],
      'color' => $instance['dropcap_color'].'',
      'padding' =>  $padding,
      'border' => $border_color,
      'border-radius' => $instance['border_radius'].'%',
  );

   $dropcap_styles =array();

    foreach ($dropcap_data as $key => $value) {

       $dropcap_styles[] = $key.':'.$value;
   }
   ?>

<div class="dropcap dropcap_<?php echo $instance['dropap_align']; ?> dropca-<?php echo $dropcap_rand; ?>" > 
  <?php if($instance['disable_dropcap_link'] != 'on' ): ?>
    <a href="<?php echo esc_url($instance['link']); ?>" >
     <?php endif; ?>
    <?php if( $instance['awesome_icon_name'] || $instance['dropcap_text']  ){ 
     ?>
    <div class="dropcap_bg align<?php echo $instance['dropap_align']; ?>  <?php echo $this->get_field_id('dropcap_bg_color') ?>" style="<?php echo  implode('; ',$dropcap_styles); ?>">
    <?php
          if( $instance['awesome_icon_name'] ){
               echo ' <i class="fa '.$instance['awesome_icon_name'].'" > </i>';
          }else {   ?>
            <strong style="font-weight:blod;"><?php echo $instance['dropcap_text']; ?></strong>
      <?php  } ?>
      </div>
     <?php } ?> 
<?php if( $instance['link'] ){ ?> 
</a> 
<?php } ?>

  <div class="description" style="overflow:<?php echo $text_wrap; ?>">
     <?php if( $instance['link'] ){ ?>
    <a href="<?php echo esc_url($instance['link']); ?>" >
    <?php } ?>
      <h3 style="color:<?php echo $instance['title_color']; ?>!important; text-align:<?php echo $instance['dropap_align']; ?>"><?php echo $instance['title']; ?></h3>
    <?php if( $instance['link'] ){ ?> </a> <?php } ?>
    <p style="color:<?php echo $instance['description_color']; ?>!important; text-align:<?php echo $instance['dropap_align']; ?>"><?php echo $instance['description']; ?></p>
    <?php if( $instance['readmore_text'] ): echo '<a href="'.esc_url($instance['link']).'" class="readmore readmore-1">'.esc_attr($instance['readmore_text']).'</a>'; endif;  ?>
  </div>
</div>


<?php echo $args['after_widget'];
  }
  public function form( $instance ) {

    $instance = wp_parse_args( $instance, array(

       'title' => __('Dropcap Title',innova),
        'dropcap_text' => 'A',
        'dropcap_bg_color' => '#343434',
        'description' => __('Enter Description Here',innova),
        'readmore_text' => '',
        'link' => '#',
        'disable_dropcap_link' => '',
        'dropcap_color' => '#ffffff',
        'title_color' => '#343434',
        'description_color' => '#666666',
        'dropap_align' => __('center',innova),
        'awesome_icon_name' => '',
        'dropap_font_size' => '',
        'text_wrap' => __('false',innova),
        'border_radius' => '100',
        'border_color' => '#333',
        'animation_names' => '',
    ) );
    $font_sizes = array(16,24,32,48,64,128);
    ?>
 <script type='text/javascript'>
    jQuery(document).ready(function($) {
      jQuery('.dropcap_color_pickr').each(function(){
        jQuery(this).wpColorPicker();
      }); 
    });
  </script> 
    <div class="input-elements-wrapper">
<p>
  <label for="<?php echo $this->get_field_id('awesome_icon_name') ?>">
  <?php _e('Awesome Icon Name',innova) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('awesome_icon_name') ?>" name="<?php echo $this->get_field_name('awesome_icon_name') ?>" value="<?php echo esc_attr($instance['awesome_icon_name']) ?>" />
  <small>
  <?php _e('Ex: fa-home, for More Awesome icons click',innova); ?>
  <a href='http://fontawesome.io/icons/' target='_blank'> click here </a></small> </p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('dropcap_text') ?>">
  <?php _e('Enter Dropcap Text',innova) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('dropcap_text') ?>" name="<?php echo $this->get_field_name('dropcap_text') ?>" value="<?php echo esc_attr($instance['dropcap_text']) ?>" />
  <small>
  <?php _e('Ex: A  <stong> Note: </strong>It Works only when above icon name field is empty ',innova) ?>
  </small> </p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('dropap_font_size') ?>">
  <?php _e('Dropcap Size',innova)?>
  </label>
  <select id="<?php echo $this->get_field_id('dropap_font_size') ?>" name="<?php echo $this->get_field_name('dropap_font_size') ?>">
    <?php  foreach ($font_sizes as $font_size) {
             echo '<option value="' .$font_size. '"  id="' .$font_size. '"',  $instance['dropap_font_size'] == $font_size  ? 'selected = "selected"' : '',' >'.$font_size.'</option>';
            }?>
  </select>
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('border_radius') ?>">
  <?php _e('Dropcap Border Radius ( % )',innova) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('border_radius') ?>" name="<?php echo $this->get_field_name('border_radius') ?>" value="<?php echo esc_attr($instance['border_radius']) ?>" />
  <small>
  <?php _e('Ex:10,20 <stont> Note: </stong>It applies only percentage(%)',innova) ?>
  </small> </p>
<p class="one_fourth_last">
  <label for="<?php echo $this->get_field_id('dropap_align') ?>">
  <?php _e('Dropcap Position',innova)?>
  </label>
  <select id="<?php echo $this->get_field_id('dropap_align') ?>" name="<?php echo $this->get_field_name('dropap_align') ?>">
    <option value="left" <?php selected('left', $instance['dropap_align']) ?>>
    <?php esc_html(_e('Position Left',innova)); ?>
    </option>
    <option value="right" <?php selected('right', $instance['dropap_align']) ?>>
    <?php esc_html(_e('Position Right', innova)); ?>
    </option>
    <option value="center" <?php selected('center', $instance['dropap_align']) ?>>
    <?php esc_html(_e('Position Center',innova) );?>
    </option>
  </select>
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_third">
  <label for="<?php echo $this->get_field_id('dropcap_bg_color') ?>">
  <?php _e('Dropcap Background Color',innova) ?>
  </label>Button Text 
  <input type="text" class="dropcap_color_pickr" id="<?php echo $this->get_field_id('dropcap_bg_color') ?>" name="<?php echo $this->get_field_name('dropcap_bg_color') ?>" value="<?php echo esc_attr($instance['dropcap_bg_color']) ?>" />
</p>
<p class="one_third">
  <label for="<?php echo $this->get_field_id('dropcap_color') ?>">
  <?php _e('Dropcap Text Color',innova) ?>
  </label>
  <input type="text" class="dropcap_color_pickr" id="<?php echo $this->get_field_id('dropcap_color') ?>" name="<?php echo $this->get_field_name('dropcap_color') ?>" value="<?php echo esc_attr($instance['dropcap_color']) ?>" />
</p>
<p class="one_third_last">
  <label for="<?php echo $this->get_field_id('border_color') ?>">
  <?php _e('Dropcap Border Color',innova) ?>
  </label>
  <input type="text" class="dropcap_color_pickr" id="<?php echo $this->get_field_id('border_color') ?>" name="<?php echo $this->get_field_name('border_color') ?>" value="<?php echo esc_attr($instance['border_color']) ?>" />
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('title') ?>">
  <?php _e('Title',innova) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($instance['title']) ?>" />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('title_color') ?>">
  <?php _e('Title Color',innova) ?>
  </label>
  <input type="text" class="dropcap_color_pickr" id="<?php echo $this->get_field_id('title_color') ?>" name="<?php echo $this->get_field_name('title_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" />
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('description') ?>">
  <?php  _e('Description' ,innova); ?>
  </label>
  <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" ><?php echo esc_attr($instance['description']) ?></textarea>
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('description_color') ?>">
  <?php _e('Description Color',innova) ?>
  </label>
  <input type="text" class="dropcap_color_pickr" id="<?php echo $this->get_field_id('description_color') ?>" name="<?php echo $this->get_field_name('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" />
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('readmore_text') ?>">
  <?php _e('Readmore Button Text',innova) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_text') ?>" name="<?php echo $this->get_field_name('readmore_text') ?>" value="<?php echo esc_attr($instance['readmore_text']) ?>" />
  <small>
  <?php _e('<stong>Note: </strong>Keep it empty to not display the readmore button ',innova) ?>
  </small> </p>
 <p class="one_fourth">
  <label for="<?php echo $this->get_field_id('link') ?>">
  <?php _e('Link',innova) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" name="<?php echo $this->get_field_name('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" />
  <small>
  <?php _e('Ex:http://www.google.com',innova) ?>
  </small> </p>
  <p class="one_fourth">
  <label for="<?php echo $this->get_field_id('disable_dropcap_link') ?>"><?php _e('Disable Dropcap Link',innova)?></label>&nbsp;
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_dropcap_link"); ?>" name="<?php echo $this->get_field_name("disable_dropcap_link"); ?>"<?php checked( (bool) $instance["disable_dropcap_link"], true ); ?> />
  </p>
<p class="one_fourth_last">
  <label for="<?php echo $this->get_field_id('text_wrap') ?>">
  <?php _e('Text Wrapping',innova)?>
  </label>
  <select id="<?php echo $this->get_field_id('text_wrap') ?>" name="<?php echo $this->get_field_name('text_wrap') ?>">
    <option value="true" <?php selected('true', $instance['text_wrap']) ?>>
    <?php esc_html(_e('True',innova)); ?>
    </option>
    <option value="false" <?php selected('false', $instance['text_wrap']) ?>>
    <?php esc_html(_e('False',innova) );?>
    </option>
  </select>
</p>
</div>
<?php
  }
}
innova_kaya_register_widgets('innova_Dropcap_Widget', __FILE__);
?>