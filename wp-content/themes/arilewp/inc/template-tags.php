<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package arilewp
 */
 
function arilewp_header_logo() {
	$arilewp_sticky_bar_logo = get_theme_mod('arilewp_sticky_bar_logo');
		the_custom_logo(); 
	?>
					
	<?php if($arilewp_sticky_bar_logo != null) : ?>	
			<a class="sticky-navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($arilewp_sticky_bar_logo); ?>" class="custom-logo" alt="<?php esc_attr(bloginfo("name")); ?>"></a>
	<?php endif; ?>
	
    <?php if ( display_header_text() ) : ?>
	<div class="site-branding-text">
	    <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_attr(bloginfo( 'name' )); ?></a></h2>
		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo esc_html( $description ); ?></p>
		<?php endif; ?>
	</div>
	<?php endif;
} 

function arilewp_header_logo_class($html)
{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
}
add_filter('get_custom_logo','arilewp_header_logo_class');

if ( ! function_exists( 'arilewp_comment' ) ) :
function arilewp_comment( $comment, $args, $depth ) 
{
	//get theme data
	global $comment_data;

	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	__('Reply','arilewp');?>
	
        <div <?php comment_class('media comment-box'); ?> id="comment-<?php comment_ID(); ?>">
			<a class="pull-left-comment">
            <?php echo get_avatar($comment); ?>
            </a>
            <div class="media-body">
			   <div class="comment-detail">
				<h5 class="comment-detail-title"><?php printf(('%s'), get_comment_author_link()) ?>
				<time class="comment-date">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) );?>">
				<?php comment_date('F j, Y');?>&nbsp;<?php esc_html_e('at','arilewp');?>&nbsp;<?php comment_time('g:i a'); ?>
				</a>
				</time></h5>
				<?php comment_text() ;?>
				<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'arilewp' ); ?></em>
				<br/>
				<?php endif; ?>
				</div>
			</div>
		</div>
<?php
}
endif;
add_filter('get_avatar','arilewp_gravatar_class');
function arilewp_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-fluid comment-img", $class);
    return $class;
}

function arilewp_read_more_button_class($read_class)
	{  global $post;
		return '<p><a href="' . esc_url( get_permalink() ) . "#more-{$post->ID}\" class=\"more-link\">" .__('Read More','arilewp')."</a></p>";
	}
add_filter( 'the_content_more_link', 'arilewp_read_more_button_class' );

function arilewp_post_thumbnail() {
    if(has_post_thumbnail()){
	    echo '<figure class="post-thumbnail"><a href="'.esc_url( get_the_permalink() ).'">';
		the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
		echo '</a></figure>';
	}
}

// theme page header title functions
function arilewp_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<div class="page-header-title text-center"><h1 class="text-white">';
		if ( is_day() ) :
		/* translators: %1$s %2$s: day */
		  printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Archives','arilewp'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */
		  printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Archives','arilewp'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */
		  printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Archives','arilewp'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */
			printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('All posts by','arilewp'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */
			printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Category','arilewp'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */
			printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Tag','arilewp'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */
			printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Shop','arilewp'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1 class="text-white">', '</h1>' ); 
		endif;
		echo '</h1></div>';
	}
	elseif( is_404() )
	{
		echo '<div class="page-header-title text-center"><h1 class="text-white">';
		/* translators: %1$s: 404 */
		printf( esc_html__( '%1$s', 'arilewp' ) , esc_html__('404','arilewp') );
		echo '</h1></div>';
	}
	elseif( is_search() )
	{
		echo '<div class="page-header-title text-center"><h1 class="text-white">';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'arilewp' ), esc_html__('Search results for','arilewp'), get_search_query() );
		echo '</h1></div>';
	}
	else
	{
		echo '<div class="page-header-title text-center"><h1 class="text-white">'.esc_html( get_the_title() ).'</h1></div>';
	}
}

function arilewp_bootstrap_menu_notitle( $menu ){
  return $menu = preg_replace('/ title=\"(.*?)\"/', '', $menu );
}
add_filter( 'wp_nav_menu', 'arilewp_bootstrap_menu_notitle' );

// theme page header Url functions
function arilewp_curPageURL() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}

// theme page header breadcrumbs functions
if( !function_exists('arilewp_page_header_breadcrumbs') ):
	function arilewp_page_header_breadcrumbs() { 	
		global $post;
		$home_Link = home_url();
	    echo '<ul class="page-breadcrumb text-center">';			
				if (is_home() || is_front_page()) :
					echo '<li><a href="'.esc_url($home_Link).'">'.esc_html__('Home','arilewp').'</a></li>';
					    echo '<li class="active">'; echo single_post_title(); echo '</li>';
						else:
						echo '<li><a href="'.esc_url($home_Link).'">'.esc_html__('Home','arilewp').'</a></li>';
						if ( is_category() ) {
							echo '<li class="active"><a href="'. arilewp_curPageURL() .'">' . esc_html__('Archive by category','arilewp').' "' . single_cat_title('', false) . '"</a></li>';
						} elseif ( is_day() ) {
							echo '<li class="active"><a href="'. esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">'. esc_html(get_the_time('Y')) .'</a>';
							echo '<li class="active"><a href="'. esc_url(get_month_link(esc_attr(get_the_time('Y')),esc_attr(get_the_time('m')))) .'">'. esc_html(get_the_time('F')) .'</a>';
							echo '<li class="active"><a href="'. arilewp_curPageURL() .'">'. esc_html(get_the_time('d')) .'</a></li>';
						} elseif ( is_month() ) {
							echo '<li class="active"><a href="' . get_year_link(esc_attr(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>';
							echo '<li class="active"><a href="'. arilewp_curPageURL() .'">'. esc_html(get_the_time('F')) .'</a></li>';
						} elseif ( is_year() ) {
							echo '<li class="active"><a href="'. arilewp_curPageURL() .'">'. esc_html(get_the_time('Y')) .'</a></li>';
                        } elseif ( is_single() && !is_attachment() && is_page('single-product') ) {
						if ( get_post_type() != 'post' ) {
							$cat = get_the_category(); 
							$cat = $cat[0];
							echo '<li>';
								echo get_category_parents($cat, TRUE, '');
							echo '</li>';
							echo '<li class="active"><a href="' . arilewp_curPageURL() . '">'. wp_title( '',false ) .'</a></li>';
						} }  
						elseif ( is_page() && $post->post_parent ) {
							$parent_id  = $post->post_parent;
							$breadcrumbs = array();
							while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = '<li class="active"><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
							$parent_id  = $page->post_parent;
                            }
							$breadcrumbs = array_reverse($breadcrumbs);
							foreach ($breadcrumbs as $crumb) echo $crumb;
							echo '<li class="active"><a href="' . arilewp_curPageURL() . '">'. get_the_title().'</a></li>';
                        }
						elseif( is_search() )
						{
							echo '<li class="active"><a href="' . arilewp_curPageURL() . '">'. get_search_query() .'</a></li>';
						}
						elseif( is_404() )
						{
							echo '<li class="active"><a href="' . arilewp_curPageURL() . '">'.esc_html__('Error 404','arilewp').'</a></li>';
						}
						else { 
						    echo '<li class="active"><a href="' . arilewp_curPageURL() . '">'. get_the_title() .'</a></li>';
						}
					endif;
			echo '</ul>';
        }
endif;
 
 if ( ! function_exists( 'arilewp_sanitize_select' ) ) :
	/**
	 * Sanitize select, radio.
	 *
	 */
	function arilewp_sanitize_select( $input, $setting ) {
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

function arilewp_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}

if( ! function_exists( 'arilewp_custom_customizer_options' ) ):
    function arilewp_custom_customizer_options() {

        $arilewp_testomonial_background_image = get_theme_mod('arilewp_testomonial_background_image');
		$arilewp_page_header_background_image = get_theme_mod('arilewp_page_header_background_image');
		$arilewp_sticky_bar_logo = get_theme_mod('arilewp_sticky_bar_logo');
        
        $output_css = '';
		if($arilewp_testomonial_background_image != null){ 
			$output_css .="	.theme-testimonial { 
				background-image: url( " .esc_url($arilewp_testomonial_background_image). ");
				background-size: cover;
				background-position: center center;
			}\n";
        }

		if ( has_header_image() ) :
			$output_css .=".theme-page-header-area {
				background: #17212c url(" .esc_url( get_header_image() ). ");
				background-attachment: scroll;
				background-position: top center;
				background-repeat: no-repeat;
				background-size: cover;
			}\n";
		endif; 

        if($arilewp_sticky_bar_logo != null) :
            $output_css .=".header-fixed-top .navbar-brand {
				display: none !important;
			}
            .not-sticky .sticky-navbar-brand {
				display: none !important;
			}\n";
        endif;
		
		if ( is_user_logged_in() && is_admin_bar_showing() ) {
            $output_css .="@media (min-width: 600px){
                .navbar.header-fixed-top{top:32px;}
            }\n";
        }

        wp_add_inline_style( 'arilewp-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'arilewp_custom_customizer_options' );


add_action( 'after_switch_theme', 'arilewp_import_theme_mods_from_child_themes_to_parent_theme' );

/**
* Import theme mods
*/
function arilewp_import_theme_mods_from_child_themes_to_parent_theme() {

    // Get the name of the previously active theme.
    $previous_theme = strtolower( get_option( 'theme_switched' ) );

    if ( ! in_array(
        $previous_theme, array(
            'business-street',
			'strangerwp',
			'newyork-city',
        )
    ) ) {
        return;
    }

    // Get the theme mods from the previous theme.
    $previous_theme_content = get_option( 'theme_mods_' . $previous_theme );

    if ( ! empty( $previous_theme_content ) ) {
        foreach ( $previous_theme_content as $previous_theme_mod_k => $previous_theme_mod_v ) {
            set_theme_mod( $previous_theme_mod_k, $previous_theme_mod_v );
        }
    }
}