<?php
/**
 * Template Name:Page with Left Sidebar
 */

get_header(); ?>

<?php do_action( 'vw_lawyer_attorney_header_pageleft' ); ?>

<div class="container">
    <div class="middle-align row">       
		<div class="col-md-3">
			<?php get_sidebar('page'); ?>
		</div>		 
		<div class="col-md-9" id="content-vw" >
			<?php while ( have_posts() ) : the_post(); ?>
                <h3><?php the_title(); ?></h3>
                <?php the_content();?>
            <?php endwhile; // end of the loop. ?>
            <?php
                //If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
        </div>
        <div class="clear"></div>    
    </div>
</div>

<?php do_action( 'vw_lawyer_attorney_footer_pageleft' ); ?>

<?php get_footer(); ?>