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
require_once('../app/helpers/system_settings.php');
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
                            <h1>Deleted Payment Means</h1>
                            <p class="breadcrumbs">
                                <span><a href="dashboard">Home</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_categories">Recycle Bin</a>
                                <span><i class="mdi mdi-chevron-right"></i></span>Payment Means
                            </p>
                        </div>
                    </div>

                    <div class="product-brand p-24px">
                        <div class="row mb-m-24px">
                            <?php
                            /* Pop All Registered API`S */
                            $payment_means = mysqli_query($mysqli, "SELECT * FROM payment_means WHERE means_delete_status != '0' ");
                            if (mysqli_num_rows($payment_means) > 0) {
                                while ($payments = mysqli_fetch_array($payment_means)) {
                            ?>

                                    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                        <div class="card card-default">
                                            <div class="card-body text-center p-24px">
                                                <div class="image mb-3">
                                                    <img src="../public/backoffice_assets/img/debit-card.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                                </div>
                                                <h5 class="card-title text-dark"><?php echo $payments['means_name']; ?></h5>
                                                <p class="item-count">
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#restore_<?php echo $payments['means_id']; ?>">Restore</button>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $payments['means_id']; ?>">Delete</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    /* API Managment Modals */
                                    include('../app/modals/payment_means_recycle_bin.php');
                                }
                            } else { ?>
                                <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/error.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>

                                            <h5 class="card-title text-dark">No Deleted Payments Methods Found</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div> <!-- End Content Wrapper -->

                <!-- Footer -->
                <?php require_once('../app/partials/backoffice_footer.php'); ?>

            </div> <!-- End Page Wrapper -->
        </div> <!-- End Wrapper -->

        <?php require_once('../app/partials/backoffice_scripts.php'); ?>
</body>

</html>