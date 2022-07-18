<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Blog
 * @package WordPress
 * 
 */

get_header(); ?>

<?php rebirth_page_subheader(get_the_title()); ?>

<section class="container-page">

    <?php
    // Posts Per Page option
    $posts_per_page=10; 
    $post_count=wp_count_posts();
    $post_listed=0;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
    $args = array (
        'nopaging'               => false,
        'paged'                  => $paged,
        'posts_per_page'         => $posts_per_page
    );

    // The Query
    $query = new WP_Query( $args );
   
    
    // The Loop
    ?>

       <div class="container">

       <div class="row">

           <div class="col-md-8 col-sm-12 col-xs-12 blog-list-containter">
                  <?php 
                        if ( $query->have_posts() ) {        
                  ?>
                     
                     <?php  while ( $query->have_posts() ) {
                           $query->the_post();
                           
                     ?>
                      
                         <div class="post-list-item">
                             
                             <?php 
                                   if ( has_post_thumbnail() ) {        
                             ?> 
                             
                             <figure class="figure-grid figure-blog">

                                 <a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                      <?php the_post_thumbnail( 'square-thumb',array( 'class' => 'thumb-responsive-blog' ) );?>
                                      <figcaption class="thumb-caption">
                                        <div class="thumb-caption-back">
                                        </div>

                                      </figcaption>

                                 </a>

                             </figure>
                              
                             <?php } ?>
                       
               
                         <?php 
                            if ( has_post_thumbnail( $_post->ID ) ) {?>
                                <div class="post-thumb-text post-thumb-text-blog">
                            <?php   } else {  ?>
                                <div class="post-thumb-text"> 
                            <?php    } 
                         ?>
                         
                         <div class="post-excerpt-title" >
                            <a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php echo the_title(); ?>
                            </a>
                        </div>
                            
                        <div class="post-big-date post-big-date-margin">
                          <i class="fa fa-calendar post-big-date-icon" aria-hidden="true"></i><?php echo the_time('F j, Y'); ?>
                        </div>  
                        <div class="link-post link-category">            
                        
                        <?php 
                            $categories = get_the_category();
                            $separator = ', ';
                            $output = '';
                            if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
                                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                            }
                              echo trim( $output, $separator );
                            }
                         ?>
                                    
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
                         
                           $post_listed=$post_listed+1;
                         
                       }?>
               
                  <?php if ( $post_listed < $post_count->publish ) {?>       
                        
                 <div class="link-pages-container">
                       <ul class="nav-links" >

                           <?php
                             wp_pagination($query);
                           ?>
                      </ul>  
                 </div>
                    
                  <?php } ?>  
                  <?php    
                        }
                        else {
                            // no posts found
                            echo '<h1 class="post-excerpt-title post-title realizacao-texto">Não há notícias para exibir</h1>';
                        }


                  ?>
           </div>
           
            
           
           <div class="col-md-4 col-sm-12 col-xs-12 blog-list-side-bar">
              <?php get_sidebar(); ?>
           </div>

       </div>

    </div> 
</section>
    
<?php 
get_footer(); ?>