<?php
/**
 * The template for displaying all single posts and attachments
 * Template Name: Single
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<?php rebirth_page_subheader('Blog'); ?>
<section class="container-page">
      <div class="container">

       <div class="row">

        <div class="col-md-8 col-sm-12 blog-list-containter">
                <div  class="content-area post-list-item">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                        // Previous/next post navigation.


                    // End the loop.
                    endwhile;
                    ?>


                </div><!-- .content-area -->



           </div>
           <div class="col-md-4 col-sm-12">
                 <?php get_sidebar(); ?>
          </div>

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


