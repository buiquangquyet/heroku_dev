<?php
/**
 * The template for displaying Tag Archive pages.
 */
get_header(); 
// Theme Layout Leftsidebar OR Rightsidebaror OR Full
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
// Image width Depend Theme layoout
$img_width=kaya_image_width(get_the_id());
//sidebar class
$sidebar_layout=$options['sidebar_class'] ? $options['sidebar_class'] : 'rightsidebar';
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
switch($sidebar_layout){
case 'full' :
$sidebarclass="fullwidth";
break;
case 'rightsidebar' :
$sidebarclass="two_third";
break;
case 'leftsidebar' :
$sidebarclass="two_third_last";
break;
}
	// Page Title
	
	?>
<!--Start Middle Section  -->
<section id="mid_container_wrapper">
	<section id="mid_container" class="container"> 
 		<section class="<?php echo $sidebarclass; ?>" id="content_section">
			<?php
                /* Run the loop to output the blog page.
                * called loop-blog.php and that will be used instead.
                */
                get_template_part( 'loop','portfolio');
            ?>
        </section>
		<!-- Start Sidebar Section -->
		<?php if($sidebar_layout !="full") { ?>
			<aside class="<?php echo $aside_class;?>" >
				<?php get_sidebar();?>
			</aside>
			<div class="clear"></div>
		<?php } ?>
       <!--End content Section -->
<?php get_footer(); // Footer Section ?>