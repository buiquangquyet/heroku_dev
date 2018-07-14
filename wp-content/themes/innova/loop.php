<?php
// global variables
global $more;
$more='0';
$kaya_options = get_option('kayapati');
$kaya_readmore_blog=get_theme_mod('readmore_button_text') ? get_theme_mod('readmore_button_text') : 'Read More';
$sidebar_layout=isset( $kaya_options['sidebar_class'] ) ? $kaya_options['sidebar_class'] : 'two_hird';
 while ( have_posts() ) : the_post(); ?> <!-- Start While Loop here -->
  <article <?php post_class('standard-blog'); ?> >
   
    <div class="blog_post description">
      <h2>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'innova' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a>
      </h2>
      <span class="meta_desc">
        <span class="category"><i class="fa fa-calendar meta-post-icons"> </i><?php echo get_the_date( )?></span>
        <span class="author"><i class="fa fa-user meta-post-icons"> </i><?php the_author_posts_link(); ?></span>
        <span class="category"><i class="fa fa-tag meta-post-icons"> </i><?php the_category(', '); ?></span>
        <span class="comments"><i class="fa fa-comment meta-post-icons"> </i><?php comments_popup_link(__('0','innova' ), __( '1', 'innova' ), __( '%', 'innova' ) ); ?></span>
        <?php echo '</span>'; ?>
    </div>
  <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
      echo '<span class="blog_img  ">';
        echo '<a href="'.get_permalink().'">';
        if( (get_post_meta( $post->ID, 'kaya_image_streatch', true ))) {
         $params = array('width' => '1100', 'height' => '450', 'crop' => true);
        }else{
           $params = array('width' => '', 'height' => '', 'crop' => true);
        }
          $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
          echo kaya_imageresize($img_url,$params,'');
        echo '</a></span>';
      }   ?>
   <?php  echo the_content($kaya_readmore_blog,''); 
   
    //} ?><!-- If No Featured Image -->
   <div class="clear"> </div>
   <!--<a class="readmore readmore-1" href="<?php the_permalink(); ?>"><?php echo $kaya_readmore_blog; ?></a>
     #post-## -->
  </article>
  <?php  // Comment Section
  $commentsection = get_post_meta( $post->ID, 'commentsection', true );
  if( $commentsection != "on") {
    comments_template( '', true );
  } ?>
  <?php endwhile; // End the loop. While. ?>
  <?php /* Display navigation to next/previous pages when applicable */ ?>
  <?php echo kaya_pagination(); ?>
