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
 * Class ArileWP_Customize_Upgrade_Control
 */
class ArileWP_Customize_Upgrade_Control extends ArileWP_Customize_Base_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'arilewp-upgrade';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		$upgrade_to_pro_link = 'https://themearile.com/arilewp-pro-theme/';
		?>

		<div class="arilewp-upgrade-pro-message" style="display:none;";>
			<# if ( data.label ) { #><h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="'.$upgrade_to_pro_link.'" target="_blank" > ArileWP Pro </a> to be add more', 'arilewp'); ?> {{{ data.label }}} <?php esc_html_e( 'and get the other pro features.', 'arilewp') ?></h4><# } #>
		</div>

		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}