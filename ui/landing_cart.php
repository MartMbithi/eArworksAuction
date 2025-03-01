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
require_once('../app/settings/cart_db_controller.php');
require_once('../app/settings/checklogin.php');
require_once('../app/settings/codeGen.php');
checklogin();
include('../app/helpers/cart.php');
require_once('../app/partials/landing_head.php');
?>

<body class="cart_page">
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
                            <h2 class="ec-breadcrumb-title">Cart</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                <li class="ec-breadcrumb-item active">Cart</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <div class="table-content cart-table-">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Unit Price</th>
                                                <th style="text-align: center;">Quantity</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            /* Fetch Everything In My Shopping Cart */
                                            if (isset($_SESSION["cart_item"])) {
                                                $total_quantity = 0;
                                                $total_price = 0;
                                                /* Populate Them */
                                                foreach ($_SESSION["cart_item"] as $item) {
                                                    $item_price = $item["quantity"] * $item["product_price"];
                                                    /* Check If This Product Has An Image */
                                                    if ($item['product_image'] == '') {
                                                        $image_dir = "../public/uploads/products/no_image.png";
                                                    } else {
                                                        $image_dir = "../public/uploads/products/" . $item['product_image'];
                                                    }
                                            ?>
                                                    <tr>
                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                            <a href="">
                                                                <img class="ec-cart-pro-img mr-4" src="<?php echo $image_dir; ?>" alt="" /><?php echo $item['product_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount">Ksh <?php echo number_format($item['product_price'], 2); ?></span></td>
                                                        <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"><?php echo $item['quantity']; ?></span></td>
                                                        <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format($item_price, 2); ?></td>
                                                        <td data-label="Remove" class="ec-cart-pro-remove text-center">
                                                            <form method="post" action="landing_cart?action=remove&product_sku_code=<?php echo $item["product_sku_code"]; ?>">
                                                                <!-- Hide This -->
                                                                <button name="Remove_Item" type="submit"><i class="ecicon eci-trash-o"></i></button></a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    /* Compute Quantity And Amount Supposed To Be Paid */
                                                    $total_quantity += $item["quantity"];
                                                    $total_price += ($item["product_price"] * $item["quantity"]);
                                                    /* DeliverY Fee */
                                                    $constant_delivery_fee = '1500';
                                                }

                                                ?>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name">
                                                        <b>Sub Total</b>
                                                    </td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                    <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"><?php echo $total_quantity; ?></span></td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format($total_price, 2); ?></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr class="text-center">
                                                    <td>No items in the cart.</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ec-cart-update-bottom">
                                            <a href="landing_products">Continue Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Order Summary</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <h4 class="ec-ship-title">Default Shipping Address</h4>
                                <div class="ec-cart-form">
                                    <?php
                                    /* Get Default Shipping Address */
                                    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
                                    $user_sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_id = '{$user_id}'");
                                    if (mysqli_num_rows($user_sql) > 0) {
                                        while ($customer = mysqli_fetch_array($user_sql)) {
                                    ?>
                                            <p>
                                                <?php echo $customer['user_default_address']; ?>
                                            </p>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Sub-Total</span>
                                            <span class="text-right">Ksh <?php echo number_format($total_price, 2); ?></span>
                                        </div>
                                        <div>
                                            <span class="text-left">Delivery Charges</span>
                                            <span class="text-right">Ksh <?php echo number_format($constant_delivery_fee, 2); ?></span>
                                        </div>
                                        <?php
                                        /* Show This If Cart Already Has Something */
                                        if (isset($_SESSION['cart_item'])) {
                                            /* Add 7 Days To Todays Date */
                                            $delivery_date = strtotime("+7 day");
                                        ?>
                                            <div>
                                                <span class="text-left">Estimated Delivery Date: </span>
                                                <span class="text-right"><?php echo date('d M, Y', $delivery_date); ?></span>
                                            </div>
                                        <?php } ?>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right">Ksh <?php echo number_format($total_price + $constant_delivery_fee, 2); ?></span>
                                        </div>

                                    </div><br>
                                    <?php
                                    if (isset($_SESSION["cart_item"])) { ?>
                                        <div class="cart_btn text-right">
                                            <a href="?action=empty" class="btn btn-danger">Clear Cart</a>
                                            <!-- Hide This Please -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkout_modal">
                                                Checkout
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                        <?php include('../app/modals/checkout_modal.php'); ?>
                        <!-- Trigger Checkout Modal -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Start -->
    <?php require_once('../app/partials/landing_footer.php'); ?>
    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <?php require_once('../app/partials/landing_scripts.php'); ?>

</body>


</html>