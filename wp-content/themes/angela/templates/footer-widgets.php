<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.10
 */

// Footer sidebar
$angela_footer_name = angela_get_theme_option('footer_widgets');
$angela_footer_present = !angela_is_off($angela_footer_name) && is_active_sidebar($angela_footer_name);
if ($angela_footer_present) { 
	angela_storage_set('current_sidebar', 'footer');
	$angela_footer_wide = angela_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($angela_footer_name) ) {
		dynamic_sidebar($angela_footer_name);
	}
	$angela_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($angela_out)) {
		$angela_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $angela_out);
		$angela_need_columns = true;	//or check: strpos($angela_out, 'columns_wrap')===false;
		if ($angela_need_columns) {
			$angela_columns = max(0, (int) angela_get_theme_option('footer_columns'));
			if ($angela_columns == 0) $angela_columns = min(4, max(1, substr_count($angela_out, '<aside ')));
			if ($angela_columns > 1)
				$angela_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($angela_columns).' widget', $angela_out);
			else
				$angela_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($angela_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$angela_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($angela_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'angela_action_before_sidebar' );
				angela_show_layout($angela_out);
				do_action( 'angela_action_after_sidebar' );
				if ($angela_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$angela_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>