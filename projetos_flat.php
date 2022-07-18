<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Projetos_flat
 * @package WordPress
 * 
 */

get_header(); ?>

<?php rebirth_page_subheader(get_the_title()); ?>

<section class="container-page">

    <?php
    // Posts Per Page option
    $posts_per_page=3; 
    $post_count=wp_count_posts($post_type = 'projeto');
    $post_listed=0;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
    $args = array (
        'nopaging'               => false,
        'paged'                  => $paged,
        'posts_per_page'         => $posts_per_page,
        'post_type' => 'projeto'
    );

    // The Query
    $query = new WP_Query( $args );

    
    // The Loop
    ?>
    
    <?php 
            if ( $query->have_posts() ) {        
    ?>
 
       <div class="container">

           <div class="row row_ajuste">
               
               <?php  while ( $query->have_posts() ) {
                           $query->the_post();
               ?>
               
               
               

               <div class="gallery-full col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   
                     <?php 
                        if ( has_post_thumbnail() ) {        
                     ?> 
                    <a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                   
                    <figure class="figure-gallery-full">
                        
                               
                               <?php the_post_thumbnail( 'square-thumb',array( 'class' => 'thumb-responsive' ) );?>
                              
                        
                         
                         <figcaption class="caption-gallery-full">

                                  <div class="gallery-full-cap-text">
                                       <p></p>
                                       <i class="fa fa-search fa-3x" aria-hidden="true"></i>
                                   </div>              
                         </figcaption>
                    
                    </figure>
                    
                    </a>    
                        
                    <?php 
                         }
                     ?> 

               </div>
               
                <?php 
        
                    $post_listed=$post_listed+1;
                   }
                ?>

       </div> 
           
        <?php if ( $post_listed < $post_count->publish ) {?>       
                        
                 <div class="link-pages-container">
                       <ul class="nav-links" >

                           <?php
                             wp_pagination($query);
                           ?>
                      </ul>  
                 </div>
                    
        <?php } ?>  
           
    </div> 
    
     <?php 
            }
    ?>
    
</section>
    
<?php 
get_footer(); ?>