<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.10
 */


// Socials
if ( angela_is_on(angela_get_theme_option('socials_in_footer')) && ($angela_output = angela_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php angela_show_layout($angela_output); ?>
		</div>
	</div>
	<?php
}
?>