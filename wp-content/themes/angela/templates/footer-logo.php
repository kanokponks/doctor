<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.10
 */

// Logo
if (angela_is_on(angela_get_theme_option('logo_in_footer'))) {
	$angela_logo_image = '';
	if (angela_is_on(angela_get_theme_option('logo_retina_enabled')) && angela_get_retina_multiplier(2) > 1)
		$angela_logo_image = angela_get_theme_option( 'logo_footer_retina' );
	if (empty($angela_logo_image)) 
		$angela_logo_image = angela_get_theme_option( 'logo_footer' );
	$angela_logo_text   = get_bloginfo( 'name' );
	if (!empty($angela_logo_image) || !empty($angela_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($angela_logo_image)) {
					$angela_attr = angela_getimagesize($angela_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($angela_logo_image).'" class="logo_footer_image" alt=""'.(!empty($angela_attr[3]) ? ' ' . wp_kses_data($angela_attr[3]) : '').'></a>' ;
				} else if (!empty($angela_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($angela_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>