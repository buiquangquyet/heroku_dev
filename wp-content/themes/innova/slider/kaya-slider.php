<?php
// Slider Settings
if( !function_exists('kaya_image_slider') ) :
function kaya_image_slider(){
global $post;
 if( class_exists('woocommerce') ){
  if( is_shop() ){
      $post_id = wc_get_page_id('shop');
  } else{
    $post_id = $post->ID;
  } }else{
    $post_id = $post->ID;
  }
$kaya_options = get_option('kayapati');
$slider=get_post_meta($post_id,'slider',true);
	if( $slider == 'none' || $slider == ''){ }
 		else {
			
			if($slider=="bxslider"){
				get_template_part('slider/bx','slider');
			}
			if($slider=="fluidslider"){
				get_template_part('slider/super','slider');
			}
			elseif($slider=="customslider"){
				get_template_part('slider/custom','slider');
			}
			
			else{ }
		echo '</div>';
	}
	//else{ ?>

<?php	//}
	wp_reset_query();
}
endif;
?>