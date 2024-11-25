<?php
header("Content-Type: text/css");
require_once plugin_dir_path(__FILE__) . 'immo-funnel-config.php'; // Config einbinden
global $immo_funnel_icons;
global $immo_funnel_colors;
global $immo_funnel_styles;
?>

.back-button {
    background-image: url('<?php echo esc_url($immo_funnel_icons['back']); ?>');
}

.next-button:enabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['next_active']); ?>');
}

.next-button:disabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['next']); ?>');
}

.next-button:hover:enabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['next_hover']); ?>');
}

.submit-button:enabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['send_active']); ?>');
}

.submit-button:disabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['send']); ?>');
}

.submit-button:hover:enabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['send_hover']); ?>');
}

.new-button:enabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['neu_active']); ?>');
}

.new-button:hover:enabled {
    background-image: url('<?php echo esc_url($immo_funnel_icons['neu_hover']); ?>');
}

.custom-check input[type="checkbox"]:checked+.custom-checkbox:after {
    background-image: url('<?php echo esc_url($immo_funnel_icons['site_icon']); ?>');
}

.datenschutz-check input[type="checkbox"]:checked+.custom-checkbox:after {
    background-image: url('<?php echo esc_url($immo_funnel_icons['site_icon']); ?>');
}

body {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
}

.step h2 {
    color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.step h3 {
    color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.step p {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
}

.form-container {
	background-color: <?php echo esc_html($immo_funnel_colors['primary_second']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['funnel_border_radius']); ?>;
    box-shadow: <?php echo esc_html($immo_funnel_styles['funnel_box_shadow']); ?>;
}

.slider-values {
    color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.slider-container span {
    color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.progress-bar-container {
    background: <?php echo esc_html($immo_funnel_colors['primary_second']); ?>;
}

.step-progress.active {
    background-color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.noUi-connect {
    background: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.noUi-tooltip {
    background: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
    color: <?php echo esc_html($immo_funnel_colors['primary_second']); ?>;
}

.noUi-handle {
    background: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
    border-color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.step {
    background-color: <?php echo esc_html($immo_funnel_colors['primary_second']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['funnel_border_radius']); ?>;
}

.step h4 {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
}

.custom-radio span {
    color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.custom-text input[type="text"] {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
    border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['input_border_radius']); ?>;
	border-color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.custom-text input[type="email"] {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
    border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['input_border_radius']); ?>;
	border-color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.custom-text input[type="tel"] {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
    border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['input_border_radius']); ?>;
	border-color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

input::placeholder,
textarea::placeholder {
    color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.checkbox-container label {
    color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.custom-check .custom-checkbox {
    border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['input_border_radius']); ?>;
	border-color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.custom-check input[type="checkbox"]:checked+.custom-checkbox {
    border-color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.custom-check input[type="checkbox"]:checked+.custom-checkbox+label {
    color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.energie-radio input[type="radio"]:checked+img {
	border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.custom-textarea textarea {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
    border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['input_border_radius']); ?>;
	border-color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.datenschutz-check .custom-checkbox {
    border-width: <?php echo esc_html($immo_funnel_styles['input_border_width']); ?>;
    border-radius: <?php echo esc_html($immo_funnel_styles['input_border_radius']); ?>;
	border-color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

.datenschutz-check input[type="checkbox"]:checked+.custom-checkbox {
    border-color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

.datenschutz-check label {
    color: <?php echo esc_html($immo_funnel_colors['primary_first']); ?>;
}

a {
    color: <?php echo esc_html($immo_funnel_colors['secondary_first']); ?>;
}

a:hover {
    color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}

a:visited {
    color: <?php echo esc_html($immo_funnel_colors['secondary_second']); ?>;
}