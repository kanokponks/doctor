<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

if (angela_sidebar_present()) {
	ob_start();
	$angela_sidebar_name = angela_get_theme_option('sidebar_widgets');
	angela_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($angela_sidebar_name) ) {
		dynamic_sidebar($angela_sidebar_name);
	}
	$angela_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($angela_out)) {
		$angela_sidebar_position = angela_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($angela_sidebar_position); ?> widget_area<?php if (!angela_is_inherit(angela_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(angela_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'angela_action_before_sidebar' );
				angela_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $angela_out));
				do_action( 'angela_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>