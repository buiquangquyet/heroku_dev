<?php
 class Innova_Blog_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-inova-blog',
      __('Innova-Blog (PB)',innova),
      array( 'description' => __('Use this widget to create blog page',innova) ,'class' => 'kaya_blog' )
    );
    }
    public function widget( $args , $instance ){
     //echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
            'content_limit' => '30',
            'post_limit' => '10',
            'blog_category' => '',
            'title_color' => '#333333',
            'content_color' => '#787878',
            'posts_link_color' => '#ff6c00',
            'posts_link_hover_color' => '#333',
            'disable_pagination' => '',
            'blog_posts_order_by' => '',
            'blog_posts_order' => '',
            'readmore_button_text' => __('Read More',innova),
         ) ); ?>
        <style type="text/css">
          #mid_container .blog_post_wrapper a{
            color: <?php echo $instance['posts_link_color']; ?>
          }
          #mid_container .blog_post_wrapper a:hover{
            color: <?php echo $instance['posts_link_hover_color']; ?>
          }
          #mid_container .blog_post_wrapper p,  #mid_container .blog_post_wrapper{
            color: <?php echo $instance['content_color']; ?>
          }           
        </style>

        <?php 
        global $post;
        echo '<div class="blog_post_wrapper">';
          $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
               'cat' =>  $instance['blog_category'],
               'post_type' => 'post',
               'posts_per_page' => $instance['post_limit'],
               'paged' => $page,
                'orderby' => $instance['blog_posts_order_by'], 
                'order' => $instance['blog_posts_order'], 
               );
      query_posts($args);
      if(have_posts() ) : while( have_posts() ) : the_post(); 
      $class="two_third_last";
      ?>
        <article <?php post_class('standard-blog'); ?> >
   
    <div class="blog_post description">
      <h2>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', innova ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a>
      </h2>
      <span class="meta_desc">
        <span class="category"><i class="fa fa-calendar meta-post-icons"> </i><?php echo get_the_date( )?></span>
        <span class="author"><i class="fa fa-user meta-post-icons"> </i><?php the_author_posts_link(); ?></span>
        <span class="category"><i class="fa fa-tag meta-post-icons"> </i><?php the_category(', '); ?></span>
        <span class="comments"><i class="fa fa-comment meta-post-icons"> </i><?php comments_popup_link(__('0',innova ), __( '1', innova ), __( '%', innova ) ); ?></span>
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
   <?php echo trim( strip_tags( kaya_short_content($instance['content_limit']) ) ); ?></p>
        <a href="<?php echo the_permalink(); ?>" class="readmore blog_read_more"><?php echo $instance['readmore_button_text'] ?></a>
   
  <?php  //} ?><!-- If No Featured Image -->
   <div class="clear"> </div>
   <!--<a class="readmore readmore-1" href="<?php the_permalink(); ?>"><?php echo $kaya_readmore_blog; ?></a>
     #post-## -->
  </article>
      <?php endwhile; endif; 
      if( $instance['disable_pagination'] != 'on' ){
         echo kaya_pagination(); 
      }
       wp_reset_query(); ?>
    </div>
    <?php  //echo $args['after_widget']; 
   ?>
    <?php }
public function form( $instance ){
   $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name .' - '.$category->cat_ID;
               $blog_cat_id[] = $category->cat_ID;
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] = '';
      }
    $instance = wp_parse_args( $instance, array(
        'content_limit' => '30',
        'post_limit' => '10',
        'blog_category' => implode(',',$blog_cat_id),
        'title_color' => '#333333',
        'content_color' => '#787878',
        'posts_link_color' => '#ff6c00',
        'posts_link_hover_color' => '#333',
        'disable_pagination' => '',
        'blog_posts_order_by' => '',
        'blog_posts_order' => '',
        'readmore_button_text' => __('Read More',innova),
             ) );  ?>
        <script type='text/javascript'>
        jQuery(document).ready(function($) {
        jQuery('.blog_color_pickr').each(function(){
        jQuery(this).wpColorPicker();
        }); 
        });
        </script> 
      <div class="input-elements-wrapper"> 
        <p>
        <label for="<?php echo $this->get_field_id('blog_category') ?>">
        <?php _e('Enter Blog Category IDs : ',innova) ?>
        </label>
        <input type="text" name="<?php echo $this->get_field_name('blog_category') ?>" id="<?php echo $this->get_field_id('blog_category') ?>" class="widefat" value="<?php echo $instance['blog_category'] ?>" />
        <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong> <?php echo implode(',', $blog_cat_name); ?></em><br />
        <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
        </p>
      </div>
      <div class="input-elements-wrapper">
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('blog_posts_order_by') ?>"><?php _e('Orderby',innova)?></label>
        <select id="<?php echo $this->get_field_id('blog_posts_order_by') ?>" name="<?php echo $this->get_field_name('blog_posts_order_by') ?>">
        <option value="date" <?php selected('date', $instance['blog_posts_order_by']) ?>>
        <?php esc_html(_e('Date', innova)); ?></option>
        <option value="menu_order" <?php selected('menu_order', $instance['blog_posts_order_by']) ?>>
        <?php esc_html(_e('Menu Order', innova)); ?></option>
        <option value="title" <?php selected('title', $instance['blog_posts_order_by']) ?>>
        <?php esc_html(_e('Title', innova)); ?></option>
        <option value="rand" <?php selected('rand', $instance['blog_posts_order_by']) ?>>
        <?php esc_html(_e('Random', innova)); ?></option>
        <option value="author" <?php selected('author', $instance['blog_posts_order_by']) ?>>
        <?php esc_html(_e('Author', innova)); ?></option>
        </select>
        </p>
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('blog_posts_order') ?>"><?php _e('Order',innova)?></label>
        <select id="<?php echo $this->get_field_id('blog_posts_order') ?>" name="<?php echo $this->get_field_name('blog_posts_order') ?>">
        <option value="DESC" <?php selected('DESC', $instance['blog_posts_order']) ?>>
        <?php esc_html(_e('Descending', innova)); ?></option> 
        <option value="ASC" <?php selected('ASC', $instance['blog_posts_order']) ?>>
        <?php esc_html(_e('Ascending', innova)); ?></option>
        </select>
        </p> 
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('content_limit') ?>"><?php _e('Post Content Limit',innova)?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('content_limit') ?>" name="<?php echo $this->get_field_name('content_limit') ?>" value="<?php echo $instance['content_limit']; ?>" />
        </p>
        <p class="one_fourth_last">
        <label for="<?php echo $this->get_field_id('post_limit') ?>"><?php _e('Display Posts Per Page',innova)?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_limit') ?>" name="<?php echo $this->get_field_name('post_limit') ?>" value="<?php echo $instance['post_limit']; ?>" />
        </p>
      </div>
      <div class="input-elements-wrapper">
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('content_color') ?>"><?php _e('Posts Content Color',innova)?></label>
        <input type="text" class="blog_color_pickr" id="<?php echo $this->get_field_id('content_color') ?>" name="<?php echo $this->get_field_name('content_color') ?>" value="<?php echo $instance['content_color']; ?>" />
        </p>
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('posts_link_color') ?>"><?php _e('Posts Link Color',innova)?></label>
        <input type="text" class="blog_color_pickr" id="<?php echo $this->get_field_id('posts_link_color') ?>" name="<?php echo $this->get_field_name('posts_link_color') ?>" value="<?php echo $instance['posts_link_color']; ?>" />
        </p>
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('posts_link_hover_color') ?>"><?php _e('Posts Link Hover Color',innova)?></label>
        <input type="text" class="blog_color_pickr" id="<?php echo $this->get_field_id('posts_link_hover_color') ?>" name="<?php echo $this->get_field_name('posts_link_hover_color') ?>" value="<?php echo $instance['posts_link_hover_color']; ?>" />
        </p>
      </div>
       <div class="input-elements-wrapper">
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('readmore_button_text') ?>"><?php _e('Readmore Button Text',innova)?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_button_text') ?>" name="<?php echo $this->get_field_name('readmore_button_text') ?>" value="<?php echo $instance['readmore_button_text']; ?>" />
        </p>
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_pagination') ?>"> <?php _e('Disable Pagination',innova) ?> </label>
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
        </p>
      </div>
     <?php  }
 }
 innova_kaya_register_widgets('Innova_Blog_Widget', __FILE__);
 ?>