<?php
/**
 * Getting Started Panel.
 *
 * @package ArileWP
 */
?>
<div id="getting-started-panel" class="panel-left visible">
    <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Recommended actions', 'arilewp' ); ?></h4>
        <p><?php esc_html_e( 'We have compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow. So kindly activate the plugin Arile Extra.', 'arilewp' ); ?></p>
		<a class="recommended-actions hyperlink" href="#actions"><?php esc_html_e( 'Check recommended actions', 'arilewp' ); ?></a>
    </div> 
    <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Extensive Documentation', 'arilewp' ); ?></h4>
        <p><?php esc_html_e( 'Read detailed documentation of the theme. The documentation has all the necessary information to set up the theme. Which will help you set up the theme.', 'arilewp' ); ?></p>
        <a href="//helpdoc.themearile.com/" class="hyperlink" title="<?php esc_attr_e( 'Visit the Support', 'arilewp' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'arilewp' ); ?></a>
    </div>
   <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Go to the Customizer', 'arilewp' ); ?></h4>
        <p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every single aspect of the theme.', 'arilewp' ); ?></p>
        <a class="button button-primary" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'arilewp' ); ?>"><?php esc_html_e( 'Go to the Customizer', 'arilewp' ); ?></a>
    </div>
</div>