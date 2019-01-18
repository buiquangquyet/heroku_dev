<?php
$img_width=kaya_image_width(get_the_id());	
//$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
$list_images= get_post_meta($post->ID,'list_images',true);
$project_client_name= get_post_meta($post->ID,'project_client_name',true);
$project_link= get_post_meta($post->ID,'client_project_link',true);
//$pf_single_page_slider_auto_play=get_theme_mod('pf_single_page_slider_auto_play'):'0';
$pf_single_page_slider_auto_play = get_theme_mod('pf_single_page_slider_auto_play') ? get_theme_mod('pf_single_page_slider_auto_play') : '0'; 
$isotop_gal=( ($list_images=='isotope_gallery') || ($list_images=='grid_gallery') ) ? 'isotope-container' : '';

if($list_images=='slider'){ ?>
<script type="text/javascript">
(function($) {
  "use strict";
$(window).load(function() {
$('.page_owlslider').owlCarousel({
   rtl:true,
    loop:true,
    margin:15,
    nav:true,
    navText : ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
    items : 1,
    autoplay :true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:1
        }
    }
})
	});
})(jQuery);
</script>
	<?php $slider_class="page_owlslider";
} else{
	$slider_class='';
 }// loop Start here 
	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			observePostViews($post->ID);
			$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
			$video_embed_code= get_post_meta($post->ID,'video_embed_code',true);
			$Featuredimage=get_post_meta(get_the_ID(),'Featuredimage' ,true);
			if( class_exists('RW_Meta_Box') ){ 
			$images = rwmb_meta( 'portfolio_slide', 'type=image&size=full' );
			}else{
			$images ='';
			}
			$video_type = get_post_meta(get_the_ID(), 'video_type', true );
			$portfolio_project_skills=get_post_meta(get_the_ID(),'portfolio_project_skills' ,false);
			$portfolio_project_skills_title=get_post_meta(get_the_ID(),'portfolio_project_skills_title' ,true);
			$portfolio_skills_title= isset( $options['portfolio_skills_title']) ?  $options['portfolio_skills_title'] : '';
			$pf_featuread_image_disable=get_post_meta(get_the_ID(),'pf_featuread_image_disable' ,true);
			$title=get_the_title($post->ID);
			foreach($images as $val){
			}
			$postid=$post->ID;
				echo '<div class="single_img '.$list_images.'">';
			 if( isset( $val )!='' ){ 
					global $wpdb, $post;
					if ( !is_array( $images ) )
						$images = ( array ) $images;
						if ( !empty( $images ) ) {
						if(count($images) > 1 ){
								echo '<ul class="'.$slider_class.' '.$isotop_gal.' clearfix '.$list_images.'">';

							foreach ( $images as $image ){

					echo "<li class='isotope-item all  '>"; 
					 echo "<a href='{$image['url']}' title='{$image['title']}' data-gal='prettyPhoto[gallery]' >"; ?>
					<?php if($list_images=="isotope_gallery"){ ?>
					<?php $params = array('width' => '650', 'height' => '', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."'  alt='{$image['title']}' />"; ?> 
					<?php } elseif($list_images=="grid_gallery"){ ?>
					<?php $params = array('width' => '650', 'height' => '500', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."'  alt='{$image['title']}' />"; ?> 
					<?php }else { ?>
					<?php $params = array('width' => '', 'height' => '', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."' alt='{$image['title']}' />"; ?> <?php }?>	</a>	</li>
							<?php	}
							echo '</ul>';
							}else{
								foreach ( $images as $image ) {
									$params = array('width' => '', 'height' => '', 'crop' => false);
									echo "<img src='".bfi_thumb( "{$image['url']}", $params )."' alt='{$image['title']}' />"; 
								}
							}
					} 
			} else {   }
		echo '</div>'; 
				if( $video_embed_code && $images ){
			echo '<br>';
		}
		if($video_embed_code!='')
		{		
			echo $video_embed_code;
		} 
			echo '<div class="clear"></div>';    
			if($sidebar_layout == "full") { ?>
				<div class="fullwidth portfolio_fullwidth">
						<?php the_content(); ?>
				</div>
			<?php }
			else{ ?>
	
			<?php } 
			
			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'innova' ), 'after' => '</div>' ) ); 
			edit_post_link( __( 'Edit', 'innova' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<!-- End Ps -->
		<?php  
		
	endwhile; // end of the loop. ?>