<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

$angela_blog_style = explode('_', angela_get_theme_option('blog_style'));
$angela_columns = empty($angela_blog_style[1]) ? 2 : max(2, $angela_blog_style[1]);
$angela_post_format = get_post_format();
$angela_post_format = empty($angela_post_format) ? 'standard' : str_replace('post-format-', '', $angela_post_format);
$angela_animation = angela_get_theme_option('blog_animation');
$angela_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($angela_columns).' post_format_'.esc_attr($angela_post_format) ); ?>
	<?php echo (!angela_is_off($angela_animation) ? ' data-animation="'.esc_attr(angela_get_animation_classes($angela_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($angela_image[1]) && !empty($angela_image[2])) echo intval($angela_image[1]) .'x' . intval($angela_image[2]); ?>"
	data-src="<?php if (!empty($angela_image[0])) echo esc_url($angela_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$angela_image_hover = 'icon';	//angela_get_theme_option('image_hover');
	if (in_array($angela_image_hover, array('icons', 'zoom'))) $angela_image_hover = 'dots';
	$angela_components = angela_is_inherit(angela_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: angela_array_get_keys_by_value(angela_get_theme_option('meta_parts'));
	$angela_counters = angela_is_inherit(angela_get_theme_option_from_meta('counters')) 
								? 'comments'
								: angela_array_get_keys_by_value(angela_get_theme_option('counters'));
	angela_show_post_featured(array(
		'hover' => $angela_image_hover,
		'thumb_size' => angela_get_thumb_size( strpos(angela_get_theme_option('body_style'), 'full')!==false || $angela_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($angela_components)
										? angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(
											'components' => $angela_components,
											'counters' => $angela_counters,
											'seo' => false,
											'echo' => false
											), $angela_blog_style[0], $angela_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'angela') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>