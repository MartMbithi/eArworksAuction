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


/* Add Orders */
if (isset($_POST['Add_Order'])) {
    $order_user_id = mysqli_real_escape_string($mysqli, $_POST['order_user_id']);
    $order_product_id = mysqli_real_escape_string($mysqli, $_POST['order_product_id']);
    $order_code = mysqli_real_escape_string($mysqli, $a . $b);
    $order_qty = mysqli_real_escape_string($mysqli, $_POST['order_qty']);
    $order_date = mysqli_real_escape_string($mysqli, date('d M Y'));
    $order_status  = mysqli_real_escape_string($mysqli, $_POST['order_status']);
    $order_payment_status = mysqli_real_escape_string($mysqli, 'Pending');
    $order_estimated_delivery_date = mysqli_real_escape_string($mysqli, $_POST['order_estimated_delivery_date']);

    $product_sql = mysqli_query(
        $mysqli,
        "SELECT * FROM products WHERE product_delete_status = '0' AND product_id = '{$order_product_id}'"
    );
    if (mysqli_num_rows($product_sql) > 0) {
        while ($product = mysqli_fetch_array($product_sql)) {
            /* Get Product Price Based On Product ID Posted From The Form */
            $order_cost = mysqli_real_escape_string($mysqli, ($product['product_price'] * $order_qty));
            /* Deduct Products From Stock */
            $new_product_qty = $product['product_qty_in_stock'] - $order_qty;

            /* Update Product Stock */
            $update_sql = "UPDATE products SET product_qty_in_stock ='{$new_product_qty}' WHERE product_id = '{$order_product_id}'";

            /* Persist */
            $sql = "INSERT INTO orders (order_user_id, order_product_id, order_code, order_date, order_cost, order_status, order_qty,  order_payment_status, order_estimated_delivery_date) VALUES(
            '{$order_user_id}', '{$order_product_id}', '{$order_code}', '{$order_date}', '{$order_cost}', '{$order_status}', '{$order_qty}', '{$order_payment_status}', '{$order_estimated_delivery_date}')";

            if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $update_sql)) {
                $success = "Order $order_code Added";
            } else {
                $err = "Failed, try again";
            }
        }
    }
}

/* Update Orders */
if (isset($_POST['Update_Order'])) {
    $order_code = mysqli_real_escape_string($mysqli, $_POST['order_code']);
    $order_cost  = mysqli_real_escape_string($mysqli, $_POST['order_cost']);
    $order_estimated_delivery_date = mysqli_real_escape_string($mysqli, $_POST['order_estimated_delivery_date']);

    /* Persist */
    $sql = "UPDATE orders SET order_cost = '{$order_cost}',  order_estimated_delivery_date = '{$order_estimated_delivery_date}'
    WHERE order_code ='{$order_code}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Order Updated";
    } else {
        $err = "Failed, try again";
    }
}

/* Update Order Status */
if (isset($_POST['Update_Order_Status'])) {
    $order_code = mysqli_real_escape_string($mysqli, $_POST['order_code']);
    $order_status = mysqli_real_escape_string($mysqli, $_POST['order_status']);

    /* Persist */
    $sql  = "UPDATE orders SET order_status = '{$order_status}' WHERE order_code = '{$order_code}'";
    if (mysqli_query($mysqli, $sql)) {
        $success = "Order status updated";
    } else {
        $err = "Failed, try gain";
    }
}

/* Delete Order */
if (isset($_POST['Delete_Order'])) {
    $order_code = mysqli_real_escape_string($mysqli, $_POST['order_code']);
    $order_delete_status = mysqli_real_escape_string($mysqli, '1');

    /* Persist */
    $sql = "UPDATE orders SET order_delete_status = '{$order_delete_status}' WHERE order_code = '{$order_code}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Order moved to recycle bin";
    } else {
        $err = "Failed, please try again";
    }
}

/* Add Payment */
if (isset($_POST['Mark_Order_As_Paid'])) {
    /* Add Extra Payment Methods Handlers Here */
    $payment_order_code = mysqli_real_escape_string($mysqli, $_POST['payment_order_code']);
    $payment_amount = mysqli_real_escape_string($mysqli, $_POST['payment_amount']);
    $payment_means_id = mysqli_real_escape_string($mysqli, $_POST['payment_means_id']);
    $payment_ref_code = mysqli_real_escape_string($mysqli, $_POST['payment_ref_code']);

    /* Persist */
    $sql = "INSERT INTO payments (payment_order_code, payment_means_id, payment_amount, payment_ref_code) 
    VALUES('{$payment_order_code}', '{$payment_means_id}', '{$payment_amount}', '$payment_ref_code')";
    $order_sql = "UPDATE orders SET order_payment_status = 'Paid' WHERE order_code = '{$payment_order_code}'";

    if (mysqli_query($mysqli, $sql)  && mysqli_query($mysqli, $order_sql)) {
        $success = "Payment reference $payment_ref_code confirmed";
    } else {
        $err = "Failed, please try again";
    }
}




/* Delete Payment*/
if (isset($_POST['Delete_Payment'])) {
    $payment_id = mysqli_real_escape_string($mysqli, $_POST['payment_id']);
    $order_code = mysqli_real_escape_string($mysqli, $_POST['order_code']);

    /* Persist */
    $sql = "UPDATE payments SET payment_delete_status = '1' WHERE payment_id = '{$payment_id}'";
    $order_sql = "UPDATE orders SET order_payment_status = 'Pending' WHERE order_code = '{$order_code}'";

    if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $order_sql)) {
        $success = "Payment moved to recycle bin";
    } else {
        $err = "Failed, please try again";
    }
}
