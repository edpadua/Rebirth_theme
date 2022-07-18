<?php

/*
	
@package rebirththeme
-- Gallery Template

*/



	function gallery_template($title) {
       
         ?>
        
         <div class="row">
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
                    
                    <?php endif; ?>
             
                         
            
                   

                    <?php 
                            $count = count($attachments)-1;
                            for( $i = 0; $i <= $count; $i++ ): 
                                
                                $active = ( $i == 0 ? ' active' : '' );

                                $n = ( $i == $count ? 0 : $i+1 );
                                $nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );
                                $p = ( $i == 0 ? $count : $i-1 );
                                $prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );
                               
                               
                               
                                 $image_alt = get_post_meta( $attachments[$i]->ID, '_wp_attachment_image_alt', true);
                              
                               
                               
                                 
        
        
                    ?>
			
                
                   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb">
                       <figure class=figure-gallery>
                            <a class="thumbnail-gallery">

                                 <img id="galleryThumb-<?php echo $i  ?>" class="img-responsive image-gallery" src="<?php echo wp_get_attachment_image_src( $attachments[$i]->ID , 'gallerys')[0]; ?>" data-fullscreen-url="<?php echo wp_get_attachment_image_src( $attachments[$i]->ID , 'large')[0]; ?>" image-index="<?php echo $i ?>" alt="<?php  echo $image_alt ?>">

                            </a>
                            <figcaption class="caption-gallery" >

                                   <div class=gallery-cap-text>
                                       <p><?php  echo $image_alt ?></p>
                                   </div>                     

                           </figcaption>
                       </figure>
                    </div>
                    
                    <?php endfor; ?>		
								
                </div> 

                <div id="myModal" class="modal">

         
              <div class="moldura-modal">
                  <!-- The Close Button -->
                  <span class="close-modal" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                  <!-- Modal Content (The Image) -->
                  <div id="div-modal">
                     <figure class="figure-gallery-lightbox">
                     <img class="conteudo-modal" id="img01">
                     <figcaption class="caption-gallery-lightbox" >
                            <div class="gallery-cap-lightbox-text">
                               <p id="lightbox-text">texto</p>
                            </div>      
                                               

                     </figcaption>
                    </figure>
                  </div>
                  <span id="button_prev_gallery" class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                  <span id="button_next_gallery" class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                  
                  <div id="modal-text"></div>

                  </div>
               
             </div>

<?php
        
   }


?>


