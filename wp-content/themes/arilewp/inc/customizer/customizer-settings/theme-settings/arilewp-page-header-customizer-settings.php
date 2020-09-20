<?php
/**
 * Page Header Settings.
 *
 * @package arilewp
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
* Page Header Settings.
*/

if ( ! class_exists( 'ArileWP_Customize_Page_Header_Option' ) ) :

	class ArileWP_Customize_Page_Header_Option extends ArileWP_Customize_Base_Option {

		public function elements() {

			return array(
			
			
			    'arilewp_page_header_heading' => array(
					'setting' => array(),
					'control' => array(
						'type'    => 'heading',
						'priority'        => 1,
						'label'   => esc_html__( 'Page Header', 'arilewp' ),
						'section' => 'header_image',
					),
				),
			
				'arilewp_page_header_disabled' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 5,
						'label'    => esc_html__( 'Page Header Enable/Disable', 'arilewp' ),
						'section'  => 'header_image',
					),
				),
				
				
				'arilewp_page_header_background_color' => array(
					'setting' => array(
						'default'           => 'rgba(0, 123, 255, 1)',
						'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 7,
						'label'           => esc_html__( 'Background color', 'arilewp' ),
						'section'         => 'header_image',
						'choices'         => array(
							'alpha' => true,
						),
					),
				),
			  

			);

		}

	}

	new ArileWP_Customize_Page_Header_Option();

endif;
