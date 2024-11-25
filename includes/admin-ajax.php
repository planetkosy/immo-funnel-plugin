<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_ajax_save_email_template', 'save_email_template');
function save_email_template() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Keine Berechtigung.');
    }

    $content = isset($_POST['content']) ? wp_unslash($_POST['content']) : '';
    $template_file = plugin_dir_path(__DIR__) . 'templates/confirmation-email-template.php';

    if (file_put_contents($template_file, $content)) {
        wp_send_json_success('Template gespeichert.');
    } else {
        wp_send_json_error('Fehler beim Speichern.');
    }
}
