<?php

/*
	
@package rebirththeme
-- Standard Post Format

*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
    </header>
	
	<div class="entry-content">
		
		<?php if( rebirth_get_attachment() ): ?>
			
			<a class="standard-featured-link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium_large',array( 'class' => 'thumb-responsive thumb-post' ) );?>
			</a>
			
		<?php endif; ?>
		
		<section class="entry-excerpt">
            <?php the_title( '<h2 class="post-excerpt-title post-title">', '</h2>'); ?>
            <div class="entry-meta">
            <i class="fa fa-calendar post-big-date-icon" aria-hidden="true"></i><?php echo the_time('F j, Y'); ?>
		    </div>
			<?php the_content(); ?>
		</section>
		
		
		
	</div><!-- .entry-content -->
	
	
	
</article>