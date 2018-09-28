<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$angela_content = '';
$angela_blog_archive_mask = '%%CONTENT%%';
$angela_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $angela_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($angela_content = apply_filters('the_content', get_the_content())) != '') {
		if (($angela_pos = strpos($angela_content, $angela_blog_archive_mask)) !== false) {
			$angela_content = preg_replace('/(\<p\>\s*)?'.$angela_blog_archive_mask.'(\s*\<\/p\>)/i', $angela_blog_archive_subst, $angela_content);
		} else
			$angela_content .= $angela_blog_archive_subst;
		$angela_content = explode($angela_blog_archive_mask, $angela_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) angela_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$angela_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$angela_args = angela_query_add_posts_and_cats($angela_args, '', angela_get_theme_option('post_type'), angela_get_theme_option('parent_cat'));
$angela_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($angela_page_number > 1) {
	$angela_args['paged'] = $angela_page_number;
	$angela_args['ignore_sticky_posts'] = true;
}
$angela_ppp = angela_get_theme_option('posts_per_page');
if ((int) $angela_ppp != 0)
	$angela_args['posts_per_page'] = (int) $angela_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($angela_args);


// Add internal query vars in the new query!
if (is_array($angela_content) && count($angela_content) == 2) {
	set_query_var('blog_archive_start', $angela_content[0]);
	set_query_var('blog_archive_end', $angela_content[1]);
}

get_template_part('index');
?>