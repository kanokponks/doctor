<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('angela_trx_addons_get_mycss')) {
	add_filter('angela_filter_get_css', 'angela_trx_addons_get_mycss', 10, 4);
	function angela_trx_addons_get_mycss($css, $colors, $fonts, $scheme='') {

        if (isset($css['fonts']) && $fonts) {
            $css['fonts'] .= <<<CSS
            h4 big,
            .wpb-js-composer .vc_tta-tabs.vc_tta.vc_general .vc_tta-panel-title,
            div.esg-filter-wrapper .esg-filterbutton, .mptt-navigation-tabs li, div.angela_tabs .angela_tabs_titles li,
            .sc_price_item_price_before,
            .format-audio .post_featured .post_audio_author, .trx_addons_audio_player .audio_author,
            .sidebar[class*="scheme_"] .widget ul li.recentcomments,
            body .mejs-container *  {
                {$fonts['p_font-family']}
            }
            .sc_testimonials_item_author_title,
            .sc_testimonials_item_content,
            .socials_share .socials_caption,
            .post_meta_label,
            .vc_message_box,
            .sc_countdown .sc_countdown_label,
            .sc_countdown_default .sc_countdown_digits,
            .sc_skills_pie.sc_skills_compact_off .sc_skills_item_title,
            .sidebar[class*="scheme_"] .widget ul li.recentcomments > a,
            .sidebar[class*="scheme_"] .widget ul li,
            .trx_addons_dropcap {
                {$fonts['h4_font-family']}
            }

CSS;
        }

        if (isset($css['colors']) && $colors) {
            $css['colors'] .= <<<CSS
            
            /* Inline colors */
            .trx_addons_accent,
            .trx_addons_accent_big,
            .trx_addons_accent > a,
            .trx_addons_accent > * {
                color: {$colors['text_link']};
            }
            .trx_addons_accent_hovered,
            .trx_addons_accent_hovered,
            .trx_addons_accent_hovered > a,
            .trx_addons_accent_hovered > * {
                color: {$colors['text_hover']};
            }
            .trx_addons_accent_bg {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }

            
            /* Tooltip */
            .trx_addons_tooltip {
                color: {$colors['text_dark']};
                border-color: {$colors['text_dark']};
            }
            .trx_addons_tooltip:before {
                background-color: {$colors['alter_bg_color']};
                color: {$colors['text_dark']};
            }
            .trx_addons_tooltip:after {
                border-top-color: {$colors['alter_bg_color']};
            }
            
            
            /* Dropcaps */
            .trx_addons_dropcap_style_1 {
                background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
                color: {$colors['inverse_link']};
            }
            .trx_addons_dropcap_style_2 {
                background: {$colors['bg_color_0']};
                color: {$colors['text_dark']};
            }
            
            
            /* Blockqoute */
            blockquote {
                color: {$colors['inverse_link']};
                background: {$colors['text_link']};
            }
            blockquote cite a,
            blockquote > a, blockquote > p > a,
            blockquote > cite, blockquote > p > cite {
                color: {$colors['inverse_link']};
            }
            blockquote cite a:hover,
            blockquote > a, blockquote > p > a:hover {
                color: {$colors['text_hover']};
            }
            blockquote:before {
                color: {$colors['inverse_link']};
            }
            
            /* Images */
            figure figcaption,
            .wp-caption .wp-caption-text,
            .wp-caption .wp-caption-dd,
            .wp-caption-overlay .wp-caption .wp-caption-text,
            .wp-caption-overlay .wp-caption .wp-caption-dd {
                color: {$colors['text_link']};
                background-color: {$colors['inverse_dark_05']};
            }
            
            
            /* Lists */
            ol li,
            ul[class*="trx_addons_list"] {
                color: {$colors['text']};
            }
            ul[class*="trx_addons_list"] > li:before{
                color: {$colors['text_link']};
            }
            ul[class*="trx_addons_list_custom"] > li:before {
                color: {$colors['text_link']};
                background-color: {$colors['bg_color_0']};
            }
            
            /* Table */
            table th {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_dark']};
            }
            table th, table th + th, table td + th  {
                border-color: {$colors['bg_color_02']};
            }
            table td, table th + td, table td + td {
                color: {$colors['text']};
                border-color: {$colors['bg_color']};
            }
            table > tbody > tr:nth-child(2n+1) > td {
                background-color: {$colors['alter_bg_hover']};
            }
            table > tbody > tr:nth-child(2n) > td {
                background-color: {$colors['alter_bg_color']};
            }

            /* Main menu */
            .sc_layouts_menu_nav>li>a {
                color: {$colors['text']} !important;
            }
            .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li.current-menu-item>a,
            .sc_layouts_menu_nav>li.current-menu-parent>a,
            .sc_layouts_menu_nav>li.current-menu-ancestor>a {
                color: {$colors['text_link']} !important;
            }
            
            /* Dropdown menu */
            .sc_layouts_menu_nav>li ul {
                background-color: {$colors['extra_bg_color']};
            }
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a,
            .sc_layouts_menu_nav>li li>a {
                color: {$colors['inverse_link']} !important;
            }
            .sc_layouts_menu_nav>li li>a:hover:after,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li li>a:hover,
            .sc_layouts_menu_nav>li li.sfHover>a,
            .sc_layouts_menu_nav>li li.current-menu-item>a,
            .sc_layouts_menu_nav>li li.current-menu-parent>a,
            .sc_layouts_menu_nav>li li.current-menu-ancestor>a {
                color: {$colors['text_link']} !important;
                background-color: {$colors['bg_color_0']};
            }
            
            /* Breadcrumbs */
            .sc_layouts_title_caption {
                color: {$colors['text_dark']};
            }
            .sc_layouts_title_breadcrumbs,
            .sc_layouts_title_breadcrumbs a {
                color: {$colors['text_dark']} !important;
            }
            .breadcrumbs_item.current{
                color: {$colors['text_dark']} !important;
            }
            .sc_layouts_title_breadcrumbs a:hover {
                color: {$colors['text_link']} !important;
            }
            
            /* Slider */
            .sc_slider_controls .slider_controls_wrap > a,
            .slider_container.slider_controls_side .slider_controls_wrap > a,
            .slider_outer_controls_side .slider_controls_wrap > a {
                color: {$colors['text_link']};
                background-color: {$colors['bg_color_0']};
            }
            .sc_slider_controls .slider_controls_wrap > a:hover,
            .slider_container.slider_controls_side .slider_controls_wrap > a:hover,
            .slider_outer_controls_side .slider_controls_wrap > a:hover {
                 color: {$colors['text_hover']};
                background-color: {$colors['bg_color_0']};
            }
            
            .slider_container .slider_pagination_wrap .swiper-pagination-bullet,
            .slider_outer .slider_pagination_wrap .swiper-pagination-bullet,
            .swiper-pagination-custom .swiper-pagination-button {
                background-color: {$colors['inverse_link']};
            }
            .swiper-pagination-custom .swiper-pagination-button.swiper-pagination-button-active,
            .slider_container .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active,
            .slider_outer .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active,
            .slider_container .slider_pagination_wrap .swiper-pagination-bullet:hover,
            .slider_outer .slider_pagination_wrap .swiper-pagination-bullet:hover {
                background-color: {$colors['inverse_link_05']};
            }
            
            
            /* Layouts */
            .sc_layouts_logo .logo_text {
                color: {$colors['text_dark']};
            }
            

            /* Shortcodes */
            .sc_skills_pie.sc_skills_compact_off .sc_skills_total {
                color: {$colors['text_dark']};
            }
            .sc_skills_pie.sc_skills_compact_off .sc_skills_item_title {
                color: {$colors['text_dark']};
            }
            .sc_countdown .sc_countdown_label,
            .sc_countdown_default .sc_countdown_digits span {
                color: {$colors['text_dark']};
                background: {$colors['bg_color_0']};
            }
            
            /* Audio */
            .trx_addons_audio_player.without_cover,
            .format-audio .post_featured.without_thumb .post_audio {
                background: {$colors['alter_bg_color']};
                border-color: {$colors['alter_bg_color']};
            }
            .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
            .mejs-controls .mejs-time-rail .mejs-time-current {
                background:linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100% );
            }
            .mejs-controls .mejs-button {
                background: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            .mejs-controls .mejs-button:hover {
                background: {$colors['text_dark']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_audio_player .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total:before, .trx_addons_audio_player .mejs-controls .mejs-time-rail .mejs-time-total:before {
                background: {$colors['bg_color']};
            }
            .mejs-controls .mejs-time-rail .mejs-time-total,
            .mejs-controls .mejs-time-rail .mejs-time-loaded,
            .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
                background: {$colors['bg_color']};
            }
            .without_thumb .mejs-controls .mejs-currenttime,
            .without_thumb .mejs-controls .mejs-duration,
            .trx_addons_audio_player .mejs-container .mejs-controls .mejs-time {
                color: {$colors['text']};
            }
            .format-audio .post_featured .post_audio_author,
            .trx_addons_audio_player.without_cover .audio_author {
                color: {$colors['text']};
            }
            
            
            /* Video */
            .trx_addons_video_player.with_cover .video_hover,
            .format-video .post_featured.with_thumb .post_video_hover {
                color: {$colors['text_link']};
                background-color: {$colors['inverse_link']};
            }
            .trx_addons_video_player.with_cover .video_hover:hover,
            .format-video .post_featured.with_thumb .post_video_hover:hover {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_link']};
            }
            
            /* Price */
            .sc_price_item {
                color: {$colors['text']};
                background-color: {$colors['alter_bg_color']};
            }
            .sc_price div[class*="trx_addons_column"]:nth-child(2n+2) .sc_price_item {
                background-color: {$colors['alter_bg_hover']};
            }
            .sc_price_item:hover {
                color: {$colors['text']};
                background-color: {$colors['alter_bg_color']};
            }
            .sc_price_item:hover .sc_price_item_title,
            .sc_price_item .sc_price_item_title,
            .sc_price_item .sc_price_item_title a {
                color: {$colors['text_dark']};
            }
            .sc_price_item:hover .sc_price_item_title a {
                color: {$colors['text_link']};
            }
            .sc_price_item .sc_price_item_price {
                color: {$colors['text_dark']};
                 background: {$colors['bg_color']};
            }
            .sc_price_item .sc_price_item_description,
            .sc_price_item .sc_price_item_details {
                color: {$colors['text']};
            }
            .sc_price_item_price_before {
                color: {$colors['text_link']};
            }
            
            
            .sc_button.sc_button_iconed:after {
                background: {$colors['bg_color']};
            }
            .alter_bg .sc_button.sc_button_iconed:after,
            .alter_bg.sc_button.sc_button_iconed:after {
                background: {$colors['alter_bg_color']};
            }
            .sc_button.sc_button_iconed {
                color: {$colors['text_link']} !important;
            }
            .sc_button.sc_button_iconed:hover {
                color: {$colors['inverse_link']} !important;
            }
            .widget .comment-author-link:before {
                background: linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100%);
            }
            .widget .comment-author-link {
            	color: {$colors['text_link']};
            }
            .sc_button.sc_button_iconed:hover .sc_button_icon span:before {
                color: {$colors['text_link']};
            }
            .scheme_self.footer_wrap .socials_wrap .social_item .social_icon {
                color: {$colors['inverse_link']};
                background-color: {$colors['inverse_link_01']};
            }
            .scheme_self.footer_wrap .socials_wrap .social_item:hover .social_icon {
                color: {$colors['text_hover']};
                background-color: {$colors['inverse_link_01']};
            }
            .scheme_self.footer_wrap .post_info .post_info_item a:hover,
            .scheme_self.footer_wrap aside .post_item .post_title a{
                color: {$colors['alter_text_08']};
            }
            .scheme_self.footer_wrap .widget ul li a {
                color: {$colors['text']};
            }
            .scheme_self.footer_wrap .post_info .post_info_item a,
            .scheme_self.footer_wrap aside .post_item .post_title a:hover,
            .scheme_self.footer_wrap .widget ul li a:hover {
                color: {$colors['text_link']};
            }
            .sc_recent_news .post_item .post_featured .post_info .post_categories a,
            .post_meta_item.post_categories a {
                color: {$colors['text_dark']};
                background-color: {$colors['text_hover']};
            }
            .sc_recent_news .post_item .post_featured .post_info .post_categories a:hover,
            .post_meta_item.post_categories a:hover {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_link']};
            }
            .post_featured + .post_meta .post_meta_item.post_categories a {
                color: {$colors['text_dark']};
                background-color: {$colors['inverse_link']};
            }
            .post_featured + .post_meta .post_meta_item.post_categories a:hover {
                color: {$colors['text_dark']};
                background-color: {$colors['text_hover']};
            }
            .sc_icons .sc_icons_item_title,
             .socials_share .socials_caption {
                color: {$colors['text_dark']};
             }
             .comment_date {
                color: {$colors['text_link']};
             }
             .sc_action_item_description,
             .sc_services_default .sc_services_item_content,
             .sc_icons_item_description,
             .comment_author a {
                color: {$colors['text']};
             }
             .sc_icons .sc_icons_item_linked:hover .sc_icons_item_description, 
             .comment_author a:before {
                color: {$colors['text_link']};
             }
             .sc_item_subtitle.sc_align_center span:before,
             .sc_item_subtitle.sc_align_center span:after,
             .sc_item_subtitle:before {
                background:linear-gradient(to right, {$colors['text_link2']} 0%, {$colors['text_hover2']} 100% );
             }
             .sc_services_light .sc_services_item_featured_left:nth-child(2n+2),
             .sc_icons.sc_icons_size_small.sc_align_left .sc_icons_item:nth-child(3n+2) {
                background-color: {$colors['alter_bg_color']};
             }
             .sc_services_default .sc_services_item .sc_button.sc_button_iconed:after {
                background-color: {$colors['alter_bg_color']};
             }
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+8) .sc_services_item .sc_button.sc_button_iconed:after,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+8) .sc_services_item,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+6) .sc_services_item .sc_button.sc_button_iconed:after,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+6) .sc_services_item,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+3) .sc_services_item .sc_button.sc_button_iconed:after,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+3) .sc_services_item,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+1) .sc_services_item .sc_button.sc_button_iconed:after,
             .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(8n+1) .sc_services_item {
                background-color: {$colors['alter_bg_hover']};
             }
             .sc_services.sc_services_light .sc_services_item_number {
                background-color: {$colors['bg_color']};
                color: {$colors['text_hover']};
             }
             .sc_team_default .sc_team_item {
                background-color: {$colors['bg_color_0']};
                color: {$colors['text']};
             }
             .sc_team_default .sc_team_item_socials .social_item,
             .team_member_page .team_member_socials .social_item{
                color: {$colors['text_hover']};
             }
             .team_member_page .team_member_socials .social_item .social_icon,
             .sc_team_default .sc_team_item_socials .social_item .social_icon {
                background-color: {$colors['bg_color']};
                color: {$colors['text_hover']};
             }
             .sc_team_default .sc_team_item_socials .social_item:hover,
             .team_member_page .team_member_socials .social_item:hover {
             color: {$colors['text_link']};
             }
             .team_member_page .team_member_socials .social_item:hover .social_icon,
             .sc_team_default .sc_team_item_socials .social_item:hover .social_icon {
                background-color: {$colors['bg_color']};
                color: {$colors['text_link']};
             }
             .sc_testimonials_item_author_subtitle  {
                color: {$colors['text_link']};
             }
             .sc_testimonials_item_author_title {
                color: {$colors['text_dark']};
             }
             .post_item_single .post_content > .post_meta_single .post_share .social_item {
                color: {$colors['inverse_link']} !important;
             }
             .sc_recent_news .post_item .post_featured .post_info *,
             .sc_recent_news .post_item .post_featured .post_info *:hover {
                color: {$colors['inverse_link']};
                background-color: {$colors['bg_color_0']};
             }
             .sc_recent_news .post_item .post_featured .post_info .post_title a:hover,
             .sc_recent_news .post_item .post_featured .post_info a:hover *{
                color: {$colors['text_link']};
             }
             
             body .cq-infobox:after {
                border-color: {$colors['text_link']};
            }
            body .cq-infobox,
            body .cq-draggable-slider,
            .cq-highlight-container:before {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            body .cq-draggable-slider {
                background-color: {$colors['inverse_link_03']};
            }
            .scheme_dark .sc_icons_item_description{
                color: {$colors['inverse_link']};
            }
            .scheme_dark .sc_item_descr {
                color: {$colors['inverse_link_08']};
            }
            .custom .tp-bullet {
                background-color: {$colors['inverse_link']};
            }
            .custom .tp-bullet:hover,
            .custom .tp-bullet.selected {
                background-color: {$colors['inverse_link_05']};
            }
            .sc_icons.sc_icons_size_medium.sc_align_left .sc_icons_image,
            .sc_services_default .sc_services_item_thumb {
                background-color: {$colors['inverse_link']};
            }
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"] .sc_services_item.with_image.sc_services_item_featured_top .sc_button.sc_button_iconed:after,
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"] .sc_services_item.with_image.sc_services_item_featured_top {
                background-color: {$colors['alter_bg_color']};
            }
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(2n+1) .sc_services_item.with_image.sc_services_item_featured_top .sc_button.sc_button_iconed:after,
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(2n+1) .sc_services_item.with_image.sc_services_item_featured_top {
                background-color: {$colors['alter_bg_hover']};
            }
            
            .sc_services .slider_outer .slider_pagination_wrap .swiper-pagination-bullet {
                background-color: {$colors['alter_bg_color']};
            }
            .sc_services .slider_outer .slider_pagination_wrap .swiper-pagination-bullet:hover,
            .sc_services .slider_outer .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active {
                background-color: {$colors['text_link']};
            }
            .sc_slider_controller .slider_outer_direction_vertical .slider_container,
            .sc_slider_controller .slider-slide {
                border-color: {$colors['alter_bg_color']} !important;
            }
            .sc_testimonials_item_content {
                color: {$colors['text']};
            }
            .scheme_dark .sc_testimonials_item_content {
                color: {$colors['inverse_link']};
            }
            .sc_icons.sc_icons_size_small.sc_align_center .sc_icons_columns_wrap .sc_icons_item {
                background-color: {$colors['alter_bg_color']};
            }
            .sc_icons.sc_icons_size_small.sc_align_center .sc_icons_columns_wrap .sc_icons_item .sc_icons_image {
                background-color: {$colors['bg_color']};
            }
            .sc_services_default .with_image.sc_services_item_featured_top.no-excerpt {
                background-color: {$colors['alter_bg_color']} !important;
            }
            .trx_addons_video_player.with_cover .video_mask,
            .format-video .post_featured.with_thumb .mask {
                background-color: {$colors['text_dark_07']};
            }
            .sc_layouts_item_icon {
                color: {$colors['text_link']};
            }
            
            
             
             
            

CSS;
		}

		return $css;
	}
}
?>