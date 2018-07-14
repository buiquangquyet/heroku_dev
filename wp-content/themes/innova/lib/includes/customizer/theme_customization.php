<?php
include_once('customize_settings.php');
add_action('customize_register', 'themename_customize_register');
function themename_customize_register($wp_customize) {
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'nav' );
    $wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_1' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_2' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_3' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_4' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_5' );
	$wp_customize->remove_section( 'sidebar-widgets-sidebar-1' );
	$wp_customize->get_section('background_image')->priority =2;
	$wp_customize->get_section('background_image')->title = __( 'Background Image' );
	$wp_customize->get_section('background_image')->panel = 'layout_options_panel';
	$wp_customize->remove_section( 'themes' );
	}
///Sanitize Functions number validation 
function check_number( $input ) {
    $input = absint( $input );
 return ( $input ? $input : '00' );
}
function opacity_number_validate( $input ){
  return $input;
} 
function text_filed_sanitize( $input ) {
    return  ( $input ? $input : '&nbsp;' );
}
function color_filed_sanitize( $input ) {
    return $input;
}
function checkbox_field_sanitize( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}
function upload_sanitize_id( $input ) {
        return $input;
}
function radio_buttons_sanitize( $input, $setting ) {
    global $wp_customize;
     $control = $wp_customize->get_control( $setting->id );
     if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

 function kaya_customize_register( $wp_customize ){
   	class Kaya_Customize_Subtitle_control extends WP_Customize_control{
   			public $type = 'sub-title';
   			public function render_content(){
   				echo '<h4 class="customizer_sub_section">'.esc_html($this->label).'</h4>';
   			}
   		}
   		// Register Our Custom Controlls
class Kaya_Customize_Sliderui_Control extends WP_Customize_Control {
	public $type = 'slider';
	public function enqueue() {
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_style("jquery-ui");
	}
	public function render_content() { ?>
		<label>
			<span class="customize-control-title">	<?php echo esc_html( $this->label ); ?>	</span>
			<input type="text" class="kaya-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
		</label>
		<div id="slider_<?php echo $this->id; ?>" class="custom_slider"></div>
		<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
					value : <?php echo $this->value() ?  $this->value() : '0'; ?>,
					min   : <?php echo $this->choices['min']; ?>,
					max   : <?php echo $this->choices['max']; ?>,
					step  : <?php echo $this->choices['step']; ?>,
					slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
		</script>
	<?php
	}
}
   	class Kaya_Customize_Textarea_Control extends WP_Customize_control{
   		public $type = 'text-area';
   		public function render_content(){ ?>
   			<label class="customize-control-title"> <?php echo esc_html( $this->label ); ?></label>
   			<textarea rows="6" width="100%" <?php $this->link(); ?> ><?php echo esc_textarea( $this->value() ); ?></textarea>
   		<?php }
   	}
   	/**
* Pages Controll  
*/
class Kaya_Customize_Page_Control extends WP_Customize_Control
{
	private $pages = false;
	public $type = 'page';
    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->pages = get_pages($options);
        parent::__construct( $manager, $id, $args );
    }
	public function render_content()
    {
        if(!empty($this->pages))
        {
            ?>
                <label class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
                    <select <?php $this->link(); ?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                    <option value=""><?php _e('Select Page Footer','interia') ?></option>
                    <?php
                        foreach ( $this->pages as $page )
                        {
                            echo '<option value='.$page->ID.'>'.$page->post_title.'</option>';
                        }
                    ?>
                    </select>                
            <?php
        }
    }
}
class Kaya_Customize_Description_Control extends WP_Customize_Control{
   		public $type = 'description';
      public $html_tags = false;
      public function render_content(){
    if( $this->html_tags == true ){
      echo '<span class="title_description">'.$this->label.'</span>';
    }else{
      echo '<span class="title_description">'.esc_html( $this->label ).'</span>';
    }
  }
   	}
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
}
   	class Kaya_Customize_Multiselect_Control extends WP_Customize_Control
   		{
   			public $type = 'multi-select';
   			public function render_content()
   			{ ?>
   				<label class="customize-control-title"><?php echo esc_html($this->label); ?></label>
   				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
   					<?php 

   						foreach ( $this->choices as $value => $label ) {
   							$selected = ( in_array($value, $this->value()) ) ? selected(1,1,false) : '';
   							echo '<option value="'.esc_attr( $value ).'" '.$selected.'>'.$label.'</option>';	
   						}

   					?>
   				</select>	
   		<?php }
   		}
   	class Kaya_Customize_Images_Radio_Control extends WP_Customize_Control {
			public $type = 'img_radio';
			public function render_content() {
			if ( empty( $this->choices ) )
			return;
			$name = 'customize-image-radios-' . $this->id;	 ?>
			
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php foreach ( $this->choices as $value => $label ) { ?>
				<?php $selected = ( $this->value() == $value ) ? 'kaya-radio-img-selected' : ''; ?>
				<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="kaya-radio-img <?php echo $selected; ?>">
				<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="img_radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				<img src="<?php echo $label['img_src']; ?>" alt="" />
				</label>
			<?php
			} // end foreach
		}	
  	 }
  	 // Multi text field
  	  class Kaya_Multi_Text_Control extends WP_Customize_control{
   		public $type = 'multi-text';
   		public function render_content(){ 

   				 $class = 'regular-text';
        echo '<ul id="' . $this->id . '-ul">';

        if(isset($this->choices) && is_array($this->choices)) {
            foreach($this->choices as $k => $value) {
                if($value != '') {
                    echo '<li><input type="text" id="' . $this->$this->id . '-' . $k . '" name="kaya_custom_sidebar[]" value="' . esc_attr($value) . '" class="' . $class . '" /> <a href="javascript:void(0);" class="redux-opts-multi-text-remove">' . __('Remove', 'envata') . '</a></li>';
                }
            }
        } else {
            echo '<li><input type="text"  data-customize-setting-link="kaya_custom_sidebar"  id="' . $this->id . '" name="kaya_custom_sidebar[]" value="" class="' . $class . '" /> <a href="javascript:void(0);" class="redux-opts-multi-text-remove">' . __('Remove', 'envata') . '</a></li>';
        }

        echo '<li style="display:none;"><input type="text" data-customize-setting-link="kaya_custom_sidebar1" id="' . $this->id . '" name="kaya_custom_sidebar[]" value="" class="' . $class . '" /> <a href="javascript:void(0);" class="redux-opts-multi-text-remove">' . __('Remove', 'envata') . '</a></li>';
        echo '</ul>';
        echo '<a href="javascript:void(0);" class="redux-opts-multi-text-add" rel-id="' . $this->id . '-ul" rel-name="kaya_custom_sidebar[]">' . __('Add More', 'envata') . '</a><br/>';
        //echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
   		}
   	}
   	// Google Fonts Seclect
class Kaya_Customize_google_fonts_Control extends WP_Customize_Control
{
	public $type = 'googlefonts';
	public function render_content(){ ?>
		<label class="customize-control-title"><?php echo esc_html($this->label); ?></label>
		<?php $list_fonts       = array();
		$list_font_weights 		= array();
		$webfonts_array    		= file( get_template_directory_uri().'/lib/includes/fonts.json');
		$webfonts          		= implode( '', $webfonts_array );
		$list_fonts_decode 		= json_decode( $webfonts, true );
		$list_fonts['default'] 	= 'Theme Default';
		foreach ( $list_fonts_decode['items'] as $key => $value ) {
			$item_family                     = $list_fonts_decode['items'][$key]['family'];
			$list_fonts[$item_family]        = $item_family; 
			$list_font_weights[$item_family] = $list_fonts_decode['items'][$key]['variants'];
		} ?>
		<select <?php $this->link(); ?> style="">
			<?php
			$defaylt_fonts = array ('0' => __('Select Font','innova'),
			'Arial,Helvetica,sans-serif' => 'Arial, Helvetica, sans-serif',
			"'Arial Black', adget,sans-serif" => "'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style',serif" => "'Bookman Old Style', serif",
			"'Comic Sans MS',cursive" => "'Comic Sans MS', cursive",
			"Courier,monospace" => "Courier, monospace",
			"Garamond,serif" => "Garamond, serif",
			"Georgia,serif" => "Georgia, serif",
			"Impact,Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
			"'Lucida Console',Monaco,monospace" => "'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode','Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif',Geneva,sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif','New York',sans-serif" => "'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype','Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma,Geneva,sans-serif" => "Tahoma, Geneva, sans-serif",
			"'Times New Roman',Times, serif" => "'Times New Roman', Times, serif",
			"'Trebuchet MS',Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva,sans-serif" => "Verdana, Geneva, sans-serif");

			$array = array('System Fonts' => $defaylt_fonts, 'Google Fonts' => $list_fonts);
			foreach ($array as $key => $val){	   
				echo '<optgroup label="'.$key.'">';
				    foreach ($val as $k => $v){
					    echo '<option value="'.$k.'">'.$v.'</option>';
					}
			    echo '</optgroup>';
			}
			?>
		</select>	
	<?php }
	}
	}
   add_action('customize_register','kaya_customize_register');
   function globel_font_family(){
	$header_text_logo_font_family = get_theme_mod('header_text_logo_font_family') ? get_theme_mod('header_text_logo_font_family') : 'Libre Baskerville';
	$google_bodyfont=get_theme_mod( 'google_body_font' ) ? get_theme_mod( 'google_body_font' ) : 'Roboto';
	$google_menufont=get_theme_mod( 'google_menu_font') ? get_theme_mod( 'google_menu_font') : 'Roboto';
	$google_generaltitlefont=get_theme_mod( 'google_heading_font' ) ? get_theme_mod( 'google_heading_font') : 'Libre Baskerville';
	$text_logo_tagline_font_family=get_theme_mod( 'text_logo_tagline_font_family' ) ? get_theme_mod( 'text_logo_tagline_font_family') : 'Arial,Helvetica,sans-serif';
	$customizer_font_names = array($header_text_logo_font_family, $google_bodyfont, $google_menufont, $google_generaltitlefont, $text_logo_tagline_font_family );
	$defaylt_fonts = array ('0','Arial,Helvetica,sans-serif',"'Arial Black', gadget,sans-serif" , "'Bookman Old Style',serif" ,"'Comic Sans MS',cursive" ,"Courier,monospace" ,"Garamond,serif" ,"Georgia,serif" ,"Impact,Charcoal, sans-serif" ,"'Lucida Console',Monaco,monospace" ,"'Lucida Sans Unicode','Lucida Grande', sans-serif" ,	"'MS Sans Serif',Geneva,sans-serif" ,"'MS Serif','New York',sans-serif" ,"'Palatino Linotype','Book Antiqua', Palatino, serif" ,"Tahoma,Geneva,sans-serif" ,"'Times New Roman',Times, serif" ,"'Trebuchet MS',Helvetica, sans-serif" ,"Verdana, Geneva,sans-serif");

	foreach ($customizer_font_names as $font_name) {
		if(in_array($font_name, $defaylt_fonts)) {	}
		else{
			$protocol = is_ssl() ? 'https' : 'http';
			if( $font_name ){
			wp_enqueue_style( 'font-family-'.str_replace(' ', '-', $font_name ), $protocol.'://fonts.googleapis.com/css?family='. urlencode( $font_name ).':300,400,700&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese' );
			}
		}
	}		
}
add_action('wp_enqueue_scripts','globel_font_family');
// LAYOUT SETTINGS
function layout_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'background_image',
	// Arguments array
	array(
		'title' => __( 'Layout Section', 'innova' ),
		'priority'       => 1,
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
$wp_customize->add_setting('kaya_layout_class',
		array(
			'deafult' => 'fluid_layout',
			));
	$wp_customize->add_control('kaya_layout_class',
		array(
			'label' => __('Select Layout Mode','innova'),
			'capability' => 'edit_theme_options', 
			'section' => 'background_image',
			'priority' => 1,
			'type' => 'select',
			'choices' => array(
				'fluid_layout' => __('Fluid','innova'),
				'box_layout' => __('Boxed','innova'),
				)
			));
 $wp_customize->add_setting( 'select_boxed_bg_type',  array(
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_boxed_bg_type', array(
        'type' => 'select',
        'label' => __('Select Boxed layout Background Type','innova'),
        'section' => 'background_image',
        'choices' => array(
           'bg_type_color' => __('Background Color','innova'),
           'bg_type_image' => __('Background Image','innova'),
          ),
    'priority' => 2,
    ));
    	$wp_customize->add_setting( 'boxed_layout_bg_color',
		array( 
			'default' => ''
		));
	$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize, 'boxed_layout_bg_color',
		array(
			'label' => __('Layout Background Color','innova'),
			'section' => 'background_image',
			'priority' => 3,
			'type' => 'color',
		)));
	$wp_customize->add_setting( 'upload_boxed[background_image1]',
		array( 
			'default' => '',
			'type' => 'option',
		));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'background_image1', array(
			'label' => __('Boxed Layout Background Image','innova'),
			'section' => 'background_image',
			'settings' => 'upload_boxed[background_image1]',
			'priority' => 3,
		)));
	 $wp_customize->add_setting('boxed_backgroundbg_repeat',
	array(
		'deafult' => 'no-repeat',
		));
$wp_customize->add_control('boxed_backgroundbg_repeat',
	array(
		'label' => __('Background Repeat','innova'),
		'capability' => 'edit_theme_options', 
		'section' => 'background_image',
		'priority' => 4,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','innova'),
			'repeat' => __('Repeat','innova'),
			)
		));
 $wp_customize->add_setting( 'box_layout_margin_top', array(
        'default'        => '0',
        'sanitize_callback' => 'check_number'
    ) );
 
  $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'box_layout_margin_top', array(
        'label'   => __('Box Layout Margin Top (px))','innova'),
        'section' => 'background_image',
        'type'    => 'text',
        'priority' =>5,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting( 'responsive_layout_mode',
		array( 
			'default' => 'on'
		));
	$wp_customize->add_control( 'responsive_layout_mode',
		array(
		'label' => __('Responsive Mode','innova'),
		'section' => 'background_image',
		'priority' => 10,
		'type' => 'radio',
		'choices' => array(
			'on' => __('On','innova'),
			'off' => __('Off','innova'),	
			)
		)
		);
/* $wp_customize->add_setting( 'box_layout_shadow', array(
        'default'        => '3',
    ) );
 
    $wp_customize->add_control( 'box_layout_shadow', array(
        'label'   => 'Box Layout Shadow ( px )',
        'section' => 'layout-section',
        'type'    => 'text',
        'priority' =>2,
    ) );

*/
}
add_action( 'customize_register', 'layout_section' );
//end
function boxed_layout_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'background_image',
	// Arguments array
	array(
		'title' => __( 'Layout Settings', 'innova' ),
		'priority'       => 10,
		
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
}
add_action( 'customize_register', 'boxed_layout_section' );
//Top Header Section
function top_box_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'header_top_bar_section',
	// Arguments array
	array(
		'title' => __( 'Header Topbar Section', 'innova' ),
		'priority'       => 0,
		'capability' => 'edit_theme_options',
		'panel' => 'header_settings_panel'
		//'description' => __( '', 'gilda' )
	));
	$wp_customize->add_setting( 'enable_top_header', array(
		'default'        => 0,
		'transport' => 'refresh',
		'capability'     => 'edit_theme_options',
	));
	$wp_customize->add_control('enable_top_header', array(
		'label'    => __( 'Enable Topbar Section','innova' ),
		'section'  => 'header_top_bar_section',
		'type'     => 'checkbox',
		'priority' => 1
	) );

 	$wp_customize->add_setting( 'select_top_header_background_type',  array(
        'default' => 'bg_type_color',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_top_header_background_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','innova'),
        'section' => 'header_top_bar_section',
        'choices' => array(
        	 'bg_type_color' => __('Background Color','innova'),
        	 'bg_type_image' => __('Background Image','innova'),
        	),
		'priority' => 1,
    ));
    $url=get_template_directory_uri().'/images/';
  $wp_customize->add_setting('upload_top_bar[top_bg_image]', array(
        'default'           => esc_url($url).'fluid-container1-bg.png',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'upload_sanitize_id',
        'transport'			=> ''
        //'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'top_bg_image', array(
        'label'    => __('Background Image', 'innova'),
        'section'  => 'header_top_bar_section',
        'settings' => 'upload_top_bar[top_bg_image]',
		'priority' => 2
    )));
    $wp_customize->add_setting('top_bar_bg_repeat',
	array(
		'deafult' => 'repeat',
		'sanitize_callback' => 'radio_buttons_sanitize',
		'transport' => '',
		));
$wp_customize->add_control('top_bar_bg_repeat',
	array(
		'label' => __('Background Repeat','innova'),
		'capability' => 'edit_theme_options', 
		'section' => 'header_top_bar_section',
		'priority' => 3,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => 'No Repeat',
			'repeat' => 'Repeat',
			'cover' => 'Cover'
			)
		)); 	
  $colors[] = array(
		'slug'=>'top_bar_bg_color',
		'default' => '#EEE',
		'label' => __('Top Bar Background Color', 'innova'),
		'priority' => 2
	);
$wp_customize->add_setting( 'header_top_left_section', array(
  			'default' => '<h3 style="font-size:2em;"> Fax Now: (925) 132-4545</h3>'
  	));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'header_top_left_section', array(
      'label'    => __( 'Top Header Left Section', 'innova' ),
      'section'  => 'header_top_bar_section',
      'settings' => 'header_top_left_section',
      'priority' =>7,
      'type' => 'text-area',
      ))  );

	$wp_customize->add_setting( 'top_bar_left_content_info', array(
			  	
	));
	$wp_customize->add_control(
	new Kaya_Customize_Description_Control( $wp_customize, 'top_bar_left_content_info', array(
	'label'    => __( 'Ex:<h3 style="font-size:2em;"> Fax Now: (925) 132-4545</h3>', 'innova' ),
	'section'  => 'header_top_bar_section',
	'settings' => 'top_bar_left_content_info',
	'priority' => 20
	))
	);	
 	$wp_customize->add_setting( 'top_bar_right_content', array(
	'default' => '',
	));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'top_bar_right_content', array(
      'label'    => __( 'Right Section Content', 'innova' ),
      'section'  => 'header_top_bar_section',
      'settings' => 'top_bar_right_content',
      'priority' => 30,
      'type' => 'text-area',
      ))  );
	$wp_customize->add_setting('disable_user_information', array(
      'default' => ''
    ));
  	$wp_customize->add_control('disable_user_information',array(
    'label' => __('Disable User Login Info Right Section','innova'),
    'type' => 'checkbox',
    'section' => 'header_top_bar_section',
    'priority' => 50
  ));
 foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'header_top_bar_section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'top_box_section'); 
// HEADER SETTINGS
function logo_section( $wp_customize ) {
$wp_customize->add_panel('header_settings_panel',array(
'priority'=>20,
'capability'=>'edit_theme_options',
'theme_supports'=>'',
'title'=>__('Header Section','innova'),

'description'=>'',
));
		$wp_customize->add_section(
	// ID
	'header-section',
	// Arguments array
	array(
		'title' => __( 'Header Section', 'innova' ),
		'priority'       =>2,
		'panel'=>'header_settings_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
$wp_customize->add_setting( 'select_Header_bg_type',  array(
        'default' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_Header_bg_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','innova'),
        'section' => 'header-section',
        'choices' => array(
           'bg_type_color' => __('Background Color','innova'),
           'bg_type_image' => __('Background Image','innova'),
          ),
    'priority' => 0,
    ));
// Header Bg Upload Image
$wp_customize->add_setting('upload_header[bg_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'bg_image', array(
        'label'    => __('Header BG Image', 'innova'),
        'section'  => 'header-section',
        'settings' => 'upload_header[bg_image]',
		'priority' => 1
    )));

 $wp_customize->add_setting('backgroundbg_repeat',
	array(
		'deafult' => 'no-repeat',
		));
$wp_customize->add_control('backgroundbg_repeat',
	array(
		'label' => __('Background Repeat','innova'),
		'capability' => 'edit_theme_options', 
		'section' => 'header-section',
		'priority' => 2,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','innova'),
			'repeat' => __('Repeat','innova'),
			)
		));
    $colors[] = array(
		'slug'=>'header_bg_color',
		'section' => 'header-section',
		'default' => '',
		'label' => __('Header Background Color', 'innova'),
		'priority' => 3,
	);
	$wp_customize->add_setting( 'header_top_border', array(
        'default'        => '0',
        'sanitize_callback' => 'check_number'
    ) );
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'header_top_border', array(
        'label'   => __('Header Top border width (px)','innova'),
        'section' => 'header-section',
        'type'    => 'text',
        'priority' =>4,
  'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
$colors[] = array(
		'slug'=>'header_top_border_color',
		'section' => 'header-section',
		'default' => '',
		'label' => __('Header Top border Color', 'innova'),
		'priority' => 5,
	);
	 $wp_customize->add_setting( 'header_padding_top_bottom', array(
        'default'        => '0',
        'sanitize_callback' => 'check_number'
    ) );
 
   $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'header_padding_top_bottom', array(
        'label'   => __('Header padding top & bottom (px)','innova'),
        'section' => 'header-section',
        'type'    => 'text',
 		'priority' => 6,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
  $wp_customize->add_setting( 'header_left_section' );
  $wp_customize->add_control(
    new Kaya_Customize_Subtitle_control( $wp_customize, 'header_left_section', array(
      'label'    => __( 'Header Left Section', 'innova' ),
      'section'  => 'header-section',
      'settings' => 'header_left_section',
      'priority' => 7,
    ))
  );
  $url=get_template_directory_uri();
  $wp_customize->add_setting('kaya_logo[upload_logo]', array(
        'default'           => $url.'/images/logo.png',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'kaya_logo', array(
        'label'    => __('Upload Logo Image', 'innova'),
        'section'  => 'header-section',
        'settings' => 'kaya_logo[upload_logo]',
        'section' => 'header-section',
		'priority' => 8,
    )));

 $wp_customize->add_setting( 'logo_margin_top', array(
        'default'        => '10',
        'sanitize_callback' => 'check_number'
    ) );
 
    $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'logo_margin_top', array(
        'label'   => __('Logo Margin Top (px)','innova'),
        'section' => 'header-section',
        'type'    => 'text',
        'priority' =>9,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
  $wp_customize->add_setting( 'header_right_title' );
  $wp_customize->add_control(
    new Kaya_Customize_Subtitle_control( $wp_customize, 'header_right_title', array(
      'label'    => __( 'Header Right Section', 'innova' ),
      'section'  => 'header-section',
      'settings' => 'header_right_title',
      'priority' => 10,
    ))
  );
  $wp_customize->add_setting( 'header_right_contact_info', array(
  			'default' => '<h3 style="font-size:1.5em;"> CALL NOW: (400) 450-2428</h3>',
  			'sanitize_callback' => 'text_filed_sanitize',
  	));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'header_right_contact_info', array(
      'label'    => __( 'Contact Information', 'innova' ),
      'section'  => 'header-section',
      'settings' => 'header_right_contact_info',
      'priority' => 11,
      'type' => 'text-area',
      ))  );
    $wp_customize->add_setting( 'header_right_content_info' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'header_right_content_info', array(
      'label'    => __( 'Ex:<i class="fa fa-phone" style="background: #f44336;color:#fff;"></i><span><p>Feel Free To Call Us</p><h4>040 (963) 12367</h4></span>', 'innova' ),
      'section'  => 'header-section',
      'settings' => 'header_right_content_info',
      'priority' => 15
    )));
 $wp_customize->add_setting( 'header_right_email_info', array(
  			'default' => '<h3 style="font-size:1.5em;">Email us:kayapati.com</h3>',
  			'sanitize_callback' => 'text_filed_sanitize',
  	));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'header_right_email_info', array(
      'label'    => __( 'Email Information', 'innova' ),
      'section'  => 'header-section',
      'settings' => 'header_right_email_info',
      'priority' => 16,
      'type' => 'text-area',
      )));
   $wp_customize->add_setting( 'header_right_email_info_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'header_right_email_info_note', array(
      'label'    => __( 'Ex:<i class="fa fa-envelope" style="background: #f44336;color:#fff;"></i><span><p>E-Mail Us</p><h4>info@kayapati.com</h4></span>', 'innova' ),
      'section'  => 'header-section',
      'settings' => 'header_right_email_info_note',
      'priority' => 17
    )));
 foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'header-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'logo_section' );
//end
// Menu Section
function menu_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'menu-section',
	// Arguments array
	array(
		'title' => __( 'Menu Section', 'innova' ),
		'priority'       => 3,
		'panel'=>'header_settings_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
   // Menu  Color
	$wp_customize->add_setting('menu_nav_bg_top_curve',
		array(
			'deafult' => '0',
			));
	$wp_customize->add_control('menu_nav_bg_top_curve',
		array(
			'label' => __('Menu bar curve','innova'),
			'capability' => 'edit_theme_options', 
			'section' => 'menu-section',
			'priority' => 1,
			'type' => 'radio',
			'choices' => array(
				'10' => __('True','innova'),
				'0' => __('False','innova'),
				)
			));
	  $colors[] = array(
		'slug'=>'menu_link_color',
		'default' => '#fff',
		'label' => __('Menu Links Color', 'innova'),
		'priority' => 4	
		);

	  $colors[] = array(
		'slug'=>'menu_link_bg_color',
		'default' => '#f44336',
		'label' => __('Menu Links BG Color', 'innova'),
		'priority' =>3
		);

	  $colors[] = array(
		'slug'=>'menu_nav_bg_color',
		'default' => '#485b6e',
		'label' => __('Menu bar BG Color', 'innova'),
		'priority' => 2
		);

	$colors[] = array(
		'slug'=>'menu_link_hover_bg_color',
		'default' => '#d32f2f',
		'label' => __('Menu Links Hover BG color', 'innova'),
		'priority' => 6
		);

	$colors[] = array(
		'slug'=>'menu_link_hover_color',
		'default' => '#fff',
		'label' => __('Menu Links Hover Color', 'innova'),
		'priority' => 5
		);

	$colors[] = array(
		'slug'=>'menu_bg_active_color',
		'default' => '',
		'label' => __('Menu Active BG Color', 'innova'),
		'priority' => 6
	);
	$colors[] = array(
		'slug'=>'menu_link_active_color',
		'priority' => 7,
		'default' => '#fff',
		'label' => __('Menu Active BG Links Color', 'innova'),
	);
// Sub  Menu
	$wp_customize->add_setting( 'child_menu_color_settings' );
	$wp_customize->add_control(
	    new Kaya_Customize_Subtitle_control( $wp_customize, 'child_menu_color_settings', array(
	      'label'    => __( 'Child Menu Color Settings', 'innova' ),
	      'section'  => 'menu-section',
	      'settings' => 'child_menu_color_settings',
	      'priority' => 8
    )));
    $colors[] = array(
	'slug'=>'sub_menu_link_hover_bg_color',
	'default' => '#f0f0f0',
	'label' => __('Child Menu Links Hover BG Color', 'innova'),
	'priority' => 10
);

$colors[] = array(
	'slug'=>'sub_menu_link_color',
	'default' => '',
	'label' => __('Child Menu Links Color', 'innova'),
	'priority' => 11
);
    $colors[] = array(
	'slug'=>'sub_menu_bottom_border_color',
	'default' => '#f0f0f0',
	'label' => __('Child Menu Bottom Border Color', 'innova'),
	'priority' => 12
);

    $colors[] = array(
	'slug'=>'sub_menu_bg_color',
	'default' => '',
	'label' => __('Child Menu BG Color', 'innova'),
	'priority' => 9
);
    $colors[] = array(
	'slug'=>'sub_menu_link_hover_color',
	'default' => '',
	'label' => __('Child Menu Links Hover Color', 'innova'),
	'priority' => 13
); 

    	$colors[] = array(
		'slug'=>'sub_menu_active_bg_color',
		'default' => '#f0f0f0',
		'label' => __('Child Menu Link Active BG Color', 'innova'),
		'priority' => 14
	);
	$colors[] = array(
		'slug'=>'sub_menu_link_active_color',
		'default' => '#fff',
		'label' => __('Child Menu Link Active Color', 'innova'),
		'priority' => 15
	);
	$wp_customize->add_setting(
    'menu_margin_top',
    array(
        'default' => '',
    )
);
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'sanitize_callback' => 'color_filed_sanitize',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'menu-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'menu_section'); // End
//end menu
function mobile_menu_text( $wp_customize ) {
    $wp_customize->add_section(
  // ID
  'mobile_menu_text',
  // Arguments array
  array(
    'title' => __( 'Mobile Menu Go to Text', 'innova' ),
    'priority'       => 3,
    'capability' => 'edit_theme_options',
    'panel'=>'header_settings_panel',
    
  )
);  
  $wp_customize->add_setting( 'mobile_menu_text', array(
      'default' => 'Go to...'
    ));
  $wp_customize->add_control('mobile_menu_text',array(
      'label'    => __( 'Mobile Menu Go to Text', 'innova' ),
      'type' => 'text',
      'section'  => 'mobile_menu_text',
      'settings' => 'mobile_menu_text',
      'priority' => 2,
  )); 
}
add_action( 'customize_register', 'mobile_menu_text' );
// Page color Settings
function page_color_section( $wp_customize ) {
$wp_customize->add_panel('page_color_settings_panel',array(
'priority'=>30,
'capability'=>'edit_theme_options',
'theme_supports'=>'',
'title'=>__('Page Section','innova'),
'description'=>'',
));
		$wp_customize->add_section(
	// ID
	'page-color-section',
	// Arguments array
	array(
		'title' => __( 'Page Titlebar Color Settings', 'innova' ),
		'priority'       => 3,
		'panel'=>'page_color_settings_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
	$wp_customize->add_setting( 'select_pagetitle_bar_bg_type',  array(
        'default' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_pagetitle_bar_bg_type', array(
        'type' => 'select',
        'label' => __('Select Page Titlebar Bg Type','innova'),
        'section' => 'page-color-section',
        'choices' => array(
           'bg_type_color' => __('Background Color','innova'),
           'bg_type_image' => __('Background Image','innova'),
          ),
    'priority' => 0,
    ));
   $url=get_template_directory_uri().'/images/';	
   $wp_customize->add_setting('page_title_bar[bg_img]',array(
    	'default' =>  $url.'titlebar_bg.png',
    	'capability' => 'edit_theme_options',
    	'type' => 'option'
    	));
     $wp_customize->add_control(
    	new WP_Customize_Image_Control($wp_customize,'page_title_bar',array(
    		'label' =>  __('Upload Transparent BG Image','innova'),
    		'section' => 'page-color-section',
    		'settings' => 'page_title_bar[bg_img]',
    		'priority' => 1
    	 	)));

    $wp_customize->add_setting('page_title_bar_bg_repeat',
	array(
		'deafult' => 'repeat',
		));
	$wp_customize->add_control('page_title_bar_bg_repeat',
	array(
		'label' => __('Background Repeat','innova'),
		'capability' => 'edit_theme_options', 
		'section' => 'page-color-section',
		'priority' => 2,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','innova'),
			'repeat' => __('Repeat','innova')
			)
		));	
	$wp_customize->add_setting( 'page_title_bg_color',
		array( 
			'default' => ''
		));
	$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize, 'page_title_bg_color',
		array(
			'label' => __('Background Color','innova'),
			'section' => 'page-color-section',
			'priority' => 3,
			'type' => 'color',
		)));
	$wp_customize->add_setting( 'page_titlebar_title_color',
		array( 
			'default' => '#333333'
		));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize, 'page_titlebar_title_color',
		array(
			'label' => __('Title Color','innova'),
			'section' => 'page-color-section',
			'priority' => 4,
			'type' => 'color',
		)));
		$wp_customize->add_setting( 'page_title_bar_bottom_border', array(
        'default'        => '0',
        'sanitize_callback' => 'check_number'
    ) );
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'page_title_bar_bottom_border', array(
        'label'   => __('Page Titlebar Bottom Border width (px)','innova'),
        'section' => 'page-color-section',
        'type'    => 'text',
        'priority' =>5,
 'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
    $colors[] = array(
		'slug'=>'page_titlebar_border_color',
		'section' => 'page-color-section',
		'default' => '',
		'label' => __('Page Titlebar Bottom Border Color', 'innova'),
		'priority' => 6,
	);
	foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'page-color-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}

}
add_action( 'customize_register', 'page_color_section' );
/*page middle section */
 function page_middile_section_settings( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'page-middle-section',
	// Arguments array
	array(
		'title' => __( 'Page Middle Content Color Settings', 'innova' ),
		'priority'       => 4,
		'panel'=>'page_color_settings_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
    );
	$wp_customize->add_setting( 'select_middle_content_bg_type',  array(
        'default' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_middle_content_bg_type', array(
        'type' => 'select',
        'label' => __('Select Page Middle Content Bg Type','innova'),
        'section' => 'page-middle-section',
        'choices' => array(
           'bg_type_color' => __('Background Color','innova'),
           'bg_type_image' => __('Background Image','innova'),
          ),
    'priority' => 0,
    ));
	 $url=get_template_directory_uri().'/images/';
	  $wp_customize->add_setting('page_content_bg[bg_img]',array(
    	'default' =>  $url.'content_img.png',
    	'capability' => 'edit_theme_options',
    	'type' => 'option'
    	));
     $wp_customize->add_control(
    	new WP_Customize_Image_Control($wp_customize,'page_content_bg',array(
    		'label' =>  __('Upload Transparent BG Image','innova'),
    		'section' => 'page-middle-section',
    		'settings' => 'page_content_bg[bg_img]',
    		'priority' => 6
    	 	)));

    $wp_customize->add_setting('page_content_bg_repeat',
	array(
		'deafult' => 'repeat',
		));
	$wp_customize->add_control('page_content_bg_repeat',
	array(
		'label' => __('Background Repeat','innova'),
		'capability' => 'edit_theme_options', 
		'section' => 'page-middle-section',
		'priority' => 7,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','innova'),
			'repeat' => __('Repeat','innova'),
			)
		));	
    $colors[] = array(
	'slug'=>'page_bg_color',
	'default' => '',
	'label' => __('Background Color', 'innova'),
	'priority' => 8
);

    $colors[] = array(
	'slug'=>'page_titles_color',
	'default' => '#333333',
	'label' => __('Title Color', 'innova'),
	'priority' => 9
);
        $colors[] = array(
	'slug'=>'page_description_color',
	'default' => '#787878',
	'label' => __('Content Color', 'innova'),
	'priority' => 10
);
    $colors[] = array(
	'slug'=>'page_link_color',
	'default' => '#2EA2CC',
	'label' => __('Link Color', 'innova'),
	'priority' => 11
);
 $colors[] = array(
	'slug'=>'page_link_hover_color',
	'default' => '#CC0069',
	'label' => __('Link Hover Color', 'innova'),
	'priority' => 12
);
 foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'page-middle-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
 }
add_action( 'customize_register', 'page_middile_section_settings' );
function sidebar_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'sidebar-section',
	// Arguments array
	array(
		'title' => __( 'Page Sidebar Color Settings', 'innova' ),
		'priority'       => 5,
		'panel'=>'page_color_settings_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
 	$colors[] = array(
		'label' => __('Title Color','innova'),
		'default' => '#333333',
		'priority' => 14	,
		'slug' => 'sidebar_title_color',
		'capability' => 'edit_theme_options'
		);
	$colors[] = array(
			'label' => __('Content Color','innova'),
			'slug' => 'sidebar_content_color',
			'priority' => 15,
			'default' => '#787878',
			'capability' => 'edit_theme_options'
		);
	$colors[] = array(
			'label' => __('Link Color','innova'),
			'slug' => 'sidebar_link_color',
			'priority' => 16,
			'capability' => 'edit_theme_options',
			'default' => '#2EA2CC'
		);
	$colors[] = array(
			'label' => __('Link Hover Color','innova'),
			'slug' => 'sidebar_link_hover_color',
			'default' => '#CC0069',
			'priority' => 17,
			'capability' => 'edit_theme_options'
		);
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'sidebar-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])
		)
	);
}
}
add_action( 'customize_register', 'sidebar_section' );
/* Portfolio Thumbnail Color Settings */
function portfolio_thumbnail_color($wp_customize){
	$wp_customize->add_panel('portfolio_section_panel',array(
  'priority'=>40,
  'capability'=>'edit_theme_options',
  'theme_supports'=>'',
  'title'=>__('Portfolio Section','innova'),
'description'=>'',
  ));
	$wp_customize->add_section('pf_page_section', array(
			'title' => __('Portfolio Section','innova'),
			'priority' => '1',
			'panel'=>'portfolio_section_panel',
			'capability' => 'edit_theme_options',

		));
 $wp_customize->add_setting('pf_category_slug_name', array(
      'default' => 'portfolio-category'
    ));
  $wp_customize->add_control('pf_category_slug_name',array(
    'label' => __('Portfolio Category Slug Name','innova'),
    'input_attrs' => array(
    'placeholder' => __( 'portfolio-category','innova' ),
  ),
    'type' => 'text',
    'section' => 'pf_page_section',
    'priority' => 1
  ));
	  $wp_customize->add_setting('pf_slug_name', array(
      'default' => 'portfolio'
    ));
  $wp_customize->add_control('pf_slug_name',array(
    'label' => __('Portfolio Post Slug Name','innova'),
     'input_attrs' => array(
    'placeholder' => __( 'portfolio','innova' ),
  ),
    'type' => 'text',
    'section' => 'pf_page_section',
    'priority' => 2
  ));
  $wp_customize->add_setting( 'pf_slug_note1' );
  	$wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_slug_note1', array(
      	'html_tags' => true,
       'label'    => __( 'Note-1:Portfolio Post slug name and category slug name should not be same ','innova'),
      'section'  => 'pf_page_section',
      'settings' => 'pf_slug_note1',
      'priority' => 3
    ))
  );
$wp_customize->add_setting( 'pf_slug_note' );
  	$wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_slug_note', array(
      	'html_tags' => true,
       'label'    => __( 'Note-2:Please make sure that the permalinks to be updated by navigating to "Settings > Permalinks" select post and save changes to avoid 404 error page. For more information  ','innova') . '<a target="_blank" href="https://youtu.be/KZR0JT9LhBE"> Watch this Video </a>',
      'section'  => 'pf_page_section',
      'settings' => 'pf_slug_note',
      'priority' => 3
    ))
  );
  	 $wp_customize->add_setting('enable_prettyphoto_socialicons', array(
      'default' => '',
      
    ));
  $wp_customize->add_control('enable_prettyphoto_socialicons',array(
    'label' => __('Enable Pretty Photo Social Icons','gilda'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 4
  ));
      $wp_customize->add_setting('disable_prettyphoto_thumbnails', array(
      'default' => '',
      
    ));
  $wp_customize->add_control('disable_prettyphoto_thumbnails',array(
    'label' => __('Disable Pretty Photo Thumbnails','gilda'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 5
  ));
   $wp_customize->add_setting('disable_prettyphoto_post_title', array(
      'default' => '',
      
    ));
  $wp_customize->add_control('disable_prettyphoto_post_title',array(
    'label' => __('Enable Pretty Photo Title','gilda'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 6
  ));
 }
add_action( 'customize_register', 'portfolio_thumbnail_color' );

/* Portfolio Categories Settings */
   function portfolio_categories_settings( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'category-settings',
	// Arguments array
	array(
		'title' => __( 'Portfolio Category Settings', 'innova' ),
		'priority'       => 3,
		'panel'=>'portfolio_section_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
    $wp_customize->add_setting( 'pf_category_menu_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_category_menu_note', array(
      'label'    => __( 'Note: Use this section when you use Portfolio Categories in menu bar', 'innova' ),
      'section'  => 'category-settings',
      'settings' => 'pf_category_menu_note',
      'priority' => 4
    ))
  );
    $wp_customize->add_setting('pf_page_sidebar', array(
			'default' => 'fullwidth'
		));
    	$wp_customize->add_control('pf_page_sidebar',array(
		'label' => __('Category Page Layout','innova'),
		'type' => 'radio',
		'section' => 'category-settings',
		'choices' => array(
			'fullwidth' => __('No Sidebar','innova'),
			'two_third' => __('Right','innova'),
			'two_third_last' => __('Left','innova')
			),
		'priority' => 5
	));
	$wp_customize->add_setting( 'pf_category_page_sidebar',
    array(
        'default' => '',
        'sanitize_callback' => 'text_filed_sanitize'
    ));
	$wp_customize->add_control(  new Kaya_Customize_Sidebar_Control( 
      $wp_customize, 'pf_category_page_sidebar', array(
      'label'    => __( 'Select Sidebar', 'innova' ),
      'section'  => 'category-settings',
      'settings' => 'pf_category_page_sidebar',
      'priority' => 6,
    )));
    $wp_customize->add_setting(
    'pf_thumbnail_columns',
    array(
        'default' => '4',
    ));
    $wp_customize->add_control(
    'pf_thumbnail_columns',
    array(
        'type' => 'select',
        'label' => __('Select Columns','innova'),
        'section' => 'category-settings',
        'choices' => array(
        	 '4' => __('4 Columns','innova'),
        	 '3' => __('3 Columns','innova'),
        	'2' => __('2 Columns','innova'),
        	),
		'priority' => 6,
    )
);
$wp_customize->add_setting('pf_images_height', array(
			'default' => '400',
			'sanitize_callback' => 'check_number'
		));
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'pf_images_height', array(
		'label' => __('Thumbnail Height','innova'),
		'type' => 'text',
		'section' => 'category-settings',
		'priority' => 7,
	'choices'  => array(
        'min'  => 100,
        'max'  => 500,
        'step' => 1
    ),
    )));
	 $wp_customize->add_setting('pf_enable_title', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_enable_title',array(
    'label' => __('Disable Portfolio Posts Title','innova'),
    'type' => 'checkbox',
    'section' => 'category-settings',
    'priority' => 8
  ));
  $wp_customize->add_setting('pf_enable_category', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_enable_category',array(
    'label' => __('Disable Portfolio Category Title','innova'),
    'type' => 'checkbox',
    'section' => 'category-settings',
    'priority' => 9
  ));
  }
add_action( 'customize_register', 'portfolio_categories_settings' );
/*Related Post Settings */
function related_post_settings( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'related-post-settings',
	// Arguments array
	array(
		'title' => __( 'Related Posts Settings', 'innova' ),
		'priority'       => 5,
		'panel'=>'portfolio_section_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
 $wp_customize->add_setting('pf_related_post_title', array(
			'default' => 'Related Post'
		));
	$wp_customize->add_control('pf_related_post_title',array(
		'label' => __('Related Post Title','innova'),
		'type' => 'text',
		'section' => 'related-post-settings',
		'priority' => 11
	));
	$wp_customize->add_setting('pf_related_images_height', array(
      'default' => '400',
      'sanitize_callback' => 'check_number'
    ));
  $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'pf_related_images_height', array(
    'label' => __('Related Post Thumbnail Height','innova'),
    'type' => 'text',
    'section' => 'related-post-settings',
    'priority' => 12,
 'choices'  => array(
        'min'  => 100,
        'max'  => 500,
        'step' => 1
    ),
    )));
     $wp_customize->add_setting('pf_enable_related_posts_title', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_enable_related_posts_title',array(
    'label' => __('Disable Related Post Title','innova'),
    'type' => 'checkbox',
    'section' => 'related-post-settings',
    'priority' => 13
  ));
  $wp_customize->add_setting('pf_enable_related_posts_category', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_enable_related_posts_category',array(
    'label' => __('Disable Related Post Category','innova'),
    'type' => 'checkbox',
    'section' => 'related-post-settings',
    'priority' => 14
  ));
   /*
   $wp_customize->add_setting( 'pf_single_page_slider' );
  $wp_customize->add_control(
      new Kaya_Customize_Subtitle_control( $wp_customize, 'pf_single_page_slider', array(
        'label'    => __( 'Portfolio Single Page Slider Settings', 'innova' ),
        'section'  => 'related-post-settings',
        'settings' => 'pf_single_page_slider',
        'priority' => 15
    )));
	$wp_customize->add_setting('disable_pf_single_page_slider_arrow_buttons', array(
      'default' => ''
    ));
	$wp_customize->add_control('disable_pf_single_page_slider_arrow_buttons',array(
    'label' => __('Disable Slider Arrow Buttons','innova'),
    'type' => 'checkbox',
    'section' => 'related-post-settings',
    'priority' => 16
  ));
	$wp_customize->add_setting('disable_pf_single_page_slider_dotos_buttons', array(
      'default' => ''
    ));
	$wp_customize->add_control('disable_pf_single_page_slider_dotos_buttons',array(
    'label' => __('Disable Slider Dots Buttons','innova'),
    'type' => 'checkbox',
    'section' => 'related-post-settings',
    'priority' => 17
  ));
	$wp_customize->add_setting('pf_single_page_slider_auto_play', array(
      'default' => ''
    ));
  	$wp_customize->add_control('pf_single_page_slider_auto_play',array(
    'label' => __('Enable Slider Auto Play','innova'),
    'type' => 'checkbox',
    'section' => 'related-post-settings',
    'priority' => 18
  ));
  */
}
add_action('customize_register','related_post_settings');

/* Blog Page Section */
/* Sidebar */
/*function sidebar_section( $wp_customize ){
	$wp_customize->add_section(
		'sidebar-section',
		array(
		'title' => 'Sidebar Color Settings',
		'capability' => 'edit_theme_options',
		//'description' => '',
		'priority' => 10	
			)
		);
	$colors=array();

	$colors[] = array(
			'label' => __('Sidebar Background Color','innova'),
			'slug' => 'sidebar_bg_color',
			'priority' => 0,
			'default' => '#ffffff',
			'capability' => 'edit_theme_options'
		);

	$colors[] = array(
		'label' => 'Sidebar Title Color',
		'default' => '#363636',
		'priority' => 1	,
		'slug' => 'sidebar_title_color',
		'capability' => 'edit_theme_options'
		);

	$colors[] = array(
			'label' => __('Sidebar Content Color','innova'),
			'slug' => 'sidebar_content_color',
			'priority' => 2,
			'default' => '#787878',
			'capability' => 'edit_theme_options'
		);
	$colors[] = array(
			'label' => __('Sidebar Link Color','innova'),
			'slug' => 'sidebar_link_color',
			'priority' => 3,
			'capability' => 'edit_theme_options',
			'default' => '#555555'
		);
	$colors[] = array(
			'label' => __('Sidebar Link Hover Color','innova'),
			'slug' => 'sidebar_link_hover_color',
			'default' => '#f44336 ',
			'priority' => 4,
			'capability' => 'edit_theme_options'
		);
	foreach ($colors as $color) {
		$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'sidebar-section',
			'settings' => $color['slug'])

		)
	);
	}
}
add_action('customize_register','sidebar_section');
//end */
/*-----------------------------------------------------------------------------------*/
// Woo Commerce Page
/*-----------------------------------------------------------------------------------*/ 
function woocommerce_page_section( $wp_customize ){
	$wp_customize->add_panel('woocommerce_page_section_panel',array(
	'priority'=>90,
	'capability'=>'edit_theme_options',
	'theme_supports'=>'',
	'title'=>__('Woocommerce Page Section','innova'),
	'description'=>'',
	));
	// Blog Page Categories
	$wp_customize->add_section('woocommerce_page_section',array(
			'title' => __('Woocommerce Page Section','innova'),
			'panel'=>'woocommerce_page_section_panel',
			'priority' => '1'
		));
	$wp_customize->add_setting('shop_page_sidebar', array(
			'default' => 'fullwidth'
		));
	$wp_customize->add_control('shop_page_sidebar',array(
		'label' => __('Shop Page Sidebar','innova'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','innova'),
			'two_third' => __('Right','innova'),
			'two_third_last' => __('Left','innova')
			),
		'priority' => 1
	));
		$wp_customize->add_setting('product_tag_page_sidebar', array(
			'default' => 'fullwidth'
		));
	$wp_customize->add_control('product_tag_page_sidebar',array(
		'label' => __('Product Categories / Tags  Page Sidebar','innova'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','innova'),
			'two_third' => __('Right','innova'),
			'two_third_last' => __('Left','innova')
			),
		'priority' => 2
	));
	$wp_customize->add_setting('shop_single_page_sidebar', array(
			'default' => 'two_third'
		));
	$wp_customize->add_control('shop_single_page_sidebar',array(
		'label' => __('Shop Single Page Sidebar','innova'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','innova'),
			'two_third' => __('Right','innova'),
			'two_third_last' => __('Left','innova')
			),
		'priority' => 3
	));
	}
add_action('customize_register','woocommerce_page_section');
 /* Buttons Colors */
  function primary_buttons_color_settings( $wp_customize ){
	$wp_customize->add_section('primary_buttons_color_settings',array(
			'title' => __('Primary Button Color Settings','innova'),
			'panel'=>'woocommerce_page_section_panel',
			'priority' => '2'
		));
$wp_customize->add_setting( 'woo-buttons-note_description' );
$wp_customize->add_control(
new Kaya_Customize_Description_Control( 
  $wp_customize, 'woo-buttons-note_description', array(
  'label'    => __( 'Note: Color applies for Add to cart, Update Cart , mini cart items and  Apply Coupon buttons', 'innova' ),
  'section'  => 'primary_buttons_color_settings',
  'settings' => 'pf_category_menu_note',
  'priority' => 4
)));
 $color = array();   
$colors[] = array(
  'slug'=>'primary_buttons_bg_color',
  'default' => '#434a54',
   'transport'   => 'refresh',
   'priority' => 5,
  'label' => __('Primary  Buttons BG Color', 'innova')
);
$colors[] = array(
  'slug'=>'primary_buttons_text_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
  'label' => __('Primary  Buttons Text Color', 'innova'),
  'priority' => 6
);
$colors[] = array(
  'slug'=>'primary_buttons_bg_hover_color',
  'default' => '#f44336',
   'transport'   => 'refresh',
   'priority' => 7,
  'label' => __('Primary Buttons BG Hover Color', 'innova')
);
$colors[] = array(
  'slug'=>'primary_buttons_text_hover_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
   'priority' => 8,
  'label' => __('Primary  Buttons Text Hover Color', 'innova')
);
 foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'primary_buttons_color_settings',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','primary_buttons_color_settings');
// Secondary Buttons */
function secondary_buttons_color_settings( $wp_customize ){
	$wp_customize->add_section('secondary_buttons_color_settings',array(
			'title' => __('Secondary Button Color Settings','innova'),
			'panel'=>'woocommerce_page_section_panel',
			'priority' => '3'
		));
$wp_customize->add_setting( 'woo-secondary-buttons-note_description' );
$wp_customize->add_control(
new Kaya_Customize_Description_Control( 
  $wp_customize, 'woo-secondary-buttons-note_description', array(
  'label'    => __( 'Note: Color applies for Tabs active color, tab hover color, quantity(plus, minus), view Cart, proceed to checkout and place order buttons', 'innova' ),
  'section'  => 'secondary_buttons_color_settings',
  'settings' => 'woo-secondary-buttons-note_description',
  'priority' => 10
)));
 $color = array();   
$colors[] = array(
  'slug'=>'secondary_buttons_bg_color',
  'default' => '#f44336',
   'transport'   => 'refresh',
   'priority' => 11,
  'label' => __('Secondary Buttons BG Color', 'innova')
);
$colors[] = array(
  'slug'=>'secondary_buttons_text_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
  'label' => __('Secondary Buttons Text Color', 'innova'),
  'priority' => 11
);
$colors[] = array(
  'slug'=>'secondary_buttons_bg_hover_color',
  'default' => '#434a54',
   'transport'   => 'refresh',
   'priority' => 12,
  'label' => __('Secondary Buttons BG Hover Color', 'innova')
);
$colors[] = array(
  'slug'=>'secondary_buttons_text_hover_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
   'priority' => 13,
  'label' => __('Secondary Buttons Text Hover Color', 'innova')
);
// Price tag Hover Color 
  $colors[] = array(
  'slug'=>'woo_elments_colors',
  'default' => '#f44336',
   'transport'   => 'refresh',
   'priority' => 14,
  'label' => __('Elements color', 'innova')
);
    $wp_customize->add_setting( 'elements_color_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'elements_color_note', array(
      'label'    => __( 'Note: color applied for price, onsale tag, star-rating, .quantity .minus / plus hover and etc...', 'innova' ),
      'section'  => 'secondary_buttons_color_settings',
      'settings' => 'elements_color_note',
      'priority' => 15
    )));
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'secondary_buttons_color_settings',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
    }
add_action('customize_register','secondary_buttons_color_settings');
 // Alert Boxes */
function alertbox_color_settings( $wp_customize ){
	$wp_customize->add_section('alertbox_color_settings',array(
			'title' => __('Alert Boxes Color Settings','innova'),
			'panel'=>'woocommerce_page_section_panel',
			'priority' => '4'
		));
$colors[] = array(
  'slug'=>'success_msg_bg_color',
  'default' => '#dff0d8',
   'transport'   => 'refresh',
   'priority' => 17,
  'label' => __('Success Alert Box BG Color', 'innova')
);
$colors[] = array(
  'slug'=>'success_msg_text_color',
  'default' => '#468847',
   'transport'   => 'refresh',
   'priority' => 18,
  'label' => __('Success Alert Box Text Color', 'innova')
);

$colors[] = array(
  'slug'=>'notification_msg_bg_color',
  'default' => '#b8deff',
   'transport'   => 'refresh',
   'priority' => 19,
  'label' => __('Notification Alert Box BG Color', 'innova')
);
$colors[] = array(
  'slug'=>'notification_msg_text_color',
  'default' => '#333',
   'transport'   => 'refresh',
   'priority' => 20,
  'label' => __('Notification Alert Box Text Color', 'innova')
);

$colors[] = array(
  'slug'=>'warning_msg_bg_color',
  'default' => '#f2dede',
   'transport'   => 'refresh',
   'priority' => 21,
  'label' => __('Warning Alert Box BG Color', 'innova')
); 
$colors[] = array(
  'slug'=>'warning_msg_text_color',
  'default' => '#a94442',
   'transport'   => 'refresh',
   'priority' => 22,
  'label' => __('Warning Alert Box Text Color', 'innova')
);  
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'alertbox_color_settings',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','alertbox_color_settings');
//end
// Typography
function typography( $wp_customize ){
	$wp_customize->add_panel('typography_section_panel',array(
'priority'=>55,
'capability'=>'edit_theme_options',
'theme_supports'=>'',
'title'=>__('Typography','innova'),
'description'=>'',
));
	$wp_customize->add_section(
	// ID
	'typography_section',
	// Arguments array
	array(
		'title' => __( 'Google Font Family', 'innova' ),
		'priority'       => 11,
		'panel'=>'typography_section_panel',
		'capability' => 'edit_theme_options',
		'description' => __( 'Select Google Fonts', 'innova' )."<a href='http://www.google.com/fonts' target='_blank' > here </a>"
	)
);	

$wp_customize->add_setting( 'google_body_font',
    array( 'default' => '2',
    	'transport' => '',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'google_body_font', array(
		'label'   => __('Select font for Body','innova'),
		'section' => 'typography_section',
		'settings'    => 'google_body_font',
		'priority'    => 0,
	)));
 $wp_customize->add_setting( 'google_heading_font',
    array( 'default' => '2',
    	'transport' => '',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
 $wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'google_heading_font', array(
		 'label'   => __('Select font for Headings','innova'),
		'section' => 'typography_section',
		'settings'    => 'google_heading_font',
		'priority'    =>1,
		)));

$wp_customize->add_setting( 'google_menu_font',
    array( 'default' => '2',
    	'transport' => '',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'google_menu_font', array(
		 'label'   => __('Select font for Top Menu','innova'),
		'section' => 'typography_section',
		'settings'    => 'google_menu_font',
		'priority'    => 2,
))); 
	}
add_action( 'customize_register', 'typography' );
  function typography_font_sizes( $wp_customize ){
		$wp_customize->add_section(
	// ID
	'font_sizes_section',
	// Arguments array
	array(
		'title' => __( 'Font Settings', 'innova' ),
		'priority'       => 15,
		'capability' => 'edit_theme_options',
		'panel' => 'typography_section_panel',
	)
);	
// Body Font Size
	$wp_customize->add_setting( 'body_font_settings' );
	$wp_customize->add_control(
	    new Kaya_Customize_Subtitle_control( $wp_customize, 'body_font_settings', array(
	      'label'    => __( 'Body Font Settings', 'innova' ),
	      'section'  => 'font_sizes_section',
	      'settings' => 'body_font_settings',
	      'priority' => 10
    )));
$wp_customize->add_setting(
    'body_font_size',
    array(
        'default' => '15',
        'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'body_font_size', array(
        'type' => 'select',
        'label' => 'Body Font Size',
        'section' => 'font_sizes_section',
		'priority' => 20,
    'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'body_line_height',
    array(
        'default' => '24',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'body_line_height', array(
        'type' => 'select',
        'label' => 'Body Line Height',
        'section' => 'font_sizes_section',
		'priority' => 25,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'body_font_letter_spacing',
    array(
        'default' => '0',
        'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'body_font_letter_spacing', array(
        'type' => 'text',
        'label' => 'Body Font Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 30,
      'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// Menu Font Size
$wp_customize->add_setting( 'menu_font_settings' );
	$wp_customize->add_control(
	    new Kaya_Customize_Subtitle_control( $wp_customize, 'menu_font_settings', array(
	      'label'    => __( 'Menu Font Settings', 'innova' ),
	      'section'  => 'font_sizes_section',
	      'settings' => 'menu_font_settings',
	      'priority' => 40
    )));
$wp_customize->add_setting(
    'menu_font_size',
    array(
        'default' => '15',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'menu_font_size', array(
        'type' => 'select',
        'label' => 'Menu  Font Size',
        'section' => 'font_sizes_section',
		'priority' => 50,
    'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'menu_line_height',
    array(
        'default' => '15',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'menu_line_height', array(
        'type' => 'select',
        'label' => 'Menu Line Height',
        'section' => 'font_sizes_section',
		'priority' => 55,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'menu_font_letter_spacing',
    array(
        'default' => '1',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'menu_font_letter_spacing', array(
        'type' => 'select',
        'type' => 'text',
        'label' => 'Menu Font Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 60,
   'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// Title Font Sizes
// H1
$wp_customize->add_setting( 'Header_tags_font_settings' );
	$wp_customize->add_control(
	    new Kaya_Customize_Subtitle_control( $wp_customize, 'Header_tags_font_settings', array(
	      'label'    => __( 'Header Tags Font Settings', 'innova' ),
	      'section'  => 'font_sizes_section',
	      'settings' => 'Header_tags_font_settings',
	      'priority' => 70
    )));
$wp_customize->add_setting(
    'h1_title_fontsize',
    array(
        'default' => '30',
         'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h1_title_fontsize', array(
        'type' => 'select',
        'label' => 'Font size for heading - H1',
        'section' => 'font_sizes_section',
		'priority' => 80,
	'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h1_line_height',
    array(
        'default' => '40',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h1_line_height', array(
        'type' => 'select',
        'label' => 'H1 Line Height',
        'section' => 'font_sizes_section',
		'priority' => 85,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h1_letter_spacing',
    array(
        'default' => '',
        'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h1_letter_spacing', array(
        'type' => 'text',
        'label' => 'H1 Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 90,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// H2
$wp_customize->add_setting(
    'h2_title_fontsize',
    array(
        'default' => '22',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h2_title_fontsize', array(
        'type' => 'select',
        'label' => 'Font size for heading - H2',
        'section' => 'font_sizes_section',
		'priority' => 100,
     'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h2_line_height',
    array(
        'default' => '42',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h2_line_height', array(
        'type' => 'select',
        'label' => 'H2 Line Height',
        'section' => 'font_sizes_section',
		'priority' => 105,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h2_letter_spacing',
    array(
        'default' => '',
        'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h2_letter_spacing', array(
        'type' => 'text',
        'label' => 'H2 Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 110,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// H3
$wp_customize->add_setting(
    'h3_title_fontsize',
    array(
        'default' => '19',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h3_title_fontsize', array(
        'type' => 'select',
        'label' => 'Font size for heading - H3',
        'section' => 'font_sizes_section',
		'priority' => 120,
    'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h3_line_height',
    array(
        'default' => '30',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h3_line_height', array(
        'type' => 'select',
        'label' => 'H3 Line Height',
        'section' => 'font_sizes_section',
		'priority' => 125,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h3_letter_spacing',
    array(
        'default' => '',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h3_letter_spacing', array(
        'type' => 'text',
        'label' => 'H3 Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 130,
   'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// H4
$wp_customize->add_setting(
    'h4_title_fontsize',
    array(
        'default' => '18',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h4_title_fontsize', array(
        'type' => 'select',
        'label' => 'Font size for heading - H4',
        'section' => 'font_sizes_section',
		'priority' => 140,
   'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h4_line_height',
    array(
        'default' => '24',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h4_line_height', array(
        'type' => 'select',
        'label' => 'H4 Line Height',
        'section' => 'font_sizes_section',
		'priority' => 145,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h4_letter_spacing',
    array(
        'default' => '',
         'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h4_letter_spacing', array(
        'type' => 'text',
        'label' => 'H4 Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 150,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// H5
$wp_customize->add_setting(
    'h5_title_fontsize',
    array(
        'default' => '16',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h5_title_fontsize', array(
        'type' => 'select',
        'label' => 'Font size for heading - H5',
        'section' => 'font_sizes_section',
		'priority' => 160,
 'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h5_line_height',
    array(
        'default' => '22',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h5_line_height', array(
        'type' => 'select',
        'label' => 'H5 Line Height',
        'section' => 'font_sizes_section',
		'priority' => 165,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h5_letter_spacing',
    array(
        'default' => '',
        'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h5_letter_spacing', array(
        'type' => 'text',
        'label' => 'H5 Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 170,
  'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
// H6
$wp_customize->add_setting(
    'h6_title_fontsize',
    array(
        'default' => '14',
        'sanitize_callback' => 'check_number'
    )
);
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h6_title_fontsize', array(
        'type' => 'select',
        'label' => 'Font size for heading - H6',
        'section' => 'font_sizes_section',
		'priority' =>180,
    'choices'  => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h6_line_height',
    array(
        'default' => '19',
        'sanitize_callback' => 'check_number'
    ));
$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h6_line_height', array(
        'type' => 'select',
        'label' => 'H6 Line Height',
        'section' => 'font_sizes_section',
		'priority' => 185,
    'choices'  => array(
        'min'  => 0,
        'max'  => 150,
        'step' => 1
    ),
    )));
$wp_customize->add_setting(
    'h6_letter_spacing',
    array(
        'default' => '',
         'sanitize_callback' => 'check_number'
    )
);

$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h6_letter_spacing', array(
        'type' => 'text',
        'label' => 'H6 Letter Spacing',
        'section' => 'font_sizes_section',
		'priority' => 190,
    'choices'  => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1
    ),
    )));
}
add_action( 'customize_register', 'typography_font_sizes' );
// Footer  Settings
function footer_section( $wp_customize ) {
  $wp_customize->add_panel('footer_section_panel',array(
  'priority'=>50,
  'capability'=>'edit_theme_options',
  'theme_supports'=>'',
  'title'=>__('Footer Section','innova'),
  'description'=>'',
));
		$wp_customize->add_section(
	// ID
	'footer-section',
	// Arguments array
	array(
		'title' => __( 'Footer Section', 'innova' ),
		'priority'       => 8,
		'panel'=>'footer_section_panel',
		'capability' => 'edit_theme_options',
	));
$wp_customize->add_setting( 'select_footer_type',  array(
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_footer_type', array(
        'type' => 'select',
        'label' => __('Select Footer Type','innova'),
        'section' => 'footer-section',
        'choices' => array(
        	 'widget_based_footer' => __('Widget Based Footer','innova'),
        	 'page_based_footer' => __('Page Based Footer','innova'),
        	),
		'priority' => 1,
    ));
    	$wp_customize->add_setting( 'widget_based_footer_video', array(
      'sanitize_callback' => 'text_filed_sanitize',
    ));
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'widget_based_footer_video', array(
      	'html_tags' => true,
      'label'    => __( 'To Know How to Create Widget Based Footer ','innova') . '<a target="_blank" href="https://youtu.be/X0zyPAtXWVw"> Watch this Video </a>',
      'section'  => 'footer-section',
      'settings' => 'widget_based_footer_video',
      'priority' => 1
    )));
    $wp_customize->add_setting( 'page_based_footer_video', array(
      'sanitize_callback' => 'text_filed_sanitize',
    ));
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'page_based_footer_video', array(
      'html_tags' => true,
      'label'    => __( 'To Know How to Create Page Based Footer ','innova') . '<a target="_blank" href="https://youtu.be/zhNq1TfP5qk"> Watch this Video </a>',
      'section'  => 'footer-section',
      'settings' => 'page_based_footer_video',
      'priority' => 1
    )));
    $wp_customize->add_setting( 'footer_page_id', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    	'default' => '',
    	));
    $wp_customize->add_control(  new Kaya_Customize_Page_Control( 
      $wp_customize, 'footer_page_id', array(
      'label'    => __( 'Select Page Footer', 'innova' ),
      'section'  => 'footer-section',
      'settings' => 'footer_page_id',
      'priority' => 1,
    )));
     $wp_customize->add_setting('main_footer_columns',
	array(
		'deafult' => '3',
		));
     $src = get_template_directory_uri() . '/images/footer_columns/';
$wp_customize->add_control(
new Kaya_Customize_Images_Radio_Control(
$wp_customize,'main_footer_columns',
	array(
		'label' => __('Display Columns','innova'),
		'section' => 'footer-section',
		'priority' => 3,
			'type' => 'img_radio', // Image radio replacement
			'choices' => array(
				'1' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'fc1.png' ),
				'2' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'fc2.png' ),
				'3' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'fc3.png' ),
				'4' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'fc4.png' ),
				'5' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'fc5.png' ),
				'twothird' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'two_third_one_third.png' ),
				'onethird' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'one_third_two_third.png' ),
				'threefourth' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'three_fourth_one_fourth.png' ),
				'onefourth' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'one_fourth_three_fourth.png' ),
				'halffourth' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'two_fourth_fourth_fourth.png' ),
				'twofourth' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'fourth_fourth_two_fourth.png' ),
				'fifth_fifth' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'fifth_fifth_three_fifth.png' ),
				'three_fifth' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'three_fifth_fifth_fifth.png' ),
				'fifth_fifth_fifth' => array( 'label' => __( 'Col-2', 'innova' ),'img_src' => $src . 'fifth_fifth_fifth_two_fifth.png' ),
				'two_fifth' => array( 'label' => __( 'Col-1', 'innova' ),'img_src' => $src . 'two_fifth_fifth_fifth_fifth.png' ),
			),	
		)));
     $wp_customize->add_setting( 'select_footer_bg_type',  array(
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_footer_bg_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','interia'),
        'section' => 'footer-section',
        'choices' => array(
           'bg_type_color' => __('Background Color','interia'),
           'bg_type_image' => __('Background Image','interia'),
          ),
    'priority' => 4,
    ));
	$url=get_template_directory_uri().'/images/';
     $wp_customize->add_setting('footerbg[footer]',array(
    	'default' =>  $url.'top-opc.png',
    	'capability' => 'edit_theme_options',
    	'type' => 'option'
    	));
    $wp_customize->add_control(
    	new WP_Customize_Image_Control($wp_customize,'footer',array(
    		'label' =>  __('Upload Footer Background Image','innova'),
    		'section' => 'footer-section',
    		'settings' => 'footerbg[footer]',
    		'priority' => 5
    	 	)));
    $wp_customize->add_setting('footerbg_repeat',
	array(
		'deafult' => 'no-repeat',
		));
   $wp_customize->add_control('footerbg_repeat',
	array(
		'label' => __('Background Repeat','innova'),
		'capability' => 'edit_theme_options', 
		'section' => 'footer-section',
		'priority' => 6,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','innova'),
			'repeat' => __('Repeat','innova')
			)
		));

   // Footer BG Color
    $colors[] = array(
	'slug'=>'footer_bg_color',
	'default' => '',
	'label' => __('Footer Background Color', 'innova'),
	'priority' => 7
);
    $colors[] = array(
	'slug'=>'footer_title_color',
	'default' => '#ffffff',
	'label' => __('Titles Color', 'innova'),
	'priority' => 8
);
    $colors[] = array(
	'slug'=>'footer_text_color',
	'default' => '#ffffff',
	'label' => __('Content Color', 'innova'),
	'priority' =>9
);
    $colors[] = array(
	'slug'=>'footer_link_color',
	'default' => '#ffffff',
	'label' => __('Hyper Link Color', 'innova'),
	'priority' => 10
);
    $colors[] = array(
	'slug'=>'footer_link_hover_color',
	'default' => '#eee',
	'label' => __('Hyper Link Hover Color', 'innova'),
	'priority' => 11
);
 $wp_customize->add_setting( 'main_footer_disable' );
	$wp_customize->add_control( 'main_footer_disable', array(
	      'label'    => __( 'Disable Main Footer', 'innova' ),
	      'section'  => 'footer-section',
	      'settings' => 'main_footer_disable',
	      'type' => 'checkbox',
	      'priority' => 0
    ));
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'footer-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'footer_section' );

function most_footer_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'most-footer-section',
	// Arguments array
	array(
		'title' => __( 'Most Footer Section', 'innova' ),
		'priority'       => 8,
		'panel'=>'footer_section_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	)
);
 $wp_customize->add_setting( 'most_footer_disable' );
	$wp_customize->add_control( 'most_footer_disable', array(
	      'label'    => __( 'Disable Footer', 'innova' ),
	      'section'  => 'most-footer-section',
	      'settings' => 'most_footer_disable',
	      'type' => 'checkbox',
	      'priority' => 12
    ));
  
  $wp_customize->add_setting( 'footer_col2_section',
  	array(
  		'default' => __('Copy rights &copy; kayapati.com','innova'),
  		'sanitize_callback' => 'text_filed_sanitize',
  		)
  	);
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'footer_col2_section', array(
      'label'    => __( 'Copy Rights', 'innova' ),
      'section'  => 'most-footer-section',
      'settings' => 'footer_col2_section',
      'priority' => 14,
      'type' => 'text-area',
      ))  );
  $wp_customize->add_setting( 'footer_col3_section' ,
  	array(
  		'default' => '<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-rss"></i></a>
					<a href="#"><i class="fa fa-youtube"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>',
					'sanitize_callback' => 'text_filed_sanitize',
  		) );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'footer_col3_section', array(
      'label'    => __( 'Social Icons', 'innova' ),
      'section'  => 'most-footer-section',
      'settings' => 'footer_col3_section',
      'priority' => 15,
      'type' => 'text-area',
      ))  );
      $colors[] = array(
	'slug'=>'footer_bottom_text_color',
	'default' => '#595959',
	'label' => __('Text Color', 'innova'),
	'priority' =>16
);
    $colors[] = array(
	'slug'=>'footer_bottom_link_color',
	'default' => '#f44336',
	'label' => __('Hyper Link Color', 'innova'),
	'priority' => 17
);
    $colors[] = array(
	'slug'=>'footer_bottom_link_hover_color',
	'default' => '#333333',
	'label' => __('Hyper Link Hover Color', 'innova'),
	'priority' => 18
);
foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'most-footer-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'most_footer_section' );
//end
// Global Section
function global_section( $wp_customize ) {
   $wp_customize->add_panel('global_section_panel',array(
  'priority'=>60,
  'capability'=>'edit_theme_options',
  'theme_supports'=>'',
  'title'=>__('Global Settings','innova'),
  'description'=>'',
   ));
		$wp_customize->add_section(
	// ID
	'global-section',
	// Arguments array
	array(
		'title' => __( 'General Settings', 'innova' ),
		'priority'       => 9,
		'panel'=>'global_section_panel',
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'innova' )
	));
	$wp_customize->add_setting('middle_content_padding',
    array(
        'default' => '',
        'sanitize_callback' => 'check_number'
    ));

    $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'middle_content_padding', array(
        'label' => __('Midcontainer Top&Bottom Padding','cooks'),
        'section' => 'global-section',
        'type' => 'text',
		'priority' => 2,
    'choices'  => array(
        'min'  => 0,
        'max'  => 500,
        'step' => 1
    ),
    )));
	$wp_customize->add_setting('favicon[favi_img]',array(
    	'default' => '',
    	 'capability'   => 'edit_theme_options',
        'type'       => 'option',
    	));
    $wp_customize->add_control(
    	new WP_Customize_Image_Control($wp_customize,'favicon',array(
    		'label' => __('Upload Favicon Image','innova'),
    		//'default' =>  
    		'section' => 'global-section',
    		'settings' => 'favicon[favi_img]',
    		'priority' => 1
    	 	)));		
  $wp_customize->add_setting( 'google_tracking_code', array(
  		'default' => '',
  		'sanitize_callback' => 'text_filed_sanitize',
  	));
  $wp_customize->add_control('google_tracking_code', array(
      'label'    => __( 'Google Analytics Code', 'innova' ),
      'section'  => 'global-section',
      'settings' => 'google_tracking_code',
      'priority' => 2,
      'type' => 'text-area',
      ));
	 $wp_customize->add_setting( 'google_tracking_code_link', array(
  		'sanitize_callback' => 'text_filed_sanitize',
  	));
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'google_tracking_code_link', array(
      //'label'    => __( 'Ex:') .' UA-XXXXX-X',
      'html_tags' => true,
    'label'    => __( 'For more information ', 'innova' ) . '<a target="_blank" href="http://kayapati.com/demos/petcare/wp-content/uploads/sites/71/2015/12/trackingcode.jpg">Click Here</a>',
      'section'  => 'global-section',
      'settings' => 'google_tracking_code_link',
      'priority' => 2
    )));
  $wp_customize->add_setting( 'kaya_custom_css' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'kaya_custom_css', array(
      'label'    => __( 'Custom CSS', 'innova' ),
      'section'  => 'global-section',
      'settings' => 'kaya_custom_css',
      'priority' => 3,
      'type' => 'text-area',
      ))  );

  $wp_customize->add_setting( 'kaya_custom_jquery' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'kaya_custom_jquery', array(
      'label'    => __( 'Custom JQUERY', 'innova' ),
      'section'  => 'global-section',
      'settings' => 'kaya_custom_jquery',
      'priority' => 3,
      'type' => 'text-area',
      ))  );
    $wp_customize->add_setting('disable_old_portfolio', array(
		'default'    => '1'
    ));

	$wp_customize->add_control( 'disable_old_portfolio', array(
	      'label'    => __( 'Disable Old Portfolio Data', 'innova' ),
	      'section'  => 'global-section',
	      'settings' => 'disable_old_portfolio',
	      'type' => 'checkbox',
	      'priority' => 12
    ));

	}
add_action( 'customize_register', 'global_section' );
/*Accent colors*/
function skincolors( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'Custom_color_section',
	// Arguments array
	array(
		'title' => __( 'Accent Colors', 'innova' ),
		'priority'       => 10,
		'capability' => 'edit_theme_options',
		'panel'=>'global_section_panel',
		'description' => __( '<strong> Note: </strong>Color applies for bx slider navigation BG active, pagination active bg color, single page slider arrows BG hover and etc.', 'innova' )
	)
);	
	$colors = array();
$colors[] = array(
	'slug'=>'accent_bg_color',
	'default' => '#f44336 ',
	 'transport'   => 'refresh',
	'label' => __('Accent BG Color', 'innova')
);

$colors[] = array(
	'slug'=>'accent_text_color',
	'default' => '#ffffff',
	 'transport'   => 'refresh',
	'label' => __('Text Color for Accent BG Color', 'innova')
);

foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option', 
			'capability' => 
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'], 
			array('label' => $color['label'], 
			'section' => 'Custom_color_section',
			'settings' => $color['slug'])
		)
	);
}	
}
add_action( 'customize_register', 'skincolors' );
// End
// TGM PLugin Notice Message 
function tgm_plugin_admin_style(){ ?>
  <style type="text/css">
    #setting-error-tgmpa p strong{
      font-weight: normal!important;
    }
  </style>
<?php }
add_action('admin_head','tgm_plugin_admin_style'); ?>