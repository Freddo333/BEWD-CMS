<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

	<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<div style="margin:25px;">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<p>
					<?php get_template_part( 'content', get_post_format() ); ?>
					</p>
					</br> 
				<?php endwhile; ?>

				<?php get_template_part( 'navigation', 'search' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>
</div>
		</div><!-- #content -->
	</div><!-- #primary -->

	<?php spacious_sidebar_select(); ?>

	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>
