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
require_once('../app/partials/landing_head.php');
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
                            <h2 class="ec-breadcrumb-title">Purchase History</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                <li class="ec-breadcrumb-item active">Orders</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- User history section -->
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <?php require_once('../app/partials/landing_profile_sidebar.php'); ?>

                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Recent Orders</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="landing_products">Shop Now</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Number Of Items</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Estimated Delivery Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /* Pull Recent Purchases Made By This User */
                                        $order_user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
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
                                            AND u.user_id = '{$order_user_id}'
                                            GROUP BY o.order_code
                                            ORDER BY o.order_date DESC"
                                        );
                                        if (mysqli_num_rows($orders_sql) > 0) {
                                            while ($orders = mysqli_fetch_array($orders_sql)) {
                                                /* Sum Number Of Items In The Order */
                                                $query = "SELECT COUNT(*)  FROM orders WHERE order_code = '{$orders['order_code']}'";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $stmt->bind_result($items_in_my_order);
                                                $stmt->fetch();
                                                $stmt->close();
                                        ?>
                                                <tr>
                                                    <th scope="row"><span><?php echo $orders['order_code']; ?></span></th>
                                                    <td><span><?php echo $items_in_my_order; ?> Items</span></td>
                                                    <td><span><?php echo date('d M Y', strtotime($orders['order_date'])); ?></span></td>
                                                    <td><span><?php echo date('d M Y', strtotime($orders['order_estimated_delivery_date'])); ?></span></td>
                                                    <td>
                                                        <span class="tbl-btn">
                                                            <a class="btn btn-lg btn-primary" href="landing_track_order_details?view=<?php echo $orders['order_bid_id']; ?>">Track Order</a>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php
                                                /* Sales Payment Helper */
                                                include('../app/modals/payment_modal.php');
                                            }
                                        } else { ?>
                                            <tr>
                                                <th scope="row">No Recent Orders</th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End User history section -->

    <!-- Footer Start -->
    <?php require_once('../app/partials/landing_footer.php'); ?>
    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <?php require_once('../app/partials/landing_scripts.php'); ?>
</body>

</html>