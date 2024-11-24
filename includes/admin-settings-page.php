<?php
// Sicherheitscheck
if (!defined('ABSPATH')) {
    exit;
}

// Erfolgs- oder Fehlermeldung nach dem Speichern der Einstellungen
function immo_funnel_save_settings_message() {
    if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == true) {
        add_settings_error('immo_funnel_options', 'settings_updated', 'Einstellungen wurden erfolgreich gespeichert.', 'updated');
    } elseif (isset($_GET['settings-updated']) && $_GET['settings-updated'] == false) {
        add_settings_error('immo_funnel_options', 'settings_error', 'Beim Speichern der Einstellungen ist ein Fehler aufgetreten.', 'error');
    }
}
add_action('admin_init', 'immo_funnel_save_settings_message');

// Einstellungsseite registrieren
function immo_funnel_add_admin_settings_page() {
    add_menu_page(
        'Immo Funnel Einstellungen', // Seitentitel
        'Immo Funnel',               // Menüeintrag
        'manage_options',            // Berechtigung
        'immo-funnel-settings',      // Slug
        'immo_funnel_render_settings_page', // Callback-Funktion
        'dashicons-admin-generic',   // Icon
        99                           // Position
    );
}
add_action('admin_menu', 'immo_funnel_add_admin_settings_page');

// Callback-Funktion für die Seite mit Tab-Übersicht
function immo_funnel_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Immo Funnel Einstellungen</h1>
		<?php
        settings_errors('immo_funnel_options');
        ?>

        <!-- Tabs -->
        <h2 class="nav-tab-wrapper">
            <a href="#tab-minimal" class="nav-tab">Mindest-Konfiguration</a>
            <a href="#tab-rate-limit" class="nav-tab">Rate-Limit-Konfiguration</a>
            <a href="#tab-style" class="nav-tab">Style-Konfiguration</a>
            <a href="#tab-icon" class="nav-tab">Icon-Konfiguration</a>
        </h2>

        <!-- Inhalte der Tabs -->
        <div id="tab-minimal" class="tab-content" style="display: none;">
            <form method="post" action="options.php">
                <?php
                settings_fields('immo_funnel_min_settings');
                do_settings_sections('immo-funnel-min-settings');
                submit_button();
                ?>
            </form>
        </div>

        <div id="tab-rate-limit" class="tab-content" style="display: none;">
            <form method="post" action="options.php">
                <?php
                settings_fields('immo_funnel_rate_limit_settings');
                do_settings_sections('immo-funnel-rate-limit-settings');
                submit_button();
                ?>
            </form>
        </div>

        <div id="tab-style" class="tab-content" style="display: none;">
            <form method="post" action="options.php">
                <?php
                settings_fields('immo_funnel_style_settings');
                do_settings_sections('immo-funnel-style-settings');
                submit_button();
                ?>
            </form>
        </div>

        <div id="tab-icon" class="tab-content" style="display: none;">
            <form method="post" action="options.php">
                <?php
                settings_fields('immo_funnel_icon_settings');
                do_settings_sections('immo-funnel-icon-settings');
                submit_button();
                ?>
            </form>
        </div>
    </div>
    <?php
}

// Einstellungen und Felder registrieren
function immo_funnel_register_settings() {
    // Registrierung der Einstellungen
    //register_setting('immo_funnel_settings', 'immo_funnel_options');
	register_setting('immo_funnel_min_settings', 'immo_funnel_min');
    register_setting('immo_funnel_rate_limit_settings', 'immo_funnel_rate_limit');
    register_setting('immo_funnel_style_settings', 'immo_funnel_style');
    register_setting('immo_funnel_icon_settings', 'immo_funnel_icon');

    // Minimal Eintellungen Abschnitt hinzufügen
    add_settings_section(
        'immo_funnel_min_section',       // ID des Abschnitts
        'Mindest Einstellungen',          // Titel des Abschnitts
        'immo_funnel_min_section_callback',   // Callback für Beschreibung
        'immo-funnel-min-settings'            // Slug der Einstellungsseite
    );

    // Felder hinzufügen
    add_settings_field(
        'site_name',                      // ID des Feldes
        'Seiten oder Firmenname*',         // Label
        'immo_funnel_site_name_field',    // Callback für HTML
        'immo-funnel-min-settings',           // Slug der Einstellungsseite
        'immo_funnel_min_section'        // ID des Abschnitts
    );

    add_settings_field(
        'embeded_site',                   // ID des Feldes
        'Seitenname Shortcode Einbindung*',// Label
        'immo_funnel_embeded_site_field', // Callback für HTML
        'immo-funnel-min-settings',           // Slug der Einstellungsseite
        'immo_funnel_min_section'        // ID des Abschnitts
    );

    add_settings_field(
        'sender_email',                   // ID des Feldes
        'Absender-E-Mail-Adresse*',        // Label
        'immo_funnel_sender_email_field', // Callback für HTML
        'immo-funnel-min-settings',           // Slug der Einstellungsseite
        'immo_funnel_min_section'        // ID des Abschnitts
    );

    add_settings_field(
        'reciver_email',
        'Empfänger-E-Mail-Adresse*',
        'immo_funnel_reciver_email_field',
        'immo-funnel-min-settings',
        'immo_funnel_min_section'
    );

    add_settings_field(
        'privacy_policy',
        'Link zur Datenschutzerklärung*',
        'immo_funnel_privacy_policy_field',
        'immo-funnel-min-settings',
        'immo_funnel_min_section'
    );

    add_settings_field(
        'turnstile_public_key',           // ID des Feldes
        'Turnstile CAPTCHA Site-Key*',     // Label
        'immo_funnel_turnstile_public_key_field', // Callback für HTML
        'immo-funnel-min-settings',           // Slug der Einstellungsseite
        'immo_funnel_min_section'        // ID des Abschnitts
    );

    add_settings_field(
        'turnstile_secret_key',            // ID des Feldes
        'Turnstile CAPTCHA Secret-Key*',    // Label
        'immo_funnel_turnstile_secret_key_field', // Callback für HTML
        'immo-funnel-min-settings',           // Slug der Einstellungsseite
        'immo_funnel_min_section'        // ID des Abschnitts
    );

    // Rate-Limit Abschnitt hinzufügen
    add_settings_section(
        'immo_funnel_rate_limit_section',       // ID des Abschnitts
        'Rate Limit Einstellungen',          // Titel des Abschnitts
        'immo_funnel_rate_limit_section_callback',   // Callback für Beschreibung
        'immo-funnel-rate-limit-settings'            // Slug der Einstellungsseite
    );

    add_settings_field(
        'rate_limit_minute',            // ID des Feldes
        'Maximale Anfragen pro Minute',    // Label
        'immo_funnel_rate_limit_minute_field', // Callback für HTML
        'immo-funnel-rate-limit-settings',           // Slug der Einstellungsseite
        'immo_funnel_rate_limit_section'        // ID des Abschnitts
    );

    add_settings_field(
        'rate_limit_hour',            // ID des Feldes
        'Maximale Anfragen pro Stune',    // Label
        'immo_funnel_rate_limit_hour_field', // Callback für HTML
        'immo-funnel-rate-limit-settings',           // Slug der Einstellungsseite
        'immo_funnel_rate_limit_section'        // ID des Abschnitts
    );

    add_settings_field(
        'rate_limit_day',            // ID des Feldes
        'Maximale Anfragen pro Tag',    // Label
        'immo_funnel_rate_limit_day_field', // Callback für HTML
        'immo-funnel-rate-limit-settings',           // Slug der Einstellungsseite
        'immo_funnel_rate_limit_section'        // ID des Abschnitts
    );

    // Color Eintellungen Abschnitt hinzufügen
    add_settings_section(
        'immo_funnel_style_section',       // ID des Abschnitts
        'Style Einstellungen',          // Titel des Abschnitts
        'immo_funnel_style_section_callback',   // Callback für Beschreibung
        'immo-funnel-style-settings'            // Slug der Einstellungsseite
    );

    add_settings_field(
        'primary_first_color', // ID des Feldes
        'Primäre Farbe 1', // Label
        'immo_funnel_primary_first_color_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'primary_second_color', // ID des Feldes
        'Primäre Farbe 2', // Label
        'immo_funnel_primary_second_color_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'secondary_first_color', // ID des Feldes
        'Sekundäre Farbe 1', // Label
        'immo_funnel_secondary_first_color_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'secondary_second_color', // ID des Feldes
        'Sekundäre Farbe 2', // Label
        'immo_funnel_secondary_second_color_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'funnel_border_radius', // ID des Feldes
        'Funnel Abrundung Ecken', // Label
        'immo_funnel_funnel_border_radius_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'input_border_radius', // ID des Feldes
        'Eingabefeld Abrundung Ecken', // Label
        'immo_funnel_input_border_radius_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'input_border_width', // ID des Feldes
        'Eingabefeld Rahmenstärke', // Label
        'immo_funnel_input_border_width_field', // Callback
        'immo-funnel-style-settings', // Slug der Einstellungsseite
        'immo_funnel_style_section' // Abschnitt
    );

    add_settings_field(
        'funnel_box_shadow', 
        'Funnel-Box-Shadow', 
        'immo_funnel_funnel_box_shadow_fields', 
        'immo-funnel-style-settings', 
        'immo_funnel_style_section'
    );

    // Icon Eintellungen Abschnitt hinzufügen
    add_settings_section(
        'immo_funnel_icon_section',       // ID des Abschnitts
        'Icon Einstellungen',          // Titel des Abschnitts
        'immo_funnel_icon_section_callback',   // Callback für Beschreibung
        'immo-funnel-icon-settings'            // Slug der Einstellungsseite
    );

    add_settings_field(
        'icon_back',
        'Icon Zurück Button',
        function () {
            immo_funnel_icon_field('icon_back', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );
    
    add_settings_field(
        'icon_next_inactive',
        'Weiter Button inaktiv',
        function () {
            immo_funnel_icon_field('icon_next_inactive', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_next_active',
        'Weiter Button aktiv',
        function () {
            immo_funnel_icon_field('icon_next_active', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_next_hover',
        'Weiter Button MouseOver',
        function () {
            immo_funnel_icon_field('icon_next_hover', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_send_inactive',
        'Senden Button inaktiv',
        function () {
            immo_funnel_icon_field('icon_send_inactive', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_send_active',
        'Senden Button aktiv',
        function () {
            immo_funnel_icon_field('icon_send_active', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_send_hover',
        'Senden Button MouseOver',
        function () {
            immo_funnel_icon_field('icon_send_hover', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_new_active',
        'Neuer Auftrag Button aktiv',
        function () {
            immo_funnel_icon_field('icon_new_active', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_new_hover',
        'Neuer Auftrag Button MouseOver',
        function () {
            immo_funnel_icon_field('icon_new_hover', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_site_icon',
        'Site Icon',
        function () {
            immo_funnel_icon_field('icon_site_icon', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_site_logo',
        'Site Logo',
        function () {
            immo_funnel_icon_field('icon_site_logo', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_eigennutzung',
        'Icon für Eigennutzung',
        function () {
            immo_funnel_icon_field('icon_eigennutzung', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_vermietung',
        'Icon für Vermietung',
        function () {
            immo_funnel_icon_field('icon_vermietung', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_beides',
        'Icon für Beides',
        function () {
            immo_funnel_icon_field('icon_beides', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_efh',
        'Icon Einfamilienhaus',
        function () {
            immo_funnel_icon_field('icon_efh', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_etw',
        'Icon Eigentumswohnung',
        function () {
            immo_funnel_icon_field('icon_etw', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_dhh',
        'Icon Doppelhaushälfte',
        function () {
            immo_funnel_icon_field('icon_dhh', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_rh',
        'Icon Reihenhaus',
        function () {
            immo_funnel_icon_field('icon_rh', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_mfh',
        'Icon Mehrfamilienhaus',
        function () {
            immo_funnel_icon_field('icon_mfh', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_gs',
        'Icon Grundstück',
        function () {
            immo_funnel_icon_field('icon_gs', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );

    add_settings_field(
        'icon_ci_picture',
        'Icon Bild für E-Mail',
        function () {
            immo_funnel_icon_field('icon_ci_picture', '');
        },
        'immo-funnel-icon-settings',
        'immo_funnel_icon_section'
    );
}
add_action('admin_init', 'immo_funnel_register_settings');

// Beschreibung des Abschnitts Mininmal Eistellungen
function immo_funnel_min_section_callback() {
    echo '<p>Hier kannst du die grundlegenden Einstellungen für den Immo Funnel vornehmen.</p>';
}

// Beschreibung des Abschnitts Rate Limit Einstellungen
function immo_funnel_rate_limit_section_callback() {
    echo '<p>Hier kannst du die Rate-Limits für Anfragen von einer IP pro Minute, Stunde und Tag festlegen.</p>';
}

// Beschreibung des Abschnitts Style Einstellungen
function immo_funnel_style_section_callback() {
    echo '<p>Hier kannst du die Styles des Funnels festlegen.</p>';
}

// Beschreibung des Abschnitts Icon Einstellungen
function immo_funnel_icon_section_callback() {
    echo '<p>Hier kannst du die im Funnel verwendeten Icons festlegen.</p>';
}

// Callback-Funktionen für die Eingabefelder
function immo_funnel_site_name_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['site_name']) ? esc_attr($options['site_name']) : '';
    echo '<input type="text" name="immo_funnel_min[site_name]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_embeded_site_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['embeded_site']) ? esc_attr($options['embeded_site']) : '';
    echo '<input type="text" name="immo_funnel_min[embeded_site]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_sender_email_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['sender_email']) ? esc_attr($options['sender_email']) : '';
    echo '<input type="email" name="immo_funnel_min[sender_email]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_reciver_email_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['reciver_email']) ? esc_attr($options['reciver_email']) : '';
    echo '<input type="email" name="immo_funnel_min[reciver_email]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_privacy_policy_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['privacy_policy']) ? esc_url($options['privacy_policy']) : '';
    echo '<input type="url" name="immo_funnel_min[privacy_policy]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_turnstile_public_key_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['turnstile_public_key']) ? esc_attr($options['turnstile_public_key']) : '';
    echo '<input type="text" name="immo_funnel_min[turnstile_public_key]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_turnstile_secret_key_field() {
    $options = get_option('immo_funnel_min');
    $value = isset($options['turnstile_secret_key']) ? esc_attr($options['turnstile_secret_key']) : '';
    echo '<input type="password" name="immo_funnel_min[turnstile_secret_key]" value="' . $value . '" class="regular-text" required>';
}

function immo_funnel_rate_limit_minute_field() {
    $options = get_option('immo_funnel_rate_limit');
    $value = isset($options['rate_limit_minute']) ? esc_attr($options['rate_limit_minute']) : '';
    echo '<input type="number" name="immo_funnel_rate_limit[rate_limit_minute]" value="' . $value . '" class="medium-text">';
}

function immo_funnel_rate_limit_hour_field() {
    $options = get_option('immo_funnel_rate_limit');
    $value = isset($options['rate_limit_hour']) ? esc_attr($options['rate_limit_hour']) : '';
    echo '<input type="number" name="immo_funnel_rate_limit[rate_limit_hour]" value="' . $value . '" class="medium-text">';
}

function immo_funnel_rate_limit_day_field() {
    $options = get_option('immo_funnel_rate_limit');
    $value = isset($options['rate_limit_day']) ? esc_attr($options['rate_limit_day']) : '';
    echo '<input type="number" name="immo_funnel_rate_limit[rate_limit_day]" value="' . $value . '" class="medium-text">';
}

function immo_funnel_primary_first_color_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['primary_first_color']) ? esc_attr($options['primary_first_color']) : '#404040';
    echo '<input type="text" class="immo-funnel-color-field" name="immo_funnel_style[primary_first_color]" value="' . $value . '" data-default-color="#404040">';
}

function immo_funnel_primary_second_color_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['primary_second_color']) ? esc_attr($options['primary_second_color']) : '#f4f4f4';
    echo '<input type="text" class="immo-funnel-color-field" name="immo_funnel_style[primary_second_color]" value="' . $value . '" data-default-color="#f4f4f4">';
}

function immo_funnel_secondary_first_color_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['secondary_first_color']) ? esc_attr($options['secondary_first_color']) : '#00A170';
    echo '<input type="text" class="immo-funnel-color-field" name="immo_funnel_style[secondary_first_color]" value="' . $value . '" data-default-color="#00A170">';
}

function immo_funnel_secondary_second_color_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['secondary_second_color']) ? esc_attr($options['secondary_second_color']) : '#404040';
    echo '<input type="text" class="immo-funnel-color-field" name="immo_funnel_style[secondary_second_color]" value="' . $value . '" data-default-color="#476345">';
}

function immo_funnel_funnel_border_radius_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['funnel_border_radius']) ? intval($options['funnel_border_radius']) : '';
    echo '<input type="number" name="immo_funnel_style[funnel_border_radius]" value="' . $value . '" class="small-text"> px';
}

function immo_funnel_input_border_radius_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['input_border_radius']) ? intval($options['input_border_radius']) : '';
    echo '<input type="number" name="immo_funnel_style[input_border_radius]" value="' . $value . '" class="small-text"> px';
}

function immo_funnel_input_border_width_field() {
    $options = get_option('immo_funnel_style');
    $value = isset($options['input_border_width']) ? intval($options['input_border_width']) : '';
    echo '<input type="number" name="immo_funnel_style[input_border_width]" value="' . $value . '" class="small-text"> px';
}

function immo_funnel_funnel_box_shadow_fields() {
    $options = get_option('immo_funnel_style');
    
    $fields = [
        'horizontal_offset' => 'Horizontaler Versatz:',
        'vertical_offset' => 'Verticaler Versatz:',
        'blur_radius' => 'Unschärfe:',
        'spread_radius' => 'Ausbreitung:',
        'color' => 'Schattenfarbe:',
    ];
    
    foreach ($fields as $key => $label) {
        $value = isset($options['box_shadow'][$key]) ? esc_attr($options['box_shadow'][$key]) : '';
        if($key === 'color') {
            echo '
            <label for="box_shadow_' . $key . '">' . $label . '</label>
            <input type="text" id="box_shadow_' . $key . '" name="immo_funnel_style[box_shadow][' . $key . ']" value="' . $value . '" class="medium-text"> Format: rgba(0,0,0,0.1)<br><br>';
        } else {
        echo '
            <label for="box_shadow_' . $key . '">' . $label . '</label>
            <input type="text" id="box_shadow_' . $key . '" name="immo_funnel_style[box_shadow][' . $key . ']" value="' . $value . '" class="small-text"> px<br><br>';
        }
    }
}

function immo_funnel_icon_field($field_id, $label) {
    $options = get_option('immo_funnel_icon');
    $value = isset($options[$field_id]) ? esc_url($options[$field_id]) : '';
    echo '
        <label for="' . $field_id . '">' . $label . '</label>
        <input type="text" id="' . $field_id . '" name="immo_funnel_icon[' . $field_id . ']" value="' . $value . '" class="regular-text">
        <button type="button" class="button immo-funnel-upload-button" data-field="' . $field_id . '">Icon auswählen</button>
        <img src="' . $value . '" id="' . $field_id . '_preview" style="max-width: 100px; margin-top: 10px;">
    ';
}