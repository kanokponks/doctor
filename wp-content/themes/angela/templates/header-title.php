<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

// Page (category, tag, archive, author) title

if ( angela_need_page_title() ) {
	angela_sc_layouts_showed('title', true);
	angela_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal scheme_dark">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$angela_blog_title = angela_get_blog_title();
							$angela_blog_title_text = $angela_blog_title_class = $angela_blog_title_link = $angela_blog_title_link_text = '';
							if (is_array($angela_blog_title)) {
								$angela_blog_title_text = $angela_blog_title['text'];
								$angela_blog_title_class = !empty($angela_blog_title['class']) ? ' '.$angela_blog_title['class'] : '';
								$angela_blog_title_link = !empty($angela_blog_title['link']) ? $angela_blog_title['link'] : '';
								$angela_blog_title_link_text = !empty($angela_blog_title['link_text']) ? $angela_blog_title['link_text'] : '';
							} else
								$angela_blog_title_text = $angela_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($angela_blog_title_class); ?>"><?php
								$angela_top_icon = angela_get_category_icon();
								if (!empty($angela_top_icon)) {
									$angela_attr = angela_getimagesize($angela_top_icon);
									?><img src="<?php echo esc_url($angela_top_icon); ?>" alt="" <?php if (!empty($angela_attr[3])) angela_show_layout($angela_attr[3]);?>><?php
								}
								echo wp_kses_data($angela_blog_title_text);
							?></h1>
							<?php
							if (!empty($angela_blog_title_link) && !empty($angela_blog_title_link_text)) {
								?><a href="<?php echo esc_url($angela_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($angela_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'angela_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>