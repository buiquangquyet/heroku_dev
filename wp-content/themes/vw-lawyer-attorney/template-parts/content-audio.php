<?php
/**
 * The template part for displaying slider
 *
 * @package VW Lawyer Attorney 
 * @subpackage vw_lawyer_attorney
 * @since VW Lawyer Attorney 1.0
 */
?>

<?php
	$content = apply_filters( 'the_content', get_the_content() );
	$audio = false;

	// Only get audio from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
	}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  	<div class="postbox smallpostimage">  		
        <?php
  				if ( ! is_single() ) {

  					// If not a single post, highlight the audio file.
  					if ( ! empty( $audio ) ) {
  						foreach ( $audio as $audio_html ) {
  							echo '<div class="entry-audio">';
  								echo $audio_html;
  							echo '</div><!-- .entry-audio -->';
  						}
  					};

  				};
  			?>
        <div class="new-text">
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