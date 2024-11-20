<?php
if (!defined('ABSPATH')) {
    exit; // verhindert direkten Zugriff
}
// Seiten- oder Companyname definieren
define('SITENAME', 'dein_seitenname');

// Emailadressen und Links des Funnels definieren
// Absendeadresse des Funnels
define('SENDER_EMAIL_ADDRESS', 'example@deine-domain.de');
// Empängeradresse Zusammenfassung
define('RECIVER_EMAIL_ADDRESS', 'example@deine-domain.de');
// Link zur Datenschutzerklärung definieren
define('PRIVACY_POLICY', home_url('/deine-datenschutzerklärung/'));

// Sicherheitseinrichtung
// Gültigkeit der Session in Sekunden
define('IMMO_FUNNEL_SESSION_TIME', '3600');
// Ratelimit für Anfragen je Zeiteinheit
define('IMMO_FUNNEL_RATELIMIT_MINUTE', '2');
define('IMMO_FUNNEL_RATELIMIT_HOUR', '10');
define('IMMO_FUNNEL_RATELIMIT_DAY', '10');

// Cloudflare Turnstile CAPTCHA einrichten
// Secretkey definieren
define('TURNSTILE_SECRET_KEY', 'dein-turnstile-captcha-secret-key');
// Sitekey definieren
define('TURNSTILE_PUBLIC_KEY', 'dein-turnstile-captcha-public-key');

// Die verwendeten Icons im Funnel definieren
global $immo_funnel_icons;
$immo_funnel_icons = [
    'back' => plugin_dir_url(__FILE__) . 'assets/icons/back.png',
    'next_active' => plugin_dir_url(__FILE__) . 'assets/icons/next_active.png',
    'next' => plugin_dir_url(__FILE__) . 'assets/icons/next.png',
    'next_hover' => plugin_dir_url(__FILE__) . 'assets/icons/next_active.png',
    'send_active' => plugin_dir_url(__FILE__) . 'assets/icons/send_active.png',
    'send' => plugin_dir_url(__FILE__) . 'assets/icons/send.png',
    'send_hover' => plugin_dir_url(__FILE__) . 'assets/icons/send_active.png',
    'neu_active' => plugin_dir_url(__FILE__) . 'assets/icons/neu_active.png',
    'neu_hover' => plugin_dir_url(__FILE__) . 'assets/icons/neu_active.png',
    'site_icon' => plugin_dir_url(__FILE__) . 'assets/icons/site_icon.png',
    'site_logo' => plugin_dir_url(__FILE__) . 'assets/icons/site_logo.png',
	'Eigennutzung' => plugin_dir_url(__FILE__) . 'assets/icons/eigen.png',
    'Vermietung' => plugin_dir_url(__FILE__) . 'assets/icons/rent.png',
    'Beides' => plugin_dir_url(__FILE__) . 'assets/icons/beides.png',
    'EFH' => plugin_dir_url(__FILE__) . 'assets/icons/efh.jpg',
    'ETW' => plugin_dir_url(__FILE__) . 'assets/icons/etw.jpg',
    'DHH' => plugin_dir_url(__FILE__) . 'assets/icons/dhh.jpg',
    'RH' => plugin_dir_url(__FILE__) . 'assets/icons/rh.jpg',
    'MFH' => plugin_dir_url(__FILE__) . 'assets/icons/mfh.jpg',
    'GS' => plugin_dir_url(__FILE__) . 'assets/icons/gs.jpg',
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
    'CI_PICTURE' => plugin_dir_url(__FILE__) . 'assets/icons/immo_search.jpg',
];

// Die zu vervendenden Farben definieren
global $immo_funnel_colors;
$immo_funnel_colors = [
    'primary_first' => '#404040',
    'primary_second' => '#f4f4f4',
    'secondary_first' => '#00A170',
    'secondary_second' => '#404040',
];

// Weitere Funnel-Styles definieren
global $immo_funnel_styles;
$immo_funnel_styles =[
    'funnel_border_radius' => '2px',
    'funnel_box_shadow' => '0 2px 10px rgba(0, 0, 0, 0.1)',
    'input_border_width' => '1px',
    'input_border_radius' => '2px',
];