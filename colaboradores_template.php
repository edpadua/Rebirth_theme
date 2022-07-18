<section class="colaboradores-section">
                <div class="container">
                    <div class="section-title">
                           <h2>Colaboradores</h2>
                    </div>    
                    
                            <?php
                    $args = array(
                        'post_type' => 'colaborador',
                        'posts_per_page'=>'4'
                    );
                    $the_query = new WP_Query ( $args );
                    ?>
                    

                    
               
                </div>
    
                <div class="container">
                    <div id="services-list" class="row">
                        
                        <?php if ( have_posts() ) : while ( $the_query->have_posts() ) :
						$the_query->the_post(); ?>
                        <?php $colaboradores_meta_data = get_post_meta( $post->ID ); ?>
                        
                        <div class="col-realizacao icon-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
                          
                            <figure>
                                 <?php 
                                                   if ( has_post_thumbnail( $_post->ID ) ) {
                                                       the_post_thumbnail( 'gallery-thumb',array( 'class' => 'thumb-responsive' ) );
                                                   } else {  ?>
                                                      <img class="thumb-responsive" src="<?php echo get_template_directory_uri() . '/img/thumb-default.jpg'; ?>" />
                                                <?php    } ?>
                            </figure>
                            <div class="colaborador-texto">
                            <div class="colaborador-titulo">
                                <h2><?php the_title(); ?></h2>
                            </div>
                             <div class="colaborador-cargo">
                                 <h3>Tecnico</h3>
                             </div>
                             <div class="colaborador_descricao">
                             <p>
                                  <?php echo $colaboradores_meta_data['descricao_id'][0]; ?>
                             </p>
                             </div>
                        </div>
                            
                        </div>
                        
                        
                        <?php endwhile; ?>
                        <?php endif; ?>
                        
                    </div>
                    
                </div>
                
</section>