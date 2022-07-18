<!-- Depoimentos
    ================================================== -->
<section class="depo-section">
                <div class="container">
                    <div class="section-title">
                           <h2>Palavra do Cliente</h2>
                    </div>    
                    
                            <?php
                    $args = array(
                        'post_type' => 'depoimento',
                        
                    );
                    $the_query = new WP_Query ( $args );
                    ?>
                    <div>
                    <div id="carouselBlog" class="carousel" data-ride="carousel" data-interval="6000">
                        
                          <ol class="carousel-indicators">

                            <!-- the Loop -->
                           
                           <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                <li data-target="#carouselBlog"
                                    data-slide-to="<?php echo $the_query->current_post; ?>"
                                    class="<?php if ( $the_query->current_post == 0 ) : ?>active<?php endif; ?>"></li>
                            <?php endwhile; endif; ?>

				         </ol>
                        
                          <?php rewind_posts(); ?>
                        
                          <div class="carousel-inner" role="listbox">
                        
                          <?php query_posts('post_type=depoimento'); ?>
                          <?php if ( have_posts() ) : while ( $the_query->have_posts() ) :
						$the_query->the_post(); ?>
               
                            <div class="item <?php if ( $the_query->current_post == 0 ) : ?>active<?php endif; ?>">
                  
                                <div class="depo-text">  
                                     <i class="fa fa-quote-left" ></i>
                                     <blockquote>
                                     <p>
                                          <?php $depoimentos_meta_data = get_post_meta( $post->ID ); 
                                           echo $depoimentos_meta_data['depoimento_id'][0];

                                         ?>
                                     </p>
                                     </blockquote>
                                     <h3><?php echo $depoimentos_meta_data['autor_id'][0]; ?></h3>
                                </div>
                                
                            </div>
                            
                         
                         
                
                           <?php endwhile; ?>
                           <?php endif; ?>
                       </div>
                        
                     
                        
                        
                        <div class="carousel-navegation">
                          
                            <a class="left carousel-control" href="#carouselBlog" data-slide="prev">
                               <i class="glyphicon glyphicon-chevron-left"></i>
                            </a>
                            <a class="right carousel-control" href="#carouselBlog" data-slide="next">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </a>
                            
                        </div>
                        
                   </div>
                    
               
                </div>
                </div>
                
                
            </section>