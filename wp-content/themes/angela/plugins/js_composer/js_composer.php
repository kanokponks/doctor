<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('angela_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'angela_vc_theme_setup9', 9 );
	function angela_vc_theme_setup9() {
		if (angela_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 				'angela_vc_frontend_scripts', 1100 );
			add_filter( 'angela_filter_merge_styles',		'angela_vc_merge_styles' );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,	'angela_vc_add_params_classes', 10, 3 );
			add_filter( 'vc_iconpicker-type-fontawesome',	'angela_vc_iconpicker_type_fontawesome' );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'angela'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'angela') ),
				"group" => esc_html__('Colors', 'angela'),
				"admin_label" => true,
				"value" => array_flip(angela_get_list_schemes(true)),
				"type" => "dropdown"
			);
			$sc_list = apply_filters('angela_filter_add_scheme_in_vc', array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'));
			foreach ($sc_list as $sc)
				vc_add_param($sc, $scheme);

			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'angela'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'angela') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'angela') => 'tiny',
					esc_html__('Small', 'angela') => 'small',
					esc_html__('Medium', 'angela') => 'medium',
					esc_html__('Large', 'angela') => 'large',
					esc_html__('Huge', 'angela') => 'huge',
					esc_html__('From the value above', 'angela') => 'none'
				),
				"type" => "dropdown"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'angela'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'angela') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'angela') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'angela'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'angela') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'angela') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'angela_filter_tgmpa_required_plugins', 'angela_vc_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'angela_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('angela_filter_tgmpa_required_plugins',	'angela_vc_tgmpa_required_plugins');
	function angela_vc_tgmpa_required_plugins($list=array()) {
		if (angela_storage_isset('required_plugins', 'js_composer')) {
			$path = angela_get_file_dir('plugins/js_composer/js_composer.zip');
			if (!empty($path) || angela_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> angela_storage_get_array('required_plugins', 'js_composer'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'angela_exists_visual_composer' ) ) {
	function angela_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'angela_vc_is_frontend' ) ) {
	function angela_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'angela_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'angela_vc_frontend_scripts', 1100 );
	function angela_vc_frontend_scripts() {
		if (angela_exists_visual_composer()) {
			if (angela_is_on(angela_get_theme_option('debug_mode')) && angela_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'angela-js_composer',  angela_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'angela_vc_merge_styles' ) ) {
	//Handler of the add_filter('angela_filter_merge_styles', 'angela_vc_merge_styles');
	function angela_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Add theme icons to the VC iconpicker list
if ( !function_exists( 'angela_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'angela_vc_iconpicker_type_fontawesome' );
	function angela_vc_iconpicker_type_fontawesome($icons) {
		$list = angela_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'angela') => $rez) );
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'angela_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'angela_vc_add_params_classes', 10, 3 );
	function angela_vc_add_params_classes($classes, $sc, $atts) {
		// Add color scheme
		if (in_array($sc, apply_filters('angela_filter_add_scheme_in_vc', array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text')))) {
			if (!empty($atts['scheme']) && !angela_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		}
		// Add other specific classes
		if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !angela_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (angela_exists_visual_composer()) { require_once ANGELA_THEME_DIR . 'plugins/js_composer/js_composer.styles.php'; }
?>