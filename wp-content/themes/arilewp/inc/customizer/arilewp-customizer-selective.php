<?php
/**
 * Override default customizer options.
 *
 * @package arilewp
 */

// Settings.
$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

if ( isset( $wp_customize->selective_refresh ) ) {
	
	// site title
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_blogname' ),
		)
	);

    // site tagline
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_blogdescription' ),
		)
	);
	
	// main slider
	$wp_customize->selective_refresh->add_partial(
		'arilewp_main_slider_content',
		array(
			'selector'        => '.theme-main-slider .theme-slider-content',
		)
	);
	
	// theme info area
	$wp_customize->selective_refresh->add_partial(
		'arilewp_theme_info_content',
		array(
			'selector'        => '.row.theme-info-area',
		)
	);
	
	// service title
	$wp_customize->selective_refresh->add_partial(
		'arilewp_service_area_title',
		array(
			'selector'        => '.theme-services .theme-section-subtitle',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_service_area_title' ),
		)
	);
	
	// service title
	$wp_customize->selective_refresh->add_partial(
		'arilewp_service_area_des',
		array(
			'selector'        => '.theme-services .theme-section-title',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_service_area_des' ),
		)
	);
	
	// service content
	$wp_customize->selective_refresh->add_partial(
		'arilewp_service_content',
		array(
			'selector'        => '.theme-services .row.theme-services-content',
		)
	);
	
	// project title
	$wp_customize->selective_refresh->add_partial(
		'arilewp_project_area_title',
		array(
			'selector'        => '.theme-project .theme-section-subtitle',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_project_area_title' ),
		)
	);
	
	// project description
	$wp_customize->selective_refresh->add_partial(
		'arilewp_project_area_des',
		array(
			'selector'        => '.theme-project .theme-section-title',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_project_area_des' ),
		)
	);
	
	// project content
	$wp_customize->selective_refresh->add_partial(
		'arilewp_project_content',
		array(
			'selector'        => '.theme-project .row.theme-project-row',
		)
	);
	
	// testimonial title
	$wp_customize->selective_refresh->add_partial(
		'arilewp_testimonial_area_title',
		array(
			'selector'        => '.theme-testimonial .theme-section-subtitle',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_testimonial_area_title' ),
		)
	);
	
	// testimonial description
	$wp_customize->selective_refresh->add_partial(
		'arilewp_testimonial_area_des',
		array(
			'selector'        => '.theme-testimonial .theme-section-title',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_testimonial_area_des' ),
		)
	);
	
    // testimonial content
	$wp_customize->selective_refresh->add_partial(
		'arilewp_testimonial_content',
		array(
			'selector'        => '.theme-testimonial .row.theme-testimonial-content',
		)
	);
	
	// blog title
	$wp_customize->selective_refresh->add_partial(
		'arilewp_blog_area_title',
		array(
			'selector'        => '.theme-blog .theme-section-subtitle',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_blog_area_title' ),
		)
	);
	
	// blog description
	$wp_customize->selective_refresh->add_partial(
		'arilewp_blog_area_des',
		array(
			'selector'        => '.theme-blog .theme-section-title',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_blog_area_des' ),
		)
	);
	
	// footer copyright text
	$wp_customize->selective_refresh->add_partial(
		'arilewp_footer_copright_text',
		array(
			'selector'        => '.site-footer .site-info',
			'render_callback' => array( 'ArileWP_Customizer_Partials', 'customize_partial_arilewp_footer_copright_text' ),
		)
	);
	
}