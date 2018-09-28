<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

$angela_args = get_query_var('angela_logo_args');

// Site logo
$angela_logo_type   = isset($angela_args['type']) ? $angela_args['type'] : '';
$angela_logo_image  = angela_get_logo_image($angela_logo_type);
$angela_logo_text   = angela_is_on(angela_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$angela_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($angela_logo_image) || !empty($angela_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($angela_logo_image)) {
			if (empty($angela_logo_type) && function_exists('the_custom_logo') && (int) $angela_logo_image > 0) {
				the_custom_logo();
			} else {
				$angela_attr = angela_getimagesize($angela_logo_image);
				echo '<img src="'.esc_url($angela_logo_image).'" alt=""'.(!empty($angela_attr[3]) ? ' '.wp_kses_data($angela_attr[3]) : '').'>';
			}
		} else {
			angela_show_layout(angela_prepare_macros($angela_logo_text), '<span class="logo_text">', '</span>');
			angela_show_layout(angela_prepare_macros($angela_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>