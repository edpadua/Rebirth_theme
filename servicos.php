<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Servicos
 * @package WordPress
 * 
 */

get_header(); ?>

<?php rebirth_page_subheader(get_the_title()); ?>
    <div class="container-page">
          
         <section class="serviços-section">
             
              
             
              <div class="container-servico">
                  <div id="services-list" class="row">
                  <?php query_posts('post_type=realizacao'); ?>
              <?php if(have_posts()):while(have_posts()):the_post(); ?>
               
                <div class="col-realizacao icon-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
                   <div class="realizacao-box">
                       <i class="fa <?php echo the_field('icone'); ?> fa-3x space_list"></i>
                       <div class="realizacao-texto">
                          <div class="realizacao-titulo">
                            <h2><?php the_title(); ?></h2>
                          </div>
                          <div class="realizacao_descricao">
                             <p>
                                   <?php the_field('descricao'); ?>
                             </p>
                          </div>
                       </div>
                   </div>             
                </div>
               <?php endwhile; ?>
               <?php endif; ?>
                        <?php /*dynamic_sidebar( 'services_widget_area' ); ?>
                        <?php 
                             $widgets_count = count($sidebars_widgets['services_widget_area']); */
                        ?>
                        
                  </div>
              </div>
          </section> 
        
          <section >
              <div class="container-gallery-realizacoes container-gallery">
                  
                <div class="section-title" >
                    <h2>Galeria de fotos</h2>
                </div>
                  
                <?php gallery_template("Realizações"); ?>
        
             </div>
          </section>    
        
            
    </div> 
<?php get_footer(); ?>