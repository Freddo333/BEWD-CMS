jQuery( document ).ready(function($) {

	/* Drag widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.preview-rendered', wpnw_fl_render_preview );

	/* Save widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.layout-rendered', wpnw_fl_render_preview );

	/* Publish button event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.didSaveNodeSettings', wpnw_fl_render_preview );
});

/* Function to render shortcode preview for Beaver Builder */
function wpnw_fl_render_preview() {
	news_scrolling_slider_init();
}