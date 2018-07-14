<?php
add_theme_support('automatic-feed-links');
global $post;
 /* Resize Images Width Fullwisth/Sidebar 
 ----------------------------------------- */
 
function kaya_image_width( $postid ){
	$sidebar_layout = get_post_meta($postid,'kaya_pagesidebar',true); 
	$kaya_width = ($sidebar_layout == "full" ) ? '1250' : '719';
	return $kaya_width;
 }
 
/* Image Resize
 ----------------------------------------- */
  /*
* @param	string $url - (required) must be uploaded using wp media uploader
* @param	int $width - (required)
* @param	int $height - (optional)
* @param	bool $crop - (optional) default to soft crop
* @param	bool $single - (optional) returns an array if false ?>

*/

function kaya_imageresize($postid,$params,$class){
	global $post;
	$title=get_the_title($post->Id);
	$img_url=wp_get_attachment_url( get_post_thumbnail_id() );
	if( $img_url ) {
		$out='<img class="'.$class.'" src="'.bfi_thumb( $img_url, $params ).'" alt="'.$title.'" />';
	}else{
		$imgurl = get_template_directory_uri().'/images/bx_slider_default_img.jpg';
		$out='<img class="'.$class.'" src="'.bfi_thumb( $imgurl, $params ).'" alt="'.$title.'" />';
	}
	return $out;
}
	 
 /* Upload Image Resize
 ----------------------------------------- */
 /*
* @param	string $url - (required) must be uploaded using wp media uploader
* @param	int $width - (required)
* @param	int $height - (optional)
* @param	bool $crop - (optional) default to soft crop
* @param	bool $single - (optional) returns an array if false ?>

*/
 
function kaya_defaulturlresize( $theImageSrc,$params,$class )
{ 
	global $post;
	$title=get_the_title($post->Id);
	$out='';
	if( $theImageSrc ) {
		$out.='<img class="'.$class.'" src="'.bfi_thumb($theImageSrc, $params ).'" alt="'.$title.'" />';
	}else{
		$imgurl = get_template_directory_uri().'/images/bx_slider_default_img.jpg';
		$out='<img class="'.$class.'" src="'.bfi_thumb( $imgurl, $params ).'" alt="'.$title.'" />';
	}
	return $out;	
}
// Site Title and Desc
function kaya_wp_title( $title ) {
	global $page, $paged;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";
	return $title;
}
add_filter( 'wp_title', 'kaya_wp_title', 10, 1 ); // End
// Logo Display Function
if(!function_exists('kaya_logo_image')): // Logo
function kaya_logo_image() {
	echo '';
	 $kaya_default_logo = esc_attr( get_template_directory_uri().'/images/logo.png' );
     $kaya_logo = get_option('kaya_logo');
     $logo = isset( $kaya_logo['upload_logo'] ) ? $kaya_logo['upload_logo']  : $kaya_default_logo;
     //print_r( $logo );
	if( empty( $logo ) ) {
		$kaya_logo = '<h1 class="site-title">'.get_bloginfo( 'name' ).'</h1>';
		$kaya_logo = apply_filters('kaya_logo_text', $kaya_logo);
	}
	else{
		if( $logo ) {
		 	$kaya_logo_src = esc_attr( $logo ) ? esc_attr( $logo ) : esc_attr( $kaya_default_logo );
		}else{
			$kaya_logo_src = esc_attr( get_template_directory_uri().'/images/logo.png' );
		}
		$kaya_logo_img = 'class="logo" src="'.esc_attr($kaya_logo_src).'" alt=""';
		$kaya_logo = apply_filters('kaya_image_logo', '<img '.$kaya_logo_img .' />');
	}
		echo apply_filters('kaya_logo_html', $kaya_logo);
		//echo '</h1>';
}	
endif; // End Logo
// Slider Include
	get_template_part('slider/kaya','slider');
// Dynamic customwidget
//-----------------------------------------
	$kaya_options = get_option('kayapati');
	$sidebar_widgets = isset( $kaya_options['custom_sidebar'] ) ? $kaya_options['custom_sidebar'] :'';
	if(is_array($sidebar_widgets)){
		array_unshift($sidebar_widgets, "select");
	}else {
			$sidebar_widgets = array();
			array_unshift($sidebar_widgets,"select");
		}
// page title
//-----------------------------------------

function kaya_custom_pagetitle( $post_id )
{

	$subheader_titleoptions=get_post_meta($post_id,'subheader_titleoptions',true);
	echo '<section class="sub_header_wrapper" >';
		echo '<section class="sub_header container">';
			//echo '<div class="two_third">';
		if(is_page()){
				if($kaya_custom_title=get_post_meta($post_id,'kaya_custom_title',true)) {		
					echo '<h2> '.$kaya_custom_title.'</h2>';			
				}
				else{
					echo '<h2>'.get_the_title($post_id).'</h2>';
				}
				if($kaya_custom_title_description=get_post_meta($post_id,'kaya_custom_title_description',true)) {		
					echo '<P>'.$kaya_custom_title_description.'</P>';
				} 
		}elseif( is_single()){ 
			if($kaya_custom_title=get_post_meta($post_id,'kaya_custom_title',true)) {		
					echo '<h2> '.$kaya_custom_title.'</h2>';			
				} else{
						echo '<h2>'.get_the_title($post_id).'</h2>';
				} ?>
				<div id="singlepage_nav" > <!-- Navigation Buttons -->
					<div class="nav_prev_item">
						<?php previous_post_link( '%link', '<span class="meta-nav-prev"> &nbsp;</span>' ); ?>
					</div>
					<div class="nav_next_item">
						<?php next_post_link( '%link', '<span class="meta-nav-next">&nbsp;</span>' ); ?>
					</div>
				</div>
	<?php	} elseif(is_tag()){ ?>
		<h2>
			<?php printf( __( 'Tag Archives: %s', 'innova' ), single_cat_title( '', false ) ); ?>
		</h2>
	<?php }
	elseif ( is_author() ) {
		the_post();
		echo '<h2>'.sprintf( __( 'Author Archives: %s', 'vantage' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ).'</h2>';
		rewind_posts();

	} elseif (is_category()) { ?>
		<h2>
			<?php printf( __( 'Category Archives: %s', 'innova' ), single_cat_title( '', false ) ); ?>
		</h2>

		<?php } elseif( is_tax() ){
	global $post;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		 echo '<h2>' .$term->name.'<h2>'; 

	}elseif (is_search()) { ?>

	<h2><?php printf( __( 'Search Results for: %s', 'innova' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
	<?php }elseif (is_404()) { ?>
			<h2> <?php _e( 'Error 404 - Not Found', 'innova' ); ?> </h2>
		<?php }
		elseif ( is_day() ){ ?>
		<h2>
			<?php  printf( __( 'Daily Archives: %s', 'innova' ), '<span>' . get_the_date() . '</span>' ); ?>
		</h2>
		<?php }			 
		 elseif ( is_month() ) { ?>
		 <h2>
		<?php 	printf( __( 'Monthly Archives: %s', 'innova' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
		</h2>
		<?php } elseif ( is_year() ){ ?>
			<h2>	<?php printf( __( 'Yearly Archives: %s', 'innova' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?> </h2>
		
		<?php }elseif ( class_exists('woocommerce') ){

			if( is_shop() ) { 
				if($kaya_custom_title=get_post_meta(wc_get_page_id('shop'),'kaya_custom_page_title',true)) {		
					echo '<h2> '.$kaya_custom_title.'</h2>';			
				} 
				else{ ?>
						<h2><?php _e('Shop','innova'); ?></h2>
				<?php }
				if($kaya_custom_title_description=get_post_meta(wc_get_page_id('shop'),'kaya_custom_title_description',true)) {		
					echo '<P>'.$kaya_custom_title_description.'</P>';
				} }
 
		?>
		<?php }else { ?>
		<h2>	<?php _e( 'Blog Archives', 'innova' ); ?> </h2> 
		<?php }
				
		echo'</section>';
	echo'</section>';
}
function kaya_page_title_bar(){
global $post;
//$PageSubheader=get_post_meta($post->ID,'PageSubheader',true);
		if(is_front_page()){ }
		//else if( is_page() ){
			//if($PageSubheader=='show'){
			//	echo kaya_custom_pagetitle($post->ID); 	
		 //}
		//}
		else{
				echo kaya_custom_pagetitle($post->ID);
		}
	}
?>
<?php

//portfolio related post
//-------------------------------------------
	get_template_part('lib/includes/relatedpost');
	
// Post Views Count
function observePostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

function fetchPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count.' Views';
}	

// footer columns
//-------------------------------------------
function kaya_footercolumn( $column )
{
	// column wise  footer widget
	if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('footer_column_'.$column.'') ) : ?>
		<div class="widget_container">
        <h3> <?php _e( ' Footer Column ', 'kaya_admin' ); echo $column; ?> </h3>
            <p>
                <?php _e( 'Wesce sit amet porttitor leo <a href="#">this is hyper link</a> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque interdum, nulla sit amet varius dignissim Vestibulum pretium risus', 'innova' ); ?>
            </p>	
	 	</div>
	<?php endif; 
}
class Kaya_Description_Walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           //$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           //if($depth != 0)
           //{
                    // $description = $append = $prepend = "";
          // }
		  $description='';
		  $item_desc='';
		  if($item->description){
		  $item_desc='<i class="fa '.esc_attr( $item->description ).'"> </i>';
		  }
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>'.$item_desc.'';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
         $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
         $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return  implode($seperator, $rgbArray); // returns the rgb string or the associative array
}
// Sidebar ID
function kaya_post_item_id(){
	 global $post_item_id, $post;
	if( class_exists('woocommerce')){	
		if( is_shop() ){
			$post_item_id = wc_get_page_id( 'shop' );
		}
		else{
			if( get_post()){ $post_item_id = $post->ID;}
		}
	}
	elseif(get_post()){
		$post_item_id = $post->ID;
	}else{

	}
}

?>