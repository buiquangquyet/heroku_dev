<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->

<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php 
 $responsive_mode = get_theme_mod( 'responsive_layout_mode' ) ? get_theme_mod( 'responsive_layout_mode' ) : 'on';
if($responsive_mode == "on"){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0" />
<?php } ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php
 wp_head(); ?>
 
 </head>
<body <?php body_class(); ?> >

	<?php
	$kaya_layout_class = get_theme_mod('kaya_layout_class') ? get_theme_mod('kaya_layout_class') : 'fluid_layout';
	?>

	<section id="<?php echo $kaya_layout_class; ?>"><!-- Main Layout Section Start -->
		<!--Start header  section -->
		   <?php   echo  header_bg_image();?>

						 
         <div class="header_top">
         	        <div class="container">
						<div class="header_top_left_section">
							<?php  $header_top_left_section = get_theme_mod('header_top_left_section' ) ? get_theme_mod('header_top_left_section'): ''; 
							if( $header_top_left_section ){
							?>
							<div class="one_half header_top_left">
								<?php
								echo $header_top_left_section;
								?>
							</div>
						
	        	<?php } ?>
	        	</div>
	        	<?php  $disable_user_information = get_theme_mod('disable_user_information' ) ? get_theme_mod('disable_user_information'): '0'; 
	        	$top_bar_right_content = get_theme_mod('top_bar_right_content') ?  get_theme_mod('top_bar_right_content') : ""; ?>
				<div class="one_half_last header_top_right">
					<?php echo do_shortcode($top_bar_right_content);
							   	 if ( get_theme_mod('menu_header_cart_items') != '1' ) { ?>
                  <?php if (class_exists('woocommerce')) { ?>
						 <?php global $woocommerce; 
					if( $disable_user_information !='1' ){?>

					<a class="cart-contents shopping_cart_img" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a> |
					<?php if (sizeof($woocommerce->cart->cart_contents)>0) :?>
					<a href="<?php echo $woocommerce->cart->get_checkout_url()?>" title="<?php _e('Checkout','woothemes') ?>"><?php _e('Checkout','woothemes') ?></a> |
					<?php endif; ?>
					<!-- User Details Login / Registration -->
					<?php if ( is_user_logged_in() ) { ?>
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a> | <a href="<?php echo wp_logout_url( home_url() ) ?>" title="Logout"><?php _e('Logout','ultimate'); ?></a>
					<?php }
					else { ?>
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
					<?php } ?>
					<?php } ?>
					<?php } ?>
					<?php } ?>
				</div>
	        	
	        </div>
    	</div>
    	
		<section id="header_wrapper">		
			<header class="container">
				<div class="header_left_section ">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php kaya_logo_image(); ?> </a>	
				</div>
				<?php $contact_info = get_theme_mod('header_right_contact_info') ? get_theme_mod('header_right_contact_info') :'<h3 style="font-size:1.5em;"> '.__('CALL NOW: (400) 450-2428','innova').'
			</h3>';
			$email_info = get_theme_mod('header_right_email_info') ? get_theme_mod('header_right_email_info') :'<h3 style="font-size:1.5em;"> '.__('Email us:kayapati.com','innova').'
			</h3>';

			?>

				<!-- Side toggle content section -->
				
				<div class="header_right_section ">
					<div>
					<?php echo do_shortcode( trim($contact_info) ); ?>
				</div>
				<div class="header_right_email_info">
					<?php echo do_shortcode( trim($email_info) ); ?>
				</div>	
				<!--end navigation -->
			</div>
				</header> 
	</section> <!--end header section -->
			<!--navigation start -->
			<?php $mobile_menu_text = get_theme_mod('mobile_menu_text') ? get_theme_mod('mobile_menu_text') : __('Go to ...', 'innova'); ?>
					<div class="nav_wrap">
						<nav class="container" data-mobile-menu="<?php echo $mobile_menu_text; ?>">
							 <?php 
						    if (has_nav_menu('primary')) {
						    	wp_nav_menu(array('echo' => true, 'container_id' => 'myslidemenu','menu_id'=> 'jqueryslidemenu', 'container_class' => 'menu','theme_location' => 'primary', 'menu_id'=> 'menu', 'walker' => new Kaya_Description_Walker()));
						    }else{
						    wp_nav_menu(array('echo' => true, 'container_id' => 'myslidemenu','menu_id'=> 'jqueryslidemenu', 'container_class' => 'menu','theme_location' => 'primary', 'menu_id'=> 'menu')); 
						    }
						    ?>
						</nav>
					</div>
					<div class="clear"></div>	
</section>
  <?php  do_action('kaya_slider_data') ?>            
