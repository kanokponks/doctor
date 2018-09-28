<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0
 */

angela_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	angela_show_layout(get_query_var('blog_archive_start'));

	$angela_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$angela_sticky_out = angela_get_theme_option('sticky_style')=='columns' 
							&& is_array($angela_stickies) && count($angela_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$angela_cat = angela_get_theme_option('parent_cat');
	$angela_post_type = angela_get_theme_option('post_type');
	$angela_taxonomy = angela_get_post_type_taxonomy($angela_post_type);
	$angela_show_filters = angela_get_theme_option('show_filters');
	$angela_tabs = array();
	if (!angela_is_off($angela_show_filters)) {
		$angela_args = array(
			'type'			=> $angela_post_type,
			'child_of'		=> $angela_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $angela_taxonomy,
			'pad_counts'	=> false
		);
		$angela_portfolio_list = get_terms($angela_args);
		if (is_array($angela_portfolio_list) && count($angela_portfolio_list) > 0) {
			$angela_tabs[$angela_cat] = esc_html__('All', 'angela');
			foreach ($angela_portfolio_list as $angela_term) {
				if (isset($angela_term->term_id)) $angela_tabs[$angela_term->term_id] = $angela_term->name;
			}
		}
	}
	if (count($angela_tabs) > 0) {
		$angela_portfolio_filters_ajax = true;
		$angela_portfolio_filters_active = $angela_cat;
		$angela_portfolio_filters_id = 'portfolio_filters';
		?>
		<div class="portfolio_filters angela_tabs angela_tabs_ajax">
			<ul class="portfolio_titles angela_tabs_titles">
				<?php
				foreach ($angela_tabs as $angela_id=>$angela_title) {
					?><li><a href="<?php echo esc_url(angela_get_hash_link(sprintf('#%s_%s_content', $angela_portfolio_filters_id, $angela_id))); ?>" data-tab="<?php echo esc_attr($angela_id); ?>"><?php echo esc_html($angela_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$angela_ppp = angela_get_theme_option('posts_per_page');
			if (angela_is_inherit($angela_ppp)) $angela_ppp = '';
			foreach ($angela_tabs as $angela_id=>$angela_title) {
				$angela_portfolio_need_content = $angela_id==$angela_portfolio_filters_active || !$angela_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $angela_portfolio_filters_id, $angela_id)); ?>"
					class="portfolio_content angela_tabs_content"
					data-blog-template="<?php echo esc_attr(angela_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(angela_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($angela_ppp); ?>"
					data-post-type="<?php echo esc_attr($angela_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($angela_taxonomy); ?>"
					data-cat="<?php echo esc_attr($angela_id); ?>"
					data-parent-cat="<?php echo esc_attr($angela_cat); ?>"
					data-need-content="<?php echo (false===$angela_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($angela_portfolio_need_content) 
						angela_show_portfolio_posts(array(
							'cat' => $angela_id,
							'parent_cat' => $angela_cat,
							'taxonomy' => $angela_taxonomy,
							'post_type' => $angela_post_type,
							'page' => 1,
							'sticky' => $angela_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		angela_show_portfolio_posts(array(
			'cat' => $angela_cat,
			'parent_cat' => $angela_cat,
			'taxonomy' => $angela_taxonomy,
			'post_type' => $angela_post_type,
			'page' => 1,
			'sticky' => $angela_sticky_out
			)
		);
	}

	angela_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>