<?php
/**
 * Template Name: Locations Template Page
 *
 * Displays the Houses Template via the theme.
 *
 * @package UC
 * @subpackage BEWD
 * @since CMS Assignment
 */
get_header(); ?>

<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php
			while ( have_posts() ) : the_post();

				//the_content();
				?><h2><?php get_field( "title" );?></h2><?php
			?>
			
			<?php global $post; // required
				$args = array('category_name' => 'Locations'); // include post category Houses
				$custom_posts = get_posts($args);
				foreach($custom_posts as $post) : setup_postdata($post);  
				?><h4><a href='<?php echo '/wordpress/' . strtolower(implode('-', preg_split('/\s+/', get_field('house_name')))) . '/' . "'>"; the_field( "house_name" );?> </a></h4><?php
					echo $housename;
					echo"<div><p>";
					$maps = get_field('house_map');
					if (!empty($maps)):
						//$images = implode(',',$images);
						$maps_arr = explode (",", strval($maps));  
						?><img style="float:left; margin-right:20px; height:200px;" src="<?php echo $images_arr[0]; ?>" /><?php
					endif;
					the_field( "location_info" );
					echo"<br><br>";			
					the_field( "house_map" ); 
					//echo"<br><br>";
					echo"</p>";
					echo "</div><hr>";
				endforeach;
			endwhile;
			?>
        </div><!-- #content -->
    </div><!-- #primary -->

<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>