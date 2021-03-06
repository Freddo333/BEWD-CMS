<?php
/**
 * Template Name: Architects Template Page
 *
 * Displays the Architects Template via the theme.
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
				$args = array('category_name' => 'Architects'); // include post category Architects
				$custom_posts = get_posts($args);
				foreach($custom_posts as $post) : setup_postdata($post);  
				?><h4><a href='<?php the_permalink(); echo"'>"; the_title(); ?></a></h4><?php
					echo'<div style="min-height:220px;"><p>';
					$images = get_field('architect_image');
					if (!empty($images)):
						//$images = implode(',',$images);
						$images_arr = explode (",", strval($images));  
						?><img style="float:left; margin-right:20px; height:200px;" src="<?php echo $images_arr[0]; ?>" /><?php
					endif;
					the_field( "architect_information" );
					echo"</p><br>";
					echo "</div><br><hr>";
				endforeach;
			endwhile;
			?>
        </div><!-- #content -->
    </div><!-- #primary -->

<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>