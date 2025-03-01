<?php
/*
 *   Crafted On Sat Mar 01 2025
 *   From his finger tips, through his IDE to your deployment environment at full throttle with no bugs, loss of data,
 *   fluctuations, signal interference, or doubt—it can only be
 *   the legendary coding wizard, Martin Mbithi (martin@devlan.co.ke, www.martmbithi.github.io)
 *   
 *   www.devlan.co.ke
 *   hello@devlan.co.ke
 *
 *
 *   The Devlan Solutions LTD Super Duper User License Agreement
 *   Copyright (c) 2022 Devlan Solutions LTD
 *
 *
 *   1. LICENSE TO BE AWESOME
 *   Congrats, you lucky human! Devlan Solutions LTD hereby bestows upon you the magical,
 *   revocable, personal, non-exclusive, and totally non-transferable right to install this epic system
 *   on not one, but TWO separate computers for your personal, non-commercial shenanigans.
 *   Unless, of course, you've leveled up with a commercial license from Devlan Solutions LTD.
 *   Sharing this software with others or letting them even peek at it? Nope, that's a big no-no.
 *   And don't even think about putting this on a network or letting a crowd join the fun unless you
 *   first scored a multi-user license from us. Sharing is caring, but rules are rules!
 *
 *   2. COPYRIGHT POWER-UP
 *   This Software is the prized possession of Devlan Solutions LTD and is shielded by copyright law
 *   and the forces of international copyright treaties. You better not try to hide or mess with
 *   any of our awesome proprietary notices, labels, or marks. Respect the swag!
 *
 *
 *   3. RESTRICTIONS, NO CHEAT CODES ALLOWED
 *   You may not, and you shall not let anyone else:
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or do any sneaky stuff to
 *   figure out the source code of this software;
 *   (b) modify, remix, distribute, or create your own funky version of this masterpiece;
 *   (c) copy (except for that one precious backup), distribute, show off in public, transmit, sell, rent,
 *   lease, or otherwise exploit the Software like it's your own.
 *
 *
 *   4. THE ENDGAME
 *   This License lasts until one of us says 'Game Over'. You can call it quits anytime by
 *   destroying the Software and all the copies you made (no hiding them under your bed).
 *   If you break any of these sacred rules, this License self-destructs, and you must obliterate
 *   every copy of the Software, no questions asked.
 *
 *
 *   5. NO GUARANTEES, JUST PIXELS
 *   DEVLAN SOLUTIONS LTD doesn’t guarantee this Software is flawless—it might have a few
 *   quirks, but who doesn’t? DEVLAN SOLUTIONS LTD washes its hands of any other warranties,
 *   implied or otherwise. That means no promises of perfect performance, marketability, or
 *   non-infringement. Some places have different rules, so you might have extra rights, but don’t
 *   count on us for backup if things go sideways. Use at your own risk, brave adventurer!
 *
 *
 *   6. SEVERABILITY—KEEP THE GOOD STUFF
 *   If any part of this License gets tossed out by a judge, don’t worry—the rest of the agreement
 *   still stands like a boss. Just because one piece fails doesn’t mean the whole thing crumbles.
 *
 *
 *   7. NO DAMAGE, NO DRAMA
 *   Under no circumstances will Devlan Solutions LTD or its squad be held responsible for any wild,
 *   indirect, or accidental chaos that might come from using this software—even if we warned you!
 *   And if you ever think you’ve got a claim, the most you’re getting out of us is the license fee you
 *   paid—if any. No drama, no big payouts, just pixels and code.
 *
 */


include('../vendor/autoload.php');

/* Init PHP Mailer */
$sql = mysqli_query($mysqli, "SELECT * FROM mailer_settings");
if (mysqli_num_rows($sql) > 0) {
    while ($sys = mysqli_fetch_array($sql)) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->setFrom($sys['mail_from_email']);
        $mail->addAddress($user_email);
        $mail->FromName = $sys['mail_from_name'];
        $mail->isHTML(true);
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = $sys['mail_host'];
        $mail->SMTPAuth = true;
        $mail->Port = $sys['mail_port'];
        $mail->Username = $sys['mail_username'];
        $mail->Password = $sys['mail_password'];
        $mail->Subject = "Order Confirmed";
        $mail->Body = '
    <table style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #d2e7f5; width: 100%;user-select: none;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#d2e7f5">
        <tbody>
            <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top;" valign="top">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td style="background-color:#d2e7f5" align="center">

                                    <div style="background-color: transparent;">
                                        <div style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #fff;">
                                            <div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                                <table style="background-color:transparent;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width:680px" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr style="background-color:transparent">
                                                                            <td style="background-color:transparent;width:226px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="226" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 224px; width: 226px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 0px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="0">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            
                                                                            <td style="background-color:transparent;width:226px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="226" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 224px; width: 226px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 0px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="0">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="background-color: transparent;">
                                        <div style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: white;">
                                            <div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                                <table style="background-color:transparent;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width:680px" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr style="background-color:transparent">
                                                                            <td style="background-color:transparent;width:680px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="680" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <div style="padding-right: 0px; padding-left: 0px;" align="center">
                                                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                    <tbody>
                                                                                                                        <tr style="line-height:0px">
                                                                                                                            <td style="padding-right: 0px;padding-left: 0px;" align="center"><img style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 40%; max-width: 612px; display: block;" title="bear looking at password" alt="bear looking at password" src="https://cdn-icons-png.flaticon.com/512/6815/6815043.png" width="612" border="0" align="middle"> </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </div>
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 5px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="5">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="background-color: transparent;">
                                        <div style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #fff;">
                                            <div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                                <table style="background-color:transparent;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width:680px" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr style="background-color:transparent">
                                                                            <td style="background-color:transparent;width:113px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="113" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 112px; width: 113px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 0px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="0">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td style="background-color:transparent;width:453px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="453" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 448px; width: 453px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%" cellspacing="0" cellpadding="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; text-align: center; width: 100%; padding: 0px;" width="100%" valign="top" align="center">
                                                                                                                            <h1 style="color: #03191e; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 40px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Order </strong></h1>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%" cellspacing="0" cellpadding="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; text-align: center; width: 100%; padding: 0px 0px 10px 0px;" width="100%" valign="top" align="center">
                                                                                                                            <h1 style="color: #03191e; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 40px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong> #' . $order_code . ' Confirmed.</strong></h1>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td style="padding-right: 10px; padding-left: 20px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif">
                                                                                                                            <div style="color: #848484; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 1.8; padding: 10px 10px 10px 20px;">
                                                                                                                                <div style="line-height: 1.8; font-size: 12px; color: #848484; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 22px;">
                                                                                                                                    <p style="margin: 0; font-size: 14px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 25px; margin-top: 0; margin-bottom: 0;">
                                                                                                                                        <span style="font-size: 14px;">
                                                                                                                                            Hello there, your order has been successfully submitted. Log in to your customer account and click track orders to track this order. You will be able to follow the status of your order.
                                                                                                                                        </span>
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 5px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 0px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="0">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td style="padding-right: 10px; padding-left: 20px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif">
                                                                                                                            <div style="color: #848484; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 1.8; padding: 10px 10px 10px 20px;">
                                                                                                                                <div style="line-height: 1.8; font-size: 12px; color: #848484; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 22px;">
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
																										    </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="background-color: transparent;">
                                        <div style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
                                            <div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                                <table style="background-color:transparent;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width:680px" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr style="background-color:transparent">
                                                                            <td style="background-color:transparent;width:113px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="113" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 112px; width: 113px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 10px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 5px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="5">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td style="background-color:transparent;width:453px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" width="453" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                                                                                                <div style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 448px; width: 453px;">
                                                                                                    <div style="width: 100% !important;">
                                                                                                        <div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 10px;" valign="top">
                                                                                                                            <table style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 5px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                                                                <tbody>
                                                                                                                                    <tr style="vertical-align: top;" valign="top">
                                                                                                                                        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" height="5">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    ';
    }
}
