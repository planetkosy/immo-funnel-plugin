<?php
/**
 * Plugin Name: Immobilien Such-Funnel
 * Plugin URI: https://github.com/MartinKosemetzky/immo-funnel-plugin
 * Description: Klick-Funnel zur Immobiliensuche als Wordpress-Plugin.
 * Version: 1.1
 * Author: planetkosy
 * Author URI: https://planetkosy.de/
 * Github: https://github.com/MartinKosemetzky/immo-funnel-plugin
 * Tested on WordPress 6.7.1
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 */
if (!defined('ABSPATH')) {
    exit;
}

// Lade die Konfigurationsdatei
include_once plugin_dir_path(__FILE__) . 'includes/immo-funnel-config.php';
// Einstellungsseite einbinden
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings-page.php';

function immo_funnel_start_session()
{
    if (!is_admin() && !session_id()) {
        session_start();
    }
}
add_action('init', 'immo_funnel_start_session');

function immo_funnel_close_session()
{
	if (session_id()) {
    	session_write_close();
	}
}
add_action('wp_footer', 'immo_funnel_close_session');

function immo_funnel_enqueue_jquery()
{
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'immo_funnel_enqueue_jquery');

function immo_funnel_generate_csrf_token()
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	$_SESSION['csrf_token_time'] = time();
    return $_SESSION['csrf_token'];
}

function immo_funnel_shortcode()
{
    $csrf_token = immo_funnel_generate_csrf_token();
    $action_url = plugin_dir_url(__FILE__) . 'includes/immo-funnel-handler.php';
    $csrf_token_input = '<input type="hidden" name="csrf_token" value="' . esc_attr($csrf_token) . '">';

    // Buffer starten und Template laden
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/immo-funnel-template.php';
    return ob_get_clean();
}
add_shortcode('immo_funnel', 'immo_funnel_shortcode');

/*
 * function immo_funnel_image_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'src' => '',
        'alt' => '',
    ), $atts, 'immo_image');

    $img_src = plugin_dir_url(__FILE__) . 'assets/icons/' . $atts['src'];
    return '<img src="' . esc_url($img_src) . '" alt="' . esc_attr($atts['alt']) . '">';
}
add_shortcode('immo_image', 'immo_funnel_image_shortcode');
*/

function immo_funnel_admin_scripts($hook) {
    if ($hook === 'toplevel_page_immo-funnel-settings') { // Nur für die Einstellungsseite
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('immo-funnel-color-picker', plugins_url('assets/js/admin-color-picker.js', __FILE__), array('wp-color-picker'), false, true);

        wp_enqueue_media();
        wp_enqueue_script('immo-funnel-admin-js', plugins_url('assets/js/enqueue_admin.js', __FILE__), array('jquery'), false, true);
    }
}
add_action('admin_enqueue_scripts', 'immo_funnel_admin_scripts');

function immo_funnel_rewrite_dynamic_css() {
    add_rewrite_rule('dynamic-style.css$', 'index.php?immo_dynamic_css=1', 'top');
}
add_action('init', 'immo_funnel_rewrite_dynamic_css');

function immo_funnel_query_vars($query_vars) {
    $query_vars[] = 'immo_dynamic_css';
    return $query_vars;
}
add_filter('query_vars', 'immo_funnel_query_vars');

function immo_funnel_output_dynamic_css() {
    if (get_query_var('immo_dynamic_css')) {
        header('Content-Type: text/css');
        include plugin_dir_path(__FILE__) . 'includes/dynamic-style.php';
        exit;
    }
}
add_action('template_redirect', 'immo_funnel_output_dynamic_css');

function immo_funnel_enqueue_scripts()
{
	
    wp_enqueue_style('nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css');
    wp_enqueue_script('nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js', array(), null, true);
    wp_enqueue_script('turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', array(), null, true);

    wp_enqueue_style('immo-funnel-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
	wp_enqueue_style('immo-funnel-dynamic-style', home_url('/dynamic-style.css'));
    wp_register_script('immo-funnel-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
    if (is_page(SHORTCODE_EMBEDED_SITE)) {
		wp_enqueue_script('immo-funnel-script');
	}

    wp_localize_script('immo-funnel-script', 'immoFunnelAjax', array(
        'ajaxUrl' => plugin_dir_url(__FILE__) . 'includes/immo-funnel-handler.php',
    ));
	
	wp_localize_script('immo-funnel-script', 'immoFunnelConfig', array(
        'turnstilePublicKey' => TURNSTILE_PUBLIC_KEY,
	));
}
add_action('wp_enqueue_scripts', 'immo_funnel_enqueue_scripts');

/*
 * Aktivieren um Style erst im footer zu laden, um etwaiges Überchreiben zu verhindern
 * wp_enqueue_style für style.css und dynamic-style.css in function immo_funnel_enqueue_script() auskommentieren
function immo_funnel_enqueue_style()
{
    wp_enqueue_style('immo-funnel-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), null);
	wp_enqueue_style('immo-funnel-dynamic-style', home_url('/dynamic-style.css', array(), null));
}
add_action('wp_footer', 'immo_funnel_enqueue_style');*/

function immo_funnel_handle_post_request()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nutzung'])) {
        include plugin_dir_path(__FILE__) . 'includes/immo-funnel-handler.php';
    }
}
add_action('init', 'immo_funnel_handle_post_request');

function immo_funnel_flush_rewrites() {
    immo_funnel_rewrite_dynamic_css();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'immo_funnel_flush_rewrites');

// Allgemeine Funktion zum Laden einer E-Mail-Vorlage mit Variablen
function load_email_template($template_filename, $variables = []) {
    ob_start();
    
    // Variablen in den globalen Raum extrahieren, um sie im Template verfügbar zu machen
    extract($variables);
    
    include plugin_dir_path(__FILE__) . 'templates/' . $template_filename;
    $template_content = ob_get_clean();
    
    return $template_content;
}

function immo_funnel_add_settings_link($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=immo-funnel-settings') . '">Einstellungen</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'immo_funnel_add_settings_link');