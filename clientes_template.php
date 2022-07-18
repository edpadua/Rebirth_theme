<!-- Depoimentos
    ================================================== -->
<section class="clientes-section">
                <div class="container">
                    <div class="section-title">
                           <h2>Clientes</h2>
                    </div>    
                    
                            <?php
                    $args = array(
                        'post_type' => 'cliente',
                        
                    );
                    $the_query = new WP_Query ( $args );
                    $count = $the_query->post_count;
                    ?>
                    
                   <div class="linha-carousel">
                    <div>
                      
                     <div class="carousel carousel-showmanymoveone slide" id="carousel_logos" count="<?php echo $count; ?>">
                        <div class="carousel-inner carousel-linha">
                            
                          <?php query_posts('post_type=depoimento'); ?>
                          <?php if ( have_posts() ) : while ( $the_query->have_posts() ) :
						   $the_query->the_post(); ?>
                          
                           <div class="item <?php if ( $the_query->current_post == 0 ) : ?>active<?php endif; ?>">
                              <div class="col-xs-12 col-sm-6 col-md-3 logo_box">
                                <a href="#"> 
                                   <?php the_post_thumbnail( 'medium_large' );?>
                                </a>
                              </div>
                          </div>
                            
                        
                            
                          <?php endwhile; ?>
                          <?php endif; ?>
                            
                        </div>
                       
                        <div class="carousel-navegation">
                          
                            <a class="left carousel-control" href="#carousel_logos" data-slide="prev">
                               <i class="glyphicon glyphicon-chevron-left"></i>
                            </a>
                            <a class="right carousel-control" href="#carousel_logos" data-slide="next">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </a>
                            
                        </div>
                          
                      </div>
                    </div>
                  </div>
                
</section>