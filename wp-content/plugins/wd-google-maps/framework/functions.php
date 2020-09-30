<?php
// get option function
function gmwd_get_option($option_name)
{
    global $wpdb;

    if (get_option("gmwd_version")) {
        $query = "SELECT * FROM " . $wpdb->prefix . "gmwd_options ";
        $rows = $wpdb->get_results($query);

        $options = new stdClass();
        foreach ($rows as $row) {
            $name = $row->name;
            $value = $row->value !== "" ? $row->value : $row->default_value;
            $options->$name = $value;
        }

        return $options->$option_name;
    }

    return false;
}

/**
 * Generate top bar.
 *
 * @return string Top bar html.
 */
function topbar() {
  $page = isset($_GET['page']) ? esc_html($_GET['page']) : '';
  $task = isset($_GET["task"]) ? esc_html($_GET["task"]) : "";
  $user_guide_link = 'https://help.10web.io/hc/en-us/articles/';
  $show_guide_link = true;
  $description = "";
  switch ($page) {
    case "maps_gmwd":
      if ($task == "edit") {
        $user_guide_link .= '360018133851-Creating-Map';
        $description .= __('This section allows you to add/edit map.', 'gmwd');

      } else {
        $user_guide_link .= '360018133851-Creating-Map';
        $description .= __('This section allows you to create, edit and delete maps.', 'gmwd');
      }
      break;
    case 'options_gmwd': {
      $user_guide_link .= '360017853132-Configuring-Google-Maps-General-Settings';
      $description .= __('This section allows you to change general options.', 'gmwd');
      break;
    }
    case 'markercategories_gmwd': {
      $user_guide_link .= '360018135431-Creating-Marker-Categories';
      $description .= __('This section allows you to create and add marker categories to your WordPress Google Map.', 'gmwd');
      break;
    }
    case 'themes_gmwd': {
      $user_guide_link .= '360017854292-Modifying-Google-Maps-Themes';
      $description .= __('This section allows you to create a new or modifying theme/skin for your map.', 'gmwd');
      break;
    }
    default: {
      return '';
      break;
    }
  }
  $support_forum_link = 'https://wordpress.org/support/plugin/wd-google-maps/#new-post';
  $premium_link = 'https://10web.io/plugins/wordpress-google-maps/';
  wp_enqueue_style('gmwd-roboto');
  wp_enqueue_style('gmwd-pricing');
  ob_start();
  ?>
  <div class="wrap">
    <h1 class="head-notice">&nbsp;</h1>
    <div class="topbar-container">
      <div class="topbar topbar-content">
        <div class="topbar-content-container">
          <div class="topbar-content-title">
            <?php _e('Google Maps by 10Web Premium', 'gmwd'); ?>
          </div>
          <div class="topbar-content-body">
            <?php echo $description; ?>
          </div>
        </div>
        <div class="topbar-content-button-container">
          <a href="<?php echo $premium_link; ?>" target="_blank" class="topbar-upgrade-button"><?php _e( 'Upgrade','gmwd' ); ?></a>
        </div>
      </div>
      <div class="topbar_cont">
        <?php
        if ( $show_guide_link ) {
          ?>
          <div class="topbar topbar-links">
            <div class="topbar-links-container">
              <a href="<?php echo $user_guide_link; ?>" target="_blank" class="topbar_user_guid">
                <div class="topbar-links-item">
                  <?php _e('User guide', 'gmwd'); ?>
                </div>
              </a>
            </div>
          </div>
          <?php
        }
        ?>
        <div class="topbar topbar-links  topbar_support_forum">
          <div class="topbar-links-container">
            <a href="<?php echo $support_forum_link; ?>" target="_blank" class="topbar_support_forum">
              <div class="topbar-links-item">
                <img src="<?php echo GMWD_URL . '/images/help.svg'; ?>" class="help_icon" />
                <?php _e('Ask a question', 'gmwd'); ?>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php

  if ( $page == 'themes_gmwd' ) {
    ?>
    <div class="wd-text-right wd-row" style="color: #15699F; font-size: 20px; margin-top:10px; padding:0px 15px;">
      <?php echo __("This is FREE version, Customizing themes is available only in the PAID version.", "gmwd"); ?>
    </div>
    <?php
  } elseif ($page == 'markercategories_gmwd') {
    ?>
    <div class="wd-text-right wd-row" style="color: #15699F; font-size: 20px; margin-top:10px; padding:0px 15px;">
      <?php echo __("This is FREE version, Customizing marker categories is available only in the PAID version.", "gmwd"); ?>
    </div>
    <?php
  }

  echo ob_get_clean();
}

function api_key_notice()
{
    echo '<div style="width:99%">
                <div class="error">
                    <p style="font-size:18px;"><strong>' . __("Important. API key is required for Google Maps to work.", "gmwd") . '</strong></p>
                    <p style="font-size:18px;"><strong>' . __("To avoid limitation errors, fill in your own App key.", "gmwd") . '</strong></p>					
                   <p><a target="_blank" href=\'https://console.developers.google.com/henhouse/?pb=["hh-1","maps_backend",null,[],"https://developers.google.com",null,["maps_backend","geocoding_backend","directions_backend","distance_matrix_backend","elevation_backend","places_backend","static_maps_backend","roads","street_view_image_backend","geolocation"],null]\' class="wd-btn wd-btn-primary" style="text-decoration:none;" name="' . __("Generate API Key - ( MUST be logged in to your Google account )", "gmwd") . '">' . __("Generate Key", "gmwd") . '</a> or <a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,static_maps_backend,roads,street_view_image_backend,geolocation,places_backend&keyType=CLIENT_SIDE&reusekey=true">click here</a> to Get a Google Maps API KEY</p>
                    <p>' . __("For getting API key read more in", "gmwd") . '
                        <a href="https://help.10web.io/hc/en-us/articles/360017782751-Installation-Wizard-and-API-Configuration" target="_blank" style="color: #00A0D2;">' . __("User Manual", "gmwd") . '</a>.
                    </p> 
                    <p>After creating the API key, please paste it here.</p>
                    <form method="post">
                        ' . wp_nonce_field('nonce_gmwd', 'nonce_gmwd') . '
                        <p>' . __("API Key", "gmwd") . ' <input type="text" name="gmwd_api_key_general"> <button class="wd-btn wd-btn-primary">' . __("Save", "gmwd") . '</button></p>
                        <input type="hidden" name="task" value="save_api_key">
                        <input type="hidden" name="page" value="' . GMWDHelper::get("page") . '">
                        <input type="hidden" name="step" value="' . GMWDHelper::get("step") . '">
                    </form>
                    <p>' . __("It may take up to 5 minutes for API key change to take effect.", "gmwd") . '</p>
                </div>
          </div>';
}


?>