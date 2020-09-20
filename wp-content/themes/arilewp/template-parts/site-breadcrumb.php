<?php 
$arilewp_page_header_disabled = get_theme_mod('arilewp_page_header_disabled', true);
$arilewp_page_header_background_color = get_theme_mod('arilewp_page_header_background_color');
?>
<?php if($arilewp_page_header_disabled == true): ?>
<!-- Theme Page Header Area -->		
	<section class="theme-page-header-area">
	<?php if($arilewp_page_header_background_color != null): ?>
		<div class="overlay" style="background-color: <?php echo esc_attr($arilewp_page_header_background_color); ?>;"></div>
    <?php else: ?>
        <div class="overlay"></div>
	<?php endif; ?>	
		<div id="content" class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
				<?php 
                    if(is_home() || is_front_page()) {
                        echo '<div class="page-header-title text-center"><h1 class="text-white">'; echo single_post_title(); echo '</h1></div>';
                    } else{
                        arilewp_theme_page_header_title();
                    }
                    arilewp_page_header_breadcrumbs();				
				?>
				</div>
			</div>
		</div>	
	</section>	
<!-- Theme Page Header Area -->		
<?php endif; ?>