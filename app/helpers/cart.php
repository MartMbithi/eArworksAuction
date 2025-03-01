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

$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            /* Add Items To Cart */
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE product_id='" . $_GET["product_id"] . "'");
                $itemArray = array(
                    $productByCode[0]["product_sku_code"] => array(
                        'product_name' => $productByCode[0]["product_name"],
                        'product_sku_code' => $productByCode[0]["product_sku_code"],
                        'quantity' => $_POST["quantity"],
                        'product_price' => ($productByCode[0]["product_price"]),
                        'product_id' => $productByCode[0]["product_id"],
                        'product_image' => $productByCode[0]["product_image"],
                    )
                );
                $success = "Item added to cart";

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["product_sku_code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["product_sku_code"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $success = "Item added to cart";
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $success = "Item added to cart";
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;


        case "remove":
            /* Remove Items From Cart */
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["product_sku_code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
                $success = "Item removed from cart";
            }
            break;
        case "empty":
            /* Empty Cart */
            $success = "Cart cleared";
            unset($_SESSION["cart_item"]);
            break;
    }
}

/* Process Cart Data */
if (isset($_POST['Process_Cart'])) {
    $cart_products = $_SESSION['cart_item'];
    $order_estimated_delivery_date = mysqli_real_escape_string($mysqli, $_POST['order_estimated_delivery_date']);
    $order_user_id = mysqli_real_escape_string($mysqli, $_POST['order_user_id']);
    $order_code = mysqli_real_escape_string($mysqli, $a . $b);
    $order_date = mysqli_real_escape_string($mysqli, date('Y-m-d'));
    $order_status = mysqli_real_escape_string($mysqli, $_POST['order_status']);
    $order_payment_status = mysqli_real_escape_string($mysqli, 'Pending');
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);



    /* Populate Items In the Cart Array  */
    foreach ($cart_products as $cart_products) {
        $order_qty = $cart_products['quantity'];
        $order_product_id = $cart_products['product_id'];
        /* Get Existing Product Details  */
        $sql = "SELECT * FROM  products  WHERE product_id = '{$order_product_id}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $products = mysqli_fetch_assoc($res);

            /* Update Products Count */
            $new_product_qty = $products['product_qty_in_stock'] - $order_qty;
            /* Get Overall Order Cost */
            $total_order_cost = $products['product_price'] * $order_qty;

            /* Persist */
            $update_sql = "UPDATE products SET product_qty_in_stock = '{$new_product_qty}' WHERE product_id = '{$order_product_id}'";
            $order_sql = "INSERT INTO orders (order_user_id, order_product_id,  order_code, order_date, order_qty, order_cost, order_status, order_payment_status, order_estimated_delivery_date)
            VALUES('{$order_user_id}', '{$order_product_id}', '{$order_code}', '{$order_date}', '{$order_qty}', '{$total_order_cost}', '{$order_status}', '{$order_payment_status}', '{$order_estimated_delivery_date}')";


            /* Order Status Mailer */
            include('../app/mailers/order_mailer.php');
            if (mysqli_query($mysqli, $order_sql) &&  mysqli_query($mysqli, $update_sql) && $mail->send()) {
                //$_SESSION['success'] = "Order $order_code submitted";
                header('Location: landing_track_order_details?view=' . $order_code);
                unset($_SESSION["cart_item"]);
                //exit  -This Code Is The One Which Killed My Session;
            } else {
                $err = "Failed, please try again";
            }
        }
    }
}
