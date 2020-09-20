<?php
/**
 * Template part for displaying posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arilewp
 */
 $blog_content_ordering = get_theme_mod( 'arilewp_general_blog_arcive_single_content_ordering', array( 'meta-one', 'title',
		'meta-two', )); 
?>
<article class="post" <?php post_class(); ?>>		
		   <?php 
			if(has_post_thumbnail()){
			echo '<figure class="post-thumbnail">';
			the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
			echo '</figure>'; } ?>		
		    <div class="post-content">
			<?php foreach ( $blog_content_ordering as $blog_content_order ) : ?>	
			   <?php if ( 'meta-one' === $blog_content_order ) : ?>
				<div class="entry-meta">
				    <?php $category_data = get_the_category_list( esc_html__( ', ', 'arilewp' ) );
					if(!empty($category_data)) {
					echo '<span class="cat-links">' . $category_data . '</span>';
					} ?>
				</div>	
				<?php elseif ( 'title' === $blog_content_order ) : ?>
				<header class="entry-header">
	            <?php 
					the_title( '<h4 class="entry-title">', '</h4>' );
				?>
				</header>
				<?php elseif ( 'meta-two' === $blog_content_order ) : ?>
				<div class="entry-meta pb-2">
					<span class="author">
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) );?>"><span class="grey"><?php echo esc_html__('by ','arilewp');?></span><?php echo esc_html(get_the_author());?></a>	
					</span>
					<span class="posted-on">
					<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><time>
					<?php echo esc_html(get_the_date()); ?></time></a>
					</span>
				</div>
				<?php  endif; endforeach; ?>
			    <div class="entry-content">
				    <?php the_content( __('Read More','arilewp') );
					    wp_link_pages();?>
				</div>
				<?php $theme_tag_list = get_the_tag_list();
		        if(!empty($theme_tag_list)) { ?>
				<div class="entry-meta mt-4 mb-0 pt-3 theme-b-top">
					<span class="tag-links">
					<?php the_tags('',''); ?>
					</span>
				</div>
				<?php } ?>
		    </div>	
</article><!-- #post-<?php the_ID(); ?> -->