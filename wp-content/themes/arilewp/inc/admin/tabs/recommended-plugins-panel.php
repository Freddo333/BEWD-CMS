<?php
/**
 * Recommended Plugins Panel
 *
 * @package arilewp
 */
?>
<div id="recommended-plugins-panel" class="panel-left">
	<?php 
	$free_plugins = array(
		'arile-extra' => array(
		    'name'      => 'Arile Extra',
			'slug'     	=> 'arile-extra',
			'filename' 	=> 'arile-extra.php',
		),
	);
	if( !empty( $free_plugins ) ) { ?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach( $free_plugins as $plugin ) {
			$info 		= arilewp_call_plugin_api( $plugin['slug'] ); ?>
			<div class="recom-plugin-wrap mb-0">
				<div class="plugin-title-install clearfix">
					<span class="title" title="<?php echo esc_attr( $plugin['name'] ); ?>">
						<?php echo esc_html( $plugin['name'] ); ?>	
					</span>
					<p><?php esc_html_e('Arile Extra Plugin requires you to be highly recommended. And after installing it, you will be able to show all the front page features and, all business sections of the FrontPage.', 'arilewp'); ?></p>
					<?php 
					echo '<div class="button-wrap">';
					echo ArileWP_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $plugin['slug'] );
					echo '</div>';
					?>
				</div>
			</div>
			</br>
			<?php
		} ?>
		</div>
	<?php
	} ?>
</div>