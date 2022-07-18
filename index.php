<?php get_header(); ?>
<div  class="content-area">
		<main id="main" class="site-main" role="main">
         
         <?php get_template_part('slider_parallax'); ?>
           
         <?php get_template_part('servicos_template'); ?>
			
         <?php get_template_part('colaboradores_template'); ?>
          
         <?php  get_template_part('posts_recentes_template'); ?>
            
         <?php  get_template_part('depoimentos_template'); ?>
            
         <?php  get_template_part('clientes_template'); ?>
            
         <?php  gallery_full_template_slider("Teste"); ?>
            
            <section>
              <div class="contact-box info-box">
                   <h3>Contact Box</h3>
                   <div class="contact-box_wrapper">
                       <ul>
                           <li>
                               <div class="line-contact row">
                                  <span class="icon-contact-box">
                                      <i class="fa fa-map-marker" ></i>
                                  </span>
                                  <span class="contact-data"><strong>Envato</strong><br> Level 13, 2 Elizabeth St,<br> Melbourne, Victoria 3000 Australia
                                  </span>
                              </div>
                           </li>
                           <li>
                              <div class="line-contact row">
                                  <span class="icon-contact-box">
                                      <i class="fa fa-phone" ></i>
                                  </span>
                                  <span class="contact-data"><strong>Envato</strong><br> Level 13, 2 Elizabeth St,<br> Melbourne, Victoria 3000 Australia
                                  </span>
                              </div>   
                           </li>
                           
                           
                       </ul>
                   </div>
              </div>
            </section>
            
            <?php  get_template_part("contador_template"); ?>
            
            <section>
                <div class="tab">
                  <button class="tablinks" onclick="openCity(event, 'London')">London</button>
                  <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
                  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
                </div>
            
            </section>

            
            <?php  get_template_part("contador_tempo_template"); ?>
           
            
            <?php  get_template_part("toggle_box_template"); ?>
            
            
            <div class="tab-box">
                <div class="tab-header">
                    <ul class="tab-header-list">
                        <li class="tab-header-item tab-header-item-active">
                             <h3 class="tab-header-item-title">
                                    <a href="#live-website-builder" onclick="return false">Tab Item 1</a>
                             </h3>
                        </li>
                        
                        <li class="tab-header-item">
                             <h3 class="tab-header-item-title">
                                    <a href="#live-website-builder" onclick="return false">Tab Item 2</a>
                             </h3>
                        </li>
                        
                         <li class="tab-header-item">
                             <h3 class="tab-header-item-title">
                                    <a href="#live-website-builder" onclick="return false">Tab Item 3</a>
                             </h3>
                        </li>
                    </ul>
                </div>
                
                <ul class="tab-box-content-list">
                    <li class="tab-content-item tab-content-item-active">
                        <p class="tab-content-item-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce velit tortor, dictum in gravida nec, aliquet non lorem.
                        </p>
                    </li>
                    
                    <li class="tab-content-item">
                        <p class="tab-content-item-text">
                            blablabla, consectetur adipiscing elit. Fusce velit tortor, dictum in gravida nec, aliquet non lorem.
                        </p>
                    </li>
                    
                    <li class="tab-content-item">
                        <p class="tab-content-item-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce velit tortor, dictum in gravida nec, aliquet non lorem.
                        </p>
                    </li>
                </ul>
            </div>
            
            
		</main>
	</div><!-- #primary -->
<?php get_footer(); ?>