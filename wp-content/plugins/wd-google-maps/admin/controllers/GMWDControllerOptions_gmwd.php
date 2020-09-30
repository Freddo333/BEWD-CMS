<?php

class GMWDControllerOptions_gmwd extends GMWDController {
  public function apply() {
    global $wpdb;
    $query = "SELECT name FROM " . $wpdb->prefix . "gmwd_options";
    // get option names
    $names = $wpdb->get_col($query, 0);
    // update options
    for ( $i = 0; $i < count($names); $i++ ) {
      $name = $names[$i];
      $value = isset($_POST[$name]) ? sanitize_text_field($_POST[$name]) : NULL;
      if ( $value !== NULL ) {
        $data = array();
        $data["value"] = $value;
        $where = array( "name" => $name );
        $where_format = $format = array( '%s' );
        $wpdb->update($wpdb->prefix . "gmwd_options", $data, $where, $format, $where_format);
      }
    }
    GMWDHelper::gmwd_redirect("admin.php?page=options_gmwd&message_id=10");
  }

  public function setup() {
    $this->view->gmwd_setup();
  }

  public function setup_general() {
    $this->view->gmwd_setup_general();
  }

  public function setup_ready() {
    $this->view->gmwd_setup_ready();
  }
}
