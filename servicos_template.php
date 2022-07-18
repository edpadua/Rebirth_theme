<section class="servicos-section">
                <div class="container">
                    <div class="section-title">
                           <h2>Serviços</h2>
                    </div>    
                    
                            <?php
                    $args = array(
                        'post_type' => 'servico',
                        'posts_per_page'=>'4'
                    );
                    $the_query = new WP_Query ( $args );
                    ?>
                    

                    
               
                </div>
    
                <div class="container">
                    <div id="services-list" class="row">
                        
                        <?php if ( have_posts() ) : while ( $the_query->have_posts() ) :
						$the_query->the_post(); ?>
                        <?php $servicos_meta_data = get_post_meta( $post->ID ); ?>
                        
                        <div class="icon-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="servico-box">
                                <div class="icons-ajuda-container" >
                                    <i class="fa <?php echo $servicos_meta_data['icone_id'][0]; ?> fa-3x space_list"></i>
                                </div>
                            
                                <div class="realizacao-texto">
                                    <div class="realizacao-titulo">
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                    <div class="realizacao_descricao">
                                         <p>
                                              <?php echo $servicos_meta_data['servico_id'][0]; ?>
                                         </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                  
                        
                        
                        <?php endwhile; ?>
                        <?php endif; ?>
                        
                    </div>
                    
                </div>
                
</section>