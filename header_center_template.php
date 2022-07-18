<!-- Header  template center
    ================================================== -->

<header id="header" class="main_header">
                 
                         <div id="top-line"></div>
                         <div class="main-nav-container-center">
                                   <div class="container">
                                   
                                      <div class="logo_container">
                                          <div class="logo_helper"></div>
                                               <?php
                                               // check to see if the logo exists and add it to the page
                                               if ( get_theme_mod( 'your_theme_logo' ) ) : ?>

                                                <a href="<?php bloginfo('url'); ?>"><img id="logo-center" class="logo" src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a> 

                                                <?php // add a fallback if the logo doesn't exist

                                                else : ?>



                                                <?php endif; ?>
                                            </div>
                                       
                                      
                                       <div class="nav-container-center">
                                            <nav class="top-menu-nav font_header">
                                                <?php 
                                                    wp_nav_menu( array(
                                                        'theme_location' => 'primary',
                                                        'container' => false,
                                                        'menu_class' => 'naveg navbar-nav',
                                                        'walker' => new Rebirth_Walker_Nav_Primary()
                                                    ) );	
                                            
                                                ?>
                                                
                                                                              
                                           </nav>
                                       </div>
                                       <div id="button-line">
                                             <i class="fa fa-bars fa-3x btn_menu"></i>
                                       </div>
                                   </div>



                          </div>
                 
                         
                 
                          <div class="nav-container-mobile">

                               <nav class="nav_menu_small">

                                    <?php wp_nav_menu( array(
                                                'theme_location' => 'mobile',
                                                'container' => false,


                                            ) );?>
                               </nav>

                          </div>
                 
    
             </header>
