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

/* Add Payment */
if (isset($_POST['Add_Payment'])) {
    /* Add Extra Payment Methods Handlers Here */
    $payment_method_name = mysqli_real_escape_string($mysqli, $_POST['payment_method_name']);
    $payment_order_code = mysqli_real_escape_string($mysqli, $_POST['payment_order_code']);
    $payment_means_id = mysqli_real_escape_string($mysqli, $_POST['payment_means_id']);
    $payment_amount = mysqli_real_escape_string($mysqli, $_POST['payment_amount']);
    $payment_ref_code = mysqli_real_escape_string($mysqli, $_POST['payment_ref_code']);
    $order_payment_status = mysqli_real_escape_string($mysqli, 'Paid');
    $user_email = mysqli_real_escape_string($mysqli, $_SESSION['user_email']);
    $user_contacts = mysqli_real_escape_string($mysqli, $_POST['user_contacts']);
    $user_name = mysqli_real_escape_string($mysqli, $_POST['user_name']);
    /* Handle Cash On Delivery Payment Method */
    if ($payment_method_name == 'Cash On Delivery') {

        /* Persist */
        $sql = "INSERT INTO payments (payment_order_code, payment_means_id, payment_amount, payment_ref_code) 
        VALUES('{$payment_order_code}', '{$payment_means_id}', '{$payment_amount}', '$payment_ref_code')";

        $order_status = "UPDATE orders SET order_payment_status = '{$order_payment_status}' WHERE order_code = '{$payment_order_code}'";

        if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $order_status)) {
            $success = "Payment reference $payment_ref_code confirmed";
        } else {
            $err = "Failed, please try again";
        }
    } else if ($payment_method_name == 'Debit / Credit Card' || $payment_method_name == 'Mobile Payment') {
        /* Process Flutterwave Payment API */
        $request = [
            'tx_ref' => time(), /* Just Timestamp Every Transaction */
            'amount' => $payment_amount,
            'currency' => 'KES',
            'payment_options' => 'card',
            /* Update This URL To Match Your Needs */
            'redirect_url' => 'http://127.0.0.1/eArworksAuction/ui/payment_response?order=' . $payment_order_code . '&means=' . $payment_means_id,
            'customer' => [
                'email' => $user_email,
                'name' => $user_name,
            ],
            'meta' => [
                'price' => $payment_amount
            ],
            'customizations' => [
                'title' => 'Order ' . ' ' . $payment_order_code . ' Payment',
                'description' => $user_name . 'Order Payment'
            ]
        ];

        /* Call Flutterwave Endpoint */
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $flutterwave_keys, /* To Do : Never hard code this bearer */
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);
        if ($res->status == 'success') {
            $link = $res->data->link;
            header('Location: ' . $link);
        } else {
            //$err =  'We can not process your payment';
            /* Show Me Exact Error Message */
            $err = $res->message;
        }
    } else {
        $err = "Payment means is not supported yet";
    }
}
