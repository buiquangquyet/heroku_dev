<?php
// Define Themename
$themename="simplia";
define('KAYA_LIB', get_template_directory(). '/lib');
define('KAYA_ADMIN', KAYA_LIB . '/admin');
define('KAYA_FUNCTIONS', KAYA_LIB . '/functions');
define('KAYA_WIDGETS', KAYA_LIB . '/functions/widgets');
define('KAYA_META', KAYA_LIB . '/functions/custom_meta');
define('KAYA_SHORTCODES', KAYA_LIB . '/functions/shortcodes');
define('KAYA_INCLUDES', KAYA_LIB . '/includes');
define('KAYA_THEME_JS', get_template_directory_uri() . '/js');
define('KAYA_ADMIN_JS', get_template_directory_uri() . '/lib/admin/js');
// theme optional panel
/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/
/* Set the file path based on whether the Options Framework is in a parent theme or child theme */
/* remove unnecessary p tag*/
/* Scripts and styles  */

define('KAYA_FILEPATH', get_template_directory());
define('KAYA_DIRECTORY', get_template_directory_uri());
function excerpt_ram($text) {
    return str_replace(' ', '', $text); }
//aq_resizer 
require_once(KAYA_FILEPATH . '/BFI_Thumb.php');
/* These files build out the options interface.  Likely won't need to edit these. */
require_once(KAYA_FUNCTIONS . '/custom_posts/kaya_slider.php');
require_once(KAYA_FUNCTIONS . '/custom_posts/kaya_portfolio.php');
require_once(KAYA_FUNCTIONS . '/custom_posts/toggletabs_accordion.php');
require_once locate_template('/lib/importer/kaya-importer.php');
require_once(KAYA_FUNCTIONS . '/kaya_pagination.php'); // pagination functions
//Plugin Activation 
require_once(KAYA_FILEPATH . '/lib/plugin-activation.php');
require_once locate_template('/lib/functions/custom_posts/kaya_testimonial.php');
add_filter( 'use_default_gallery_style', '__return_false' );
//Simplia Theme setup
add_action( 'after_setup_theme', 'kaya_simplia_theme_setup' );

function kaya_simplia_theme_setup() {

    // This theme allows users to set a custom background
    add_theme_support( 'custom-background');
    add_theme_support( 'custom-header' );


    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
    // This theme menu supports
    add_theme_support( 'nav-menus' );
    add_editor_style();

    // This theme uses wp_nav_menu() in 3 location.
    register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'innova' ),
    'footer' => __( 'Footer Navigation' , 'innova'),       
    ) );

    // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
    add_theme_support( 'post-thumbnails' );
    add_theme_support('post-formats',array( 'gallery','link','quote','video','audio' ) ); // Postformates
    add_image_size( 'gallery-thumb',600, 600, true );
}
// WP Default Gallery
add_shortcode( 'gallery', 'my_gallery_shortcode' );
function my_gallery_shortcode( $atts )
{
    $atts['link'] = 'file';
    return gallery_shortcode( $atts );
}
if ( ! isset( $content_width ) )
    $content_width ='';


add_action( 'tgmpa_register', 'kaya_required_plugins' );
function kaya_required_plugins() {

    $plugins = array(
   
            array(
            'name'      => 'SiteOrigin Page Builder',
            'slug'      => 'siteorigin-panels',
            'required'  => true,
        ),
         array(
                'name'      => 'Meta Box',
                'slug'      => 'meta-box',
                'required'  => true,
            ),
 
           array(
            'name'                  => 'Kaya Innova Page Widgets', // The plugin name
            'slug'                  => 'kaya-innova-page-widgets', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/lib/plugins/kaya-innova-page-widgets.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),  

    );
    $theme_text_domain = 'innova';
 
    $config = array(
       'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                       // Message to output right before the plugins table
        'strings'              => array(
            'page_title'                                   => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                   => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                   => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                         => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'                 => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                      => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'                => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'            => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                     => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'            => _n_noop( '"%1$s" plugin needs to be updated to its latest version to ensure maximum compatibility with this theme.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'                         => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                                   => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                               => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                       => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                             => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                     => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'                                    => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
 
    tgmpa( $plugins, $config );
 
}
// End
require_once(KAYA_INCLUDES . '/theme-functions.php'); //header functions
require_once(KAYA_INCLUDES . '/kaya_custom_js.php'); //header functions
require_once(KAYA_INCLUDES . '/header_loads.php'); //Jquery & Css Load
require_once (KAYA_INCLUDES. '/customizer/theme_customization.php'); 
require_once(KAYA_FUNCTIONS . '/kaya_comments.php'); // comments page
require_once(KAYA_FUNCTIONS . '/common.php'); // common functions
require_once(KAYA_INCLUDES . '/siteorigen_panel_row_styles.php'); //Panel Row Styles
require_once(KAYA_INCLUDES . '/kaya-sidebar-generator.php'); //Sidebar Generator]

//Widgets Registration
require_once(KAYA_WIDGETS . '/widgets.php');
// Make theme available for translation
// Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'innova', get_template_directory(). '/languages' );
    $locale = get_locale();
    $locale_file = get_template_directory(). "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );


// limit the post content ======================================================================================
function kaya_content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).' ';
    } else {
    $content = implode(" ",$content);
    }   
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('get_the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function innova_filter_panels_row_class( $class, $row ){
    if( !empty( $row['style']['row_stretch'] ) ) {
        switch( $row['style']['row_stretch'] ) {
            case 'full-stretched':
                $class[] = 'my-full-stretched-class';
                break;
            case 'full':
                $class[] = 'my-full-width-class';
                break;
        }
    }

    return $class;
}

add_filter( 'siteorigin_panels_row_classes', 'innova_filter_panels_row_class', 10, 2 );
/*

 * Thank to Bob Sherron.
 * http://stackoverflow.com/questions/1155565/query-multiple-custom-taxonomy-terms-in-wordpress-2-8/2060777#2060777

 */
 function kaya_multi_tax_terms($where) {
    global $wp_query;
    global $wpdb;
    if (isset($wp_query->query_vars['term']) && (strpos($wp_query->query_vars['term'], ',') !== false && strpos($where, "AND 0") !== false) ) {
        // it's failing because taxonomies can't handle multiple terms
        //first, get the terms
        $term_arr = explode(",", $wp_query->query_vars['term']);
        foreach($term_arr as $term_item) {
            $terms[] = get_terms($wp_query->query_vars['taxonomy'], array('slug' => $term_item));
        }

        //next, get the id of posts with that term in that tax
        foreach ( $terms as $term ) {
            $term_ids[] = $term[0]->term_id;
        }

        $post_ids = get_objects_in_term($term_ids, $wp_query->query_vars['taxonomy']);

        if ( !is_wp_error($post_ids) && count($post_ids) ) {
            // build the new query
            $new_where = " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
            // re-add any other query vars via concatenation on the $new_where string below here

            // now, sub out the bad where with the good
            $where = str_replace("AND 0", $new_where, $where);
        } else {
            // give up
        }
    }
    return $where;
}
add_filter("posts_where", "kaya_multi_tax_terms");

/* Include Meta Box Script */
    include 'lib/meta-boxes.php';
    // Remove query string from static files
    function remove_cssjs_ver( $src ) {
     if( strpos( $src, '?ver=' ) )
     $src = remove_query_arg( 'ver', $src );
     return $src;
    }
    add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
    add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
// Woo Commerce Shop Page title
    add_theme_support( 'woocommerce' );
if( class_exists('woocommerce')){
    function override_page_title() {
        return false;
    }
    add_filter('woocommerce_show_page_title', 'override_page_title');

   // Cart Items adding With out refresh
    add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php

    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;

}
function innova_product_category_class($classes) {
    global $product, $woocommerce_loop, $post;
    if( is_woocommerce() ){
        $shop_columns = get_theme_mod('shop_page_columns') ? get_theme_mod('shop_page_columns') : '4';
        foreach((get_the_terms($post->ID, 'product_cat')) as $term){
            $classes[] = $term->name;
            $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $shop_columns );
            if( is_shop() ){
                $classes[] ='shop-product-coloumns-'.$shop_columns;
            }   
            else{
                $classes[] ='shop-product-coloumns-'.$woocommerce_loop['columns'];  
            }
        }
   }
    return $classes;
}
add_filter('post_class', 'innova_product_category_class');
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
        global $post;
        $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        if (  $img_url ) {
            return get_the_post_thumbnail( $post->ID, $size );
        } else {
           echo '<img src="'.get_template_directory_uri().'/images/woo_product_image.jpg"  alt="" />';
        }
    }
}
}
//end
add_action( 'after_setup_theme', 'innova_theme_setup' );
    function innova_theme_setup() {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
?>