<?php
if (!defined('ABSPATH')) {
    exit; // verhindert direkten Zugriff
}
// Abrufen der gespeicherten Optionen
//$options = get_option('immo_funnel_options', []);
$options_min = get_option('immo_funnel_min', []);
$options_rate_limit = get_option('immo_funnel_rate_limit', []);
$options_style = get_option('immo_funnel_style', []);
$options_icon = get_option('immo_funnel_icon', []);

// Seiten- oder Companyname definieren
define('SITENAME', !empty($options_min['site_name']) ? $options_min['site_name'] : '');

// Seite auf der der Shortcode eingebunden ist
define('SHORTCODE_EMBEDED_SITE', !empty($options_min['embeded_site']) ? $options_min['embeded_site'] : '');

// Emailadressen und Links des Funnels definieren
// Absendeadresse des Funnels
define('SENDER_EMAIL_ADDRESS', !empty($options_min['sender_email']) ? $options_min['sender_email'] : '');
// Empängeradresse Zusammenfassung
define('RECIVER_EMAIL_ADDRESS', !empty($options_min['reciver_email']) ? $options_min['reciver_email'] : '');
// Link zur Datenschutzerklärung definieren
define('PRIVACY_POLICY', !empty($options_min['privacy_policy']) ? $options_min['privacy_policy'] : '');

// Cloudflare Turnstile CAPTCHA einrichten
// Secretkey definieren
define('TURNSTILE_SECRET_KEY', !empty($options_min['turnstile_secret_key']) ? $options_min['turnstile_secret_key'] : '');
// Sitekey definieren
define('TURNSTILE_PUBLIC_KEY', !empty($options_min['turnstile_public_key']) ? $options_min['turnstile_public_key'] : '');

// Sicherheitseinrichtung
// Gültigkeit der Session in Sekunden
define('IMMO_FUNNEL_SESSION_TIME', '3600');
// Ratelimit für Anfragen je Zeiteinheit
define('IMMO_FUNNEL_RATELIMIT_MINUTE', !empty($options_rate_limit['rate_limit_minute']) ? $options_rate_limit['rate_limit_minute'] : '2');
define('IMMO_FUNNEL_RATELIMIT_HOUR', !empty($options_rate_limit['rate_limit_hour']) ? $options_rate_limit['rate_limit_hour'] : '10');
define('IMMO_FUNNEL_RATELIMIT_DAY', !empty($options_rate_limit['rate_limit_day']) ? $options_rate_limit['rate_limit_day'] : '30');

// Die verwendeten Icons im Funnel definieren
global $immo_funnel_icons;
$immo_funnel_icons = [
    'back' => !empty($options_icon['icon_back']) ? $options_icon['icon_back'] : plugin_dir_url(__DIR__) . 'assets/icons/back.png',
    'next_active' => !empty($options_icon['icon_next_active']) ? $options_icon['icon_next_active'] : plugin_dir_url(__DIR__) . 'assets/icons/next_active.png',
    'next' => !empty($options_icon['icon_next_inactive']) ? $options_icon['icon_next_inactive'] : plugin_dir_url(__DIR__) . 'assets/icons/next.png',
    'next_hover' => !empty($options_icon['icon_next_hover']) ? $options_icon['icon_next_hover'] : plugin_dir_url(__DIR__) . 'assets/icons/next_hover.png',
    'send_active' => !empty($options_icon['icon_send_active']) ? $options_icon['icon_send_active'] : plugin_dir_url(__DIR__) . 'assets/icons/send_active.png',
    'send' => !empty($options_icon['icon_send_inactive']) ? $options_icon['icon_send_inactive'] : plugin_dir_url(__DIR__) . 'assets/icons/send.png',
    'send_hover' => !empty($options_icon['icon_send_hover']) ? $options_icon['icon_send_hover'] : plugin_dir_url(__DIR__) . 'assets/icons/send_hover.png',
    'neu_active' => !empty($options_icon['icon_new_active']) ? $options_icon['icon_new_active'] : plugin_dir_url(__DIR__) . 'assets/icons/neu_active.png',
    'neu_hover' => !empty($options_icon['icon_new_hover']) ? $options_icon['icon_new_hover'] : plugin_dir_url(__DIR__) . 'assets/icons/neu_hover.png',
    'site_icon' => !empty($options_icon['icon_site_icon']) ? $options_icon['icon_site_icon'] : plugin_dir_url(__DIR__) . 'assets/icons/planetkosy_site_icon.png',
	'site_logo' => !empty($options_icon['icon_site_logo']) ? $options_icon['icon_site_logo'] : plugin_dir_url(__DIR__) . 'assets/icons/planetkosy_site_logo.png',
	'Eigennutzung' => !empty($options_icon['icon_eigennutzung']) ? $options_icon['icon_eigennutzung'] : plugin_dir_url(__DIR__) . 'assets/icons/eigen.png',
    'Vermietung' => !empty($options_icon['icon_vermietung']) ? $options_icon['icon_vermietung'] : plugin_dir_url(__DIR__) . 'assets/icons/rent.png',
    'Beides' => !empty($options_icon['icon_beides']) ? $options_icon['icon_beides'] : plugin_dir_url(__DIR__) . 'assets/icons/beides.png',
    'EFH' => !empty($options_icon['icon_efh']) ? $options_icon['icon_efh'] : plugin_dir_url(__DIR__) . 'assets/icons/efh.jpg',
    'ETW' => !empty($options_icon['icon_etw']) ? $options_icon['icon_etw'] : plugin_dir_url(__DIR__) . 'assets/icons/etw.jpg',
    'DHH' => !empty($options_icon['icon_dhh']) ? $options_icon['icon_dhh'] : plugin_dir_url(__DIR__) . 'assets/icons/dhh.jpg',
    'RH' => !empty($options_icon['icon_rh']) ? $options_icon['icon_rh'] : plugin_dir_url(__DIR__) . 'assets/icons/rh.jpg',
    'MFH' => !empty($options_icon['icon_mfh']) ? $options_icon['icon_mfh'] : plugin_dir_url(__DIR__) . 'assets/icons/mfh.jpg',
    'GS' => !empty($options_icon['icon_gs']) ? $options_icon['icon_gs'] : plugin_dir_url(__DIR__) . 'assets/icons/gs.jpg',
    'A+' => plugin_dir_url(__DIR__) . 'assets/icons/aplus.png',
    'A' => plugin_dir_url(__DIR__) . 'assets/icons/a.png',
    'B' => plugin_dir_url(__DIR__) . 'assets/icons/b.png',
    'C' => plugin_dir_url(__DIR__) . 'assets/icons/c.png',
    'D' => plugin_dir_url(__DIR__) . 'assets/icons/d.png',
    'E' => plugin_dir_url(__DIR__) . 'assets/icons/e.png',
    'F' => plugin_dir_url(__DIR__) . 'assets/icons/f.png',
    'G' => plugin_dir_url(__DIR__) . 'assets/icons/g.png',
    'H' => plugin_dir_url(__DIR__) . 'assets/icons/h.png',
    'EGAL' => plugin_dir_url(__DIR__) . 'assets/icons/egal.png',
	'CI_PICTURE' => !empty($options_icon['icon_ci_picture']) ? $options_icon['icon_ci_picture'] : plugin_dir_url(__DIR__) . 'assets/icons/immo_search.jpg',
];

// Die zu vervendenden Farben definieren
global $immo_funnel_colors;
$immo_funnel_colors = [
    'primary_first' => !empty($options_style['primary_first_color']) ? $options_style['primary_first_color'] : '#404040',
    'primary_second' => !empty($options_style['primary_second_color']) ? $options_style['primary_second_color'] : '#f4f4f4',
    'secondary_first' => !empty($options_style['secondary_first_color']) ? $options_style['secondary_first_color'] : '#00A170',
    'secondary_second' => !empty($options_style['secondary_second_color']) ? $options_style['secondary_second_color'] : '#404040',
];

// Weitere Funnel-Styles definieren
global $immo_funnel_styles;

$box_shadow = isset($options_style['box_shadow']) ? $options_style['box_shadow'] : [];
$funnel_box_shadow = sprintf(
    '%s %s %s %s %s',
    !empty($box_shadow['horizontal_offset']) ? $box_shadow['horizontal_offset'] . 'px' : '0px',
    !empty($box_shadow['vertical_offset']) ? $box_shadow['vertical_offset'] . 'px' : '2px',
    !empty($box_shadow['blur_radius']) ? $box_shadow['blur_radius'] . 'px' : '10px',
    !empty($box_shadow['spread_radius']) ? $box_shadow['spread_radius'] . 'px' : '0px',
    !empty($box_shadow['color']) ? $box_shadow['color'] : 'rgba(0, 0, 0, 0.1)'
);

// Verwende $funnel_box_shadow in deiner Konfiguration
$immo_funnel_styles['funnel_box_shadow'] = $funnel_box_shadow;

$immo_funnel_styles =[
    'funnel_border_radius' => !empty($options_style['funnel_border_radius']) ? $options_style['funnel_border_radius'] . 'px' : '10px',
    'funnel_box_shadow' => $funnel_box_shadow,
    'input_border_width' => !empty($options_style['input_border_width']) ? $options_style['input_border_width'] . 'px' : '1px',
    'input_border_radius' => !empty($options_style['input_border_radius']) ? $options_style['input_border_radius'] . 'px' : '5px',
];