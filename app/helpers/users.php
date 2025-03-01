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


/* _____________________________________________________________________________________________________ */

/* Customers Helpers */

/* Register Customer */

if (isset($_POST['Register_New_Customer'])) {
    /*
     The following functionalities has been removed
     1. Automated email with a link to create new password
     2. Automated welcome email to help user set up account
     3. Password is given by the entity who is registering the account
    */
    $user_first_name = mysqli_real_escape_string($mysqli, $_POST['user_first_name']);
    $user_last_name  = mysqli_real_escape_string($mysqli, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_dob  = mysqli_real_escape_string($mysqli, $_POST['user_dob']);
    $user_phone_number  = mysqli_real_escape_string($mysqli, $_POST['user_phone_number']);
    $user_default_address  = mysqli_real_escape_string($mysqli, $_POST['user_default_address']);
    $user_access_level  = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, 'Demo123@'))); /* Default User Password - Update This Password */
    if (!empty($_FILES['user_profile_picture']['name'])) {
        /* Process User Image */
        $temp_user_image = explode('.', $_FILES['user_profile_picture']['name']);
        $new_user_image = 'Customer_' . (round(microtime(true)) . '.' . end($temp_user_image));
        move_uploaded_file(
            $_FILES['user_profile_picture']['tmp_name'],
            '../public/uploads/users/' . $new_user_image
        );

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
            $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_default_address, user_password, user_access_level, user_profile_picture)
                VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_default_address}', '{$user_password}', '{$user_access_level}', '{$new_user_image}')";

            /* Prepare */
            if (mysqli_query($mysqli, $insert_sql)) {
                $success = "User registered";
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    } else {
        /* Persist Without Profile Photo */
        $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_default_address, user_password, user_access_level)
        VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_default_address}', '{$user_password}', '{$user_access_level}')";

        /* Prepare */
        if (mysqli_query($mysqli, $insert_sql)) {
            $success = "User registered";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}



/* Update Customer Account */
if (isset($_POST['Update_Customer_Profile'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $user_first_name = mysqli_real_escape_string($mysqli, $_POST['user_first_name']);
    $user_last_name  = mysqli_real_escape_string($mysqli, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_dob  = mysqli_real_escape_string($mysqli, $_POST['user_dob']);
    $user_phone_number  = mysqli_real_escape_string($mysqli, $_POST['user_phone_number']);
    $user_default_address  = mysqli_real_escape_string($mysqli, $_POST['user_default_address']);
    /* Check If User Profile Has A File In It */
    if (!empty($_FILES['user_profile_picture']['name'])) {
        /* Process User Image */
        $temp_user_image = explode('.', $_FILES['user_profile_picture']['name']);
        $new_user_image = 'Customer_' . (round(microtime(true)) . '.' . end($temp_user_image));
        move_uploaded_file(
            $_FILES['user_profile_picture']['tmp_name'],
            '../public/uploads/users/' . $new_user_image
        );
        /*Check If User Had 
        Existing Profile Photo And If It
        Was There Delete It From Storage Then Replace With New One
        */
        $sql = "SELECT * FROM  users WHERE  user_id = '{$user_id}'";
        $res = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($res);
        if (!empty($row['user_profile_picture'])) {
            /* User Has Old Photo */
            $old_profile_photo = $row['user_profile_picture'];
            $old_profile_photo_location = '../public/uploads/users/' . $old_profile_photo;
            /* Delete It */
            unlink($old_profile_photo_location);
        }
        /* Process  User Accout Update */
        $update_sql = "UPDATE users SET user_first_name = '{$user_first_name}', user_last_name = '{$user_last_name}', 
        user_email = '{$user_email}', user_dob = '{$user_dob}',user_phone_number = '{$user_phone_number}',user_default_address = '{$user_default_address}',
        user_profile_picture = '{$new_user_image}' WHERE user_id = '{$user_id}'";

        /* Persist */
        if (mysqli_query($mysqli, $update_sql)) {
            $success = "Profile details updated";
        } else {
            $err = "Failed, please try again later";
        }
    } else {
        /* Process User Account Update Without Changing Profile Photo */
        $update_sql = "UPDATE users SET user_first_name = '{$user_first_name}', user_last_name = '{$user_last_name}', 
        user_email = '{$user_email}', user_dob = '{$user_dob}',user_phone_number = '{$user_phone_number}',user_default_address = '{$user_default_address}'
        WHERE user_id = '{$user_id}'";

        /* Persist */
        if (mysqli_query($mysqli, $update_sql)) {
            $success = "Profile details updated";
        } else {
            $err = "Failed, please try again later";
        }
    }
}

/* Update Customer Account Password Details */
if (isset($_POST['Update_Customer_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $old_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['old_password'])));
    $new_password  = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    if ($new_password != $confirm_password) {
        /* Check If Passwords Match */
        $err = "Passwords does not match";
    } else {

        /* Does Old Password Match */
        $sql = "SELECT * FROM  users   WHERE user_id = '{$user_id}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($row['user_password'] != $old_password) {
                $err = "Enter correct old password";
            } else {
                /* Persist Password Update */
                $update_sql = "UPDATE users SET user_password  = '{$confirm_password}' WHERE user_id = '{$user_id}'";
                /* Prepare */
                if (mysqli_query($mysqli, $update_sql)) {
                    $success = "Password updated";
                } else {
                    $err = "Failed, please try again";
                }
            }
        }
    }
}

/* Enable Or Disable 2FA */
if (isset($_POST['Customer_2FA'])) {
    $user_2fa_status = mysqli_real_escape_string($mysqli, $_POST['user_2fa_status']);
    $user_2fa_code = mysqli_real_escape_string($mysqli, $_POST['user_2fa_code']);
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $alert = mysqli_real_escape_string($mysqli, $_POST['alert']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);


    /* Persist  */
    $sql  = "UPDATE users SET user_2fa_status = '{$user_2fa_status}'  WHERE user_id = '{$user_id}'";

    if (!empty($user_2fa_code)) {
        /* Notify User Has Enabled 2FA */
        include('../app/mailers/twofactor_enable_mailer.php');
        $mail->send();
    } else {
        /* Send Disabling 2FA Mailer */
        include('../app/mailers/twofactor_disable_mailer.php');
        $mail->send();
    }

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {

        $success = $alert;
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* __________________________________________________________________________________________________ */

/* STAFF HELPERS */

/* Register Staff */
if (isset($_POST['Register_New_Staff'])) {
    /*
     The following functionalities has been removed
     1. Automated email with a link to create new password
     2. Automated welcome email to help user set up account
     3. Password is given by the entity who is registering the account
    */
    $user_first_name = mysqli_real_escape_string($mysqli, $_POST['user_first_name']);
    $user_last_name  = mysqli_real_escape_string($mysqli, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_dob  = mysqli_real_escape_string($mysqli, $_POST['user_dob']);
    $user_phone_number  = mysqli_real_escape_string($mysqli, $_POST['user_phone_number']);
    $user_default_address  = mysqli_real_escape_string($mysqli, $_POST['user_default_address']);
    $user_access_level  = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, 'Demo123@'))); /* Default User Password - Update This Password */
    /* Process User Image */
    $temp_user_image = explode('.', $_FILES['user_profile_picture']['name']);
    $new_user_image = $user_access_level . '_' . (round(microtime(true)) . '.' . end($temp_user_image));
    move_uploaded_file(
        $_FILES['user_profile_picture']['tmp_name'],
        '../public/uploads/users/' . $new_user_image
    );

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
        $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_default_address, user_password, user_access_level, user_profile_picture)
            VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_default_address}', '{$user_password}', '{$user_access_level}', '{$new_user_image}')";

        /* Prepare */
        if (mysqli_query($mysqli, $insert_sql)) {
            $success = "User registered";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}

/* Update Staff Password */
if (isset($_POST['Update_Staff_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Does passwords match */
    if ($confirm_password != $new_password) {
        $err = "Passwords does not match";
    } else {
        /* Persist */
        $sql = "UPDATE users SET user_password = '{$confirm_password}' WHERE user_id = '{$user_id}'";

        if (mysqli_query($mysqli, $sql)) {
            $success = "Password updated";
        } else {
            $err = "Failed, try again";
        }
    }
}

/* ___________________________________________________________________________________________________ */


/* COMMON HELPERS */

/*
The following are common functions that are can be accessed by
all access levels
*/

/* Delete Users */
if (isset($_POST['Delete_User'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $user_delete_status = mysqli_real_escape_string($mysqli, '1'); /* Move This record to trash */

    /* Persist */
    $sql = "UPDATE users SET user_delete_status = '{$user_delete_status}' WHERE user_id = '{$user_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "User moved to recycle bin";
    } else {
        $err = "Error, please try again";
    }
}
