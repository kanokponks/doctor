<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'angela_vc_get_css' ) ) {
	add_filter( 'angela_filter_get_css', 'angela_vc_get_css', 10, 4 );
	function angela_vc_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label,
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	{$fonts['h1_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Row and columns */
.scheme_self.vc_section,
.scheme_self.wpb_row,
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	color: {$colors['text']};
}
/* Background color for blocks with specified scheme (removed, use bg_color instead)
.scheme_self.vc_section[data-vc-full-width="true"],
.scheme_self.wpb_row[data-vc-full-width="true"],
.scheme_self.wpb_column:not([class*="sc_extra_bg_"]) > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	background-color: {$colors['bg_color']};
}
*/
/* Mask for parallax background (removed, use bg_color + bg_mask instead)
.scheme_self.vc_row.vc_parallax[class*="scheme_"] .vc_parallax-inner:before {
	background-color: {$colors['bg_color_08']};
}
*/

/* Accordion */
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel + .vc_tta-panel {
	border-color: {$colors['inverse_link']};
}
.wpb-js-composer .vc_tta-accordion.vc_general .vc_tta-panels-container {
    color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon {
	color: {$colors['text_link']};
	background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
}
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
    background-color: {$colors['alter_bg_color']};
}
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:before,
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
	border-color: {$colors['text_link']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a {
	color: {$colors['text_dark']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover {
	color: {$colors['text_link']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon {
	color: {$colors['text_link']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:after {
	border-color: {$colors['inverse_link']};
}
.sc_button.sc_button_iconed .sc_button_icon span:before,
.vc_tta .vc_tta-controls-icon.vc_tta-controls-icon-chevron::before {
    color: {$colors['text_link']};
}
.sc_button.sc_button_iconed:hover .sc_button_icon span:before,
.vc_tta a:hover .vc_tta-controls-icon.vc_tta-controls-icon-chevron::before {
   color: {$colors['inverse_link']};
}
.wpb-js-composer .vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:after {
    background:{$colors['inverse_link']};
}
.vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a span {
    color: {$colors['text_link']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover span,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a span {
    color: {$colors['inverse_link']};
}
/* Tabs */
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a {
	color: {$colors['inverse_link']};
	background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a {
	color: {$colors['inverse_hover']};
	background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
}

/* Separator */
.vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['bd_color']};
}

/* Progress bar */
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
	background-color: {$colors['alter_bg_hover']};
}
.vc_progress_bar.vc_progress_bar_narrow.vc_progress-bar-color-blue  .vc_single_bar .vc_bar {
	background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label {
	color: {$colors['text_dark']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['text_dark']};
}
.scheme_dark .vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
    background-color: {$colors['text_link']};
}


.vc_color-grey.vc_message_box {
    background-color: {$colors['alter_bg_hover']};
    color: {$colors['text_dark']};
}
.vc_color-grey.vc_message_box .vc_message_box-icon {
    color: {$colors['text_dark']};
}
.vc_color-grey.vc_message_box.vc_message_box_closeable:after {
    color: {$colors['text_dark']};
}
.vc_color-warning.vc_message_box {
    background-color: {$colors['text_hover']};
    color: {$colors['inverse_link']};
}
.vc_color-warning.vc_message_box.vc_message_box_closeable:after,
.vc_color-warning.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_link']};
}

.vc_color-info.vc_message_box {
    background: {$colors['text_link2']};
    color: {$colors['inverse_link']};
}
.vc_color-info.vc_message_box.vc_message_box_closeable:after,
.vc_color-info.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_link']};
}

.vc_color-success.vc_message_box {
    background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
    color: {$colors['inverse_link']};
}
.vc_color-success.vc_message_box.vc_message_box_closeable:after,
.vc_color-success.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_link']};
}
CSS;
		}

		return $css;
	}
}
?>