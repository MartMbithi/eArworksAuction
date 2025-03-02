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

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/* Login */

if (isset($_POST['User_Login'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));

    $ret = mysqli_query($mysqli, "SELECT * FROM users 
    WHERE user_email = '{$user_email}' AND user_password = '{$user_password}' AND user_delete_status != '1' AND  user_account_status = 'Active'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        /* Persist Sessions */
        $_SESSION['user_id'] = $num['user_id'];
        $_SESSION['user_email'] = $num['user_email'];
        $_SESSION['user_phone_number'] = $num['user_phone_number'];

        /* Determiner Where To Redirect Based On Access Leveles */
        if (($num['user_access_level'] == 'Administrator') ||  ($num['user_access_level'] == 'Staff')) {
            /* Load Sessions */
            $_SESSION['user_access_level'] = $num['user_access_level'];
            $_SESSION['success'] = "Welcome to back office module";
            header('Location: dashboard');
            exit;
        } else if ($num['user_access_level'] == 'Customer') {

            /* Nested If Statement On Customer Check If They Have Enaled 2FA  */
            if ($num['user_2fa_status'] == '1') {

                /* Give User OTP Code*/
                $two_fa_sql = "UPDATE users SET user_2fa_code = '{$two_fa_codes}' WHERE user_id = '{$num['user_id']}'";

                /* Mail That OTP Code  */
                include('../app/mailers/otp.php');

                /* Preapare */
                if (mysqli_query($mysqli, $two_fa_sql) && $mail->send()) {

                    /* SMS OTP Code */
                    $to = $_SESSION['user_phone_number'];
                    $to = preg_replace("/\s+/", "", $to);
                    $arr = str_split($to);

                    $to = "254" . substr($to, -9);

                    /* GENERATE API HEADERS & PAYLOAF */
                    $client = new Client([
                        'base_uri' => "https://89y4k1.api.infobip.com/",
                        'headers' => [
                            'Authorization' => "",
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                        ]
                    ]);

                    /* Prepare API REQUEST To Infobip */

                    $response = $client->request(
                        'POST',
                        'sms/2/text/advanced',
                        [
                            RequestOptions::JSON => [
                                'messages' => [
                                    [
                                        'from' => 'eArtworks',
                                        'destinations' => [
                                            ['to' => "$to"]
                                        ],
                                        'text' => 'This is your OTP Code: ' . $two_fa_codes,
                                    ]
                                ]
                            ],
                        ]
                    );

                    $_SESSION['success'] = 'Check your email or message we have sent you authentication code';
                    header('Location: landing_otp_confirm');
                    exit;
                } else {
                    $err = "We're experiencing difficulty delivering your OTP code. Please retry later.";
                }
            } else {
                /* Load Sessions */
                $_SESSION['user_access_level'] = $num['user_access_level'];
                $_SESSION['success'] = 'Login was successful';
                header('Location: ../');
                exit;
            }
        }
    } else {
        $err = "Failed! Invalid Login Credentials or Your account is not verified";
    }
}

/* Resent 2FA Code Incase User Missed It */
if (isset($_POST['Resent_2FA_Code'])) {
    $user_phone_number = mysqli_real_escape_string($mysqli, $_SESSION['user_phone_number']);
    $user_email = mysqli_real_escape_string($mysqli, $_SESSION['user_email']);
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);

    /* Persist */
    $resent_sql = "UPDATE users SET user_2fa_code = '{$two_fa_codes}' WHERE user_id = '{$user_id}'";

    /* Mail That OTP Code  */
    include('../app/mailers/otp.php');

    /* Preapare */
    if (mysqli_query($mysqli, $resent_sql) && $mail->send()) {
        /* SMS OTP Code */
        $to = $user_phone_number;
        $to = preg_replace("/\s+/", "", $to);
        $arr = str_split($to);

        $to = "254" . substr($to, -9);

        /* GENERATE API HEADERS & PAYLOAD */
        $client = new Client([
            'base_uri' => "https://89y4k1.api.infobip.com/",
            'headers' => [
                'Authorization' => "App 2015dca8a64813666b47902dd6567af9-12ae6a93-ddb3-4af8-b01f-c82bab88a71c",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);


        /* Prepare API REQUEST To Infobip */

        $response = $client->request(
            'POST',
            'sms/2/text/advanced',
            [
                RequestOptions::JSON => [
                    'messages' => [
                        [
                            'from' => 'eArtworks',
                            'destinations' => [
                                ['to' => "$to"]
                            ],
                            'text' => 'This is your OTP Code: ' . $two_fa_codes,
                        ]
                    ]
                ],
            ]
        );

        /* If the above logic is error free pass an alert message to users */
        $_SESSION['success'] = 'Check your email or message we have sent you authentication code';
        header('Location: landing_otp_confirm');
        exit;
    } else {
        $err = "We're experiencing difficulty delivering your OTP code. Please retry later.";
    }
}


/* Confirm 2FA */
if (isset($_POST['Customer_Confirm_2FA'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $user_2fa_code = mysqli_real_escape_string($mysqli, $_POST['user_2fa_code']);

    /* Login User Using This Code */
    $stmt = $mysqli->prepare("SELECT user_id, user_2fa_code, user_access_level  FROM users  WHERE 
    user_2fa_code = '{$user_2fa_code}' AND user_id = '{$user_id}' ");
    $stmt->execute();
    $stmt->bind_result($user_id, $user_2fa_code, $user_access_level);
    $rs = $stmt->fetch();
    /* Prepare */
    if ($rs) {
        /* Allow Login */
        $_SESSION['user_access_level'] = $user_access_level;
        $_SESSION['success'] = 'Login success';
        header('Location: ../');
        exit;
    } else {
        $err = "Failed, please type the right code";
    }
}

/* Register */
if (isset($_POST['User_Register'])) {
    $user_first_name = mysqli_real_escape_string($mysqli, $_POST['user_first_name']);
    $user_last_name  = mysqli_real_escape_string($mysqli, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_dob  = mysqli_real_escape_string($mysqli, $_POST['user_dob']);
    $user_phone_number  = mysqli_real_escape_string($mysqli, $_POST['user_phone_number']);
    $user_default_address  = mysqli_real_escape_string($mysqli, $_POST['user_default_address']);
    $user_access_level  = mysqli_real_escape_string($mysqli, 'Customer');
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Avoid Duplications */
        $sql = "SELECT * FROM  users   WHERE user_email = '{$user_email}' AND  user_phone_number = '{$user_phone_number}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $user_email == $row['user_email'] || $user_phone_number == $row['user_phone_number']
            ) {
                $err = 'Phone Number Or Email Already Exists';
            }
        } else {
            /* Persist */
            $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_default_address, user_password, user_access_level)
            VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_default_address}', '{$confirm_password}', '{$user_access_level}')";

            /* Load Mailer */
            include('../app/mailers/confirm_email.php');

            /* Prepare */
            if (mysqli_query($mysqli, $insert_sql) && $mail->send()) {
                $_SESSION['success'] = "Account created, proceed to log in";
                header('Location: login');
                exit;
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}

/* Confirm User Email */
if (isset($_GET['confirm'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_GET['confirm']);

    /* Persist */
    $sql = "UPDATE users SET user_email_status = 'Confirmed' WHERE user_email  = '{$user_email}'";

    /* Prepare*/
    if (mysqli_query($mysqli, $sql)) {
        $success = "Email confirmed";
    } else {
        $err = "Please try again later";
    }
}

/* Reset Password Step 1 */
if (isset($_POST['Reset_Password'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password_reset_token = mysqli_real_escape_string($mysqli, $checksum);

    /* Persist */
    $sql = "SELECT * FROM  users   WHERE user_email = '{$user_email}'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        /* Persist Reset Token */
        $sql = "UPDATE users SET user_password_reset_token = '{$user_password_reset_token}' WHERE user_email = '{$user_email}'";
        /* Email User Reset Token */
        include('../app/mailers/reset_password.php');
        if (mysqli_query($mysqli, $sql) && $mail->send()) {
            $success = "Password reset instructions has been emailed to you";
        } else {
            $err = "Failed, please try again later";
        }
    } else {
        /* No Account With This Email */
        $err = "Email address does not exist";
    }
}


/* Reset Password Step 2 */
if (isset($_POST['Reset_Password_Step_2'])) {
    $token = mysqli_real_escape_string($mysqli, $_GET['token']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($confirm_password != $new_password) {
        $err = "Passwords does not match";
    } else {
        /* Persist */
        $sql = "UPDATE users SET user_password  = '{$confirm_password}' WHERE user_password_reset_token = '{$token}'";

        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $_SESSION['success'] = 'Successfully reset your password, now log in.';
            header('Location: ../');
            exit;
        }
    }
}
