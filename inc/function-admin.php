<?php

/*
	
@package rebirththeme
	
	========================
		ADMIN PAGE
	========================
*/

function rebirth_add_admin_page() {
	
	//Generate rebirth Admin Page
	add_menu_page( 'rebirth Theme Options', 'rebirth', 'manage_options', 'edp_rebirth', 'rebirth_theme_create_page', get_template_directory_uri() . '/img/rebirth-icon.png', 110 );
	
	//Generate rebirth Admin Sub Pages
	add_submenu_page( 'edp_rebirth', 'rebirth Sidebar Options', 'Sidebar', 'manage_options', 'edp_rebirth', 'rebirth_theme_create_page' );
	add_submenu_page( 'edp_rebirth', 'rebirth Theme Options', 'Theme Options', 'manage_options', 'edp_rebirth_theme', 'rebirth_theme_support_page' );
	add_submenu_page( 'edp_rebirth', 'rebirth Contact Form', 'Contact Form', 'manage_options', 'edp_rebirth_theme_contact', 'rebirth_contact_form_page' );
	add_submenu_page( 'edp_rebirth', 'rebirth CSS Options', 'Custom CSS', 'manage_options', 'edp_rebirth_css', 'rebirth_theme_settings_page');
	
}
add_action( 'admin_menu', 'rebirth_add_admin_page' );

//Activate custom settings
add_action( 'admin_init', 'rebirth_custom_settings' );

function rebirth_custom_settings() {
	//Sidebar Options
	register_setting( 'rebirth-settings-group', 'profile_picture' );
	register_setting( 'rebirth-settings-group', 'first_name' );
	register_setting( 'rebirth-settings-group', 'last_name' );
	register_setting( 'rebirth-settings-group', 'user_description' );
	register_setting( 'rebirth-settings-group', 'twitter_handler', 'rebirth_sanitize_twitter_handler' );
	register_setting( 'rebirth-settings-group', 'facebook_handler' );
	register_setting( 'rebirth-settings-group', 'gplus_handler' );
	
	add_settings_section( 'rebirth-sidebar-options', 'Sidebar Option', 'rebirth_sidebar_options', 'edp_rebirth');
	
	add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'rebirth_sidebar_profile', 'edp_rebirth', 'rebirth-sidebar-options');
	add_settings_field( 'sidebar-name', 'Full Name', 'rebirth_sidebar_name', 'edp_rebirth', 'rebirth-sidebar-options');
	add_settings_field( 'sidebar-description', 'Description', 'rebirth_sidebar_description', 'edp_rebirth', 'rebirth-sidebar-options');
	add_settings_field( 'sidebar-twitter', 'Twitter handler', 'rebirth_sidebar_twitter', 'edp_rebirth', 'rebirth-sidebar-options');
	add_settings_field( 'sidebar-facebook', 'Facebook handler', 'rebirth_sidebar_facebook', 'edp_rebirth', 'rebirth-sidebar-options');
	add_settings_field( 'sidebar-gplus', 'Google+ handler', 'rebirth_sidebar_gplus', 'edp_rebirth', 'rebirth-sidebar-options');
	
	//Theme Support Options
	register_setting( 'rebirth-theme-support', 'post_formats' );
	register_setting( 'rebirth-theme-support', 'custom_header' );
	register_setting( 'rebirth-theme-support', 'custom_background' );
	
	add_settings_section( 'rebirth-theme-options', 'Theme Options', 'rebirth_theme_options', 'edp_rebirth_theme' );
	
	add_settings_field( 'post-formats', 'Post Formats', 'rebirth_post_formats', 'edp_rebirth_theme', 'rebirth-theme-options' );
	add_settings_field( 'custom-header', 'Custom Header', 'rebirth_custom_header', 'edp_rebirth_theme', 'rebirth-theme-options' );
	add_settings_field( 'custom-background', 'Custom Background', 'rebirth_custom_background', 'edp_rebirth_theme', 'rebirth-theme-options' );
	
	//Contact Form Options
	register_setting( 'rebirth-contact-options', 'activate_contact' );
	
	add_settings_section( 'rebirth-contact-section', 'Contact Form', 'rebirth_contact_section', 'edp_rebirth_theme_contact');
	
	add_settings_field( 'activate-form', 'Activate Contact Form', 'rebirth_activate_contact', 'edp_rebirth_theme_contact', 'rebirth-contact-section' );
	
	//Custom CSS Options
	register_setting( 'rebirth-custom-css-options', 'rebirth_css', 'rebirth_sanitize_custom_css' );
	
	add_settings_section( 'rebirth-custom-css-section', 'Custom CSS', 'rebirth_custom_css_section_callback', 'edp_rebirth_css' );
	
	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'rebirth_custom_css_callback', 'edp_rebirth_css', 'rebirth-custom-css-section' );
	
}

function rebirth_custom_css_section_callback() {
	echo 'Customize rebirth Theme with your own CSS';
}

function rebirth_custom_css_callback() {
	$css = get_option( 'rebirth_css' );
	$css = ( empty($css) ? '/* rebirth Theme Custom CSS */' : $css );
	echo '<div id="customCss">'.$css.'</div><textarea id="rebirth_css" name="rebirth_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}

function rebirth_theme_options() {
	echo 'Activate and Deactivate specific Theme Support Options';
}

function rebirth_contact_section() {
	echo 'Activate and Deactivate the Built-in Contact Form';
}

function rebirth_activate_contact() {
	$options = get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.' /></label>';
}

function rebirth_post_formats() {
	$options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	echo $output;
}

function rebirth_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}

function rebirth_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}

// Sidebar Options Functions
function rebirth_sidebar_options() {
	echo 'Customize your Sidebar Information';
}

function rebirth_sidebar_profile() {
	$picture = esc_attr( get_option( 'profile_picture' ) );
	if( empty($picture) ){
		echo '<button type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><span class="rebirth-icon-button dashicons-before dashicons-format-image"></span> Upload Profile Picture</button><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	} else {
		echo '<button type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><span class="rebirth-icon-button dashicons-before dashicons-format-image"></span> Replace Profile Picture</button><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <button type="button" class="button button-secondary" value="Remove" id="remove-picture"><span class="rebirth-icon-button dashicons-before dashicons-no"></span> Remove</button>';
	}
	
}
function rebirth_sidebar_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function rebirth_sidebar_description() {
	$description = esc_attr( get_option( 'user_description' ) );
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write something smart.</p>';
}
function rebirth_sidebar_twitter() {
	$twitter = esc_attr( get_option( 'twitter_handler' ) );
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}
function rebirth_sidebar_facebook() {
	$facebook = esc_attr( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}
function rebirth_sidebar_gplus() {
	$gplus = esc_attr( get_option( 'gplus_handler' ) );
	echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ handler" />';
}

//Sanitization settings
function rebirth_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}

function rebirth_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}

//Template submenu functions
function rebirth_theme_create_page() {
	require_once( get_template_directory() . '/inc/templates/rebirth-admin.php' );
}

function rebirth_theme_support_page() {
	require_once( get_template_directory() . '/inc/templates/rebirth-theme-support.php' );
}

function rebirth_contact_form_page() {
	require_once( get_template_directory() . '/inc/templates/rebirth-contact-form.php' );
}

function rebirth_theme_settings_page() {
	require_once( get_template_directory() . '/inc/templates/rebirth-custom-css.php' );
}