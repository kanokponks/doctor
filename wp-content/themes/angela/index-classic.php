<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

angela_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	angela_show_layout(get_query_var('blog_archive_start'));

	$angela_classes = 'posts_container '
						. (substr(angela_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap columns_padding_bottom' : 'masonry_wrap');
	$angela_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$angela_sticky_out = angela_get_theme_option('sticky_style')=='columns' 
							&& is_array($angela_stickies) && count($angela_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($angela_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$angela_sticky_out) {
		if (angela_get_theme_option('first_post_large') && !is_paged() && !in_array(angela_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($angela_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($angela_sticky_out && !is_sticky()) {
			$angela_sticky_out = false;
			?></div><div class="<?php echo esc_attr($angela_classes); ?>"><?php
		}
		get_template_part( 'content', $angela_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	angela_show_pagination();

	angela_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>