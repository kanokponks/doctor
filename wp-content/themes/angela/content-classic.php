<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

$angela_blog_style = explode('_', angela_get_theme_option('blog_style'));
$angela_columns = empty($angela_blog_style[1]) ? 2 : max(2, $angela_blog_style[1]);
$angela_expanded = !angela_sidebar_present() && angela_is_on(angela_get_theme_option('expand_content'));
$angela_post_format = get_post_format();
$angela_post_format = empty($angela_post_format) ? 'standard' : str_replace('post-format-', '', $angela_post_format);
$angela_animation = angela_get_theme_option('blog_animation');
$angela_components = angela_is_inherit(angela_get_theme_option_from_meta('meta_parts')) 
							? 'date,author'
							: angela_array_get_keys_by_value(angela_get_theme_option('meta_parts'));
$angela_counters = angela_is_inherit(angela_get_theme_option_from_meta('counters')) 
							? 'comments'
							: angela_array_get_keys_by_value(angela_get_theme_option('counters'));

?><div class="<?php echo $angela_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($angela_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($angela_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($angela_columns)
					. ' post_layout_'.esc_attr($angela_blog_style[0]) 
					. ' post_layout_'.esc_attr($angela_blog_style[0]).'_'.esc_attr($angela_columns)
					); ?>
	<?php echo (!angela_is_off($angela_animation) ? ' data-animation="'.esc_attr(angela_get_animation_classes($angela_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	angela_show_post_featured( array( 'thumb_size' => angela_get_thumb_size($angela_blog_style[0] == 'classic'
													? (strpos(angela_get_theme_option('body_style'), 'full')!==false 
															? ( $angela_columns > 2 ? 'big' : 'huge' )
															: (	$angela_columns > 2
																? ($angela_expanded ? 'med' : 'small')
																: ($angela_expanded ? 'big' : 'med')
																)
														)
													: (strpos(angela_get_theme_option('body_style'), 'full')!==false 
															? ( $angela_columns > 2 ? 'masonry-big' : 'full' )
															: (	$angela_columns <= 2 && $angela_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($angela_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('angela_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('angela_action_before_post_meta'); 

			// Post meta
			if (!empty($angela_components))
				angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(
					'components' => $angela_components,
					'counters' => $angela_counters,
					'seo' => false
					), $angela_blog_style[0], $angela_columns)
				);

			do_action('angela_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$angela_show_learn_more = false; //!in_array($angela_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($angela_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($angela_post_format == 'quote') {
				if (($quote = angela_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					angela_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($angela_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($angela_components))
				angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(
					'components' => $angela_components,
					'counters' => $angela_counters
					), $angela_blog_style[0], $angela_columns)
				);
		}
		// More button
		if ( $angela_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'angela'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>