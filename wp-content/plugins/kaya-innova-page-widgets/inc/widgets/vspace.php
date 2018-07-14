<?php
class innova_Vspace_Widget extends WP_Widget{
   public function __construct(){

   parent::__construct(  'kaya-vspace',
      __('Innova-Vertical Space (PB)',innova),
      array( 'description' => __('Use this widget to add vertical height in between block rows',innova),'class' => 'kaya_title' )
    );

   }
    public function widget( $args , $instance ){

        echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
            'height' => '20',
         ) );
        echo '<div class="vspace" style="margin-bottom: '.$instance['height'].'px;"> </div>';
        echo  $args['after_widget'];

    }
    public function form( $instance ){

        $instance = wp_parse_args( $instance, array(
            'height' => '30',
        ) );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height',innova) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="widefat" value="<?php echo $instance['height'] ?>" />
        </p>

<?php  }
 }
 innova_kaya_register_widgets('innova_Vspace_Widget', __FILE__);

?>