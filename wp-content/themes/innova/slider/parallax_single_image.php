<?php
$Single_Image_height=get_post_meta(get_the_id(),'Single_Image_height',true);
		if( $Single_Image_height ){ ?>
			<style>
				#parallax_single_image{
					height: <?php echo $Single_Image_height; ?>px!important;
				}
			</style>
		<?php }
		?>
<script type="text/javascript">
	(function($) {
  "use strict";
	$(function() {
	 	$(window).resize(function(){ 
	 	var $sudo_caption_height1 = ( $("#parallax_single_image .container").height() / 2 )-51;
	    $('#parallax_single_image .container').height( $('#parallax_single_image .container').height() ).css({'margin-top' : -$sudo_caption_height1,'top':'50%'});
	});
	 	var $sudo_caption_height1 = ( $("#parallax_single_image .container").height() / 2 )-51;
	    $('#parallax_single_image .container').height( $('#parallax_single_image .container').height() ).css({'margin-top' : -$sudo_caption_height1,'top':'50%'});

	});
	})(jQuery);
 </script>
		<?php $meta=get_post_meta(get_the_id(),'Single_Image_Upload',true);
		$image_height=get_post_meta(get_the_id(),'Single_Image_height',true);
		$Single_Image_opacity=get_post_meta(get_the_id(),'Single_Image_opacity',true);
		$Single_Image_content=get_post_meta(get_the_id(),'Single_Image_content',true);
		$single_img_attachment=get_post_meta(get_the_id(),'single_img_attachment',true);
		$Single_image_height= $image_height ? $image_height : '500';
			$meta = ( array ) $meta;
			if ( !empty( $meta ) ) {
			$meta = implode( ',', $meta );
			$src = wp_get_attachment_image_src( $meta, '' );
			$src = $src[0];
			echo '<div id="parallax_single_image" style="background:url('.$src.'); background-attachment:'.$single_img_attachment.'; height:'.$Single_image_height.'px; background-position:top center; opacity:'.$Single_Image_opacity.'">'; 
				if($Single_Image_content){
					echo '<div class="container single_img_parallex_inner_text" >'.$Single_Image_content.'</div>';
				}
			echo '</div>';
				
			
			}	//echo $vals;
		//print_r($meta);
		?>
