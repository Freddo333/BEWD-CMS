<?php
/**
 * Register customizer panels and sections.
 *
 * @package arilewp
 */

/* Theme Settings. */
 
$wp_customize->add_panel( new ArileWP_Customize_Panel( $wp_customize, 'arilewp_theme_settings', array(
	'priority'   => 28,
	'title'      => esc_html__( 'Theme Options', 'arilewp' ),
	'capabitity' => 'edit_theme_options',
) ) );


// Section Header.
	
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_theme_header', array(
		'title'    => esc_html__( 'Header', 'arilewp' ),
		'panel'    => 'arilewp_theme_settings',
		'priority' => 10,
	) ) );
	

// Section Menu.
	
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_theme_menu_bar', array(
		'title'    => esc_html__( 'Menu', 'arilewp' ),
		'panel'    => 'arilewp_theme_settings',
		'priority' => 20,
	) ) );


// Section Blog.

	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_theme_blog_settings', array(
		'title'    => esc_html__( 'Blog', 'arilewp' ),
		'panel'    => 'arilewp_theme_settings',
		'priority' => 30,
	) ) );
	
		$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_blog_general', array(
			'title'    => esc_html__( 'General', 'arilewp' ),
			'panel'    => 'arilewp_theme_settings',
			'section'  => 'arilewp_theme_blog_settings',
			'priority' => 10,
		) ) );


// Section Footer.

	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_theme_footer', array(
		'title'    => esc_html__( 'Footer', 'arilewp' ),
		'panel'    => 'arilewp_theme_settings',
		'priority' => 50,
	) ) );
	
	    $wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_footer_widgets', array(
			'title'    => esc_html__( 'Footer Widgets', 'arilewp' ),
			'panel'    => 'arilewp_theme_settings',
			'section'  => 'arilewp_theme_footer',
			'priority' => 10,
		) ) );
	
		$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_footer_copyright', array(
			'title'    => esc_html__( 'Footer Copyright', 'arilewp' ),
			'panel'    => 'arilewp_theme_settings',
			'section'  => 'arilewp_theme_footer',
			'priority' => 20,
		) ) );

/**
 * Panel: Typography.
 */
$wp_customize->add_panel( new ArileWP_Customize_Panel( $wp_customize, 'arilewp_theme_typography', array(
	'priority'   => 32,
	'title'      => esc_html__( 'Typography', 'arilewp' ),
	'capabitity' => 'edit_theme_options',
) ) );

    // Section Enable/Disable Typography.
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_enable_disable_typography', array(
		'title'    => esc_html__( 'Enable Typography', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 5,
	) ) );

	// Section Base typography Typography.
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_base_typography', array(
		'title'    => esc_html__( 'Base Typography', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 10,
	) ) );
	
	// Section Headings ( h1 - h6 ) Typography.
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_headings1_typography', array(
		'title'    => esc_html__( 'Headings H1', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 70,
	) ) );
	
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_headings2_typography', array(
		'title'    => esc_html__( 'Headings H2', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 80,
	) ) );
	
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_headings3_typography', array(
		'title'    => esc_html__( 'Headings H3', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 90,
	) ) );
	
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_headings4_typography', array(
		'title'    => esc_html__( 'Headings H4', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 100,
	) ) );
	
	$wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_headings5_typography', array(
		'title'    => esc_html__( 'Headings H5', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 110,
	) ) );

    $wp_customize->add_section( new ArileWP_Customize_Section( $wp_customize, 'arilewp_headings6_typography', array(
		'title'    => esc_html__( 'Headings H6', 'arilewp' ),
		'panel'    => 'arilewp_theme_typography',
		'priority' => 120,
	) ) );