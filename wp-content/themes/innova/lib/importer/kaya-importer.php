<?php 
class Globel_Demo_Import
{
    function __construct() {
        if ( ! is_admin() ) {
            return;
        }
        add_action('admin_menu', array(&$this, 'kaya_admin_option_page'));
    }
    /**
     * Importing XML Demo content
     */
    function kaya_admin_option_page(){
        add_menu_page('Options', ucfirst('innova').' Options', 'manage_options', 'kaya_theme_options', array(&$this, 'import_xml_content'), '', 62);
        add_submenu_page('kaya_theme_options', 'Import', 'One Click Demo', 'manage_options', 'one_click_import', array(&$this,'import_xml_content'));
        remove_submenu_page( 'kaya_theme_options', 'kaya_theme_options' );
    }
    function import_xml_content(){
        echo '<h3>'.__('Choose Your','innova').' ' .ucfirst('innova'). ' '.__('Demo Content','innova').'</h3>';
         echo '<div class="kaya_demo_note"><strong style="color:red;">'. __('Note-1','innova').' : </strong> '.__(' Before importing demo content make sure that you have installed and activated " '. ucfirst('innova').' " theme required plugins for more information &nbsp;<a target="_blank" href="https://www.youtube.com/watch?v=ouCQeZLBz7Y&feature=youtu.be">'.__('Watch this video.').'</a>').'</div>';
          echo '<div class="kaya_demo_note"><strong style="color:red;">'. __('Note-2','innova').' : </strong>'.__('After Importing One Click Demo Content &nbsp;<a target="_blank" href="https://www.youtube.com/watch?v=QJiUQ62PFEE&feature=youtu.be">'.__('Watch this video').'</a>&nbsp; For adding images.').'</div>';
        ?>
        <div id="import_xml_content_wrapper">            
            <div class="content_loading_wrapper">
                <img class="content_loading" style="display:none" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="" /><div class="import_message"> </div>
            </div>
         <span class="clear"> </span>
            <label>
               <input type="radio" name="demo_content" id="innova" value="innova" checked />
                <img src="<?php echo get_template_directory_uri() ?>/images/demo_xml_images/innova.jpg">
                <h4><?php echo __('Home Page styles1','innova') ?></h4>
            </label>
             <label>
               <input type="radio" name="demo_content" id="innova_old" value="innova_old" />
                <img src="<?php echo get_template_directory_uri() ?>/images/demo_xml_images/innova_old.jpg">
                 <h4><?php echo __('Home Page styles2' ,'innova') ?></h4>
            </label>
            <span class="clear"> </span>
            <input type="button" class="xml_demo_import button button-primary button-large" value="import content" />
        <?php
            echo '<div class="clear"> </div>';
            echo '</div>';
            $css ='';
            $css .='.content_loading_wrapper {
                    margin-top: 30px;
                }
            .content_loading_wrapper img {
                float: left;
                margin-right: 15px;
            }
            label > input{ 
              visibility: hidden;
              position: absolute;
            }
            #import_xml_content_wrapper label {
               float: left;
                margin-bottom: 30px;
                margin-right: 1.5%;
                overflow: hidden;
                text-align: center;
                width: 23.5%;
            }
            .xml_demo_import {
                float: left;
                margin-bottom: 30px !important;
               margin-right: 1.5% !important;
            }
             .kaya_demo_note {
             background: #fff;
             border-left: 4px solid #fff;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
             box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
             margin: 5px 15px 2px;
             padding: 15px;
             border-left-color: #46b450;
            }
            .import_message{
                margin-top: 30px;
                margin-bottom: 30px;
            }
            .import_message .updated{
                margin-left:0; 
            }
            #import_xml_content_wrapper label img {
                background: none repeat scroll 0 0 #f5f5f5;
                border: 1px solid #dfdfdf;
                display: block;
                margin-right: 16px;
                overflow: hidden;
                padding: 6px;
                width: 95%;
            }
            label > input:checked + img {
                border: 1px solid #2ea2cc!important;
            }';
            $css = preg_replace( '/\s+/', ' ', $css );
            $output = "<style type=\"text/css\">\n" . $css . "\n</style>";
            echo $output;  ?>     
        <script>
            (function($) {
            "use strict";
                 $("input[type='button']").click(function(){
                     var $import_options = $("input[name='demo_content']:checked").val();
                     if( $import_options == undefined){
                        alert('Please Choose Your Demo Content');
                        return;
                     }
                    //alert($import_options);
                    var $import_true = confirm('are you sure to import dummy content ? it will overwrite the existing data');
                    if($import_true == false) return;
                    $('.import_message').html(' Data is being imported please be patient, while the awesomeness is being created :)  ');
                    $('.content_loading').show();
                    $('html, body').animate({scrollTop: $("body").offset().top}, 400);
                    var data = {
                        action: 'demo_xml_content_import',
                        xml: $import_options,     
                    };
                    $.post(ajaxurl, data, function(response) {
                        $('.import_message').html('<div class="import_message_success">'+ response +'</div>');
                        $('.content_loading').hide();
                    });
                });
            })(jQuery);
        </script>
        <?php 
    }
}
$globel_options = new Globel_Demo_Import();
add_action( 'wp_ajax_demo_xml_content_import', 'demo_xml_content_import' );
function demo_xml_content_import() 
{ 
    
    global $wpdb, $post;
    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);    
    // Load Importer API
    require_once ABSPATH . 'wp-admin/includes/import.php';
    if ( ! class_exists( 'WP_Importer' ) ) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) )
        {
            require $class_wp_importer;
        }
    }
    if ( ! class_exists( 'WP_Import' ) ) {
        $class_wp_importer = get_template_directory() ."/lib/importer/wordpress-importer.php";
        if ( file_exists( $class_wp_importer ) )
            require $class_wp_importer;
    }
    //ob_start();
    if ( class_exists( 'WP_Import' ) ) 
    { 
        if( $_POST['xml'] ){
            $files = $_POST['xml'];
        }else{
            // $files = 'globel1';
        }
        $import_filepath = get_template_directory() ."/lib/kaya-xml-files/".$files."/".$files.".xml" ; // Get the xml file from directory     
        $wp_import = new WP_Import();
        set_time_limit(0);
        $wp_import->fetch_attachments = false;
        $wp_import->import($import_filepath);
        // Customizer options 
        $file_name = $files.'.json'; // Get the name of file
        if( $file_name ){
            //$file_ext = strtolower(end(explode(".", $file_name))); // Get extension of file
            $file_extention = explode('.', $file_name); // Get extension of file
            $file_ext = end($file_extention);
            if (($file_ext == "json")) {
                $customizer_content = get_template_directory() ."/lib/kaya-xml-files/".$files."/".$file_name;
                 if( $customizer_content ){
                    $encode_options = file_get_contents($customizer_content);
                    $options = json_decode($encode_options, true);
                    foreach ($options as $key => $value) {
                        set_theme_mod($key, $value);
                    }
                    $locations = array();
                    if (is_array($options['nav_menu_locations'])) {
                           foreach ($options['nav_menu_locations'] as $menu_name => $menu_id) {
                            $locations[$menu_name] = $menu_id;
                            set_theme_mod( 'nav_menu_locations', $locations);
                        }
                    }                    
                    $front_page = !empty( $options['front_page_name'] ) ?  $options['front_page_name'] : '2';
                    $page_title = get_the_title( $front_page );
                    $front_page_name = get_page_by_title( $page_title );
                    if( $front_page_name == 'Sample Page' ){ }
                    else{
                        update_option( 'page_on_front', $front_page_name->ID );
                        update_option( 'show_on_front', 'page' );
                    }
                    echo "<div class='updated'><p>".__('All options are restored successfully','innova')."</p></div>";
                }else{
                 echo "<div class='error'><p>".__('Error occured while loading / File not found','innova')."</p></div>";
                }
                }
            }else{
                 echo "<div class='error'><p>".__('Error occured while loading / File not found','innova')."</p></div>";
            }
   // ob_get_clean();
    }
    die(); // this is required to return a proper result
}
add_action('wp_ajax_customizer_data_import', 'customizer_data_import');
function customizer_data_import(){
    echo $files = $_POST['xml'];
     $file_name = trim($files).'.json'; // Get the name of file
        echo $file_ext = strtolower(end(explode(".", $file_name))); // Get extension of file
       if (($file_ext == "json")) {
            $customizer_content = get_template_directory() ."/lib/demo-files/".$file_name;
            $encode_options = file_get_contents($customizer_content);
            $options = json_decode($encode_options, true);
            foreach ($options as $key => $value) {
                set_theme_mod($key, $value);
            }
            echo "<div class='updated'><p>".__('All options are restored successfully','innova')."</p></div>";
       }
}
?>