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
require_once('../app/partials/landing_head.php');
?>

<body>
  <div id="ec-overlay"><span class="loader_img"></span></div>

  <!-- Header start  -->
  <?php require_once('../app/partials/landing_navigation.php'); ?>
  <!-- Header End  -->


  <!-- Main Slider Start -->
  <div class="sticky-header-next-sec ec-main-slider section section-space-pb">
    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
      <!-- Main slider -->
      <div class="swiper-wrapper">
        <div class="ec-slide-item swiper-slide d-flex ec-slide-1">
          <div class="container align-self-center">
            <div class="row">
              <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                <div class="ec-slide-content slider-animation">
                  <h1 class="ec-slide-title text-primary">Top Artwork Collection</h1>
                  <h2 class="ec-slide-title text-primary">Sale Offer</h2>
                  <p class="text-primary">
                    Purchase high-quality artworks from your favorite artists from across the world.
                  </p>
                  <a href="landing_products" class="btn btn-lg btn-secondary">Order Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="ec-slide-item swiper-slide d-flex ec-slide-2">
          <div class="container align-self-center">
            <div class="row">
              <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                <div class="ec-slide-content slider-animation">
                  <h1 class="ec-slide-title">Ready Market</h1>
                  <h2 class="ec-slide-stitle">Expand your market quickly.</h2>
                  <p class="">
                    Are you an artist looking to expand into new markets? Register today and receive a free platform to sell your artworks.
                  </p>
                  <a href="register" class="btn btn-lg btn-secondary">Register Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination swiper-pagination-white"></div>
      <div class="swiper-buttons">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </div>
  <!-- Main Slider End -->

  <!-- Product tab Area Start -->
  <section class="section ec-product-tab section-space-p" id="collection">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="section-title">
            <h2 class="ec-bg-title">Our Top Artwork Collection</h2>
            <h2 class="ec-title">Our Top Artwork Collection</h2>
            <p class="sub-title">Browse The Collection of Top Products</p>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col">
          <div class="tab-content">
            <!-- 1st Product tab start -->
            <div class="tab-pane fade show active" id="tab-pro-for-all">
              <div class="row">
                <?php

                $products_sql = mysqli_query(
                  $mysqli,
                  "SELECT * FROM products p
                  INNER JOIN users u ON u.user_id = p.product_seller_id
                  INNER JOIN categories c ON c.category_id = p.product_category_id
                  WHERE u.user_delete_status = '0' 
                  AND c.category_delete_status = '0'
                  AND p.product_delete_status = '0'
                  ORDER BY RAND() LIMIT 6"
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
                      <!-- Product Content -->
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-6 ec-product-content" data-animation="fadeIn">
                        <div class="ec-product-inner">
                          <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                              <a href="landing_product?view=<?php echo $products['product_id']; ?>&category=<?php echo $products['category_id']; ?>" class="image">
                                <img class="main-image" src="<?php echo $image_dir; ?>" alt="Product" />
                              </a>
                              <span class="percentage"><?php echo $products['product_sku_code']; ?> </span>
                            </div>
                          </div>
                          <div class="ec-pro-content">
                            <h5 class="ec-pro-title">
                              <a href="landing_product?view=<?php echo $products['product_id']; ?>&category=<?php echo $products['category_id']; ?>"><?php echo $products['product_name']; ?></a>
                            </h5>
                            <span class="ec-price">
                              <span class="new-price">Ksh <?php echo number_format($products['product_price'], 2); ?></span>
                            </span>
                          </div>
                        </div>
                      </div>
                  <?php }
                  }
                } else { ?>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-6 ec-product-content" data-animation="fadeIn">
                    <div class="ec-product-inner">
                      <div class="ec-pro-image-outer">
                        <div class="ec-pro-image">
                          <a href="" class="image">
                            <img class="main-image" src="../public/uploads/products/no_image.png" alt="Product" />
                          </a>
                        </div>
                      </div>
                      <div class="ec-pro-content">
                        <h5 class="ec-pro-title">
                          <a href="">No available products at the moment</a>
                        </h5>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <div class="col-sm-12 shop-all-btn">
                  <a href="landing_products">Shop All Collection</a>
                </div>
              </div>
            </div>
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