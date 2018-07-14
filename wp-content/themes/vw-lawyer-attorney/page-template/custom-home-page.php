<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'vw_lawyer_attorney_above_slider' ); ?>

<?php /** slider section **/ ?>
	<?php
	// Get pages set in the customizer (if any)
	$pages = array();
	for ( $count = 1; $count <= 5; $count++ ) {
	$mod = absint( get_theme_mod( 'vw_lawyer_attorney_slidersettings-page-' . $count ));
	if ( 'page-none-selected' != $mod ) {
	  $pages[] = $mod;
	}
	}
	if( !empty($pages) ) :
	  $args = array(
	    'post_type' => 'page',
	    'post__in' => $pages,
	    'orderby' => 'post__in'
	  );
	  $query = new WP_Query( $args );
	  if ( $query->have_posts() ) :
	    $count = 1;
	    ?>
		<div class="slider-main">
	    	<div id="slider" class="nivoSlider">
		      <?php
		        $vw_lawyer_attorney_n = 0;
				while ( $query->have_posts() ) : $query->the_post();
				  
				  $vw_lawyer_attorney_n++;
				  $vw_lawyer_attorney_slideno[] = $vw_lawyer_attorney_n;
				  $vw_lawyer_attorney_slidetitle[] = get_the_title();
				  $vw_lawyer_attorney_slidecontent[] = get_the_content();
				  $vw_lawyer_attorney_slidelink[] = esc_url(get_permalink());
				  ?>				   
				   <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $vw_lawyer_attorney_n ); ?>" />
				  <?php
				$count++;
				endwhile;
				wp_reset_postdata();
		      ?>
		    </div>

		    <?php
		    $vw_lawyer_attorney_k = 0;
	      	foreach( $vw_lawyer_attorney_slideno as $vw_lawyer_attorney_sln )
	      	{ ?>
		      <div id="slidecaption<?php echo esc_attr( $vw_lawyer_attorney_sln ); ?>" class="nivo-html-caption">
		        <div class="slide-cap  ">
		          <div class="container">
		            <h2><?php echo esc_html($vw_lawyer_attorney_slidetitle[$vw_lawyer_attorney_k]); ?></h2>
		            <p><?php echo esc_html($vw_lawyer_attorney_slidecontent[$vw_lawyer_attorney_k]); ?></p>		            
		            <a class="read-more" href="<?php echo esc_url($vw_lawyer_attorney_slidelink[$vw_lawyer_attorney_k] ); ?>"><?php esc_html_e( 'More About Us','vw-lawyer-attorney' ); ?></a>
		          </div>
		        </div>
		      </div>
		        <?php $vw_lawyer_attorney_k++;
		    } ?>
		</div>
	  <?php else : ?>
	      <div class="header-no-slider"></div>
	    <?php
	  endif;
	endif;
?>
<div class="clearfix"></div>

<?php do_action( 'vw_lawyer_attorney_below_slider' ); ?>

<div class="container">
	<div class="row">
		<div class="about col-md-6 col-sm-6">
		    <?php
		      $args = array( 'name' => get_theme_mod('vw_lawyer_attorney_about_setting',''));
		      $query = new WP_Query( $args );
		      if ( $query->have_posts() ) :
		        while ( $query->have_posts() ) : $query->the_post(); ?>
		            <h3><?php the_title(); ?></h3>
		            <p><?php the_excerpt(); ?></p>
		            <?php if( get_theme_mod('vw_lawyer_attorney_about_name') != ''){ ?>
		            <div class ="testbutton">
		              <a href="<?php the_permalink(); ?>"><span><?php echo esc_html(get_theme_mod('vw_lawyer_attorney_about_name',__('DISCOVER MORE ABOUT US','vw-lawyer-attorney'))); ?></span></a>
		            </div>
		            <?php }?>
		        <?php endwhile; 
		        wp_reset_postdata();?>
		        <?php else : ?>
		           <div class="no-postfound"></div>
		        <?php
		    endif; ?>
		</div>
		<div id="choose" class="col-md-6 col-sm-6" >
			<?php if( get_theme_mod('vw_lawyer_attorney_main_title') != ''){ ?>
			    <div class="heading-line">
			      <h3><?php echo esc_html(get_theme_mod('vw_lawyer_attorney_main_title','')); ?> </h3>
			    </div>
		    <?php } ?>
			<?php 
			    $page_query = new WP_Query(array( 'category_name' => get_theme_mod('vw_lawyer_attorney_blogcategory_setting','theblog')));?>
		  		<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
		  			<div class="row">
				    	<div class="col-md-3 col-sm-3">
				    		<div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div>
				    	</div>
				    	<div class="col-md-9 col-sm-9">
				    		<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
				    		<p><?php the_excerpt(); ?></p>
				    	</div>
				    </div>
			    	<div class="clearfix"></div>
			    <?php endwhile;
			    wp_reset_postdata();
			?>
		</div>
	</div>
</div>

<?php do_action( 'vw_lawyer_attorney_below_about' ); ?>

<div id="content-vw" class="container">
  <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>