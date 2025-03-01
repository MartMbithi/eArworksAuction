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


/* Manage Mailer Settings */
if (isset($_POST['Update_Mailer'])) {
    $mailer_id = mysqli_real_escape_string($mysqli, $_POST['mailer_id']);
    $mail_host = mysqli_real_escape_string($mysqli, $_POST['mail_host']);
    $mail_port = mysqli_real_escape_string($mysqli, $_POST['mail_port']);
    $mail_protocol = mysqli_real_escape_string($mysqli, $_POST['mail_protocol']);
    $mail_username = mysqli_real_escape_string($mysqli, $_POST['mail_username']);
    $mail_password = mysqli_real_escape_string($mysqli, $_POST['mail_password']);
    $mail_from_name = mysqli_real_escape_string($mysqli, $_POST['mail_from_name']);
    $mail_from_email = mysqli_real_escape_string($mysqli, $_POST['mail_from_email']);

    /* Persist */
    $sql = "UPDATE mailer_settings SET mail_host = '{$mail_host}', mail_port = '{$mail_port}', mail_protocol = '{$mail_protocol}', mail_username = '{$mail_username}',
    mail_password = '{$mail_password}', mail_from_name = '{$mail_from_name}', mail_from_email = '{$mail_from_email}'  WHERE mailer_id = '{$mailer_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "STMP mailer confgurations updated";
    } else {
        $err = "Failed, please try again";
    }
}

/* Add thirdparty API  */
if (isset($_POST['Add_API'])) {
    $api_name = mysqli_real_escape_string($mysqli, $_POST['api_name']);
    $api_identification = mysqli_real_escape_string($mysqli, $_POST['api_identification']);
    $api_token = mysqli_real_escape_string($mysqli, $_POST['api_token']);

    /* Persist */
    $sql = "INSERT INTO thirdparty_apis (api_name, api_identification, api_token) VALUES('{$api_name}', '{$api_identification}', '{$api_token}')";

    if (mysqli_query($mysqli, $sql)) {
        $success = "$api_name added to API lists";
    } else {
        $err = "Failed, please try again";
    }
}

/* Update API */
if (isset($_POST['Update_API'])) {
    $api_id = mysqli_real_escape_string($mysqli, $_POST['api_id']);
    $api_name = mysqli_real_escape_string($mysqli, $_POST['api_name']);
    $api_identification = mysqli_real_escape_string($mysqli, $_POST['api_identification']);
    $api_token = mysqli_real_escape_string($mysqli, $_POST['api_token']);

    /* Persist */
    $sql  = "UPDATE thirdparty_apis SET api_name = '{$api_name}', api_identification = '{$api_identification}', api_token = '{$api_token}' 
    WHERE api_id = '{$api_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "$api_name updated";
    } else {
        $err = "Failed, please try again";
    }
}

/* Delete API */
if (isset($_POST['Delete_API'])) {
    $api_id = mysqli_real_escape_string($mysqli, $_POST['api_id']);

    /* Persist */
    $sql  = "DELETE FROM thirdparty_apis WHERE api_id = '{$api_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "API deleted";
    } else {
        $err = "Failed, please try again";
    }
}

/* Add Payment Methods */
if (isset($_POST['Add_Payment_Means'])) {
    $means_code = mysqli_real_escape_string($mysqli, $_POST['means_code']);
    $means_name = mysqli_real_escape_string($mysqli, $_POST['means_name']);

    /* Persist */
    $sql = "INSERT INTO payment_means (means_code, means_name) VALUES('{$means_code}', '{$means_name}')";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Payment method added";
    } else {
        $err = "Failed, please try again";
    }
}


/* Update Payment Methods */
if (isset($_POST['Update_Payment_Means'])) {
    $means_id = mysqli_real_escape_string($mysqli, $_POST['means_id']);
    $means_code = mysqli_real_escape_string($mysqli, $_POST['means_code']);
    $means_name = mysqli_real_escape_string($mysqli, $_POST['means_name']);

    /* Persist */
    $sql = "UPDATE payment_means SET means_code = '{$means_code}', means_name = '{$means_name}' WHERE means_id = '{$means_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Payment method updated";
    } else {
        $err = "Failed, please try again";
    }
}


/* Delete Payment Methods */
if (isset($_POST['Delete_Payment_Means'])) {
    $means_id = mysqli_real_escape_string($mysqli, $_POST['means_id']);

    /* Persist */
    $sql = "UPDATE payment_means SET means_delete_status = '1' WHERE means_id = '{$means_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Payment means moved to recycle bin";
    } else {
        $err = "Failed, please try again";
    }
}


/* Purge Everything */
if (isset($_POST['Purge_Everything'])) {
    /* Purge Everything */
    $categories_purge = "DELETE FROM categories WHERE category_delete_status = '1'";
    $orders_purge = "DELETE FROM orders WHERE order_delete_status= '1'";
    $payments_purge = "DELETE FROM payments WHERE payment_delete_status = '1'";
    $payment_means_purge = "DELETE FROM payment_means WHERE means_delete_status  = '1'";
    $products_purge = "DELETE FROM products WHERE product_delete_status = '1'";
    $users_purge = "DELETE FROM users WHERE user_delete_status  = '1'";

    /* Persist */
    if (
        mysqli_query($mysqli, $categories_purge) &&
        mysqli_query($mysqli, $orders_purge) &&
        mysqli_query($mysqli, $payments_purge) &&
        mysqli_query($mysqli, $payment_means_purge) &&
        mysqli_query($mysqli, $products_purge) &&
        mysqli_query($mysqli, $users_purge)
    ) {
        $success  = "Contents in recycle bin purged";
    } else {
        $err = "Failed, please try again";
    }
}

/* Delete Categories */
if (isset($_POST['Delete_Categories'])) {
    $category_id = mysqli_real_escape_string($mysqli, $_POST['category_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM categories WHERE category_id = '{$category_id}'"
    )) {
        $success = "Category deleted";
    } else {
        $err  = "Failed, please try again";
    }
}


/* Restore Categories */
if (isset($_POST['Restore_Categories'])) {
    $category_id   = mysqli_real_escape_string($mysqli, $_POST['category_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "UPDATE categories SET category_delete_status = '0' WHERE category_id = '{$category_id}'"
    )) {
        $success = "Category restored";
    } else {
        $err  = "Failed, please try again";
    }
}

/* Delete Order */
if (isset($_POST['Delete_Order'])) {
    $order_code = mysqli_real_escape_string($mysqli, $_POST['order_code']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM  orders WHERE order_code = '{$order_code}'"
    )) {
        $success = "Order deleted";
    } else {
        $err =  "Failed, please try again";
    }
}

/* Restore Orders */
if (isset($_POST['Restore_Orders'])) {
    $order_code = mysqli_real_escape_string($mysqli, $_POST['order_code']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "UPDATE orders SET order_delete_status = '0' WHERE order_code = '{$order_code}'"
    )) {
        $success = "Order restored";
    } else {
        $err =  "Failed, please try again";
    }
}


/* Delete Payments */
if (isset($_POST['Delete_Payment'])) {
    $payment_id = mysqli_real_escape_string($mysqli, $_POST['payment_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM payments WHERE payment_id = '{$payment_id}'"
    )) {
        $success = "Payment deleted";
    } else {
        $err = "Failed, please try again";
    }
}

/* Restore Payments */
if (isset($_POST['Restore_Payment'])) {
    $payment_id = mysqli_real_escape_string($mysqli, $_POST['payment_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "UPDATE payments SET payment_delete_status = '0' WHERE payment_id = '{$payment_id}'"
    )) {
        $success = "Payment restored";
    } else {
        $err = "Failed, please try again";
    }
}

/* Delete Payment Means */
if (isset($_POST['Delete_Payment_Means_From_Trash'])) {
    $means_id = mysqli_real_escape_string($mysqli, $_POST['means_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM payment_means  WHERE means_id = '{$means_id}'"
    )) {
        $success = "Payment means deleted";
    } else {
        $err = "Failed, pelase try again";
    }
}


/* Restore Payments Methods */
if (isset($_POST['Restore_Payment_Methods'])) {
    $means_id = mysqli_real_escape_string($mysqli, $_POST['means_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "UPDATE payment_means SET means_delete_status = '0' WHERE means_id = '{$means_id}'"
    )) {
        $success = "Payment means restored";
    } else {
        $err = "Failed, pelase try again";
    }
}

/* Delete Product */
if (isset($_POST['Delete_Product'])) {
    $product_id = mysqli_real_escape_string($mysqli, $_POST['product_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM products WHERE product_id = '{$product_id}'"
    )) {
        $success = "Product deleted";
    } else {
        $err = "Failed, please try again";
    }
}

/* Restore Products */
if (isset($_POST['Restore_Products'])) {
    $product_id  = mysqli_real_escape_string($mysqli, $_POST['product_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "UPDATE products SET product_delete_status = '0' WHERE product_id = '{$product_id}'"
    )) {
        $success = "Product restored";
    } else {
        $err = "Failed, please try again";
    }
}

/* Delete Staffs */
if (isset($_POST['Delete_Staff_Account'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM users WHERE user_id ='{$user_id}'"
    )) {
        $success = "Account deleted";
    } else {
        $err = "Failed, please try again";
    }
}

/* Restore Staffs */
if (isset($_POST['Restore_Staff_Account'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "UPDATE users SET user_delete_status = '0' WHERE user_id = '{$user_id}'"
    )) {
        $success = "Account restored";
    } else {
        $err = "Failed, please try again";
    }
}

/* Analytics Of Items In Recycle Bin */

/* 1. Deleted Staffs */
$query = "SELECT COUNT(*)  FROM users WHERE user_access_level = 'Staff' AND  user_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_staffs);
$stmt->fetch();
$stmt->close();

/* 2. Deleted Customers */
$query = "SELECT COUNT(*)  FROM users WHERE user_access_level = 'Customer' AND  user_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_customers);
$stmt->fetch();
$stmt->close();


/* 3. Deleted Product Categories */
$query = "SELECT COUNT(*)  FROM categories WHERE category_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_categories);
$stmt->fetch();
$stmt->close();


/* 4. Deleted Products */
$query = "SELECT COUNT(*)  FROM products WHERE product_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_products);
$stmt->fetch();
$stmt->close();

/* 5. Deleted Orders */
$query = "SELECT COUNT(*)  FROM orders WHERE order_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_orders);
$stmt->fetch();
$stmt->close();

/* 6. Deleted Payment Means */
$query = "SELECT COUNT(*)  FROM payment_means WHERE means_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_payment_means);
$stmt->fetch();
$stmt->close();

/* 7. Deleted Payments */
$query = "SELECT COUNT(*)  FROM payments WHERE payment_delete_status = '1'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($deleted_payments);
$stmt->fetch();
$stmt->close();
