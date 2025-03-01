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
require_once('../app/helpers/lite_cms.php');
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
                            <h1>About eArtworks</h1>
                            <p class="breadcrumbs">
                                <span><a href="dashboard">Home</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_cms_about">LiteCms</a>
                                <span><i class="mdi mdi-chevron-right"></i></span>Manage About
                            </p>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="ec-vendor-list card card-default">
                                <div class="card-body">
                                    <?php
                                    $litecms_sql = mysqli_query($mysqli, "SELECT * FROM system_litecms");
                                    if (mysqli_num_rows($litecms_sql) > 0) {
                                        while ($contacts = mysqli_fetch_array($litecms_sql)) { ?>
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="modal-body px-4">
                                                    <div class="row mb-2">
                                                        <div class="form-group col-lg-6">
                                                            <label for="firstName">Contacts</label>
                                                            <input type="text" required class="form-control" name="system_contact" value="<?php echo $contacts['system_contact']; ?>">
                                                        </div>
                                                        <div class=" form-group col-lg-6">
                                                            <label for="firstName">Email Address</label>
                                                            <input type="text" required class="form-control" name="system_email" value="<?php echo $contacts['system_email']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-3">
                                                            <label for="firstName">Facebook Page</label>
                                                            <input type="text" required class="form-control" name="system_facebook_url" value="<?php echo $contacts['system_facebook_url']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-3">
                                                            <label for="firstName">Twitter Handle</label>
                                                            <input type="text" required class="form-control" name="system_twittwer_url" value="<?php echo $contacts['system_twittwer_url']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-3">
                                                            <label for="firstName">Instagram Handle</label>
                                                            <input type="text" required class="form-control" name="system_instagram_url" value="<?php echo $contacts['system_instagram_url']; ?>">
                                                        </div>
                                                        <div class=" form-group col-lg-3">
                                                            <label for="firstName">LinkedIn</label>
                                                            <input type="text" required class="form-control" name="system_linkedin_url" value="<?php echo $contacts['system_linkedin_url']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-12">
                                                            <label for="email">Address eArtworks</label>
                                                            <textarea class="form-control" id="editor" required name="system_address"><?php echo $contacts['system_address']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer px-4">
                                                    <button type="submit" name="Contact_Us" class="btn btn-primary btn-pill">Save</button>
                                                </div>
                                            </form>
                                    <?php }
                                    } ?>
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