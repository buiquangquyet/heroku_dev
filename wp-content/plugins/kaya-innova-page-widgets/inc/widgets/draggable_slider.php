<?php
class Innova_Draggable_slider_Widget extends WP_Widget{
    public function __construct(){
        parent::__construct('innova-draggable-slider-widget',
            __('Innova-Draggable Slider (PB)',innova),
            array('description' => __('Displays portfolio and kaya slider items as draggable slider',innova), 'class' => 'draggable_widget')
        );
    }
       public function widget( $args, $instance ) {
      echo $args['before_widget'];
      global $innova_plugin_name;
          global $post;
      $instance=wp_parse_args($instance, array(
         'title' => '',
         'description' => '',
         'readmore_text' => __('Read More',innova),
          'text_align'   => __('center',innova),
         'title_color' => '#333333',
         'desc_color' => '#666666',
          'pf_slider_cat' => '',
          'portfolio_project_link' => '#',
          'portfolio_project_title' => '',
          'pfslider_thumb_height' => '',
          'pfslider_thumb_width' => '',
          'disable_title' => '',
          'Popular_post_display' => '',
          'pf_display_orderby' => __('menu_order',innova),
          'pf_display_order' => __('ASC',innova),
          'portfolio_slide_items' => '4',
          'pf_auto_play' => __('true',innova),
          'select_cat_type' => '',
          'kaya_slider_cat' => '',
          'disable_gutter' => '',
          'disable_description' => '',
          'disable_category' => '',
          'disable_background' => '',

      ));
            $rand = rand(1,50); 
            $disable_gutter = ( $instance['disable_gutter'] == 'on' ) ? '0' : '15';
            ?>
            <style type="text/css">
            .kaya_portfolio_slider<?php echo $rand; ?>{
              display: none;
              }</style>
       <?php 
       switch ( $instance['portfolio_slide_items'] ) {
      case '5':
       $width = '350';
        break;
      case '4':
        $width = '400';
        break;
      case '3':
        $width = '400';
        break;
      case '2':
        $width = '600';
        break;
      case '1':
        $width = '1920';
        break;  
      default:
        $width = '400';
        break;
      }
          ?>
            <script type="text/javascript">
                (function($) {
                    "use strict";
                  $(window).load(function() {
                      var responsive2_column = ( ( <?php echo $instance['portfolio_slide_items'] ?> == '4' ) || ( <?php echo $instance['portfolio_slide_items'] ?> == '3' ) ) ? '2' : <?php echo $instance['portfolio_slide_items'] ?>;
                  $(".kaya_portfolio_slider<?php echo $rand; ?>").owlCarousel({
                  navigation : false,
                  stopOnHover : true,
                  margin: <?php echo $disable_gutter; ?>,
                  autoplay : <?php echo $instance['pf_auto_play']; ?>,
                  items : <?php echo $instance['portfolio_slide_items']; ?>,
                  onInitialized: function() { 
                   $('.kaya_portfolio_slider<?php echo $rand; ?>').css('display', 'block');
                   $(".portfolio_draggable_slider").css("height", "");
                   $('.slider_bg_loading_img').hide();
                   },
                  
                  responsive: {
                  0:{
                      items:1,
                      },
                      480:{
                          items:1,
                      },
                      768:{
                          items:responsive2_column,
                          loop : false,
                      },
                      1024:{
                          items:<?php echo $instance['portfolio_slide_items'] ?>,
                          loop : true,
                      },
                }, 
     
               });
         });
  })(jQuery);

            </script>
            <?php 
       $post_type = ( $instance['select_cat_type'] == 'portfolio_category' ) ? 'portfolio' : 'slider';
        $post_terms = ( $instance['select_cat_type'] == 'portfolio_category' ) ? $instance['pf_slider_cat'] : $instance['kaya_slider_cat'];
      ?>
    <div class="Portfolio_gallery portfolio_draggable_slider">
    <?php  echo '<span class="slider_bg_loading_img container" style="height:400px; background:url('.constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/bx_loader.gif)"></span>'; ?>
    <div id="kaya_portfolio_widget_slider" class="kaya_portfolio_slider<?php echo $rand; ?>" >
                <?php
    if( $instance['select_cat_type'] == 'portfolio_category'){
      $array_val = ( !empty($instance['pf_slider_cat']) ) ? explode(',', $instance['pf_slider_cat'])  :  '';
    }
    elseif( $instance['select_cat_type'] == 'slider_category'){
     $array_val = ( !empty($instance['kaya_slider_cat']) ) ? explode(',', $instance['kaya_slider_cat'])  :  '';
    } else{ $array_val = '';   } 

    if( ( $instance["Popular_post_display"] == '1') && ($instance["Popular_post_display"] == 'on') ){
      $loop = new WP_Query(array('post_type' => $post_type , 'showposts' => -1, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'field' => 'id', 'order' => $instance['pf_display_order'], 'taxonomy' => $instance['select_cat_type'] ));

    }else{
         if( is_array($array_val ) ){
          $loop = new WP_Query(array( 'post_type' => $post_type,  'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>-1,'order' => $instance['pf_display_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => $instance['select_cat_type'],   'field' => 'id', 'terms' => $array_val  ) )));
          }else{
                 $loop = new WP_Query(array('post_type' => $post_type, 'taxonomy' => $instance['select_cat_type'],'term' => '', 'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>-1,'order' => $instance['pf_display_order']));
          }
        }
                if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post()
                ?>
                  <div class="innova-portfolio-container">
                    <?php 
                        $title=get_the_title($post->Id);
                        $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
                    ?>
                     <?php  //$params = array('width' => '500' , 'height' => '400', 'crop' => true);
                    ?>
                    <?php
                    $pfslider_thumb_width = $instance['pfslider_thumb_width'] ? $instance['pfslider_thumb_width'] : '465';
                    $pfslider_thumb_height = $instance['pfslider_thumb_height'] ? $instance['pfslider_thumb_height'] : '400';
                    if( $img_url ):
                    ?> 
                     
                      <?php 
                      echo '<a href="'.get_permalink().'">';
                       echo '<img src="'.kaya_image_resize( $img_url, $pfslider_thumb_width, $pfslider_thumb_height, true ).'" class=""  alt="'.$title.'"  />';
                      echo'</a>';
                     else:
                //echo '<img src="'.kaya_image_resize( $img_url, $pfslider_thumb_width, $pfslider_thumb_height, 't' ).'" alt="'.$title.'" height="'.$pfslider_thumb_height.'" width="'.$pfslider_thumb_width.'" />';
               $default_img_url = constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/draggable_slider_default_img.jpg';
               if (is_multisite()){
                     $image_url = $default_img_url;
                  }else{                  
                    $image_url = kaya_image_resize( $default_img_url, $pfslider_thumb_width, $pfslider_thumb_height, true);
                  }
                  echo '<img src="'.$image_url.'" alt="'.$title.'" height="'.$pfslider_thumb_height.'" width="'.$pfslider_thumb_width.'" />';

                    endif; 
              $post_item_bg_color=get_post_meta($post->ID,'post_item_bg_color',true) ? get_post_meta($post->ID,'post_item_bg_color',true) : '#dedede';
              $post_item_text_color=get_post_meta($post->ID,'post_item_text_color',true) ? get_post_meta($post->ID,'post_item_text_color',true) : '#232323'; 
              $pf_item_box_bg = ( $instance['disable_background'] !='on' ) ? 'pf_item_box' : 'pf_item_box_no_bg';
              $pf_item_box_bg_dynamic = ( $instance['disable_background'] !='on' ) ? $post_item_bg_color : 'none';
              ?>
                  <?php if( $instance['disable_title'] != 'on' || $instance['disable_description'] != 'on' || $instance['disable_category'] != 'on' ) { ?>               
                  <div class="<?php echo $pf_item_box_bg; ?>" style="background-color:<?php echo $pf_item_box_bg_dynamic; ?>;">
                    <div style="color:<?php echo $post_item_text_color; ?>!important;">                  
                    <?php if( $instance['disable_category'] != 'on'){ 
                        $post_category = ( $instance['select_cat_type'] == 'portfolio_category' ) ? 'portfolio_category' : 'slider_category';
                       $terms = get_the_terms(get_the_ID(), $post_category);
                        echo '<span style="color:'.$post_item_text_color.'!important;">';
                        if ($terms) {
                              foreach($terms as $term) {
                            echo $term->name;
                          }
                        } else{ echo 'Uncategorized'; }
                      echo "</span>"; 
                    }  ?>
                    <?php if( $instance['disable_title'] != 'on'){ ?>
                        <h4> <a href="<?php echo the_permalink(); ?>" style="color:<?php echo $post_item_text_color; ?>!important;"><?php echo the_title(); ?></a></h4>
                    <?php } ?>
                    <?php if( !empty($post->post_excerpt) ){ 
                     if( $instance['disable_description'] != 'on'): ?> 
                      <p style="color:<?php echo $post_item_text_color; ?>!important;"><?php echo get_the_excerpt(); ?></p>
                    <?php endif;
                      } ?>
                    </div>
                  </div>  
                   <?php } ?>
                  </div>

                <?php endwhile; endif; ?>
            </div>
               <?php wp_reset_query(); ?>
           </div>
   <?php
         echo $args['after_widget'];
    }
    public function form($instance){

          $portfolio_terms=  get_terms('portfolio_category','');
    if( $portfolio_terms ){
      foreach ($portfolio_terms as $portfolio_term) { 
         $pf_cats_name[] = $portfolio_term->name.' - '.$portfolio_term->term_id;
         $pf_cats_id[] = $portfolio_term->term_id;
      }
    }else{
      $pf_cats_name[] = '';
      $pf_cats_id[] = '';
    }
     $kayaslider_array =get_terms('slider_category','hide_empty=1');
    if( $kayaslider_array ){
        foreach ($kayaslider_array as $sliders) {
               $kaya_cat_name[] = $sliders->name.' - '.$sliders->term_id;
                $kaya_cat_id[] =$sliders->term_id;
      } } else{
          $kaya_cat_name[] = '';
           $kaya_cat_id[] ='';
      }

           $instance = wp_parse_args($instance, array(
          'title' => '',
          'description' => '',
          'readmore_text' => __('Read More',innova),
          'text_align'   => __('center',innova),
          'title_color' => '#333333',
          'desc_color' => '#666666',
          'pf_slider_cat' => '',
          'portfolio_project_link' => '#',
          'portfolio_project_title' => '',
          'pfslider_thumb_height' => '',
          'pfslider_thumb_width' => '',
          'disable_title' => '',
          'disable_description' => '',
          'disable_category' => '',
          'disable_background' => '',
          'Popular_post_display' => '',
          'pf_display_orderby' => __('menu_order',innova),
          'pf_display_order' => __('ASC',innova),
          'portfolio_slide_items' => '4',
          'disable_gutter' => '',
          'pf_auto_play' => __('true',innova),
          'kaya_slider_cat' => '',
          'select_cat_type' => '',
           ) ); 
           ?>
           <script type="text/javascript">
      (function($) {
      "use strict";
      $(function() {

      $("#<?php echo $this->get_field_id('select_cat_type') ?>").change(function () {
      $("#<?php echo $this->get_field_id('kaya_slider_cat') ?>").parent().hide();
      $("#<?php echo $this->get_field_id('pf_slider_cat') ?>").parent().hide();
      var selectlayout = $("#<?php echo $this->get_field_id('select_cat_type') ?> option:selected").val(); 
      switch(selectlayout)
        {
          case 'portfolio_category':
           $("#<?php echo $this->get_field_id('pf_slider_cat') ?>").parent().show();
          break;
          case 'slider_category':
           $("#<?php echo $this->get_field_id('kaya_slider_cat') ?>").parent().show();
          break;


        }
      }).change();
     });
  })(jQuery);
    </script>
    <script type='text/javascript'>
        jQuery(document).ready(function($) {
        jQuery('.recent_blog_color_pickr').each(function(){
        jQuery(this).wpColorPicker();
        }); 
        });
        </script> 
        <p>
      <label for="<?php echo $this->get_field_id('select_cat_type') ?>"> <?php _e('Select Slider Category : ',innova); ?></label>
      <select id="<?php echo $this->get_field_id('select_cat_type') ?>" name="<?php echo $this->get_field_name('select_cat_type') ?>">
       <option value="portfolio_category" <?php selected('portfolio_category', $instance['select_cat_type']) ?>> <?php _e('Portfolio Category',innova) ?> </option> 
       <option value="slider_category" <?php selected('slider_category',$instance['select_cat_type']) ?>>
        <?php _e('Kaya Slider Category',innova) ?></option>
       </select>
      </p>
         <p>
      <label for="<?php echo $this->get_field_id('pf_slider_cat') ?>">  <?php _e('Enter Portfolio Category IDs : ',innova) ?>  </label>
          <input type="text" name="<?php echo $this->get_field_name('pf_slider_cat') ?>" id="<?php echo $this->get_field_id('pf_slider_cat') ?>" class="widefat" value="<?php echo $instance['pf_slider_cat'] ?>" />
     <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong> <?php echo implode(',', $pf_cats_name); ?></em><br />
     <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
    </p>
   <p>
      <label for="<?php echo $this->get_field_id('kaya_slider_cat') ?>">   <?php _e('Enter Kaya Slider Category IDs : ',innova) ?>  </label>
          <input type="text" name="<?php echo $this->get_field_name('kaya_slider_cat') ?>" id="<?php echo $this->get_field_id('kaya_slider_cat') ?>" class="widefat" value="<?php echo $instance['kaya_slider_cat'] ?>" />
      <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong><?php echo implode(',', $kaya_cat_name); ?></em><br />
      <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
    </p>
    <div class="input-elemennts-wrapper">
      <p class="one_fourth">
            <label for="<?php echo $this->get_field_id('portfolio_slide_items') ?>"><?php _e('Display Items',innova); ?></label>
         <select id="<?php echo $this->get_field_id('portfolio_slide_items') ?>" name="<?php echo $this->get_field_name('portfolio_slide_items') ?>">
          <option value="1" <?php selected('1', $instance['portfolio_slide_items']) ?>>
            <?php esc_html(_e('1 Item', innova)); ?></option>
          <option value="2" <?php selected('2', $instance['portfolio_slide_items']) ?>>
            <?php esc_html(_e('2 Items', innova)); ?></option>
          <option value="3" <?php selected('3', $instance['portfolio_slide_items']) ?>>
            <?php esc_html(_e('3 Items', innova)); ?></option>
          <option value="4" <?php selected('4', $instance['portfolio_slide_items']) ?>>
            <?php esc_html(_e('4 Items', innova)); ?></option>
          <option value="5" <?php selected('5', $instance['portfolio_slide_items']) ?>>
            <?php esc_html(_e('5 Items', innova)); ?></option>
      </select>
        </p>
        <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('pf_auto_play') ?>">
          <?php _e('Auto Play',innova)?>
          </label>
          <select id="<?php echo $this->get_field_id('pf_auto_play') ?>" name="<?php echo $this->get_field_name('pf_auto_play') ?>">
            <option value="true" <?php selected('true', $instance['pf_auto_play']) ?>>
            <?php esc_html(_e('True', innova)); ?>
            </option>
            <option value="false" <?php selected('false', $instance['pf_auto_play']) ?>>
            <?php esc_html(_e('False', innova)); ?>
            </option>
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
          <label for="<?php echo $this->get_field_id('pfslider_thumb_height') ?>"><?php _e('Slider Item Thumbnail Height',innova)?></label>
          <input type="text" class="widefat" id="<?php echo $this->get_field_id('pfslider_thumb_height') ?>" value="<?php echo esc_attr($instance['pfslider_thumb_height']) ?>" name="<?php echo $this->get_field_name('pfslider_thumb_height') ?>" />
        <small><?php _e('Ex:400'); ?></small></p>
        <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('pfslider_thumb_width') ?>"><?php _e('Slider Item Thumbnail width',innova)?></label>
          <input type="text" class="widefat" id="<?php echo $this->get_field_id('pfslider_thumb_width') ?>" value="<?php echo esc_attr($instance['pfslider_thumb_width']) ?>" name="<?php echo $this->get_field_name('pfslider_thumb_width') ?>" />
          <small><?php _e('Ex:400'); ?></small>
        </p>
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('Popular_post_display') ?>"><?php _e('Popular Posts',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("Popular_post_display"); ?>" name="<?php echo $this->get_field_name("Popular_post_display"); ?>"<?php checked( (bool) $instance["Popular_post_display"], true ); ?> />
      </p>
       <p class="one_fourth_last">
        <label for="<?php echo $this->get_field_id('disable_gutter') ?>"><?php _e('Disable Gutter',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_gutter"); ?>" name="<?php echo $this->get_field_name("disable_gutter"); ?>"<?php checked( (bool) $instance["disable_gutter"], true ); ?> />
      </p>  
      </div>
      <div class="input-elements-wrapper"> 
        <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_background') ?>"><?php _e('Disable Background Color',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_background"); ?>" name="<?php echo $this->get_field_name("disable_background"); ?>"<?php checked( (bool) $instance["disable_background"], true ); ?> />
      </p>  
      <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_category') ?>"><?php _e('Disable Category Name',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_category"); ?>" name="<?php echo $this->get_field_name("disable_category"); ?>"<?php checked( (bool) $instance["disable_category"], true ); ?> />
      </p>
         <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('disable_title') ?>"><?php _e('Disable Title',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_title"); ?>" name="<?php echo $this->get_field_name("disable_title"); ?>"<?php checked( (bool) $instance["disable_title"], true ); ?> />
      </p>
      <p class="one_fourth_last">
        <label for="<?php echo $this->get_field_id('disable_description') ?>"><?php _e('Disable Description',innova)?></label>
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_description"); ?>" name="<?php echo $this->get_field_name("disable_description"); ?>"<?php checked( (bool) $instance["disable_description"], true ); ?> />
      </p>
    </div>
<?php  }
}
innova_kaya_register_widgets('Innova_Draggable_slider_Widget', __FILE__);
?>