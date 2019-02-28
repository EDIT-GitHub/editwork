<?php
$sEventTitleVar    = '$sEventTitle';
?>
<!-- <!DOCTYPE html>
<html lang="uk">
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
	</head>
<body style="margin: 0;padding: 0;border: 0;border-top: 8px solid #5fc7ae;border-bottom: 8px solid #5fc7ae; font-size: 100%;font: inherit;vertical-align: baseline;background:transparent;font-family: 'Lato', sans-serif; font-size: 20px;color:#7f7f7f;font-weight:300; ">
	<div class="wrapper" style="display: block;margin:0 auto;width:600px;text-align:center;padding-top: 45px;padding-bottom: 55px;">
		<h1 style="margin:0;color:#333333;font-size: 56px; font-weight:300;"><?php esc_html_e( 'Hello!', 'coworking' ) ?></h1>
		<p style="line-height: 34px;margin-bottom:50px;"><?php echo sprintf( esc_html__( 'This is copy of your event registration details %1$s %2$s', 'coworking' ), '<br>', $sEventTitleVar ) ?></p>
		<div class="eventDesc" style="width: 330px;margin: 0 auto 50px;overflow: hidden;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
			<p style="line-height: 60px;margin: 0;border-bottom: 1px solid #6dd2ba; background: #5fc7ae;font-size: 16px;color:#fff;font-weight:300;text-align:center;">$sEventDate</p>
			<p style="line-height: 60px;margin: 0;border-bottom: 1px solid #6dd2ba; background: #5fc7ae;font-size: 16px;color:#fff;font-weight:300;text-align:center;">$sEventTime</p>
			<p style="line-height: 22px;padding:8px 0; margin: 0;border-bottom: 1px solid #6dd2ba; background: #5fc7ae;font-size: 16px;color:#fff;font-weight:300;text-align:center;">$sEventLocation</p>
			<p style="line-height: 60px;margin: 0; background: #5fc7ae;font-size: 16px;color:#fff;font-weight:300;text-align:center;">$sEventPrice</p>
		</div>
		<p style="line-height: 34px;margin-bottom:0px;"><?php esc_html_e( 'Feel free to contact us anytime in case you have any questions', 'coworking' ) ?></p>
		<p style="line-height: 34px;margin-top:0px;"><?php esc_html_e( 'Contact info', 'coworking' ) ?>:</p>
		<div class="contactInfo" style="padding-top:4px; text-align:center;">
			<span style="display: inline-block;padding-right: 12px; font-size: 16px;color:#7f7f7f;"><?php esc_html_e( 'tel', 'coworking' ) ?>: $sPhone</span>
			<span style="display: inline-block;padding-left: 12px; font-size: 16px;color:#7f7f7f;"><?php esc_html_e( 'email', 'coworking' ) ?>: $sEmail</span>
		</div>
	</div>
</body>
</html> -->


<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Your Message Subject or Title</title>
                <style type="text/css">
                    /* Based on The MailChimp Reset INLINE: Yes. */
                    /* Client-specific Styles */
                    #outlook a {
                        padding: 0;
                    }

                    a {
                        text-decoration: none !important;
                    }

                    /* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/
                    .ExternalClass {
                        width: 100%;
                    }
                    /* Force Hotmail to display emails at full width */
                    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                        line-height: 100%;
                    }
                    #backgroundTable {
                        margin: 0;
                        padding: 0;
                        width: 100% !important;
                        line-height: 24px !important;
                    }
                    
                    /* Outlook 07, 10 Padding issue fix
                    Bring inline: No.*/
                    table td {
                        border-collapse: collapse;
                    }


                    /***************************************************
                    ****************************************************
                    MOBILE TARGETING
                    ****************************************************
                    ***************************************************/
                    @media only screen and (max-device-width: 480px) {
                        /* Part one of controlling phone number linking for mobile. */
                        a[href^="tel"], a[href^="sms"] {
                            text-decoration: none;
                            color: blue; /* or whatever your want */
                            pointer-events: none;
                            cursor: default;
                        }

                        .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                            text-decoration: default;
                            color: orange !important;
                            pointer-events: auto;
                            cursor: default;
                        }
                    }

                    /* More Specific Targeting */

                    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
                        /* You guessed it, ipad (tablets, smaller screens, etc) */
                        /* repeating for the ipad */
                        a[href^="tel"], a[href^="sms"] {
                            text-decoration: none;
                            color: blue; /* or whatever your want */
                            pointer-events: none;
                            cursor: default;
                        }

                        .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                            text-decoration: default;
                            color: orange !important;
                            pointer-events: auto;
                            cursor: default;
                        }
                    }

                    @media only screen and (-webkit-min-device-pixel-ratio: 2) {
                        /* Put your iPhone 4g styles in here */
                    }

                    /* Android targeting */
                    @media only screen and (-webkit-device-pixel-ratio:.75) {
                        /* Put CSS for low density (ldpi) Android layouts in here */
                    }

                    @media only screen and (-webkit-device-pixel-ratio:1) {
                        /* Put CSS for medium density (mdpi) Android layouts in here */
                    }

                    @media only screen and (-webkit-device-pixel-ratio:1.5) {
                        /* Put CSS for high density (hdpi) Android layouts in here */
                    }
                    /* end Android targeting */
                </style>
                <!-- Targeting Windows Mobile -->
                <!--[if IEMobile 7]>
                <style type="text/css">

                </style>
                <![endif]-->
                <!-- ***********************************************
                ****************************************************
                END MOBILE TARGETING
                ****************************************************
                ************************************************ -->
                <!--[if gte mso 9]>
                    <style>
                    /* Target Outlook 2007 and 2010 */
                    </style>
                <![endif]-->
            </head>
            <body style=" width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; margin: 0; padding: 0;">
                <!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
                <table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tr>
                        <td valign="top">
                            <!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
                            <table cellpadding="0" cellspacing="0" border="0" align="center" width="700">
                            <tr>
                                    <td>
                                        <a href="http://edit.work"><img src="http://edit.work/img/banner_email.png" style="display: block; max-width:100%; border: none; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;"/></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" width="700" style="text-align: center; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tr>
                                                <td width="70"></td>
                                                <td width="560" style="text-align: left; padding-top: 40px; padding-bottom: 80px;">
                                                    <h1 style="width: 560px; font-family: \'Lucida Sans\',Verdana,Arial,sans-serif; font-size: 24px; color:#000000;"> Olá, $sClientName</h1>
                                                    <p style="width: 560px; margin: 1em 0; font-family: "Lucida Sans",Verdana,Arial,sans-serif; font-size: 14px; color:#333;">
                                                      O pedido de inscrição nesta Growth Session foi recebido pela equipa do EDIT.WORK. Agradecemos desde já o teu interesse. Em breve entraremos em contacto contigo.
                                                    </p>
                                                      <p style="width: 560px; margin: 1em 0; font-family: "Lucida Sans",Verdana,Arial,sans-serif; font-size: 14px; color:#333;">
                                                    A equipa EDIT.WORK
                                                    </p>
                                                    <p>&nbsp;</p>
                                                      <p style="width: 560px; margin: 1em 0; font-family: "Lucida Sans",Verdana,Arial,sans-serif; font-size: 14px;color:#333;">
                                                        <b>EDIT. Lisboa</b> <br />
                                                        Alameda D. Afonso <br />
                                                        Henriques, 7A <br />
                                                        1900-178, Lisboa <br />
                                                        Portugal <br />
                                                    </p>
                                                    <p style="width: 560px; margin: 1em 0; font-family: "Lucida Sans",Verdana,Arial,sans-serif; font-size: 14px;color:#333;">
                                                        <b>EDIT. Porto</b> <br />
                                                        Rua Gonçalo Cristovão, nº 347, 3º Piso, Sala 302 e 309 <br />
                                                        4000-270, Porto <br />
                                                        Portugal <br />
                                                    </p>
                                                    <p style="width: 560px; margin: 1em 0; font-family: "Lucida Sans",Verdana,Arial,sans-serif; font-size: 14px;color:#333;">
                                                        <b>EDIT. Madrid</b> <br />
                                                        Calle de la Colegiata 9, utopic_Us <br />
                                                        28012 Madrid <br />
                                                        Espanha <br />
                                                    </p> 
                                                </td>
                                                <td width="70"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <img src="http://edit.work/img/footer_email.png" style="display: block; max-width:100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; "/>
                                    </td>
                                </tr>
                            </table>
                
                        </td>
                    </tr>
                </table>
                <!-- End of wrapper table -->
            </body>
            </html>