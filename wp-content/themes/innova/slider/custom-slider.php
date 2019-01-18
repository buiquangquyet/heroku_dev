<div id="Custom_Slider_wrapper">
	<?php 
 if( class_exists('woocommerce') ){
  if( is_shop() ){
      $post_id = wc_get_page_id('shop');
  } else{
    $post_id = $post->ID;
  } }else{
    $post_id = $post->ID;
  }
		$customslider_type=get_post_meta($post_id,'customslider_type',true);
		echo do_shortcode($customslider_type); ?>
</div>