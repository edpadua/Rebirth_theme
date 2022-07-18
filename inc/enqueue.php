<?php

/*
	
@package rebirththeme
	
	========================
		ADMIN ENQUEUE FUNCTIONS
	========================
*/

function rebirth_load_admin_scripts( $hook ){
	//echo $hook;
	
	//register css admin section
	wp_register_style( 'raleway-admin', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
	wp_register_style( 'rebirth_admin', get_template_directory_uri() . '/css/rebirth.admin.css', array(), '1.0.0', 'all' );
	
	//register js admin section
	wp_register_script( 'rebirth-admin-script', get_template_directory_uri() . '/js/rebirth.admin.js', array('jquery'), '1.0.0', true );
	
	$pages_array = array(
		'toplevel_page_edp_rebirth',
		'rebirth_page_edp_rebirth_theme',
		'rebirth_page_edp_rebirth_theme_contact'
	);
	
	if( in_array( $hook, $pages_array ) ){
		
		wp_enqueue_style( 'raleway-admin' );
		wp_enqueue_style( 'rebirth_admin' );
	
	} else if( 'toplevel_page_edp_rebirth' == $hook ){
		
		wp_enqueue_media();
		
		wp_enqueue_script( 'rebirth-admin-script' );
		
	} else if ( 'rebirth_page_edp_rebirth_css' == $hook ){
		
		wp_enqueue_style( 'raleway-admin' );
		wp_enqueue_style( 'rebirth_admin' );
		
		wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/rebirth.ace.css', array(), '1.0.0', 'all' );
		
		wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
		wp_enqueue_script( 'rebirth-custom-css-script', get_template_directory_uri() . '/js/rebirth.custom_css.js', array('jquery'), '1.0.0', true );
	
	} else { return; }
	
}
add_action( 'admin_enqueue_scripts', 'rebirth_load_admin_scripts' );

/*
	
	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================
*/

function rebirth_load_scripts(){
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );
	wp_enqueue_style( 'rebirth', get_template_directory_uri() . '/css/rebirth.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
	
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
    wp_enqueue_script( 'fontawesome-embed', 'https://use.fontawesome.com/a0e20d62f4.js');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	wp_enqueue_script( 'rebirth', get_template_directory_uri() . '/js/rebirth.js', array('jquery'), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'rebirth_load_scripts' );
