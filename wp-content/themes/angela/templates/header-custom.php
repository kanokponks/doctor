<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.06
 */

$angela_header_css = $angela_header_image = '';
$angela_header_video = angela_get_header_video();
if (true || empty($angela_header_video)) {
	$angela_header_image = get_header_image();
	if (angela_trx_addons_featured_image_override()) $angela_header_image = angela_get_current_mode_image($angela_header_image);
}

$angela_header_id = str_replace('header-custom-', '', angela_get_theme_option("header_style"));
if ((int) $angela_header_id == 0) {
	$angela_header_id = angela_get_post_id(array(
												'name' => $angela_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$angela_header_id = apply_filters('angela_filter_get_translated_layout', $angela_header_id);
}
$angela_header_meta = get_post_meta($angela_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($angela_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($angela_header_id)));
				echo !empty($angela_header_image) || !empty($angela_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($angela_header_video!='') 
					echo ' with_bg_video';
				if ($angela_header_image!='') 
					echo ' '.esc_attr(angela_add_inline_css_class('background-image: url('.esc_url($angela_header_image).');'));
				if (!empty($angela_header_meta['margin']) != '') 
					echo ' '.esc_attr(angela_add_inline_css_class('margin-bottom: '.esc_attr(angela_prepare_css_value($angela_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (angela_is_on(angela_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight angela-full-height';
				?> scheme_<?php echo esc_attr(angela_is_inherit(angela_get_theme_option('header_scheme')) 
												? angela_get_theme_option('color_scheme') 
												: angela_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($angela_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('angela_action_show_layout', $angela_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>