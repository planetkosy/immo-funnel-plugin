<?php
// Zugriffsschutz, falls jemand direkt darauf zugreift
if (!defined('ABSPATH')) {
    exit;
}

// Beispiel: Werte für Platzhalter laden
require_once plugin_dir_path(__DIR__) . 'includes/immo-funnel-config.php';
global $immo_funnel_icons, $immo_funnel_colors, $immo_funnel_styles;
$vorname = isset($_GET['vorname']) ? sanitize_text_field($_GET['vorname']) : '"Vorname"';

// Header für korrekte HTML-Ausgabe
header('Content-Type: text/html; charset=UTF-8');

// HTML-Template einbinden
include plugin_dir_path(__File__) . 'confirmation-email-template.php';
