<?php 
	$Single_slider_height=get_post_meta($post->ID,'Single_slider_height',true);
	if( $Single_slider_height ){ ?>
	<style scoped>
		#video_wrapper{
			height: <?php echo trim( $Single_slider_height ); ?>px!important;
		}
	</style>
	<?php } ?>
	<script type="text/javascript">
		jQuery( function($) {
		"use strict";
		$(function() {
			$(function(){
              $(".player").mb_YTPlayer();
			});
		});
		})( jQuery );		

	</script>
	<?php  $slider=get_post_meta($post->ID,'slider',true);
	if($slider == 'video'){ ?>
		<style scoped>
			#box_layout{
				box-shadow: 0 0 0 rgba(0, 0, 0, 0.3)!important;
			}
		</style><?php } ?>
<div id="video_wrapper">
	<?php 
	$kaya_options = get_option('kayapati');
	$boxed_layout = $kaya_options['boxed_layout'] ? $kaya_options['boxed_layout'] : '0'; ?>
	
	<?php	$options=get_option('page_video');
		$page_video=get_post_meta(get_the_id(),'page_video',true);
		$page_video_bg_text=get_post_meta(get_the_id(),'page_video_text',true);
		$page_video_mute=get_post_meta(get_the_id(),'page_video_mute',true);
		if( $boxed_layout == '0' ){
		?>
		<div class="video_overlay"> </div> <?php } ?>
		<a id="video_bg_wrapper" class="player" data-property="{videoURL:'<?php echo trim($page_video); ?>',containment:'body',autoPlay:true, mute:<?php echo $page_video_mute; ?>, startAt:0, opacity:1}">My video</a>
		<div class="video_inner_text">
			<?php echo wp_kses_post( $page_video_bg_text ); ?>	
		</div>	
</div>