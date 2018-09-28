<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.14
 */
$angela_header_video = angela_get_header_video();
$angela_embed_video = '';
if (!empty($angela_header_video) && !angela_is_from_uploads($angela_header_video)) {
	if (angela_is_youtube_url($angela_header_video) && preg_match('/[=\/]([^=\/]*)$/', $angela_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$angela_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($angela_header_video) . '[/embed]' ));
			$angela_embed_video = angela_make_video_autoplay($angela_embed_video);
		} else {
			$angela_header_video = str_replace('/watch?v=', '/embed/', $angela_header_video);
			$angela_header_video = angela_add_to_url($angela_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$angela_embed_video = '<iframe src="' . esc_url($angela_header_video) . '" width="1278" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php angela_show_layout($angela_embed_video); ?></div><?php
	}
}
?>