<div class="front_page_section front_page_section_about<?php
			$angela_scheme = angela_get_theme_option('front_page_about_scheme');
			if (!angela_is_inherit($angela_scheme)) echo ' scheme_'.esc_attr($angela_scheme);
			echo ' front_page_section_paddings_'.esc_attr(angela_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$angela_css = '';
		$angela_bg_image = angela_get_theme_option('front_page_about_bg_image');
		if (!empty($angela_bg_image)) 
			$angela_css .= 'background-image: url('.esc_url(angela_get_attachment_url($angela_bg_image)).');';
		if (!empty($angela_css))
			echo ' style="' . esc_attr($angela_css) . '"';
?>><?php
	// Add anchor
	$angela_anchor_icon = angela_get_theme_option('front_page_about_anchor_icon');	
	$angela_anchor_text = angela_get_theme_option('front_page_about_anchor_text');	
	if ((!empty($angela_anchor_icon) || !empty($angela_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($angela_anchor_icon) ? ' icon="'.esc_attr($angela_anchor_icon).'"' : '')
										. (!empty($angela_anchor_text) ? ' title="'.esc_attr($angela_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (angela_get_theme_option('front_page_about_fullheight'))
				echo ' angela-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$angela_css = '';
			$angela_bg_mask = angela_get_theme_option('front_page_about_bg_mask');
			$angela_bg_color = angela_get_theme_option('front_page_about_bg_color');
			if (!empty($angela_bg_color) && $angela_bg_mask > 0)
				$angela_css .= 'background-color: '.esc_attr($angela_bg_mask==1
																	? $angela_bg_color
																	: angela_hex2rgba($angela_bg_color, $angela_bg_mask)
																).';';
			if (!empty($angela_css))
				echo ' style="' . esc_attr($angela_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$angela_caption = angela_get_theme_option('front_page_about_caption');
			if (!empty($angela_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($angela_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($angela_caption); ?></h2><?php
			}
		
			// Description (text)
			$angela_description = angela_get_theme_option('front_page_about_description');
			if (!empty($angela_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($angela_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($angela_description)); ?></div><?php
			}
			
			// Content
			$angela_content = angela_get_theme_option('front_page_about_content');
			if (!empty($angela_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($angela_content) ? 'filled' : 'empty'; ?>"><?php
					$angela_page_content_mask = '%%CONTENT%%';
					if (strpos($angela_content, $angela_page_content_mask) !== false) {
						$angela_content = preg_replace(
									'/(\<p\>\s*)?'.$angela_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$angela_content
									);
					}
					angela_show_layout($angela_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>