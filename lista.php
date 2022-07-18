<?php
/* 
Template Name: Lista
*/
get_header(); ?>
<div class="post-main-title">
   <h1>Projetos</h1>
</div>
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
           
			<div class="container">
                       
              
                
                
<?php
// Posts Per Page option
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
$args = array (
    'nopaging'               => false,
    'paged'                  => $paged,
    'posts_per_page'         => '3',
    'post_type'              => 'projeto'
    
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) { ?>

  <div class="gallery-post-container">
      
    
      
  <?php  while ( $query->have_posts() ) {
        $query->the_post();
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <figure class="figure-grid">
        <?php the_post_thumbnail( 'gallery-thumb',array( 'class' => 'thumb-responsive' ) );?>
            <figcaption class="thumb-caption">
                <div class="thumb-caption-back">
                </div>
                <div class="info-thumb-projeto">
                   <h2 class="titulo-thumb"><?php echo the_title(); ?></h2>
                </div>
            </figcaption>
        </figure>
        </a>
       </div> <?php
    }?>
    </div> 
  <div class="link-pages-container">
       <ul class="link-pages-ul" >

        <?php
                             
             wp_pagination($query);
           ?>
      </ul>   
                
    
<?php    

} else {
    // no posts found
    echo '<h1 class="page-title screen-reader-text">No Posts Found</h1>';
}

   
?></div>
                
			</div><!-- .container -->
			
		</main>
	</div><!-- #primary -->

<?
php get_footer(); ?>