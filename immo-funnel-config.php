<?php
if (!defined('ABSPATH')) {
    exit; // verhindert direkten Zugriff
}
// Abrufen der gespeicherten Optionen
$options = get_option('immo_funnel_options', []);

// Seiten- oder Companyname definieren
define('SITENAME', $options['site_name'] ?? 'default_site_name');

// Seite auf der der Shortcode eingebunden ist
define('SHORTCODE_EMBEDED_SITE', $options['embeded_site'] ?? 'default_embeded_site');

// Emailadressen und Links des Funnels definieren
// Absendeadresse des Funnels
define('SENDER_EMAIL_ADDRESS', $options['sender_email'] ?? 'default_sender@deine-domain.de');
// Empängeradresse Zusammenfassung
define('RECIVER_EMAIL_ADDRESS', $options['receiver_email'] ?? 'default_receiver@deine-domain.de');
// Link zur Datenschutzerklärung definieren
define('PRIVACY_POLICY', $options['privacy_policy'] ?? home_url('/default_datenschutzerklaerung/'));

// Cloudflare Turnstile CAPTCHA einrichten
// Secretkey definieren
define('TURNSTILE_SECRET_KEY', $options['turnstile_secret_key'] ?? 'default_secret_key');
// Sitekey definieren
define('TURNSTILE_PUBLIC_KEY', $options['turnstile_public_key'] ?? 'default_public_key');

// Sicherheitseinrichtung
// Gültigkeit der Session in Sekunden
define('IMMO_FUNNEL_SESSION_TIME', '3600');
// Ratelimit für Anfragen je Zeiteinheit
define('IMMO_FUNNEL_RATELIMIT_MINUTE', $options['rate_limit_minute'] ?? '2');
define('IMMO_FUNNEL_RATELIMIT_HOUR', $options['rate_limit_hour'] ?? '10');
define('IMMO_FUNNEL_RATELIMIT_DAY', $options['rate_limit_day'] ?? '30');

// Die verwendeten Icons im Funnel definieren
global $immo_funnel_icons;
$immo_funnel_icons = [
    'back' => !empty($options['icon_back']) ? $options['icon_back'] : plugin_dir_url(__FILE__) . 'assets/icons/back.png',
    'next_active' => !empty($options['icon_next_active']) ? $options['icon_next_active'] : plugin_dir_url(__FILE__) . 'assets/icons/next_active.png',
    'next' => !empty($options['icon_next_inactive']) ? $options['icon_next_inactive'] : plugin_dir_url(__FILE__) . 'assets/icons/next.png',
    'next_hover' => !empty($options['icon_next_hover']) ? $options['icon_next_hover'] : plugin_dir_url(__FILE__) . 'assets/icons/next_hover.png',
    'send_active' => !empty($options['icon_send_active']) ? $options['icon_send_active'] : plugin_dir_url(__FILE__) . 'assets/icons/send_active.png',
    'send' => !empty($options['icon_send_inactive']) ? $options['icon_send_inactive'] : plugin_dir_url(__FILE__) . 'assets/icons/send.png',
    'send_hover' => !empty($options['icon_send_hover']) ? $options['icon_send_hover'] : plugin_dir_url(__FILE__) . 'assets/icons/send_hover.png',
    'neu_active' => !empty($options['icon_new_active']) ? $options['icon_new_active'] : plugin_dir_url(__FILE__) . 'assets/icons/neu_active.png',
    'neu_hover' => !empty($options['icon_new_hover']) ? $options['icon_new_hover'] : plugin_dir_url(__FILE__) . 'assets/icons/neu_hover.png',
    'site_icon' => !empty($options['icon_site_icon']) ? $options['icon_site_icon'] : plugin_dir_url(__FILE__) . 'assets/icons/planetkosy_site_icon.png',
	'site_logo' => !empty($options['icon_site_logo']) ? $options['icon_site_logo'] : plugin_dir_url(__FILE__) . 'assets/icons/planetkosy_site_logo.png',
	'Eigennutzung' => !empty($options['icon_eigennutzung']) ? $options['icon_eigennutzung'] : plugin_dir_url(__FILE__) . 'assets/icons/eigen.png',
    'Vermietung' => !empty($options['icon_vermietung']) ? $options['icon_vermietung'] : plugin_dir_url(__FILE__) . 'assets/icons/rent.png',
    'Beides' => !empty($options['icon_beides']) ? $options['icon_beides'] : plugin_dir_url(__FILE__) . 'assets/icons/beides.png',
    'EFH' => !empty($options['icon_efh']) ? $options['icon_efh'] : plugin_dir_url(__FILE__) . 'assets/icons/efh.jpg',
    'ETW' => !empty($options['icon_etw']) ? $options['icon_etw'] : plugin_dir_url(__FILE__) . 'assets/icons/etw.jpg',
    'DHH' => !empty($options['icon_dhh']) ? $options['icon_dhh'] : plugin_dir_url(__FILE__) . 'assets/icons/dhh.jpg',
    'RH' => !empty($options['icon_rh']) ? $options['icon_rh'] : plugin_dir_url(__FILE__) . 'assets/icons/rh.jpg',
    'MFH' => !empty($options['icon_mfh']) ? $options['icon_mfh'] : plugin_dir_url(__FILE__) . 'assets/icons/mfh.jpg',
    'GS' => !empty($options['icon_gs']) ? $options['icon_gs'] : plugin_dir_url(__FILE__) . 'assets/icons/gs.jpg',
    'A+' => plugin_dir_url(__FILE__) . 'assets/icons/aplus.png',
    'A' => plugin_dir_url(__FILE__) . 'assets/icons/a.png',
    'B' => plugin_dir_url(__FILE__) . 'assets/icons/b.png',
    'C' => plugin_dir_url(__FILE__) . 'assets/icons/c.png',
    'D' => plugin_dir_url(__FILE__) . 'assets/icons/d.png',
    'E' => plugin_dir_url(__FILE__) . 'assets/icons/e.png',
    'F' => plugin_dir_url(__FILE__) . 'assets/icons/f.png',
    'G' => plugin_dir_url(__FILE__) . 'assets/icons/g.png',
    'H' => plugin_dir_url(__FILE__) . 'assets/icons/h.png',
    'EGAL' => plugin_dir_url(__FILE__) . 'assets/icons/egal.png',
	'CI_PICTURE' => !empty($options['icon_ci_picture']) ? $options['icon_ci_picture'] : plugin_dir_url(__FILE__) . 'assets/icons/immo_search.jpg',
];

// Die zu vervendenden Farben definieren
global $immo_funnel_colors;
$immo_funnel_colors = [
    'primary_first' => $options['primary_first_color'] ?? '#404040',
    'primary_second' => $options['primary_second_coler'] ?? '#f4f4f4',
    'secondary_first' => $options['secondary_first_color'] ?? '#00A170',
    'secondary_second' => $options['secondary_second_color'] ?? '#404040',
];

// Weitere Funnel-Styles definieren
global $immo_funnel_styles;
$immo_funnel_styles =[
    'funnel_border_radius' => $options['funnel_border_radius'] . 'px' ?? '10px',
    'funnel_box_shadow' => $funnel_box_shadow,
    'input_border_width' => $options['input_border_width'] . 'px' ?? '1px',
    'input_border_radius' => $options['input_border_radius'] . 'px' ?? '5px',
];

$box_shadow = isset($options['box_shadow']) ? $options['box_shadow'] : [];
$funnel_box_shadow = sprintf(
    '%s %s %s %s %s',
    $box_shadow['horizontal_offset'] ?? '0px',
    $box_shadow['vertical_offset'] ?? '2px',
    $box_shadow['blur_radius'] ?? '10px',
    $box_shadow['spread_radius'] ?? '0px',
    $box_shadow['color'] ?? 'rgba(0, 0, 0, 0.1)'
);

// Verwende $funnel_box_shadow in deiner Konfiguration
$immo_funnel_styles['funnel_box_shadow'] = $funnel_box_shadow;