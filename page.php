<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>



<?php  rebirth_page_subheader( get_the_title() ); ?>

<section class="page-content-container">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
       
         <div>
           <?php the_content(); ?>
         </div>
    <?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>


