<?php
/**
 * VW Lawyer Attorney Theme Customizer
 *
 * @package VW Lawyer Attorney
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_lawyer_attorney_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_lawyer_attorney_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-lawyer-attorney' ),
	    'description' => __( 'Description of what this panel does.', 'vw-lawyer-attorney' ),
	) );

	$wp_customize->add_section( 'vw_lawyer_attorney_left_right', array(
    	'title'      => __( 'General Settings', 'vw-lawyer-attorney' ),
		'priority'   => 30,
		'panel' => 'vw_lawyer_attorney_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_lawyer_attorney_theme_options',array(
	        'default' =>  __( 'One Column', 'vw-lawyer-attorney' ),
	        'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_lawyer_attorney_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __( 'Do you want this section', 'vw-lawyer-attorney' ),
	        'section' => 'vw_lawyer_attorney_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','vw-lawyer-attorney'),
	            'Right Sidebar' => __('Right Sidebar','vw-lawyer-attorney'),
	            'One Column' => __('One Column','vw-lawyer-attorney'),
	            'Three Columns' => __('Three Columns','vw-lawyer-attorney'),
	            'Four Columns' => __('Four Columns','vw-lawyer-attorney'),
	            'Grid Layout' => __('Grid Layout','vw-lawyer-attorney')
	        ),
	) );

	$font_array = array(
        '' => __( 'No Fonts', 'vw-lawyer-attorney' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-lawyer-attorney' ),
        'Acme' => __( 'Acme', 'vw-lawyer-attorney' ),
        'Anton' => __( 'Anton', 'vw-lawyer-attorney' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-lawyer-attorney' ),
        'Arimo' => __( 'Arimo', 'vw-lawyer-attorney' ),
        'Arsenal' => __( 'Arsenal', 'vw-lawyer-attorney' ),
        'Arvo' => __( 'Arvo', 'vw-lawyer-attorney' ),
        'Alegreya' => __( 'Alegreya', 'vw-lawyer-attorney' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-lawyer-attorney' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-lawyer-attorney' ),
        'Bangers' => __( 'Bangers', 'vw-lawyer-attorney' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-lawyer-attorney' ),
        'Bad Script' => __( 'Bad Script', 'vw-lawyer-attorney' ),
        'Bitter' => __( 'Bitter', 'vw-lawyer-attorney' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-lawyer-attorney' ),
        'BenchNine' => __( 'BenchNine', 'vw-lawyer-attorney' ),
        'Cabin' => __( 'Cabin', 'vw-lawyer-attorney' ),
        'Cardo' => __( 'Cardo', 'vw-lawyer-attorney' ),
        'Courgette' => __( 'Courgette', 'vw-lawyer-attorney' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-lawyer-attorney' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-lawyer-attorney' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-lawyer-attorney' ),
        'Cuprum' => __( 'Cuprum', 'vw-lawyer-attorney' ),
        'Cookie' => __( 'Cookie', 'vw-lawyer-attorney' ),
        'Chewy' => __( 'Chewy', 'vw-lawyer-attorney' ),
        'Days One' => __( 'Days One', 'vw-lawyer-attorney' ),
        'Dosis' => __( 'Dosis', 'vw-lawyer-attorney' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-lawyer-attorney' ),
        'Economica' => __( 'Economica', 'vw-lawyer-attorney' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-lawyer-attorney' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-lawyer-attorney' ),
        'Francois One' => __( 'Francois One', 'vw-lawyer-attorney' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-lawyer-attorney' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-lawyer-attorney' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-lawyer-attorney' ),
        'Handlee' => __( 'Handlee', 'vw-lawyer-attorney' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-lawyer-attorney' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-lawyer-attorney' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-lawyer-attorney' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-lawyer-attorney' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-lawyer-attorney' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-lawyer-attorney' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-lawyer-attorney' ),
        'Kanit' => __( 'Kanit', 'vw-lawyer-attorney' ),
        'Lobster' => __( 'Lobster', 'vw-lawyer-attorney' ),
        'Lato' => __( 'Lato', 'vw-lawyer-attorney' ),
        'Lora' => __( 'Lora', 'vw-lawyer-attorney' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-lawyer-attorney' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-lawyer-attorney' ),
        'Merriweather' => __( 'Merriweather', 'vw-lawyer-attorney' ),
        'Monda' => __( 'Monda', 'vw-lawyer-attorney' ),
        'Montserrat' => __( 'Montserrat', 'vw-lawyer-attorney' ),
        'Muli' => __( 'Muli', 'vw-lawyer-attorney' ),
        'Marck Script' => __( 'Marck Script', 'vw-lawyer-attorney' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-lawyer-attorney' ),
        'Open Sans' => __( 'Open Sans', 'vw-lawyer-attorney' ),
        'Overpass' => __( 'Overpass', 'vw-lawyer-attorney' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-lawyer-attorney' ),
        'Oxygen' => __( 'Oxygen', 'vw-lawyer-attorney' ),
        'Orbitron' => __( 'Orbitron', 'vw-lawyer-attorney' ),
        'Patua One' => __( 'Patua One', 'vw-lawyer-attorney' ),
        'Pacifico' => __( 'Pacifico', 'vw-lawyer-attorney' ),
        'Padauk' => __( 'Padauk', 'vw-lawyer-attorney' ),
        'Playball' => __( 'Playball', 'vw-lawyer-attorney' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-lawyer-attorney' ),
        'PT Sans' => __( 'PT Sans', 'vw-lawyer-attorney' ),
        'Philosopher' => __( 'Philosopher', 'vw-lawyer-attorney' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-lawyer-attorney' ),
        'Poiret One' => __( 'Poiret One', 'vw-lawyer-attorney' ),
        'Quicksand' => __( 'Quicksand', 'vw-lawyer-attorney' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-lawyer-attorney' ),
        'Raleway' => __( 'Raleway', 'vw-lawyer-attorney' ),
        'Rubik' => __( 'Rubik', 'vw-lawyer-attorney' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-lawyer-attorney' ),
        'Russo One' => __( 'Russo One', 'vw-lawyer-attorney' ),
        'Righteous' => __( 'Righteous', 'vw-lawyer-attorney' ),
        'Slabo' => __( 'Slabo', 'vw-lawyer-attorney' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-lawyer-attorney' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-lawyer-attorney'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-lawyer-attorney' ),
        'Sacramento' => __( 'Sacramento', 'vw-lawyer-attorney' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-lawyer-attorney' ),
        'Tangerine' => __( 'Tangerine', 'vw-lawyer-attorney' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-lawyer-attorney' ),
        'VT323' => __( 'VT323', 'vw-lawyer-attorney' ),
        'Varela Round' => __( 'Varela Round', 'vw-lawyer-attorney' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-lawyer-attorney' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-lawyer-attorney' ),
        'Volkhov' => __( 'Volkhov', 'vw-lawyer-attorney' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-lawyer-attorney' )
    );

	//Typography
	$wp_customize->add_section( 'vw_lawyer_attorney_typography', array(
    	'title'      => __( 'Typography', 'vw-lawyer-attorney' ),
		'priority'   => 30,
		'panel' => 'vw_lawyer_attorney_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_paragraph_color', array(
		'label' => __('Paragraph Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_paragraph_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'Paragraph Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	$wp_customize->add_setting('vw_lawyer_attorney_paragraph_font_size',array(
		'default'	=> '12px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_atag_color', array(
		'label' => __('"a" Tag Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_atag_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( '"a" Tag Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_li_color', array(
		'label' => __('"li" Tag Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_li_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( '"li" Tag Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_h1_color', array(
		'label' => __('H1 Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_h1_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'H1 Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('vw_lawyer_attorney_h1_font_size',array(
		'default'	=> '50px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_h1_font_size',array(
		'label'	=> __('H1 Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_h2_color', array(
		'label' => __('h2 Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_h2_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'h2 Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('vw_lawyer_attorney_h2_font_size',array(
		'default'	=> '45px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_h2_font_size',array(
		'label'	=> __('h2 Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_h3_color', array(
		'label' => __('h3 Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_h3_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'h3 Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('vw_lawyer_attorney_h3_font_size',array(
		'default'	=> '36px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_h3_font_size',array(
		'label'	=> __('h3 Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_h4_color', array(
		'label' => __('h4 Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_h4_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'h4 Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('vw_lawyer_attorney_h4_font_size',array(
		'default'	=> '30px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_h4_font_size',array(
		'label'	=> __('h4 Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_h5_color', array(
		'label' => __('h5 Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_h5_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'h5 Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('vw_lawyer_attorney_h5_font_size',array(
		'default'	=> '25px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_h5_font_size',array(
		'label'	=> __('h5 Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'vw_lawyer_attorney_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vw_lawyer_attorney_h6_color', array(
		'label' => __('h6 Color', 'vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_typography',
		'settings' => 'vw_lawyer_attorney_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('vw_lawyer_attorney_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices'
	));
	$wp_customize->add_control(
	    'vw_lawyer_attorney_h6_font_family', array(
	    'section'  => 'vw_lawyer_attorney_typography',
	    'label'    => __( 'h6 Fonts','vw-lawyer-attorney'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('vw_lawyer_attorney_h6_font_size',array(
		'default'	=> '18px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_h6_font_size',array(
		'label'	=> __('h6 Font Size','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_typography',
		'setting'	=> 'vw_lawyer_attorney_h6_font_size',
		'type'	=> 'text'
	));

	//Top Bar(topbar)
	$wp_customize->add_section('vw_lawyer_attorney_contact',array(
		'title'	=> __('Contact Us','vw-lawyer-attorney'),
		'description'	=> __('Add contact us here','vw-lawyer-attorney'),
		'priority'	=> null,
		'panel' => 'vw_lawyer_attorney_panel_id',
	));

	$wp_customize->add_setting('vw_lawyer_attorney_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_call',array(
		'label'	=> __('Phone Number','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_lawyer_attorney_call1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_call1',array(
		'label'	=> __('Email Address','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_lawyer_attorney_location',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_location',array(
		'label'	=> __('Address 1','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_lawyer_attorney_location1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_location1',array(
		'label'	=> __('Address 2','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_lawyer_attorney_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_time',array(
		'label'	=> __('Opening time.','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_lawyer_attorney_time1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_lawyer_attorney_time1',array(
		'label'	=> __('Closing Time','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_contact',
		'type'		=> 'text'
	));
	
	//home page slider
	$wp_customize->add_section( 'vw_lawyer_attorney_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-lawyer-attorney' ),
		'priority'   => 30,
		'panel' => 'vw_lawyer_attorney_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_lawyer_attorney_slidersettings-page-' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( 'vw_lawyer_attorney_slidersettings-page-' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-lawyer-attorney' ),
			'section'  => 'vw_lawyer_attorney_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//About
	$wp_customize->add_section('vw_lawyer_attorney_about1',array(
		'title'	=> __('About Section','vw-lawyer-attorney'),
		'description'	=> __('Add About sections below.','vw-lawyer-attorney'),
		'panel' => 'vw_lawyer_attorney_panel_id',
	));

	$post_list = get_posts();
	$i = 0;
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('vw_lawyer_attorney_about_setting',array(
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('vw_lawyer_attorney_about_setting',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_about1',
	));

	$wp_customize->add_setting('vw_lawyer_attorney_about_name',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	

	$wp_customize->add_control('vw_lawyer_attorney_about_name',array(
		'label'	=> __('read more text','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_about1',
		'setting'	=> 'vw_lawyer_attorney_about_name',
		'type'		=> 'text'
	));


	//Why Choose us
	$wp_customize->add_section('vw_lawyer_attorney_amenities_section',array(
		'title'	=> __('Why Choose Us','vw-lawyer-attorney'),
		'description'	=> '',
		'priority'	=> null,
		'panel' => 'vw_lawyer_attorney_panel_id',
	));
	
	$wp_customize->add_setting('vw_lawyer_attorney_main_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));

	$wp_customize->add_control('vw_lawyer_attorney_main_title',array(
		'label'	=> __('Title','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_amenities_section',
		'type'	=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_lawyer_attorney_blogcategory_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_lawyer_attorney_sanitize_choices',
	));

	$wp_customize->add_control('vw_lawyer_attorney_blogcategory_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','vw-lawyer-attorney'),
		'section' => 'vw_lawyer_attorney_amenities_section',
	));

	//footer
	$wp_customize->add_section('vw_lawyer_attorney_footer_section',array(
		'title'	=> __('Footer Text','vw-lawyer-attorney'),
		'description'	=> __('Add some text for footer like copyright etc.','vw-lawyer-attorney'),
		'priority'	=> null,
		'panel' => 'vw_lawyer_attorney_panel_id',
	));
	
	$wp_customize->add_setting('vw_lawyer_attorney_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('vw_lawyer_attorney_footer_copy',array(
		'label'	=> __('Copyright Text','vw-lawyer-attorney'),
		'section'	=> 'vw_lawyer_attorney_footer_section',
		'type'		=> 'text'
	));
	/** home page setions end here**/	
}
add_action( 'customize_register', 'vw_lawyer_attorney_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class vw_lawyer_attorney_customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Lawyer_Attorney_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Lawyer_Attorney_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW Lawyer Pro', 'vw-lawyer-attorney' ),
					'pro_text' => esc_html__( 'Upgarde Pro',         'vw-lawyer-attorney' ),
					'pro_url'  => 'https://www.vwthemes.com/themes/premium-lawyer-wordpress-theme/'
				)
			)
		);

		// Register sections.
		$manager->add_section(
			new VW_Lawyer_Attorney_Customize_Section_Pro(
				$manager,
				'example_2',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Documentation', 'vw-lawyer-attorney' ),
					'pro_text' => esc_html__( 'Docs', 'vw-lawyer-attorney' ),
					'pro_url'  => admin_url( 'themes.php?page=vw_lawyer_attorney_guide' )
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-lawyer-attorney-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-lawyer-attorney-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
vw_lawyer_attorney_customize::get_instance();