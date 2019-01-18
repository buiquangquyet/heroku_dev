<?php
class innova_Latest_News_widget extends WP_Widget{
  public function __construct()
  {
    parent::__construct(
      'kaya-latest-news-widget',
      __('Innova Latest News',innova),
      array('description' => __('Display Latest News from post category',innova), 'class' => 'kaya_latest_news')
      );
  }
     public function widget( $args, $instance ) {
      echo $args['before_widget'];
      global $innova_plugin_name;
      global $post;
      $instance=wp_parse_args($instance, array(
         'title' => '',
         'description' => '',
         'columns' => '4',
         'readmore_text' => __('Read More',innova),
          'text_align'   => __('left',innova),
         'title_color' => '#343434',
         'desc_color' => '#666666',
         'limit' => '3',
         'recent_blog_post' => '',
        'recent_blog_title_color' => '#343434',
        'recent_blog_desc_color' => '#757575',
        'recent_blog_date_color' => '#ED4E6E',
        'disable_description' => '',
        'disable_date' => '',
         'post_content_limit' => '8',
         'disable_comment' => '',
         'recent_blog_comment_color' => '#ED4E6E',
      ));

         ?>
<div class="recent_blog_post">
  <?php  if( $instance['title'] ):
        echo '<div class="custom_title kaya_title_'.$instance['text_align'].'">';
           echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h3>';
        echo '</div>';

      ?>
  <div class="clear"> </div>
  <?php endif; ?>
  <ul>
    <?php
        $loop = new WP_Query(array('post_type' => 'post', 'orderby' => '', 'order' => 'DESC', 'posts_per_page' => $instance['limit'], 'cat' =>  $instance['recent_blog_post']));
           if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
        ?>
    <li>
      <?php  
        $comment_rand = rand(1,20); ?>
        <style>
          .comment_color-<?php echo $comment_rand; ?> a{
            color:<?php echo $instance['recent_blog_comment_color']; ?>!important;
          }
        </style>
      <?php

        $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
      <a href="<?php echo the_permalink(); ?>" >
      <?php if( $img_url ){
           echo '<img src="'.kaya_image_resize( $img_url, 60, 60, true ).'" class="alignleft" alt="'.$instance['title'].'" />';  
        } 
        else{
                echo '<img src="'.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/recent_blog_post_img.jpg" class="alignleft" >';
            } 
        echo '</a>';
        ?>
      <div class="description">
        <h5 style="color:<?php echo $instance['recent_blog_title_color']; ?>">
          <?php the_title(); ?>
        </h5>
        <?php if( $instance['disable_date'] != '1' && $instance['disable_date'] != 'on') : ?>
        <span style="color:<?php echo $instance['recent_blog_date_color']; ?>"><?php echo get_the_date('d.M.Y'); ?> </span><br />
        <?php endif; ?>
        <?php if( $instance['disable_description'] != '1' && $instance['disable_description'] != 'on') : ?>
        <span style="color:<?php echo $instance['recent_blog_desc_color']; ?>">
        <?php  echo strip_tags(kaya_short_content($instance['post_content_limit'])); ?>
        </span><br />
        <?php endif; ?>
        <?php if( $instance['disable_comment'] != '1' && $instance['disable_comment'] != 'on') : ?>
            <span  class="comment_color-<?php echo $comment_rand; ?>"><?php comments_popup_link(__('0 Comments',innova ), __( '1 Comment', innova ), __( '% Comments', innova ) ); ?></span>
        <?php endif; ?>
      </div>
    </li>
    <?php endwhile; endif; ?>
  </ul>
  <?php wp_reset_query(); ?>
</div>
<?php
         echo $args['after_widget'];
    }

    public function form($instance){
         $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name.'-'.$category->cat_ID;
                $blog_cat_id[] = $category->cat_ID;  
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] ='';
      }
        $instance = wp_parse_args($instance, array(
           'title' => '',
           'description' => '',
           'columns'  => '4',
            'readmore_text' => __('Read More',innova),
            'text_align'   => __('left',innova),
            'title_color' => '#343434',
            'desc_color' => '#666666',
            'limit' => '3',
            'recent_blog_post' => implode(',', $blog_cat_id),
            'recent_blog_title_color' => '#343434',
            'recent_blog_desc_color' => '#757575',
            'recent_blog_date_color' => '#ED4E6E',
            'disable_description' => '',
            'disable_date' => '',
            'post_content_limit' => '8',
            'disable_comment' => '',
            'recent_blog_comment_color' => '#ED4E6E ',
            'hide_post_link_icon' => '',
           'hide_lightbox_icon' => '',
       ) ); ?>
       <script type='text/javascript'>
        jQuery(document).ready(function($) {
        jQuery('.recent_blog_color_pickr').each(function(){
        jQuery(this).wpColorPicker();
        }); 
        });
        </script>
<p>
<label for="<?php echo $this->get_field_id('recent_blog_post') ?>">
<?php _e('Select Blog Category',innova) ?>
</label>
     <input type="text" name="<?php echo $this->get_field_name('recent_blog_post') ?>" id="<?php echo $this->get_field_id('recent_blog_post') ?>" class="widefat" value="<?php echo $instance['recent_blog_post'] ?>" />
       <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong> <?php echo implode(',', $blog_cat_name); ?></em><br />
      <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
    </p>
 <div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('recent_blog_title_color') ?>">
  <?php _e('Posts Title Color',innova)?>
  </label>
  <input type="text" class="recent_blog_color_pickr" id="<?php echo $this->get_field_id('recent_blog_title_color') ?>" value="<?php echo esc_attr($instance['recent_blog_title_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_title_color') ?>" />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('recent_blog_date_color') ?>">
  <?php _e('Posts Date Color',innova)?>
  </label>
  <input type="text" class="recent_blog_color_pickr" id="<?php echo $this->get_field_id('recent_blog_date_color') ?>" value="<?php echo esc_attr($instance['recent_blog_date_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_date_color') ?>" />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('recent_blog_desc_color') ?>">
  <?php _e('Posts Description Color',innova)?>
  </label>
  <input type="text" class="recent_blog_color_pickr" id="<?php echo $this->get_field_id('recent_blog_desc_color') ?>" value="<?php echo esc_attr($instance['recent_blog_desc_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_desc_color') ?>" />
</p>
<p class="one_fourth_last">
  <label for="<?php echo $this->get_field_id('recent_blog_comment_color') ?>">
  <?php _e('Posts Comment Color',innova)?>
  </label>
  <input type="text" class="recent_blog_color_pickr" id="<?php echo $this->get_field_id('recent_blog_comment_color') ?>" value="<?php echo esc_attr($instance['recent_blog_comment_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_comment_color') ?>" />
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('limit') ?>">
  <?php _e('Display Number of Posts',innova)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('limit') ?>" value="<?php echo esc_attr($instance['limit']) ?>" name="<?php echo $this->get_field_name('limit') ?>" />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('post_content_limit') ?>">
  <?php _e('Posts Content Limit',innova)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_content_limit') ?>" value="<?php echo esc_attr($instance['post_content_limit']) ?>" name="<?php echo $this->get_field_name('post_content_limit') ?>" />
</p>
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('disable_date') ?>">
  <?php _e('Disable Date',innova)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_date"); ?>" name="<?php echo $this->get_field_name("disable_date"); ?>"<?php checked( (bool) $instance["disable_date"], true ); ?> />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('disable_description') ?>">
  <?php _e('Disable Description',innova)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_description"); ?>" name="<?php echo $this->get_field_name("disable_description"); ?>"<?php checked( (bool) $instance["disable_description"], true ); ?> />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('disable_comment') ?>">
  <?php _e('Disable Comment',innova)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_comment"); ?>" name="<?php echo $this->get_field_name("disable_comment"); ?>"<?php checked( (bool) $instance["disable_comment"], true ); ?> />
</p>
</div>
<?php  }
 }
 innova_kaya_register_widgets('innova_Latest_News_widget', __FILE__);
?>