<?php
class Innova_Info_Boxes extends WP_Widget{
  public function __construct(){
    global $innova_plugin_name;
    parent::__construct(
        'info-boxes',
          __('Innova-Info Boxes (PB)', innova), // Name
        array(
            'description' => __('Info boxes',innova) , 'class' => 'innova_class'
          )
      );
} 
public function widget( $args, $instance){
      global $innova_plugin_name;
        $instance= wp_parse_args($instance, array(
              'info_box_type' => __('success',innova),
              'info_box_content' => '',
               'animation_names' => ''
          ));
        echo $args['before_widget'];
           echo '<div class="wow '.$instance['animation_names'].' info_box '.$instance['info_box_type'].'">';
              echo $instance['info_box_content'];
    echo '<img src="'.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/'.$instance['info_box_type'].'_btn.png" class="delete">';          echo '</div>';
        echo $args['after_widget'];

    }
    public function form($instance){
      global $innova_plugin_name;
        $instance= wp_parse_args($instance, array(
              'info_box_type' => __('success',innova),
              'info_box_content' => '',
               'animation_names' => ''
          ));
      ?>
      <p> <label for="<?php echo $this->get_field_id('info_box_type') ?>"><?php _e('Info Box Type',innova) ?></label>
        <select id="<?php echo $this->get_field_id('info_box_type') ?>" name="<?php echo $this->get_field_name('info_box_type') ?>">
          <option value="success" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'success',$instance['info_box_type'] ) ?> >
            <?php esc_html(_e('Success', innova) );?></option>
          <option value="info" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'info',$instance['info_box_type'] ) ?> >
            <?php esc_html(_e('Info', innova)); ?></option>
          <option value="warning" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'warning',$instance['info_box_type'] ) ?> >
            <?php esc_html(_e('Warning', innova)); ?></option>
          <option value="error" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'error',$instance['info_box_type'] ) ?> >
            <?php esc_html(_e('Error', innova) );?></option>      
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('info_box_content') ?>"><?php _e('Info Box Content',innova) ?></lable>
         <textarea type="text" id="<?php echo $this->get_field_id('info_box_content') ?>" class="widefat" name="<?php echo $this->get_field_name('info_box_content') ?>" value = "<?php echo $instance['info_box_content'] ?>" > <?php echo $instance['info_box_content'] ?></textarea>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',angel) ?>  </label>
        <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
       </p> 
<?php
    }
  }
innova_kaya_register_widgets('Innova_Info_Boxes', __FILE__);
?>