<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

// Header sidebar
$angela_header_name = angela_get_theme_option('header_widgets');
$angela_header_present = !angela_is_off($angela_header_name) && is_active_sidebar($angela_header_name);
if ($angela_header_present) { 
	angela_storage_set('current_sidebar', 'header');
	$angela_header_wide = angela_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($angela_header_name) ) {
		dynamic_sidebar($angela_header_name);
	}
	$angela_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($angela_widgets_output)) {
		$angela_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $angela_widgets_output);
		$angela_need_columns = strpos($angela_widgets_output, 'columns_wrap')===false;
		if ($angela_need_columns) {
			$angela_columns = max(0, (int) angela_get_theme_option('header_columns'));
			if ($angela_columns == 0) $angela_columns = min(6, max(1, substr_count($angela_widgets_output, '<aside ')));
			if ($angela_columns > 1)
				$angela_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($angela_columns).' widget', $angela_widgets_output);
			else
				$angela_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($angela_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$angela_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($angela_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'angela_action_before_sidebar' );
				angela_show_layout($angela_widgets_output);
				do_action( 'angela_action_after_sidebar' );
				if ($angela_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$angela_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>