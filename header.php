<?php 
	
	/*
		This is the template for the hedaer
		
		@package rebirththeme
	*/
	
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php geraTitle(); ?></title>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
        
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
		
		<?php 
			$custom_css = esc_attr( get_option( 'sunset_css' ) );
			if( !empty( $custom_css ) ):
				echo '<style>' . $custom_css . '</style>';
			endif;
		?>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

    <body <?php body_class(); ?>>
	
	   
		
    
    
              <?php  get_template_part('header_classic_template'); ?>
		
	