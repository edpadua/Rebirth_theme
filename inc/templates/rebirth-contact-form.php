<h1>Rebirth Contact Form</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="rebirth-general-form">
	<?php settings_fields( 'rebirth-contact-options' ); ?>
	<?php do_settings_sections( 'edp_rebirth_theme_contact' ); ?>
	<?php submit_button(); ?>
</form>