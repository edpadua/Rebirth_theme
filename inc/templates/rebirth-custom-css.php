<h1>Rebirth Custom CSS</h1>
<?php settings_errors(); ?>

<form id="save-custom-css-form" method="post" action="options.php" class="rebirth-general-form">
	<?php settings_fields( 'rebirth-custom-css-options' ); ?>
	<?php do_settings_sections( 'edp_rebirth_css' ); ?>
	<?php submit_button(); ?>
</form>