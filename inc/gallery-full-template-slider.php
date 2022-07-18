<?php

/*
	
@package rebirththeme
-- Gallery full Template slider

*/



	function gallery_full_template_slider($title) {
       
         ?>



<section class="gallery-full-section">
                 
    
                    <?php 
                        global $wpdb;
                        $mypostids = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title=%s", $title ));
                        $query = new WP_Query( array( 'p'=>$mypostids, 'post_type' => 'gallery' ) );
                        

                     ?>
             
             
             
                    <?php if ( $query->have_posts() ) : ?>
                        <?php 
                           
                            while ( $query->have_posts() ) : $query->the_post(); ?>   
                            <?php 
                             
                             $attachments = rebirth_get_all_attachments_id( $mypostids );
                              
                        ?>
                             
                        <?php endwhile;  ?>
                    <!-- show pagination here -->
                    
                    <?php endif; 
                         $count = count($attachments);   
     
                    ?>
             
                       
            
                   <div class="carousel carousel-gallery-full slide" id="carousel_gallery" count="<?php echo $count; ?>">
                        <div class="carousel-inner">

                    <?php 
                            $max = count($attachments)-1;
                            for( $i = 0; $i <= $max; $i++ ): 
                                
                                $active = ( $i == 0 ? ' active' : '' );

                                $n = ( $i == $max ? 0 : $i+1 );
                                $nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );
                                $p = ( $i == 0 ? $max : $i-1 );
                                $prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );
                               
                               
                                 $image_alt = get_post_meta( $attachments[$i]->ID, '_wp_attachment_image_alt', true);
                              
                               
        
                    ?>
                       
                    
    
                <div class="item <?php if ( $i == 0 ) : ?>active<?php endif; ?>">
                    <div class="gallery-full col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <figure class="figure-gallery-full">
                        <a>
                        
                            <img width="200" height="200" id="galleryThumb-<?php echo $i  ?>" class="thumb-responsive wp-post-image" src="<?php echo wp_get_attachment_image_src( $attachments[$i]->ID , 'gallery-thumb')[0]; ?>" data-fullscreen-url="<?php echo wp_get_attachment_image_src( $attachments[$i]->ID , 'large')[0]; ?>" image-index="<?php echo $i ?>" alt="<?php  echo $image_alt ?>">
                        
                        </a>
                         
                         <figcaption class="caption-gallery-full">

                                  <div class="gallery-full-cap-text">
                                       <p></p>
                                       <i class="fa fa-search fa-3x" aria-hidden="true"></i>
                                   </div>              
                         </figcaption>
                    
                    </figure>
                   </div>
                  </div>   
                    <?php endfor; ?>		
                </div>
                       <div class="carousel-navegation">
                          
                            <a class="left carousel-control" href="#carousel_gallery" data-slide="prev">
                               <i class="glyphicon glyphicon-chevron-left"></i>
                            </a>
                            <a class="right carousel-control" href="#carousel_gallery" data-slide="next">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </a>
                            
                        </div>
                    
                </div>
                
                
</section>


<?php
        
   }


?>
