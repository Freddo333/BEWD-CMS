<?php
/**
 * Typography. 
 * @package     arilewp
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== TYPOGRAPHY ==========================================*/
if ( ! class_exists( 'ArileWP_Customize_Theme_Typography_Option' ) ) :

	/**
	 * Theme Typography option.
	 */
	class ArileWP_Customize_Theme_Typography_Option extends ArileWP_Customize_Base_Option {

		public function elements() {

			return array(
			
/* ---------- Enable/Disable TYPOGRAPHY -------------- */		
			
			    'arilewp_typography_disabled' => array(
					'setting' => array(
						'default'           => false,
						'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 2,
						'label'    => esc_html__( 'Enable Typography', 'arilewp' ),
						'section'  => 'arilewp_enable_disable_typography',
					),
				),	
            				

			);

		}

	}

	new ArileWP_Customize_Theme_Typography_Option();

endif;
