<?php 
/**
 * ArileWP Plugin
 *
 * @package arilewp
 */

if( class_exists( 'WP_Customize_Section' ) ) :
/**
 * Adding Plugin Section in Customizer
 */
class ArileWP_Customize_Recommended_Plugin_Section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'plugin-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $plugin_text = '';

	/**
	 * Custom plugin button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $plugin_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['plugin_text'] = $this->plugin_text;
		$json['plugin_url']  = esc_url( $this->plugin_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}
				<# if ( data.plugin_text && data.plugin_url ) { #>
					<a href="{{ data.plugin_url }}" class="button button-secondary alignright" target="_blank">{{ data.plugin_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;