<?php
/**
 * General Blog.
 *
 * @package     arilewp
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ArileWP_Customize_Blog_General_Option' ) ) :

	/**
	 * General Blog..
	 */
	class ArileWP_Customize_Blog_General_Option extends ArileWP_Customize_Base_Option {

		public function elements() {

			return array(
			
			    'arilewp_general_arcive_single_blog_heading' => array(
					'setting' => array(),
					'control' => array(
						'type'    => 'heading',
				   		'priority'        => 1,
						'label'   => esc_html__( 'Blog/Archive/Single', 'arilewp' ),
						'section' => 'arilewp_blog_general',
					),
				),

				'arilewp_general_blog_arcive_single_content_ordering' => array(
					'setting' => array(
						'default'           => array(
							'meta-one',
							'title',
							'meta-two',
						),
						'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_sortable' ),
					),
					'control' => array(
						'type'        => 'sortable',
						'priority'    => 5,
						'description' => esc_html__( 'Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'arilewp' ),
						'section'     => 'arilewp_blog_general',
						'choices'     => array(
							'meta-one' => esc_attr__( 'Meta One', 'arilewp' ),
							'title'          => esc_attr__( 'Title', 'arilewp' ),
							'meta-two'           => esc_attr__( 'Meta Two', 'arilewp' ),
						),
					),
				), 
				
				'arilewp_archive_blog_heading' => array(
					'setting' => array(),
					'control' => array(
						'type'    => 'heading',
				   		'priority'        => 15,
						'label'   => esc_html__( 'Archive Blog Pages', 'arilewp' ),
						'section' => 'arilewp_blog_general',
					),
				),  
				
				
					'arilewp_archive_blog_pages_layout' => array(
						'setting' => array(
							'default'           => 'arilewp_right_sidebar',
							'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_radio' ),
						),
						'control' => array(
							'type'            => 'radio_image',
							'priority'        => 20,
							'label'           => esc_html__( 'Layout', 'arilewp' ),
							'section'         => 'arilewp_blog_general',
							'choices'         => array(
								'arilewp_right_sidebar'   => ARILEWP_PARENT_INC_IMG_URI . '/theme-right-sidebar.png',
								'arilewp_left_sidebar'   => ARILEWP_PARENT_INC_IMG_URI . '/theme-left-sidebar.png',
								'arilewp_no_sidebar' => ARILEWP_PARENT_INC_IMG_URI . '/theme-fullwidth.png',
							),
						),
					),	
				
				'arilewp_single_blog_heading' => array(
					'setting' => array(),
					'control' => array(
						'type'    => 'heading',
				   		'priority'        => 30,
						'label'   => esc_html__( 'Single Blog Pages', 'arilewp' ),
						'section' => 'arilewp_blog_general',
					),
				),
				
				    'arilewp_single_blog_pages_layout' => array(
						'setting' => array(
							'default'           => 'arilewp_right_sidebar',
							'sanitize_callback' => array( 'ArileWP_Customizer_Sanitize', 'sanitize_radio' ),
						),
						'control' => array(
							'type'            => 'radio_image',
							'priority'        => 35,
							'label'           => esc_html__( 'Layout', 'arilewp' ),
							'section'         => 'arilewp_blog_general',
							'choices'         => array(
								'arilewp_right_sidebar'   => ARILEWP_PARENT_INC_IMG_URI . '/theme-right-sidebar.png',
								'arilewp_left_sidebar'   => ARILEWP_PARENT_INC_IMG_URI . '/theme-left-sidebar.png',
								'arilewp_no_sidebar' => ARILEWP_PARENT_INC_IMG_URI . '/theme-fullwidth.png',
							),
						),
					),
				

			);

		}

	}

	new ArileWP_Customize_Blog_General_Option();

endif;
