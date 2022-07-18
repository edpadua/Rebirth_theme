<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Contato
 * @package WordPress
 * 
 */

get_header(); ?>




	    
        <?php rebirth_page_subheader(get_the_title()); ?>
            <div class="content-area">
               <main id="main" class="site-main" role="main">
               
                <div class="container-contato text-secfont">
                    
                    <section id="contato-forms" class="col-md-6 col-sm-12 col-xs-12">
                      
                        <?php echo do_shortcode( '[contact-form-7 id="50" title="Formulário de contato 1"]' ); ?>
                    </section>
                    <section id="contato-extra" class="col-md-6 col-sm-12 col-xs-12 text-secfont">
                    <div class="contato-texto">
                        <ul>
                            <li class="contact-list-item contact-list-item-extra">
                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                <a href="<?php echo get_theme_mod( 'facebook_link' ); ?>"><?php echo substr(get_theme_mod( 'facebook_link' ),24); ?></a>
                            </li>
                            <li class="contact-list-item contact-list-item-extra">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:<?php echo get_theme_mod( 'email_site' ); ?>"><?php echo get_theme_mod( 'email_site' ); ?></a>
                            </li>
                        </ul>
                    </div>
                </section>


                </div>
                
            </main><!-- .site-main -->
    </div>


<?php get_footer(); ?>