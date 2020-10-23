<?php
/**
 * Widget Class
 *
 * Handles latest News widget functionality of plugin
 *
 * @package WP News and Scrolling Widgets
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class SP_News_Widget extends WP_Widget {

	var $defaults;

	/**
	 * Sets up a new widget instance.
	 *
	 * @package WP News and Scrolling Widgets
	 * @since 1.0
	 */
	function __construct() {

		$widget_ops		= array('classname' => 'SP_News_Widget', 'description' => esc_html__('Displayed Latest News Items from the News  in a sidebar', 'sp-news-and-widget') );
		$control_ops	= array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_news_widget' );

		parent::__construct( 'sp_news_widget', esc_html__('Latest News Widget', 'sp-news-and-widget'), $widget_ops, $control_ops );

		$this->defaults = array(
			'limit'			=> 5,
			'title'			=> __('Latest News', 'sp-news-and-widget'),
			'date'			=> false, 
			'show_category'	=> false,
			'category'		=> 0,
		);
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @package WP News and Scrolling Widgets
	 * @since 1.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance					= $old_instance;
		$instance['title']			= isset( $new_instance['title'] ) 			? wpnw_clean( $new_instance['title'] ) 							: '';
		$instance['num_items']		= isset( $new_instance['category'] )		? wpnw_clean_number( $new_instance['num_items'], 5, 'number' )	: '';
		$instance['category']		= isset( $new_instance['category'] )		? wpnw_clean_number( $new_instance['category'] )				: '';
		$instance['date']			= ! empty( $new_instance['date'])			? 1	: 0;
		$instance['show_category']	= ! empty( $new_instance['show_category'] )	? 1	: 0;

		return $instance;
	}

	/**
	 * Outputs the settings form for the widget.
	 *
	 * @package WP News and Scrolling Widgets
	 * @since 1.0
	 */
	function form( $instance ) {

		$instance	= wp_parse_args( (array)$instance, $this->defaults );
		$num_items	= isset( $instance['num_items'] ) ? absint( $instance['num_items'] ) : 5;
		?>

		<div class="wpnw-widget-wrap">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e( 'Title', 'sp-news-and-widget' ); ?>:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items', 'sp-news-and-widget' ); ?>:<input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label>
			</p>

			<p>
				<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
			</p>

			<p>
				<input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
				<label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'sp-news-and-widget' ); ?>:</label>
				<?php
					$dropdown_args = array(
										'taxonomy'			=> WPNW_CAT,
										'show_option_none'	=> __('All Categories', 'sp-news-and-widget'),
										'option_none_value'	=> '',
										'class'				=> 'widefat',
										'id'				=> $this->get_field_id( 'category' ),
										'name'				=> $this->get_field_name( 'category' ),
										'selected'			=> $instance['category'],
									);
					wp_dropdown_categories( $dropdown_args );
				?>
			</p>
		</div>
	<?php
	}

	/**
	 * Outputs the content for the current widget instance.
	 *
	 * @package WP News and Scrolling Widgets
	 * @since 1.0
	 */
	function widget( $news_args, $instance ) {

		$instance 	= wp_parse_args( (array)$instance, $this->defaults );
		extract($news_args, EXTR_SKIP);

		$current_post_name	= get_query_var('name');
		$title				= empty( $instance['title'] )		? ''	: apply_filters('widget_title', $instance['title']);
		$num_items			= empty( $instance['num_items'] )	? '5'	: apply_filters('widget_title', $instance['num_items']);

		if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) {
			$date = "true";
		} else {
			$date = "false";
		}

		if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) {
			$show_category = "true";
		} else {
			$show_category = "false";
		}

		if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) {
			$category = intval( $instance['category'] );
		}

		$postcount = 0;

		echo $before_widget;
			
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// SiteOrigin Page Builder Gutenberg Block Tweak - Do not Display Preview
		if( isset( $_POST['action'] ) && ( $_POST['action'] == 'so_panels_layout_block_preview' || $_POST['action'] == 'so_panels_builder_content_json' ) ) {
			echo "Latest News";
			return;
		}

		// visual-columns
		$no_p = '';
		if($date == "false" && $show_category == "false"){ 
			$no_p = "no_p";
		} ?>

		<div class="recent-news-items <?php echo $no_p; ?>">
			<ul>
				<?php // setup the query
				$news_args = array(
					'posts_per_page'	=> $num_items,
					'post_type'			=> WPNW_POST_TYPE,
					'post_status'		=> array( 'publish' ),
					'order'				=> 'DESC'
				);

				if( ! empty( $category ) ) {
					$news_args['tax_query'] = array(
										array(
											'taxonomy'	=> WPNW_CAT,
											'field'		=> 'term_id',
											'terms'		=> $category,
										));
				}

				$cust_loop = new WP_Query( $news_args );

				global $post;

				$post_count	= $cust_loop->post_count;
				$count		= 0;

				if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;

					$count++;
					$terms		= get_the_terms( $post->ID, WPNW_CAT );
					$news_links	= array();

					if( $terms ) {
						foreach ( $terms as $term ) {
							$term_link		= get_term_link( $term );
							$news_links[]	= '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
					}
					$cate_name = join( ", ", $news_links ); ?>

					<li class="news_li">
						<a class="newspost-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

						<?php if($date == "true" ||  $show_category == "true"){ ?>
							<div class="widget-date-post">
								<?php echo ( $date == "true" )													? get_the_date()	: ""; ?>
								<?php echo ( $date == "true" && $show_category == "true" && $cate_name != '')	? " , "				: ""; ?>
								<?php echo ( $show_category == 'true' && $cate_name != '')						? $cate_name		: ""; ?>
							</div>
						<?php } ?>

					</li>

				<?php endwhile;
				endif;
				wp_reset_postdata(); ?>
			</ul>
		</div>
<?php
		echo $after_widget;
	}
}