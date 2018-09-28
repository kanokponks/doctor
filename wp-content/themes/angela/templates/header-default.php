<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */


$angela_header_css = $angela_header_image = '';
$angela_header_video = angela_get_header_video();
if (true || empty($angela_header_video)) {
	$angela_header_image = get_header_image();
	if (angela_trx_addons_featured_image_override()) $angela_header_image = angela_get_current_mode_image($angela_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($angela_header_image) || !empty($angela_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($angela_header_video!='') echo ' with_bg_video';
					if ($angela_header_image!='') echo ' '.esc_attr(angela_add_inline_css_class('background-image: url('.esc_url($angela_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (angela_is_on(angela_get_theme_option('header_fullheight'))) echo ' header_fullheight angela-full-height';
					?> scheme_<?php echo esc_attr(angela_is_inherit(angela_get_theme_option('header_scheme')) 
													? angela_get_theme_option('color_scheme') 
													: angela_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($angela_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (angela_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>