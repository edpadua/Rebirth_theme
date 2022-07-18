<?php

/*
	
@package rebirththeme
-- Gallery Post Format

*/

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="entry-header text-center">
    </header>

    
	<div class="entry-content">
        
        <section class="entry-excerpt">
            <?php the_title( '<h2 class="post-excerpt-title post-title">', '</h2>'); ?>
            <div class="entry-meta">
            <i class="fa fa-calendar post-big-date-icon" aria-hidden="true"></i><?php echo the_time('F j, Y'); ?>
		    </div>
			
		</section>
        
		<div class="row">
		<?php if( rebirth_get_attachment() ): 
			$attachments = rebirth_get_attachment(7);
			
		?>
			
       <?php 
                            $count = count($attachments)-1;
                            for( $i = 0; $i <= $count; $i++ ): 
                                $active = ( $i == 0 ? ' active' : '' );

                                $n = ( $i == $count ? 0 : $i+1 );
                                $nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );
                                $p = ( $i == 0 ? $count : $i-1 );
                                $prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );
                    ?>
			
                
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb">
                        <a class="thumbnail-gallery">

                             <img id="galleryThumb-<?php echo $i  ?>" class="img-responsive image-gallery" src="<?php echo wp_get_attachment_image_src( $attachments[$i]->ID , 'medium')[0]; ?>" data-fullscreen-url="<?php echo wp_get_attachment_image_src( $attachments[$i]->ID , 'large')[0]; ?>" image-index="<?php echo $i ?>" alt="">

                        </a>
                    </div>
                    
                    <?php endfor; ?>	
			
		<?php endif; ?>
		
        </div>
		
		
		
	</div>
	
	
	
	
</article>