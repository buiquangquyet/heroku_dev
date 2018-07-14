<?php
class innova_Property_Details_Widget extends WP_Widget{
public function __construct(){
parent::__construct(  'kaya-property-details',
__('Innova Property Details',innova),
array( 'description' => __('Use this widget to add Property details',innova) ,'class' => 'kaya_skllbar' )
);
}
public function widget( $args , $instance ){
echo $args['before_widget'];
  $instance = wp_parse_args($instance, array(
  'property_details_values' => 'Type|For Sale    
                              Price| $500000
                              Location| Fort Worth
                              Type|Mansion
                              Area|9000 Sq.Ft
                              Bedrooms| 4
                              Bathrooms|3 
                              Adress|833 Earl Freda 15643 Sussex St Livonia,MI(Michigan) 48154-1833',
  'property_title_color' => '',
  'property_description_color' => '',
   ) ); ?>
   <?php $explode_values =  kaya_explode_data(trim($instance['property_details_values']));
    $sting_vales = explode(',', trim($explode_values));
    echo '<div class="proprty_details_widget">';
    echo '<dl>';
    foreach ($sting_vales as $key => $string_values) {
      $proprty_data = explode("|", $string_values);
      $property_title_color = 'color:'.$instance['property_title_color'];
      $property_description_color = 'color:'.$instance['property_description_color'];
       echo '<dt  style="color:'.$instance['property_title_color'].'">'.$proprty_data[0].'</dt>';
        echo '<dd style="color:'.$instance['property_description_color'].'">'.$proprty_data[1].'</dd>';
       ?>
  <?php  }
    echo '</dl>';
    echo '</div>';
    ?>
  <?php  echo $args['after_widget']; ?>
<?php }

public function form( $instance ){
$instance = wp_parse_args( $instance, array(
'property_details_values' => ' Type|For Sale    
                              Price| $500000
                              Location| Fort Worth
                              Type|Mansion
                              Area|9000 Sq.Ft
                              Bedrooms| 4
                              Bathrooms|3 
                              Adress|833 Earl Freda 15643 Sussex St Livonia MI(Michigan) 48154-1833',
'property_title_color' => '',
'property_description_color' => '',
) );
?>
<script type='text/javascript'>
  jQuery(document).ready(function($) {
  jQuery('.property_details_color_pickr').each(function(){
  jQuery(this).wpColorPicker();
  });    
  });
</script>   
<div class="input-elements-wrapper">             
  <p>
    <label for="<?php echo $this->get_field_id('property_details_values'); ?>"><?php _e('Property Details',innova) ?></label>
    <textarea class="widefat" id="<?php echo $this->get_field_id('property_details_values'); ?>" name="<?php echo $this->get_field_name('property_details_values') ?>" value="<?php echo esc_attr($instance['property_details_values']) ?>" ><?php echo esc_attr($instance['property_details_values']) ?></textarea>
    </p>
    <small> <?php _e( 'Divide values with linebreaks (Enter) </small>',innova) ?>

</div> 
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('property_title_color') ?>"><?php _e('Property Title Color',innova)?></label>
    <input type="text" class="property_details_color_pickr" id="<?php echo $this->get_field_id('property_title_color') ?>" name="<?php echo $this->get_field_name('property_title_color') ?>" value="<?php echo $instance['property_title_color']; ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('property_description_color') ?>"><?php _e('Property Description Color',innova)?></label>
    <input type="text" class="property_details_color_pickr" id="<?php echo $this->get_field_id('property_description_color') ?>" name="<?php echo $this->get_field_name('property_description_color') ?>" value="<?php echo $instance['property_description_color']; ?>" />
  </p>
</div>            
<?php  }
}
 innova_kaya_register_widgets('innova_Property_Details_Widget', __FILE__);
?>