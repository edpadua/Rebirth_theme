<h1>Rebirth Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="rebirth-general-form">
	<?php settings_fields( 'rebirth-theme-support' ); ?>
	<?php do_settings_sections( 'edp_rebirth_theme' ); ?>
	<?php submit_button(); ?>
</form>