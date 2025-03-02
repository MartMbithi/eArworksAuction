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
require_once('../app/helpers/users.php');
require_once('../app/partials/backoffice_head.php');
/* Load This Page With Variable From GET Function */
$get_id = mysqli_real_escape_string($mysqli, $_GET['view']);
$customer_sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_id = '{$get_id}'");
if (mysqli_num_rows($customer_sql) > 0) {
    while ($customer = mysqli_fetch_array($customer_sql)) {
        /* Image Directory */
        if ($customer['user_profile_picture'] == '') {
            $profile_photo_directory = "../public/uploads/users/no-profile.png";
        } else {
            $profile_photo_directory = "../public/uploads/users/" . $customer['user_profile_picture'];
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
                                    <h1><?php echo $customer['user_access_level']; ?> Profile</h1>
                                    <p class="breadcrumbs">
                                        <span><a href="dashboard">Home</a></span>
                                        <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_customers">Sellers</a>
                                        <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_customers">Manage Sellers</a>
                                        <span><i class="mdi mdi-chevron-right"></i><?php echo $customer['user_first_name'] . ' ' . $customer['user_last_name']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="card bg-white profile-content">
                                <div class="row">
                                    <div class="col-lg-4 col-xl-3">
                                        <div class="profile-content-left profile-left-spacing">
                                            <div class="text-center widget-profile px-0 border-0">
                                                <div class="card-img mx-auto rounded-circle">
                                                    <img src="<?php echo $profile_photo_directory; ?>" alt="user image">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="py-2 text-dark"><?php echo $customer['user_first_name'] . ' ' . $customer['user_last_name']; ?></h4>
                                                    <p><?php echo $customer['user_access_level']; ?></p>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between ">
                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2"></h6>
                                                    <p></p>
                                                </div>

                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2"></h6>
                                                    <p></p>
                                                </div>

                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2"></h6>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <hr class="w-100">

                                            <div class="contact-info pt-4">
                                                <h5 class="text-dark">Contact Information</h5>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Email address</p>
                                                <p><?php echo $customer['user_email']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Phone Number</p>
                                                <p><?php echo $customer['user_phone_number']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Birthday</p>
                                                <p><?php echo date('M, d Y', strtotime($customer['user_dob'])); ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Address</p>
                                                <p><?php echo $customer['user_default_address']; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-xl-9">
                                        <div class="profile-content-right profile-right-spacing py-5">
                                            <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Edit Profile</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#profile_settings" type="button" role="tab">Change Password</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content px-3 px-xl-5" id="myTabContent">

                                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="firstName">First name</label>
                                                                        <input type="text" required value="<?php echo $customer['user_first_name']; ?>" class="form-control" name="user_first_name">
                                                                        <input type="hidden" required value="<?php echo $customer['user_id']; ?>" class="form-control" name="user_id">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="lastName">Last name</label>
                                                                        <input type="text" required value="<?php echo $customer['user_last_name']; ?>" class="form-control" name="user_last_name">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-lg-12">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" required value="<?php echo $customer['user_email']; ?>" class="form-control" name="user_email">
                                                                </div>

                                                                <div class="form-group col-lg-8">
                                                                    <label for="email">Phone Number</label>
                                                                    <input type="tel" minlength="12" maxlength="12" required value="<?php echo $customer['user_phone_number']; ?>" class="form-control" name="user_phone_number">
                                                                </div>

                                                                <div class="form-group col-lg-4">
                                                                    <label for="email">Date Of Birth</label>
                                                                    <input type="date" required value="<?php echo $customer['user_dob']; ?>" class="form-control" name="user_dob">
                                                                </div>

                                                                <div class="form-group col-lg-12">
                                                                    <label for="email">Address</label>
                                                                    <textarea class="form-control" required name="user_default_address"><?php echo $customer['user_default_address']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group row mb-6">
                                                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Profile Photo</label>
                                                                <div class="col-sm-8 col-lg-10">
                                                                    <div class="custom-file mb-1">
                                                                        <input type="file" accept=".png, .jpg" name="user_profile_picture" class="custom-file-input">
                                                                        <label class="custom-file-label" for="coverImage">
                                                                            Choose file...
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-5">
                                                                <button type="submit" name="Update_Customer_Profile" class="btn btn-primary mb-2 btn-pill">
                                                                    Update Profile
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="profile_settings" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <form method="post" autocomplete="off" enctype="multipart/form-data">
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="firstName">New Password</label>
                                                                        <input type="password" required class="form-control" name="new_password">
                                                                        <input type="hidden" required value="<?php echo $customer['user_id']; ?>" class="form-control" name="user_id">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="lastName">Confirm Password</label>
                                                                        <input type="password" required class="form-control" name="confirm_password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-5">
                                                                <button type="submit" name="Update_Staff_Password" class="btn btn-primary mb-2 btn-pill">
                                                                    Update Password
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="ec-vendor-list card card-default">
                                        <div class="card-header justify-content-between">
                                            <h2>Products Selling</h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="responsive-data-table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>SKU</th>
                                                            <th>Name</th>
                                                            <th>QTY</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $products_sql = mysqli_query(
                                                            $mysqli,
                                                            "SELECT * FROM products p
                                                            INNER JOIN users u ON u.user_id = p.product_seller_id
                                                            INNER JOIN categories c ON c.category_id = p.product_category_id
                                                            WHERE u.user_delete_status = '0' 
                                                            AND c.category_delete_status = '0'
                                                            AND p.product_delete_status = '0'
                                                            AND p.product_seller_id = '{$get_id}'"
                                                        );
                                                        if (mysqli_num_rows($products_sql) > 0) {
                                                            while ($products = mysqli_fetch_array($products_sql)) {
                                                                /* Image Directory */
                                                                if ($products['product_image'] == '') {
                                                                    $image_dir = "../public/uploads/products/no_image.png";
                                                                } else {
                                                                    $image_dir = "../public/uploads/products/" . $products['product_image'];
                                                                }
                                                        ?>
                                                                <tr>
                                                                    <td><img class="vendor-thumb" src="<?php echo $image_dir; ?>" alt="Product" /></td>
                                                                    <td><?php echo $products['product_sku_code']; ?></td>
                                                                    <td><?php echo $products['product_name']; ?></td>
                                                                    <td><?php echo $products['product_qty_in_stock']; ?></td>
                                                                    <td>Ksh <?php echo number_format($products['product_price'], 2); ?></td>
                                                                    <td>
                                                                        <div class="btn-group mb-1">
                                                                            <button type="button" class="btn btn-outline-success">Manage</button>
                                                                            <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                                <span class="sr-only">Manage</span>
                                                                            </button>

                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item" href="backoffice_manage_product?view=<?php echo $products['product_id']; ?>">View</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
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