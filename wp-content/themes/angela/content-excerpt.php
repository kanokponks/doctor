<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

$angela_post_format = get_post_format();
$angela_post_format = empty($angela_post_format) ? 'standard' : str_replace('post-format-', '', $angela_post_format);
$angela_animation = angela_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($angela_post_format) ); ?>
	<?php echo (!angela_is_off($angela_animation) ? ' data-animation="'.esc_attr(angela_get_animation_classes($angela_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
    if ((get_the_title() != '') && !in_array($angela_post_format, array('audio')) ) {
        do_action('angela_action_before_post_title');

        // Post title
        the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
    }

    ?><div class="post-top"><?php
        if (in_array($angela_post_format, array('audio')) ) {
            $angela_components = 'categories';
            if (!empty($angela_components))
                angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(
                        'components' => $angela_components,
                        'counters' => '',
                        'seo' => false
                    ), 'excerpt', 1)
                );
        }

        // Featured image
	angela_show_post_featured(array( 'thumb_size' => angela_get_thumb_size( strpos(angela_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

        if ((get_the_title() != '') && in_array($angela_post_format, array('audio')) ) {
            do_action('angela_action_before_post_title');

            // Post title
            the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
        }
        if (!in_array($angela_post_format, array('audio')) ) {
            $angela_components = 'categories';
            if (!empty($angela_components))
                angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(
                        'components' => $angela_components,
                        'counters' => '',
                        'seo' => false
                    ), 'excerpt', 1)
                );
        }
    ?></div><?php
	// Title and post meta
		?>
		<div class="post_header entry-header">
			<?php

			do_action('angela_action_before_post_meta'); 

			// Post meta
			$angela_components = angela_is_inherit(angela_get_theme_option_from_meta('meta_parts')) 
										? 'date,author,counters'
										: angela_array_get_keys_by_value(angela_get_theme_option('meta_parts'));
			$angela_counters = angela_is_inherit(angela_get_theme_option_from_meta('counters')) 
										? 'comments'
										: angela_array_get_keys_by_value(angela_get_theme_option('counters'));

			if (!empty($angela_components))
				angela_show_post_meta(apply_filters('angela_filter_post_meta_args', array(
					'components' => $angela_components,
					'counters' => $angela_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php

	
	// Post content
	?><div class="post_content entry-content"><?php
		if (angela_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'angela' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'angela' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$angela_show_learn_more = !in_array($angela_post_format, array('link','audio', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php
			// More button
			if ( $angela_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'angela'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>