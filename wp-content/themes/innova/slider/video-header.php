<?php
 if( class_exists('woocommerce') ){
  if( is_shop() ){
      $post_id = wc_get_page_id('shop');
  } else{
    $post_id = $post->ID;
  } }else{
    $post_id = $post->ID;
  }
$video_header=get_post_meta($post_id,'video_header',true);
echo $video_header;
?>
