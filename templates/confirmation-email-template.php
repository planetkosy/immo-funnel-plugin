<?php
global $immo_funnel_icons;
global $immo_funnel_colors;
global $immo_funnel_styles;
?>

<!DOCTYPE html>
    <html>

    <head>
    <title>confirmation email</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200;300;400;500;600&display=swap');

        body,
        table,
        td,
        a {
            font-family: 'Source Sans 3', Arial, sans-serif;
            font-size: 16px;
            color: <?php echo esc_url($immo_funnel_colors['secondary_first']); ?>;
            text-align: left;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            display: block;
            max-width: 100%;
        }

        .container {
            max-width: 640px;
            width: 100%;
            margin: 0 auto;
            padding: 10px;
            box-sizing: border-box;
        }

        .logo {
            text-align: left;
            padding: 10px 0;
        }

        .main-image-wrapper {
            display: flex;
            justify-content: center;
            padding: 0;
            box-sizing: border-box;
            width: 100%;
        }

        .main-image {
            margin: 10px auto;
            max-width: 100%;
            height: auto;
            display: block;
            padding: 0 10px;
            box-sizing: border-box;
        }

        .content {
            margin: 20px 10px;
            color: <?php echo esc_url($immo_funnel_colors['primary_first']); ?>;
        }

        .header-bar-wrapper {
            background-color: <?php echo esc_url($immo_funnel_colors['secondary_first']); ?>;
            width: 100%;
            padding: 0;
        }

        .header-bar {
            max-width: 640px;
            height: 14px;
            margin: 0 auto;
            padding: 10px 20px;
            text-align: right;
        }

        .footer-wrapper {
            background-color: <?php echo esc_url($immo_funnel_colors['primary_first']); ?>;
            width: 100%;
        }

        .footer {
            color: <?php echo esc_url($immo_funnel_colors['primary_second']); ?>;
            padding: 20px;
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
        }

        .footer p {
            font-size: 14px;
            line-height: 18px;
            margin: 5px 0;
        }

        .footer a {
            color: <?php echo esc_url($immo_funnel_colors['secondary_first']); ?>;
            text-decoration: underline;
            font-size: 14px;
        }

        @media screen and (max-width: 640px) {
            .container {
                padding: 10px;
            }

            .content,
            .footer {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
    </head>

    <body style='margin: 0; padding: 0; width: 100%; height: 100%; font-family: Source+Sans+3, Arial, sans-serif;'>

    <table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='border-spacing: 0; width: 100%;'>
        <tr>
            <td class='header-bar-wrapper'>

                <!--[if mso]>
                <table width='640' cellpadding='0' cellspacing='0' align='center' style='margin: 0 auto;'>
                    <tr>
                        <td style='height: 14px;'></td>
                    </tr>
                </table>
                <![endif]-->

                <!--[if !mso]><!-->
                <table class='header-bar' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td style='height: 14px;'></td>
                    </tr>
                </table>
                <!--<![endif]-->
            </td>
        </tr>
    
        <tr>
            <td>
                <!--[if mso]>
                <table cellpadding='0' cellspacing='0' width='640' align='center'>
                    <tr>
                        <td style='padding: 10px 0;'>
                            <img src='<?php echo esc_url($immo_funnel_icons['site_logo']); ?>'
                                alt='siteLogo' width='250' style='display: block; border: 0;'>
                        </td>
                    </tr>
                </table>
                <![endif]-->

                <!--[if !mso]><!-->
                <table cellpadding='0' cellspacing='0' align='center'
                    style='max-width: 640px; width: 100%; margin: 0 auto; padding: 10px;'>
                    <tr>
                        <td style='padding: 10px 0; text-align: left;' class='logo'>
                            <img src='<?php echo esc_url($immo_funnel_icons['site_logo']); ?>'
                                alt='siteLogo' width='250' style='display: block; border: 0;'>
                        </td>
                    </tr>
                </table>
                <!--<![endif]-->
            </td>
        </tr>

        <tr>
            <td>
                <!--[if mso]>
                <table cellpadding='0' cellspacing='0' width='640' align='center'>
                    <tr>
                        <td style='padding: 0 10px;'>
                            <img src='<?php echo esc_url($immo_funnel_icons['CI_PICTURE']); ?>'
                                alt='ciPicture' width='640' style='display: block; max-width: 100%; height: auto;'>
                        </td>
                    </tr>
                </table>
                <![endif]-->

                <!--[if !mso]><!-->
                <table cellpadding='0' cellspacing='0' align='center'
                    style='max-width: 640px; width: 100%; margin: 0 auto; padding: 10px;' class='main-image-wrapper'>
                    <tr>
                        <td style='text-align: center; padding: 0 10px;'>
                            <img class='main-image'
                                src='<?php echo esc_url($immo_funnel_icons['CI_PICTURE']); ?>'
                                alt='ciPicture' width='640'>
                        </td>
                    </tr>
                </table>
                <!--<![endif]-->
            </td>
        </tr>

        <tr>
            <td>
                <!--[if mso]>
                <table cellpadding='0' cellspacing='0' width='640' align='center'>
                    <tr>
                        <td style='margin: 20px 10px; color: <?php echo esc_url($immo_funnel_colors['primary_first']); ?>; padding: 0 10px;'>
                            <h2 style='color: <?php echo esc_url($immo_funnel_colors['primary_first']); ?>;'>Dein Suchauftrag ist bei uns eingegangen.</h2>
                            <p>Hallo <?php echo htmlspecialchars($vorname); ?>,</p>
                            <p>Dein Auftrag wurde erfolgreich an uns übermittelt. Vielen Dank.</p>
                            <p>Bei relevanten Treffern werden wir uns umgehend mit Dir per Mail oder telefonisch in Verbindung setzen.</p>
                            <p>Mit freundlichen Grüßen</p>
                            <p>Das Team von <?php echo esc_html(SITENAME); ?></p>
                        </td>
                    </tr>
                </table>
                <![endif]-->

                <!--[if !mso]><!-->
                <table cellpadding='0' cellspacing='0' align='center' class='container'>
                    <tr>
                    <td class='content'>
                            <h2>Dein Suchauftrag ist bei uns eingegangen.</h2>
                            <p>Hallo <?php echo htmlspecialchars($vorname); ?>,</p>
                            <p>Dein Auftrag wurde erfolgreich an uns übermittelt. Vielen Dank.</p>
                            <p>Bei relevanten Treffern werden wir uns umgehend mit Dir per Mail oder telefonisch in Verbindung setzen.</p>
                            <p>Mit freundlichen Grüßen</p>
                            <p>Das Team von <?php echo esc_html(SITENAME); ?></p>
                        </td>
                    </tr>
                </table>
                <!--<![endif]-->
            </td>
        </tr>

        <tr>
            <td style='background-color: <?php echo esc_url($immo_funnel_colors['primary_first']); ?>;'>
                <!--[if mso]>
                <table cellpadding='0' cellspacing='0' width='640' align='center'>
                    <tr>
                        <td style='color: <?php echo esc_url($immo_funnel_colors['primary_second']); ?>; padding: 20px; font-size: 14px; line-height: 18px; text-align: center;'>
                            <p>Dein Firmenname<br>
                                gegebenfalls Ansprechpartenr<br>
                                Deine Firmenadresse<br><br>
                                Kontakt<br>
                                Tel.: <br>
                                E-Mail: <a href='mailto:<?php echo esc_html(RECIVER_EMAIL_ADDRESS); ?>'
                                    style='color: <?php echo esc_url($immo_funnel_colors['secondary_first']); ?>;'><?php echo esc_html(RECIVER_EMAIL_ADDRESS); ?></a><br>
                                Hier sollten noch weitere relevante Firmeninformationen wie Registereinträge, Aufzichsbehörden oder Gewerdezulassungen aufgeführt werden<br><br>
                                Wichtiger Hinweis: Aus Rechts- und Sicherheitsgründen ist die in dieser E-Mail gegebene
                                Information nicht rechtsverbindlich. Eine rechtsverbindliche Bestätigung reichen wir Ihnen gerne auf
                                Anforderung in schriftlicher Form nach. Beachten Sie bitte, dass jede Form der unautorisierten
                                Nutzung, Veröffentlichung, Vervielfältigung oder Weitergabe des Inhalts dieser E-Mail nicht
                                gestattet ist.<br><br>
                                Bitte beachten Sie unsere <a href='<?php echo esc_url(PRIVACY_POLICY); ?>'
                                    target='_blank' style='color: <?php echo esc_url($immo_funnel_colors['secondary_first']); ?>;'>Datenschutzhinweise</a>.
                            </p>
                        </td>
                    </tr>
                </table>
                <![endif]-->

                <!--[if !mso]><!-->
                <table cellpadding='0' cellspacing='0' class='footer-wrapper'>
                    <tr>
                    <td class='footer' style='text-align: center;'>
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
                <!--<![endif]-->
            </td>
        </tr>
    </table>

    </body>

    </html>