<?php
class innova_Skillset_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-skillbar',
      __('Innova-Skillbar (PB)',innova),
      array( 'description' => __('Use this widget to add bar type skills',innova) ,'class' => 'kaya_skllbar' )
    );
    }
    public function widget( $args , $instance ){
      //  echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(

            'title' => __('PHP',innova),
            'skillset_width' => '60',
            'skillbar_color' => '#f54325',
             'skillbar_title_color' => '#ffffff',
             'animation_names' => '',
         ) ); ?>
         <?php  $animation = !empty($instance['animation_names']) ? 'wow '.$instance['animation_names'].'' : ''; ?>
         <div class="skillbar clearfix <?php echo $animation; ?>" data-percent="<?php echo $instance['skillset_width']; ?>%">
      <div class="skillbar-title" style="background: <?php echo $instance['skillbar_color']; ?>;">
        <span style="color:<?php echo $instance['skillbar_title_color'];?>;"><?php echo $instance['title']; ?></span></div>
      <div class="skillbar-bar" style="background: <?php echo $instance['skillbar_color']; ?>;"><span class="left_arrow" style="border-left: 8px solid <?php echo $instance['skillbar_color']; ?>;">&nbsp;</span></div>
      <div style="color:<?php echo $instance['skillbar_title_color'];?>;" class="skill-bar-percent"><?php echo $instance['skillset_width']; ?>%</div>
    </div>

    <?php }

    public function form( $instance ){

        $instance = wp_parse_args( $instance, array(

            'title' => __('PHP', innova),
           'skillset_width' => '60',
            'skillbar_color' => '#f54325',
             'skillbar_title_color' => '#ffffff',
             'animation_names' => '',
             ) );       ?>
         <script type='text/javascript'>
        jQuery(document).ready(function($) {
        jQuery('.skillbar_color_pickr').each(function(){
        jQuery(this).wpColorPicker();
        }); 
        });
        </script>
        <div class="input-elements-wrapper">
        <p class="one_half">
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Skillbar Title',innova)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $instance['title']; ?>" />
        </p>
           <p class="one_half_last">
            <label for="<?php echo $this->get_field_id('skillbar_title_color') ?>"><?php _e('Skillbar Title Color',innova)?></label>
            <input type="text" class="skillbar_color_pickr" id="<?php echo $this->get_field_id('skillbar_title_color') ?>" name="<?php echo $this->get_field_name('skillbar_title_color') ?>" value="<?php echo $instance['skillbar_title_color']; ?>" />
        </p>
      </div>
      <div class="input-elements-wrapper">
       <p class="one_half">
            <label for="<?php echo $this->get_field_id('skillset_width') ?>"><?php _e('Skillbar Width',innova)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('skillset_width') ?>" name="<?php echo $this->get_field_name('skillset_width') ?>" value="<?php echo $instance['skillset_width']; ?>" />
        </p>
         <p class="one_half_last">
            <label for="<?php echo $this->get_field_id('skillbar_color') ?>"><?php _e('Skillbar Color',innova)?></label>
            <input type="text" class="skillbar_color_pickr" id="<?php echo $this->get_field_id('skillbar_color') ?>" name="<?php echo $this->get_field_name('skillbar_color') ?>" value="<?php echo $instance['skillbar_color']; ?>" />
        </p>
      </div>
        <p>
  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',innova) ?>  </label>
    <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?></p> 
<?php  
  }
  }
 innova_kaya_register_widgets('innova_Skillset_Widget', __FILE__);
?>