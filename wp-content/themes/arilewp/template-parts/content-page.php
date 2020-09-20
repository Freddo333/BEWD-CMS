<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arilewp
 */

?>

<article class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

	<?php arilewp_post_thumbnail(); ?>

	<div class="post-content">
	
	    <div class="entry-content">
			<?php
			the_content();
            
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'arilewp' ), 'after'  => '</div>', ) );
			
			?>
		</div><!-- .entry-content -->	
		
	</div><!-- .post-content -->

</article>