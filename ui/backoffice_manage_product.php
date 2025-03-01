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
require_once('../app/helpers/artworks.php');
require_once('../app/partials/backoffice_head.php');
/* Load This Page With Variable From GET Function */
$get_id = mysqli_real_escape_string($mysqli, $_GET['view']);
$product_sql = mysqli_query(
    $mysqli,
    "SELECT * FROM products p
    INNER JOIN users u ON u.user_id = p.product_seller_id
    INNER JOIN categories c ON c.category_id = p.product_category_id
    WHERE u.user_delete_status = '0' 
    AND c.category_delete_status = '0'
    AND p.product_delete_status = '0' 
    AND p.product_id = '{$get_id}'"
);
if (mysqli_num_rows($product_sql) > 0) {
    while ($product = mysqli_fetch_array($product_sql)) {
        /* Image Directory */
        if ($product['product_image'] == '') {
            $product_photo_directory = "../public/uploads/products/no_image.png";
        } else {
            $product_photo_directory = "../public/uploads/products/" . $product['product_image'];
        }
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
                                    <h1><?php echo $product['product_name']; ?> </h1>
                                    <p class="breadcrumbs">
                                        <span><a href="dashboard">Home</a></span>
                                        <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_products">Products</a>
                                        <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_products">Manage Products</a>
                                        <span><i class="mdi mdi-chevron-right"></i><?php echo $product['product_sku_code']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="card bg-white profile-content">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-4">
                                        <div class="profile-content-left profile-left-spacing">
                                            <div class="text-center widget-profile px-0 border-0">
                                                <div class="card-img mx-auto rounded-circle">
                                                    <img src="<?php echo $product_photo_directory; ?>" alt="user image">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="py-2 text-dark"><?php echo $product['product_name']; ?></h4>
                                                    <p><?php echo $product['product_sku_code']; ?></p> <br>
                                                    <p>
                                                        In Market From : <?php echo date('d M Y', strtotime($product['product_available_from'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between ">
                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2">Category</h6>
                                                    <p><?php echo $product['category_name']; ?></p>
                                                </div>

                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2">Quantity</h6>
                                                    <p><?php echo $product['product_qty_in_stock']; ?></p>
                                                </div>

                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2">Price</h6>
                                                    <p>Ksh <?php echo number_format($product['product_price'], 2); ?></p>
                                                </div>
                                            </div>

                                            <hr class="w-100">

                                            <div class="contact-info pt-4">
                                                <h5 class="text-dark">Seller Information</h5>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Names</p>
                                                <p><?php echo $product['user_first_name'] . ' ' . $product['user_last_name']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Email Address</p>
                                                <p><?php echo $product['user_email']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Phone Number</p>
                                                <p><?php echo $product['user_phone_number']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Birthday</p>
                                                <p><?php echo date('M, d Y', strtotime($product['user_dob'])); ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Address</p>
                                                <p><?php echo $product['user_default_address']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-8">
                                        <div class="profile-content-right profile-right-spacing py-5">
                                            <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Product Details</button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#profile_settings" type="button" role="tab">Edit Product</button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Cumulative Income</button>
                                                </li>

                                            </ul>
                                            <div class="tab-content px-3 px-xl-5" id="myTabContent">

                                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <?php echo $product['product_details']; ?>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="profile_settings" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body px-4">
                                                                <div class="row mb-2">
                                                                    <div class="col-lg-8">
                                                                        <div class="form-group">
                                                                            <label for="firstName">Product Name</label>
                                                                            <input type="hidden" required class="form-control" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                                            <input type="text" required class="form-control" name="product_name" value="<?php echo $product['product_name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="lastName">Available From</label>
                                                                            <input value="<?php echo date('Y-m-d', strtotime($product['product_available_from'])); ?>" type="date" required class="form-control" name="product_available_from">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="lastName">SKU Code</label>
                                                                            <input type="text" required class="form-control" name="product_sku_code" value="<?php echo $product['product_sku_code']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-4">
                                                                        <label for="email">Product price (Ksh)</label>
                                                                        <input type="number" required class="form-control" name="product_price" value="<?php echo $product['product_price']; ?>">
                                                                    </div>

                                                                    <div class="form-group col-lg-4">
                                                                        <label for="email">Quantity In Stock</label>
                                                                        <input type="number" required class="form-control" name="product_qty_in_stock" value="<?php echo $product['product_qty_in_stock']; ?>">
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-lg-8">
                                                                            <label for="email">Select Product Seller</label>
                                                                            <select type="text" required class="form-control" name="product_seller_id">
                                                                                <option value="<?php echo $product['user_id']; ?>"><?php echo $product['user_first_name'] . ' ' . $product['user_last_name'] . '.  Phone Number: ' . $product['user_phone_number'];; ?></option>
                                                                                <?php
                                                                                /* Fetch Sellers ID And Avoid Replication */
                                                                                $sellers_sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_delete_status = '0'  
                                                                                AND user_id != '{$product['user_id']}' AND user_access_level = 'Customer' ORDER BY user_first_name ASC");
                                                                                if (mysqli_num_rows($sellers_sql) > 0) {
                                                                                    while ($sellers = mysqli_fetch_array($sellers_sql)) {
                                                                                ?>
                                                                                        <option value="<?php echo $sellers['user_id']; ?>"><?php echo $sellers['user_first_name'] . ' ' . $sellers['user_last_name'] . '.  Phone Number: ' . $sellers['user_phone_number']; ?></option>
                                                                                <?php }
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-lg-4">
                                                                            <label for="email">Select Product Category</label>
                                                                            <select type="text" required class="form-control" name="product_category_id">
                                                                                <option value="<?php echo $product['category_id']; ?>"><?php echo $product['category_code'] . ' ' .  $product['category_name']; ?></option>
                                                                                <?php
                                                                                /* Fetch Other Categories */
                                                                                $categories_sql = mysqli_query($mysqli, "SELECT * FROM categories 
                                                                                WHERE category_delete_status = '0' AND category_id != '{$product['category_id']}' ORDER BY category_name ASC");
                                                                                if (mysqli_num_rows($categories_sql) > 0) {
                                                                                    while ($product_categories = mysqli_fetch_array($categories_sql)) {
                                                                                ?>
                                                                                        <option value="<?php echo $product_categories['category_id']; ?>"><?php echo $product_categories['category_code'] . ' ' .  $product_categories['category_name']; ?></option>
                                                                                <?php }
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mb-6">
                                                                        <label for="coverImage" class="col-sm-12 col-lg-12 col-form-label">Product Image</label>
                                                                        <div class="col-sm-12 col-lg-12">
                                                                            <div class="custom-file mb-1">
                                                                                <input type="file" accept=".png, .jpg, .jpeg" name="product_image" class="custom-file-input">
                                                                                <label class="custom-file-label" for="coverImage">
                                                                                    Choose file...
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-12">
                                                                        <label for="email">Product Details</label>
                                                                        <textarea class="form-control" rows="5" required name="product_details"><?php echo $product['product_details']; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer px-4">
                                                                <button type="submit" name="Update_Product" class="btn btn-primary btn-pill">Update Product</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="nav-home" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <h2 class="text-center">
                                                            Overall Income Generated By This Artwork: <br>
                                                            <?php
                                                            /* Compute Sum Of Sales Made By This Artwork */
                                                            $query = "SELECT SUM(payment_amount)  FROM payments p
                                                            INNER JOIN orders o ON o.order_code = p.payment_order_code
                                                            WHERE  p.payment_delete_status = '0'
                                                            AND o.order_product_id = '{$get_id}'
                                                            AND o.order_delete_status = '0'";
                                                            $stmt = $mysqli->prepare($query);
                                                            $stmt->execute();
                                                            $stmt->bind_result($product_income);
                                                            $stmt->fetch();
                                                            $stmt->close();
                                                            echo 'Ksh ' .  number_format($product_income, 2);
                                                            ?>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 p-b-15">
                                    <!-- Recent Order Table -->
                                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                                        <div class="card-header justify-content-between">
                                            <h2>Purchase History</h2>
                                        </div>
                                        <div class="card-body pt-0 pb-5">
                                            <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer Name</th>
                                                        <th class="d-none d-lg-table-cell">Units</th>
                                                        <th class="d-none d-lg-table-cell">Order Date</th>
                                                        <th class="d-none d-lg-table-cell">Order Cost</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    /* Fetch All Orders Made To This Product - Sort Them By Date Added */
                                                    $orders_sql = mysqli_query(
                                                        $mysqli,
                                                        "SELECT * FROM orders o 
                                                        INNER JOIN users u 
                                                        ON u.user_id = o.order_user_id
                                                        WHERE o.order_delete_status = '0'
                                                        AND u.user_delete_status = '0'
                                                        AND o.order_product_id = '{$get_id}'
                                                        ORDER BY order_date ASC"
                                                    );
                                                    if (mysqli_num_rows($orders_sql) > 0) {
                                                        while ($orders = mysqli_fetch_array($orders_sql)) {
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <a class="text-dark" href="backoffice_manage_order?view=<?php echo $orders['order_id']; ?>">
                                                                        <?php echo $orders['order_code']; ?>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a class="text-dark" href="backoffice_manage_customer?view=<?php echo $orders['user_id']; ?>"><?php echo $orders['user_first_name'] . ' ' . $orders['user_last_name']; ?></a>
                                                                </td>
                                                                <td class="d-none d-lg-table-cell"><?php echo $orders['order_qty']; ?> Unit(s)</td>
                                                                <td class="d-none d-lg-table-cell"><?php echo date('M, d Y', strtotime($orders['order_date'])); ?></td>
                                                                <td class="d-none d-lg-table-cell">Ksh <?php echo number_format($orders['order_cost']); ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($orders['order_status'] == 'Placed Orders') { ?>
                                                                        <span class="badge badge-warning">Awaiting Fulfillment</span>
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
                        </div> <!-- End Content -->
                    </div> <!-- End Content Wrapper -->

                    <!-- Footer -->
                    <?php require_once('../app/partials/backoffice_footer.php'); ?>

                </div> <!-- End Page Wrapper -->
            </div>
            <!-- End Wrapper -->

            <?php require_once('../app/partials/backoffice_scripts.php'); ?>

        </body>

        </html>
<?php
    }
} else {
    /* LOad 404 Page */
    include('error_404.php');
} ?>