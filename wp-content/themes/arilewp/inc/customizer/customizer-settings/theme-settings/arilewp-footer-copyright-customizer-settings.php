<?php
/**
 * Footer Copyright.
 *
 * @package     arilewp
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ArileWP_Customize_Footer_Copyright_Option' ) ) :

	/**
	 * Footer Copyright.
	 */
	class ArileWP_Customize_Footer_Copyright_Option extends ArileWP_Customize_Base_Option {

		public function elements() {

			return array(

				'arilewp_footer_copright_enabled' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 5,
						'label'    => esc_html__( 'Footer Copyright Enable/Disable', 'arilewp' ),
						'section'  => 'arilewp_footer_copyright',
					),
				),		
				
				
			);

		}

	}

	new ArileWP_Customize_Footer_Copyright_Option();

endif;
