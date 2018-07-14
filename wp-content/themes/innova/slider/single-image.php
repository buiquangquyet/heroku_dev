<?php
 if( class_exists('woocommerce') ){
  if( is_shop() ){
      $post_id = wc_get_page_id('shop');
  } else{
    $post_id = $post->ID;
  } }else{
    $post_id = $post->ID;
  }
$Single_Image_height=get_post_meta($post_id,'Single_Image_height',true);
		if( $Single_Image_height ){ ?>
			<style>
				#parallax_single_image{
					height: <?php echo $Single_Image_height; ?>px!important;
					}
			</style>
		<?php }
		?>

		<?php $meta=get_post_meta($post_id,'Single_Image_Upload',true);
		$Single_Image_content=get_post_meta($post_id,'Single_Image_content',true);
		$single_img_attachment=get_post_meta($post_id,'single_img_attachment',true);
	
			$meta = ( array ) $meta;
			if ( !empty( $meta ) ) {
			$meta = implode( ',', $meta );
			$src = wp_get_attachment_image_src( $meta, '' );
			$src = $src[0];
			echo '<div id="parallax_single_image" style="background:url('.$src.'); background-attachment:'.$single_img_attachment.'; background-position:top center;">'; 
				if($Single_Image_content){
					echo '<div class="container single_img_parallex_inner_text" >'.$Single_Image_content.'</div>';
				}
			echo '</div>';
				
			
			}	//echo $vals;
		//print_r($meta);
		?>
