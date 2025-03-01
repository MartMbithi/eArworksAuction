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
                            <h1>System Recycle Bin</h1>
                            <p class="breadcrumbs">
                                <span><a href="dashboard">Home</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span>Recycle Bin
                            </p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#empty">
                                Purge Recycle Bin Cache
                            </button>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="empty" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM RECYCLE BIN PURGE</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body text-center ">
                                        <h4 class="text-danger">
                                            Heads Up!, You are about to purge everything in recycle bin. Are you sure you want to proceed?
                                        </h4>
                                        <br>
                                        <!-- Hide This -->
                                        <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="text-center btn btn-danger" name="Purge_Everything">Yes, Purge Eveything</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <div class="product-brand p-24px">
                        <div class="row mb-m-24px">

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_staff">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/man.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Staffs</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_staffs; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_customers">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/man.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Customers</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_customers; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_categories">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/categories.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Categories</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_categories; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_products">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/painting.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Products</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_products; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_order">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/order.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Orders</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_orders; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_means">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/debit-card_2.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Payment Means</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_payment_means; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                                <a href="backoffice_deleted_payments">
                                    <div class="card card-default">
                                        <div class="card-body text-center p-24px">
                                            <div class="image mb-3">
                                                <img src="../public/backoffice_assets/img/debit-card.png" class="img-fluid rounded-circle" alt="Avatar Image">
                                            </div>
                                            <h5 class="card-title text-dark">Payments</h5>
                                            <p class="item-count">
                                                <button class="btn btn-primary btn-sm"><?php echo $deleted_payments; ?></button>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
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