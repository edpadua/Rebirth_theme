<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Blog
 * @package WordPress
 * 
 */

get_header(); ?>


   <?php if(have_posts()) :?>
			<!--<div class="col-md-12">-->
			<h1 ><?php 
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
                    $posts_per_page=3;
                    if ( is_category() ) :
				        rebirth_page_subheader_blog('Notícias', get_query_var('category_name'));
						
                          $args = array (
                        'nopaging'               => false,
                        'paged'                  => $paged,
                        'posts_per_page'         => $posts_per_page,
                        'cat' => get_query_var('cat')
                        
                    );
                    elseif ( is_day() ) :
                        rebirth_page_subheader_blog('Notícias', get_the_date( ));
						/*printf( __( 'Notícias - %s', 'rebirth-theme' ), '<span>' . get_the_date() . '</span>' );*/
                          $args = array (
                        'nopaging'               => false,
                        'paged'                  => $paged,
                        'posts_per_page'         => $posts_per_page,
                        'year' => get_query_var('year'),
                        'monthnum' => get_query_var('monthnum'),
                        'day'=> get_query_var('day')
                    );
					elseif ( is_month() ) :
                        rebirth_page_subheader_blog('Notícias', get_the_date( _x( 'F Y', 'monthly archives date format', 'rebirth-theme' ) ));
						/*printf( __( 'Notícias - %s', 'rebirth-theme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'rebirth-theme' ) ) . '</span>' );*/
                         $args = array (
                         'date_pagination_type' => 'monthly',
                        'nopaging'               => false,
                        'paged'                  => $paged,
                        'posts_per_page'         => $posts_per_page,
                        'year' => get_query_var('year'),
                        'monthnum' => get_query_var('monthnum')
                    );
					elseif ( is_year() ) :
                        rebirth_page_subheader_blog('Notícias', get_the_date( _x( 'Y', 'yearly archives date format', 'rebirth-theme' ) ));
						/*printf( __( 'Notícias - %s', 'rebirth-theme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'rebirth-theme' ) ) . '</span>' );*/
                          $args = array (
                        'nopaging'               => false,
                        'paged'                  => $paged,
                        'posts_per_page'         => $posts_per_page,
                        'year' => get_query_var('year')
                    );
					else :
						_e( 'Archives', 'rebirth-theme' );
					endif; ?>
			</h1>
       
		<?php endif; ?>	

<section class="container-page">

    <?php
    // Posts Per Page option
 /*   $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
    $args = array (
        'nopaging'               => false,
        'paged'                  => $paged,
        'posts_per_page'         => '3'

    );*/

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) { ?>

       <div class="blog-container">

            <div class="row">

                <div class="col-md-8 col-sm-12 col-xs-12 blog-list-containter">



                <?php  while ( $query->have_posts() ) {
                    $query->the_post();
                ?>
                   <div class="post-list-item">

                      <figure class="figure-grid figure-blog">
                         <a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                         <?php the_post_thumbnail( 'square-thumb',array( 'class' => 'thumb-responsive-blog' ) );?>
                         <figcaption class="thumb-caption">
                         <div class="thumb-caption-back">
                         </div>
                 
                         </figcaption>
                         </a>
                     </figure>


                     <?php 
                     if ( has_post_thumbnail( $_post->ID ) ) {?>
                        <div class="post-thumb-text post-thumb-text-blog">
                    <?php   } else {  ?>
                           <div class="post-thumb-text"> 
                    <?php    } ?>

                               <div class="post-excerpt-title" >
                                  <a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php echo the_title(); ?>
                                  </a>
                               </div>
                               <div class="post-big-date post-big-date-margin">
                                   <i class="fa fa-calendar post-big-date-icon" aria-hidden="true"></i><?php echo the_time('F j, Y'); ?>
                               </div>  
                               <div class="post-excerpt post-excerpt-padding">
                                   <?php the_excerpt(); ?>
                               </div>
                               <div class="link-post">
                                   <a href="<?php the_permalink(); ?>">Ler mais ></a>
                               </div>

                          </div>

                       </div>
                 
        <?php
        }?>

                     </div> 
                 
                     <div class="col-md-4 col-sm-12 col-xs-12">
                         <?php get_sidebar(); ?>
                     </div>


                </div>

                <div class="link-pages-container">
                   <ul class="nav-links" >

                    <?php

                         wp_pagination($query);
                    ?>

                  </ul>   
        

    <?php    

    } else {
        // no posts found
        echo '<h1 class="page-title screen-reader-text">No Posts Found</h1>';
    }


    ?>        </div>       

           </div>

    </div> 

</section>
    
<?php 
get_footer(); ?>