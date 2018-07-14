<?php
function kaya_relatedpost($postid)
{	
$options=get_option('kayapati');
global $post;
$kaya_readmore_portfolio=$options['kaya_readmore_portfolio'] ? $options['kaya_readmore_portfolio'] : 'Read More';
$tags = wp_get_post_tags($postid);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$args=array(
'tag__in' => $tag_ids,
'post_type' => 'portfolio',
'post__not_in' => array($postid),
'showposts'=>4,  // Number of related posts that will be shown.
 'orderby' => 'rand',
'ignore_sticky_posts'=>1
); 
$my_query = new wp_query($args);
$kaya_related_projects_text=get_theme_mod('pf_related_post_title') ? get_theme_mod('pf_related_post_title'):'Related Projects';
$pf_related_images_height=get_theme_mod('pf_related_images_height') ? get_theme_mod('pf_related_images_height'):'400';

echo '<div class="vspace"> </div>';
if( $my_query->have_posts() ) {
 echo '<hr class="custom_hr">';
	echo '<div class="vspace"> </div>';
		echo '<div id="relatedposts">';
	echo '<h3>'.$kaya_related_projects_text.'</h3><span class="border_left"> </span>';

		echo '<div class="portfolio_extra"><ul class="isotope-container porfolio_items clearfix">';
			while ($my_query->have_posts()) {
				$my_query->the_post();
				$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
				//if ( has_post_thumbnail() ) { ?>
				<li class="isotope-item all">      
					<?php 
					//$post='';
					$width="460";
					$height="400";
					$imgurl=wp_get_attachment_url( get_post_thumbnail_id() ); ?>
					<?php							
					$thumb_id = get_post_thumbnail_id();
					$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
					$lightbox_url=$imgurl;
					$terms = get_the_terms(get_the_ID(), 'portfolio_category');
					$terms_name = array();
					if($terms ){
					foreach ($terms as $term) {
						$terms_name[] = $term ->name;
					}
				}else{
					$terms_name[] = 'Uncategorized';
				}		$lightbox_class="lightbox";   ?>
						<?php 
		                 	$post_item_bg_color=get_post_meta($post->ID,'post_item_bg_color',true) ? get_post_meta($post->ID,'post_item_bg_color',true) : '#dedede';
							$post_item_text_color=get_post_meta($post->ID,'post_item_text_color',true) ? get_post_meta($post->ID,'post_item_text_color',true) : '#232323';
		                 ?>
                        <div class="portfolio-container show-details">
                          <?php	$params = array('width' => '460' , 'height' => $pf_related_images_height, 'crop' => true); ?>

                          <a href="<?php echo the_permalink(); ?>" >
                          	<?php 
                          echo kaya_imageresize($post->ID,$params,' ');      ?>
                      		</a>
                      		<?php
                      		 if(( get_theme_mod('pf_enable_related_posts_title') != 'on') || (get_theme_mod('pf_enable_related_posts_category') != 'on')) : ?>
                      		
                          <div class="pf_item_box" style="background-color:<?php echo $post_item_bg_color; ?>;">
                   			<div style="color:<?php echo $post_item_text_color; ?>!important;">
                   				<?php 
                   				if( get_theme_mod('pf_enable_related_posts_title') != 'on' ): ?>
                                <h4 style="color:<?php echo $post_item_text_color; ?>!important;"><?php echo the_title(); ?></h4>
                                 <?php endif; ?> 
                           <?php if( get_theme_mod('pf_enable_related_posts_category') != 'on' ): ?>
                                <?php
									echo "<span>";
									 echo implode(' , ', $terms_name);
									 echo "</span>";?>
								 <?php endif; ?> 	  
                                   
                            </div>
                          </div>
                          <?php endif; ?> 
                        </div>
					<?php
					//echo '<h4>'.$post_title.'</h4>';
					?>
				</li>
				<?php //}
			}
		echo '</ul>';
	echo '</div>';echo '</div>';
}
}
$backup='';
$post = $backup;
wp_reset_query();
}
?>