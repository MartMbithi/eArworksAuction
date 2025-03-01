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


$user_access_level = mysqli_real_escape_string($mysqli, $_SESSION['user_access_level']);
global $user_access_level;
if ($user_access_level == 'Administrator') {
?>
    <div class="ec-left-sidebar ec-bg-sidebar">
        <div id="sidebar" class="sidebar ec-sidebar-footer">

            <div class="ec-brand">
                <a href="dashboard" title="eArworksAuction">
                    <img class="ec-brand-icon" src="../public/backoffice_assets/img/logo/ec-site-logo.png" alt="" />
                    <span class="ec-brand-name text-truncate">eArworksAuction</span>
                </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="ec-navigation" data-simplebar>
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <!-- Dashboard -->
                    <li>
                        <a class="sidenav-item-link" href="dashboard">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <hr>
                    </li>

                    <!-- Users -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-account-group"></i>
                            <span class="nav-text">Staffs</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                <li>
                                    <a class="sidenav-item-link" href="backoffice_import_users">
                                        <span class="nav-text">Bulk Import</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_staffs">
                                        <span class="nav-text">Manage Staffs</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Customers -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-account-group-outline"></i>
                            <span class="nav-text">Customers</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                <li>
                                    <a class="sidenav-item-link" href="backoffice_import_customers">
                                        <span class="nav-text">Bulk Import</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_customers">
                                        <span class="nav-text">Manage Customers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </li>

                    <!-- Category -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-dns-outline"></i>
                            <span class="nav-text">Categories</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_import_categories">
                                        <span class="nav-text">Bulk Import</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_categories">
                                        <span class="nav-text">Manage Categories</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Products -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-palette-advanced"></i>
                            <span class="nav-text">Products</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_import_products">
                                        <span class="nav-text">Bulk Import</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_products">
                                        <span class="nav-text">Manage Products</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Orders -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-cart"></i>
                            <span class="nav-text">Orders</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_orders">
                                        <span class="nav-text">Manage Orders</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_payments">
                                        <span class="nav-text">Order Payments</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Settings -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-settings"></i>
                            <span class="nav-text">Settings</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="settings" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_settings_mailer">
                                        <span class="nav-text">Mailer API</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_settings_api">
                                        <span class="nav-text">Thirdparty APIs</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_settings_payments">
                                        <span class="nav-text">Payments Methods</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class="sidenav-item-link" href="backoffice_reports">
                            <i class="mdi mdi-file"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <hr>
                    </li>
                    <li>
                        <a class="sidenav-item-link" href="backoffice_recycle_bin">
                            <i class="mdi mdi-trash-can"></i>
                            <span class="nav-text">Recycle Bin</span>
                        </a>
                        <hr>
                    </li>

                    <!-- Lite CMS -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-cast"></i>
                            <span class="nav-text">Lite CMS</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="settings" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_cms_toc">
                                        <span class="nav-text">Terms & Conditions</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_cms_faq">
                                        <span class="nav-text">FAQ</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_cms_contacts">
                                        <span class="nav-text">Contacts</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_cms_about">
                                        <span class="nav-text">About Us</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } else if ($user_access_level == 'Staff') { ?>

    <div class="ec-left-sidebar ec-bg-sidebar">
        <div id="sidebar" class="sidebar ec-sidebar-footer">

            <div class="ec-brand">
                <a href="dashboard" title="eArworksAuction">
                    <img class="ec-brand-icon" src="../public/backoffice_assets/img/logo/ec-site-logo.png" alt="" />
                    <span class="ec-brand-name text-truncate">eArworksAuction</span>
                </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="ec-navigation" data-simplebar>
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <!-- Dashboard -->
                    <li>
                        <a class="sidenav-item-link" href="dashboard">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <hr>
                    </li>

                    <!-- Customers -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-account-group-outline"></i>
                            <span class="nav-text">Customers</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_customers">
                                        <span class="nav-text">Manage Customers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </li>

                    <!-- Category -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-dns-outline"></i>
                            <span class="nav-text">Categories</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_categories">
                                        <span class="nav-text">Manage Categories</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Products -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-palette-advanced"></i>
                            <span class="nav-text">Products</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_products">
                                        <span class="nav-text">Manage Products</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Orders -->
                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)">
                            <i class="mdi mdi-cart"></i>
                            <span class="nav-text">Orders</span> <b class="caret"></b>
                        </a>
                        <div class="collapse">
                            <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_orders">
                                        <span class="nav-text">Manage Orders</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="sidenav-item-link" href="backoffice_manage_payments">
                                        <span class="nav-text">Order Payments</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } else {
    /* Prevent Customer Accessing Back Office */
    header('Location: logout');
} ?>