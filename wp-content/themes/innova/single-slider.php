<?php
get_header(); 
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
switch( $sidebar_layout ){
	case 'leftsidebar':
		$sidebar_class="two_third_last";
		break;
	case 'rightsidebar':
		$sidebar_class="two_third";
		break;	
	case 'full':
		$sidebar_class="fullwidth";
		break;		
}
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last'; 
	// Sub Header Section
?>
<!--Start Middle Section  -->
	<section id="mid_container_wrapper">
	<section id="mid_container" class="container"> 
		<div class="two_third" id="content_section">
			<?php get_template_part('loop','page'); ?>
		</div>
		<!--StartSidebar Section -->
		<?php if($sidebar_layout !="full") { ?>
			<div class="one_third_last">
				<?php //get_sidebar();
				the_content();
				?>
			</div>
			<div class="clear"></div>
		<?php } ?>
		<div class="clear"></div>
		<!--End content Section -->
	<?php get_footer(); ?>