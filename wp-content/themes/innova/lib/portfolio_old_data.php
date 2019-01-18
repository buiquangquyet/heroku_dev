<?php
	$relatedpost=get_post_meta(get_the_ID(),'relatedpost' ,true);
	$portfolio_project_skills=get_post_meta(get_the_ID(),'portfolio_project_skills' ,false);
	$postid=$post->ID;
	$meta = get_post_meta( $post->ID, 'portfolio_slide', false );
	$video_type = get_post_meta(get_the_ID(), 'video_type', true );
	$pf_featuread_image_disable=get_post_meta(get_the_ID(),'pf_featuread_image_disable' ,true);
	//$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true);
	foreach($meta as $val)
	{
	}
	if (isset( $val ) || ($video_type !='none') ){
	?>
	<div class="<?php echo $sidebar_class; ?>" id="content_section">
	<?php
	get_template_part('loop','portfolio');  ?>
	</div>
	<!--StartSidebar Section -->
	<?php if($sidebar_layout !="full") { ?>
	<div class="<?php echo $aside_class;?> portfolio_aside">
	<?php the_content(); ?>
	</div>
	<?php }  } else{  ?>
	<?php if($sidebar_layout !="full") { ?>
	<div class="fullwidth portfolio_fullwidth">
	<?php
	get_template_part('loop','portfolio');
	echo '<div class="content_box">';
	the_content(); ?>
	</div>	</div>
	<?php } else{
	get_template_part('loop','portfolio');
	//the_content();
	}
	}
?>