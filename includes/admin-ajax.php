<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'immo-funnel-config.php';

add_action('wp_ajax_save_email_template', 'save_email_template');
function save_email_template() {
    // CSRF-Schutz durch Nonce-Validierung
    if (!isset($_POST['save_template_nonce']) || !wp_verify_nonce($_POST['save_template_nonce'], 'save_email_template_nonce')) {
        wp_send_json_error('Ungültiger Sicherheits-Token.');
    }

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

add_action('wp_ajax_preview_email_template', 'preview_email_template');
function preview_email_template() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Keine Berechtigung.');
    }

    $content = isset($_POST['content']) ? wp_unslash($_POST['content']) : '';
    if ($content) {
        wp_send_json_success(['preview' => $content]);
    } else {
        wp_send_json_error('Kein Inhalt für die Vorschau.');
    }
}

add_action('wp_ajax_send_preview_email_template', 'send_preview_email_template');
function send_preview_email_template() {
    // CSRF-Schutz durch Nonce-Validierung
    if (!isset($_POST['send_template_nonce']) || !wp_verify_nonce($_POST['send_template_nonce'], 'send_email_template_nonce')) {
        wp_send_json_error('Ungültiger Sicherheits-Token.');
    }

    if (!current_user_can('manage_options')) {
        wp_send_json_error('Keine Berechtigung.');
    }

    $to = RECIVER_EMAIL_ADDRESS;
    $subject = CONFIRMATION_EMAIL_SUBJECT;
    $confirmation_email_template = load_email_template('confirmation-email-template-preview.php');
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . SENDER_EMAIL_ADDRESS);
    
    $send_preview_confirmation_email_status = wp_mail(
    	$to,
    	$subject,
    	$confirmation_email_template,
		$headers
	);
    
    if ($send_preview_confirmation_email_status) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success'));
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Die E-Mail konnte nicht gesendet werden.'));
        exit();
    }
}