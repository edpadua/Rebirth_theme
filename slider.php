
<!-- Carousel
    ================================================== -->
<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-speed="3000" data-interval="<?php echo get_theme_mod( 'slide_interval','6000' ); ?>">
                          <!-- Indicators -->
                          <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                          </ol>
                          
                          <!-- Wrapper for slides -->
                          <div id="carousel-item" class="carousel-inner" role="listbox">
                            <div class="item active">
                                 
                                <img class="img-slide img-responsive" src='<?php echo esc_url( get_theme_mod( 'imagem_slide1' ) ); ?>' alt='<?php echo  get_theme_mod( 'slide_desc1' ); ?>'>
                                
                               
                                <div class="carousel-caption-parent">
                                  <div class="carousel-caption">
                                     
                                      <div class="textbox-slide-font">
                                         <h3 class="textbox-slide-font-title"><?php echo get_theme_mod( 'slide_title1' ); ?></h3>
                                         <p class="textbox-slide-font-text">
                                             <?php echo  get_theme_mod( 'slide_desc1' ); ?>
                                         </p>
                                      </div>
                                      <div class="slider-button">
                                         <a class="btn btn-section" href="" target="_self">Ver Todas</a>
                                      </div> 
                                      
                                  </div>
                                                                  
                                    
                                
                               </div>
                                
                               
                            </div>
                            
                             
                            <div class="item">
                              <img class="img-slide img-responsive" src='<?php echo esc_url( get_theme_mod( 'imagem_slide2' ) ); ?>' alt='<?php echo  get_theme_mod( 'slide_desc2' ); ?>'>
                                  
                                  <div class=" carousel-caption-parent">
                                      <div class="carousel-caption">

                                          <div class="textbox-slide-font">
                                             <h3 class="textbox-slide-font-title"><?php echo get_theme_mod( 'slide_title2' ); ?></h3>
                                             <p class="textbox-slide-font-text">
                                                 <?php echo  get_theme_mod( 'slide_desc2' ); ?>
                                             </p>
                                          </div>
                                      </div>
                                  </div>
                                  
                            </div>

                            <div class="item">
                                 <img class="img-slide img-responsive" src='<?php echo esc_url( get_theme_mod( 'imagem_slide3' ) ); ?>' alt='<?php echo  get_theme_mod( 'slide_desc3' ); ?>'>
                                  
                                  <div class=" carousel-caption-parent">
                                      <div class="carousel-caption">

                                          <div class="textbox-slide-font">
                                             <h3 class="textbox-slide-font-title"><?php echo get_theme_mod( 'slide_title3' ); ?></h3>
                                             <p class="textbox-slide-font-text">
                                                 <?php echo  get_theme_mod( 'slide_desc3' ); ?>
                                             </p>
                                          </div>
                                      </div>
                                  </div>
                                 
                            </div>
                              
                           
                            <div class="item">
                                 <img class="img-slide img-responsive" src='<?php echo esc_url( get_theme_mod( 'imagem_slide4' ) ); ?>' alt='<?php echo  get_theme_mod( 'slide_desc4' ); ?>'>
                                
                                  <div class=" carousel-caption-parent">
                                      <div class="carousel-caption">

                                          <div class="textbox-slide-font">
                                             <h3 class="textbox-slide-font-title"><?php echo get_theme_mod( 'slide_title4' ); ?></h3>
                                             <p class="textbox-slide-font-text">
                                                 <?php echo  get_theme_mod( 'slide_desc4' ); ?>
                                             </p>
                                          </div>
                                      </div>
                                  </div>
                                 
                            </div>
                         <!--     
                            <div class="item">
                                 <img class="img-slide img-responsive" src='<?php echo esc_url( get_theme_mod( 'imagem_slide5' ) ); ?>' alt='<?php echo  get_theme_mod( 'slide_desc5' ); ?>'>
                                
                                  <div class="carousel-caption-parent">
                                      <div class="carousel-caption">

                                          <div class="textbox-slide-font">
                                             <h3 class="textbox-slide-font-title"><?php echo get_theme_mod( 'slide_title5' ); ?></h3>
                                             <p class="textbox-slide-font-text">
                                                 <?php echo  get_theme_mod( 'slide_desc5' ); ?>
                                             </p>
                                          </div>
                                      </div>
                                  </div>
                                 
                            </div>-->

                          </div>

                              <!-- Left and right controls -->
                              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span id="button_prev" class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span id="button_next" class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>

</div>

