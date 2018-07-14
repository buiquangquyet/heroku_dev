<?php
global $post;
$kaya_options=get_option('kayapati');
 if( class_exists('woocommerce') ){
  if( is_shop() ){
      $post_id = wc_get_page_id('shop');
  } else{
    $post_id = $post->ID;
  } }else{
    $post_id = $post->ID;
  }
	$Kaya_Slider_cat=get_post_meta($post_id,'Kaya_Slider_cat',false);
	$kaya_portfolio_cat=get_post_meta($post_id,'kaya_portfolio_cat',false);
	$kaya_slidecaption=get_post_meta($post_id,'kaya_slidecaption',true);
	$kaya_slidelink=get_post_meta($post_id,'kaya_slidelink',true);
	$Kaya_slider_transitions=get_post_meta($post_id,'Kaya_slider_transitions',true);
	$slide_text_color=get_post_meta($post_id,'slide_text_color',true);
	$Kaya_slider_autoplay=get_post_meta($post_id,'Kaya_slider_autoplay',true);
	$enable_slider_screen_height=get_post_meta($post_id,'enable_slider_screen_height',true);
	$Kaya_slider_post_type=get_post_meta($post_id,'Kaya_slider_post_type',true) ? get_post_meta($post_id,'Kaya_slider_post_type',true) : 'slider';
	$adaptive_height=get_post_meta($post_id,'adaptive_height',true) ? get_post_meta($post_id,'adaptive_height',true) : 'false';
	$rtl_right=get_post_meta($post_id,'rtl_right',true) ? get_post_meta($post_id,'rtl_right',true) : 'false';
	$Kaya_slider_mode=get_post_meta($post_id,'Kaya_slider_mode',true);
	 $box_slider = ( $Kaya_slider_mode == 'boxed_slider') ? 'container' : 'bx_fluid_slider'; 
 	$Kaya_slider_height=get_post_meta($post_id,'Kaya_slider_height',true) ? get_post_meta($post_id,'Kaya_slider_height',true) :'500';
	$height = ( $adaptive_height == 'true' ) ? '' : $Kaya_slider_height;
	$Kaya_slider_pause=get_post_meta($post_id,'Kaya_slider_pause',true) ? get_post_meta($post_id,'Kaya_slider_pause',true) : '4000';
	$Kaya_slider_easing=get_post_meta($post_id,'Kaya_slider_easing',true) ? get_post_meta($post_id,'Kaya_slider_easing',true) : 'swing';
	$kaya_slider_order=get_post_meta($post_id,'kaya_slider_order',true);
	$Kaya_bx_slider_limit=get_post_meta($post_id,'Kaya_bx_slider_limit',true);
	$Kaya_slider_transitions_speed=get_post_meta($post_id,'Kaya_slider_transitions_speed',true) ? get_post_meta($post_id,'Kaya_slider_transitions_speed',true) :'15000';

		?>
	<script type="text/javascript">
		(function($) {
		"use strict";
		$(function() {
			$(".page_owlslider").owlCarousel({
			nav : true,
			navText : ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
			stopOnHover : true,
			margin : 15,
			rtl : <?php echo $rtl_right?>,
			autoplay : <?php echo $Kaya_slider_autoplay; ?>,
			autoplayTimeout:<?php echo $Kaya_slider_transitions_speed; ?>,
			loop: true,
			items : 1,
		//rtl:true,
			onSliderLoad: function(){
				$(".page_owlslider").css("visibility", "visible");
			}
			});
			<?php if( $enable_slider_screen_height =='1'  ){ ?>
			function window_resize(){
				var header_height = $('#header_wrapper').height();
				var nav_height = $('.nav_wrap').height();
				var header_padding = $('#header_wrapper').css('padding-top');
				var height = $(window).height();
				var header_p = parseInt(header_padding);
				var padding_t_b = parseInt(header_wrapper * 2);
				$('.main_slider_wrapper, .owl-carousel .owl-stage-outer, .owl-carousel .owl-item').css('height',(height - (header_height+header_p+header_p+nav_height)));
			}
			//if(  $(window).height() < 768  ){
				window_resize();
				$(window).resize(function(){
					window_resize();
				})
				<?php } ?>
			//}
			});
		})(jQuery);
	</script>
	
	<?php if( $enable_slider_screen_height !='1'  ){ ?>
	<style>
			.main_slider_wrapper, .main_slider_wrapper .owl-carousel .owl-stage-outer, .main_slider_wrapper .owl-carousel .owl-item{
				height : <?php echo $Kaya_slider_height ?>px;
			}
	</style>
	<?php 	} ?>
	
    <div class="main_slider_wrapper <?php echo $box_slider; ?>" style="overflow:hidden;">
	<div class="page_owlslider">
	<?php
	switch ( $Kaya_slider_post_type ) {
		case 'slider_category':
			 $post_type = 'slider';
			 $category = $Kaya_Slider_cat;
			break;
		case 'portfolio_category':
				 $post_type = 'portfolio';
				 $category = $kaya_portfolio_cat;
			break;
		default:
			 $post_type = 'slider';
			 $category = $Kaya_Slider_cat;
			break;
	}
		if(empty($category)) {
				$loop = new WP_Query(array('post_type' => $post_type, 'taxonomy' => $Kaya_slider_post_type,'term' => $category, 'orderby' => 'menu_order', 'posts_per_page' =>$Kaya_bx_slider_limit,'order' => $kaya_slider_order));
			}else{ 
				$loop =new WP_Query( array('post_type' => $post_type, 'orderby' => '', 'posts_per_page' =>$Kaya_bx_slider_limit,'order' => $kaya_slider_order , 'tax_query' => array( array( 'taxonomy' => $Kaya_slider_post_type, 'field' => 'slug', 'terms' => $category , 'operator' => 'IN'))));
			}
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<div>
		<span class="slider_overlay1"> </span>	
	<?php
	global $post;  	?>
			<?php
	$slider_link=get_post_meta(get_the_ID(),'customlink' ,true);
	$slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
	$slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
	$slider_target_link= get_post_meta($post->ID,'slider_target_link',true);
	$slide_description= get_post_meta($post->ID,'slide_description',true);
	$slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
	$disable_slide_content = get_post_meta($post->ID,'disable_slide_content',true) ? get_post_meta($post->ID,'disable_slide_content',true) : '0';

	if( $slider_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
		if($slider_link){
			echo '<a href="'.$slider_imglink.'" '.$target_link_class.' >';
		}
		

		$kaya_img_width = ( get_theme_mod('kaya_layout_class') == 'box_layout' || $Kaya_slider_mode == 'boxed_slider' ) ? '1160' : '1920';

		//$kaya_layout_class = get_theme_mod('box_layout') ? '1160' : '1920';
		$kaya_layout_class = get_theme_mod('kaya_layout_class') ? get_theme_mod('kaya_layout_class') : 'fluid_layout';

			$params = array('width' => '1920', 'height' => '', 'crop' => true);
				$img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL	
				
				echo kaya_imageresize($post->ID, $params,'');		
				//echo '<img src="'.$img_url.'" />';	
				echo '</a>';
				if($disable_slide_content == "0") { 
					if( $slide_text_color ) {
				$slide_colors =array(
					'color' => $slide_text_color,
					'border-top' => '3px solid '.$slide_text_color,
					'border-bottom' => '3px solid '.$slide_text_color,
				); 
				$slide_color_val = array();
				foreach ($slide_colors as $slide_style => $slide_color) {
							$slide_color_val[] = $slide_style.':'.$slide_color;
				}
			} else{ $slide_text_color = ''; }?>	
			<?php  global $post; 
			 $title_align = get_post_meta($post->ID,'title_align',true) ? get_post_meta($post->ID,'title_align',true) : 'left';
              $title_font_size = get_post_meta($post->ID,'title_font_size',true) ? get_post_meta($post->ID,'title_font_size',true) : '';
               $description_font_size = get_post_meta($post->ID,'description_font_size',true) ? get_post_meta($post->ID,'description_font_size',true) : '';
			?>
				<div class="caption" style="text-align:<?php echo $title_align ;?>!important;">
					<h3 class="slide_title" style="font-size:<?php echo $title_font_size; ?>px; <?php echo implode('; ', $slide_color_val); ?>"><?php echo the_title(); ?></h3>
					<p style="color:<?php echo $slide_text_color; ?>; font-size:<?php echo $description_font_size; ?>px!important;"><?php // echo $slide_description; 
						echo strip_tags ( kaya_content('20') );
					?></p>
				</div>
		<?php }
				//echo "<img src='" . bfi_thumb( $img_url, $params ) . "'/>";
		//}
		?>
	</div>
			<?php endwhile; // End the loop. Whew. ?>
	 <?php else :
                echo '<li><img src="'.get_template_directory_uri().'/images/defult_featured_img.png" width="100%" height="400"></li>';
                endif; ?>

	</div>
</div>
  	<?php   wp_reset_query();
      wp_reset_postdata(); ?>
    	<div class="clear"></div>