<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = '';

$meta_boxes = array();

/* ----------------------------------------------------- 

$revolutionslider = array();
$revolutionslider[0] = 'Select Slider Type';

if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}
*/
$kayaslider_array =get_terms('slider_category','hide_empty=1');

	$kaya_slider = array();
		foreach ($kayaslider_array as $sliders) {
		$kaya_slider[$sliders->slug] = $sliders->name;
		$sliders_ids[] = $sliders->slug;
		}
$kayaportfolio_array =get_terms('portfolio_category','hide_empty=0');

	$kaya_portfolio_cat = array();
		foreach ($kayaportfolio_array as $pf_cat) {
		$kaya_portfolio_cat[$pf_cat->slug] = $pf_cat->name;
		$pf_cat_ids[] = $pf_cat->slug;
		}		
/* ----------------------------------------------------- */
// Page Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'pagesettings',
	'title' => __('Sub header Section which displays below menu bar','innova'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> __('Select Sub Header Style','innova'),
			'id'		=> $prefix . "select_page_options",
			'type'		=> 'select',
			'options'	=> array(
				'page_title_setion'		=> __('Page Title bar','innova'),
				"page_slider_setion"	=> __("Header Slider",'innova'),
				"singleimage" 	=> __("Parallax Header Image",'innova'),
				"video_header" 	=> __("Video Header",'innova'),									
				'none' => 'None',
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		array(
				'name'		=> __('Custom Page Title','innova'),
				'id'		=> $prefix . "kaya_custom_title",
				'type'		=> 'text',
			//	'desc'		=> 'Enter page custom title',
				'std'		=> '',
				'class'     => 'kaya_custom_title'
		),
		array(
				'name'		=> __('Page Title Description','innova'),
				'id'		=> $prefix . "kaya_custom_title_description",
				'type'		=> 'textarea',
				//'desc'		=> 'Enter page title description',
				'std'		=> '',
				'cols' => 20,
				'rows' => 1,
				'class' => 'kaya_custom_title_description'
		),


		array(
			'name'		=> __('Select Header Slider Type','innova'),
			'id'		=> $prefix . "slider",
			'type'		=> 'select',
			'options'	=> array(			
				"bxslider"	=> __("Slider",'innova'),
				"customslider"	=> __("Slider Plugin Shortcode ",'innova'),
												
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),


// Kaya Slider Options	
		array(
			'name'		=> __('Slider Post Type','innova'),
			'id'		=> $prefix . "Kaya_slider_post_type",
			'type'		=> 'select',
			'options'	=> array(
				'slider_category'  	=> __('Kaya Slider','innova'),
				"portfolio_category" 	=> __('Portfolio Slider','innova'),	
			),
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),	
		array(
			'name'		=> __('Select Kaya Slider Category','innova'),
			'id'		=> $prefix . "Kaya_Slider_cat",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_slider,
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> '',
			'class'     => 'Kaya_Slider_cat'
		),
			array(
			'name'		=> __('Select Portfolio Category','innova'),
			'id'		=> $prefix . "kaya_portfolio_cat",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_portfolio_cat,
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> '',
			'class'     => 'kaya_portfolio_cat'
		),	
		array(
			'name'		=> __('Slider Mode','innova'),
			'id'		=> $prefix . "Kaya_slider_mode",
			'type'		=> 'select',
			'options'	=> array(
				'fluid_slider'  	=> __('Full Width','innova'),
				"boxed_slider" 	=> __("Boxed",'innova'),	
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),	
		array(
			'name'		=> __('Auto Play','innova'),
			'id'		=> $prefix . "Kaya_slider_autoplay",
			'type'		=> 'select',
			'options'	=> array(
				'true'  	=> __('True','innova'),
				"false" 	=> __("False",'innova'),	
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slider Items Order','innova'),
			'id'		=> $prefix . "kaya_slider_order",
			'type'		=> 'select',
			'options'	=> array(
				'DESC'  	=> __('Decending Order','innova'),
				"ASC" 	=> __("Ascending Order",'innova'),
			),
			'multiple'	=> false,
			'std'		=> 'DESC',
			'desc'		=> ''
		),
		/*array(
			'name'		=> __('Slide Transition','innova'),
			'id'		=> $prefix . "Kaya_slider_transitions",
			'type'		=> 'select',
			'options'	=> array(
				'horizontal'  => __('Horizontal','innova'),
				"vertical" 	=> __("Vertical",'innova'),
				'fade'  => __('Fade','innova'),
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slide Easing Effect','innova'),
			'id'		=> $prefix . "Kaya_slider_easing",
			'type'		=> 'text',
			'std'		=>'swing',
			'desc'		=> "Enter easing effect Ex:linear, swing,easeOutElastic <br> for more transition effects  <a href='http://jqueryui.com/resources/demos/effect/easing.html' target='_blank'>  click here   </a>"
		),
		array(
			'name'		=> __('Slide Pause Time','innova'),
			'id'		=> $prefix . "Kaya_slider_pause",
			'type'		=> 'text',
			'std'		=>'4000',
			'desc'		=> "The amount of time (in ms) between each auto transition <br> Ex: 4000"
		), */
		array(
			'name'		=> __('Auto Height','innova'),
			'id'		=> $prefix . "adaptive_height",
			'type'		=> 'select',
			'options'	=> array(
				'false'  	=> __('False','innova'),
				"true" 	=> __("True",'innova'),
				),
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slide Animation','innova'),
			'id'		=> $prefix . "rtl_right",
			'class'     => 'rtl_right',
			'type'		=> 'select',
			'options'	=> array(
				'false'  	=> __('Right to Left','innova'),
				"true" 	=> __("Left to Right",'innova'),
				),
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slide Transition Speed','innova'),
			'id'		=> $prefix . "Kaya_slider_transitions_speed",
			'type'		=> 'text',
			'std'		=> '15000',
			'desc'	=> '<small>Ex:1500</small>',
		),
		array(
			'name'		=> __('Slider Height','innova'),
			'id'		=> $prefix . "Kaya_slider_height",
			'type'		=> 'text',
			'std'		=> '500',
			'desc'		=> '<small>Ex:500-600</small>',
		),
		array(
			'name'		=> __('Slider Fullscreen Height ','innova'),
			'id'		=> $prefix . 'enable_slider_screen_height',
			'class'     => 'enable_slider_screen_height',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> '',
			'std' 		=> '1' 
		),
		array(
			'name'	=> __('Slider Items Limit','innova'),
			'desc'	=> '',
			'id'	=> "Kaya_bx_slider_limit",
			'type'	=> 'text',
			'std' => '10'
		),
		array(
			'name'		=> __('Disable Slider Arrow Navigation','innova'),
			'id'		=> $prefix . "disable_bx_slider_arrow_navigation",
			'type'		=> 'checkbox',
			
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Disable Slider Dots Pagination','innova'),
			'id'		=> $prefix . "disable_bx_slider_dots_pagination",
			'type'		=> 'checkbox',
			
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),
// Super Slider
	array(
			'name'		=> __('Slider Post Type','innova'),
			'id'		=> $prefix . "kaya_fluid_slider_post_type",
			'type'		=> 'select',
			'options'	=> array (
						'slider_category' => __('Kaya Slider','innova'),
						'portfolio_category' =>__('Portfolio','innova'),
						),
			'std'		=> '',
			'std'		=> ''
		),
		array(
			'name'		=> __('Select Kaya Slider Category','innova'),
			'id'		=> $prefix . "Kaya_fluid_slider_category",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_slider,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> 'Kaya Slider categories are displayed here',
			'class'   => 'Kaya_fluid_slider_category'
		),

		array(
			'name'		=> __('Select Portfolio Category','innova'),
			'id'		=> $prefix . "Kaya_fluid_portfolio_category",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_portfolio_cat,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> 'Kaya Portfolio categories are displayed here',
			//'class'    => 'kaya_portfolio_cat',
			'class'   => 'Kaya_fluid_portfolio_category'
		),
		array(
			'name'		=> __('Auto Play','innova'),
			'id'		=> $prefix . "Kaya_fluid_slider_auto_play",
			'type'		=> 'select',
			'options'	=> array(
				'3000'  	=> __('True','innova'),
				"0" 	=> __("False",'innova'),	
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slider Items Order','innova'),
			'id'		=> $prefix . "kaya_fluid_slider_pf_order",
			'type'		=> 'select',
			'options'	=> array(
				'DESC'  	=> __('Decending Order','innova'),
				"ASC" 	=> __("Ascending Order",'innova'),
			),
			'multiple'	=> false,
			'std'		=> 'DESC',
			'desc'		=> ''
		),
		array(
			'name'	=> __('Slider Items Limit','innova'),
			'desc'	=> '',
			'id'	=> "Kaya_fluid_slider_limit",
			'type'	=> 'text',
			'std' => '10'
		),
		array(
			'name'		=> __('Disable Arrow Navigation','innova'),
			'id'		=> $prefix . "disable_arrow_navigation",
			'type'		=> 'checkbox',
			
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Disable Dots Pagination','innova'),
			'id'		=> $prefix . "disable_dots_pagination",
			'type'		=> 'checkbox',
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> ''
		),
// Video		
	array(
			'name'		=> __('Slider Shortcode','innova'),
			'id'		=> $prefix . 'customslider_type',
			'type'		=> 'text',
			'desc' => 'Ex: [customslider shortcode_name]'
			),
// Single Image Upload
	array(
			'name'	=> __('Parallax Header Image','innova'),
			'desc'	=> 'Select image and click "Insert into page".',
			'id'	=> "Single_Image_Upload",
			'type'	=> 'image_advanced',
			'class' => 'Single_Image_Upload'
		),
		array(
			'name' => __( 'Background Position ', 'innova' ),
			'id' => $prefix."single_img_attachment",
			'type' => 'radio',
			'class' =>'single_img_attachment',
			'options' => array(
			'fixed' => __( 'Fixed', 'innova' ),
			'scroll' => __( 'Scroll', 'innova' ),
			),
			'std' => 'fixed'
		),	
	
		array(
			'name'	=> __('Image Height ( px ) <small>Ex:400-600</small>','innova'),
			//'desc'	=> '<strong>Note:</strong> By default Screen height is displayed',
			'id'	=> "Single_Image_height",
			'type'	=> 'text',
			'std' => '500'
		),
	array(
			'name'	=> __('Image Overlay Text ','innova'),
			'desc'	=> 'Add text in above field like below html format <br />&lt;h2 style="color:#ffffff; font-size:3.5em; text-align:left;"&gt;Parallax header &lt;/h2&gt; <br />
&lt;p  style="color:#ffffff; font-size:1.3em; text-align:left;"&gt; Parallax Header description place holder, add your inline styles. &lt;/p&gt;',

		'id'	=> "Single_Image_content",
			'type'	=> 'textarea',
			'std' => ''
		),		
// Video		
	array(
			'name'		=> __('Add iframe video code','innova'),
			'id'		=> $prefix . 'video_header',
			'type'		=> 'textarea',
			'desc' => 'Ex: &lt;iframe src=&quot;//player.vimeo.com/video/70301553&quot; width=&quot;100%&quot; height=&quot;500&quot; frameborder=&quot;0&quot; webkitallowfullscreen mozallowfullscreen allowfullscreen&gt;&lt;/iframe&gt;
'
			),
			


	)
);


/* ----------------------------------------------------- */
// Page Layout Options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'my-page-layout',
	'title' => __('Custom Sidebar Options','innova'),
	'pages' => array( 'page','product' ),
	'context' => 'side',
	'priority' => 'core',
		'fields' => array(
	/* array(
				'name' => 'Choose Page Style',
				'desc' => 'Select Page style <em>Fullwidth</em> or <em>Right Sidebar</em> or <em>Left Sidebar</em> ',
				'id' => $prefix . 'kaya_pagesidebar',
				'type' => 'select',
				'std'	=> '',
				'options' => array( "rightsidebar" => "Right Sidebar", "leftsidebar" => "Left Sidebar","full" => "Full Width"),
				'multiple'	=> false,
				), */
		
			array(
				'name' => '',
				'desc' => __('Select Sidebar for this page, <br> <br><em>Note: create custom sidebars by navigating to "Apperance > Theme Options > Custom Sidebar"</em>','innova'),
				'id' => $prefix . 'kaya_widgetsidebar',
				'type' => 'select',
				'std'	=> '',
				'options' => $sidebar_widgets
			),
	)

);


/* ----------------------------------------------------- */
// Portfolio page Layout Options
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'my-page-layout',
	'title' => 'Portfolio Image Align Options',
	'pages' => array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'high',
		'fields' => array(
		array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( "rightsidebar" => "Images Align Left", "leftsidebar" => "Images Align Right", "full" => "Images Align Center")
		),
	)

);
*/
// Portfolio sidebar
/* ----------------------------------------------------- */ 
$meta_boxes[] = array(
	'id'		=> 'portfolio_sidebar',
	'title'		=> __('Template','innova'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'default',
	'fields'	=> array(
	array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array(  "full" => __('Fullwidth','innova'), "rightsidebar" => __('Right Sidebar','innova'), "leftsidebar" => __('Left Sidebar','innova'))
		),
	
		
		)
	);
/* ----------------------------------------------------- */
// POrtfolio Info Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => __('Portfolio General Options','innova'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
		'fields' => array(
		array(
			'name' => __('Custom Portfolio Item Title','innova'),
			'desc' => '',
			'id' => $prefix . 'kaya_custom_title',
			'type' => 'text',
			
		),

		array(
			'name' => __('Portfolio Item External link to','innova'),
			'desc' => 'Ex: http://www.google.com',
			'id' => $prefix . 'Porfolio_customlink',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name'		=> __('Open In New Window','innova'),
			'id'		=> $prefix . 'pf_link_new_window',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Related Posts','innova'),
			'id'		=> $prefix . 'relatedpost',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> 'Display Related posts at the bottom of this post in Portfolio single page  <br /><strong>Note:</strong> <em>Related post displays based on tags</em>'
		),

		array(
			'name'		=> __('Post Item Background color','innova'),
			'id'		=> $prefix . 'post_item_bg_color',
			'clone'		=> false,
			'type'		=> 'color',
			'desc'		=> ''
		),

		array(
			'name'		=> __('Post Item Text color','innova'),
			'id'		=> $prefix . 'post_item_text_color',
			'clone'		=> false,
			'type'		=> 'color',
			'desc'		=> ''
		),
		
	)
);

/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'portfolio_slides',
	'title'		=> __('Portfolio Images / Video','innova'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Project Images','innova'),
			'desc'	=> __('Upload up to 500 project images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image','innova'),
			'id'	=> $prefix . 'portfolio_slide',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 500,
		),
		array(
			'name'		=> __('Images Display Format','innova'),
			'id'		=> $prefix . 'list_images',
			'type'		=> 'select',
			'options'	=> array(
					'slider'			=> __('Slider','innova'),
					'isotope_gallery'	=> __('Masonry Gallery','innova'),
					'grid_gallery'	=> __('Grid Gallery','innova'),
					'listimg'			=> __('List Images','innova'),
				),
				'multiple'	=> false,
				'desc' =>  ''
			),
		// Video
		
		array(
			'name'		=> __('Video Embed Code','innova'),
			'id'		=> $prefix . 'video_embed_code',
			'type'		=> 'textarea',
			'desc' => 'Paste the video iframe embed code Ex: <br /> &lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; width=&quot;440&quot; height=&quot;248&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;'
			),
		 array(
			'name' => __('Project Images / Video Alignment','innova'),
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( 
				"rightsidebar" => __("Align Left", 'innova'),
				"leftsidebar" => __("Align Right",'innova'), 
				"full" => __("Align Center",'innova'),
				)
		), 
		)
);
*/
/* ----------------------------------------------------- */
// Project Video Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'portfolio_video',
	'title'		=> 'Portfolio Video',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
	array(
			'name'		=> 'Video Type',
			'id'		=> $prefix . 'video_type',
			'type'		=> 'select',
			'options'	=> array(
					'none' => 'None',
					'vimeo'	=> 'Vimeo',
					'youtube'	=> 'Youtube',
					'videoembed'	=> 'Video Embed Code'					
				),
				'multiple'	=> false,
				'desc' =>  'It overwrites portfolio project images'
			),
		array(
			'name'		=> 'Video ID',
			'id'		=> $prefix . 'youtube_video',
			'type'		=> 'text',
			'desc' => 'Paste the video ID Ex:iU8iA7jfrIg<br /><br /><img src="'.get_template_directory_uri().'/images/video_id.jpg">'
			),
		array(
			'name'		=> 'Video ID',
			'id'		=> $prefix . 'vimeo_video',
			'type'		=> 'text',
			'desc' => 'Paste the video ID Ex:76357146<br /><br /><img src="'.get_template_directory_uri().'/images/vimeo_id.jpg">'
			),
		array(
			'name'		=> 'Video Embed Code',
			'id'		=> $prefix . 'video_embed',
			'type'		=> 'textarea',
			'desc' => 'Paste the video iframe embed code Ex: <br /> &lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; width=&quot;440&quot; height=&quot;248&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;'
			),
	
		
		)
	);
*/
	/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'portfolio_pj_skills',
	'title'		=> 'Project Specification',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
			array(
			'name'	=> 'Project Specifications Title',
			'desc'	=> 'Add Project Specifications title Ex: fresh color, durablity etc.',
			'id'	=> $prefix . 'portfolio_project_skills_title',
			'type'	=> 'text',
			'std' => '',
		),	
		array(
			'name'	=> 'Project Specifications',
			'desc'	=> 'Add Project Specifications separate with commas<br />Ex:PHP, WORDPRESS,JQUERY,HTML5,CSS3',
			'id'	=> $prefix . 'portfolio_project_skills',
			'type'	=> 'textarea',
			'std' => '',
		),
		
		)
);

*/
/* ----------------------------------------------------- */
// Post Info Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'kaya_featured_info',
	'title' => 'Featured Image options',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name' 	=> 	'Featured Image',
			'id' 	=> 	$prefix . 'featuredImage',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'Check this box to enable " Featured Image" in blog single page',
			'std' 	=> 	''	
		),
		
	)
); */
/* ----------------------------------------------------- */
// Video Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_post_format_video',
	'title' => __('Video','innova'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(

		array(
			'name' 	=> 	__('Add Iframe Video','innova'),
			'id' 	=> 	$prefix . 'post_video',
			'type'	=> 	'textarea',
			'desc' 	=> 	'&lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; width=&quot;100%&quot; height=&quot;350&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;',
			'std' 	=> 	''	
		),	
		
	)
);

$meta_boxes[] = array(
	'id' => 'kaya_title_image_streatch',
	'title' => __('Blog Post Image Settings','innova'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(

	/* Image Streached */
		array(
			'name' 	=> 	__('Featured Image Stretch','innova'),
			'id' 	=> 	$prefix .'kaya_image_streatch',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),		
		
	)
);
/* ----------------------------------------------------- */
// Gallery
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'kaya_post_format_gallery',
	'title'		=> __('Gallery Format','innova'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Post Format Gallery','innova'),
			'desc'	=> __('These images are displayed in Post single page, Upload up to 500 project images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image','innova'),
			'id'	=> $prefix . 'post_gallery',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 500,
		),
		array(
			'name' 	=> 	__('Gallery Slider','innova'),
			'id' 	=> 	$prefix . 'kaya_gallery_slider',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
		
		)
);

/* ----------------------------------------------------- */
// Quote Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_quote_format_quote',
	'title' => __('Quote Format','innova'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Quote','innova'),
			'id' 	=> 	$prefix . 'kaya_quote_desc',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
	)
);
/* ----------------------------------------------------- */
// Audio Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_audio_format',
	'title' => __('Audio Format','innova'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Audio Embed','innova'),
			'id' 	=> 	$prefix . 'kaya_audio',
			'type'	=> 	'textarea',
			'desc' 	=> 	'Ex:<br />&lt;iframe width=&quot;100%&quot; height=&quot;100&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot; src=&quot;https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/14453926&amp;auto_play=false&amp;hide_related=false&amp;visual=true&quot;&gt;&lt;/iframe&gt;',
			'std' 	=> 	''	
		),	
		
	)
);
/* ----------------------------------------------------- */
// Link Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_link_format',
	'title' => __('Link Format','innova'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Link','innova'),
			'id' 	=> 	$prefix . 'kaya_link',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),	
		
	)
);

/* ----------------------------------------------------- */
// Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'slider-customlink',
	'title'		=> __('Slider Settings','innova'),
	'pages'		=> array( 'slider' ),
	'context' => 'normal',
	'fields'	=> array(
		/*
	array(
			'name' => 'Slide Title Description',
			'desc' => '',
			'id' => $prefix . 'slide_description',
			'type' => 'textarea',
			'std' => ''
		),*/
	array(
			'name' => __('Slide Text Color','innova'),
			'desc' => __('Color for slide title and description','innova'),
			'id' => $prefix . 'slide_text_color',
			'type' => 'color',
			'std' => '#fff'
		),
	array(
			'name' => __('Title Font Size','innova'),
			'id' => $prefix . 'title_font_size',
			'type' => 'text',
			'desc' => 'Ex:40',
			'std' => ''
		),
	array(
			'name' => __('Description Font Size','innova'),
			'id' => $prefix . 'description_font_size',
			'type' => 'text',
			'desc' => 'Ex:30',
			'std' => ''
		),
	array(
			'name' => __('Disable Slide Title/Description','innova'),
			'desc' => '',
			'id' => $prefix . 'disable_slide_content',
			'type' => 'checkbox',
			'std' => ''
		),
	array(
			'name' => __('Slide link','innova'),
			'desc' => 'Ex: http://www.google.com',
			'id' => $prefix . 'customlink',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Open In New Window','innova'),
			'desc' => '',
			'id' => $prefix . 'slider_target_link',
			'type' => 'checkbox',
			'std' => ''
		),

		array(
			'name'		=> __('Title Alignment','innova'),
			'id'		=> $prefix . "title_align",
			'type'		=> 'select',
			'options'	=> array(
				"left"	=> __("Left",'innova'),
				"center" => __("Center",'innova'),
				"right"	=> __("Right",'innova'),
												
			),
			'multiple'	=> false,
			'std'		=> array( '' ),
			'desc'		=> ''
		),
/*
		array(
			'name' => 'Slide Video Iframe code',
			'desc' => '',
			'id' => $prefix . 'slide_video',
			'type' => 'textarea',
			'std' => ''
		),

*/
		)
	);

/* ----------------------------------------------------- */
// Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'testimonial-settngs',
	'title'		=> __('Testimonial Settings','innova'),
	'pages'		=> array( 'testimonial' ),
	'context' => 'normal',
	'fields'	=> array(

	array(
			'name' => __('Designation','innova'),
			'desc' => '',
			'id' => $prefix . 't_client_designation',
			'type' => 'text',
			'std' => ''
		),
	
	array(
			'name' => __('Description','innova'),
			'desc' => '',
			'id' => $prefix . 'testimonial_description',
			'type' => 'textarea',
			'std' => ''
		),
		

		array(
			'name' => __('Link','innova'),
			'desc' => '',
			'id' => $prefix . 't_client_link',
			'type' => 'text',
			'std' => ''
		),
		)
	);
/* ----------------------------------------------------- */
//  Tabs Icon
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'tab_icon_settings',
	'title'		=> __('Tabs Section','innova'),
	'pages'		=> array( 'tabs' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name' => __('Tab Icon Name','innova'),
			'desc' => __('for more awesome icons click ','innova').'<a href="http://fortawesome.github.io/Font-Awesome/icons/"> '.__(' here','innova').'</a>',
			'id' => $prefix . 'tab_awesome_icon_name',
			'type' => 'text',
			'std' => ''
		),
		
		)
	);
/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'slider_single_slides',
	'title'		=> 'Slider Single Page Options',
	'pages'		=> array( 'slider' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> 'Slider Single Page Images',
			'desc'	=> 'Upload up to 50  images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image',
			'id'	=> $prefix . 'kaya_slider_slide',
			'type'	=> 'thickbox_image',
			'max_file_uploads' => 50,
		),

		)
	);
*/
// Slider page Layout Options
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'my-slider-layout',
	'title' => 'Slider Image Align Options',
	'pages' => array( 'slider' ),
	'context' => 'side',
	'priority' => 'high',
		'fields' => array(
		array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( "rightsidebar" => "Images Align Left", "leftsidebar" => "Images Align Right", "full" => "Images Align Center")
		),
	)

);*/


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function kaya_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'kaya_register_meta_boxes' );