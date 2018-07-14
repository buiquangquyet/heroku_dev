<?php
/* These are functions specific to the included option settings and this theme */
/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

/* Add Body Classes for Layout

/*-----------------------------------------------------------------------------------*/
// This used to be done through an additional stylesheet call, but it seemed like
// a lot of extra files for something so simple. Adds a body class to indicate sidebar position.

add_filter('body_class','kaya_body_class');
function kaya_body_class($classes) {

  $shortname =  get_option('kaya_shortname');

  $layout = get_option($shortname .'_layout');

  if ($layout == '') {

    $layout = 'layout-2cr';

  }

  $classes[] = $layout;

  return $classes;
}

/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

if( !function_exists('favicon') ){
    function favicon() {
      $favicon = get_option('favicon');
      $favi_img_ul = $favicon['favi_img'];
        if ( !empty( $favi_img_ul) ) {
        echo '<link rel="shortcut icon" href="'.  $favi_img_ul  .'"/>'."\n";
      }
    }
}    
add_action('wp_head', 'favicon');

/*-----------------------------------------------------------------------------------*/

/* Custom CSS

/*-----------------------------------------------------------------------------------*/
function custom_css() {
$kaya_custom_css = get_theme_mod('kaya_custom_css') ? get_theme_mod('kaya_custom_css') : '';
if($kaya_custom_css)
{
  echo '<style>';
  echo $kaya_custom_css;
  echo '</style>';
}
}
add_action('wp_head', 'custom_css');

/*-----------------------------------------------------------------------------------*/

/* Custom JS

/*-----------------------------------------------------------------------------------*/
function custom_js() {
echo $kaya_custom_js = get_theme_mod('kaya_custom_jquery') ? get_theme_mod('kaya_custom_jquery') : '';
if($kaya_custom_js)
{
  ?>

  <script>
  <?php echo $kaya_custom_js; ?>
 </script>
<?php } 
}
add_action('wp_head', 'custom_js');

/* Show analytics code in footer */

/*-----------------------------------------------------------------------------------*/

function childtheme_analytics(){

  $shortname =  get_option('kaya_shortname');

  $output = get_option($shortname . '_google_analytics');

  if ( $output <> "" ) 

    echo stripslashes($output) . "\n";

}

add_action('wp_footer','childtheme_analytics');


function kaya_slider_data(){
if(is_search()){ } else{ 
  global $post;
  if( class_exists('woocommerce') ){
  if( is_shop() ){
      $post_id = wc_get_page_id('shop');
  } else{
    $post_id = $post->ID;
  } }else{
    $post_id = $post->ID;
  }
  $select_page_options=get_post_meta($post_id,'select_page_options',true);
  if( $select_page_options == 'page_slider_setion'){
     kaya_image_slider(); 
  }
  elseif($select_page_options=="singleimage"){
     get_template_part('slider/single','image');
  }
  elseif($select_page_options=="video_header"){
    get_template_part('slider/video','header');
  }
  elseif($select_page_options=="page_title_setion"){
     kaya_page_title_bar(); 
  }
  elseif($select_page_options=="none"){
   
  }else{
   kaya_page_title_bar(); 
  }


// Page Title
}
}
add_action('kaya_slider_data','kaya_slider_data');

function header_bg_image(){
  global $post;
  if( is_search() ){ $page_title_bg_color = ''; $bg_opacity=''; $page_bg_Image_Upload = '';} else{  $page_title_bg_color=get_post_meta($post->ID,'page_title_bg_color',true); 
 $bg_opacity = $page_title_bg_color ? 0.2 : '1'; 
$page_bg_Image_Upload=get_post_meta($post->ID,'page_bg_Image_Upload',false);}
 ?>
  <section id="header_nav_bar_container">
<?php  
    //print_r($page_bg_Image_Upload);
    $page_bg_Image_Upload = ( array ) $page_bg_Image_Upload;
      if ( !empty( $page_bg_Image_Upload ) ) {
      $page_bg_Image_Upload = implode( ',', $page_bg_Image_Upload );
      $src = wp_get_attachment_image_src( $page_bg_Image_Upload, '' );
      $src = $src[0];
    }else{
      $src="";
    }
    //$default_bg = get_template_directory_uri().'/images/page_title_bg.jpg';
    $bg_image = $src ? 'background-image:url('.$src.');' : '';
 ?>
    <div class="page_title_bg" style="<?php echo $bg_image; ?> opacity:<?php echo $bg_opacity; ?>"> </div>
<?php }

/* Theme customization */
function kaya_custom_colors(){
  // Logo Section
   global $post; 
  $upload_boxed = get_option('upload_boxed');
   $boxed_backgroundbg_repeat = get_theme_mod('boxed_backgroundbg_repeat') ? get_theme_mod('boxed_backgroundbg_repeat') : 'no-repeat';
   $select_boxed_bg_type = get_theme_mod('select_boxed_bg_type') ? get_theme_mod('select_boxed_bg_type') : '';
   $kaya_layout_class = get_theme_mod('kaya_layout_class') ? get_theme_mod('kaya_layout_class') : 'fluid_layout';
    $box_layout_margin_top =get_theme_mod( 'box_layout_margin_top', '' ) ? get_theme_mod( 'box_layout_margin_top', '0' ) : ''; // H6
   $boxed_layout_bg_color =get_theme_mod( 'boxed_layout_bg_color', '' ) ? get_theme_mod( 'boxed_layout_bg_color') : ''; 
    $responsive_layout_mode = get_option( 'responsive_layout_mode' );
     $logo_bg_color = get_option('logo_bg_color') ? get_option('logo_bg_color') : '';
     $logo_bg_opacity = get_theme_mod('logo_bg_opacity') ? get_theme_mod('logo_bg_opacity') : '0.5';
     $logo_margin_top =get_theme_mod( 'logo_margin_top', '' ) ? get_theme_mod( 'logo_margin_top', '0' ) : ''; 
      // Header Section
     $upload_header = get_option('upload_header');
     $select_Header_bg_type = get_theme_mod('select_Header_bg_type') ? get_theme_mod('select_Header_bg_type') : '' ;
    $backgroundbg_repeat = get_theme_mod('backgroundbg_repeat') ? get_theme_mod('backgroundbg_repeat') : 'repeat' ;
    $header_bg_color = get_option('header_bg_color') ? get_option('header_bg_color') : '' ;
    $header_top_border =get_theme_mod( 'header_top_border') ? get_theme_mod( 'header_top_border') : '0';
   $header_padding_top_bottom = get_theme_mod('header_padding_top_bottom') ? get_theme_mod('header_padding_top_bottom') : '30'; 

    $header_top_border_color = get_option('header_top_border_color') ? get_option('header_top_border_color') : '';

    $header_opacity = get_theme_mod('header_opacity') ? get_theme_mod('header_opacity') : '0.5';

     // Menu  Section
    $menu_nav_bg_color = get_option('menu_nav_bg_color') ? get_option('menu_nav_bg_color') : '#485b6e' ;
    $menu_nav_bg_top_curve = get_theme_mod('menu_nav_bg_top_curve') ? get_theme_mod('menu_nav_bg_top_curve') : '0';
    $menu_link_bg_color = get_option('menu_link_bg_color') ? get_option('menu_link_bg_color') : '#f44336' ;
    $menu_link_color = get_option('menu_link_color') ? get_option('menu_link_color') : '#fff' ;
    $menu_link_hover_color = get_option('menu_link_hover_color') ? get_option('menu_link_hover_color') : '';
    $menu_link_hover_bg_color = get_option('menu_link_hover_bg_color') ? get_option('menu_link_hover_bg_color') : '#d32f2f';
    $menu_bg_active_color = get_option('menu_bg_active_color') ? get_option('menu_bg_active_color') : '#d32f2f' ;
    $menu_link_active_color = get_option('menu_link_active_color') ? get_option('menu_link_active_color') : '#fff' ;
    $sub_menu_link_color = get_option('sub_menu_link_color') ? get_option('sub_menu_link_color') : '';
    $sub_menu_link_hover_color = get_option('sub_menu_link_hover_color') ? get_option('sub_menu_link_hover_color') : '#';
    $sub_menu_bg_color = get_option('sub_menu_bg_color') ? get_option('sub_menu_bg_color') : '#';
    $sub_menu_link_hover_bg_color = get_option('sub_menu_link_hover_bg_color') ? get_option('sub_menu_link_hover_bg_color') : '#f0f0f0';
    $sub_menu_bottom_border_color = get_option('sub_menu_bottom_border_color') ? get_option('sub_menu_bottom_border_color') : '#e4e4e4';
    $sub_menu_link_active_color = get_option('sub_menu_link_active_color') ? get_option('sub_menu_link_active_color') : '#f44336' ;
    $sub_menu_active_bg_color = get_option('sub_menu_active_bg_color') ? get_option('sub_menu_active_bg_color') : '#f0f0f0';
    //Page color settings

    //Page title bar color settings
 $page_title_bar = get_option('page_title_bar');
 $select_pagetitle_bar_bg_type = get_theme_mod('select_pagetitle_bar_bg_type') ? get_theme_mod('select_pagetitle_bar_bg_type') : '' ;
    $page_title_bar_bg_repeat = get_theme_mod('page_title_bar_bg_repeat') ? get_theme_mod('page_title_bar_bg_repeat') : 'repeat' ;
    $page_title_bg_color = get_theme_mod( 'page_title_bg_color' ) ? get_theme_mod( 'page_title_bg_color' ) : '';
    $page_titlebar_title_color = get_theme_mod('page_titlebar_title_color') ? get_theme_mod('page_titlebar_title_color') : '#333';
    $page_title_bg = get_option('page_title_bg');
        $page_title_bar_bottom_border =get_theme_mod( 'page_title_bar_bottom_border') ? get_theme_mod( 'page_title_bar_bottom_border') : '0';
    $page_titlebar_border_color = get_option('page_titlebar_border_color') ? get_option('page_titlebar_border_color') : '#333333';


    //page middle section
  $page_content_bg = get_option('page_content_bg');
    $select_middle_content_bg_type = get_theme_mod('select_middle_content_bg_type') ? get_theme_mod('select_middle_content_bg_type') : '' ;
    $page_content_bg_repeat = get_theme_mod('page_content_bg_repeat') ? get_theme_mod('page_content_bg_repeat') : 'repeat' ;
    $page_bg_color = get_option('page_bg_color') ? get_option('page_bg_color') : '';
    $page_titles_color = get_option('page_titles_color') ? get_option('page_titles_color') : '#333';
    $page_description_color = get_option('page_description_color') ? get_option('page_description_color') : '#555555';
    $page_link_color = get_option('page_link_color') ? get_option('page_link_color') : '#2EA2CC';
    $page_link_hover_color = get_option('page_link_hover_color') ? get_option('page_link_hover_color') : '#339933';

    //Sidebar color settings
    $sidebar_bg_color = get_option('sidebar_bg_color') ? get_option('sidebar_bg_color') : '#ffffff';
    $sidebar_title_color = get_option('sidebar_title_color') ? get_option('sidebar_title_color') : '#333333';
    $sidebar_link_color = get_option('sidebar_link_color') ? get_option('sidebar_link_color') : '#2EA2CC';
    $sidebar_link_hover_color = get_option('sidebar_link_hover_color') ? get_option('sidebar_link_hover_color') : '#CC0069';
    $sidebar_content_color = get_option('sidebar_content_color') ? get_option('sidebar_content_color') : '#787878';
    $sidebar_tag_hover_bg_color= get_option('sidebar_tag_hover_bg_color') ? get_option('sidebar_tag_hover_bg_color') : '#d32f2f';
     $sidebar_tag_hover_text_color= get_option('sidebar_tag_hover_text_color') ? get_option('sidebar_tag_hover_text_color') : '#ffffff';


    /* Woocommerce Color Section */
    $primary_buttons_bg_color = get_option('primary_buttons_bg_color') ? get_option('primary_buttons_bg_color') : '#434a54';
    $primary_buttons_text_color = get_option('primary_buttons_text_color') ? get_option('primary_buttons_text_color') : '#ffffff';
    $primary_buttons_bg_hover_color = get_option('primary_buttons_bg_hover_color') ? get_option('primary_buttons_bg_hover_color') : '#f44336';
    $primary_buttons_text_hover_color = get_option('primary_buttons_text_hover_color') ? get_option('primary_buttons_text_hover_color') : '#ffffff';

    $secondary_buttons_bg_color = get_option('secondary_buttons_bg_color') ? get_option('secondary_buttons_bg_color') : '#f44336';
    $secondary_buttons_text_color = get_option('secondary_buttons_text_color') ? get_option('secondary_buttons_text_color') : '#ffffff';
    $secondary_buttons_bg_hover_color = get_option('secondary_buttons_bg_hover_color') ? get_option('secondary_buttons_bg_hover_color') : '#434a54';
    $secondary_buttons_text_hover_color = get_option('secondary_buttons_text_hover_color') ? get_option('secondary_buttons_text_hover_color') : '#ffffff';
    $woo_elments_colors = get_option('woo_elments_colors') ? get_option('woo_elments_colors') : '#f44336';

    $success_msg_bg_color = get_option('success_msg_bg_color') ? get_option('success_msg_bg_color') : '#dff0d8';
    $success_msg_text_color = get_option('success_msg_text_color') ? get_option('success_msg_text_color') : '#468847';
    $notification_msg_bg_color = get_option('notification_msg_bg_color') ? get_option('notification_msg_bg_color') : '#b8deff';
    $notification_msg_text_color = get_option('notification_msg_text_color') ? get_option('notification_msg_text_color') : '#333';
    $warning_msg_bg_color = get_option('warning_msg_bg_color') ? get_option('warning_msg_bg_color') : '#f2dede';
    $warning_msg_text_color = get_option('warning_msg_text_color') ? get_option('warning_msg_text_color') : '#a94442';
//prtttyphoto
    $enable_prettyphoto_socialicons = get_theme_mod('enable_prettyphoto_socialicons') ? get_theme_mod('enable_prettyphoto_socialicons') : '0';
    $disable_prettyphoto_thumbnails = get_theme_mod('disable_prettyphoto_thumbnails') ? get_theme_mod('disable_prettyphoto_thumbnails') : '0';
    $disable_prettyphoto_post_title = get_theme_mod('disable_prettyphoto_post_title') ? get_theme_mod('disable_prettyphoto_post_title') : '0';
    // Accent Color Section
    $accent_bg_color = get_option('accent_bg_color') ? get_option('accent_bg_color') : '#f44336';
    $accent_text_color = get_option('accent_text_color') ? get_option('accent_text_color') : '#ffffff';
     //top header
     $select_top_header_background_type = get_theme_mod('select_top_header_background_type') ? get_theme_mod('select_top_header_background_type') : 'bg_type_color';
      $upload_top_bar = get_theme_mod('upload_top_bar');
      $top_bar_bg_repeat = get_theme_mod('top_bar_bg_repeat') ? get_theme_mod('top_bar_bg_repeat') : 'repeat';
    $top_bar_bg_color = get_option( 'top_bar_bg_color' ) ?  $top_bar_bg_color = get_option( 'top_bar_bg_color' ) : '#EEE';
    /* Footer Section */
    $footerbg = get_option('footerbg');
    $select_footer_bg_type = get_theme_mod('select_footer_bg_type') ? get_theme_mod('select_footer_bg_type') : '' ;
    $footerbg_repeat = get_theme_mod('footerbg_repeat') ? get_theme_mod('footerbg_repeat') : 'repeat' ;
    $footer_bg_color = get_option('footer_bg_color') ? get_option('footer_bg_color') : '';
    $footer_title_color = get_option('footer_title_color') ? get_option('footer_title_color') : '#ffffff';
    $footer_text_color = get_option('footer_text_color') ? get_option('footer_text_color') : '#eeeeee';
    $footer_link_color = get_option('footer_link_color') ? get_option('footer_link_color') : '#f44336';
    $footer_link_hover_color = get_option('footer_link_hover_color') ? get_option('footer_link_hover_color') : '#000000';
    /*Footerbottom Section*/
     $select_most_footer_background_type = get_theme_mod('select_most_footer_background_type') ? get_theme_mod('select_most_footer_background_type') : 'bg_type_color' ;
    $most_footerbg = get_theme_mod('mostfooterbg');
    $most_footerbg_repeat = get_theme_mod('most_footerbg_repeat') ? get_theme_mod('most_footerbg_repeat') : 'repeat' ;
    $most_footer_bg_color = get_theme_mod('most_footer_bg_color') ? get_theme_mod('most_footer_bg_color') : '';    
    $footerbottom_title_color = get_option('footerbottom_title_color') ? get_option('footerbottom_title_color') : '#999999';
    $footerbottom_text_color = get_option('footerbottom_text_color') ? get_option('footerbottom_text_color') : '#666666';
    $footerbottom_link_color = get_option('footerbottom_link_color') ? get_option('footerbottom_link_color') : '#f44336';
    $footerbottom_link_hover_color = get_option('footerbottom_link_hover_color') ? get_option('footerbottom_link_hover_color') : '#333333';
    $footer_bottom_text_color = get_option('footer_bottom_text_color') ? get_option('footer_bottom_text_color') : '#595959';
    $footer_bottom_link_color = get_option('footer_bottom_link_color') ? get_option('footer_bottom_link_color') : '#f44336';
    $footer_bottom_link_hover_color = get_option('footer_bottom_link_hover_color') ? get_option('footer_bottom_link_hover_color') : '#000000';
   
    /* Font Family */
    $google_bodyfont=get_theme_mod( 'google_body_font', '' );
    $gbodyfont = $google_bodyfont ? str_replace( '+', ' ', $google_bodyfont) : 'Open Sans'; // body font family
    $google_heading_font=get_theme_mod( 'google_heading_font', '' );
    $heading_font_family = $google_heading_font ? str_replace( '+', ' ', $google_heading_font) :'Pathway Gothic One'; // Heading font family
    $google_menu_font=get_theme_mod( 'google_menu_font', '' );
    $menu_font_family = $google_menu_font ? str_replace( '+', ' ', $google_menu_font) :'Pathway Gothic One'; // Heading font family
    /* Font Sizes */
    /* Title Font sizes H1 */
    $h1_title_font_size=get_theme_mod( 'h1_title_fontsize', '' ) ? get_theme_mod( 'h1_title_fontsize', '' ) : '27'; // H1
    $h2_title_font_size=get_theme_mod( 'h2_title_fontsize', '' ) ? get_theme_mod( 'h2_title_fontsize', '' ) : '24'; // H2
    $h3_title_font_size=get_theme_mod( 'h3_title_fontsize', '' ) ? get_theme_mod( 'h3_title_fontsize', '' ) : '22'; // H3
    $h4_title_font_size=get_theme_mod( 'h4_title_fontsize', '' ) ? get_theme_mod( 'h4_title_fontsize', '' ) : '18'; // H4
    $h5_title_font_size=get_theme_mod( 'h5_title_fontsize', '' ) ? get_theme_mod( 'h5_title_fontsize', '' ) : '16'; // H5
    $h6_title_font_size=get_theme_mod( 'h6_title_fontsize', '' ) ? get_theme_mod( 'h6_title_fontsize', '' ) : '14'; // H6
    $body_font_size=get_theme_mod( 'body_font_size', '' ) ? get_theme_mod( 'body_font_size', '' ) : '13'; // Body Font Size
     $menu_font_size=get_theme_mod( 'menu_font_size', '' ) ? get_theme_mod( 'menu_font_size', '' ) : '16'; // Body Font Size
     $child_menu_font_size=get_theme_mod( 'child_menu_font_size', '' ) ? get_theme_mod( 'child_menu_font_size', '' ) : '15'; // Body Font Size
    //title letter spacings
    $h1_letter_spacing=get_theme_mod( 'h1_letter_spacing', '' ) ? get_theme_mod( 'h1_letter_spacing', '' ) : ''; // H1
    $h2_letter_spacing=get_theme_mod( 'h2_letter_spacing', '' ) ? get_theme_mod( 'h2_letter_spacing', '' ) : ''; // H2
    $h3_letter_spacing=get_theme_mod( 'h3_letter_spacing', '' ) ? get_theme_mod( 'h3_letter_spacing', '' ) : ''; // H3
    $h4_letter_spacing=get_theme_mod( 'h4_letter_spacing', '' ) ? get_theme_mod( 'h4_letter_spacing', '' ) : ''; // H4
    $h5_letter_spacing=get_theme_mod( 'h5_letter_spacing', '' ) ? get_theme_mod( 'h5_letter_spacing', '' ) : ''; // H5
    $h6_letter_spacing=get_theme_mod( 'h6_letter_spacing', '' ) ? get_theme_mod( 'h6_letter_spacing', '' ) : ''; // H6
    $body_font_letter_spacing=get_theme_mod( 'body_font_letter_spacing', '' ) ? get_theme_mod( 'body_font_letter_spacing', '' ) : ''; 
     $menu_font_letter_spacing=get_theme_mod( 'menu_font_letter_spacing', '' ) ? get_theme_mod( 'menu_font_letter_spacing', '' ) : '1';
    //tyography line height settings
    //title letter spacings
    $h1_line_height=get_theme_mod( 'h1_line_height', '' ) ? get_theme_mod( 'h1_line_height', '' ) : '40'; // H1
    $h2_line_height=get_theme_mod( 'h2_line_height', '' ) ? get_theme_mod( 'h2_line_height', '' ) : '42'; // H2
    $h3_line_height=get_theme_mod( 'h3_line_height', '' ) ? get_theme_mod( 'h3_line_height', '' ) : '30'; // H3
    $h4_line_height=get_theme_mod( 'h4_line_height', '' ) ? get_theme_mod( 'h4_line_height', '' ) : '24'; // H4
    $h5_line_height=get_theme_mod( 'h5_line_height', '' ) ? get_theme_mod( 'h5_line_height', '' ) : '22'; // H5
    $h6_line_height=get_theme_mod( 'h6_line_height', '' ) ? get_theme_mod( 'h6_line_height', '' ) : '19'; // H6
    $body_line_height=get_theme_mod( 'body_line_height', '' ) ? get_theme_mod( 'body_line_height', '' ) : '24'; 
    $menu_line_height=get_theme_mod( 'menu_line_height', '' ) ? get_theme_mod( 'menu_line_height', '' ) : '15';
    //Globel Settings
    $middle_content_padding = get_theme_mod('middle_content_padding') ? get_theme_mod('middle_content_padding') : '' ;
    /* Menu top */
    $menu_margin_top =get_theme_mod( 'menu_margin_top', '' ) ? get_theme_mod('menu_margin_top', '') : ''; // H6
    $box_layout_shadow = get_theme_mod('box_layout_shadow', '') ? get_theme_mod('box_layout_shadow', '') : '0' ;
    $css = '';
    //prettyphoto social icons
if( $enable_prettyphoto_socialicons == '0' ){ 

$css .= '.pp_social{
            display: none!important;
        }';
}else{
   $css .= '.pp_social{
            display: block!important;
        }'; 
}
    //prettyphoto thumbnails
if( $disable_prettyphoto_thumbnails == '0' ){ 

$css .= '.pp_gallery{
            display: block!important;
        }';
}else{
   $css .= '.pp_gallery{
            display: none!important;
        }'; 
}
    //prettyphoto post title
if( $disable_prettyphoto_post_title == '0' ){ 
$css .= '.ppt{
            display: none!important;
        }';
}else{
   $css .= '.ppt{
            display: block!important;
        }'; 
}
//end
//top header section
 $top_bar_bg_size = ( $top_bar_bg_repeat == 'cover' ) ? 'cover' : 'inherit';

    if( $select_top_header_background_type == 'bg_type_color' ){
         $css .='.header_top{
            background:'.$top_bar_bg_color.'!important;
        }';
    }else{
        //$header_top_bar_img = get_template_directory_uri().'/images/page-title-transperent-bg.png';
        if( $upload_top_bar['top_bg_image'] ){
            $css .='.header_top{
                background:url('.$upload_top_bar['top_bg_image'].');
                background-repeat:'.$top_bar_bg_repeat.';
                background-position:center top!important;
                background-size:'.$top_bar_bg_size.';    
            }';
        }
    }

$enable_top_header = get_theme_mod('enable_top_header') ? get_theme_mod('enable_top_header') : '0';
  $top_header_display = ( $enable_top_header == '1' ) ? 'block' : 'none';
       $css .=' .header_top{
            display:'.$top_header_display.'!important;
        }';

  //end
     /* Boxed layout margin top */
     $css .= ' #box_layout{
      margin-top:'.$box_layout_margin_top.'px !important;
        }';
if( $select_boxed_bg_type=="bg_type_color" ){     
     $css .= 'body {
   background-color:'.$boxed_layout_bg_color.';
}';
}else{
  $css .= 'body {
   background:url('.$upload_boxed['background_image1'].');
   background-repeat: '.$boxed_backgroundbg_repeat.'; 
   background-size: cover;
}';
}
   $css .= '.menu ul li a{
        font-family:'.$menu_font_family.'!important;
        font-size:'.$menu_font_size.'px;
        line-height: '.$menu_line_height.'px;
        letter-spacing: '.$menu_font_letter_spacing.'px;
    }
    .menu ul ul li a {
        font-size:'.$child_menu_font_size.'px;
      }
    nav{
      margin-top: '.$menu_margin_top.'px;
    }
    .nav_wrap {
      border-bottom: 3px solid '.$menu_link_hover_bg_color.';
      }
      #box_layout .nav_wrap{
        border-radius: '.$menu_nav_bg_top_curve.'px '.$menu_nav_bg_top_curve.'px 0px 0px;
        }

    body, p{
        font-family:'.$gbodyfont.'!important;
        line-height:'.$body_line_height.'px;
        font-size:'.$body_font_size.'px;
        letter-spacing: '.$body_font_letter_spacing.'px;
    }
    p{
        padding-bottom:'.$body_line_height.'px;
    }
    /* Heading Font Family */
     h1, h2, h3, h4, h5, h6{
        font-family:'.$heading_font_family.'!important;
        font-weight: 500;
    }
    /* Font Sizes */
    h1{
      font-size:'.$h1_title_font_size.'px;
     line-height:'.$h1_line_height.'px;
     letter-spacing: '.$h1_letter_spacing.'px;
    }
    h2{
     font-size:'.$h2_title_font_size.'px;
      line-height:'.$h2_line_height.'px;
      letter-spacing: '.$h2_letter_spacing.'px;
    }
    h3{
      font-size:'.$h3_title_font_size.'px;
      line-height:'.$h3_line_height.'px;
      letter-spacing: '.$h3_letter_spacing.'px;
    }
    h4{
      font-size:'.$h4_title_font_size.'px;
      line-height:'.$h4_line_height.'px;
      letter-spacing: '.$h4_letter_spacing.'px;
    }
    h5{
     font-size:'.$h5_title_font_size .'px;
      line-height:'. $h5_line_height .'px;
      letter-spacing: '.$h5_letter_spacing.'px;
    }
    h6{
      font-size:'.$h6_title_font_size.'px;
      line-height:'.$h6_line_height.'px;
      letter-spacing: '.$h6_letter_spacing.'px;
    }';
 /* Header Section */
if( $select_Header_bg_type=="bg_type_color" ){
   $css .= '#header_wrapper{
      background-color:'.$header_bg_color.'!important;     
        }';
     }else{ 
    if( $upload_header['bg_image'] ){ 
       $backgroundbg_image_repeat = ( $backgroundbg_repeat == 'repeat' ) ? 'inherit' : 'cover';
     $css .='#header_nav_bar_container {
      background:url('.$upload_header['bg_image'].')!important;
      background-size : '.$backgroundbg_image_repeat.'!important;
      background-repeat : '.$backgroundbg_repeat.'!important;
      background-attachment: scroll!important;
      background-position: center;
       background-repeat:repeat;
           
     }';
    }
  }
   /* Header Section */
     $css .= ' #header_wrapper{
        border-top: '.$header_top_border.'px solid '.$header_top_border_color.'!important;
      }';

        $css .= ' #header_wrapper{
       padding:'.$header_padding_top_bottom.'px 0px;
   
        }';
        /* Accnt Color Settings */
    $css .= '.post_description, .team_name, .meta-nav-prev, .meta-nav-next, .blog_single_img .bx-prev:hover, .blog_single_img .bx-next:hover, .blog_single_img .isotope_gallery li, .readmore-1:after,
     .widget_tag_cloud .tagcloud a:hover , #sidebar .widget_calendar table caption, .cal-blog, .pagination .current, .pagination span a.current, ul.page-numbers .current, .single_img .isotope_gallery li, .slides-pagination a.current,  #mid_container input#submit.primary-button,.meta-nav-next, .meta-nav-prev
     {
       background-color:'.$accent_bg_color.'!important;
     }';
   $css .= '.page_owlslider .owl-prev{
     background-color:'.$accent_bg_color.'!important;
     color: '.$accent_text_color.'!important;
   }';
   $css .= '.page_owlslider .owl-prev:hover{
     background-color:'.$accent_text_color.'!important;
     color: '.$accent_bg_color.'!important;
   }';
   $css .= '.page_owlslider .owl-next{
    background-color:'.$accent_bg_color.'!important;
     color: '.$accent_text_color.'!important;
   }';
   $css .= '.page_owlslider .owl-next:hover{
    background-color:'.$accent_text_color.'!important;
     color: '.$accent_bg_color.'!important;
   }';
    $css .= '.page_owlslider .owl-dot{
     border: 3px solid '.$accent_text_color.';
   }';
    $css .= '.page_owlslider .owl-dot.active{
    background-color: '.$accent_bg_color.'!important;
  }
  #mid_container #sidebar .widget_tag_cloud .tagcloud a:hover{
     color: '.$accent_text_color.'!important;
  }';
 $css .= '.bx-wrapper .bx-pager.bx-default-pager a:hover, .bx-wrapper .bx-pager.bx-default-pager a.active, #filter ul li a.active {
         background: '.$accent_bg_color.'; 
     }';
      $css .= '#filter ul li a.active {
         background: '.$accent_bg_color.'!important; 
     }';

    $css .= 'blockquote{
      border-left: 3px solid '.$accent_bg_color.'!important;
     }';
    $css .= '.draggble_slider_item h3 > span , .accent{
      color:'.$accent_bg_color.'!important;
    }';
    $css .= '.widget_container ul li a:hover, i.meta-post-icons, .video_inner_text h2 span,.single_img_parallex_inner_text span, .blog_post a:hover, . .comment-author cite a, .reply a, #mid_container_wrapper .commentmetadata a, #author-link a, #entry-author-info h4,
    .draggble_slider_item h3 > span, .draggble_slider_item h3 span, .draggble_slider_item{
      color:'.$accent_bg_color.'!important;
    }';
    $css .= '.filter .active:after{
      border-top:5px solid '.$accent_bg_color.'!important;
    }';
    $css .= '.vaidate_error{
      border:1px solid '.$accent_bg_color.'!important;
    }';
    
   /* Accent background text color */
    $css .= '.filter .active, #crumbs li, .widget_tag_cloud .tagcloud a:hover, #sidebar .widget_calendar table caption, #sidebar .widget_calendar table td a, #sidebar .widget_calendar table td a:visited, .pagination .current, .pagination span a.current, ul.page-numbers .current {
       color:'.$accent_text_color.'!important;
     }
    .readmore {
        border: 0px solid '.$accent_bg_color.'!important;
        background-color: '.$accent_bg_color.'!important;
        color: '.$accent_text_color.'!important;
        margin-top:10px;
      }
     
      .header_right_section h3 strong{
        color: '.$accent_bg_color.'!important;
      }
    #kaya_slider_wrapper .owl-dot {
    border: 3px solid '.$accent_text_color.';
  }
    #kaya_slider_wrapper .owl-dot.active{
    background-color: '.$accent_bg_color.';
  }
    .logo{
      margin-top:'.$logo_margin_top.'px!important;
    }
   
    /* Menu Section */

    .nav_wrap{
      background-color:'.$menu_nav_bg_color.'!important;
      
    }
     .menu > ul:before  {
         border-right: 10px solid '.$menu_link_bg_color.';
    }
    .menu > ul:after  {
          border-bottom: 6px solid '.$menu_link_bg_color.'; 
    }
     .menu > ul > li > a  {
      background-color:'.$menu_link_bg_color.'!important;
       
    }

    .menu > ul > li > a{
      color:'.$menu_link_color.'!important;
    }
    #menu > li.current-menu-item > a, #menu > li.current_page_item > a, .menu > ul  > li:hover > a
    {
    color:'.$menu_link_hover_color.'!important;
      background-color:'.$menu_link_hover_bg_color.'!important;
    }
    ul.menu > li > ul:after {
      border-bottom: 8px solid '.$menu_link_hover_bg_color.'!important;
    }
     #menu > li.current_page_item > a{
        background-color:'.$menu_bg_active_color.'!important;
        color:'.$menu_link_active_color.'!important;
    }
    .menu ul ul li a, .menu ul ul {
      background-color:'.$sub_menu_bg_color.'!important;
    }
    .menu ul ul li a{
      color:'.$sub_menu_link_color.'!important;
    }
    .menu ul ul li a:hover{
      color:'.$sub_menu_link_hover_color.'!important;
      background-color: '.$sub_menu_link_hover_bg_color.'!important;
    }
  
    .menu ul ul li{
      border-bottom:  1px solid '.$sub_menu_bottom_border_color.'!important; 
    }

    .menu .current_page_ancestor > a, .menu .current-menu-ancestor > a, .menu .current-menu-item > a{
        color:'.$sub_menu_link_active_color.';
        background-color:'.$sub_menu_active_bg_color.';
    }'; 
/*Page color settings */
/*Page color settings */
$css .= ' .sub_header_wrapper{
        border-bottom: '.$page_title_bar_bottom_border.'px solid '.$page_titlebar_border_color.'!important;
      }';
/*Page middle section settings */
if( $select_middle_content_bg_type=="bg_type_color" ){
        $css .= '#mid_container_wrapper, .blog #mid_container_wrapper{
            background : '.$page_bg_color.';
        }';
      }else{ 
      if( $page_content_bg['bg_img'] ){
      $bg_size_cover = ( $page_content_bg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
     $css .= '#mid_container_wrapper, .blog #mid_container_wrapper{
           background:url('.$page_content_bg['bg_img'].')!important;
           background-repeat:'.$page_content_bg_repeat.'!important;
           background-size: '.$bg_size_cover.'!important;
    }';
  }
}
    $css .= '#mid_container_wrapper h1,
    #mid_container_wrapper h2,
    #mid_container_wrapper h3,
    #mid_container_wrapper h4,
    #mid_container_wrapper h5,
    #mid_container_wrapper h6{
      color: '.$page_titles_color.';
    }
     #mid_container_wrapper p, #mid_container_wrapper, #contact-form input, #contact-form textarea, #commentform input, #commentform textarea{
       color: '.$page_description_color.';
    }
    #mid_container_wrapper a:not(.add_to_cart_button){
       color: '.$page_link_color.';
    }
    #mid_container_wrapper a:hover:not(.add_to_cart_button){
       color: '.$page_link_hover_color.';
    }';
    $css .= '#mid_container_wrapper{
    padding:'.$middle_content_padding.'px 0;
   }';
  // Page Title bar Section 
    if( $select_pagetitle_bar_bg_type=="bg_type_color" ){
        $css .= '.sub_header_wrapper {
            background :'.$page_title_bg_color.';
        }';
     }
     else{
      if( $page_title_bar['bg_img'] ){
        $bg_size_cover = ( $page_title_bar_bg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
        $css .= '.sub_header_wrapper{
               background:url('.$page_title_bar['bg_img'].')!important;
               background-repeat:'.$page_title_bar_bg_repeat.'!important;
               background-size : '.$bg_size_cover.'!important;
        }';
    }
  }
      $css .= '.sub_header_wrapper h2, .sub_header_wrapper p{
        color:'.$page_titlebar_title_color.';
      }';
    /* Footer Section  */
 if( $select_footer_bg_type=="bg_type_color" ){
      $css .= 'footer {
        background:'.$footer_bg_color.'!important;
    }';
  }else{
    if(  $footerbg['footer'] ){
      $footer_bg_img_repeat = ( $footerbg_repeat == 'repeat' ) ? 'inherit' : 'cover';
       $css .= 'footer{
          background: url('.$footerbg['footer'].')!important;
          background-attachment: scroll!important;
          background-position: center;
          background-repeat : '.$footerbg_repeat.'!important;
          background-size : '.$footer_bg_img_repeat.'!important;
          background-attachment: scroll!important;
        } ';
      }
  }
    /* Sidebar */
    $css .= '#sidebar h3{
      color:'.$sidebar_title_color.';
    }
    #sidebar{
      background-color: '.$sidebar_bg_color.';
    }
     #sidebar p, #sidebar{
      color: '.$sidebar_content_color.';
    }
    #mid_container #sidebar a{
      color: '.$sidebar_link_color.'!important;
    }
    #mid_container #sidebar a:hover{
      color:'.$sidebar_link_hover_color.'!important;
    }';

/* Footer Section */
   if( $footer_bg_color ){
      $css .= 'footer {
        background:'.$footer_bg_color.'!important;
    }';
  }else{
    if(  $footerbg['footer'] ){
      $footer_bg_img_repeat = ( $footerbg_repeat == 'repeat' ) ? 'inherit' : 'cover';
       $css .= 'footer{
          background: url('.$footerbg['footer'].')!important;
          background-attachment: scroll!important;
          background-position: center;
          background-repeat : '.$footerbg_repeat.'!important;
          background-size : '.$footer_bg_img_repeat.'!important;
          background-attachment: scroll!important;
        } ';
      }
  }
  $css.='footer h3{
        color:'.$footer_title_color.'!important;
    }
    footer .widget_container > h3:after {
        background-color: '.$footer_title_color.'!important;
    }
    footer p, footer{
        color:'.$footer_text_color.'!important;
    }
    footer a{
        color:'.$footer_link_color.'!important;
    }
    footer a:hover, footer a:active, #menu-footer > li.current-menu-item > a{
        color:'.$footer_link_hover_color.'!important;
    }';

//footerbottom settings
    if(  $select_most_footer_background_type == 'bg_type_color' ){
       $css .= '#footer_bottom{
            background-color:'.$most_footer_bg_color.';
     }';
    }else{
        if( $most_footerbg['mostfooter'] ){ 
        $most_footer_bg_img_repeat = ( $most_footerbg_repeat == 'cover' ) ? 'cover' : 'inherit';
        $css .= '#footer_bottom{
            background: url('. $most_footerbg['mostfooter'].')!important;
            background-attachment: fixed!important;
            background-position: center top!important;
            background-repeat : '.$most_footerbg_repeat.'!important;
            background-size : '.$most_footer_bg_img_repeat.'!important;
            background-attachment: scroll!important;
          } ';
      }
    }
    $css .= '#footer_bottom h3{
        color:'.$footerbottom_title_color.'!important;
    }
     #footer_bottom .widget_container > h3:after {
        background-color: '.$footerbottom_title_color.'!important;
    }
    #footer_bottom,  #footer_bottom p{
        color:'.$footerbottom_text_color.'!important;
    }
    #footer_bottom a{
        color:'.$footerbottom_link_color.'!important;
    }
    #footer_bottom a:hover{
        color:'.$footerbottom_link_hover_color.'!important;
    }
     #footer_bottom span{
        color:'.$footer_bottom_text_color.'!important;
    }
 #footer_bottom a{
        color:'.$footer_bottom_link_color.'!important;
    }
   #footer_bottom a:hover{
        color:'.$footer_bottom_link_hover_color.'!important;
    }';
    $select_most_footer_style=get_theme_mod('select_most_footer_style') ? get_theme_mod('select_most_footer_style') : 'left_content_right_menu';
    if( $select_most_footer_style == 'none' ){
        $css .='#footer_bottom{
            display:none;
        }';
    }

    //supperslider navigatio disable
$disable_dots_pagination = get_post_meta($post->ID,'disable_dots_pagination',true) ? get_post_meta($post->ID,'disable_dots_pagination',true) : '0'; 
    if($disable_dots_pagination =='1'){
    $css .='#slides .slides-pagination{
    display:none!important;
  }';
   } 

//bx lider
$disable_bx_slider_arrow_navigation = get_post_meta($post->ID,'disable_bx_slider_arrow_navigation',true) ? get_post_meta($post->ID,'disable_bx_slider_arrow_navigation',true) : '0'; 
    if($disable_bx_slider_arrow_navigation =='1'){
    $css .='.page_owlslider .owl-nav{
    display:none!important;
  }';
   }

$disable_bx_slider_dots_pagination = get_post_meta($post->ID,'disable_bx_slider_dots_pagination',true) ? get_post_meta($post->ID,'disable_bx_slider_dots_pagination',true) : '0'; 
    if($disable_bx_slider_dots_pagination =='1'){
    $css .='.page_owlslider .owl-dots{
    display:none!important;
  }';
   }  


   //portfolio single page slider
$disable_pf_single_page_slider_arrow_buttons = get_theme_mod('disable_pf_single_page_slider_arrow_buttons') ? get_theme_mod('disable_pf_single_page_slider_arrow_buttons') : '0';
if($disable_pf_single_page_slider_arrow_buttons =='1'){
$css .='.single_img.slider .bx-controls-direction {
    display:none!important;
  }';
}

$disable_pf_single_page_slider_dotos_buttons = get_theme_mod('disable_pf_single_page_slider_dotos_buttons') ? get_theme_mod('disable_pf_single_page_slider_dotos_buttons') : '0';
if($disable_pf_single_page_slider_dotos_buttons =='1'){
$css .='.single_img.slider .bx-pager-item{
    display:none!important;
  }';
}


/* Woocommerce Color Section */
     $css .= '.primary-button, p.buttons .button.wc-forward{
        background:'.$primary_buttons_bg_color.'!important;
        color:'.$primary_buttons_text_color.'!important;
     }
     .primary-button:hover, p.buttons .button.wc-forward:hover{
        background:'.$primary_buttons_bg_hover_color.'!important;
        color:'.$primary_buttons_text_hover_color.'!important;
     }
     .seconadry-button, #place_order, .single-product-tabs .active, .single-product-tabs li:hover, .woocommerce .quantity .minus, .woocommerce .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page .quantity .plus{
        background:'.$secondary_buttons_bg_color.'!important;
        color:'.$secondary_buttons_text_color.'!important;
     }
     .seconadry-button:hover, #place_order:hover, .woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page .quantity .plus:hover{
        background:'.$secondary_buttons_bg_hover_color.'!important;
        color:'.$secondary_buttons_text_hover_color.'!important;
     }
     .woocommerce a.wc-forward:after, .woocommerce-page a.wc-forward:after{
          color:'.$secondary_buttons_text_color.'!important;
     }
     .woocommerce a.wc-forward:hover:after, .woocommerce-page a.wc-forward:hover:after{
          color:'.$secondary_buttons_text_hover_color.'!important;
     }
 
    .product-remove a.remove:hover {
       border-color: '.$woo_elments_colors.'!important;
    }
    .product-remove a.remove:hover, .star-rating, #mid_container_wrapper .comment-form-rating .stars a:hover, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .related-product-slider .shop-products span .amount, .woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .price{
           color:'.$woo_elments_colors.'!important;
    }
    .woocommerce span.onsale, .woocommerce-page span.onsale{
         background-color:'.$woo_elments_colors.'!important;
    }
    .cart-sussess-message {
      background-color:'.$success_msg_bg_color.';
      color:'.$success_msg_text_color.';
    }
    .woocommerce-cart-info {
      background-color:'.$notification_msg_bg_color.';
      color: '.$notification_msg_text_color.';
    }
    .woocommerce-cart-info a{
          color: '.$notification_msg_text_color.'!important;
    }
    .woocommerce-cart-error {
      background-color: '.$warning_msg_bg_color.';
      color: '.$warning_msg_text_color.';
    }';

  $css = preg_replace( '/\s+/', ' ', $css ); 
  $output = "<!-- Customizer Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action('wp_head','kaya_custom_colors');
function meta_box_admin_style(){
  /*portfolio data disable */
  $disable_old_portfolio=get_theme_mod('disable_old_portfolio') ? get_theme_mod('disable_old_portfolio') : '0';
  if( $disable_old_portfolio == '0' ){
    $css ='';
  $css .= '#portfolio_slides{
    display:none !important;
  }';
}
else{
  $css ='';
}
/* widget video tutorials */
$css ='.so-panels-dialog-wrapper span.widget-name a {
        position: relative!important;
        width: inherit!important;
        display: inline-block!important;
        border-bottom: 0!important;
        border-left: 0px!important;
        background:none!important;
        height:20px;
        box-shadow:none!important;
    }
    .title h4 a.widget_video_tutorials, .siteorigin-panels-builder .so-rows-container .so-row-container .so-cells .cell .widgets-container .so-widget:hover .title h4 a.widget_video_tutorials, .widget-type-wrapper a.widget_video_tutorials, .so-section ul li a.widget_video_tutorials{
        display:none!important;
    }';
$css = preg_replace( '/\s+/', ' ', $css ); 
  $output = "<!-- Customizer Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action('admin_head','meta_box_admin_style');

function theme_customizer_css() { 
  $css ='';
     $css .=' .customize-control-radio label {
          float: left;
          margin-right: 10px;
      }
      h4.customizer_sub_section{
          background-color: #EEEEEE;
          margin-bottom: 0 !important;
          margin-left: -30px;
          margin-right: -30px;
          margin-top: 15px !important;
          padding: 5px 30px;
          border: 1px solid #e5e5e5;
      }
      .title_description {
        display: block;
        line-height: 23px;
        margin: 0 0 10px;
        padding: 0;
      }

      .img_radio {
          display: none !important;
      }
      .kaya-radio-img {
          display: inline-block;
          margin: 0 3px 3px 0;
          border: 2px solid #fff;
      }
      .kaya-radio-img:hover{
        border: 2px solid #2EA2CC;
      }
      .kaya-radio-img-selected {
    border: 2px solid #2EA2CC;
}';
$css = preg_replace( '/\s+/', ' ', $css );
 $output = "<!-- Theme  Customizer admin Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action( 'customize_controls_print_styles', 'theme_customizer_css' );

?>