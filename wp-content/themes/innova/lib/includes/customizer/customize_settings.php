<?php
// Customizer Import and Export Settings
ob_start();
class kaya_Customizer_Menu {
	function __construct() {
		if ( ! is_admin() ) {
			return;
		}
		add_action( 'admin_menu', array( $this, 'kaya_customizer_menu_setion' ) );
	}
	/**
	 * Import and export settings
	 */
	function kaya_customizer_menu_setion() 
	{
		add_menu_page('Customizer', 'Customizer', 'edit_theme_options', 'customize.php', '', '', 61);
		add_submenu_page('customize.php', 'Import', 'Import', 'edit_theme_options', 'import', array( $this,'customize_import_option_page'));
	    add_submenu_page('customize.php', 'Export', 'Export', 'edit_theme_options', 'export', array( $this,'customize_export_option_page'));
    }
	function customize_export_option_page() {
    if (!isset($_POST['export'])) {
        ?>
        <div class="wrap">
            <div id="icon-tools" class="icon32"><br /></div>
            <h2><?php _e('Export','innova'); ?> </h2>
            <p><?php _e('When you click <tt>Backup all options</tt> button, system will generate a JSON file for you to save on your computer.</p>
            <p>This backup file contains all configution and setting options on our website. Note that it do <b>NOT</b> contain posts, pages, or any relevant data, just your all options.','innova'); ?></p>
            <p> <?php _e('After exporting, you can either use the backup file to restore your settings on this site again or another WordPress site.','innova'); ?> </p>
            <form method='post'>
                <p class="submit">
                    <?php wp_nonce_field('customize-export'); ?>
                    <input type='submit' name='export' value='Dowload Customizer Settings' class="button"/>
                </p>
            </form>
        </div>
        <?php
    }
    elseif (check_admin_referer('customize-export')) {
         $blogname = str_replace(" ", "", get_option('blogname'));
        $date = date("m-d-Y");
        $json_name = $blogname."-".$date; // Namming the filename will be generated.
         $options = get_theme_mods(); // Get all options data, return array        
         foreach ($options as $key => $value) {
            $value = maybe_unserialize($value);
            $need_options[$key] = $value;
        }
        $need_options['front_page_name'] .= get_option('page_on_front');
        $json_file = json_encode($need_options); // Encode data into json data
        ob_clean();
        echo $json_file;
        header("Content-Type: text/json; charset=" . get_option( 'blog_charset'));
        header("Content-Disposition: attachment; filename=$json_name.json");
        exit();
    }
}
function customize_import_option_page() {
    ?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2>Import</h2>
        <?php
            if (isset($_FILES['import']) && check_admin_referer('customize-import')) {
                if ($_FILES['import']['error'] > 0) {
                    wp_die("Please Choose Upload json format file");
                }
                else {
                    $file_name = $_FILES['import']['name']; // Get the name of file
                    $file_ext = strtolower(end(explode(".", $file_name))); // Get extension of file
                    $file_size = $_FILES['import']['size']; // Get size of file
                    /* Ensure uploaded file is JSON file type and the size not over 500000 bytes
                     * You can modify the size you want
                     */
                    if (($file_ext == "json") && ($file_size < 500000)) {
                        $encode_options = file_get_contents($_FILES['import']['tmp_name']);
                        $options = json_decode($encode_options, true);
                        $front_page = !empty( $options['front_page_name'] ) ?  $options['front_page_name'] : '2';
                        foreach ($options as $key => $value) {
                            set_theme_mod($key, $value);
                        }
                         $locations = array();
                        foreach ($options['nav_menu_locations'] as $menu_name => $menu_id) {
                            $locations[$menu_name] = $menu_id;
                            set_theme_mod( 'nav_menu_locations', $locations);
                            }
                        //set_theme_mod( 'nav_menu_locations', '');
                        $page_title = get_the_title( $front_page );
                        $front_page_name = get_page_by_title( $page_title );
                        if( $front_page_name == 'Sample Page' ){ }
                        else{
                            update_option( 'page_on_front', $front_page_name->ID );
                            update_option( 'show_on_front', 'page' );
                        }
                        echo "<div class='updated'><p>".__('All options are restored successfully','innova')."</p></div>";
                    }
                    else {
                        echo "<div class='error'><p>".__('Invalid file or file size too big.','innova')."</p></div>";
                    }
                }
            }
        ?>
        <p><?php _e('Click Browse button and choose a json file that you backup before.','innova'); ?> </p>
        <p><?php _e('Press Upload File and Import, WordPress do the rest for you.','innova'); ?></p>
        <form method='post' enctype='multipart/form-data'>
            <p class="submit">
                <?php wp_nonce_field('customize-import'); ?>
                <input type='file' name='import' class="primary-button"  />
                <input type='submit' name='submit' value='Upload File and Import' class="button"/>
            </p>
        </form>
    </div>
    <?php
}
}
$admin_page = new kaya_Customizer_Menu();
?>
