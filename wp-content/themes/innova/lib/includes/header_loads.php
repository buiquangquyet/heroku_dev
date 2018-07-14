<?php
// juqery and css loads
add_action('wp_enqueue_scripts', 'kaya_jquery_scripts');
function kaya_jquery_scripts()
{
	$kaya_options = get_option('kayapati');
	wp_enqueue_script("jquery");
 	wp_enqueue_style('css_font_awesome', get_template_directory_uri() . '/css/font-awesome.css', false, '3.0', 'all');
	wp_localize_script( 'jquery', 'wppath', array('template_path' => get_template_directory_uri('template_directory')));
	wp_enqueue_script('jquery.fitvids', KAYA_THEME_JS .'/jquery.fitvids.js',array(),'', true);
	//wp_enqueue_script('theme-customizer', KAYA_THEME_JS .'/theme-customizer.js',array(),'', true);
	wp_enqueue_script('cloud-zoom.1.0.2.min', KAYA_THEME_JS .'/cloud-zoom.1.0.2.min.js',array(),'', true);// Bx Slider js
   if( class_exists('woocommerce') ){
		wp_enqueue_style('css_woocommerce', get_template_directory_uri() .'/css/kaya_woocommerce.css', false, '', 'all'); // Woocommerce
	}
	wp_register_style('css_responsive', get_template_directory_uri() . '/css/responsive.css', true, '3.0', 'all');
	  $responsive_mode = get_theme_mod( 'responsive_layout_mode' ) ? get_theme_mod( 'responsive_layout_mode' ) : 'on';
 
if($responsive_mode == "on"){
	wp_enqueue_style('css_responsive');

	}
	// Load Scripts and Styles for pages
	//if(is_page()){
		wp_register_script('jquery.superslides', KAYA_THEME_JS .'/jquery.superslides.js',array(),'', true);
	    wp_register_script('jquery_hammer', KAYA_THEME_JS .'/hammer.min.js',array(),'', true);
	    wp_register_style('superslides', get_template_directory_uri().'/css/superslides.css',false, '', 'all');

	     wp_enqueue_script('jquery.superslides');
	    wp_enqueue_script('jquery_hammer');
	    wp_enqueue_style('superslides');
	//}
	wp_register_script( 'jquery_easing', KAYA_THEME_JS .'/jquery.easing.1.3.js',array(),'', true);	 // Easing
	wp_enqueue_script("jquery_easing");		
	// Load Single Pages Scripts and Styles
	wp_enqueue_script('jquery.prettyPhoto', KAYA_THEME_JS .'/jquery.prettyPhoto.js',array(),'', true); // for fancybox  script
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() .'/css/prettyPhoto.css', false, '', 'all'); // for fancybox  css

	global $is_IE; // IE
    if( $is_IE ) {
		wp_enqueue_script('html5shim', '//html5shiv.googlecode.com/svn/trunk/html5.js', false, '1.1', true );
	}

	// BX SLIDER JS
		wp_register_script('jquery_bxslider', KAYA_THEME_JS .'/owl.carousel.js',array(),'', false);// Bx Slider js	  
	   	wp_enqueue_script('jquery_bxslider');

	// BX SLIDER JS
		wp_register_style('css_bxslider', get_template_directory_uri() .'/css/owl.carousel.css', false, '', 'all'); // Bx Slider css
		wp_enqueue_style('css_bxslider');


	// Isotop filter portfoloio
		wp_enqueue_script('jquery.isotope', KAYA_THEME_JS .'/jquery.isotope.min.js',array(),'', true);
	  	wp_enqueue_style('css_Isotope', get_template_directory_uri().'/css/Isotope.css',false, '', 'all');
		
		//wp_enqueue_script('classie', KAYA_THEME_JS .'/classie.js',array(),'1.0.3', true); // fitdiv
	   	//wp_enqueue_script('jquery.nicescroll.min', KAYA_THEME_JS .'/jquery.nicescroll.min.js',array(),'3.5.4', true); // nice scroller
		wp_enqueue_script('jquery-custom', KAYA_THEME_JS .'/custom.js',array(),'', true);
}

//Styles
add_action('wp_enqueue_scripts', 'kaya_css_styles');

function kaya_css_styles() {
$kaya_options = get_option('kayapati');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
		wp_enqueue_style( 'simplia-style', get_stylesheet_uri(), array() );
		//wp_enqueue_style('rtl', get_template_directory_uri() . '/rtl.css', true , '', 'all');
		//wp_enqueue_style( 'rtl', get_stylesheet_uri(), array() );
		wp_enqueue_style('css_portfolio', get_template_directory_uri() . '/css/portfolio.css',true, '3.0', 'all');
		wp_enqueue_style('css_slidemenu', get_template_directory_uri() . '/css/menu.css', true , '', 'all');
		wp_enqueue_style('css_skins', get_template_directory_uri().'/lib/includes/custom-skin.php', true, '', 'all');
		wp_register_style('css_responsive', get_template_directory_uri() . '/css/responsive.css', true, '3.0', 'all');
	  $responsive_mode = get_theme_mod( 'responsive_layout_mode' ) ? get_theme_mod( 'responsive_layout_mode' ) : 'on';
 
if($responsive_mode == "on"){
	wp_enqueue_style('css_responsive');

	}
	
	// Google Font======================	
	$google_bodyfont=get_theme_mod( 'google_body_font', '' ) ? get_theme_mod( 'google_body_font', '' ) : 'Open Sans';
	$google_menufont=get_theme_mod( 'google_menu_font', '' ) ? get_theme_mod( 'google_menu_font', '' ) : 'Pathway Gothic One';
	$google_generaltitlefont=get_theme_mod( 'google_heading_font', '' ) ? get_theme_mod( 'google_heading_font', '' ) : 'Pathway Gothic One';

		$protocol = is_ssl() ? 'https' : 'http';
	if( $google_generaltitlefont ){
    	wp_enqueue_style( 'title_googlefonts', $protocol.'://fonts.googleapis.com/css?family='. urlencode( $google_generaltitlefont ).'&subset=latin,cyrillic-ext,greek-ext,greek,cyrillic');
	}
	if( $google_menufont ){
    	wp_enqueue_style( 'google_menufont', $protocol.'://fonts.googleapis.com/css?family='. urlencode( $google_menufont ).'&subset=latin,cyrillic-ext,greek-ext,greek,cyrillic');
	}
	if( $google_bodyfont ){
    	wp_enqueue_style( 'google_bodyfont', $protocol.'://fonts.googleapis.com/css?family='. urlencode( $google_bodyfont ).'&subset=latin,cyrillic-ext,greek-ext,greek,cyrillic');
	}
	wp_enqueue_style( 'innova-ie', get_template_directory_uri() . '/css/ie9_down.css', array( 'innova-style' ) );
	wp_style_add_data( 'innova-ie', 'conditional', 'lt IE 9' );
}

//Admin script
add_action('admin_enqueue_scripts', 'kaya_admin_scripts');

function kaya_admin_scripts()
{
	wp_enqueue_script('kaya_custommeta', KAYA_DIRECTORY.'/js/kaya_admin_custommeta.js');

}
// Customizer
if( !function_exists('theme_customizer_js') ){
	function theme_customizer_js(){
		wp_enqueue_media();
		wp_enqueue_script('jquery_theme-customizer', get_template_directory_uri() .'/js/theme-customizer.js',array(),'', true);
		wp_enqueue_style('customizer_styles', get_template_directory_uri() . '/css/customizer_styles.css', false, '', 'all');
		//wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '', true );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'theme_customizer_js',100 );
?>