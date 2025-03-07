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
require_once('../app/helpers/landing.php');
require_once('../app/partials/landing_head.php');
?>

<body class="product_page">
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
                            <h2 class="ec-breadcrumb-title">Artwork</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                <li class="ec-breadcrumb-item"><a href="../">Artworks</a></li>
                                <li class="ec-breadcrumb-item active">Artwork</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->
    <?php
    $product_id = mysqli_real_escape_string($mysqli, $_GET['view']);
    $products_sql = mysqli_query(
        $mysqli,
        "SELECT * FROM products p
        INNER JOIN users u ON u.user_id = p.product_seller_id
        INNER JOIN categories c ON c.category_id = p.product_category_id
        WHERE u.user_delete_status = '0' 
        AND c.category_delete_status = '0'
        AND p.product_delete_status = '0'
        AND p.product_id = '{$product_id}'
        "
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
            <section class="ec-page-content section-space-p">
                <div class="container">
                    <div class="row">
                        <div class="ec-pro-rightside ec-common-rightside col-lg-12 order-lg-last col-md-12 order-md-first">

                            <!-- Single product content Start -->
                            <div class="single-pro-block">
                                <div class="single-pro-inner">
                                    <div class="row">
                                        <div class="single-pro-img">
                                            <div class="single-product-scroll">
                                                <div class="single-product-cover">
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive" src="<?php echo $image_dir; ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-pro-desc">
                                            <div class="single-pro-content">
                                                <h5 class="ec-single-title"><?php echo $products['product_name']; ?></h5>
                                                <div class="ec-single-rating-wrap">
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ec-single-price-stoke">
                                                    <div class="ec-single-price">
                                                        <span class="ec-single-ps-title">As low as</span>
                                                        <span class="new-price">Ksh <?php echo number_format($products['product_price'], 2); ?></span>
                                                    </div>
                                                    <div class="ec-single-stoke">
                                                        <span class="ec-single-ps-title">IN STOCK</span>
                                                        <span class="ec-single-sku">SKU#: <?php echo $products['product_sku_code']; ?></span>
                                                    </div>
                                                </div>
                                                <?php if ($_SESSION['user_access_level'] == 'Customer') { ?>
                                                    <div class="ec-single-price-stoke">
                                                        <div class="ec-single-price">
                                                            <span class="ec-single-ps-title">Seller Details</span>
                                                            <span class="new-price">Name : <?php echo $products['user_first_name'] . ' ' . $products['user_last_name']; ?> </span>
                                                            <span class="new-price">Email : <?php echo $products['user_email']; ?> </span>
                                                            <span class="new-price">Contacts : <?php echo $products['user_phone_number']; ?></span>

                                                        </div>
                                                    </div>
                                                    <p class="text-danger">
                                                        Bids can be placed every four hours, and your bid amount must not be lower than the artwork's selling price. Any bids below the product price will be discarded.
                                                    </p>
                                                    <div class="ec-single-qty">
                                                        <form method="post">
                                                            <!-- Hidden -->
                                                            <input type="hidden" name="bid_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                                            <input type="hidden" name="bid_product_id" value="<?php echo $products['product_id']; ?>">
                                                            <input type="hidden" name="bid_code" value="<?php echo $bid; ?>">
                                                            <input type="hidden" name="bid_date" value="<?php echo date('d M Y g:ia'); ?>">
                                                            <input type="hidden" name="bid_qty" value="1">

                                                            <div class="qty-plus-minus">
                                                                <input class="qty-input" type="text" name="bid_cost" value="<?php echo $products['product_price']; ?>" />
                                                            </div>
                                                            <br>
                                                            <div class="ec-single-cart ">
                                                                <button type="submit" name="Place_Bid" class="btn btn-primary">Place Bid</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Single product content End -->
                            <!-- Single product tab start -->
                            <div class="ec-single-pro-tab">
                                <div class="ec-single-pro-tab-wrapper">
                                    <div class="ec-single-pro-tab-nav">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details" role="tablist">Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content  ec-single-pro-tab-content">
                                        <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                            <div class="ec-single-pro-tab-desc">
                                                <?php echo $products['product_details']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- product details description area end -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Single product -->
    <?php }
    } ?>

    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Related Artworks</h2>
                        <h2 class="ec-title">Related Artworks</h2>
                        <p class="sub-title">Browse The Collection of Top Artworks</p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                <?php
                $category = mysqli_real_escape_string($mysqli, $_GET['category']);
                $products_sql = mysqli_query(
                    $mysqli,
                    "SELECT * FROM products p
                    INNER JOIN users u ON u.user_id = p.product_seller_id
                    INNER JOIN categories c ON c.category_id = p.product_category_id
                    WHERE u.user_delete_status = '0' 
                    AND c.category_delete_status = '0'
                    AND p.product_delete_status = '0'
                    AND c.category_id = '{$category}' 
                    AND p.product_id != '{$product_id}'
                    "
                );
                if (mysqli_num_rows($products_sql) > 0) {
                    while ($products = mysqli_fetch_array($products_sql)) {
                        /* Image Directory */
                        if ($products['product_image'] == '') {
                            $image_dir = "../public/uploads/products/no_image.png";
                        } else {
                            $image_dir = "../public/uploads/products/" . $products['product_image'];
                        }
                        /* Only show available artworks */
                        $availability = strtotime($products['product_available_from']);
                        /* Show Available Artowkrs */
                        if ($current_time >= $availability) {
                ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                <div class="ec-product-inner">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image">
                                            <a href="landing_product?view=<?php echo $products['product_id']; ?>&category=<?php echo $products['category_id']; ?>" class="image">
                                                <img class="main-image" src="<?php echo $image_dir; ?>" alt="Product" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content">
                                        <h5 class="ec-pro-title"><a href="landing_product?view=<?php echo $products['product_id']; ?>&category=<?php echo $products['category_id']; ?>"><?php echo $products['product_name']; ?></a></h5>
                                        <div class="ec-pro-rating">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                        </div>
                                        <span class="ec-price">
                                            <span class="new-price">Ksh <?php echo number_format($products['product_price'], 2); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                <?php }
                    }
                } ?>
            </div>
        </div>
    </section>
    <!-- Related Product end -->
    <!-- Footer Start -->
    <?php require_once('../app/partials/landing_footer.php'); ?>
    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <?php require_once('../app/partials/landing_scripts.php'); ?>

</body>

</html>