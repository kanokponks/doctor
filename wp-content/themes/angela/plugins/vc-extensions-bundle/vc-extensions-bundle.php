<?php
/* Visual Composer Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('angela_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'angela_vc_extensions_theme_setup9', 9 );
	function angela_vc_extensions_theme_setup9() {
		if (angela_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'angela_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'angela_filter_merge_styles',						'angela_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'angela_filter_tgmpa_required_plugins',		'angela_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'angela_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('angela_filter_tgmpa_required_plugins',	'angela_vc_extensions_tgmpa_required_plugins');
	function angela_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (angela_storage_isset('required_plugins', 'vc-extensions-bundle')) {
			$path = angela_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			if (!empty($path) || angela_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> angela_storage_get_array('required_plugins', 'vc-extensions-bundle'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'angela_exists_vc_extensions' ) ) {
	function angela_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'angela_vc_extensions_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'angela_vc_extensions_frontend_scripts', 1100 );
	function angela_vc_extensions_frontend_scripts() {
		if (angela_is_on(angela_get_theme_option('debug_mode')) && angela_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'angela-vc-extensions-bundle',  angela_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'angela_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('angela_filter_merge_styles', 'angela_vc_extensions_merge_styles');
	function angela_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>