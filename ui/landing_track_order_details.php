<?php
/*
 *   Crafted On Sat Mar 08 2025
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

session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
require_once('../app/settings/codeGen.php');
require_once('../app/settings/fluttterwave_api_configs.php');
checklogin();
require_once('../app/helpers/payments.php');
require_once('../app/partials/landing_head.php');
?>

<body class="track_order_page">
    <div id="ec-overlay"><span class="loader_img"></span></div>

    <!-- Header start  -->
    <?php require_once('../app/partials/landing_navigation.php');
    $view = mysqli_real_escape_string($mysqli, $_GET['view']);
    /* Pull Recent Purchases Made By This User */
    $order_user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $orders_sql = mysqli_query(
        $mysqli,
        "SELECT * FROM orders o  
        INNER JOIN products p ON p.product_id = o.order_product_id
        INNER JOIN users u ON u.user_id = o.order_user_id
        INNER JOIN categories c ON c.category_id = p.product_category_id
        WHERE u.user_delete_status = '0' 
        AND c.category_delete_status = '0'
        AND p.product_delete_status = '0'
        AND o.order_delete_status = '0'
        AND o.order_bid_id  = '{$view}'"
    );
    if (mysqli_num_rows($orders_sql) > 0) {
        while ($orders = mysqli_fetch_array($orders_sql)) {
            $order_code = $orders['order_code'];
    ?>
            <!-- Header End  -->

            <!-- Ec breadcrumb start -->
            <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row ec_breadcrumb_inner">
                                <div class="col-md-6 col-sm-12">
                                    <h2 class="ec-breadcrumb-title">Track Order</h2>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <!-- ec-breadcrumb-list start -->
                                    <ul class="ec-breadcrumb-list">
                                        <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                        <li class="ec-breadcrumb-item"><a href="landing_track_order">Orders</a></li>
                                        <li class="ec-breadcrumb-item active">Track</li>
                                    </ul>
                                    <!-- ec-breadcrumb-list end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ec breadcrumb end -->

            <!-- Ec Track Order section -->
            <section class="ec-page-content section-space-p">
                <div class="container">
                    <!-- Track Order Content Start -->
                    <div class="ec-trackorder-content col-md-12">
                        <div class="ec-trackorder-inner">
                            <div class="ec-trackorder-top">
                                <h2 class="ec-order-id">Order #<?php echo $orders['order_code']; ?></h2>
                                <div class="ec-order-detail">
                                    <div>Expected arrival date: <?php echo date('d M Y', strtotime($orders['order_estimated_delivery_date'])); ?></div>
                                </div>
                            </div>
                            <div class="ec-trackorder-bottom">
                                <div class="ec-progress-track">
                                    <ul id="ec-progressbar">
                                        <?php
                                        if ($orders['order_status'] == 'Placed Orders') { ?>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_1.png" alt="track_order">
                                                </span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>processing
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_2.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Awaiting <br>Fullfilment</span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_3.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>shipped
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_4.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Out For <br> Delivery
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_5.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>arrived
                                                </span>
                                            </li>
                                        <?php } else if ($orders['order_status'] == 'Awaiting Fullfilment') { ?>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_1.png" alt="track_order">
                                                </span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>processing
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_2.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Awaiting <br>Fullfilment</span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_3.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>shipped
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_4.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Out For <br> Delivery
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_5.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>arrived
                                                </span>
                                            </li>
                                        <?php } else if ($orders['order_status'] == 'Shipped') { ?>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_1.png" alt="track_order">
                                                </span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>processing
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_2.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Awaiting <br>Fullfilment</span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_3.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>shipped
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_4.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Out For <br> Delivery
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_5.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>arrived
                                                </span>
                                            </li>
                                        <?php } else if ($orders['order_status'] == 'Out For Delivery') { ?>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_1.png" alt="track_order">
                                                </span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>processing
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_2.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Awaiting <br>Fullfilment</span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_3.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>shipped
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_4.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Out For <br> Delivery
                                                </span>
                                            </li>
                                            <li class="step0">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_5.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>arrived
                                                </span>
                                            </li>
                                        <?php } else if ($orders['order_status'] == 'Delivered') { ?>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_1.png" alt="track_order">
                                                </span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>processing
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_2.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Awaiting <br>Fullfilment</span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_3.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br>shipped
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_4.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    Out For <br> Delivery
                                                </span>
                                            </li>
                                            <li class="step0 active">
                                                <span class="ec-track-icon">
                                                    <img src="../public/landing_assets/images/icons/track_5.png" alt="track_order"></span>
                                                <span class="ec-progressbar-track"></span>
                                                <span class="ec-track-title">
                                                    order <br> Delivered
                                                </span>
                                            </li>
                                        <?php } else if ($orders['order_status'] == 'Cancelled') { ?>
                                            <h4 class="text-center text-danger">This order has been Cancelled.</h4>
                                        <?php } else { ?>
                                            <h4 class="text-center text-danger">We are unable to track this order.</h4>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="ec-vendor-card-header text-center">
                                <h5>Items In This Order</h5>
                            </div>
                            <br>
                            <div class="ec-vendor-card-body">
                                <div class="ec-vendor-card-table">
                                    <table class="table ec-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Item SKU</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Item QTY</th>
                                                <th scope="col">Item Bid Cost</th>
                                                <th scope="col">Total Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_quantity = 0;
                                            $total_price = 0;
                                            /* Pull Recent Purchases Made By This User */
                                            $order_user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
                                            $items_orders_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM orders o  
                                                INNER JOIN products p ON p.product_id = o.order_product_id
                                                INNER JOIN users u ON u.user_id = o.order_user_id
                                                INNER JOIN categories c ON c.category_id = p.product_category_id
                                                WHERE u.user_delete_status = '0' 
                                                AND c.category_delete_status = '0'
                                                AND p.product_delete_status = '0'
                                                AND o.order_delete_status = '0'
                                                AND u.user_id = '{$order_user_id}'
                                                AND o.order_bid_id = '{$view}'
                                                "
                                            );
                                            if (mysqli_num_rows($items_orders_sql) > 0) {
                                                while ($item_order = mysqli_fetch_array($items_orders_sql)) {

                                                    /* Compute Quantity And Amount Supposed To Be Paid */
                                                    $total_quantity += $item_order["order_qty"];
                                                    $total_price += $item_order['order_cost'];
                                                    /* DeliverY Fee */

                                                    $constant_delivery_fee = '500';
                                                    $payment_status = $item_order['order_payment_status'];
                                                    $user_name = $item_order['user_first_name'] . ' ' . $item_order['user_last_name'];
                                                    $user_contacts = $item_order['user_phone_number'];


                                                    /* Push Variables To Global Variable */
                                                    global $payment_status, $user_name, $user_contacts;


                                            ?>
                                                    <tr>
                                                        <td><span><?php echo $item_order['product_sku_code']; ?></span></td>
                                                        <td><span><?php echo $item_order['product_name']; ?></span></td>
                                                        <td><span><?php echo $item_order['order_qty']; ?></span></td>
                                                        <td><span>Ksh <?php echo number_format($item_order['order_cost'], 2); ?></span></td>
                                                        <td><span>Ksh <?php echo number_format($item_order['order_cost'], 2); ?></span></td>
                                                    </tr>

                                                <?php  } ?>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name">
                                                        <b>Sub Total Payable Amount</b>
                                                    </td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format($total_price, 2); ?></td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name">
                                                        <b>Delivery Fee</b>
                                                    </td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format($constant_delivery_fee, 2); ?></td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name">
                                                        <b>Total Payable Amount</b>
                                                    </td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format(($total_price + $constant_delivery_fee), 2); ?></td>
                                                </tr>
                                                <?php
                                                if ($payment_status == 'Pending') {
                                                ?>
                                                    <tr>
                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                        </td>
                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                        <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                        <td data-label="Total" class="ec-cart-pro-subtotal">
                                                            <span class="tbl-btn"><button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#checkout_modal_<?php echo $order_code; ?>">Add Payment</button></span>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                /* Include Payments Modal */
                                                include('../app/modals/payment_modal.php');
                                            } else { ?>
                                                <tr>
                                                    <th scope="row">No Items In Your Order</th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="ec-vendor-card-header text-center">
                                <h5>Order Payment Details</h5>
                            </div>
                            <br>
                            <div class="ec-vendor-card-body">
                                <div class="ec-vendor-card-table">
                                    <table class="table ec-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Payment Ref</th>
                                                <th scope="col">Payment Means</th>
                                                <th scope="col">Payment Amount</th>
                                                <th scope="col">Payment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $payment_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM payments p
                                                INNER JOIN payment_means pm ON pm.means_id = p.payment_means_id
                                                WHERE p.payment_order_code = '{$order_code}' AND p.payment_delete_status = '0'"
                                            );
                                            if (mysqli_num_rows($payment_sql) > 0) {
                                                while ($payment = mysqli_fetch_array($payment_sql)) {
                                            ?>
                                                    <tr>
                                                        <td><span><?php echo $payment['payment_ref_code']; ?></span></td>
                                                        <td><span><?php echo $payment['means_code'] . ' ' . $payment['means_name']; ?></span></td>
                                                        <td><span>Ksh <?php echo number_format($payment['payment_amount'], 2); ?></span></td>
                                                        <td><span> <?php echo date('d M Y g:ia', strtotime($payment['payment_date'])); ?></span></td>
                                                    </tr>
                                                <?php  }
                                            } else { ?>
                                                <tr>
                                                    <th scope="row">We Can't Find Any Payment Records Related To This Order</th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Track Order Content end -->
                </div>
            </section>
            <!-- End Track Order section -->
    <?php }
    } ?>

    <!-- Footer Start -->
    <?php require_once('../app/partials/landing_footer.php'); ?>

    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <?php require_once('../app/partials/landing_scripts.php'); ?>

</body>


</html>