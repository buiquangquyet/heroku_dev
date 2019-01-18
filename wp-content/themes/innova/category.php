<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
	get_header();
	$kaya_options = get_option('kayapati');
 // Blog Page Options Left / Right / Fullwidth
	$blog_page_options = $kaya_options['blog_page_options'] ? $kaya_options['blog_page_options'] : 'two_third';
	$sidebar_class=( $blog_page_options == 'two_third' ) ? 'one_third_last' : 'one_third';
	$sidebar_border_class=( $blog_page_options == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
	 ?>
<!--Sub Header Section  -->

	<!-- Start Middle Section  -->
	<section id="mid_container_wrapper">
		<section id="mid_container" class="container"> 
			<section class="<?php echo $blog_page_options; ?>" id="content_section">
				<?php get_template_part( 'loop'); // called loop-blog.php ?>
			</section>
        <?php // Sidebar Section
		if( $blog_page_options != 'fullwidth' ) :	?>
			<article class="<?php echo $sidebar_class. ' ' . $sidebar_border_class; ?>" >
				<?php get_sidebar();?>
			</article>
			<?php endif; ?>
			<div class="clear"></div>
	<?php get_footer(); ?>