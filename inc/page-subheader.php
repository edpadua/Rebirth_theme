<?php 
	
	/*
		This is the template for the footer
		
		@package rebirththeme
	*/


	function rebirth_page_subheader( $title ) {
       
        echo '<section class="page-title-area">';
        echo '<div class="page-title-container container">';
        echo '<h1>'.$title.'</h1>';
        echo '</div>';
        echo '</section>';
        
   }


   function rebirth_page_subheader_blog( $title, $subtitle ) {
       
       
        echo '<section class="page-title-area">';
        echo '<div class="page-title-container container">';
        echo '<h1>'.$title.'</h1>';
        /*echo '<h2>'.$subtitle.'</h2>';*/
        echo '</div>';
        echo '</section>';
   }


   function rebirth_page_subheader_blog_sup() {
       
       
        echo '<section class="sup-header">';
        echo '</section>';
   }

?>