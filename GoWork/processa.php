<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        $email = $_SESSION['email_rec_c'];
        $senha = $_SESSION['senha_rec_c'];
        
        require 'vendor/autoload.php';
        $from = new SendGrid\Email(null, "gowork.contact.ifs@gmail.com");
        $subject = "Mensagem de contato";
        $to = new SendGrid\Email(null, "$email");
        $content = new SendGrid\Content("text/html", "<!DOCTYPE html>
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml'>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <meta name='viewport' content='width=device-width'>
                <meta name='HandheldFriendly' content='true' />
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <!--[if gte IE 7]><html class='ie8plus' xmlns='http://www.w3.org/1999/xhtml'><![endif]-->
                <!--[if IEMobile]><html class='ie8plus' xmlns='http://www.w3.org/1999/xhtml'><![endif]-->
                <meta name='format-detection' content='telephone=no'>
                <meta name='x-apple-disable-message-reformatting'>
                <meta name='generator' content='EDMdesigner, www.edmdesigner.com'>
                <title></title>
                <link href='https://fonts.googleapis.com/css?family=Avenir' rel='stylesheet' type='text/css'>
                <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> <!--##custom-font-resource##-->
                <style type='text/css' media='screen'>
                * {line-height: inherit;}
                .ExternalClass * { line-height: 100%; }
                body, p{margin:0; padding:0; margin-bottom:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;} img{line-height:100%; outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} a img{border: none;} a, a:link, .no-detect-local a, .appleLinks a{color:#5555ff !important; text-decoration: underline;} .ExternalClass {display: block !important; width:100%;} .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: inherit; } table td {border-collapse:collapse;mso-table-lspace: 0pt; mso-table-rspace: 0pt;} .mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {text-decoration: default; color: #5555ff !important; pointer-events: auto; cursor: default;} .no-detect a{text-decoration: none; color: #5555ff;
                pointer-events: auto; cursor: default;} {color: #5555ff;} span {color: inherit; border-bottom: none;} span:hover { background-color: transparent; }
                a[x-apple-data-detectors] {color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
                .nounderline {text-decoration: none !important;}
                h1, h2, h3 { margin:0; padding:0; }
                p {Margin: 0px !important; }
                table[class='email-root-wrapper'] { width: 600px !important; }
                body {
                background-color: #ffffff;
                background: #ffffff;
                }
                body { min-width: 280px; width: 100%;}
                td[class='pattern'] .c199p33r { width: 33.33333333333333%;}
                td[class='pattern'] .c200p33r { width: 33.333333333333336%;}
                </style>
                <style>
                @media only screen and (max-width: 599px),
                only screen and (max-device-width: 599px),
                only screen and (max-width: 400px),
                only screen and (max-device-width: 400px) {
                .email-root-wrapper { width: 100% !important; }
                .full-width { width: 100% !important; height: auto !important; text-align:center;}
                .fullwidthhalfleft {width:100% !important;}
                .fullwidthhalfright {width:100% !important;}
                .fullwidthhalfinner {width:100% !important; margin: 0 auto !important; float: none !important; margin-left: auto !important; margin-right: auto !important; clear:both !important; }
                .hide { display:none !important; width:0px !important;height:0px !important; overflow:hidden; }
                .c199p33r { width: 100% !important; float:none;}
                .c200p33r { width: 100% !important; float:none;}
                }
                </style>
                <style>
                @media only screen and (min-width: 600px) {
                td[class='pattern'] .c199p33r { width: 199px !important;}
                td[class='pattern'] .c200p33r { width: 200px !important;}
                }
                @media only screen and (max-width: 599px),
                only screen and (max-device-width: 599px),
                only screen and (max-width: 400px),
                only screen and (max-device-width: 400px) {
                table[class='email-root-wrapper'] { width: 100% !important; }
                td[class='wrap'] .full-width { width: 100% !important; height: auto !important;}
                td[class='wrap'] .fullwidthhalfleft {width:100% !important;}
                td[class='wrap'] .fullwidthhalfright {width:100% !important;}
                td[class='wrap'] .fullwidthhalfinner {width:100% !important; margin: 0 auto !important; float: none !important; margin-left: auto !important; margin-right: auto !important; clear:both !important; }
                td[class='wrap'] .hide { display:none !important; width:0px;height:0px; overflow:hidden; }
                .edm-social {width: 100% !important;}
                td[class='pattern'] .c199p33r { width: 100% !important; }
                td[class='pattern'] .c200p33r { width: 100% !important; }
                }
                @media screen and (-webkit-min-device-pixel-ratio:0) {
                .img302x121 { width: 302px !important; height: 121px !important;}
                .img37x37 { width: 37px !important; height: 37px !important;}
                }
                </style>
                <style>
                @media screen and (min-width: 600px) {
                .dh{
                display: none;
                }
                }
                </style>
                <!--[if (gte mso 9)|(IE)]>
                <style>
                .dh {
                display: none;
                }
                .dh table {
                mso-hide: all;
                }
                </style>
                <![endif]-->
                <!--[if (gte IE 7) & (vml)]>
                <style type='text/css'>
                html, body {margin:0 !important; padding:0px !important;}
                img.full-width { position: relative !important; }
                .img302x121 { width: 302px !important; height: 121px !important;}
                .img37x37 { width: 37px !important; height: 37px !important;}
                </style>
                <![endif]-->
                <!--[if gte mso 9]>
                <style type='text/css'>
                .mso-font-fix-arial { font-family: Arial, sans-serif;}
                .mso-font-fix-georgia { font-family: Georgia, sans-serif;}
                .mso-font-fix-tahoma { font-family: Tahoma, sans-serif;}
                .mso-font-fix-times_new_roman { font-family: 'Times New Roman', sans-serif;}
                .mso-font-fix-trebuchet_ms { font-family: 'Trebuchet MS', sans-serif;}
                .mso-font-fix-verdana { font-family: Verdana, sans-serif;}
                </style>
                <![endif]-->
                <!--[if gte mso 9]>
                <style type='text/css'>
                table, td {
                border-collapse: collapse !important;
                mso-table-lspace: 0px !important;
                mso-table-rspace: 0px !important;
                }
                .email-root-wrapper { width 600px !important;}
                .imglink { font-size: 0px; }
                </style>
                <![endif]-->
                <!--[if gte mso 15]>
                <style type='text/css'>
                table {
                font-size:0px;
                mso-margin-top-alt:0px;
                }
                .fullwidthhalfleft {
                width: 49% !important;
                float:left !important;
                }
                .fullwidthhalfright {
                width: 50% !important;
                float:right !important;
                }
                </style>
                <![endif]-->
                <STYLE type='text/css' media='(pointer) and (min-color-index:0)'>
                html, body {background-image: none !important; background-color: transparent !important; margin:0 !important; padding:0 !important;}
                </STYLE>
            </head>
            <body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0' style='font-family:Arial, sans-serif; font-size:0px;margin:0;padding:0;background: #ffffff !important;' bgcolor='#ffffff'>
                <style>
                @media screen yahoo and (max-width: 600px){
                .hide{
                display: none;
                overflow: hidden;
                }
                }
                </style>
                <!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]--><!--[if t]><![endif]-->
                <table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'  bgcolor='#ffffff' style='margin:0; padding:0; width:100% !important; background: #ffffff !important;'>
                    <tr>
                        <td class='wrap' align='center' valign='top' width='100%'>
                            <center>
                            <!-- content -->
                            <div  style='padding:0px'>
                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                    <tr>
                                        <td valign='top'  style='padding:0px'>
                                            <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                                                <tr>
                                                    <td valign='top'  style='padding:0px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' class='full-width'>
                                                            <tr>
                                                                <td valign='top' align='center' style='padding:5px'>
                                                                    <table cellpadding='0' cellspacing='0' border='0' width='302' style='border:0px none' class='full-width'>
                                                                        <tr>
                                                                            <td valign='top' style='padding:0px'><img
                                                                                src='https://images.chamaileon.io/5db659bdd401420012e2a83b/GoWork-logo.png' width='302' height='121' alt=' border='0'  style='display:block;max-width:100%;height:auto' class='full-width img302x121'  />
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                    <tr>
                                        <td valign='top'  style='padding:0px'>
                                            <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                                                <tr>
                                                    <td valign='top'  style='padding:0px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                            <tr>
                                                                <td valign='top' style='padding:0px'>
                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                        <tr>
                                                                            <td  style='padding:0px'>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:16px;color:#000000;line-height:24px;mso-line-height:exactly;mso-text-raise:4px'><h1 style='font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif; font-size: 36px; color: #000000; line-height: 52px; mso-line-height: exactly; mso-text-raise: 8px; padding: 0; margin: 0;text-align: center;'><span class='mso-font-fix-arial'>Redefinição de senha</span></h1></div></td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top' style='padding-top:10px;padding-right:120px;padding-bottom:10px;padding-left:120px'>
                                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                <tr>
                                                                                                    <td  style='padding:0px'>
                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:2px solid #00a591'>
                                                                                                            <tr>
                                                                                                                <td valign='top'>
                                                                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                        <tr>
                                                                                                                            <td  style='padding:0px'></td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                    <tr>
                                        <td valign='top'  style='padding:0px'>
                                            <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                                                <tr>
                                                    <td valign='top'  style='padding:0px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                            <tr>
                                                                <td valign='top' style='padding:0px'>
                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                        <tr>
                                                                            <td  style='padding:0px'>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top' style='padding-top:10px;padding-bottom:10px'>
                                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                <tr>
                                                                                                    <td  style='padding:0px'>
                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:1px solid #00a591'>
                                                                                                            <tr>
                                                                                                                <td valign='top'>
                                                                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                        <tr>
                                                                                                                            <td  style='padding:0px'></td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:16px;color:#000000;line-height:24px;mso-line-height:exactly;mso-text-raise:4px'><h3 style='font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif; font-size: 22px; color: #000000; line-height: 34px; mso-line-height: exactly; mso-text-raise: 6px; padding: 0; margin: 0;text-align: center;'><span class='mso-font-fix-arial'>Conforme solicitado, geramos uma nova senha. Utilize os dados abaixo para acessar o sistema:</span><span class='mso-font-fix-arial'><br></span><span class='mso-font-fix-arial'> </span></h3></div></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                            <tr>
                                                                <td valign='top' style='padding-top:10px;padding-bottom:10px'>
                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                        <tr>
                                                                            <td  style='padding:0px'>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:1px solid #00a591'>
                                                                                    <tr>
                                                                                        <td valign='top'>
                                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                <tr>
                                                                                                    <td  style='padding:0px'></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                    <tr>
                                        <td valign='top'  style='padding:0px'>
                                            <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                                                <tr>
                                                    <td valign='top'  style='padding:0px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                            <tr>
                                                                <td valign='top' style='padding:0px'>
                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                        <tr>
                                                                            <td  style='padding:0px'>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Arial;font-size:14px;color:#000000;line-height:22px;mso-line-height:exactly;mso-text-raise:4px'><p style='padding: 0; margin: 0;text-align: center;'><span style='font-size:20px;'>Nova Senha: <span style='color:#FF0000;'><strong>$senha</strong></span></span></p></div></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                    <tr>
                                        <td valign='top'  style='padding:0px'>
                                            <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                                                <tr>
                                                    <td valign='top'  style='padding:0px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                            <tr>
                                                                <td valign='top' style='padding:0px'>
                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                        <tr>
                                                                            <td  style='padding:0px'>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top'  style='padding:10px'><div  style='text-align:left;font-family:Arial;font-size:14px;color:#000000;line-height:22px;mso-line-height:exactly;mso-text-raise:4px'><p style='padding: 0; margin: 0;text-align: center;'><span style='font-size:16px;'>Ao fazer o login você terá a opção de alterar a senha.</span></p></div></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                    <tr>
                                        <td valign='top'  style='padding:0px'>
                                            <table cellpadding='0' cellspacing='0' width='600' align='center'  style='max-width:600px;min-width:240px;margin:0 auto' class='email-root-wrapper'>
                                                <tr>
                                                    <td valign='top'  style='padding:0px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                            <tr>
                                                                <td valign='top' style='padding:0px'>
                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                        <tr>
                                                                            <td  style='padding:0px' class='pattern'>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top' style='padding-top:5px;padding-bottom:20px'>
                                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                <tr>
                                                                                                    <td  style='padding:0px'>
                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border-top:1px solid #00a591'>
                                                                                                            <tr>
                                                                                                                <td valign='top'>
                                                                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                        <tr>
                                                                                                                            <td  style='padding:0px'></td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top'  style='padding:0;mso-cellspacing:0in'>
                                                                                            <table cellpadding='0' cellspacing='0' border='0' align='left' width='199' id='c199p33r'  style='float:left' class='c199p33r'>
                                                                                                <tr>
                                                                                                    <td valign='top'  style='padding:0px'>
                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                            <tr>
                                                                                                                <td valign='top' style='padding:10px'>
                                                                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                        <tr>
                                                                                                                            <td  style='padding:0px'>
                                                                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                                                    <tr>
                                                                                                                                        <td valign='top'>
                                                                                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                                                <tr>
                                                                                                                                                    <td  style='padding:0px'></td>
                                                                                                                                                </tr>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <!--[if gte mso 9]></td><td valign='top' style='padding:0;'><![endif]-->
                                                                                            <table cellpadding='0' cellspacing='0' border='0' align='left' width='199' id='c199p33r'  style='float:left' class='c199p33r'>
                                                                                                <tr>
                                                                                                    <td valign='top'  style='padding:0px'>
                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:0px none'>
                                                                                                            <tr>
                                                                                                                <td valign='top' style='padding:0px'>
                                                                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                        <tr>
                                                                                                                            <td  style='padding:0px'>
                                                                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                                                    <tr>
                                                                                                                                        <td valign='top' width='66'  style='padding:0px'>
                                                                                                                                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                                                                <tr>
                                                                                                                                                    <td valign='top' align='center' style='padding:15px'>
                                                                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='37' style='border:0px none'>
                                                                                                                                                            <tr>
                                                                                                                                                                <td valign='top' style='padding:0px'><img
                                                                                                                                                                    src='https://images.chamaileon.io/5af430d4a0870300120192f8/1460562865_06-facebook.png' width='37' height='37' alt=' border='0'  style='display:block' class='img37x37'  />
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                                                        </table>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                        <td valign='top' width='66'  style='padding:0px'>
                                                                                                                                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                                                                <tr>
                                                                                                                                                    <td valign='top' align='center' style='padding:15px'>
                                                                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='37' style='border:0px none'>
                                                                                                                                                            <tr>
                                                                                                                                                                <td valign='top' style='padding:0px'><img
                                                                                                                                                                    src='https://images.chamaileon.io/5af430d4a0870300120192f8/1460562885_03-twitter.png' width='37' height='37' alt=' border='0'  style='display:block' class='img37x37'  />
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                                                        </table>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                        <td valign='top' width='66'  style='padding:0px'>
                                                                                                                                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                                                                <tr>
                                                                                                                                                    <td valign='top' align='center' style='padding:15px'>
                                                                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='37' style='border:0px none'>
                                                                                                                                                            <tr>
                                                                                                                                                                <td valign='top' style='padding:0px'><img
                                                                                                                                                                    src='https://images.chamaileon.io/5af430d4a0870300120192f8/1460563162_38-instagram.png' width='37' height='37' alt=' border='0'  style='display:block' class='img37x37'  />
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                                                        </table>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <!--[if gte mso 9]></td><td valign='top' style='padding:0;'><![endif]-->
                                                                                            <table cellpadding='0' cellspacing='0' border='0' align='left' width='200' id='c200p33r'  style='float:left' class='c200p33r'>
                                                                                                <tr>
                                                                                                    <td valign='top'  style='padding:0px'>
                                                                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                            <tr>
                                                                                                                <td valign='top' style='padding:10px'>
                                                                                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                        <tr>
                                                                                                                            <td  style='padding:0px'>
                                                                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                                                                    <tr>
                                                                                                                                        <td valign='top'>
                                                                                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                                                                                <tr>
                                                                                                                                                    <td  style='padding:0px'></td>
                                                                                                                                                </tr>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                                                    <tr>
                                                                                        <td valign='top'  style='padding-top:10px;padding-right:10px;padding-bottom:30px;padding-left:10px'><div  style='text-align:left;font-family:Raleway, Trebuchet MS, Avenir, Segoe UI, sans-serif;font-size:14px;color:#000000;line-height:20px;mso-line-height:exactly;mso-text-raise:3px'><p style='padding: 0; margin: 0;text-align: center;'>Se não solicitou a redefinição de senha entre em contato com nossa equipe<br><br>Cumprimentos, Serviço de Suporte Go Work.<br>E-mail: gowork.contact.ifs@gmail.com<br>&nbsp;</p><p style='padding: 0; margin: 0;text-align: center;'><span style='font-size:9px;'>Não será necessário responder a esta mensagem.</span></p><p style='padding: 0; margin: 0;text-align: center;'>&nbsp;</p><p style='padding: 0; margin: 0;text-align: center;'>&nbsp;</p></div></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- content end -->
                            </center>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
        ");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        
        //Necessário inserir a chave
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);
        header('Location: page/recuperar_pass.php');
        
        ?>
    </body>
</html>