<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php get_template_part( 'navigation', 'archive' ); ?>
			
				<?php if ( spacious_options( 'spacious_related_posts_activate', 0 ) == 1 ) {
				get_template_part( 'inc/related-posts' );
				}
				?>
				
				<?php if(in_category("Architects")): ?>
					<h2><b><?php the_field( "architect_name" );?></b></h2>
					<div>
						<?php if(!empty(get_field("architect_information"))): ?>
						<h2>Architect Information</h2>
						<img style="margin-left:auto; margin-right:auto; min-height:30vh; max-height:30vh;" src="<?php echo get_field( "architect_image" );?>">
						<p>
							<?php the_field( "architect_information" );?>
						</p>
						</br>
						<?php endif; ?>
						<?php if(!empty(get_field("education"))): ?>
						<h2>Education</h2>
						<p>
							<?php the_field( "education" );?>
						</p>
						</br>
						<?php endif; ?>
						<?php if(!empty(get_field("career"))): ?>
						<h2>Career</h2>
						<p>
							<?php the_field( "career" );?>
						</p>
						</br>
						<?php endif; ?>
						<?php if(!empty(get_field("publications"))): ?>
						<h2>Publications</h2>
						<p>
							<?php the_field( "publications" );?>
						</p>
						</br>
						<?php endif; ?>
						<?php if(!empty(get_field("awards"))): ?>
						<h2>Awards</h2>
						<p>
							<?php the_field( "awards" );?>
						</p>
						</br>
						<?php endif; ?>
						<?php if(!empty(get_field("canberra_works"))): ?>
						<h2>Canberra Works</h2>
						<?php
						$works = get_field('canberra_works');
						if($works): ?>
							<ul>
								<?php foreach( $works as $post ): 
									if(!empty($post)):
										setup_postdata($post); ?>
										<li>
												<div style="width:100%;display:flex;">
													<?php
														$images = get_field('houses-image');
														if (!empty($images)):
															$images = implode(',',$images);
															$images_arr = explode (",", strval($images)); 
													?>
														<img style="flex:0 0 25%;max-width:25%;" src="<?php echo $images_arr[0];?>">
													<?php endif; ?>
													<a style="font-size:2rem;flex:0 0 75%;max-width:75%;align-items:center;margin-left:15px;display:flex;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</div>
										</li>
									<?php endif;
								 endforeach; ?>
							</ul>
							<?php wp_reset_postdata(); 
						endif; ?>
						</br>
						<?php endif; ?>
						<?php if(!empty(get_field("other_works"))): ?>
						<h2>Other Works</h2>
						<p>
						<?php the_field( "other_works" );?>
						</p>
						<?php endif; ?>
						
					</div>
				<?php	endif; ?>
				
				<?php if(in_category("Houses")): ?>
					<h2><b><?php the_title();?></b></h2>
					<div>
						<p>
							<?php the_field( "houses-address" );?>
						</p>
						</br>
						<div>
							<h2>Images</h2>
							<?php
							$images = get_field('houses-image');
							if (!empty($images)):
								$images = implode(',',$images);
								$images_arr = explode (",", strval($images));  
								?>							
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0"style="background-color:#0FBE7C; border-color:#0FBE7C;" class="active"></li>
								<?php for($i= 1; $i < sizeof($images_arr); $i++){
									if (!empty($images_arr[$i])):
										?><li data-target="#myCarousel" style="background-color:#0FBE7C; border-color:#0FBE7C"data-slide-to="<?php echo $i;?>"></li><?php
									endif;  
								}?>
                            	</ol>
                            
                           		<!-- Wrapper for slides -->
                           		<div style="min-height:30vh; max-height:30vh;" class="carousel-inner">
	                               	<div class="item active">
    	                           	<img style="margin-left:auto; margin-right:auto; min-height:30vh; max-height:30vh;" src="<?php echo $images_arr[0]; ?>">
        	                       	</div>
            	               			<?php for($i= 1; $i < sizeof($images_arr); $i++){
											if (!empty($images_arr[$i])):?>
												<div class="item">
	                	                			<img style="margin-left:auto; margin-right:auto; min-height:30vh; max-height:30vh;" src="<?php echo $images_arr[$i]; ?>">
    	                	            		</div><?php
											endif;
										}?>
            	               	</div>
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" style="background:white !important" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" style="color:green;"></span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" style="background:white !important" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" style="color:green;"></span>
                            </a>
                            </div>
								<?php
							endif;?>
						</div>
						</br>
						<h2>About</h2>
						<p>
							<?php the_field( "houses-about" );?>
						</p>
						</br>
						<?php if  (!empty(get_field( "houses-significance" ))):?>
						<h2>Significance</h2>
						<p>
							<?php the_field( "houses-significance" );?>
						</p>
						</br>
						<?php endif; 
						if  (!empty(get_field( "houses-description" ))):?>
						<h2>Description</h2>
						<p>
							<?php the_field( "houses-description" );?>
						</p>
						</br>
						<?php endif; 
						if  (!empty(get_field( "houses-architect" ))):?>
						<h2>Architect</h2>
						<p>
							<a href='<?php the_field( "houses-architect" );?>'><?php the_field( "houses-architect" );?></a>
						</p>
						</br>
						<?php endif; 
						if  (!empty(get_field( "houses-source" ))):?>
						<h2>Source</h2>
						<p>
							<?php the_field( "houses-source" );?>
						</p>
						</br>
						<?php endif; 
						if  (!empty(get_field( "houses-acknowledgments" ))):?>
						<h2>Acknowledgments</h2>
						<p>
							<?php the_field( "houses-acknowledgments" );?>
						</p>
						</br>
						<?php endif; ?>
					</div>
				<?php	endif; ?>
					
				<?php
				if ( spacious_options( 'spacious_author_bio', 0 ) == 1 ) :
					if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="author-box clearfix">
							<div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
							<div class="author-description-wrapper">
								<h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>
								<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
							</div>
						</div>
					<?php endif;
				endif;
				?>

				<?php
					do_action( 'spacious_before_comments_template' );
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
	      		do_action ( 'spacious_after_comments_template' );
				?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->



	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>
