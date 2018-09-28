<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.10
 */

$angela_footer_scheme =  angela_is_inherit(angela_get_theme_option('footer_scheme')) ? angela_get_theme_option('color_scheme') : angela_get_theme_option('footer_scheme');
$angela_footer_id = str_replace('footer-custom-', '', angela_get_theme_option("footer_style"));
if ((int) $angela_footer_id == 0) {
	$angela_footer_id = angela_get_post_id(array(
												'name' => $angela_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$angela_footer_id = apply_filters('angela_filter_get_translated_layout', $angela_footer_id);
}
$angela_footer_meta = get_post_meta($angela_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($angela_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($angela_footer_id))); 
						if (!empty($angela_footer_meta['margin']) != '') 
							echo ' '.esc_attr(angela_add_inline_css_class('margin-top: '.angela_prepare_css_value($angela_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($angela_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('angela_action_show_layout', $angela_footer_id);
	?>
</footer><!-- /.footer_wrap -->
