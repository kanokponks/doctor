<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

$angela_post_id    = get_the_ID();
$angela_post_date  = angela_get_date();
$angela_post_title = get_the_title();
$angela_post_link  = get_permalink();
$angela_post_author_id   = get_the_author_meta('ID');
$angela_post_author_name = get_the_author_meta('display_name');
$angela_post_author_url  = get_author_posts_url($angela_post_author_id, '');

$angela_args = get_query_var('angela_args_widgets_posts');
$angela_show_date = isset($angela_args['show_date']) ? (int) $angela_args['show_date'] : 1;
$angela_show_image = isset($angela_args['show_image']) ? (int) $angela_args['show_image'] : 1;
$angela_show_author = isset($angela_args['show_author']) ? (int) $angela_args['show_author'] : 1;
$angela_show_counters = isset($angela_args['show_counters']) ? (int) $angela_args['show_counters'] : 1;
$angela_show_categories = isset($angela_args['show_categories']) ? (int) $angela_args['show_categories'] : 1;

$angela_output = angela_storage_get('angela_output_widgets_posts');

$angela_post_counters_output = '';
if ( $angela_show_counters ) {
	$angela_post_counters_output = '<span class="post_info_item post_info_counters">'
								. angela_get_post_counters('comments')
							. '</span>';
}


$angela_output .= '<article class="post_item with_thumb">';

if ($angela_show_image) {
	$angela_post_thumb = get_the_post_thumbnail($angela_post_id, angela_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($angela_post_thumb) $angela_output .= '<div class="post_thumb">' . ($angela_post_link ? '<a href="' . esc_url($angela_post_link) . '">' : '') . ($angela_post_thumb) . ($angela_post_link ? '</a>' : '') . '</div>';
}

$angela_output .= '<div class="post_content">'
			. ($angela_show_categories 
					? '<div class="post_categories">'
						. angela_get_post_categories()
						. $angela_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($angela_post_link ? '<a href="' . esc_url($angela_post_link) . '">' : '') . ($angela_post_title) . ($angela_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('angela_filter_get_post_info', 
								'<div class="post_info">'
									. ($angela_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($angela_post_link ? '<a href="' . esc_url($angela_post_link) . '" class="post_info_date">' : '') 
											. esc_html($angela_post_date) 
											. ($angela_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($angela_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'angela') . ' ' 
											. ($angela_post_link ? '<a href="' . esc_url($angela_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($angela_post_author_name) 
											. ($angela_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$angela_show_categories && $angela_post_counters_output
										? $angela_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
angela_storage_set('angela_output_widgets_posts', $angela_output);
?>