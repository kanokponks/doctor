<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

$angela_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$angela_post_format = get_post_format();
$angela_post_format = empty($angela_post_format) ? 'standard' : str_replace('post-format-', '', $angela_post_format);
$angela_animation = angela_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($angela_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($angela_post_format) ); ?>
	<?php echo (!angela_is_off($angela_animation) ? ' data-animation="'.esc_attr(angela_get_animation_classes($angela_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	angela_show_post_featured(array(
		'thumb_size' => angela_get_thumb_size($angela_columns==1 ? 'big' : ($angela_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($angela_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(), 'sticky', $angela_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>