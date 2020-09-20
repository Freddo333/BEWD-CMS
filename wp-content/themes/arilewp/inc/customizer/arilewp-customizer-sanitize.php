<?php
/**
 * Customizer sanitize class.
 *
 * @package arilewp
 *
 * @access  public
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Customizer Sanitizes Initial setup
 */
class ArileWP_Customizer_Sanitize {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	// Sanitize Alpha Color control.
	public static function sanitize_alpha_color( $val ) {
		if ( '' === $val ) { return ''; }
		if ( is_string( $val ) && 'transparent' === trim( $val ) ) {
			return 'transparent';
		}
		if ( false === strpos( $val, 'rgba' ) ) {
			return sanitize_hex_color( $val );
		}
		$color = str_replace( ' ', '', $val );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $r, $g, $b, $a );
		return "rgba($r,$g,$b,$a)";
	}


	// Sanitize Dimensions control.
	public static function sanitize_dimensions( $val ) {
		if ( ! is_array( $val ) ) { return array(); }
		foreach ( $val as $key => $item ) {
			$val[ $key ] = sanitize_text_field( $item );
		}
		return $val;
	}

	// Sanitize Radio Buttonset control.
	public static function sanitize_radio( $val, $setting ) {
		$val = sanitize_key( $val );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return array_key_exists( $val, $choices ) ? $val : $setting->default;
	}


	// Sanitize Sortable control.
	public static function sanitize_sortable( $val = array(), $setting ) {
		if ( is_string( $val ) || is_numeric( $val ) ) {
			return array(
				esc_attr( $val ),
			);
		}
		$sanitized_value = array();
		foreach ( $val as $item ) {
			if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
				$sanitized_value[] = esc_attr( $item );
			}
		}
		return $sanitized_value;
	}

	// Sanitize checkbox.
	public static function sanitize_checkbox( $val ) {
		if ( '0' === $val || 'false' === $val ) {
			return false;
		}
		return (bool) $val;
	}

}

ArileWP_Customizer_Sanitize::get_instance();
