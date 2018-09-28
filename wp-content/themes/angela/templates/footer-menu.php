<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.10
 */

// Footer menu
$angela_menu_footer = angela_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($angela_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php angela_show_layout($angela_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>