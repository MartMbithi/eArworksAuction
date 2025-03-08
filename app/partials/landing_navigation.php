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

if ($_SESSION['user_access_level'] == 'Customer') {
    /* Get Logged In User Items Count In Wishlist */
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $query = "SELECT COUNT(*)  FROM wishlists WHERE wishlist_user_id = '{$user_id}'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($items_in_my_wishlist);
    $stmt->fetch();
    $stmt->close();


?>
    <header class="ec-header">
        <!--Ec Header Top Start -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Header Top social Start -->
                    <div class="col text-left header-top-left d-none d-lg-block">
                        <div class="header-top-social">
                            <span class="social-text text-upper">Follow us on:</span>
                            <ul class="mb-0">
                                <li class="list-inline-item">
                                    <a class="hdr-facebook" href="https://<?php echo $fb; ?>" target="_blank"><i class="ecicon eci-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-twitter" href="https://<?php echo $twitter; ?>" target="_blank"><i class="ecicon eci-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-instagram" href="https://<?php echo $instagram; ?>" target="_blank"><i class="ecicon eci-instagram"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-linkedin" href="https://<?php echo $linkedin; ?>" target="_blank"><i class="ecicon eci-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top social End -->
                    <!-- Header Top Message Start -->
                    <div class="col text-center header-top-center">
                        <div class="header-top-message text-upper">
                            <strong>
                                <span>The ongoing auction will end in</span><span id="bid-timer"></span>
                            </strong>
                        </div>
                    </div>
                    <!-- Header Top Message End -->
                    <!-- Header Top Language Currency -->
                    <div class="col header-top-right d-none d-lg-block">
                        <div class="header-top-lan-curr d-flex justify-content-end">
                            <!-- Currency Start -->
                            <div class="header-top-curr dropdown">
                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                    Default Currency
                                    <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="active">
                                        <a class="dropdown-item" href="">Kes</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Currency End -->
                            <!-- Language Start -->
                            <div class="header-top-lan dropdown">
                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                    Language
                                    <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="active">
                                        <a class="dropdown-item" href="">English</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Language End -->
                        </div>
                    </div>
                    <!-- Header Top Language Currency -->
                    <!-- Header Top responsive Action -->
                    <div class="col d-lg-none">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <img src="../public/landing_assets/images/icons/user.svg" class="svg_img header_svg" alt="" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item" href="landing_profile">My Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="landing_purchase_history">Recent Orders</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="landing_track_order">Track Orders</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart End -->
                            <!-- Header Cart Start -->
                            <a href="landing_my_bids" class="ec-header-btn">
                                <div class="header-icon">
                                    <img src="../public/landing_assets/images/icons/cart.svg" class="svg_img header_svg" alt="" />
                                </div>
                            </a>
                            <!-- Header Cart End -->
                            <!-- Header menu Start -->
                            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                                <img src="../public/landing_assets/images/icons/menu.svg" class="svg_img header_svg" alt="icon" />
                            </a>
                            <!-- Header menu End -->
                        </div>
                    </div>
                    <!-- Header Top responsive Action -->
                </div>
            </div>
        </div>
        <!-- Ec Header Top  End -->
        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <!-- Ec Header Logo Start -->
                        <div class="align-self-center">
                            <div class="header-logo">
                                <a href="../">
                                    <h2>
                                        eArworksAuction
                                    </h2>
                                </a>
                            </div>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center">
                            <div class="header-search">
                                <form class="ec-btn-group-form" action="landing_search" method="get">
                                    <input class="form-control ec-search-bar" name="search_params" placeholder="Search products..." type="text" />
                                    <button class="submit" type="submit">
                                        <img src="../public/landing_assets/images/icons/search.svg" class="svg_img header_svg" alt="" />
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Ec Header Search End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">
                                <!-- Header Cart Start -->
                                <a href="landing_my_bids" class="ec-header-btn">
                                    <div class="header-icon">
                                        <img src="../public/landing_assets/images/icons/cart.svg" class="svg_img header_svg" alt="" />
                                        <span class="ec-header-count">
                                            <?php
                                            /* Get All Items In My Bids Un Processed */
                                            $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
                                            $query = "SELECT COUNT(*)  FROM bids WHERE bid_user_id = '{$user_id}' AND bid_status = 'Pending'";
                                            $stmt = $mysqli->prepare($query);
                                            $stmt->execute();
                                            $stmt->bind_result($items_in_my_bids);
                                            $stmt->fetch();
                                            $stmt->close();
                                            echo $items_in_my_bids;
                                            ?>
                                        </span>
                                    </div>
                                </a>
                                <!-- Header Cart End -->
                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="../public/landing_assets/images/icons/user.svg" class="svg_img header_svg" alt="" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a class="dropdown-item" href="landing_profile">My Profile</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="landing_purchase_history">Recent Orders</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="landing_track_order">Track Orders</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="logout">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Header User End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none">
            <div class="container position-relative">
                <div class="row">
                    <!-- Ec Header Logo Start -->
                    <div class="col">
                        <div class="header-logo">
                            <a href="../">
                                <h2>
                                    eArworksAuction
                                </h2>
                            </a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    <!-- Ec Header Search Start -->
                    <div class="col">
                        <div class="header-search">
                            <form class="ec-btn-group-form" action="landing_search" method="get">
                                <input class="form-control ec-search-bar" name="search_params" placeholder="Search products..." type="text" />
                                <button class="submit" type="submit">
                                    <img src="../public/landing_assets/images/icons/search.svg" class="svg_img header_svg" alt="" />
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->
                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->
        <!-- EC Main Menu Start -->
        <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <div class="ec-main-menu">
                            <ul>
                                <li><a href="../">Home</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0)">Shop By Categories</a>
                                    <ul class="sub-menu">
                                        <?php
                                        /* Fetch All Categories */
                                        $categories_sql = mysqli_query($mysqli, "SELECT * FROM categories WHERE category_delete_status = '0'");
                                        if (mysqli_num_rows($categories_sql) > 0) {
                                            while ($categories = mysqli_fetch_array($categories_sql)) {
                                        ?>
                                                <li>
                                                    <a href="shop_by_categories?category=<?php echo $categories['category_id']; ?>&name=<?php echo $categories['category_name']; ?>"><?php echo $categories['category_name']; ?></a>
                                                </li>
                                            <?php }
                                        } else { ?>
                                            <li>
                                                <a href="#">No Categories</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li><a href="landing_products">Artworks</a></li>
                                <li><a href="landing_my_bids">My Bids</a></li>
                                <li><a href="landing_reccomendations">Reccomendations</a></li>
                                <li><a href="landing_seller_dashboard">Seller Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Main Menu End -->
        <!-- ekka Mobile Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">My Menu</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="../">Home</a></li>
                        <li>
                            <a href="javascript:void(0)">Shop By Categories</a>
                            <ul class="sub-menu">
                                <?php
                                /* Fetch All Categories */
                                $categories_sql = mysqli_query($mysqli, "SELECT * FROM categories WHERE category_delete_status = '0'");
                                if (mysqli_num_rows($categories_sql) > 0) {
                                    while ($categories = mysqli_fetch_array($categories_sql)) {
                                ?>
                                        <li>
                                            <a href="shop_by_categories?category=<?php echo $categories['category_id']; ?>&name=<?php echo $categories['category_name']; ?>"><?php echo $categories['category_name']; ?></a>
                                        </li>
                                    <?php }
                                } else { ?>
                                    <li>
                                        <a href="#">No Categories</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="landing_products">Artworks</a></li>
                    </ul>
                </div>
                <div class="header-res-lan-curr">
                    <div class="header-top-lan-curr">
                        <!-- Language Start -->
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                Language
                                <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="active">
                                    <a class="dropdown-item" href="">English</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Language End -->
                        <!-- Currency Start -->
                        <div class="header-top-curr dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                Default Currency
                                <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="active">
                                    <a class="dropdown-item" href="">Kes </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Currency End -->
                    </div>
                    <!-- Social Start -->
                    <div class="header-res-social">
                        <div class="header-top-social">
                            <ul class="mb-0">
                                <li class="list-inline-item">
                                    <a class="hdr-facebook" href="https://<?php echo $fb; ?>" target="_blank"><i class="ecicon eci-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-twitter" href="https://<?php echo $twitter; ?>" target="_blank"><i class="ecicon eci-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-instagram" href="https://<?php echo $instagram; ?>" target="_blank"><i class="ecicon eci-instagram"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-linkedin" href="https://<?php echo $linkedin; ?>" target="_blank"><i class="ecicon eci-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Social End -->
                </div>
            </div>
        </div>
        <!-- ekka mobile Menu End -->
    </header>
<?php
} else { ?>
    <header class="ec-header">
        <!--Ec Header Top Start -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Header Top social Start -->
                    <div class="col text-left header-top-left d-none d-lg-block">
                        <div class="header-top-social">
                            <span class="social-text text-upper">Follow us on:</span>
                            <ul class="mb-0">
                                <li class="list-inline-item">
                                    <a class="hdr-facebook" href="https://<?php echo $fb; ?>" target="_blank"><i class="ecicon eci-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-twitter" href="https://<?php echo $twitter; ?>" target="_blank"><i class="ecicon eci-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-instagram" href="https://<?php echo $instagram; ?>" target="_blank"><i class="ecicon eci-instagram"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-linkedin" href="https://<?php echo $linkedin; ?>" target="_blank"><i class="ecicon eci-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top social End -->
                    <!-- Header Top Message Start -->
                    <div class="col text-center header-top-center">
                        <div class="header-top-message text-upper">
                            <span>Free Shipping</span>This Week Order Over - Ksh 7,500
                        </div>
                    </div>
                    <!-- Header Top Message End -->
                    <!-- Header Top Language Currency -->
                    <div class="col header-top-right d-none d-lg-block">
                        <div class="header-top-lan-curr d-flex justify-content-end">
                            <!-- Currency Start -->
                            <div class="header-top-curr dropdown">
                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                    Default Currency
                                    <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="active">
                                        <a class="dropdown-item" href="">Kes</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Currency End -->
                            <!-- Language Start -->
                            <div class="header-top-lan dropdown">
                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                    Language
                                    <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="active">
                                        <a class="dropdown-item" href="">English</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Language End -->
                        </div>
                    </div>
                    <!-- Header Top Language Currency -->
                    <!-- Header Top responsive Action -->
                    <div class="col d-lg-none">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <img src="../public/landing_assets/images/icons/user.svg" class="svg_img header_svg" alt="" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item" href="register">Register</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="login">Login</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <a href="login" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon">
                                    <img src="../public/landing_assets/images/icons/wishlist.svg" class="svg_img header_svg" alt="" />
                                </div>
                            </a>
                            <!-- Header Cart End -->
                            <!-- Header menu Start -->
                            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                                <img src="../public/landing_assets/images/icons/menu.svg" class="svg_img header_svg" alt="icon" />
                            </a>
                            <!-- Header menu End -->
                        </div>
                    </div>
                    <!-- Header Top responsive Action -->
                </div>
            </div>
        </div>
        <!-- Ec Header Top  End -->
        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <!-- Ec Header Logo Start -->
                        <div class="align-self-center">
                            <div class="header-logo">
                                <a href="../">
                                    <a href="../">
                                        <h2>
                                            eArworksAuction
                                        </h2>
                                    </a>
                                </a>
                            </div>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center">
                            <div class="header-search">
                                <form class="ec-btn-group-form" action="landing_search" method="get">
                                    <input class="form-control ec-search-bar" name="search_params" placeholder="Search products..." type="text" />
                                    <button class="submit" type="submit">
                                        <img src="../public/landing_assets/images/icons/search.svg" class="svg_img header_svg" alt="" />
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Ec Header Search End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none">
            <div class="container position-relative">
                <div class="row">
                    <!-- Ec Header Logo Start -->
                    <div class="col">
                        <div class="header-logo">
                            <a href="../">
                                <h2>
                                    eArworksAuction
                                </h2>
                            </a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    <!-- Ec Header Search Start -->
                    <div class="col">
                        <div class="header-search">
                            <form class="ec-btn-group-form" action="landing_search" method="get">
                                <input class="form-control ec-search-bar" name="search_params" placeholder="Search products..." type="text" />
                                <button class="submit" type="submit">
                                    <img src="../public/landing_assets/images/icons/search.svg" class="svg_img header_svg" alt="" />
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->
                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->
        <!-- EC Main Menu Start -->
        <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <div class="ec-main-menu">
                            <ul>
                                <li><a href="../">Home</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0)">Shop By Categories</a>
                                    <ul class="sub-menu">
                                        <?php
                                        /* Fetch All Categories */
                                        $categories_sql = mysqli_query($mysqli, "SELECT * FROM categories WHERE category_delete_status = '0'");
                                        if (mysqli_num_rows($categories_sql) > 0) {
                                            while ($categories = mysqli_fetch_array($categories_sql)) {
                                        ?>
                                                <li>
                                                    <a href="shop_by_categories?category=<?php echo $categories['category_id']; ?>&name=<?php echo $categories['category_name']; ?>"><?php echo $categories['category_name']; ?></a>
                                                </li>
                                            <?php }
                                        } else { ?>
                                            <li>
                                                <a href="#">No Categories</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li><a href="landing_products">Artworks</a></li>
                                <li><a href="register">Register</a></li>
                                <li><a href="login">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Main Menu End -->
        <!-- ekka Mobile Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">My Menu</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="../">Home</a></li>
                        <li>
                            <a href="javascript:void(0)">Shop By Categories</a>
                            <ul class="sub-menu">
                                <?php
                                /* Fetch All Categories */
                                $categories_sql = mysqli_query($mysqli, "SELECT * FROM categories WHERE category_delete_status = '0'");
                                if (mysqli_num_rows($categories_sql) > 0) {
                                    while ($categories = mysqli_fetch_array($categories_sql)) {
                                ?>
                                        <li>
                                            <a href="shop_by_categories?category=<?php echo $categories['category_id']; ?>&name=<?php echo $categories['category_name']; ?>"><?php echo $categories['category_name']; ?></a>
                                        </li>
                                    <?php }
                                } else { ?>
                                    <li>
                                        <a href="#">No Categories</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="landing_products">Artworks</a></li>
                    </ul>
                </div>
                <div class="header-res-lan-curr">
                    <div class="header-top-lan-curr">
                        <!-- Language Start -->
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                Language
                                <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="active">
                                    <a class="dropdown-item" href="">English</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Language End -->
                        <!-- Currency Start -->
                        <div class="header-top-curr dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">
                                Default Currency
                                <i class="ecicon eci-caret-down" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="active">
                                    <a class="dropdown-item" href="">Kes </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Currency End -->
                    </div>
                    <!-- Social Start -->
                    <div class="header-res-social">
                        <div class="header-top-social">
                            <ul class="mb-0">
                                <li class="list-inline-item">
                                    <a class="hdr-facebook" href="https://<?php echo $fb; ?>" target="_blank"><i class="ecicon eci-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-twitter" href="https://<?php echo $twitter; ?>" target="_blank"><i class="ecicon eci-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-instagram" href="https://<?php echo $instagram; ?>" target="_blank"><i class="ecicon eci-instagram"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="hdr-linkedin" href="https://<?php echo $linkedin; ?>" target="_blank"><i class="ecicon eci-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Social End -->
                </div>
            </div>
        </div>
        <!-- ekka mobile Menu End -->
    </header>
<?php } ?>