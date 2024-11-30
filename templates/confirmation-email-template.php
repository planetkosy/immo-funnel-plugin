<?php
global $immo_funnel_icons, $immo_funnel_colors, $immo_funnel_styles;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestätigungsmail</title>
    <style>
        body,
        table,
        td,
        a {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 24px;
            color: #333333;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
        }

        body {
            background-color: #f4f4f4;
            width: 100%;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
        }

        .header-bar {
            background-color: <?php echo esc_url($immo_funnel_colors['secondary_first'] ?? '#00a170'); ?>;
            height: 25px;
        }

        .logo {
            text-align: left;
            padding: 20px 0;
        }

        .logo img {
            max-width: 200px;
            height: auto;
        }
		
		.ci_picture {
            text-align: center;
            padding: 20px 0;
        }

        .ci_picture img {
            max-width: 640px;
            height: auto;
        }

        .content {
            color: <?php echo esc_url($immo_funnel_colors['primary_first'] ?? '#404040'); ?>;
        }

        .footer {
            background-color: <?php echo esc_url($immo_funnel_colors['primary_first'] ?? '#404040'); ?>;
            padding: 20px;
            text-align: center;
            color: <?php echo esc_url($immo_funnel_colors['primary_second'] ?? '#f4f4f4'); ?>;
            font-size: 14px;
            line-height: 20px;
        }

        .footer a {
            color: <?php echo esc_url($immo_funnel_colors['secondary_first'] ?? '#00a170'); ?>;
            text-decoration: underline;
        }

        .footer p {
            color: <?php echo esc_url($immo_funnel_colors['primary_second'] ?? '#f4f4f4'); ?>;
        }

        @media only screen and (max-width: 640px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="header-bar"></div>
            </td>
        </tr>
        <tr>
            <td>
                <table class="container">
                    <tr>
                        <td class="logo">
                            <img src="<?php echo esc_url($immo_funnel_icons['site_logo'] ?? ''); ?>" alt="Logo">
                        </td>
                    </tr>
                    <tr>
                        <td class="ci_picture">
                            <img src="<?php echo esc_url($immo_funnel_icons['CI_PICTURE'] ?? ''); ?>" alt="CI-Picture">
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                        <h2>Dein Suchauftrag ist bei uns eingegangen.</h2>
                            <p>Hallo <?php echo htmlspecialchars($vorname); ?>,</p>
                            <p>Dein Auftrag wurde erfolgreich an uns übermittelt. Vielen Dank.</p>
                            <p>Bei relevanten Treffern werden wir uns umgehend mit Dir per Mail oder telefonisch in Verbindung setzen.</p>
                            <p>Mit freundlichen Grüßen</p>
                            <p>Das Team von <?php echo esc_html(SITENAME); ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="footer" role="presentation" width="100%">
                    <tr>
                        <td>
                        <p>Dein Firmenname<br>
                                gegebenfalls Ansprechpartenr<br>
                                Deine Firmenadresse<br><br>
                                Kontakt<br>
                                Tel.: <br>
                                E-Mail: <a href='mailto:<?php echo esc_html(RECIVER_EMAIL_ADDRESS); ?>'><?php echo esc_html(RECIVER_EMAIL_ADDRESS); ?></a><br>
                                Hier sollten noch weitere relevante Firmeninformationen wie Registereinträge, Aufzichsbehörden oder Gewerdezulassungen aufgeführt werden<br><br>
                                Wichtiger Hinweis: Aus Rechts- und Sicherheitsgründen ist die in dieser E-Mail gegebene
                                Information nicht rechtsverbindlich. Eine rechtsverbindliche Bestätigung reichen wir Ihnen gerne auf
                                Anforderung in schriftlicher Form nach. Beachten Sie bitte, dass jede Form der unautorisierten
                                Nutzung, Veröffentlichung, Vervielfältigung oder Weitergabe des Inhalts dieser E-Mail nicht
                                gestattet ist.<br><br>
                                Bitte beachten Sie unsere <a href='<?php echo esc_url(PRIVACY_POLICY); ?>'
                                    target='_blank'>Datenschutzhinweise</a>.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>