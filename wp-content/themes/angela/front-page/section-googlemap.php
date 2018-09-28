<div class="front_page_section front_page_section_googlemap<?php
			$angela_scheme = angela_get_theme_option('front_page_googlemap_scheme');
			if (!angela_is_inherit($angela_scheme)) echo ' scheme_'.esc_attr($angela_scheme);
			echo ' front_page_section_paddings_'.esc_attr(angela_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$angela_css = '';
		$angela_bg_image = angela_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($angela_bg_image)) 
			$angela_css .= 'background-image: url('.esc_url(angela_get_attachment_url($angela_bg_image)).');';
		if (!empty($angela_css))
			echo ' style="' . esc_attr($angela_css) . '"';
?>><?php
	// Add anchor
	$angela_anchor_icon = angela_get_theme_option('front_page_googlemap_anchor_icon');	
	$angela_anchor_text = angela_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($angela_anchor_icon) || !empty($angela_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($angela_anchor_icon) ? ' icon="'.esc_attr($angela_anchor_icon).'"' : '')
										. (!empty($angela_anchor_text) ? ' title="'.esc_attr($angela_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (angela_get_theme_option('front_page_googlemap_fullheight'))
				echo ' angela-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$angela_css = '';
			$angela_bg_mask = angela_get_theme_option('front_page_googlemap_bg_mask');
			$angela_bg_color = angela_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($angela_bg_color) && $angela_bg_mask > 0)
				$angela_css .= 'background-color: '.esc_attr($angela_bg_mask==1
																	? $angela_bg_color
																	: angela_hex2rgba($angela_bg_color, $angela_bg_mask)
																).';';
			if (!empty($angela_css))
				echo ' style="' . esc_attr($angela_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$angela_layout = angela_get_theme_option('front_page_googlemap_layout');
			if ($angela_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$angela_caption = angela_get_theme_option('front_page_googlemap_caption');
			$angela_description = angela_get_theme_option('front_page_googlemap_description');
			if (!empty($angela_caption) || !empty($angela_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($angela_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($angela_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($angela_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($angela_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($angela_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($angela_description) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post(wpautop($angela_description));
						?></div><?php
					}
				if ($angela_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$angela_content = angela_get_theme_option('front_page_googlemap_content');
			if (!empty($angela_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($angela_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($angela_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($angela_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($angela_content);
				?></div><?php
	
				if ($angela_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($angela_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!angela_exists_trx_addons())
						angela_customizer_need_trx_addons_message();
					else
						angela_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($angela_layout == 'columns' && (!empty($angela_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>