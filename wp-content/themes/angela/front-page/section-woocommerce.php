<div class="front_page_section front_page_section_woocommerce<?php
			$angela_scheme = angela_get_theme_option('front_page_woocommerce_scheme');
			if (!angela_is_inherit($angela_scheme)) echo ' scheme_'.esc_attr($angela_scheme);
			echo ' front_page_section_paddings_'.esc_attr(angela_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$angela_css = '';
		$angela_bg_image = angela_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($angela_bg_image)) 
			$angela_css .= 'background-image: url('.esc_url(angela_get_attachment_url($angela_bg_image)).');';
		if (!empty($angela_css))
			echo ' style="' . esc_attr($angela_css) . '"';
?>><?php
	// Add anchor
	$angela_anchor_icon = angela_get_theme_option('front_page_woocommerce_anchor_icon');	
	$angela_anchor_text = angela_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($angela_anchor_icon) || !empty($angela_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($angela_anchor_icon) ? ' icon="'.esc_attr($angela_anchor_icon).'"' : '')
										. (!empty($angela_anchor_text) ? ' title="'.esc_attr($angela_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (angela_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' angela-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$angela_css = '';
			$angela_bg_mask = angela_get_theme_option('front_page_woocommerce_bg_mask');
			$angela_bg_color = angela_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($angela_bg_color) && $angela_bg_mask > 0)
				$angela_css .= 'background-color: '.esc_attr($angela_bg_mask==1
																	? $angela_bg_color
																	: angela_hex2rgba($angela_bg_color, $angela_bg_mask)
																).';';
			if (!empty($angela_css))
				echo ' style="' . esc_attr($angela_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$angela_caption = angela_get_theme_option('front_page_woocommerce_caption');
			$angela_description = angela_get_theme_option('front_page_woocommerce_description');
			if (!empty($angela_caption) || !empty($angela_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($angela_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($angela_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($angela_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($angela_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($angela_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($angela_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$angela_woocommerce_sc = angela_get_theme_option('front_page_woocommerce_products');
				if ($angela_woocommerce_sc == 'products') {
					$angela_woocommerce_sc_ids = angela_get_theme_option('front_page_woocommerce_products_per_page');
					$angela_woocommerce_sc_per_page = count(explode(',', $angela_woocommerce_sc_ids));
				} else {
					$angela_woocommerce_sc_per_page = max(1, (int) angela_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$angela_woocommerce_sc_columns = max(1, min($angela_woocommerce_sc_per_page, (int) angela_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$angela_woocommerce_sc}"
									. ($angela_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($angela_woocommerce_sc_ids).'"' 
											: '')
									. ($angela_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(angela_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($angela_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(angela_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(angela_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($angela_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($angela_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>