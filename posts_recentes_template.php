<!-- Posts Recentes
    ================================================== -->
<?php   if( get_theme_mod( 'posts_general_show' )==1  && have_posts() ) {    ?>
            
            <section class="posts-section hideme">
                

                    <div class="section-title">
                       <h2>Últimas Notícias</h2>
                    </div>     

                    <div class="container" >
                        <div class="row">

                        <?php
                            // Posts Per Page option
                            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
                            $args = array (
                                'nopaging'               => false,
                                'paged'                  => $paged,
                                'posts_per_page'         => '3',
                                

                            );

                            // The Query
                            $query = new WP_Query( $args );

                            // The Loop
                            if ( $query->have_posts() ) { ?>

                            <?php  while ( $query->have_posts() ) {
                                $query->the_post();?>
                                    <div class="post-center col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <figure class="figure-grid">
                                                <?php 
                                                   if ( has_post_thumbnail( $_post->ID ) ) {
                                                       the_post_thumbnail( 'gallery-thumb',array( 'class' => 'thumb-responsive' ) );
                                                   } else {  ?>
                                                      <img class="thumb-responsive" src="<?php echo get_template_directory_uri() . '/img/thumb-default.jpg'; ?>" />
                                                <?php    } ?>
                                               
                                                
                                                <figcaption class="thumb-caption">
                                                    
                                                    <div class="thumb-caption-back">
                                                    </div>
                                                 <!--   <div class="info-thumb-projeto">
                                                        <h2 class="titulo-thumb"><?php echo the_title(); ?></h2>
                                                    </div>-->
                                                </figcaption>
                                            </figure>
                                        </a>
                                        <div class="post-thumb-text post-thumb-recent">
                                            <div class="recent-post-content">
                                                <div class="post-excerpt-title" >
                                                  <a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                        <?php echo the_title(); ?>
                                                  </a>
                                                </div>
                                                <div class="post-excerpt post-excerpt-height">
                                                   <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                            <div class="link-post">
                                               <a href="<?php the_permalink(); ?>">Ler mais ></a>
                                            </div>
                                            <div class="post-big-date"><i class="fa fa-calendar post-big-date-icon" aria-hidden="true"></i><?php echo the_time('F j, Y'); ?></div>
                                        </div>
                                    </div>
                              <?php /*  }*/

                             } }?>

                        </div>
                    </div>
                    
                    

                
                <div class="botton-section bottom-section-correction">
                    <a class="btn btn-section" href="<?php bloginfo('url'); ?>/blog/">Ver Todas</a>
                </div>
                <?php   }   ?>
			</section>