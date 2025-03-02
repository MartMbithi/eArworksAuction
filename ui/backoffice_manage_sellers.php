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
                            <h1>Sellers</h1>
                            <p class="breadcrumbs">
                                <span><a href="dashboard">Home</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_sellers">Sellers</a>
                                <span><i class="mdi mdi-chevron-right"></i></span>Manage Sellers
                            </p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                                Register Seller
                            </button>
                        </div>
                    </div>

                    <!-- Add User Modal  -->
                    <div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal-header px-4">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Register New Seller</h5>
                                    </div>

                                    <div class="modal-body px-4">
                                        <div class="row mb-2">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">First name</label>
                                                    <input type="hidden" value="Seller" required class="form-control" name="user_access_level">
                                                    <input type="text" required class="form-control" name="user_first_name">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="lastName">Last name</label>
                                                    <input type="text" required class="form-control" name="user_last_name">
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="email">Email</label>
                                                <input type="email" required class="form-control" name="user_email">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="email">Default Password </label>
                                                <input type="text" value="Demo@123" required class="form-control" name="user_email">
                                            </div>

                                            <div class="form-group col-lg-8">
                                                <label for="email">Phone Number</label>
                                                <input type="tel" placeholder="2547123456789" minlength="12" maxlength="12" required class="form-control" name="user_phone_number">
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="email">Date Of Birth</label>
                                                <input type="date" required class="form-control" name="user_dob">
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="email">Address</label>
                                                <textarea class="form-control" required name="user_default_address"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row mb-6">
                                            <label for="coverImage" class="col-sm-12 col-lg-12 col-form-label">Profile Photo</label>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="custom-file mb-1">
                                                    <input type="file" accept=".png, .jpg, .jpeg" name="user_profile_picture" class="custom-file-input">
                                                    <label class="custom-file-label" for="coverImage">
                                                        Choose file...
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer px-4">
                                        <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="Register_New_Customer" class="btn btn-primary btn-pill">Register Customer</button>
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
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>DOB</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $user_sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level = 'Seller'");
                                                if (mysqli_num_rows($user_sql) > 0) {
                                                    while ($customers = mysqli_fetch_array($user_sql)) {
                                                        /* Image Directory */
                                                        if ($customers['user_profile_picture'] == '') {
                                                            $image_dir = "../public/uploads/users/no-profile.png";
                                                        } else {
                                                            $image_dir = "../public/uploads/users/" . $customers['user_profile_picture'];
                                                        }
                                                ?>
                                                        <tr>
                                                            <td><img class="vendor-thumb" src="<?php echo $image_dir; ?>" alt="user profile" /></td>
                                                            <td><?php echo $customers['user_first_name'] . ' ' . $customers['user_last_name']; ?></td>
                                                            <td><?php echo $customers['user_email']; ?></td>
                                                            <td><?php echo $customers['user_phone_number']; ?></td>
                                                            <td><?php echo date('M d Y', strtotime($customers['user_dob'])); ?></td>
                                                            <td><?php echo $customers['user_account_status']; ?></td>
                                                            <td>
                                                                <div class="btn-group mb-1">
                                                                    <button type="button" class="btn btn-outline-success">Manage</button>
                                                                    <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                        <span class="sr-only">Manage</span>
                                                                    </button>

                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="backoffice_manage_seller?view=<?php echo $customers['user_id']; ?>">View</a>
                                                                        <?php if ($customers['user_account_status'] != 'Active') { ?>
                                                                            <a class="dropdown-item" data-bs-toggle="modal" href="#verify_<?php echo $customers['user_id']; ?>">Verify Account</a>
                                                                        <?php } ?>
                                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#delete_staff_<?php echo $customers['user_id']; ?>">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- Delete Staff Modal -->
                                                        <?php include('../app/modals/delete_customer.php'); ?>
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