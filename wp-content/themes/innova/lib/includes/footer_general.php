<?php $options=get_option('kayapati'); ?>
<footer>	
	<?php 
	$footer_page_id = get_theme_mod('footer_page_id') ? get_theme_mod('footer_page_id') : '';
	$select_footer_type=get_theme_mod('select_footer_type') ? get_theme_mod('select_footer_type') : '';
	$footer_disable=get_theme_mod('main_footer_disable') ? get_theme_mod('main_footer_disable') : '0'; 
			 if($footer_disable=="0") {?>
		<?php	if( $select_footer_type=="page_based_footer" ){ ?>
		<div class="footer_wrapper">
			<div class="container"> <!-- Start Footer section -->
				<?php $post = get_page($footer_page_id); 
			$content = apply_filters('the_content', $post->post_content); 
			echo $content; echo '</div>';
		echo '</div>';}else{ ?>
		<div class="footer_wrapper">
			<div class="container">
				<div class="footer_widgets">
					<?php  get_template_part('lib/includes/bottom_footer_section'); ?>
				</div>
			</div> 
		</div> <!-- end Footer  section -->
	<?php } } ?>
	<div class="clear"></div>
		<!-- Start Footer bottom section -->

	</footer>
		<?php $most_footer_disable=get_theme_mod('most_footer_disable') ? get_theme_mod('most_footer_disable') : '0'; 
	if($most_footer_disable=="0"){ ?> 
		<div id="footer_bottom"> 
			<div class="container">
				<div class="one_half">
                <?php if( has_nav_menu( 'footer' ) ){
				   wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer' , 'menu_class' => '') );
                   }else{
                    echo '<span class="copyrights">';
                       	echo get_theme_mod('footer_col2_section') ? do_shortcode( get_theme_mod('footer_col2_section') ) :
                       	_e('Copyright &copy; Kayapati. All rights reserved.','innova');
                    echo '</span>';
                   }

                   ?>
				</div>
	<?php $footer_social_icons = get_theme_mod('footer_col3_section') ? do_shortcode( get_theme_mod('footer_col3_section') ) : '<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-rss"></i></a>
					<a href="#"><i class="fa fa-youtube"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>'; ?>
			<div class="one_half_last" id="footer_column3">
				<?php if( $footer_social_icons ): ?>
					<div class="footer_social_icons">
						<?php echo $footer_social_icons; ?>
					</div>
				<?php endif; ?>	
			</div>
			</div>
		</div> <!-- end Footer bottom section  -->	
	<?php } ?>