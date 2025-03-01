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


/* Load Composer PHPMAILER */
/* require_once('../vendor/PHPMailer/src/SMTP.php');
require_once('../vendor/PHPMailer/src/PHPMailer.php');
require_once('../vendor/PHPMailer/src/Exception.php'); */

include('../vendor/autoload.php');

/* Confirm Links */
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
$confirm_url = $uri . '/eArworksAuction/ui/landing_confirm_email?confirm=' . $user_email;


/* Init PHP Mailer */
$ret = "SELECT * FROM mailer_settings";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->setFrom($sys->mail_from_email);
    $mail->addAddress($user_email);
    $mail->FromName = $sys->mail_from_name;
    $mail->isHTML(true);
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = $sys->mail_host;
    $mail->SMTPAuth = true;
    $mail->Port = $sys->mail_port;
    $mail->Username = $sys->mail_username;
    $mail->Password = $sys->mail_password;
    $mail->Subject = 'Confirm Email Address';
    $mail->Body = '
    <table
        style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%; user-select: none;"
        width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
            <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top;" valign="top">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <div style="background-color: #ff4f5a;">
                                        <div
                                            style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
                                            <div
                                                style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                                <table style="background-color: #132437;" width="100%" cellspacing="0"
                                                    cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width: 600px;" cellspacing="0" cellpadding="0"
                                                                    border="0">
                                                                    <tbody>
                                                                        <tr style="background-color: transparent;">
                                                                            <td style="background-color: transparent; width: 600px; border: 0px solid transparent;"
                                                                                width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0"
                                                                                    cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding: 0px;">
                                                                                                <div
                                                                                                    style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                                                                                                    <div
                                                                                                        style="width: 100% !important;">
                                                                                                        
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
                                    <div style="background-color: #ff4f5a;">
                                        <div
                                            style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
                                            <div
                                                style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
                                                <table style="background-color: #132437;" width="100%" cellspacing="0"
                                                    cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width: 600px;" cellspacing="0" cellpadding="0"
                                                                    border="0">
                                                                    <tbody>
                                                                        <tr style="background-color: #ffffff;">
                                                                            <td style="background-color: #ffffff; width: 600px; border: 0px solid transparent;"
                                                                                width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0"
                                                                                    cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="padding: 50px 10px 10px;">
                                                                                                <div
                                                                                                    style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                                                                                                    <div
                                                                                                        style="width: 100% !important;">
                                                                                                        <div
                                                                                                            style="border: 0px solid transparent; padding: 0px 0px 10px 0px;">
                                                                                                            <div style="padding-right: 20px; padding-left: 20px;"
                                                                                                                align="center">
                                                                                                                <table
                                                                                                                    width="100%"
                                                                                                                    cellspacing="0"
                                                                                                                    cellpadding="0"
                                                                                                                    border="0">
                                                                                                                    <tbody>
                                                                                                                        <tr
                                                                                                                            style="line-height: 0px;">
                                                                                                                            <td style="padding-right: 20px; padding-left: 20px;"
                                                                                                                                align="center">
                                                                                                                                <div
                                                                                                                                    style="font-size: 1px; line-height: 5px;">
                                                                                                                                    &nbsp;
                                                                                                                                </div>
                                                                                                                                <img style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 50%; max-width: 541px; display: block;"
                                                                                                                                    src="https://cdn-icons-png.flaticon.com/512/1334/1334653.png"
                                                                                                                                    alt=""
                                                                                                                                    width="541"
                                                                                                                                    border="0"
                                                                                                                                    align="middle">
                                                                                                                                <div
                                                                                                                                    style="font-size: 1px; line-height: 5px;">
                                                                                                                                    &nbsp;
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </div>
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
                                    <div
                                        style="background-position: top left; background-repeat: no-repeat; background-color: #333;">
                                        <div
                                            style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
                                            <div
                                                style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table style="width: 600px;" cellspacing="0" cellpadding="0"
                                                                    border="0">
                                                                    <tbody>
                                                                        <tr style="background-color: #ffffff;">
                                                                            <td style="background-color: #ffffff; width: 600px; border: 0px solid transparent;"
                                                                                width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0"
                                                                                    cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding: 0px;">
                                                                                                <div
                                                                                                    style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                                                                                                    <div
                                                                                                        style="width: 100% !important;">
                                                                                                        <div
                                                                                                            style="border: 0px solid transparent; padding: 0px;">
                                                                                                            <table
                                                                                                                style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                                                                width="100%"
                                                                                                                cellspacing="0"
                                                                                                                cellpadding="0">
                                                                                                                <tbody>
                                                                                                                    <tr style="vertical-align: top;"
                                                                                                                        valign="top">
                                                                                                                        <td style="word-break: break-word; vertical-align: top; text-align: center; width: 100%; padding: 25px 0px 5px 0px;"
                                                                                                                            width="100%"
                                                                                                                            valign="top"
                                                                                                                            align="center">
                                                                                                                            <h1
                                                                                                                                style="color: #555555; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 30px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;padding: 0 50px;">
                                                                                                                                <strong>
                                                                                                                                    Hey there, you
                                                                                                                                    are
                                                                                                                                    one
                                                                                                                                    step
                                                                                                                                    away
                                                                                                                                    from
                                                                                                                                    ultimate
                                                                                                                                    eArworksAuction
                                                                                                                                </strong>
                                                                                                                            </h1>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <table
                                                                                                                width="100%"
                                                                                                                cellspacing="0"
                                                                                                                cellpadding="0"
                                                                                                                border="0">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td
                                                                                                                            style="font-family: Arial, sans-serif;">
                                                                                                                            <div
                                                                                                                                style="color: #737487; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 1.8; padding: 20px 15px 20px 15px;">
                                                                                                                                <div
                                                                                                                                    style="font-size: 14px; line-height: 1.8; color: #737487; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 25px;">
                                                                                                                                    <p
                                                                                                                                        style="margin: 0; font-size: 18px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 32px; margin-top: 0; margin-bottom: 0;">
                                                                                                                                        <span
                                                                                                                                            style="font-size: 18px;">Please
                                                                                                                                            Confirm
                                                                                                                                            your
                                                                                                                                            email
                                                                                                                                            address
                                                                                                                                        </span>
                                                                                                                                    </p>
                                                                                                                                    <p
                                                                                                                                        style="margin: 0; font-size: 18px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 32px; margin-top: 0; margin-bottom: 0;">
                                                                                                                                        <span
                                                                                                                                            style="font-size: 18px;">to
                                                                                                                                            finish
                                                                                                                                            setting
                                                                                                                                            up
                                                                                                                                            your
                                                                                                                                            account.</span>
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <div
                                                                                                                align="center">
                                                                                                                <table
                                                                                                                    style="border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                                                                    width="100%"
                                                                                                                    cellspacing="0"
                                                                                                                    cellpadding="0"
                                                                                                                    border="0">
                                                                                                                    <tbody>
                                                                                                                        <tr>
                                                                                                                            <td style="padding: 20px 15px 40px 15px;"
                                                                                                                                align="center">
                                                                                                                                <center
                                                                                                                                    style="font-family: Arial, sans-serif; font-size: 16px;">
                                                                                                                                    <div
                                                                                                                                        style="text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff4f5a; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; padding-top: 10px; padding-bottom: 10px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; cursor: pointer;">
                                                                                                                                        <a href="' . $confirm_url . '" style="color: #ffffff;">
                                                                                                                                        <span
                                                                                                                                            style="padding-left: 60px; padding-right: 60px; font-size: 16px; display: inline-block; letter-spacing: undefined;"><span
                                                                                                                                                style="font-weight: 600; font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">
                                                                                                                                                Confirm
                                                                                                                                                Email
                                                                                                                                            </span>
                                                                                                                                        </span>
                                                                                                                                        </a>
                                                                                                                                    </div>
                                                                                                                                </center>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </div>
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
