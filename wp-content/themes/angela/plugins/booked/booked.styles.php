<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('angela_booked_get_css')) {
	add_filter('angela_filter_get_css', 'angela_booked_get_css', 10, 4);
	function angela_booked_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page input[type="submit"],
body #booked-profile-page button,
body .booked-list-view input[type="submit"],
body .booked-list-view button,
body table.booked-calendar input[type="submit"],
body table.booked-calendar button,
body .booked-modal input[type="submit"],
body .booked-modal button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

CSS;
		}
		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Calendar */
table.booked-calendar th .monthName a {
	color: {$colors['inverse_link']};
}
table.booked-calendar th .monthName a:hover {
	color: {$colors['inverse_link_08']};
}
.booked-calendar-wrap .booked-appt-list h2 {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-title {
	color: {$colors['text_link']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .spots-available {
}

/* Form fields */
#booked-page-form {
	color: {$colors['text']};
	border-color: {$colors['bd_color']};
}

#booked-profile-page .booked-profile-header {
	background-color: {$colors['bg_color']} !important;
	border-color: transparent !important;
	color: {$colors['text']};
}
#booked-profile-page .booked-user h3 {
	color: {$colors['text_dark']};
}
#booked-profile-page .booked-profile-header .booked-logout-button:hover {
	color: {$colors['text_link']};
}

#booked-profile-page .booked-tabs {
	border-color: {$colors['alter_bd_color']} !important;
}

.booked-modal .bm-window p.booked-title-bar {
	background-color: {$colors['alter_dark']} !important;
}
.booked-modal .bm-window .close i {
	color: {$colors['alter_bg_color']};
}

.booked-calendarSwitcher.calendar,
.booked-calendarSwitcher.calendar select,
#booked-profile-page .booked-tabs {
	background-color: {$colors['alter_bg_color']} !important;
}
#booked-profile-page .booked-tabs li a {
	background-color: {$colors['extra_bg_hover']};
	color: {$colors['extra_dark']};
}
#booked-profile-page .booked-tabs li a i {
	color: {$colors['extra_dark']};
}
table.booked-calendar thead,
table.booked-calendar thead th,
table.booked-calendar tr.days,
table.booked-calendar tr.days th,
#booked-profile-page .booked-tabs li.active a,
#booked-profile-page .booked-tabs li.active a:hover,
#booked-profile-page .booked-tabs li a:hover {
	color: {$colors['extra_dark']} !important;
	background-color: {$colors['text_link']} !important;
}
table.booked-calendar tr.days,
table.booked-calendar tr.days th {
	border-color: {$colors['bg_color']} !important;
}
table.booked-calendar thead th i {
	color: {$colors['extra_dark']} !important;
}
table.booked-calendar td.today .date span {
	border-color: {$colors['text_link']};
}
table.booked-calendar td:hover .date span {
	color: {$colors['text_dark']} !important;
}
table.booked-calendar td.today:hover .date span {
	background-color: {$colors['text_link']} !important;
	color: {$colors['inverse_link']} !important;
}
#booked-profile-page .booked-tab-content {
	background-color: {$colors['bg_color']};
	border-color: {$colors['alter_bd_color']};
}
table.booked-calendar td,
table.booked-calendar td+td {
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['bg_color_0']} !important;
}
body .booked-modal button:hover,
body #booked-profile-page input[type="submit"]:hover, 
body #booked-profile-page button:hover, 
body .booked-list-view input[type="submit"]:hover, 
body .booked-list-view button:hover, 
body table.booked-calendar input[type="submit"]:hover, 
body table.booked-calendar button:hover,
body .booked-modal input[type="submit"]:hover,
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover {
    background-color: {$colors['text_hover']} !important;
}

CSS;
		}

		return $css;
	}
}
?>