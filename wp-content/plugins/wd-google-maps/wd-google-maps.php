<?php

/**
 * Plugin Name: 10Web Google Maps
 * Plugin URI: https://10web.io/plugins/wordpress-google-maps/
 * Description: 10Web Google Maps is an intuitive tool for creating Google maps with advanced markers, custom layers and overlays for   your website.
 * Version: 1.0.64
 * Author: 10Web
 * Author URI: https://10web.io/plugins
 * License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

define('GMWD_DIR', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define('GMWD_NAME', plugin_basename(dirname(__FILE__)));
define('GMWD_URL', plugins_url(plugin_basename(dirname(__FILE__))));
define('GMWD_MAIN_FILE', plugin_basename(__FILE__));

require_once(GMWD_DIR . '/framework/functions.php');
if (is_admin()) {
    require_once('gmwd_admin_class.php');
    register_activation_hook(__FILE__, array('GMWDAdmin', 'gmwd_activate'));
    add_action('plugins_loaded', array('GMWDAdmin', 'gmwd_get_instance'));

    add_action('wp_ajax_add_marker', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_select_marker_icon', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_marker_size', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_polygon', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_polyline', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_circle', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_rectangle', array('GMWDAdmin', 'gmwd_ajax'));

    add_action('admin_enqueue_scripts', 'gmwd_register_admin_scripts');
    add_action('admin_enqueue_style', 'gmwd_register_admin_styles');
}


function gmwd_register_admin_scripts() {
  $version = get_option("gmwd_version");
  wp_register_script('polygons_gmwd', GMWD_URL . '/js/polygons_gmwd.js', array(), $version );
  wp_register_script('polylines_gmwd', GMWD_URL . '/js/polylines_gmwd.js', array(), $version );
  wp_register_script('simple-slider', GMWD_URL . '/js/simple-slider.js', array(), $version );
  wp_register_script('admin_main', GMWD_URL . '/js/admin_main.js', array(), $version );
  wp_register_script('markers_gmwd', GMWD_URL . '/js/markers_gmwd.js', array(), $version );
  wp_register_script('jscolor', GMWD_URL . '/js/jscolor/jscolor.js', array(), $version );

  wp_register_style( 'admin_main', GMWD_URL . '/css/admin_main.css', array(), $version );
  wp_register_style( 'simple-slider', GMWD_URL . '/css/simple-slider.css', array(), $version );

  wp_register_style('gmwd-pricing', GMWD_URL . '/css/pricing.css', array(), $version);
  wp_register_style('gmwd-roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700');


}

require_once('gmwd_class.php');

add_action('plugins_loaded', array('GMWD', 'gmwd_get_instance'));


add_action('wp_ajax_get_ajax_markers', array('GMWD', 'gmwd_frontend'));
add_action('wp_ajax_nopriv_get_ajax_markers', array('GMWD', 'gmwd_frontend'));
add_action('wp_ajax_get_ajax_store_loactor', array('GMWD', 'gmwd_frontend'));
add_action('wp_ajax_nopriv_get_ajax_store_loactor', array('GMWD', 'gmwd_frontend'));
add_action('wp_ajax_ajax_accept_gdpr', array('GMWD', 'gmwd_frontend'));
add_action('wp_ajax_nopriv_ajax_accept_gdpr', array('GMWD', 'gmwd_frontend'));


add_action('elementor/widgets/widgets_registered', 'register_elementor_widget');

//fires after elementor editor styles and scripts are enqueued.
add_action('elementor/editor/after_enqueue_styles', 'enqueue_editor_styles', 11);

// Register 10Web category for Elementor widget if 10Web builder doesn't installed.
add_action('elementor/elements/categories_registered', 'register_widget_category', 1, 1);

add_filter('tw_get_elementor_assets', 'register_elementor_assets');

function enqueue_editor_styles()
{
    $key = 'twbb-editor-styles';
    wp_deregister_style($key);
    $assets = apply_filters('tw_get_elementor_assets', array());
    wp_enqueue_style($key, $assets['css_path'], array(), $assets['version']);

}

/**
 * Register widget for Elementor builder.
 */
function register_elementor_widget()
{
    if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
        require_once(GMWD_DIR . '/admin/controllers/elementorWidget.php');
    }
}

/**
 * Register 10Web category for Elementor widget if 10Web builder doesn't installed.
 *
 * @param $elements_manager
 */
function register_widget_category($elements_manager)
{
    $elements_manager->add_category('tenweb-plugins-widgets', array(
        'title' => __('10WEB Plugins', 'tenweb-builder'),
        'icon'  => 'fa fa-plug',
    ));
}

function register_elementor_assets($assets)
{
    $version = '2.0.0';
    if (!isset($assets['version']) || version_compare($assets['version'], $version) === -1) {
        $assets['version'] = $version;
        $assets['css_path'] = GMWD_URL . '/css/gmwd_elementor_icon/gmwd_elementor_icon.css';
    }

    return $assets;
}



function gmwd_map($shortcode_id, $map_id)
{
    GMWD::gmwd_get_instance();
    $params = array();
    $params ['map'] = $map_id;
    $params ['id'] = $shortcode_id;

    $map_controller = new GMWDControllerFrontendMap($params);
    $map_controller->display();
}

require_once(GMWD_DIR . '/widgets.php');

function gmwd_bp_script_style()
{
    wp_enqueue_script('wd_bck_install', GMWD_URL . '/js/wd_bp_install.js', array('jquery'));
    wp_enqueue_style('wd_bck_install', GMWD_URL . '/css/wd_bp_install.css');
}

add_action('admin_enqueue_scripts', 'gmwd_bp_script_style');

/**
 * Show notice to install backup plugin
 */
function gmwd_bp_install_notice()
{
    if (get_option('wds_bk_notice_status') !== false) {
        update_option('wds_bk_notice_status', '1', 'no');
    }
    if (!isset($_GET['page']) || strpos(sanitize_text_field($_GET['page']), '_gmwd') === false) {
        return '';
    }

    $prefix = "gmwd";
    $meta_value = get_option('wd_bk_notice_status');
    if ($meta_value === '' || $meta_value === false) {
        ob_start();
        ?>
        <div class="notice notice-info" id="wd_bp_notice_cont">
            <p>
                <img id="wd_bp_logo_notice" src="<?php echo GMWD_URL . '/images/logo.png'; ?>">
                <?php _e("Google Maps advises:  Install brand new FREE", $prefix) ?>
                <a href="https://wordpress.org/plugins/backup-wd/" title="<?php _e("More details", $prefix) ?>"
                   target="_blank"><?php _e("Backup WD", $prefix) ?></a>
                <?php _e("plugin to keep your data and website safe.", $prefix) ?>
                <a class="button button-primary"
                   href="<?php echo esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=backup-wd'), 'install-plugin_backup-wd')); ?>">
                    <span onclick="wd_bp_notice_install()"><?php _e("Install", $prefix); ?></span>
                </a>
            </p>
            <button type="button" class="wd_bp_notice_dissmiss notice-dismiss"><span class="screen-reader-text"></span>
            </button>
        </div>
        <script>wd_bp_url = '<?php echo add_query_arg(array('action' => 'wd_bp_dismiss',), admin_url('admin-ajax.php')); ?>'</script>
        <?php
        echo ob_get_clean();
    }
}

if (!is_dir(plugin_dir_path(__DIR__) . 'backup-wd')) {
    add_action('admin_notices', 'gmwd_bp_install_notice');
}

/**
 * Add usermeta to db
 *
 * empty: notice,
 * 1    : never show again
 */
function gmwd_bp_install_notice_status()
{

    update_option('wd_bk_notice_status', '1', 'no');

}

add_action('wp_ajax_wd_bp_dismiss', 'gmwd_bp_install_notice_status');


function wd_gmwd_init()
{
    if (!isset($_REQUEST['ajax']) && is_admin()) {

        if (!class_exists("TenWebLib")) {
            require_once(GMWD_DIR . '/wd/start.php');
        }
        global $gmwd_options;
        $gmwd_options = array(
            "prefix"                 => "gmwd",
            "wd_plugin_id"           => 147,
            "plugin_id"              => 89,
            "plugin_title"           => "Google Maps",
            "plugin_wordpress_slug"  => "wd-google-maps",
            "plugin_dir"             => GMWD_DIR,
            "plugin_main_file"       => __FILE__,
            "description"            => __('Plugin for creating Google maps with advanced markers, custom layers and overlays for   your website.', 'gmwd'),
            // from web-dorado.com
            "plugin_features"        => array(
                0 => array(
                    "title"       => __("Easy set up", "gmwd"),
                    "description" => __("After installation a set-up guide will help you configure general options and get started on the dashboard. The plugin also displays tooltips in the whole admin area and settings. Moreover, you get instant live previews of changes you make in the working area, so you don’t have to save and publish maps to see the results.", "gmwd"),
                ),
                1 => array(
                    "title"       => __("Unlimited Everything", "gmwd"),
                    "description" => __("Display unlimited maps on any page or post. Same is true for markers, rectangles, circles, polygons and polylines.", "gmwd"),
                ),
                2 => array(
                    "title"       => __("100+ Marker Icons", "gmwd"),
                    "description" => __("Choose from 100+ readymade marker icons with different shapes and colors. Can’t find what you need? Create your own icons with the icon marker editor, setting background color and icon color or upload your own image.", "gmwd"),
                ),
                3 => array(
                    "title"       => __("Beautiful Maps Theme", "gmwd"),
                    "description" => __("Select or create a beautiful map theme that best fits your business and website needs. Choose from readymade themes or design your own map skin, by using the advanced editor.", "gmwd"),
                ),
                4 => array(
                    "title"       => __("Multilevel Marker Categories", "gmwd"),
                    "description" => __("Do you have a large number of markers on locations? Then the marker clustering option is for you! Add multiple marker categories and subcategories. Assign categories to markers quickly and easily by choosing from a dropdown menu.", "gmwd"),
                )
            ),
            // user guide from web-dorado.com
            "user_guide"             => array(
                0 => array(
                    "main_title" => __("Installation Wizard/ Options Menu", "gmwd"),
                    "url"        => "https://help.10web.io/hc/en-us/articles/360017782751-Installation-Wizard-and-API-Configuration",
                    "titles"     => array(
                        array(
                            "title" => __("Configuring Map API Key", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017782751-Installation-Wizard-and-API-Configuration"
                        )
                    )
                ),
                1 => array(
                    "main_title" => __("Creating Map", "gmwd"),
                    "url"        => "https://help.10web.io/hc/en-us/articles/360018133851-Creating-Map",
                    "titles"     => array()
                ),
                2 => array(
                    "main_title" => __("Settings", "gmwd"),
                    "url"        => "https://help.10web.io/hc/en-us/articles/360017853132-Configuring-Google-Maps-General-Settings",
                    "titles"     => array(
                        array(
                            "title" => __("General", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853132-Configuring-Google-Maps-General-Settings",
                        ),
                        array(
                            "title" => __("Controls", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853192-Google-Map-Controls",
                        ),
                        array(
                            "title" => __("Layers", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853312-Google-Maps-Layers",
                        ),
                        array(
                            "title" => __("Directions", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853372-Directions-Settings",
                        ),
                        array(
                            "title" => __("Store Locator", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853472-Store-Locator-Options",
                        ),
                        array(
                            "title" => __("Marker Listing", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853512-Google-Maps-Marker-Listing",
                        ),
                    )
                ),
                3 => array(
                    "main_title" => __("Map", "gmwd"),
                    "url"        => "https://help.10web.io/hc/en-us/articles/360018134351-Adding-Google-Maps-Attributes",
                    "titles"     => array(
                        array(
                            "title" => __("Adding Marker", "gmwd"),
                            "url"   => "https://web-dorado.com/wordpress-google-maps/map/adding-marker.html",
                        ),
                        array(
                            "title" => __("Adding Circle", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853652-Adding-Markers-to-Google-Maps",
                        ),
                        array(
                            "title" => __("Adding Rectangle", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360017853992-Adding-Rectangles",
                        ),
                        array(
                            "title" => __("Adding Polygon", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360018135011-Adding-Polygons-to-your-Google-Map",
                        ),
                        array(
                            "title" => __("Adding Polylines", "gmwd"),
                            "url"   => "https://help.10web.io/hc/en-us/articles/360018135091-Adding-Polylines",
                        ),
                    )
                ),
                4 => array(
                    "main_title" => __("Preview/Themes", "gmwd"),
                    "url"        => "https://help.10web.io/hc/en-us/articles/360017854292-Modifying-Google-Maps-Themes",
                    "titles"     => array()
                ),
                5 => array(
                    "main_title" => __("Creating Marker Categories", "gmwd"),
                    "url"        => "https://help.10web.io/hc/en-us/articles/360018135431-Creating-Marker-Categories",
                    "titles"     => array()
                ),
            ),
            "overview_welcome_image" => null,
            "video_youtube_id"       => "acaexefeP7o",  // e.g. https://www.youtube.com/watch?v=acaexefeP7o youtube id is the acaexefeP7o
            "plugin_wd_url"          => "https://10web.io/plugins/wordpress-google-maps/",
            "plugin_wd_demo_link"    => "https://demo.10web.io/google-maps/?_ga=2.107313026.1852679516.1550666932-1168307491.1539778623",
            "plugin_wd_addons_link"  => "https://10web.io/plugins/wordpress-google-maps/",
            "after_subscribe"        => "index.php?page=gmwd_setup", // this can be plagin overview page or set up page
            "plugin_wizard_link"     => admin_url('index.php?page=gmwd_setup'),
            "plugin_menu_title"      => "Google Maps",
            "plugin_menu_icon"       => GMWD_URL . '/images/icon-map-20.png',
            "deactivate"             => true,
            "subscribe"              => false,
            "custom_post"            => "maps_gmwd",  // if true => edit.php?post_type=contact
            "menu_capability"        => "manage_options",
            "menu_position"          => null,
            "display_overview"       => 0
        );

        ten_web_lib_init($gmwd_options);
    }

}

add_action('init', "wd_gmwd_init");

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'gmvd_add_ask_question_links' );

/**
 * Add plugin action links.
 *
 * Add a link to the settings page on the plugins.php page.
 *
 * @since 1.0.0
 *
 * @param  array  $links List of existing plugin action links.
 * @return array         List of modified plugin action links.
 */
function gmvd_add_ask_question_links ( $links ) {
  $url = 'https://wordpress.org/support/plugin/wd-google-maps/#new-post';
  $gmwd_ask_question_link = array('<a href="' . $url . '" target="_blank">' . __('Help', 'gmwd') . '</a>');
  return array_merge( $links, $gmwd_ask_question_link );
}

?>
