<!DOCTYPE html>
<html>

<head>
    <title><?php echo @$pageTitle; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <style>
        html,
        body {
            padding: 0;
            margin: 0;
            font-family: Inter, Helvetica, "sans-serif";
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
        <div style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto" style="border-collapse:collapse">
                <tbody>
                    <tr>
                        <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">
                            <div style="text-align:center; margin:0 15px 34px 15px">
                                <div style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                    <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700"><?php echo lang("Text.e_rv_hi") . ' ' . @$person . ', ' . lang("Text.e_rv_welcome_company") . ' ' . @$pageTitle; ?></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="display: flex; justify-content: center; margin:0 60px 35px 60px">
                        <td align="start" valign="start" style="padding-bottom: 10px;">
                            <div style="background: #F9F9F9; border-radius: 12px; padding:35px 30px">
                                <div style="display:flex">
                                    <div>
                                        <span style="color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif">
                                            <?php echo lang("Text.e_rv_complete_account"); ?>
                                        </span>
                                        <p style="color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif">
                                            <?php echo lang("Text.e_rv_complete_account_msg"); ?>
                                        </p>
                                    </div>
                                </div>
                                <div align="center" style="margin-top: 10px; margin-bottom: 10px;">
                                    <div>
                                        <a href="<?php echo @$url; ?>" target="_blank" style="background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;">
                                            <?php echo lang("Text.e_rv_create_account"); ?>
                                        </a>
                                    </div>
                                </div>
                                <div style="display:flex">
                                    <div>
                                        <p style="color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif">
                                            <?php echo lang("Text.e_rv_complete_account_info"); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center" style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                            <p style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px">
                                <?php echo lang("Text.contact_info_label"); ?>
                            </p>
                            <p style="margin-bottom:2px"><?php echo lang("Text.phone_label") . ': ' . @$companyPhone; ?></p>
                            <p style="margin-bottom:2px"><?php echo lang("Text.email_label") . ': ' . @$companyEmail; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>