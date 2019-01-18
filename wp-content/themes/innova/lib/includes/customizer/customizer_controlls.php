<?php
/**
* Sidebars Controll  
*/
class Kaya_Customize_Sidebar_Control extends WP_Customize_Control
{
	public $type = 'sidebar';
	public function render_content()
    { 
    	require_once locate_template('/lib/includes/kaya-sidebar-generator.php');
        $sidebars = sidebar_generator::get_sidebars(); ?>
        <label class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
       	<?php
       	global $wp_customize, $wp_registered_sidebars;
       	if( $wp_customize){
    	   	for ($i=1; $i <= 5 ; $i++) { 
					unset($GLOBALS['wp_registered_sidebars']['footer_column_'.$i]);				
				}
			}
			if ( empty( $wp_registered_sidebars ) )
			return; ?>
			<select <?php $this->link(); ?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
		        <?php
                   foreach ( $wp_registered_sidebars as $sidebar )
                    {
                        echo '<option value="'.$sidebar['id'].'">'.$sidebar['name'].'</option>';
                    }
                ?>
                </select>
   <?php    	}
} ?>