<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Awaken
 */

get_header(); ?>


	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="post-thumb-text  container-page container-content">
				
                
                
				<h1 class="post-excerpt-title post-title title-not-found">Oops! Página não encontrada</h1>
                <div id="not-found-icon">
				    
                    <i class="fa fa-exclamation-triangle  fa-5x" aria-hidden="true"></i>
                
                </div>
				<div class="link-pages-container link-general">
                    Volte para <a href="<?php bloginfo('url'); ?>">página inicial</a>

				</div><!-- .page-content -->
                
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	
	


<?php get_footer(); ?>