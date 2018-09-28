<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

						// Widgets area inside page content
						angela_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					angela_create_widgets_area('widgets_below_page');

					$angela_body_style = angela_get_theme_option('body_style');
					if ($angela_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$angela_footer_type = angela_get_theme_option("footer_type");
			if ($angela_footer_type == 'custom' && !angela_is_layouts_available())
				$angela_footer_type = 'default';
			get_template_part( "templates/footer-{$angela_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (angela_is_on(angela_get_theme_option('debug_mode')) && angela_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(angela_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>