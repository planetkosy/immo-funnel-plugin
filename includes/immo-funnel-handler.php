<?php
// Pfad zu wp-load.php bestimmen
$wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';

if (!defined('ABSPATH')) {
    if (file_exists($wp_load_path)) {
        require_once($wp_load_path);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'wp-load.php nicht gefunden: ' . $wp_load_path));
        exit;
    }
}

require_once plugin_dir_path(__FILE__) . 'immo-funnel-config.php'; // Config einbinden

$time_limit = IMMO_FUNNEL_SESSION_TIME;

// Überprüfen, ob CSRF-Token gesendet wurde und korrekt ist
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Ungültiges CSRF-Token. Anfrage abgelehnt.'));
    exit();
}

// Überprüfen, ob der CSRF-Token-Zeitstempel existiert und ob das Token noch gültig ist
if (!isset($_SESSION['csrf_token_time']) || (time() - $_SESSION['csrf_token_time']) > $time_limit) {
    // Token ist abgelaufen
    unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']); // Optional: Token aus der Session entfernen
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'CSRF-Token abgelaufen.'));
    exit();
}

// CSRF-Token nach erfolgreicher Validierung aus Session entfernen
unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);

// IP-Adresse validieren
$ip_address = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);

// Anfragen Rate-Limit
$rate_limit_per_minute = IMMO_FUNNEL_RATELIMIT_MINUTE;
$rate_limit_per_hour = IMMO_FUNNEL_RATELIMIT_HOUR;
$rate_limit_per_day = IMMO_FUNNEL_RATELIMIT_DAY;

// CAPTCHA-Rate-Limit
$captcha_limit_per_minute = 3;

// Zeitrahmen in Sekunden
$time_window_minute = 60; //Minute
$time_window_hour = 3600; //Stunde
$time_window_day = 86400; //Tag

$current_time = time();

// Initialisierung der Rate-Limits, falls noch nicht gesetzt
if (!isset($_SESSION['rate_limit'][$ip_address])) {
    $_SESSION['rate_limit'][$ip_address] = [];
}

// CAPTCHA-Rate-Limiting pro Minute
if (!isset($_SESSION['rate_limit'][$ip_address]['captcha_minute'])) {
    $_SESSION['rate_limit'][$ip_address]['captcha_minute'] = [
        'count' => 1,
        'start_time' => $current_time
    ];
} else {
    $captcha_info_minute = &$_SESSION['rate_limit'][$ip_address]['captcha_minute'];

    if ($current_time - $captcha_info_minute['start_time'] < $time_window_minute) {
        $captcha_info_minute['count']++;

        if ($captcha_info_minute['count'] > $captcha_limit_per_minute) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'error', 'message' => 'Zu viele CAPTCHA-Anfragen. Bitte warten Sie eine Minute.'));
            exit();
        }
    } else {
        $captcha_info_minute['count'] = 1;
        $captcha_info_minute['start_time'] = $current_time;
    }
}

// Überprüfung und Begrenzung pro Minute
if (!isset($_SESSION['rate_limit'][$ip_address]['minute'])) {
    $_SESSION['rate_limit'][$ip_address]['minute'] = [
        'count' => 1,
        'start_time' => $current_time
    ];
} else {
    $rate_info_minute = &$_SESSION['rate_limit'][$ip_address]['minute'];

    if ($current_time - $rate_info_minute['start_time'] < $time_window_minute) {
        $rate_info_minute['count']++;

        if ($rate_info_minute['count'] > $rate_limit_per_minute) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'error', 'message' => 'Zu viele Anfragen. Bitte warten Sie eine Minute.'));
            exit();
        }
    } else {
        $rate_info_minute['count'] = 1;
        $rate_info_minute['start_time'] = $current_time;
    }
}

// Überprüfung und Begrenzung pro Stunde
if (!isset($_SESSION['rate_limit'][$ip_address]['hour'])) {
    $_SESSION['rate_limit'][$ip_address]['hour'] = [
        'count' => 1,
        'start_time' => $current_time
    ];
} else {
    $rate_info_hour = &$_SESSION['rate_limit'][$ip_address]['hour'];

    if ($current_time - $rate_info_hour['start_time'] < $time_window_hour) {
        $rate_info_hour['count']++;

        if ($rate_info_hour['count'] > $rate_limit_per_hour) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'error', 'message' => 'Zu viele Anfragen. Bitte warten Sie eine Stunde.'));
            exit();
        }
    } else {
        $rate_info_hour['count'] = 1;
        $rate_info_hour['start_time'] = $current_time;
    }
}

// Überprüfung und Begrenzung pro Tag
if (!isset($_SESSION['rate_limit'][$ip_address]['day'])) {
    $_SESSION['rate_limit'][$ip_address]['day'] = [
        'count' => 1,
        'start_time' => $current_time
    ];
} else {
    $rate_info_day = &$_SESSION['rate_limit'][$ip_address]['day'];

    if ($current_time - $rate_info_day['start_time'] < $time_window_day) {
        $rate_info_day['count']++;

        if ($rate_info_day['count'] > $rate_limit_per_day) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'error', 'message' => 'Zu viele Anfragen. Bitte warten Sie bis morgen.'));
            exit();
        }
    } else {
        $rate_info_day['count'] = 1;
        $rate_info_day['start_time'] = $current_time;
    }
}

// Cleanup: Veraltete IP-Einträge aus der Session entfernen
foreach ($_SESSION['rate_limit'] as $ip => $data) {
    if (isset($data['captcha_minute']) && ($current_time - $data['captcha_minute']['start_time'] > $time_window_minute)) {
        unset($_SESSION['rate_limit'][$ip]['captcha_minute']);
    }

    if (isset($data['minute']) && ($current_time - $data['minute']['start_time'] > $time_window_minute)) {
        unset($_SESSION['rate_limit'][$ip]['minute']);
    }

    if (isset($data['hour']) && ($current_time - $data['hour']['start_time'] > $time_window_hour)) {
        unset($_SESSION['rate_limit'][$ip]['hour']);
    }

    if (isset($data['day']) && ($current_time - $data['day']['start_time'] > $time_window_day)) {
        unset($_SESSION['rate_limit'][$ip]['day']);
    }

    if (empty($_SESSION['rate_limit'][$ip])) {
        unset($_SESSION['rate_limit'][$ip]);
    }
}

// Turnstile CAPTCHA Secret-Key aus wp-config.php
$secret_key = TURNSTILE_SECRET_KEY;

$turnstile_response = $_POST['cf-turnstile-response'];

// Turnstile-API zur Validierung aufrufen
$url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
$data = [
    'secret' => $secret_key,
    'response' => $turnstile_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // Sicherstellen, dass SSL korrekt überprüft wird
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // SSL-Zertifikat verifizieren
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout setzen

$response = curl_exec($ch);

if ($response === false) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Fehler beim Verbindungsaufbau zum Server.' . curl_error($ch)));
    exit();
}
curl_close($ch);

$result = json_decode($response, true);

// Überprüfen, ob die Turnstile-Validierung erfolgreich war
if (!$result['success']) {
    $error_codes = implode(', ', $result['error-codes'] ?? []);
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Captcha Validierung fehlgeschlagen.' . $error_codes));
    exit();
}

//Formularübergabe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Ungültige E-Mail-Adresse!'));
        exit();
    }
    $email = htmlspecialchars($email);

    $telefonnummer = $_POST['telefonnummer'] ?? null;
    if (!preg_match("/^[0-9+\s()-]+$/", $telefonnummer)) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Ungültige Telefonnummer!'));
        exit();
    }
    $telefonnummer = htmlspecialchars($telefonnummer);

    $weitere_info = $_POST['weitere_info'] ?? null;
    $weitere_info = htmlspecialchars($weitere_info);

    $plz = $_POST['plz'] ?? null;
    if (!preg_match("/^\d{5}$/", $plz)) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Ungültige Postleitzahl'));
        exit();
    }
    $plz = htmlspecialchars($plz);

    $vorname = $_POST['vorname'] ?? null;
    $name = $_POST['name'] ?? null;
    $ort = $_POST['ort'] ?? null;

    if (empty($vorname) || empty($name) || empty($ort)) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Bitte füllen Sie alle erforderlichen Felder aus.'));
        exit();
    }

    $vorname = htmlspecialchars($vorname);
    $name = htmlspecialchars($name);
    $ort = htmlspecialchars($ort);

    $summary = $_POST['summary'] ?? null;

    if (empty($summary)) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Zusammenfassung darf nicht leer sein.'));
        exit();
    }

    // Erlaubte Tags definieren
	$allowed_tags = '<h3><div><p><strong>';

	$summary = strip_tags($summary, $allowed_tags);
	$summary = trim($summary); // entfernt überflüssige Leerzeichen

    $to = RECIVER_EMAIL_ADDRESS;

    $subject = "Jemand hat den Immo-Funnel durchgeklickt";

    // Template für Admin-E-Mail laden
	$admin_email_template = load_email_template('admin-email-template.php', [
    	'summary' => $summary
	]);

    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . SENDER_EMAIL_ADDRESS);

    $admin_mail_status = wp_mail(
    	$to,
    	$subject,
    	$admin_email_template,
		$headers
	);

    $confirmation_subject = "Nachricht von planetkosy";
    
	// Template für Bestätigungs-E-Mail laden
	$confirmation_email_template = load_email_template('confirmation-email-template.php', [
    	'vorname' => $vorname
	]);

    $confirmation_headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . SENDER_EMAIL_ADDRESS);

    $confirmation_mail_status = wp_mail(
    	$email,
		$confirmation_subject,
    	$confirmation_email_template,
		$confirmation_headers
	);

    if ($admin_mail_status && $confirmation_mail_status) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success'));
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Die E-Mail konnte nicht gesendet werden.'));
        exit();
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Ungültiger Zugriff.'));
    exit();
}