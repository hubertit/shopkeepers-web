<?php
if (isset($_GET["q"])) {

    require("configs/connection.php");

    $q = $_GET["q"]; ?>
    <!DOCTYPE html>
    <html class="no-js" lang="">


    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title> Search : <?php print $q; ?> </title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="manifest" href="" />
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
        <!-- Place favicon.png in the root directory -->

        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />
        <link rel="stylesheet" href="assets/css/animate.min.css" />
        <link rel="stylesheet" href="assets/css/magnific-popup.css" />
        <link rel="stylesheet" href="assets/css/nice-select.css" />
        <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css" />
        <link rel="stylesheet" href="assets/css/slick.css" />
        <link rel="stylesheet" href="assets/css/ui-range-slider.css" />
        <link rel="stylesheet" href="assets/css/meanmenu.css" />
        <link rel="stylesheet" href="assets/css/swipper.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <?php require("templates/header.php"); ?>

        <main>
            <!-- prealoder area start -->
            <!-- <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="first_object"></div>
                    <div class="object" id="second_object"></div>
                    <div class="object" id="third_object"></div>
                </div>
            </div>
        </div> -->
            <!-- prealoder area end -->
            <!-- breadcrumb area start -->
            <div class="epix-breadcrumb-area mb-40">
                <div class="container">
                    <!-- <h4 class="epix-breadcrumb-title">SHOP PAGE</h4> -->
                    <div class="epix-breadcrumb">
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span>Search</span></li>
                            <li><span><?php print $_GET["q"]; ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->
            <!-- shop product area start -->
            <div class="shop-product-area pb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-3">
                            <?php require("templates/sidebar.php"); ?>
                            <!-- /. sidebar area -->

                            <!-- /. sidebar area -->
                        </div>
                        <div class="col-xxl-9 col-lg-9 epix-shop-order">
                            <div class="epix-shop-products-display">
                                <div class="epix-shop-product-topbar">
                                    <div class="epix-content-header mb-55">
                                        <div class="epix-ch-left">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="shop?details=<?php print $data["shop_id"] ;?>grid-view" type="button"><i class="fas fa-th"></i></button>
                                                    <button class="" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="shop?details=<?php print $data["shop_id"] ;?>list-view" type="button"><i class="fas fa-list-ul"></i></button>
                                                </div>
                                            </nav>
                                        </div>
                                        <div class="epix-ch-right">
                                            <div class="show-text">
                                                <?php
                                                $query = mysqli_query($connection, "SELECT * FROM shops, products WHERE products.shop_id = shops.shop_id AND  country_id ='1' AND product_name LIKE'%$q%' ");
                                                $shops = mysqli_num_rows($query);
                                                $pages = $shops / 24;
                                                ?>
                                                <span>Showing 1–24 of <?php print  $shops ?> results</span>
                                            </div>
                                            <div class="sort-wrapper">
                                                <select name="select" id="select">
                                                    <option value="1">Short By Sale</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="epix-shop-product-main" style="background-color: #f5f5f5; padding:20px">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="grid-view">
                                                <div class="row">
                                                    <?php

                                                    if (isset($_GET["page"])) {
                                                        $page = $_GET["page"];
                                                        $show = $page * 24;

                                                        $query = mysqli_query($connection, "SELECT * FROM shops, products WHERE products.shop_id = shops.shop_id AND  country_id ='1' AND product_name LIKE'%$q%'  LIMIT $show, 24 ") or die(mysqli_error($connection));
                                                    } else {
                                                        $query = mysqli_query($connection, "SELECT * FROM shops, products WHERE products.shop_id = shops.shop_id AND  country_id ='1' AND product_name LIKE'%$q%'  LIMIT 24 ") or die(mysqli_error($connection));
                                                    }

                                                    while ($data = mysqli_fetch_assoc($query)) {
                                                        $data["shop_password"] = null;

                                                        $shopId = $data["shop_id"];
                                                        $salesQuery = mysqli_query($connection, "SELECT * FROM sales, products WHERE sales.shop_id='$shopId' AND sales.sale_product_id = products.product_id") or die(mysqli_error($connection));
                                                        $sales = mysqli_fetch_assoc($salesQuery);
                                                        $sales["product_image"] = "https://shoopkeepers.com/" . $sales["product_image"];
                                                        $data["sales"] = $sales;


                                                    ?>
                                                        <div class="col-xxl-3 col-sm-6 col-xs-6 col-md-3 mb-4">
                                                            <div class="epix-single-product-3 sale-product mb-40 style-2 text-center swiper-slide">
                                                                <div class="epix-product-thumb-3">
                                                                    <div class="epix-action">
                                                                        <a href="tel:<?php print $data["shop_phone"] ?>" target="_blank" class="p-cart product-popup-toggle">
                                                                            <i class="fa fa-phone"></i>
                                                                            <i class="fa fa-phone"></i>
                                                                        </a>
                                                                        <a href="<?php print $data["shop_facebook"] ?>" target="_blank" class="p-cart">
                                                                            <i class="fab fa-facebook"></i>
                                                                            <i class="fab fa-facebook"></i>
                                                                        </a>
                                                                        <a href="<?php print $data["shop_instagram"] ?>" target="_blank" class="p-cart">
                                                                            <i class="fab fa-instagram"></i>
                                                                            <i class="fab fa-instagram"></i>
                                                                        </a>

                                                                    </div>
                                                                    <span class="sale">sale</span>
                                                                    <a href="shop?details=<?php print $data["shop_id"] ;?>">
                                                                        <div class="sale-product-container" style="height: 200px; overflow:hidden;">
                                                                            <img src="<?php print $sales["product_image"] ?>" alt="">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="price-box price-box-3">
                                                                    <span class="price"><?php print number_format($sales["product_price"]); ?> RWF</span>
                                                                </div>
                                                                <h5 class="epix-p-title epix-p-title-3"><a href="shop?details=<?php print $data["shop_id"] ;?>"> <?php print $sales["product_name"] ?></a></h5>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="list-view" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <?php

                                                if (isset($_GET["page"])) {
                                                    $page = $_GET["page"];
                                                    $show = $page * 24;

                                                    $query = mysqli_query($connection, "SELECT * FROM shops, products WHERE products.shop_id = shops.shop_id AND  country_id ='1' AND product_name LIKE'%$q%'  LIMIT $show, 24 ") or die(mysqli_error($connection));
                                                } else {
                                                    $query = mysqli_query($connection, "SELECT * FROM shops, products WHERE products.shop_id = shops.shop_id AND  country_id ='1' AND product_name LIKE'%$q%'  LIMIT 24 ") or die(mysqli_error($connection));
                                                }
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $data["shop_password"] = null;

                                                    $shopId = $data["shop_id"];
                                                    $salesQuery = mysqli_query($connection, "SELECT * FROM sales, products WHERE sales.shop_id='$shopId' AND sales.sale_product_id = products.product_id") or die(mysqli_error($connection));
                                                    $sales = mysqli_fetch_assoc($salesQuery);
                                                    $sales["product_image"] = "https://shoopkeepers.com/" . $sales["product_image"];
                                                    $data["sales"] = $sales;


                                                ?>
                                                    <div class="epix-list-product-single">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-xl-3">
                                                                <div class="epix-product-thumb-3 d-inline-block">
                                                                    <div class="epix-action">
                                                                        <a href="tel:<?php print $data["shop_phone"] ?>" target="_blank" class="p-cart product-popup-toggle">
                                                                            <i class="fa fa-phone"></i>
                                                                            <i class="fa fa-phone"></i>
                                                                        </a>
                                                                        <a href="<?php print $data["shop_facebook"] ?>" target="_blank" class="p-cart">
                                                                            <i class="fab fa-facebook"></i>
                                                                            <i class="fab fa-facebook"></i>
                                                                        </a>
                                                                        <a href="<?php print $data["shop_instagram"] ?>" target="_blank" class="p-cart">
                                                                            <i class="fab fa-instagram"></i>
                                                                            <i class="fab fa-instagram"></i>
                                                                        </a>
                                                                    </div>
                                                                    <span class="sale">sale</span>
                                                                    <a href="shop?details=<?php print $data["shop_id"] ;?>"><img src="<?php print $sales["product_image"] ?>" alt=""></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-xl-9">
                                                                <div class="epix-product-content d-inline-block">
                                                                    <div class="mb-15">
                                                                        <h5 class="epix-p-title"><a href="shop?details=<?php print $data["shop_id"] ;?>"><?php print $sales["product_name"] ?></a></h5>
                                                                        <div class="wrap">
                                                                            <span class="epix-p-subtitle"><?php print $data["shop_name"] ?></span>
                                                                            <!-- <div class="rating">
                                                                            <i class="fal fa-star"></i>
                                                                            <span>2.5</span>
                                                                        </div> -->
                                                                        </div>
                                                                        <div class="price-box">
                                                                            <span class="price"><?php print number_format($sales["product_price"]); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <p>
                                                                        <?php print $data["shop_address"] ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php require("templates/pagination.php"); ?>
                </div>
            </div>
            <!-- shop product area end -->
        </main>

        <?php require("templates/footer.php"); ?>

        <!-- JS here -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/swipper-bundle.min.js"></script>
        <script src="assets/js/jquery.meanmenu.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/nice-select.js"></script>
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/jquery-ui-slider-range.js"></script>
        <script src="assets/js/jquery.elevatezoom.js"></script>
        <script src="assets/js/countdown.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/mouse-wheel.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>


<?php } else { ?>

    <script>
        history.back();
    </script>

<?php } ?>