<?php
ob_start();	
require get_template_directory() . '/inc/cleanup.php';
require get_template_directory() . '/inc/function-admin.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/theme-support.php';
require get_template_directory() . '/inc/custom-post-type.php';
require get_template_directory() . '/inc/walker.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/page-subheader.php';
require get_template_directory() . '/inc/gallery-template.php';
require get_template_directory() . '/inc/gallery-full-template.php';
require get_template_directory() . '/inc/gallery-full-template-slider.php';
require get_template_directory() . '/inc/widgets.php';
ob_end_clean();

