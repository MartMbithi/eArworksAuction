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
require_once('../app/helpers/orders.php');
require_once('../app/partials/backoffice_head.php');
?>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">

    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- LEFT MAIN SIDEBAR -->
        <?php require_once('../app/partials/backoffice_sidebar.php'); ?>


        <!-- PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            <!-- Header -->
            <?php require_once('../app/partials/backoffice_header.php'); ?>

            <!-- CONTENT WRAPPER -->
            <div class="ec-content-wrapper">
                <div class="content">
                    <div class="breadcrumb-wrapper breadcrumb-contacts">
                        <div>
                            <h1>Orders</h1>
                            <p class="breadcrumbs">
                                <span><a href="dashboard">Home</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_orders">Orders</a>
                                <span><i class="mdi mdi-chevron-right"></i></span>Manage Orders
                            </p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                                Register Order
                            </button>
                        </div>
                    </div>

                    <!-- Add User Modal  -->
                    <div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal-header px-4">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Register New Order</h5>
                                    </div>

                                    <div class="modal-body px-4">
                                        <div class="row mb-2">
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <label for="email">Select Customer</label>
                                                    <select type="text" required class="form-control" name="order_user_id">
                                                        <?php
                                                        $customer_sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_delete_status = '0' 
                                                        AND user_access_level = 'Customer' ORDER BY user_first_name ASC");
                                                        if (mysqli_num_rows($customer_sql) > 0) {
                                                            while ($customers = mysqli_fetch_array($customer_sql)) {
                                                        ?>
                                                                <option value="<?php echo $customers['user_id']; ?>"><?php echo $customers['user_first_name'] . ' ' . $customers['user_last_name'] . '.  Phone Number: ' . $customers['user_phone_number']; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-8">
                                                    <label for="email">Select Product</label>
                                                    <select type="text" required class="form-control" name="order_product_id">
                                                        <option>Select Product</option>
                                                        <?php
                                                        $products_sql = mysqli_query($mysqli, "SELECT * FROM products WHERE product_delete_status = '0'");
                                                        if (mysqli_num_rows($products_sql) > 0) {
                                                            while ($products = mysqli_fetch_array($products_sql)) {
                                                        ?>
                                                                <option value="<?php echo $products['product_id']; ?>"><?php echo $products['product_name']; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="firstName">Order Qty</label>
                                                        <input type="number" required class="form-control" name="order_qty">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="lastName">Order Status</label>
                                                    <select type="text" required class="form-control" name="order_status">
                                                        <option value="Placed Orders">Order Placed</option>
                                                        <option>Awaiting Fullfilment</option>
                                                        <option>Shipped</option>
                                                        <option>Out For Delivery</option>
                                                        <option>Delivered</option>
                                                        <option>Returned</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="email">Estimated Delivery Date</label>
                                                <input type="date" required class="form-control" name="order_estimated_delivery_date">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer px-4">
                                        <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="Add_Order" class="btn btn-primary btn-pill">Register Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="ec-vendor-list card card-default">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="responsive-data-table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order Code</th>
                                                    <th>Customer Details</th>
                                                    <th>Order Items</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
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
                                                    GROUP BY o.order_code"
                                                );
                                                if (mysqli_num_rows($orders_sql) > 0) {
                                                    while ($orders = mysqli_fetch_array($orders_sql)) {
                                                        /* Image Directory */
                                                        if ($orders['product_image'] == '') {
                                                            $image_dir = "../public/uploads/products/no_image.png";
                                                        } else {
                                                            $image_dir = "../public/uploads/products/" . $orders['product_image'];
                                                        }

                                                        /* Count Number Of Items In Order */
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
                                                                Name: <?php echo $orders['user_first_name'] . ' ' . $orders['user_last_name']; ?><br>
                                                                Phone: <?php echo $orders['user_phone_number']; ?>
                                                            </td>
                                                            <td><?php echo $items_in_my_order; ?> Items</td>
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
                                                            <td>
                                                                <div class="btn-group mb-1">
                                                                    <button type="button" class="btn btn-outline-success">Manage</button>
                                                                    <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                        <span class="sr-only">Manage</span>
                                                                    </button>

                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="backoffice_manage_order?view=<?php echo $orders['order_code']; ?>">View</a>
                                                                        <a class="dropdown-item" href="backoffice_generate_delivery_note?view=<?php echo $orders['order_code']; ?>">Generate Delivery Note</a>
                                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#update_order_status<?php echo $orders['order_code']; ?>">Update Status</a>
                                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#update_order_<?php echo $orders['order_code']; ?>">Edit</a>
                                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#delete_order_<?php echo $orders['order_code']; ?>">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- Delete Staff Modal -->
                                                        <?php include('../app/modals/manage_order.php'); ?>
                                                        <!-- End Modal -->
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
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