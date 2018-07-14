<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Lawyer Attorney
 */

get_header(); ?>

<div id="content-vw">
	<div class="container">
        <div class="page-content">					
			<h3><?php printf( '<strong>%s</strong> %s', esc_html__( '404', 'vw-lawyer-attorney' ), esc_html__( 'Not Found', 'vw-lawyer-attorney' ) ) ?></h3>
			<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn&hellip', 'vw-lawyer-attorney' ); ?></p>
			<p class="text-404"><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'vw-lawyer-attorney' ); ?></p>
			<div class="read-moresec">
        		<a href="<?php echo esc_url( home_url() ) ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Return to Home Page', 'vw-lawyer-attorney' ); ?></a>
			</div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
<?php get_footer(); ?>