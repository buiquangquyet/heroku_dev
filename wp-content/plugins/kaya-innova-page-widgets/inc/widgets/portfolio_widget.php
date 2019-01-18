<?php
  class innova_Portfolio_Widget extends WP_Widget{
    public function __construct(){
      global $innova_plugin_name;
        parent::__construct('kaya-portfolio-widget',
            __('Innova-Portfolio (PB)',innova).'&nbsp; <a class="widget_video_tutorials" target="_blank" href="https://www.youtube.com/watch?v=z4S4AiQYeZo">'.__('Watch this video', innova).'</a>',
            array('description' => __('Displays all portfolio items in grid style',innova), 'class' => 'portfolio_widget')
        );
    }
    public function widget( $args, $instance ) {
      global $innova_plugin_name;
          global $post;
      $instance=wp_parse_args($instance, array(
         'title' => '',
         'description' => '',
         'columns' => '4',
         'readmore_text' => __('Read More',innova),
          'text_align'   => __('center',innova),
         'title_color' => '#333333',
         'desc_color' => '#666666',
         'portfolio_limit' => '',
         'kaya_portfolio_filter' => __('false',innova),
         'portfolio_widget_category' => '',
        'pf_display_orderby' => __('menu_order',innova),
        'pf_display_order' => __('DESC',innova),
        'Popular_post_display' => '',
        'disable_title' => '',
        'pf_thumb_height' => '',
        'pf_thumb_width' => '',
        'animation_names' => '',
         'filter_tab_bg_color' => '#333',
        'filter_tab_text_color' => '#ffffff',
        'filter_tab_active_bg_color' => '#ED4E6E',
        'filter_tab_active_text_color' => '#ffffff',
        'disable_pagination' => '',
        'disable_category' => '',
      ));
      switch( $instance['columns'] ){

        case 4:
             $width = "480";  
            break;
        case 3:
            $width ='650';
            break;
         case 2:
            $width = '600';
         }
          $rand = rand(1,100);
?>
    <style type="text/css">
      .filter-<?php echo $rand; ?> a:hover, .filter-<?php echo $rand; ?> .active{
        background-color: <?php echo $instance['filter_tab_active_bg_color']; ?>!important;
        color: <?php echo $instance['filter_tab_active_text_color']; ?>!important;
      }
    </style>
       <?php 
      if ($instance['kaya_portfolio_filter'] == 'true'){ // open filter settings
            echo '<div class="filter_portfolio">';
              echo '<div class="filter filter-'.$rand.'" id="filter">';
                echo '<ul style="text-align:'.$instance['text_align'].';">';
                  echo '<li class="all" ><a class="" href="#" style="color:'.$instance['filter_tab_text_color'].'; background:'.$instance['filter_tab_bg_color'].';" data-category="all">'.__( 'All', innova ).'</a></li>';
                  $category = trim( $instance['portfolio_widget_category']);
                  if( $category ){
                    $pf_categories = @explode(',', $category);
                     for($i=0;$i<count($pf_categories);$i++){
                      $terms[] = get_term_by('id', $pf_categories[$i], 'portfolio_category');
                    } } else {
                      $terms = get_terms('portfolio_category');
                    }
                    foreach($terms as $term) {
                    echo '<li  class="cat-'.$term->term_id .'" >';
                    echo '<a href="" style="color:'.$instance['filter_tab_text_color'].'; background:'.$instance['filter_tab_bg_color'].';" data-category="cat-' . $term->term_id . '">' . $term->name . ' </a></li>';
                    }
                echo '</ul>';
             echo '</div>';
           echo '</div>'; 
      } // end filter
        $pf_animation_effcect = !empty($instance['animation_names']) ? 'wow '.$instance['animation_names'].'' : '';
    echo '<div class="'.$pf_animation_effcect.'">'; 
       $array_val = ( !empty( $instance['portfolio_widget_category'] )) ? explode(',',  $instance['portfolio_widget_category']) : '';
      ?>
        <div class="Portfolio_gallery">
        <ul class="isotope-container portfolio<?php echo $instance['columns'] ?> porfolio_items portfolio_extra clearfix">
         <?php       
      if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
      } elseif ( get_query_var('page') ){
      $paged = get_query_var('page');
      } else {
      $paged = 1;
      }
      $array_val = ( !empty( $instance['portfolio_widget_category'] )) ? explode(',',  $instance['portfolio_widget_category']) : '';
         if( $instance["Popular_post_display"] == '1' || $instance["Popular_post_display"] == 'on' ){
          $args = array('post_type' => 'portfolio', 'showposts' => $instance['portfolio_limit'], 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'field' => 'id', 'order' => $instance['pf_display_order'], 'taxonomy' => 'portfolio_category');
        }else{
         if( $array_val ) {
           $args = array( 'paged' => $paged, 'post_type' => 'portfolio',  'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>$instance['portfolio_limit'],'order' => $instance['pf_display_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'portfolio_category',   'field' => 'id', 'terms' => $array_val  ), ));
          }else{
             $args = array('paged' => $paged, 'post_type' => 'portfolio', 'taxonomy' => 'portfolio_category','term' => $instance['portfolio_widget_category'], 'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>$instance['portfolio_limit'],'order' => $instance['pf_display_order']);
          }
        }
      query_posts($args);
      if( have_posts() ) : while( have_posts() ) : the_post();         
      $terms = get_the_terms(get_the_ID(), 'portfolio_category');
        $terms_id = array();
        $terms_name = array();
       if($terms ){
          foreach ($terms as $term) {
            $terms_id[] = 'cat-'.$term->term_id;
            $terms_name[] = $term ->name;
           }
      }else{
        $terms_name[] = 'Uncategorized';
      }
                ?>
                <li class="all  <?php echo implode(' ', $terms_id); ?>">
                  <div class="innova-portfolio-container">
                     <?php  
                     $pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
              if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
                $permalink = get_permalink();
                $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
                $pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
                $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); 
                $pf_thumb_width = $instance['pf_thumb_width'] ? $instance['pf_thumb_width'] : '800';
                $pf_thumb_height = $instance['pf_thumb_height'] ? $instance['pf_thumb_height'] : '400';
                $default_img_url = constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/portfolio_default_img.jpg';
              if( $img_url ){ ?> 
                <a href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link;  ?>">
                <?php echo '<img src="'.kaya_image_resize( $img_url, $pf_thumb_width, $pf_thumb_height, true ).'" class="" alt="'.$instance['title'].'" />';
                ?></a> 
                <?php }
              else{ ?>
                  <a href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link;  ?>">
              <?php 
                if (is_multisite()){
                     $image_url = $default_img_url;
                  }else{                  
                    $image_url = kaya_image_resize( $default_img_url, $pf_thumb_width, $pf_thumb_height, true );
                  }
                  echo '<img src="'.$image_url.'" class="" alt="'.$instance['title'].'" />'; ?>
                  </a>
            <?php }
              $post_item_bg_color=get_post_meta($post->ID,'post_item_bg_color',true) ? get_post_meta($post->ID,'post_item_bg_color',true) : '#dedede';
              $post_item_text_color=get_post_meta($post->ID,'post_item_text_color',true) ? get_post_meta($post->ID,'post_item_text_color',true) : '#232323';
              if( ($instance['disable_title'] != 'on') || ($instance['disable_category'] != 'on')){  ?>
                  <div class="pf_item_box" style="background-color:<?php echo $post_item_bg_color; ?>;">
                    <div style="color:<?php echo $post_item_text_color; ?>!important;">
                     <?php
                  if( $instance['disable_title'] != 'on'){ ?>
                  <h4 style="color:<?php echo $post_item_text_color; ?>!important;"><?php echo the_title(); ?></h4>
                  <?php } ?>

               <?php    $terms = get_the_terms(get_the_ID(), 'portfolio_category');
if( $instance['disable_category'] != 'on'){ ?>
<?php
            echo "<span>";

            if ($terms) {
                  foreach($terms as $term) {
                echo $term->name;
              }
            } else{ echo 'Uncategorized'; }
          echo "</span>";
            
            ?>
            <?php } ?>          
                  </div>
                  </div>
                 <?php } ?> 
                  </div>

                </li>
                <?php endwhile; endif; ?>
            </ul>
                  <?php 
      if( $instance['disable_pagination'] != 'on'){
        echo kaya_pagination();
      } 
       wp_reset_query(); ?>
         </div>
  <?php echo '</div>'; ?>
   <?php
    }
    public function form($instance){

        $portfolio_terms=  get_terms('portfolio_category','');
        $portfolio_terms=  get_terms('portfolio_category','');
        if( $portfolio_terms ){
          foreach ($portfolio_terms as $portfolio_term) { 
            $pf_cat_ids[] = $portfolio_term->term_id;
             $pf_cats_name[] = $portfolio_term->name.' - '.$portfolio_term->term_id;
          }
        }else{ $pf_cats_name[] = ''; $pf_cat_ids[] =''; }
           $instance = wp_parse_args($instance, array(
          'title' => '',
          'description' => '',
          'columns'  => '4',         
          'text_align'   => __('center',innova),
          'title_color' => '#333333',
          'desc_color' => '#666666',
          'portfolio_limit' => '8',
          'kaya_portfolio_filter' => __('false',innova),
          'portfolio_widget_category' => implode(',', $pf_cat_ids),
          'pf_display_orderby' => __('menu_order',innova),
          'pf_display_order' => __('DESC',innova),
          'Popular_post_display' => '',
          'disable_title' => '',
          'pf_thumb_height' => '',
          'pf_thumb_width' => '',
          'filter_tab_bg_color' => '#333',
          'animation_names' => '',
          'filter_tab_text_color' => '#ffffff',
          'filter_tab_active_bg_color' => '#ED4E6E',
          'filter_tab_active_text_color' => '#ffffff',
          'disable_pagination' => '',
          'disable_category' => '',
           ) ); ?>
           <script type="text/javascript">
      (function($) {
        "use strict";
        $(function() {
        $("#<?php echo $this->get_field_id('kaya_portfolio_filter') ?>").change(function () {
        $(".<?php echo $this->get_field_id('filter_tab_bg_color'); ?>").hide();
        $(".<?php echo $this->get_field_id('filter_tab_text_color'); ?>").hide()
        $(".<?php echo $this->get_field_id('filter_tab_active_bg_color'); ?>").hide()
        $(".<?php echo $this->get_field_id('filter_tab_active_text_color'); ?>").hide()
        var selectlayout = $("#<?php echo $this->get_field_id('kaya_portfolio_filter') ?> option:selected").val(); 
        switch(selectlayout)
          {
            case 'true':
              $(".<?php echo $this->get_field_id('filter_tab_bg_color'); ?>").show();
              $(".<?php echo $this->get_field_id('filter_tab_text_color'); ?>").show()
              $(".<?php echo $this->get_field_id('filter_tab_active_bg_color'); ?>").show()
              $(".<?php echo $this->get_field_id('filter_tab_active_text_color'); ?>").show()
            break;      
          }
        }).change();
        });
      })(jQuery);
      </script>
      <script type='text/javascript'>
    jQuery(document).ready(function($) {
      jQuery('.pf_color_pickr').each(function(){
      jQuery(this).wpColorPicker();
      }); 
    });
  </script>  
      <p>
        <label for="<?php echo $this->get_field_id('portfolio_widget_category') ?>"> <?php _e('Enter Portfolio Category IDs : ',innova) ?> </label>
       <input type="text" name="<?php echo $this->get_field_name('portfolio_widget_category') ?>" id="<?php echo $this->get_field_id('portfolio_widget_category') ?>" class="widefat" value="<?php echo $instance['portfolio_widget_category'] ?>" />
        <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong><?php echo implode(', ', $pf_cats_name); ?></em><br />
         <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
      </p>
      <div class="input-elements-wrapper">
         <p class="one_fifth">
            <label for="<?php echo $this->get_field_id('kaya_portfolio_filter') ?>">
              <?php _e('Portfolio Filter Tabs',innova)?></label>
              <select id="<?php echo $this->get_field_id('kaya_portfolio_filter') ?>" name="<?php echo $this->get_field_name('kaya_portfolio_filter') ?>">
                 <option value="false" <?php selected('false', $instance['kaya_portfolio_filter']) ?>>
                  <?php esc_html(_e('False', innova)); ?></option>
                 <option value="true" <?php selected('true', $instance['kaya_portfolio_filter']) ?>>
                  <?php esc_html(_e('True', innova)); ?></option>
            </select>
        </p>
        <p class="<?php echo $this->get_field_id('filter_tab_bg_color'); ?> one_fifth">
        <label for="<?php echo $this->get_field_id('filter_tab_bg_color'); ?>"><?php _e('Filter Tab BG Color',innova) ?></label>
        <input type="text" name="<?php echo $this->get_field_name('filter_tab_bg_color') ?>" id="<?php echo $this->get_field_id('filter_tab_bg_color') ?>" class="pf_color_pickr" value="<?php echo $instance['filter_tab_bg_color'] ?>" />
      </p>
      <p class="<?php echo $this->get_field_id('filter_tab_text_color'); ?> one_fifth">
        <label for="<?php echo $this->get_field_id('filter_tab_text_color'); ?>"><?php _e('Filter Tab Text Color',innova) ?></label>
        <input type="text" name="<?php echo $this->get_field_name('filter_tab_text_color') ?>" id="<?php echo $this->get_field_id('filter_tab_text_color') ?>" class="pf_color_pickr" value="<?php echo $instance['filter_tab_text_color'] ?>" />
      </p>
      <p class="<?php echo $this->get_field_id('filter_tab_active_bg_color'); ?> one_fifth">
        <label for="<?php echo $this->get_field_id('filter_tab_active_bg_color'); ?>"><?php _e('Filter Tab Acive BG Color',innova) ?></label>
        <input type="text" name="<?php echo $this->get_field_name('filter_tab_active_bg_color') ?>" id="<?php echo $this->get_field_id('filter_tab_active_bg_color') ?>" class="pf_color_pickr" value="<?php echo $instance['filter_tab_active_bg_color'] ?>" />
      </p>
      <p class="<?php echo $this->get_field_id('filter_tab_bg_color'); ?> one_fifth_last">
        <label for="<?php echo $this->get_field_id('filter_tab_active_text_color'); ?>"><?php _e('Filter Tab Active Text Color',innova) ?></label>
        <input type="text" name="<?php echo $this->get_field_name('filter_tab_active_text_color') ?>" id="<?php echo $this->get_field_id('filter_tab_active_text_color') ?>" class="pf_color_pickr" value="<?php echo $instance['filter_tab_active_text_color'] ?>" />
      </p>
       <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('text_align') ?>"><?php _e('Filters Tabs Position',innova)?></label>
              <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
                <option value="left" <?php selected('left', $instance['text_align']) ?>>
                  <?php esc_html(_e(' Left', innova) );?></option>
                  <option value="right" <?php selected('right', $instance['text_align']) ?>>
                  <?php esc_html(_e(' Right', innova)); ?></option>
                  <option value="center" <?php selected('center', $instance['text_align']) ?>>
                 <?php esc_html(_e(' Center', innova)); ?></option>
      </select>
        </p>
    </div>
      <div class="input-elements-wrapper">
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('columns') ?>"><?php _e('Select Columns',innova)?></label>
          <select id="<?php echo $this->get_field_id('columns') ?>" name="<?php echo $this->get_field_name('columns') ?>">
        <option value="4" <?php selected('4', $instance['columns']) ?>>
          <?php esc_html(_e('Column4', innova)); ?></option>
        <option value="3" <?php selected('3', $instance['columns']) ?>>
          <?php esc_html(_e('Column3', innova)); ?></option>
        <option value="2" <?php selected('2', $instance['columns']) ?>>
          <?php esc_html(_e('Column2', innova)); ?></option>
      </select>
        </p>
      <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('pf_display_orderby') ?>"><?php _e('Orderby',innova)?></label>
        <select id="<?php echo $this->get_field_id('pf_display_orderby') ?>" name="<?php echo $this->get_field_name('pf_display_orderby') ?>">
        <option value="date" <?php selected('date', $instance['pf_display_orderby']) ?>>
          <?php esc_html(_e('Date', innova)); ?></option>
       <option value="menu_order" <?php selected('menu_order', $instance['pf_display_orderby']) ?>>
        <?php esc_html(_e('Menu Order', innova)); ?></option>
        <option value="title" <?php selected('title', $instance['pf_display_orderby']) ?>>
          <?php esc_html(_e('Title', innova)); ?></option>
        <option value="rand" <?php selected('rand', $instance['pf_display_orderby']) ?>>
          <?php esc_html(_e('Random', innova)); ?></option>
        <option value="author" <?php selected('author', $instance['pf_display_orderby']) ?>>
          <?php esc_html(_e('Author', innova)); ?></option>
      </select>
        </p>
       <p class="one_fourth_last">
      <label for="<?php echo $this->get_field_id('pf_display_order') ?>"><?php _e('Order',innova)?></label>
        <select id="<?php echo $this->get_field_id('pf_display_order') ?>" name="<?php echo $this->get_field_name('pf_display_order') ?>">
        <option value="ASC" <?php selected('ASC', $instance['pf_display_order']) ?>>
          <?php esc_html(_e('Ascending', innova)); ?></option>
       <option value="DESC" <?php selected('DESC', $instance['pf_display_order']) ?>>
        <?php esc_html(_e('Descending', innova)); ?></option>
        </select>
        </p>
      </div>
      <div class="input-elements-wrapper">
        <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('pf_thumb_width') ?>"><?php _e('Item Thumbnail Width',innova)?></label>
            <input type="text" class="small-text" id="<?php echo $this->get_field_id('pf_thumb_width') ?>" value="<?php echo esc_attr($instance['pf_thumb_width']) ?>" name="<?php echo $this->get_field_name('pf_thumb_width') ?>" />
        <small><?php _e('Ex:800')?></small>
        </p>
        <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('pf_thumb_height') ?>"><?php _e('Item Thumbnail Height',innova)?></label>
            <input type="text" class="small-text" id="<?php echo $this->get_field_id('pf_thumb_height') ?>" value="<?php echo esc_attr($instance['pf_thumb_height']) ?>" name="<?php echo $this->get_field_name('pf_thumb_height') ?>" />
        <small><?php _e('Ex:400')?></small>
        </p>
          <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('portfolio_limit') ?>"><?php _e('Display Number of Images',innova)?></label>
            <input type="text" class="small-text" id="<?php echo $this->get_field_id('portfolio_limit') ?>" value="<?php echo esc_attr($instance['portfolio_limit']) ?>" name="<?php echo $this->get_field_name('portfolio_limit') ?>" />
        </p>
        <p class="one_fourth_last">
        <label for="<?php echo $this->get_field_id('Popular_post_display') ?>"><?php _e('Popular Posts',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("Popular_post_display"); ?>" name="<?php echo $this->get_field_name("Popular_post_display"); ?>"<?php checked( (bool) $instance["Popular_post_display"], true ); ?> />
      </p>
    </div>
    <div class="input-elements-wrapper">
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_pagination') ?>">
        <?php _e('Disable Pagination',innova)?>
        </label>
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
      </p>
       <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_title') ?>"><?php _e('Disable Title',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_title"); ?>" name="<?php echo $this->get_field_name("disable_title"); ?>"<?php checked( (bool) $instance["disable_title"], true ); ?> />
      </p>
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_category') ?>"><?php _e('Disable Category',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_category"); ?>" name="<?php echo $this->get_field_name("disable_category"); ?>"<?php checked( (bool) $instance["disable_category"], true ); ?> />
      </p>
    </div>
      <p>
    <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',
    innova) ?>  </label>
      <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
</p> 
<?php  }
 }
 innova_kaya_register_widgets('innova_Portfolio_Widget', __FILE__);
?>