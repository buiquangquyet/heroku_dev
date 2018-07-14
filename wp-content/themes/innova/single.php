<?php
get_header();
$options=get_option('kayapati');
 ?>
<!-- Slider -->
  <script type="text/javascript">
  (function($) {
    "use strict";
    $(function() {
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
<?php
//Blog Page Options Left / Right / Fullwidth
$blog_page_options = $options['blog_page_options'] ? $options['blog_page_options'] : 'two_third';
	$sidebar_class=( $blog_page_options == 'two_third' ) ? 'one_third_last' : 'one_third';
	$sidebar_border_class=( $blog_page_options == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
	// Sub Header Section ?>
	<!--Start Middle Section  -->
<section id="mid_container_wrapper">
	<section id="mid_container" class="container"> 
		<section class="<?php echo $blog_page_options; ?>" id="content_section">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php				
					// image resize setting
					$featuredImage=get_post_meta($post->ID,'featuredImage', true);
					// single post image enable/disable		
					$single_image=get_option('blog_bigger_image');	

					if(has_post_format('video')){ // Video
						$video = get_post_meta( get_the_ID(), 'post_video', true ); 
						echo $video;
					}else if(has_post_format('gallery')){ // Gallery 
						 echo '<div class="single_img ">'; 
						$meta = get_post_meta($post->ID, 'post_gallery', false );
						$kaya_gallery_slider = get_post_meta($post->ID, 'kaya_gallery_slider', true );
						$gallery_slider = ( $kaya_gallery_slider == '1' ) ? 'page_owlslider' : 'blog-isotope-container isotope_gallery';
						$width = ( $kaya_gallery_slider == '1' ) ? '1100' : '397';
						global $wpdb, $post;
						//print_r($meta);
						if ( !is_array( $meta ) )
						$meta = ( array ) $meta;
						if ( !empty( $meta ) ) {
						$meta = implode( ',', $meta );
						$images = $wpdb->get_col( "
						SELECT ID FROM $wpdb->posts
						WHERE post_type = 'attachment'
						AND ID IN ( $meta )
						ORDER BY menu_order ASC
						" );
						if( class_exists('RW_Meta_Box') ){
						$post_gallery_images= rwmb_meta( 'post_gallery', 'type=image&size=full' );
						}else{
							$post_gallery_images = '';
						}
						if(count($images) > 1 ){
								echo '<ul class="'.$gallery_slider .' clearfix ">';
								foreach ($post_gallery_images as $post_gallery_image) {
									echo '<li>';
									$params = array('width' => $width, 'height' => '', 'crop' => true);
								echo '<a data-gal="prettyPhoto[gallery]" href='.$post_gallery_image['url'].'><img src="'.bfi_thumb($post_gallery_image['url'], $params, 't').'" alt="'.$post_gallery_image['name'].'"/></a>';
								echo '</li>';
						}
							echo '</ul>';
							} else{
									foreach ( $images as $att ) {
								$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0]; ?>
									<a data-gal='prettyPhoto[gallery]' href='<?php echo "{$src}"; ?>' class="example2" title="">
									<?php echo "<img src='{$src}' /> </a>";
						
								}
								
							} 
						}						
						echo '</div>'; 
					}else if(has_post_format('audio')){ // Audio
						$audio = get_post_meta( get_the_ID(), 'kaya_audio', true ); 
						echo $audio;
					}else if(has_post_format('quote')){ // Quote
						$source = get_post_meta(get_the_ID(), 'kaya_quote_desc', true); ?>
						 <div class="quote_format"> <?php echo $source; ?> </div>
					<?php }else if(has_post_format('link')){ // Link
						$pf_link = get_post_meta(get_the_ID(), 'kaya_link', true); ?>
						<h3><a title="Permalink to: <?php echo $pf_link; ?>" href="<?php echo $pf_link; ?>" target="_blank"> <?php the_title(); ?>  </a>
						</h3>
						<p> <?php echo $pf_link; ?> </p>
					<?php } else{		
							echo '<div class="bxsider_wraper">';
								// Slider Attachment images
								 echo '<div class="single_img ">'; 
						$meta = get_post_meta($post->ID, 'post_gallery', false );
						global $wpdb, $post;
						//print_r($meta);
						if ( !is_array( $meta ) )
						$meta = ( array ) $meta;
						if ( !empty( $meta ) ) {
						$meta = implode( ',', $meta );
						$images = $wpdb->get_col( "
						SELECT ID FROM $wpdb->posts
						WHERE post_type = 'attachment'
						AND ID IN ( $meta )
						ORDER BY menu_order ASC
						" );
						if(count($images) > 1 ){
								echo '<ul class="owlslider">';
								foreach ( $images as $att ) {
									$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0];
								echo "<li>" ?>
						<?php $params = array('width' => '1200', 'height' => '450', 'crop' => true);?>
						<img src='<?php echo bfi_thumb( "{$src}", $params ); ?>' />
							<?php echo '</li>';
							}
							echo '</ul>';
							} else{
									foreach ( $images as $att ) {
								$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0];
									echo "<img src='{$src}' />";
						
								}

							} 
						}						
						echo '</div>';
							echo '</div>';	
						}
					?>
					<div class="content_box">
						<?php the_content(); ?> 
					</div>
					<div class="vspace"> </div>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'innova' ), 'after' => '</div>' ) ); ?>
				</div>
					<!-- .entry-content -->
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
			<div id="entry-author-info"> <!-- Author Information -->
				<div id="author-avatar" class="alignleft"> <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'kaya_author_bio_avatar_size', 60 ) ); ?> </div>
				<!-- #author-avatar -->
					<div id="author-description" class="description">
						<h4><?php printf( esc_attr__( 'About %s', 'innova' ), get_the_author() ); ?></h4>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div id="author-link"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'innova' ), get_the_author() ); ?> </a> </div>
					</div>
			</div>
			</div>
			<?php endif; ?>
					<!-- End Author information -->    
			<?php   // Comment Section
			$commentsection = get_post_meta( $post->ID, 'commentsection', true );	
			if( $commentsection != "on") {
				comments_template( '', true );
			} ?>
			<?php endwhile; // end of the loop. ?>
		</section>
        <?php // Sidebar Section
		if( $blog_page_options != 'fullwidth' ) :	?>
			<article class="<?php echo $sidebar_class. ' ' . $sidebar_border_class; ?>" >
				<?php get_sidebar();?>
			</article>
			<?php endif; ?>
			<div class="clear"></div>
	<?php get_footer(); ?>