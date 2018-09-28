<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($angela_columns).' post_format_'.esc_attr($angela_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!angela_is_off($angela_animation) ? ' data-animation="'.esc_attr(angela_get_animation_classes($angela_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$angela_image_hover = angela_get_theme_option('image_hover');
	// Featured image
	angela_show_post_featured(array(
		'thumb_size' => angela_get_thumb_size(strpos(angela_get_theme_option('body_style'), 'full')!==false || $angela_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $angela_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $angela_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>