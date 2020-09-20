<?php
/**
 * Useful Plugin Panel
 *
 * @package ArileWP
 */
?>
<div id="useful-plugin-panel" class="panel-left">
	<?php 
	$free_plugins = array(
		'contact-form-7' => array(
		    'name'      => 'Contact form 7',
			'slug'     	=> 'contact-form-7',
			'filename' 	=> 'contact-form-7.php',
		),
		'woocommerce' => array(
		    'name'     	=> 'Woocommerce',
			'slug'     	=> 'woocommerce',
			'filename' 	=> 'woocommerce.php',
		),
		'elementor' => array(
		    'name'     	=> 'Elementor',
			'slug'     	=> 'elementor',
			'filename' 	=> 'elementor.php',
		),
	);
	if( !empty( $free_plugins ) ) { ?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach( $free_plugins as $plugin ) {
			$info 		= arilewp_call_plugin_api( $plugin['slug'] ); ?>
			<div class="recom-plugin-wrap w-3-col">
				<div class="plugin-title-install clearfix">
					<span class="title" title="<?php echo esc_attr( $plugin['name'] ); ?>">
						<?php echo esc_html( $plugin['name'] ); ?>	
					</span>
					<?php if($plugin['slug'] == 'contact-form-7') : ?>
					<p><?php esc_html_e('Contact form 7 is the most popular plugin. And ArileWP theme is fully compatible with this plugin. By using this plugin you will be able to create an amazing contact form on your website.', 'arilewp'); ?></p>
					<?php endif; ?>
					
					<?php if($plugin['slug'] == 'woocommerce') : ?>
					<p><?php esc_html_e('Do you want to sell your product online? ArileWP is the fully WooCommerce compatible theme, through which you can easily create your online store and sell your products online.', 'arilewp'); ?></p>
					<?php endif; ?>
					
				    <?php if($plugin['slug'] == 'elementor') : ?>
					<p><?php esc_html_e('Elementor is the World best WordPress Page Builder, So you can create beautiful pages with intuitive drag and drop interface. And make pixel perfect websites at record speeds.', 'arilewp'); ?></p>
					<?php endif; ?>	
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