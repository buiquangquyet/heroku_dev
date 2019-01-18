<?php
// List style
 class Innova_Custom_List_Box_Widget extends WP_Widget{
   public function __construct(){
     global $innova_plugin_name;
   parent::__construct(  'kaya-list-box',
      __('Innova -  List Box',$innova_plugin_name),
      array( 'description' => __('Add list items with custom icon',$innova_plugin_name), 'class' => 'kaya_list_box_widget' ));
    }
    public function widget( $args , $instance ){
      global $innova_plugin_name;
        $instance = wp_parse_args($instance, array( 
          'list_color' => '#333333',
          'list_box' => __('<ul>
                            <li>List Item - 1</li>
                            <li>List Item - 2 </li>
                            <li> List Items - 3</li>
                        </ul>',$innova_plugin_name),
          "image_uri" => '',
          'animation_names' => '',
       )); 
      $list_rand = rand(1,200);
      echo $args['before_widget'];  ?>
    <style>
    <?php   if( !empty($instance['image_uri']) ){ ?>
        .custom_list_box-<?php echo $list_rand ?> ul li {
            background-image:url('<?php echo esc_url($instance['image_uri']); ?>');
            padding: 0 0 18px 28px !important; 
            color: <?php echo $instance['list_color']; ?>;
            }
      <?php } ?>
        .custom_list_box-<?php echo $list_rand ?> ul li {
              color: <?php echo $instance['list_color']; ?>;
          }
          </style>
      <?php 
      $listbox_animation = (trim($instance['animation_names'])) ? 'wow '.$instance['animation_names'].' ' : '';
      echo '<div class="'.$listbox_animation.'">';
  
            ?>
            <div class="clear"> </div>
            <?php 
               echo '<div class="custom_list_box custom_list_box-'.$list_rand.'">';
                  echo $instance['list_box'];
               echo '</div>';
        echo '</div>';       
               echo $args['after_widget'];
          }

    public function form( $instance ){
       global $innova_plugin_name;
        $instance = wp_parse_args( $instance, array(

          'list_color' => '#333333',
          'list_box' => __('<ul>
                            <li>List Item - 1</li>
                            <li>List Item - 2 </li>
                            <li> List Items - 3</li>
                        </ul>',$innova_plugin_name),
          "image_uri" => '',
          'animation_names' => '',
        ) );

        ?>
<script type='text/javascript'>
  jQuery(document).ready(function($) {
  jQuery('.listbox_color_pickr').each(function(){
  jQuery(this).wpColorPicker();
  });
      
  });
</script>

<div class="input-elements-wrapper">    
  <p><?php $i = rand(1,100); ?>
    <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
        <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
        <input type="button" value="<?php _e( 'Upload List Image', 'themename' ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
    <script type="text/javascript">
      jQuery(document).ready( function(){
      jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
            e.preventDefault();
            var custom_uploader = wp.media({
                title: 'Custom Title',
                button: {
                    text: 'List Image Upload'
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
  <p class="three_fourth">
    <label for="<?php echo $this->get_field_id('list_box') ?>"> <?php _e('List Box',$innova_plugin_name) ?>  </label>
    <textarea type="text" id="<?php echo $this->get_field_id('list_box') ?>" class="widefat" name="<?php echo $this->get_field_name('list_box') ?>" value = "<?php echo esc_attr( $instance['list_box'] ) ?>" > <?php echo esc_attr( $instance['list_box'] ); ?></textarea>
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('list_color') ?>"> <?php _e('List Box List Color',$innova_plugin_name) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('list_color') ?>" id="<?php echo $this->get_field_id('list_color') ?>" class="listbox_color_pickr" value="<?php echo esc_attr( $instance['list_color'] ) ?>" />
  </p>
</div>
<p>
  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',$innova_plugin_name) ?>  </label>
   <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
<p> 
<?php  }
 }
  innova_kaya_register_widgets('Innova_Custom_List_Box_Widget', __FILE__);
?>