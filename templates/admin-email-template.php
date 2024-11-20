<?php
global $immo_funnel_icons;
global $immo_funnel_colors;
global $immo_funnel_styles;
?>

<!DOCTYPE html>
<html>

<head>
    <title>admin email</title>
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
            <td>
                <table cellpadding='0' cellspacing='0' align='center'
                    style='max-width: 640px; width: 100%; margin: 0 auto; padding: 10px;' class='main-image-wrapper'>
                    <tr>
                        <td style='text-align: center; padding: 0 10px;'>
                            <img class='main-image'
                                src='<?php echo esc_url($immo_funnel_icons['site_logo']); ?>'
                                alt='planetkosy_Logo' width='640'>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table cellpadding='0' cellspacing='0' align='center' class='container'>
                    <tr>
                        <td class='content'>
                            <h2>Zusammenfassung:</h2>
                            <p><?php echo $summary; ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>