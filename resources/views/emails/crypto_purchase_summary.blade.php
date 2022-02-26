<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Daily Interest Report by Mail on {{$date_format}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
        @media screen {
            @font-face {
                font-family: 'Merriweather';
                font-style: normal;
                font-weight: 400;
                src: local('Merriweather'), local('Merriweather'), url(http://fonts.gstatic.com/s/merriweather/v8/ZvcMqxEwPfh2qDWBPxn6nmB7wJ9CoPCp9n30ZBThZ1I.woff) format('woff');
            }

            @font-face {
                font-family: 'Merriweather Bold';
                font-style: normal;
                font-weight: 700;
                src: local('Merriweather Bold'), local('Merriweather-Bold'), url(http://fonts.gstatic.com/s/merriweather/v8/ZvcMqxEwPfh2qDWBPxn6nhAPw1J91axKNXP_-QX9CC8.woff) format('woff');
            }
        }

        /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }

        /**
         * Remove extra space added to tables and cells in Outlook.
         */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
         * Better fluid images in Internet Explorer.
         */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
         * Remove blue links for iOS devices.
         */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
         * Fix centering issues in Android 4.4.
         */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
         * Collapse table borders to avoid space between cells.
         */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #CC7953;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>
<body style="background-color: #D2C7BA;">

<!-- start preheader -->
<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    Daily Interest Report by Mail on {{$date_format}}
</div>
<!-- end preheader -->

<!-- start body -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
        <td align="center" bgcolor="#D2C7BA">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 36px 24px;">
                        <a href="{{$settings->site_domain}}" target="_blank" style="display: inline-block;">
                            <img src="{{$settings->site_logo_url}}" alt="Logo" border="0" width="48" style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
        <td align="center" bgcolor="#D2C7BA">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif; border-top: 5px solid #1b1363;">
                        <h2 style="margin: 0;  line-height: 28px; text-align:center">Daily Interest Report by Mail on <br> {{$date_format}}</h2>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
        <td align="center" bgcolor="#D2C7BA">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <!-- start copy -->
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Merriweather', serif; font-size: 16px; line-height: 24px;">
                        <strong>Full Name: </strong>{{$userDetails->name}},<br />
                        <strong>Coin Bought: </strong>{{$investment->coin_details->coin_name}},<br />
                        <strong>Amount: </strong> ${{number_format($investment->amount)}},<br />
                        <strong>Current Interest: </strong> {{number_format($investment->intrest_growth)}},<br />
                        <strong>Date Created:: </strong>{{$investment->created_at}},<br />
                        <strong>Interest Age by Number of Days:: </strong>{{$investment->day_counter}},<br />
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Merriweather', serif; font-size: 16px; line-height: 24px;">
                        <p style="margin: 0;">Dear {{$userDetails->name}}, Our live support team are always available to answer all your questions, you can reach {{ucfirst($settings->site_name)}} via our 24/7 live support or send an email to <a href="mailto::{{$settings->site_email}}">{{$settings->site_email}}</a></p>
                    </td>
                </tr>
                <!-- end copy -->

                <!-- start button -->
                <tr>
                    <td align="left" bgcolor="#ffffff">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center" bgcolor="#f05a23" style="border-radius: 6px;">
                                                <h3 style="padding: 2px 5px;">
                                                    <a style="color:#fff" href="{{ $settings->site_domain }}">Visit Website</a>
                                                </h3>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end button -->

                <!-- start copy -->
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Merriweather', serif; font-size: 16px; line-height: 24px; border-bottom: 5px solid #1b1363">
                        <p style="margin: 0;">Thanks and Regards {{ucfirst($settings->site_name)}}.</p>
                    </td>
                </tr>
                <!-- end copy -->

            </table>
        </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
        <td align="center" bgcolor="#D2C7BA" style="padding: 24px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <!-- start permission -->
                <tr>
                    <td align="center" bgcolor="#D2C7BA" style="padding: 12px 24px; font-family: 'Merriweather', serif; font-size: 14px; line-height: 20px; color: #666;">
                        <p style="margin: 0;">{{$settings->site_address}}</p>
                        <p style="margin: 0;">Powered by {{ucfirst($settings->site_name)}}.</p>
                    </td>
                </tr>
                <!-- end permission -->

            </table>
        </td>
    </tr>
    <!-- end footer -->

</table>
<!-- end body -->

</body>
</html>
