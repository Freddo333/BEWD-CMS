<?php

class GMWDElementor extends \Elementor\Widget_Base {
  /**
   * Get widget name.
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'gmwd-elementor';
  }

  /**
   * Get widget title.
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __('Google Maps WD', 'gmwd');
  }

  /**
   * Get widget icon.
   *
   * @return string Widget icon.
   */
  public function get_icon() {
      return 'twbb-map twbb-widget-icon';
  }

  /**
   * Get widget categories.
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'tenweb-plugins-widgets' ];
  }

  public function gmwd_get_maps() {
    global $wpdb;
    $results = $wpdb->get_results("SELECT `id`,`title` FROM `" . $wpdb->prefix . "gmwd_maps`", OBJECT_K);
    $maps = array();
    foreach ($results as $id => $map) {
      $maps[$id] = isset($map->title) ? $map->title : '';
    }
    return $maps;

  }

  /**
   * Register widget controls.
   */
  protected function _register_controls() {
    $this->start_controls_section(
      'general',
      [
        'label' => __('Google Maps WD', 'gmwd'),
      ]
    );
    $maps = $this->gmwd_get_maps();
    $maps[0] = __('Select Map', 'gmwd');
    $this->add_control(
      'maps',
      [
        'label_block' => TRUE,
        'show_label' => FALSE,
        'description' => __('Select the map to display.', 'gmwd') . ' <a target="_blank" href="' . add_query_arg(array( 'page' => 'maps_' . 'gmwd' ), admin_url('admin.php')) . '">' . __('Edit map', 'gmwd') . '</a>',
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 0,
        'options' => $maps,
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Render widget output on the frontend.
   */
  protected function render() {
    $settings = $this->get_settings_for_display();
    include_once GMWD_DIR.'/gmwd_class.php';
    $params = array();
    $params['map'] = intval( $settings['maps'] );
    $params['id'] = wp_rand( 1, 999999 );
    GMWD::gmwd_frontend( $params );
  }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new GMWDElementor());
