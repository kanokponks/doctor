<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage ANGELA
 * @since ANGELA 1.0.10
 */

// Copyright area
$angela_footer_scheme =  angela_is_inherit(angela_get_theme_option('footer_scheme')) ? angela_get_theme_option('color_scheme') : angela_get_theme_option('footer_scheme');
$angela_copyright_scheme = angela_is_inherit(angela_get_theme_option('copyright_scheme')) ? $angela_footer_scheme : angela_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($angela_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$angela_copyright = angela_prepare_macros(angela_get_theme_option('copyright'));
				if (!empty($angela_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $angela_copyright, $angela_matches)) {
						$angela_copyright = str_replace($angela_matches[1], date_i18n(str_replace(array('{', '}'), '', $angela_matches[1])), $angela_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($angela_copyright));
				}
			?></div>
		</div>
	</div>
</div>
