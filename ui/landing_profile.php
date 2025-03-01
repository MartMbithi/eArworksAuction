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
require_once('../app/settings/checklogin.php');
checklogin();
require_once('../app/settings/config.php');
require_once('../app/helpers/users.php');
require_once('../app/partials/landing_head.php');
/* Get Details Of Logged In User */
$user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
$user_sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_id = '{$user_id}'");
if (mysqli_num_rows($user_sql) > 0) {
    while ($customer = mysqli_fetch_array($user_sql)) {
?>

        <body class="shop_page">
            <div id="ec-overlay"><span class="loader_img"></span></div>

            <!-- Header start  -->
            <?php require_once('../app/partials/landing_navigation.php'); ?>
            <!-- Header End  -->

            <!-- Ec breadcrumb start -->
            <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row ec_breadcrumb_inner">
                                <div class="col-md-6 col-sm-12">
                                    <h2 class="ec-breadcrumb-title">User Profile</h2>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <!-- ec-breadcrumb-list start -->
                                    <ul class="ec-breadcrumb-list">
                                        <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                        <li class="ec-breadcrumb-item active">Profile</li>
                                    </ul>
                                    <!-- ec-breadcrumb-list end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ec breadcrumb end -->
            <?php
            if ($customer['user_email_status'] == 'Pending') {
                /* Show This Banner If User Has Not Verified Their Email Address */
            ?>
                <div class="footer-offer">
                    <div class="container">
                        <div class="row">
                            <div class="text-center footer-off-msg">
                                <span>Kindly Verify Your Email In Order To Enjoy Our Daily Updates And Offers.</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- User profile section -->
            <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
                <div class="container">
                    <div class="row">
                        <!-- Sidebar Area Start -->
                        <?php require_once('../app/partials/landing_profile_sidebar.php'); ?>
                        <div class="ec-shop-rightside col-lg-9 col-md-12">
                            <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                                <div class="ec-vendor-card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ec-vendor-block-profile">
                                                <div class="ec-vendor-block-img space-bottom-30">
                                                    <div class="ec-vendor-block-bg">
                                                        <a href="#" class="btn btn-lg btn-primary" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal">Update Profile</a>
                                                    </div>
                                                    <div class="ec-vendor-block-detail">
                                                        <?php
                                                        /* Load Default Image If User Has No Profile Photo */
                                                        if ($customer['user_profile_picture'] == '') { ?>
                                                            <img class="v-img" src="../public/uploads/users/no-profile.png" alt="Customer image">
                                                        <?php } else { ?>
                                                            <img class="v-img" src="../public/uploads/users/<?php echo $customer['user_profile_picture']; ?>" alt="Customer image">
                                                        <?php } ?>
                                                        <h5 class="name"><?php echo $customer['user_first_name'] . ' ' . $customer['user_last_name']; ?></h5>
                                                        <p class="text-success">( Loyal Customer Since <?php echo date('d M Y g:ia', strtotime($customer['user_date_joined'])); ?> )</p>
                                                    </div>
                                                    <p>Hello <span><?php echo $customer['user_first_name'] . ' ' . $customer['user_last_name']; ?></span></p>
                                                    <p>From your account you can easily view and track orders. You can manage and change your account information like address, contact information and history of orders.</p>
                                                </div>
                                                <h5>Account Information</h5>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                            <h6>E-mail Address <a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><img src="../public/landing_assets/images/icons/edit.svg" class="svg_img pro_svg" alt="edit" /></a></h6>
                                                            <ul>
                                                                <li><strong>Email : </strong><?php echo $customer['user_email']; ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                            <h6>Contact Number<a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><img src="../public/landing_assets/images/icons/edit.svg" class="svg_img pro_svg" alt="edit" /></a></h6>
                                                            <ul>
                                                                <li><strong>Phone Number : </strong> <?php echo $customer['user_phone_number']; ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="ec-vendor-detail-block ec-vendor-block-address">
                                                            <h6>Default Shipping Address<a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><img src="../public/landing_assets/images/icons/edit.svg" class="svg_img pro_svg" alt="edit" /></a></h6>
                                                            <ul>
                                                                <li>
                                                                    <strong>Address : </strong> <?php echo $customer['user_default_address']; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End User profile section -->

            <!-- Footer Start -->
            <?php require_once('../app/partials/landing_footer.php'); ?>
            <!-- Footer Area End -->

            <!-- Modal -->
            <?php require_once('../app/modals/landing_profile_modal.php'); ?>
            <!-- Modal end -->

            <?php require_once('../app/partials/landing_scripts.php'); ?>

        </body>

        </html>
<?php
    }
} else {
    /* LOad 404 Page */
    include('error_404.php');
} ?>