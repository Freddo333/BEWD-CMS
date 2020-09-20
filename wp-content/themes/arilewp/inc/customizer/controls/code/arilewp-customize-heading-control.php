<?php
/**
 * Customize Heading control class.
 *
 * @package arilewp
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class ArileWP_Customize_Heading_Control
 */
class ArileWP_Customize_Heading_Control extends ArileWP_Customize_Base_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'arilewp-heading';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		?>

		<h4>
			<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
		</h4>

		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}
