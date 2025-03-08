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

session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/codeGen.php');
require_once('../app/settings/checklogin.php');
checklogin();
require_once('../app/helpers/analytics.php');
require_once('../app/partials/backoffice_head.php');
?>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

    <!--  WRAPPER  -->
    <div class="wrapper">

        <!-- LEFT MAIN SIDEBAR -->
        <?php require_once('../app/partials/backoffice_sidebar.php'); ?>

        <!--  PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            <!-- Header -->
            <?php require_once('../app/partials/backoffice_header.php'); ?>

            <!-- CONTENT WRAPPER -->
            <div class="ec-content-wrapper">
                <div class="content">
                    <?php
                    /* Only Show This To Admins */
                    if ($user_access_level == 'Administrator') {
                    ?>
                        <!-- Top Statistics -->
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                                <div class="card card-mini dash-card card-1">
                                    <a href="backoffice_manage_customers" class="text-dark">
                                        <div class="card-body">
                                            <h2 class="mb-1"><?php echo $customers; ?></h2>
                                            <p>Customers</p>
                                            <span class="mdi mdi-account-group"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                                <div class="card card-mini dash-card card-2">
                                    <a href="backoffice_manage_staffs" class="text-dark">
                                        <div class="card-body">
                                            <h2 class="mb-1"><?php echo $staffs; ?></h2>
                                            <p>Staffs</p>
                                            <span class="mdi mdi-account-group-outline"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                                <div class="card card-mini dash-card card-3">
                                    <a href="backoffice_manage_products" class="text-dark">
                                        <div class="card-body">
                                            <h2 class="mb-1"><?php echo $products; ?></h2>
                                            <p>Products</p>
                                            <span class="mdi mdi-palette-advanced"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                                <div class="card card-mini dash-card card-4">
                                    <a href="backoffice_manage_payments" class="text-dark">
                                        <div class="card-body">
                                            <h2 class="mb-1">Ksh <?php echo number_format($payments); ?></h2>
                                            <p>Overall Revenue</p>
                                            <span class="mdi mdi-currency-usd"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Orders statistics -->
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-1">
                                <a href="backoffice_manage_bids" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $placed_bids; ?></h2>
                                        <p>Placed Bids</p>
                                        <span class="mdi mdi-gavel"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-1">
                                <a href="backoffice_manage_orders" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $placed_orders; ?></h2>
                                        <p>Placed Orders</p>
                                        <span class="mdi mdi-cart-plus"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-2">
                                <a href="backoffice_manage_orders" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $awaiting_fulfillment; ?></h2>
                                        <p>Awaiting Fulfilment</p>
                                        <span class="mdi mdi-cart-arrow-down"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-3">
                                <a href="backoffice_manage_orders" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $shipped; ?></h2>
                                        <p>Shipped Orders</p>
                                        <span class="mdi mdi-car-limousine"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-4">
                                <a href="backoffice_manage_orders" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $out_for_delivery; ?></h2>
                                        <p>Out For Delivery</p>
                                        <span class="mdi mdi-dolly"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-1">
                                <a href="backoffice_manage_orders" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $delivered; ?></h2>
                                        <p>Delivered Orders</p>
                                        <span class="mdi mdi-package-variant"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-2">
                                <a href="backoffice_manage_orders" class="text-dark">
                                    <div class="card-body">
                                        <h2 class="mb-1"><?php echo $returned; ?></h2>
                                        <p>Returned Orders</p>
                                        <span class="mdi mdi-account-clock"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 p-b-15">
                            <!-- Recent Order Table -->
                            <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                                <div class="card-header justify-content-between">
                                    <h2>Recent Orders</h2>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer Details</th>
                                                <th class="d-none d-lg-table-cell">No Of Products</th>
                                                <th class="d-none d-lg-table-cell">Order Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            /* Fetch All Orders - Sort Them By Date Added */
                                            $orders_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM orders o 
                                                INNER JOIN users u ON u.user_id  = o.order_user_id
                                                INNER JOIN products p 
                                                ON p.product_id = o.order_product_id
                                                WHERE o.order_delete_status = '0'
                                                GROUP BY order_code
                                                ORDER BY order_date ASC
                                                "
                                            );
                                            if (mysqli_num_rows($orders_sql) > 0) {
                                                while ($orders = mysqli_fetch_array($orders_sql)) {

                                                    /* Count Number Of Items In This Order */
                                                    $query = "SELECT COUNT(*)  FROM orders WHERE order_code = '{$orders['order_code']}'";
                                                    $stmt = $mysqli->prepare($query);
                                                    $stmt->execute();
                                                    $stmt->bind_result($items_in_my_order);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a href="backoffice_manage_order?view=<?php echo $orders['order_code']; ?>">
                                                                <?php echo $orders['order_code']; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a class="text-dark" href="backoffice_manage_customer?view=<?php echo $orders['user_id']; ?>">
                                                                Name: <?php echo $orders['user_first_name'] . ' ' . $orders['user_last_name']; ?> <br>
                                                                Contacts: <?php echo $orders['user_phone_number']; ?>
                                                            </a>
                                                        </td>
                                                        <td class="d-none d-lg-table-cell"><?php echo $items_in_my_order; ?> Unit(s)</td>
                                                        <td class="d-none d-lg-table-cell"><?php echo date('M, d Y', strtotime($orders['order_date'])); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($orders['order_status'] == 'Placed Orders') { ?>
                                                                <span class="badge badge-warning">Order Placed</span>
                                                            <?php } else if ($orders['order_status'] == 'Awaiting Fullfilment') { ?>
                                                                <span class="badge badge-warning">Awaiting Fulfillment</span>
                                                            <?php } else if ($orders['order_status'] == 'Shipped') { ?>
                                                                <span class="badge badge-primary">Shipped</span>
                                                            <?php } else if ($orders['order_status'] == 'Out For Delivery') { ?>
                                                                <span class="badge badge-primary">Out For Delivery</span>
                                                            <?php } else if ($orders['order_status'] == 'Delivered') { ?>
                                                                <span class="badge badge-success">Delivered</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger">Cancelled</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else {
                                                /* No Orders To Fetch */ ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <span class="text-dark">There are no current orders posted.</span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-5">
                            <!-- New Customers -->
                            <div class="card ec-cust-card card-table-border-none card-default">
                                <div class="card-header justify-content-between ">
                                    <h2>New Customers</h2>
                                </div>
                                <div class="card-body pt-0 pb-15px">
                                    <table class="table ">
                                        <tbody>
                                            <?php
                                            /* Fetch Top 10 Registered Customers - Sort Them By Date Added */
                                            $users_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM users
                                                WHERE user_access_level = 'Customer'
                                                AND user_delete_status = '0'
                                                ORDER BY user_date_joined DESC
                                                LIMIT 5"
                                            );
                                            if (mysqli_num_rows($users_sql) > 0) {
                                                while ($customers = mysqli_fetch_array($users_sql)) {
                                                    /* Load User Image */
                                                    if ($customers['user_profile_picture'] == '') {
                                                        $image_dir = "../public/uploads/users/no-profile.png";
                                                    } else {
                                                        $image_dir = "../public/uploads/users/" . $customers['user_profile_picture'];
                                                    }
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <div class="media">
                                                                <div class="media-image mr-3 rounded-circle">
                                                                    <a href="backoffice_manage_customer?view=<?php echo $customers['user_id']; ?>">
                                                                        <img class="profile-img rounded-circle w-45" src="<?php echo $image_dir; ?>" alt="customer image">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body align-self-center">
                                                                    <a href="backoffice_manage_customer?view=<?php echo $customers['user_id']; ?>">
                                                                        <h6 class="mt-0 text-dark font-weight-medium">
                                                                            <?php echo $customers['user_first_name'] . ' ' . $customers['user_last_name']; ?>
                                                                        </h6>
                                                                    </a>
                                                                    <small><?php echo $customers['user_email']; ?></small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else
                                            /* No Customers */ {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-image mr-3 rounded-circle">
                                                                <img class="profile-img rounded-circle w-45" src="../public/uploads/users/no-profile.png" alt="customer image">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <h6 class="mt-0 text-dark font-weight-medium">
                                                                    There are currently no registered customers.
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <!-- Top Products -->
                            <div class="card card-default ec-card-top-prod">
                                <div class="card-header justify-content-between">
                                    <h2>Top Orders & Products</h2>
                                </div>
                                <div class="card-body mt-10px mb-10px py-0">
                                    <?php
                                    /* Fetch Products With Top Sales -
                                    Revise This Logic Later
                                    */
                                    $orders_sql = mysqli_query(
                                        $mysqli,
                                        "SELECT * FROM orders o 
                                        INNER JOIN products p 
                                        ON p.product_id = o.order_product_id
                                        WHERE o.order_delete_status = '0'
                                        ORDER BY o.order_qty DESC
                                        LIMIT 5
                                        "
                                    );
                                    if (mysqli_num_rows($orders_sql) > 0) {
                                        while ($top_product = mysqli_fetch_array($orders_sql)) {
                                            /* Load Product Image */
                                            if ($top_product['product_image'] == '') {
                                                $product_image_dir = "../public/uploads/products/no_image.png";
                                            } else {
                                                $product_image_dir = "../public/uploads/products/" . $top_product['product_image'];
                                            }
                                    ?>
                                            <div class="row media d-flex pt-15px pb-15px">
                                                <div class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                                                    <a href="backoffice_manage_product?view=<?php echo $top_product['product_id']; ?>">
                                                        <img src="<?php echo $product_image_dir; ?>" alt="Product Image">
                                                    </a>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                                                    <a href="backoffice_manage_product?view=<?php echo $top_product['product_id']; ?>">
                                                        <h6 class="mb-10px text-dark font-weight-medium">
                                                            <?php echo substr($top_product['product_name'], 0, 30); ?>...
                                                        </h6>
                                                    </a>
                                                    <p class="float-md-right sale">
                                                        <span class="mr-2"><?php echo $top_product['order_qty']; ?></span>Order Items
                                                    </p>
                                                    <p class="mb-0 ec-price">
                                                        <span class="text-dark">Ksh <?php echo number_format($top_product['order_cost']); ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php }
                                    } else { ?>
                                        <div class="row media d-flex pt-15px pb-15px">
                                            <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                                                <a href="#">
                                                    <h6 class="mb-10px text-dark font-weight-medium">
                                                        There are currently no top products or orders.
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Content -->
            </div> <!-- End Content Wrapper -->

            <!-- Footer -->
            <?php require_once('../app/partials/backoffice_footer.php'); ?>

        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->
    <?php require_once('../app/partials/backoffice_scripts.php'); ?>
</body>

</html>