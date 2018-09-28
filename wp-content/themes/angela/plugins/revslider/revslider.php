<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('angela_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'angela_revslider_theme_setup9', 9 );
	function angela_revslider_theme_setup9() {
		if (angela_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'angela_revslider_frontend_scripts', 1100 );
			add_filter( 'angela_filter_merge_styles',			'angela_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'angela_filter_tgmpa_required_plugins','angela_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'angela_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('angela_filter_tgmpa_required_plugins',	'angela_revslider_tgmpa_required_plugins');
	function angela_revslider_tgmpa_required_plugins($list=array()) {
		if (angela_storage_isset('required_plugins', 'revslider')) {
			$path = angela_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || angela_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> angela_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'angela_exists_revslider' ) ) {
	function angela_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'angela_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'angela_revslider_frontend_scripts', 1100 );
	function angela_revslider_frontend_scripts() {
		if (angela_is_on(angela_get_theme_option('debug_mode')) && angela_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'angela-revslider',  angela_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'angela_revslider_merge_styles' ) ) {
	//Handler of the add_filter('angela_filter_merge_styles', 'angela_revslider_merge_styles');
	function angela_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>