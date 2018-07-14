<?php
/**
 * The template part for displaying slider
 *
 * @package VW Lawyer Attorney 
 * @subpackage vw_lawyer_attorney
 * @since VW Lawyer Attorney 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="postbox smallpostimage">
      <?php 
          if(has_post_thumbnail()) { ?>
      <div class="box-image col-md-5">
            <?php the_post_thumbnail();  ?>
      </div>
      <?php } ?>
      <div class="new-text <?php 
          if(has_post_thumbnail()) { ?>col-md-7"<?php } else { ?>col-md-12"<?php } ?>>
          <div class="box-content">
              <h4><?php the_title();?></h4>
              <div class="metabox">
                  <span class="entry-date"><?php the_date(); ?></span>
                  <span class="entry-author"><?php the_author(); ?></span>
                  <span class="entry-comments"><?php comments_number( __('0 Comments','vw-lawyer-attorney'), __('0 Comments','vw-lawyer-attorney'), __('% Comments','vw-lawyer-attorney') ); ?></span>
              </div>
              <hr class="big">
              <hr class="small">
              <p><?php echo the_excerpt(); ?></p>
              <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small hvr-sweep-to-right" title="<?php esc_attr_e( 'Read Full', 'vw-lawyer-attorney' ); ?>"><?php esc_html_e('Read Full','vw-lawyer-attorney'); ?></a>
          </div>
      </div>
      <div class="clearfix"></div> 
  </div>
</div>