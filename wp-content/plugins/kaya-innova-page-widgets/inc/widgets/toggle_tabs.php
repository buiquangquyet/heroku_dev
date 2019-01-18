<?php
class Innova_Toggle_Tabs_Accordion extends WP_Widget{
public function __construct(){
  global $innova_plugin_name;
  parent::__construct(
    'toggle-tabs-accordion',
    __('Innova - Toggle & Tabs',innova).'&nbsp; <a class="widget_video_tutorials" target="_blank" href="">'.__('Watch this video', $innova_plugin_name).'</a>',
    array('description' => __('Add Toggle tabs and Accordion widget',innova))
    );
}
public function widget($args, $instance){
  global $innova_plugin_name, $post;
  $instance = wp_parse_args($instance, array(
      'title' => '',
      'select_type' => '',
      'select_tabs_type' => 'horizontal',
      'tabs_acordion_order' => '',
      'tabs_acordion_orderby' => '',
      'taba_accordion_cat' => '',
      'limit' => '',
      'tabs_bg_color' => '#ffffff',
      'tabs_content_bg_color' => '#eee',
      'tabs_content_color' => '#666',
      'tabs_title_color' => '#343434',
      'tabs_border_color' => '#f5f5f5',
      'tabs_content_link_color' => '#343434',
      'tabs_active_bg_color' => '',
      'tabs_active_title_color' => '',
      'tabs_active_border_color' => '',
      'animation_names' => '',
      'tabs_content_bg_border_color' => '#f5f5f5',
      'tabs_position' => 'center',
      'tabs_font_size' => '16',
      'tabs_font_weight' => 'bold',
      'tabs_container_bar_border_color' => '',
      'tab_active_strip_color' => '',
      'tab_icon_position' => 'left',
      'tab_icon_size' => '14',
      'tabs_border_radius' => '0',
      'tabs_container_bar_border_radius' => '0',
      'tab_icon_color' => '#343434',
      'tabs_margin' => '0',
      'disable_tab_title' => '',
      'tabs_contant_padding_top' => '30',
      'tabs_contant_padding_bottom' => '30',
      'tabs_contant_padding_left' => '30',
      'tabs_contant_padding_right' => '30',
      'tabs_padding_top' => '10',
      'tabs_padding_bottom' => '10',
      'tabs_padding_left' => '20',
      'tabs_padding_right' => '20',
      'vtabs_position_right' => '',
    ));
  // Accordion Script
    $tabs_rand_class = rand(1,100);
    $toggle_rand_class = rand(1,100);
    $active_bg_color = $instance['tabs_active_bg_color'] ? 'background-color:'.$instance['tabs_active_bg_color'].'!important;' :'';
    $active_border_color = $instance['tabs_active_border_color'] ? 'border:1px solid '.$instance['tabs_active_border_color'].'!important;' :'';  ?>
    <style>
    .accordion > div a, .toggle_content .block a, .tabDetails a{
      color:<?php echo $instance['tabs_content_link_color'] ?>;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs li.tab-active > a, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .tab-active a, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs > ul > li a:hover, .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs > ul > li a:hover,
    .toggle_container_wrapper .trigger.active, .accordion > strong.ui-state-active, .accordion > strong.ui-accordion-header:hover{
      <?php echo $active_bg_color; ?>
      <?php echo $active_border_color; ?>
      color: <?php echo $instance['tabs_active_title_color'] ?>!important;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .tab-active a i, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs > ul > li a:hover i,.tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .tab-active a i, .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs > ul > li a:hover i{
      color: <?php echo $instance['tabs_active_title_color'] ?>!important;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs ul li{
      margin-right: <?php echo $instance['tabs_margin'] ?>px;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li{
      margin-bottom: <?php echo $instance['tabs_margin'] ?>px;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs ul li a{
           border-radius: <?php echo $instance['tabs_border_radius'] ?>px;
    }
     <?php if( $instance['vtabs_position_right'] == 'on' ){ ?>
      .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li a{
        border-radius: 0 <?php echo $instance['tabs_border_radius'] ?>px  <?php echo $instance['tabs_border_radius'] ?>px 0;
      }
    <?php }else{ ?>
       .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li a{
        border-radius: <?php echo $instance['tabs_border_radius'] ?>px 0 0 <?php echo $instance['tabs_border_radius'] ?>px;
      }
    <?php } ?>
    <?php if( $instance['tabs_container_bar_border_radius'] != '0' ){ ?>
     .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs ul li:first-child a{
        border-radius: <?php echo $instance['tabs_container_bar_border_radius'] ?>px 0 0 <?php echo $instance['tabs_container_bar_border_radius'] ?>px!important;
      }
      .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs ul li:last-child a{
        border-radius: 0 <?php echo $instance['tabs_container_bar_border_radius'] ?>px <?php echo $instance['tabs_container_bar_border_radius'] ?>px 0!important;
      }     
      <?php if( $instance['vtabs_position_right'] == 'on' ){ ?>
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li:last-child a{
          border-radius: 0  0 <?php echo $instance['tabs_container_bar_border_radius'] ?>px !important;
        }
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li:first-child a{
          border-radius: 0 <?php echo $instance['tabs_container_bar_border_radius'] ?>px 0 0 !important;
        }
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs.right_vtabs .tabDetails{
          border-radius: <?php echo $instance['tabs_container_bar_border_radius'] ?>px 0 0 <?php echo $instance['tabs_container_bar_border_radius'] ?>px;
        }
      <?php }else{ ?>
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li:last-child a{
          border-radius: 0  0 0 <?php echo $instance['tabs_container_bar_border_radius'] ?>px !important;
        }
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs ul li:first-child a{
          border-radius: <?php echo $instance['tabs_container_bar_border_radius'] ?>px 0 0 0!important;
        }
      <?php  } ?>
    <?php } ?>
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .tabDetails p, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .tabDetails  p{
      color: <?php echo $instance['tabs_content_color'] ?>!important;
    }
    .toggle-<?php echo $toggle_rand_class; ?> .toggle_container_wrapper p{
      color: <?php echo $instance['tabs_content_color'] ?>!important;
    }
    <?php if( $instance['tab_active_strip_color'] ):
      if( $instance['vtabs_position_right'] == 'on' ){ ?>
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .tab-active a::after, .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs a:hover::after{
       border-color: transparent <?php echo $instance['tab_active_strip_color'] ?> transparent transparent !important;
        }
      <?php }else{   ?>
        .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .tab-active a::after, .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs a:hover::after{
          border-color: transparent transparent transparent <?php echo $instance['tab_active_strip_color'] ?>!important;
        } 
      <?php } ?>
        .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .tab-active a::after, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs  ul > li a:hover::after{
          border-color: <?php echo $instance['tab_active_strip_color'] ?> transparent transparent!important;
        }
      <?php else: ?>
        .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs  ul > li.tab-active a::after, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs  ul > li a:hover ::after{
          content:inherit;
          border-width: 0px!important;
        }
      <?php endif; ?>
    </style>
    <?php
  $accordion_rand = rand(1,100);
  $tabs_rand = rand(1,1000);
      if( $instance['select_type'] == 'accordion' ){
        wp_enqueue_script('jquery-ui-accordion');  ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $( "#accordion<?php echo $accordion_rand; ?>" ).accordion({
            autoHeight: true,
            collapsible: false,
            heightStyle: "content"
          });
         });
    </script>
        <?php  } // Tabs Script ?>
    <?php    if( $instance['select_type'] == 'tabs' ){ ?>
    <script type="text/javascript">
   jQuery(document).ready(function($) { 
      $('.widget_toggle-tabs-accordion').each(function(){
      $("#tabid-<?php echo $tabs_rand; ?> .tab_content").hide(); //Hide all content
      $("#tabid-<?php echo $tabs_rand; ?> ul.tabContaier li:first").addClass("tab-active").show();
      $("#tabid-<?php echo $tabs_rand; ?> .tab_content:first").stop(true,true).fadeIn(0);
      $("#tabid-<?php echo $tabs_rand; ?> ul.tabContaier li").click(function() {
      $("#tabid-<?php echo $tabs_rand; ?> ul.tabContaier li").removeClass("tab-active");
      $(this).addClass("tab-active");
      $("#tabid-<?php echo $tabs_rand; ?> .tab_content").stop(true,true).fadeOut(0);
      var activeTab = $(this).find("a").attr("href");
      $(activeTab).stop(true,true).fadeIn(800);
      return false;
      });
      });
   });
    </script>
    <?php
  } ?>
  <?php  // Switch case in tabs type and add classes
  echo $args['before_widget'];
    if( $instance['select_tabs_type'] == 'vertical'){
        $right_vtabs = ( $instance['vtabs_position_right'] == 'on' ) ? 'right_vtabs' : '';
    }else{
         $right_vtabs = '';
    }
    switch ($instance['select_type']) {
      case 'accordion':
        $ids='accordion'.$accordion_rand.'';
        $class = '';
        break;
      case 'tabs':
        $ids='tabid-'.$tabs_rand.'';
        $class = $right_vtabs .' tabContaier tabs-'.$tabs_rand_class.'';
        break;
      case 'toggle':
        $ids='';
        $class = 'toggle-'.$toggle_rand_class.'';
        break;
      default:
        $ids='';
         $class = '';
        break;
    }
    $animation = !empty($instance['animation_names']) ? 'wow '.$instance['animation_names'].'' : '';

    echo '<div class="'.$animation.' '.$instance['select_type'].'_wrapper '.$instance['select_type'].' '.$class.' '.$instance['select_tabs_type'].'_tabs" id="'.$ids.'">';
    // Adding ul when tabs active 
    if( $instance['tabs_position'] == 'left' ){
      $htabs_align = 'float:left';
    }elseif( $instance['tabs_position'] == 'right' ){
      $htabs_align = 'float:right';
    }else{
      $htabs_align = 'margin:0px auto!important;';
    }
    if( ($instance['tabs_content_bg_color'] != '') || ( $instance['tabs_content_bg_border_color'] !='' ) ){
      $tab_content_bg = 'background-color:'.$instance['tabs_content_bg_color'].';';
      $tabs_content_padding = '';
    }else{
      $tabs_content_padding = 'padding-left:0px; padding-right:0px;';
      $tab_content_bg = '';
    }
    if( $instance['select_tabs_type'] == 'horizontal' ){
      $border_radius = $instance['tabs_container_bar_border_radius'].'px;';
    }
    else{
      if( $instance['vtabs_position_right'] == 'on' ){
        $border_radius = ' 0 '.$instance['tabs_container_bar_border_radius'].'px  '.$instance['tabs_container_bar_border_radius'].'px 0px;';
      }else{
        $border_radius = $instance['tabs_container_bar_border_radius'].'px 0 0 '.$instance['tabs_container_bar_border_radius'].'px;';
      }
    }
    $tabs_container_bar_border = $instance['tabs_container_bar_border_color'] ? '1' : '0';
    $tabs_content_border_color = $instance['tabs_content_bg_border_color'] ? '1' : '0'; 
    if ($instance['select_type'] == 'tabs') { echo '<ul class="tabContaier" style="border-radius:'.$border_radius.'; '.$htabs_align.'; border:'.$tabs_container_bar_border.'px solid '.$instance['tabs_container_bar_border_color'].';">'; }
    $array_val = ( !empty( $instance['taba_accordion_cat'] )) ? explode(',', $instance['taba_accordion_cat']) : '';
        if( $array_val ) {
          $loop = new WP_Query(array( 'post_type' => 'tabs',   'orderby' => $instance['tabs_acordion_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['tabs_acordion_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'toggletabs_category',   'field' => 'id', 'terms' => $array_val  ) )));
          }else{
             $loop = new WP_Query(array('post_type' => 'toogletabs' , 'taxonomy' => 'toggletabs_category', 'term' => $instance['taba_accordion_cat'], 'orderby' => $instance['tabs_acordion_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['tabs_acordion_order'] ));
          }
  if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
    $tab_awesome_icon_name = get_post_meta(get_the_ID(),'tab_awesome_icon_name',true);
    if( ( $instance['tab_icon_position'] == 'left' ) || ( $instance['tab_icon_position'] == 'top' ) ){
       $tab_awesome_icon_left_top = $tab_awesome_icon_name ? '<i class="fa '.$tab_awesome_icon_name.' icon_position_'.$instance['tab_icon_position'].'" style="font-size:'.$instance['tab_icon_size'].'px; color:'.$instance['tab_icon_color'].';"> </i>' : '';
        $tab_awesome_icon_right_bottom = '';
    }elseif( ( $instance['tab_icon_position'] == 'right' ) || ( $instance['tab_icon_position'] == 'bottom' ) ){
        $tab_awesome_icon_right_bottom = $tab_awesome_icon_name ? '<i class="fa '.$tab_awesome_icon_name.' " style="font-size:'.$instance['tab_icon_size'].'px; color:'.$instance['tab_icon_color'].';"> </i>' : '';
        $tab_awesome_icon_left_top = '';
    }else{
    }
    if( $instance['select_type'] == 'accordion' ){ // Accordion ?>
      <strong style="font-size:<?php echo $instance['tabs_font_size']; ?>px; font-weight:<?php echo $instance['tabs_font_weight'] ?>; border-radius:<?php echo $instance['tabs_border_radius'] ?>px; background-color:<?php echo $instance['tabs_bg_color']; ?>; color:<?php echo $instance['tabs_title_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;padding:<?php echo $instance['tabs_padding_top'].'px '.$instance['tabs_padding_right'].'px '.$instance['tabs_padding_bottom'].'px '.$instance['tabs_padding_left'].'px '; ?> "><i class="toggle_title_icon fa <?php echo $tab_awesome_icon_name; ?>"> </i><span><?php echo the_title(); ?></span></strong>
      <div style="padding:<?php echo $instance['tabs_contant_padding_top'] ?>px <?php echo $instance['tabs_contant_padding_right'] ?>px <?php echo $instance['tabs_contant_padding_bottom'] ?>px <?php echo $instance['tabs_contant_padding_left'] ?>px; border-radius:<?php echo $instance['tabs_border_radius'] ?>px; background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:<?php echo $tabs_content_border_color; ?>px solid <?php echo $instance['tabs_content_bg_border_color'] ?>;"><div class="accordion_animation"><?php echo the_content(); ?></div></div> 
    <?php } 
      elseif( $instance['select_type'] == 'toggle' ){ // Toggle ?>
        <div class="toggle_container_wrapper" style="margin-bottom:<?php echo $instance['tabs_margin'] ?>px;"><strong class="trigger" style="font-size:<?php echo $instance['tabs_font_size']; ?>px; font-weight:<?php echo $instance['tabs_font_weight'] ?>; border-radius:<?php echo $instance['tabs_border_radius'] ?>px; background-color:<?php echo $instance['tabs_bg_color']; ?>; color:<?php echo $instance['tabs_title_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>; padding:<?php echo $instance['tabs_padding_top'].'px '.$instance['tabs_padding_right'].'px '.$instance['tabs_padding_bottom'].'px '.$instance['tabs_padding_left'].'px '; ?> " ><i class="toggle_title_icon fa <?php echo $tab_awesome_icon_name; ?>"> </i><span><?php echo the_title(); ?></span><i class="fa fa-angle-left arrow_buttons"></i></strong><div class="toggle_content"><div class="block" style="padding:<?php echo $instance['tabs_contant_padding_top'] ?>px <?php echo $instance['tabs_contant_padding_right'] ?>px <?php echo $instance['tabs_contant_padding_bottom'] ?>px <?php echo $instance['tabs_contant_padding_left'] ?>px;  border-radius:<?php echo $instance['tabs_border_radius'] ?>px; background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:<?php echo $tabs_content_border_color; ?>px solid <?php echo $instance['tabs_content_bg_border_color'] ?>;"><?php echo the_content(); ?></div></div></div>
     <?php }
      elseif ($instance['select_type'] == 'tabs') { // Tabs
        $tab_id = $post->ID;
       $string = mb_strtolower( preg_replace("/[\s_]/", "-", get_the_title()));
       $tabs_border_color = $instance['tabs_border_color'] ? '1' : '0';
       if( $instance['disable_tab_title'] != 'on' ){
        $tab_title = '<span>'.get_the_title().'</span>';
       }else{
          $tab_title = '';
       }
        echo '<li><a class="icon_position_'.$instance['tab_icon_position'].'" style="background-color:'.$instance['tabs_bg_color'].'; color:'.$instance['tabs_title_color'].'; border:'.$tabs_border_color.'px solid'.$instance['tabs_border_color'].'; font-size:'.$instance['tabs_font_size'].'px; font-weight:'.$instance['tabs_font_weight'].'; padding:'.$instance['tabs_padding_top'].'px '.$instance['tabs_padding_right'].'px '.$instance['tabs_padding_bottom'].'px '.$instance['tabs_padding_left'].'px;" href="#'.'tab-'.$tab_id.'">'.$tab_awesome_icon_left_top.''.$tab_title.''.$tab_awesome_icon_right_bottom .'</a></li>';
      } ?>
  <?php endwhile;
  wp_reset_query();
  endif;
     if ($instance['select_type'] == 'tabs') { echo '</ul>'; // End Tabs UL
     if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post(); // Tabs Content loop
     $tab_id = $post->ID;
       $string = mb_strtolower( preg_replace("/[\s_]/", "-", get_the_title())); ?>
       <div id="<?php echo 'tab-'.$tab_id.''; ?>" class="tab_content ">
           <div class="tabDetails" style="padding:<?php echo $instance['tabs_contant_padding_top'].'px '.$instance['tabs_contant_padding_right'].'px ' .$instance['tabs_contant_padding_bottom'].'px '.$instance['tabs_contant_padding_right'].'px;' ?>; <?php echo $tab_content_bg . ' ' .$tabs_content_padding; ?> color:<?php echo $instance['tabs_content_color']; ?>; border:<?php echo $tabs_content_border_color; ?>px solid <?php echo $instance['tabs_content_bg_border_color'] ?>;"><?php the_content(); ?></div>
      </div>
     <?php endwhile;
     wp_reset_query();
     endif; // End Tabs Loop
     }
  echo  '</div>';
  echo $args['after_widget'];
}
// Form
public function form($instance){
   global $innova_plugin_name;
  $tabs_terms=  get_terms('toggletabs_category','');
        if( $tabs_terms ){
          foreach ($tabs_terms as $tabs_term) { 
            $tab_cat_ids[] = $tabs_term->term_id;
             $tab_cats_name[] = $tabs_term->name.' - '.$tabs_term->term_id;
          }
        }else{ $tab_cats_name[] = ''; $tab_cat_ids[] = ''; }
    $instance = wp_parse_args($instance, array(
      'title' => '',
      'select_type' => '',
      'select_tabs_type' => 'horizontal',
      'tabs_acordion_order' => '',
      'tabs_acordion_orderby' => '',
      'taba_accordion_cat' => implode(',', $tab_cat_ids),
      'limit' => '',
      'tabs_bg_color' => '#ffffff',
      'tabs_content_bg_color' => '#eee',
      'tabs_content_color' => '#666',
      'tabs_title_color' => '#343434',
      'tabs_border_color' => '#f5f5f5',
      'tabs_content_link_color' => '#343434',
      'tabs_active_bg_color' => '',
      'tabs_active_title_color' => '',
      'tabs_active_border_color' => '',
      'animation_names' => '',
      'tabs_content_bg_border_color' => '#f5f5f5',
      'tabs_position' => 'center',
      'tabs_font_size' => '16',
      'tabs_font_weight' => 'bold',
      'tabs_container_bar_border_color' => '',
      'tab_active_strip_color' => '',
      'tab_icon_position' => 'left',
      'tab_icon_size' => '14',
      'tabs_border_radius' => '0',
      'tabs_container_bar_border_radius' => '0',
      'tab_icon_color' => '#343434',
      'tabs_margin' => '0',
      'disable_tab_title' => '',
      'tabs_contant_padding_top' => '30',
      'tabs_contant_padding_bottom' => '30',
      'tabs_contant_padding_left' => '30',
      'tabs_contant_padding_right' => '30',
      'tabs_padding_top' => '10',
      'tabs_padding_bottom' => '10',
      'tabs_padding_left' => '20',
      'tabs_padding_right' => '20',
      'vtabs_position_right' => '',

    )); ?>
<script type="text/javascript">
  (function($) {
    "use strict";
    $(function() {
    $("#<?php echo $this->get_field_id('select_type') ?>").change(function () {
    $("#<?php echo $this->get_field_id('select_tabs_type') ?>").parent().hide();
    $(".<?php echo $this->get_field_id('tabs_active_border_color') ?>").hide();
    $(".<?php echo $this->get_field_id('tabs_container_bar_border_color') ?>").hide();
    $(".<?php echo $this->get_field_id('tab_active_strip_color') ?>").hide();
    $("#<?php echo $this->get_field_id('tab_icon_position') ?>").parent().parent().hide();
    $("#<?php echo $this->get_field_id('tabs_container_bar_border_radius') ?>").parent().hide();
    $("#<?php echo $this->get_field_id('tab_icon_size') ?>").parent().hide();
    $("#<?php echo $this->get_field_id('disable_tab_title') ?>").parent().hide();
    $(".<?php echo $this->get_field_id('tab_icon_color') ?>").hide();
    $("#<?php echo $this->get_field_id('tabs_margin') ?>").parent().show();
    var selectlayout = $("#<?php echo $this->get_field_id('select_type') ?> option:selected").val(); 
    switch(selectlayout)
    {
    case 'tabs':
        tabs_display();
        $("#<?php echo $this->get_field_id('select_tabs_type') ?>").parent().show();
        $(".<?php echo $this->get_field_id('tabs_active_border_color') ?>").show();
        $(".<?php echo $this->get_field_id('tabs_container_bar_border_color') ?>").show();
        $(".<?php echo $this->get_field_id('tab_active_strip_color') ?>").show();
        $("#<?php echo $this->get_field_id('tab_icon_position') ?>").parent().parent().show();
        $("#<?php echo $this->get_field_id('tabs_container_bar_border_radius') ?>").parent().show();
        $("#<?php echo $this->get_field_id('tab_icon_size') ?>").parent().show();
        $(".<?php echo $this->get_field_id('tab_icon_color') ?>").show();
        $("#<?php echo $this->get_field_id('disable_tab_title') ?>").parent().show();
        $("#<?php echo $this->get_field_id('tabs_font_size') ?>").parent().addClass('one_fourth_last').removeClass('one_fourth').next().addClass('one_fourth').removeClass('one_fourth_last').attr('style','clear:both').next().attr('style','');
        $("#<?php echo $this->get_field_id('tabs_margin') ?>").parent().addClass('one_fourth_last').removeClass('one_fourth');
        break;
    case 'toggle':
        $("#<?php echo $this->get_field_id('tabs_font_size') ?>").parent().addClass('one_fourth').removeClass('one_fourth_last').next().addClass('one_fourth_last').removeClass('one_fourth').attr('style','').next().attr('style','clear:both');
        $("#<?php echo $this->get_field_id('tabs_margin') ?>").parent().addClass('one_fourth').removeClass('one_fourth_last');
      break;
    case 'accordion':
        $("#<?php echo $this->get_field_id('tabs_font_size') ?>").parent().addClass('one_fourth').removeClass('one_fourth_last').next().addClass('one_fourth_last').removeClass('one_fourth').attr('style','').next().attr('style','clear:both');
        $("#<?php echo $this->get_field_id('tabs_margin') ?>").parent().addClass('one_fourth').removeClass('one_fourth_last');
        $("#<?php echo $this->get_field_id('tabs_margin') ?>").parent().hide();
        break; 
    }
   }).change();
  function tabs_display(){
    $("#<?php echo $this->get_field_id('select_tabs_type') ?>").change(function () {
        $("#<?php echo $this->get_field_id('vtabs_position_right') ?>").parent().hide();
        $("#<?php echo $this->get_field_id('tabs_position') ?>").parent().parent().hide(); 
         var tab_selected = $("#<?php echo $this->get_field_id('select_tabs_type') ?> option:selected").val();
         switch(tab_selected){
            case 'horizontal':
              $("#<?php echo $this->get_field_id('tabs_position') ?>").parent().parent().show(); 
              break;
             case 'vertical':
              $("#<?php echo $this->get_field_id('vtabs_position_right') ?>").parent().show();
              break; 
         }
    }).change();
  }
   });
  })(jQuery);
</script>
<script type='text/javascript'>
  jQuery(document).ready(function($) {
  jQuery('.toggle_tabs_color_pickr').each(function(){
  jQuery(this).wpColorPicker();
  });
      
  });
</script>
<div class="input-elements-wrapper">
  <p class="one_fourth"> 
    <label for="<?php echo $this->get_field_id('select_type') ?>"><?php _e('Select Type',innova) ?></label>
    <select id="<?php echo $this->get_field_id('select_type') ?>" name="<?php echo $this->get_field_name('select_type') ?>">
      <option value="accordion" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'accordion',$instance['select_type'] ) ?> >
      <?php esc_html_e('Accordion', innova) ?></option>
      <option value="tabs" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'tabs',$instance['select_type'] ) ?> >
        <?php esc_html_e('Tabs', innova) ?></option>
      <option value="toggle" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'toggle',$instance['select_type'] ) ?> >
      <?php esc_html_e('Toggle ', innova) ?></option>
    </select>
  </p>
  <p class="one_fourth">
   <label for="<?php echo $this->get_field_id('select_tabs_type') ?>"><?php _e('Select Tabs Type',innova) ?></label>
   <select id="<?php echo $this->get_field_id('select_tabs_type') ?>" name="<?php echo $this->get_field_name
     ('select_tabs_type') ?>">
      <option value="horizontal" id="<?php echo $this->get_field_id('select_tabs_type') ?>" <?php selected( 'horizontal',$instance['select_tabs_type'] ) ?> >
        <?php esc_html_e('Horizontal Tabs', innova) ?></option>
      <option value="vertical" id="<?php echo $this->get_field_id('select_tabs_type') ?>" <?php selected( 'vertical',$instance['select_tabs_type'] ) ?> >
      <?php esc_html_e('Vertical Tabs', innova) ?></option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">
<p>
  <label for="<?php echo $this->get_field_id('taba_accordion_cat') ?>"> <?php _e('Enter Category IDs : ',innova) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('taba_accordion_cat') ?>" id="<?php echo $this->get_field_id
  ('taba_accordion_cat') ?>" class="widefat" value="<?php echo $instance['taba_accordion_cat'] ?>" />
  <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',innova); ?> </strong> <?php echo implode
  (', ', $tab_cats_name); ?></em><br />
  <stong><?php _e('Note:',innova); ?></strong><?php _e('Separate IDs with commas only',innova); ?>
</p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_bg_color') ?>"><?php _e('Tabs Bg Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_bg_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_bg_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_bg_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_border_color') ?>"><?php _e('Tabs Border Color',innova); ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_border_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_border_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_border_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_border_radius') ?>"><?php _e('Tabs Border Radius',innova); ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_border_radius') ?>" id="<?php echo $this->get_field_id
    ('tabs_border_radius') ?>" class="small-text" value="<?php echo $instance['tabs_border_radius'] ?>" />
    <small><?php _e('px',innova); ?></small>
  </p>
  <p class="one_fourth_last <?php echo $this->get_field_id('tabs_title_color') ?>">
    <label for="<?php echo $this->get_field_id('tabs_title_color') ?>"><?php _e('Tabs Title Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_title_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_title_color') ?>"  class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_title_color'] ?>" />
  </p>
   <p class="one_fourth <?php echo $this->get_field_id('tabs_active_bg_color') ?>" style="clear:both;">
    <label for="<?php echo $this->get_field_id('tabs_active_bg_color') ?>"><?php _e('Tabs Active Bg Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_active_bg_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_active_bg_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_active_bg_color'] ?>" />
  </p>
   <p class="one_fourth <?php echo $this->get_field_id('tabs_active_border_color') ?>">
    <label for="<?php echo $this->get_field_id('tabs_active_border_color') ?>"><?php _e('Tabs Active Border Color',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_active_border_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_active_border_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_active_border_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_active_title_color') ?>"><?php _e('Tabs Active Title Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_active_title_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_active_title_color') ?>"  class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_active_title_color'] ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('tabs_font_size') ?>"><?php _e('Tabs Font Size',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_font_size') ?>" id="<?php echo $this->get_field_id('tabs_font_size') ?>"  value="<?php echo $instance['tabs_font_size'] ?>" class="small-text" />
    <small><?php _e('px', innova); ?></small>
  </p>
  <p class="one_fourth" style="clear:both;">
    <label for="<?php echo $this->get_field_id('tabs_font_weight') ?>"> <?php _e('Tabs Font Weight',innova) ?></label>
    <select id="<?php echo $this->get_field_id('tabs_font_weight') ?>" name="<?php echo $this->get_field_name('tabs_font_weight') ?>">
      <option value="normal" <?php selected('normal', $instance['tabs_font_weight']) ?>> <?php esc_html_e('Normal', innova) ?>   </option>
      <option value="bold" <?php selected('bold', $instance['tabs_font_weight']) ?>>  <?php esc_html_e('Bold',innova) ?></option>
    </select>
  </p> 
   <p class="one_half">
   <label for="<?php echo $this->get_field_id('tabs_padding_top') ?>"><?php _e('Tabs Padding',innova); ?></label>
    <?php _e('Top',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_padding_top') ?>" id="<?php echo $this->get_field_id('tabs_padding_top') ?>"  value="<?php echo $instance['tabs_padding_top'] ?>" class="small-text" /> 
    <?php _e('Right',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_padding_right') ?>" id="<?php echo $this->get_field_id('tabs_padding_right') ?>"  value="<?php echo $instance['tabs_padding_right'] ?>" class="small-text" /> 
    <?php _e('Bottom',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_padding_bottom') ?>" id="<?php echo $this->get_field_id('tabs_padding_bottom') ?>"  value="<?php echo $instance['tabs_padding_bottom'] ?>" class="small-text" />
    <?php _e('Left',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_padding_left') ?>" id="<?php echo $this->get_field_id('tabs_padding_left') ?>"  value="<?php echo $instance['tabs_padding_left'] ?>" class="small-text" /> 
    <small><?php _e('px', innova); ?></small>
  </p>
   <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('tabs_margin') ?>"><?php _e('Tabs Margin',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_margin') ?>" id="<?php echo $this->get_field_id('tabs_margin') ?>"  value="<?php echo $instance['tabs_margin'] ?>" class="small-text" />
    <small><?php _e('px',innova); ?></small>
  </p>
  
  <p class="one_fourth <?php echo $this->get_field_id('tabs_container_bar_border_color'); ?>" style="clear:both;">
    <label for="<?php echo $this->get_field_id('tabs_container_bar_border_color') ?>"><?php _e('Tabs Container Border Color',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_container_bar_border_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_container_bar_border_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_container_bar_border_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_container_bar_border_radius') ?>"><?php _e('Tabs Container Border Radius',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_container_bar_border_radius') ?>" id="<?php echo $this->get_field_id
    ('tabs_container_bar_border_radius') ?>" class="small-text" value="<?php echo $instance['tabs_container_bar_border_radius'] ?>" />
    <small><?php _e('px',innova); ?></small>
  </p>
 <p class="one_fourth <?php echo $this->get_field_id('tab_active_strip_color') ?>">
    <label for="<?php echo $this->get_field_id('tab_active_strip_color') ?>"><?php _e('Tabs Bottom Arrow Color',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tab_active_strip_color') ?>" id="<?php echo $this->get_field_id
    ('tab_active_strip_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tab_active_strip_color'] ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('disable_tab_title') ?>"> <?php _e('Disable Tab Title',innova) ?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_tab_title"); ?>" name="<?php echo $this->get_field_name("disable_tab_title"); ?>"<?php checked( (bool) $instance["disable_tab_title"], true ); ?> />
  </p>
  <p class="one_fourth" style="clear:both;">
    <label for="<?php echo $this->get_field_id('tab_icon_size') ?>"><?php _e('Tab Icon Size',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tab_icon_size') ?>" id="<?php echo $this->get_field_id('tab_icon_size') ?>"  value="<?php echo $instance['tab_icon_size'] ?>" class="small-text" />
    <small><?php _e('px', innova); ?></small>
  </p>
  <p class="one_fourth <?php echo $this->get_field_id('tab_icon_color') ?>">
    <label for="<?php echo $this->get_field_id('tab_icon_color') ?>"><?php _e('Tab Icon Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tab_icon_color') ?>" id="<?php echo $this->get_field_id('tab_icon_color') ?>"  value="<?php echo $instance['tab_icon_color'] ?>" class="toggle_tabs_color_pickr" />
  </p>
  <p class="two_fourth_last img_radio_select">
    <label for="<?php echo $this->get_field_id('tab_icon_position') ?>"> <?php _e('Tab Icon Alignments',innova) ?></label>
       <label>
       <input type="radio" id="<?php echo $this->get_field_id( 'tab_icon_position' ); ?>" name="<?php echo $this->get_field_name( 'tab_icon_position' ); ?>" value="left" <?php checked( $instance['tab_icon_position'], 'left' ); ?>>  <img  alt="Align Left" src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/icon_align_left.png' ?>">
      </label>
      <label>
       <input type="radio" id="<?php echo $this->get_field_id( 'tab_icon_position' ); ?>" name="<?php echo $this->get_field_name( 'tab_icon_position' ); ?>" value="right" <?php checked( $instance['tab_icon_position'], 'right' ); ?>> <img  alt="Align Right" src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/icon_align_right.png' ?>">
      </label>
      <label> 
        <input type="radio" id="<?php echo $this->get_field_id( 'tab_icon_position' ); ?>" name="<?php echo $this->get_field_name( 'tab_icon_position' ); ?>" value="top" <?php checked( $instance['tab_icon_position'], 'top' ); ?>>  <img alt="Align Top"  src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/icon_align_top.png' ?>">
     </label>
     <label> 
        <input type="radio" id="<?php echo $this->get_field_id( 'tab_icon_position' ); ?>" name="<?php echo $this->get_field_name( 'tab_icon_position' ); ?>" value="bottom" <?php checked( $instance['tab_icon_position'], 'bottom' ); ?>>  <img alt="Align Bottom" src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/icon_align_bottom.png' ?>">
     </label>
  </p>
  <p class="one_fourth img_radio_select" style="clear:both;">
    <label for="<?php echo $this->get_field_id('tabs_position') ?>"> <?php _e('Tabs Position',innova) ?></label>
    <label>
       <input type="radio" id="<?php echo $this->get_field_id( 'tabs_position' ); ?>" name="<?php echo $this->get_field_name( 'tabs_position' ); ?>" value="center" <?php checked( $instance['tabs_position'], 'center' ); ?>>  <img  alt="Align Left" src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/tab_align_center.png' ?>">
      </label>
      <label>
       <input type="radio" id="<?php echo $this->get_field_id( 'tabs_position' ); ?>" name="<?php echo $this->get_field_name( 'tabs_position' ); ?>" value="left" <?php checked( $instance['tabs_position'], 'left' ); ?>> <img  alt="Align Right" src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/tab_align_left.png' ?>">
      </label>
      <label> 
        <input type="radio" id="<?php echo $this->get_field_id( 'tabs_position' ); ?>" name="<?php echo $this->get_field_name( 'tabs_position' ); ?>" value="right" <?php checked( $instance['tabs_position'], 'right' ); ?>>  <img alt="Align Top"  src="<?php echo  constant(strtoupper($innova_plugin_name).'_PLUGIN_URL').'images/tab_images/tab_align_right.png' ?>">
     </label>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('vtabs_position_right') ?>"> <?php _e('Tabs Right Align',innova) ?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("vtabs_position_right"); ?>" name="<?php echo $this->get_field_name("vtabs_position_right"); ?>"<?php checked( (bool) $instance["vtabs_position_right"], true ); ?> />
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_content_bg_color') ?>"><?php _e('Tabs Content BG Color',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_content_bg_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_content_bg_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_content_bg_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_content_bg_border_color') ?>"><?php _e('Tabs Content BG Border Color',innova); ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_content_bg_border_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_content_bg_border_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_content_bg_border_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('tabs_content_color') ?>"><?php _e('Tabs Content Color',innova); ?></label>
    <input type="text" name="<?php echo $this->get_field_name('tabs_content_color') ?>" id="<?php echo $this->get_field_id
    ('tabs_content_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_content_color'] ?>" />
  </p>
<p class="one_fourth_last">
  <label for="<?php echo $this->get_field_id('tabs_content_link_color') ?>"><?php _e('Tabs Content Link Color',innova); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('tabs_content_link_color') ?>" id="<?php echo $this->get_field_id('tabs_content_link_color') ?>" class="toggle_tabs_color_pickr" value="<?php echo $instance['tabs_content_link_color'] ?>" />
</p>
  <p class="one_half">
    <label for="<?php echo $this->get_field_id('tabs_contant_padding_top') ?>"><?php _e('Tabs Content Padding',innova); ?></label>
    <?php _e('Top',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_contant_padding_top') ?>" id="<?php echo $this->get_field_id('tabs_contant_padding_top') ?>"  value="<?php echo $instance['tabs_contant_padding_top'] ?>" class="small-text" /> 
    <?php _e('Right',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_contant_padding_right') ?>" id="<?php echo $this->get_field_id('tabs_contant_padding_right') ?>"  value="<?php echo $instance['tabs_contant_padding_right'] ?>" class="small-text" /> 
    <?php _e('Bottom',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_contant_padding_bottom') ?>" id="<?php echo $this->get_field_id('tabs_contant_padding_bottom') ?>"  value="<?php echo $instance['tabs_contant_padding_bottom'] ?>" class="small-text" />
    <?php _e('Left',innova); ?> <input type="text" name="<?php echo $this->get_field_name('tabs_contant_padding_left') ?>" id="<?php echo $this->get_field_id('tabs_contant_padding_left') ?>"  value="<?php echo $instance['tabs_contant_padding_left'] ?>" class="small-text" /> 
    <small><?php _e('px', innova); ?></small>
  </p> 
</div>
<div class="input-elements-wrapper">
<p class="one_fourth">  
  <label for="<?php echo $this->get_field_id('tabs_acordion_order') ?>"><?php _e('Order',innova)?></label>
  <select id="<?php echo $this->get_field_id('tabs_acordion_order') ?>" name="<?php echo $this->get_field_name
   ('tabs_acordion_order') ?>">
    <option value="ASC" <?php selected('ASC', $instance['tabs_acordion_order']) ?>><?php esc_html_e('Ascending', '') ?>
    </option>
    <option value="DESC" <?php selected('DESC', $instance['tabs_acordion_order']) ?>><?php esc_html_e('Descending', '') ?>
    </option>
  </select>
</p> 
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('tabs_acordion_orderby') ?>"><?php _e('Orderby',innova)?></label>
  <select id="<?php echo $this->get_field_id('tabs_acordion_orderby') ?>" name="<?php echo $this->get_field_name
   ('tabs_acordion_orderby') ?>">
    <option value="date" <?php selected('date', $instance['tabs_acordion_orderby']) ?>><?php esc_html_e('Date', '') ?>
    </option>
    <option value="menu_order" <?php selected('menu_order', $instance['tabs_acordion_orderby']) ?>><?php esc_html_e('Menu Order', '') ?></option>
    <option value="title" <?php selected('title', $instance['tabs_acordion_orderby']) ?>><?php esc_html_e('Title', '') ?></option>
    <option value="rand" <?php selected('rand', $instance['tabs_acordion_orderby']) ?>><?php esc_html_e('Random', '') ?></option>
    <option value="author" <?php selected('author', $instance['tabs_acordion_orderby']) ?>><?php esc_html_e('Author', '') ?></option>
 </select>
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('limit') ?>"><?php _e('Limit',innova); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('limit') ?>" id="<?php echo $this->get_field_id('limit') ?>"  value="<?php echo $instance['limit'] ?>" />
</p>
</div>
<p>
  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',innova) ?>  
  </label>
  <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
<p> 
<?php 
}
} 
 innova_kaya_register_widgets('Innova_Toggle_Tabs_Accordion', __FILE__);
?>