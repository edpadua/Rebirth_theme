<?php 
	
	/*
		This is the template for the footer
		
		@package rebirththeme
	*/
	
?>

<footer>
   <div class="footer-content container">
    
       <div class="row-footer">
           <div id="contact-area">
               <h3 class="contact-footer-title">Contato</h3>
               <ul>
                  <li class="contact-list-item contact-list-item-footer">
                     <i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i><a href="mailto:<?php echo get_theme_mod( 'email_site' ); ?>"><?php echo get_theme_mod( 'email_site' ); ?></a>
                  </li>
                  <li class="contact-list-item contact-list-item-footer">
                     <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i><a href="<?php echo get_theme_mod( 'facebook_link' ); ?>"><?php echo substr(get_theme_mod( 'facebook_link' ),24); ?></a>
                  </li>
               </ul>
           </div>
           <div class="contact-list-item-footer footer-copyright">
               © <?php echo get_theme_mod( 'copyright' ); ?>
           </div>
       </div>
   </div>
   
</footer>

<?php wp_footer(); ?>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
</body>
</html>