<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Projeto-single-full-img
 * Template Post Type: projeto
 * @package WordPress

 */

get_header(); ?>
<?php rebirth_page_subheader_blog_sup(); ?>
<?php rebirth_page_subheader(get_the_title()); ?>
<?php $images=get_attached_media('image');

?>
<section class="container-page">
      <div class="container">

           <div class="row row_ajuste portfolio-img-bottom">
               
               
               <?php foreach($images as $image) { ?>
               
               
               <div class="gallery-full col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                     <?php 
                        if ( has_post_thumbnail() ) {        
                     ?> 
                   
                   
                    <figure class="figure-gallery-full">
                        <a>
                               
                               <img class="thumb-responsive" src="<?php echo wp_get_attachment_image_url($image->ID,'large'); ?>" />
                              
                        </a>
                         
                         <figcaption class="caption-gallery-full">

                                  <div class="gallery-full-cap-text">
                                       <p></p>
                                       <i class="fa fa-search fa-3x" aria-hidden="true"></i>
                                   </div>              
                         </figcaption>
                    
                    </figure>
                   
                    <?php 
                         }
                     ?> 

               </div>
               
               <?php } ?>
               
           </div>
          
          <?php $projetos_meta_data = get_post_meta( $post->ID ); ?>
           
           <div class="row row_ajuste port entry-excerpt" >
              
              <p>
                
                  
                 <?php echo wpautop($projetos_meta_data['custom_editor'][0]); ?>
              
              </p>
           
              
               
           </div>
          
            <?php 
               the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
                                '',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
                                '',
                            'screen_reader_text' => __( '' ),
                        ) );
           ?>
      </div>
</section>   



<?php get_footer(); ?>


