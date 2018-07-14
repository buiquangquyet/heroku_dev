<?php
/**
 * The template for displaying Search Results pages.
 *
 */
get_header();
	echo '<section class="sub_header_wrapper" >'; ?>
	<div class="sub_header container">
				<h2><?php  printf( __( 'Search Results for: %s', 'innova' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

		</div>
	</div>
</section> <!-- end header section -->

<!-- Start Middle Section -->
	<section id="mid_container_wrapper">	
		<section id="mid_container" class="container"> 
			<?php if ( have_posts() ) : ?>
				<?php
				/* Run the loop to output the blog page.
				* called loop-blog.php and that will be used instead.
				*/
				get_template_part( 'loop', 'search'); ?>
			<?php else : ?>
				<h1><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
			<?php endif; ?>
    <!--Start Footer Section -->
<?php get_footer(); ?>