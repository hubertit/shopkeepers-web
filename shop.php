<?php if (isset($_GET["details"])) {
    $shopId = $_GET["details"];

    require("configs/globals.php");

    $query = mysqli_query($connection, "SELECT * FROM shops WHERE shop_id ='$shopId'") or die(mysqli_error($connection));
    $shop = mysqli_fetch_assoc($query);

?>
    <!DOCTYPE html>
    <html class="no-js" lang="">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title><?php print $shop["shop_name"]; ?></title>
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
            <div id="loading">
                <div id="loading-center">
                    <div id="loading-center-absolute">
                        <div class="object" id="first_object"></div>
                        <div class="object" id="second_object"></div>
                        <div class="object" id="third_object"></div>
                    </div>
                </div>
            </div>
            <!-- prealoder area end -->
            <!-- breadcrumb area start -->
            <div class="epix-breadcrumb-area mb-40">
                <div class="container">
                    <h4 class="epix-breadcrumb-title">SHOP PAGE</h4>
                    <div class="epix-breadcrumb">
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span>Shop Page</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->

            <!-- single product area start -->
            <div class="single-product-area mb-100">
                <div class="container">
                    <div class="row mb-40">
                        <div class="col-xxl-6 col-lg-6">
                            <div class="epix-single-product-left mr-35">
                                <div class="epix-tab-product mb-15">
                                    <div class="epix-product-tab-content">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="epix-single-1">
                                                <div class="epix-single-product-thumb-4">
                                                    <div class="epix-featured">
                                                        <span>featured</span>
                                                    </div>
                                                    <img src="https://shopkeepers.rw/<?php print $shop["shop_profile_picture"]; ?>" data-zoom-image="<?php print $shop["shop_profile_picture"]; ?>" class="img-fluid zoom-img-hover" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="epix-single-2">
                                                <div class="epix-single-product-thumb-4">
                                                    <div class="epix-featured">
                                                        <span>new</span>
                                                    </div>
                                                    <img src="assets/img/product/signle-product-2.jpg" data-zoom-image="assets/img/product/signle-product-2.jpg" class="img-fluid zoom-img-hover" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="epix-single-3">
                                                <div class="epix-single-product-thumb-4">
                                                    <div class="epix-featured">
                                                        <span>hot</span>
                                                    </div>
                                                    <img src="assets/img/product/signle-product-3.jpg" data-zoom-image="assets/img/product/signle-product-3.jpg" class="img-fluid zoom-img-hover" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="epix-single-4">
                                                <div class="epix-single-product-thumb-4">
                                                    <div class="epix-featured">
                                                        <span>featured</span>
                                                    </div>
                                                    <img src="assets/img/product/signle-product-4.jpg" data-zoom-image="assets/img/product/signle-product-4.jpg" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="epix-tab-content">
                                    <ul class="nav nav-pills mb-3" id="epix-single-product-tab" role="tablist">
                                        <li>
                                            <button class="active" value="1" data-bs-toggle="pill" data-bs-target="#epix-single-1" type="button">
                                                <img width="98" height="98" src="assets/img/product/single-product-sm-1.jpg" alt="">
                                            </button>
                                        </li>
                                        <li>
                                            <button data-bs-toggle="pill" value="2" data-bs-target="#epix-single-2" type="button">
                                                <img width="98" height="98" src="assets/img/product/single-product-sm-2.jpg" alt="">
                                            </button>
                                        </li>
                                        <li>
                                            <button data-bs-toggle="pill" value="3" data-bs-target="#epix-single-3" type="button">
                                                <img width="98" height="98" src="assets/img/product/single-product-sm-3.jpg" alt="">
                                            </button>
                                        </li>
                                        <li>
                                            <button data-bs-toggle="pill" value="4" data-bs-target="#epix-single-4" type="button">
                                                <img width="98" height="98" src="assets/img/product/single-product-sm-4.jpg" alt="">
                                            </button>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>
                            <!-- /. single product left -->
                        </div>
                        <div class="col-xxl-6 col-lg-6">
                            <div class="epix-single-product-right">
                                <div class="rating">
                                    <!-- <i class="fas fa-star active"></i>
                                    <i class="fas fa-star active"></i>
                                    <i class="fas fa-star active"></i>
                                    <i class="fas fa-star-half"></i>
                                    <i class="fas fa-star text-gray"></i> -->
                                </div>
                                <h4 class="epix-single-product-title"><?php print $shop["shop_name"]; ?></h4>
                                <!-- <p class="epix-product-details-short-description">
                                    Screen Size: 8 Inches<br>
                                    Screen Resolution: 1280 x 800 pixels
                                </p> -->
                                <p><a href="tel:<?php print $shop["shop_phone"]; ?>"><i class="fas fa-phone-square"></i> <?php print $shop["shop_phone"]; ?></a></p>
                                <p><a href="<?php print $shop["shop_facebook"]; ?>"><i class="fab fa-facebook"></i> <?php print $shop["shop_facebook"]; ?></a></p>
                                <p><a href="<?php print $shop["shop_instagram"]; ?>"><i class="fab fa-instagram-square"></i> <?php print $shop["shop_instagram"]; ?></a></p>
                                <p><a href="<?php print $shop["shop_website"]; ?>"><i class="fas fa-globe"></i> <?php print $shop["shop_website"]; ?></a></p>
                                <p><i class="fas fa-street-view"></i> <?php print $shop["shop_address"]; ?></p>
                    
                            </div>
                            <!-- /. single product right -->
                        </div>
                    </div>


                </div>
            </div>
            <!-- single product area end -->
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
        <script src="assets/js/nice-select.js"></script>
        <script src="assets/js/nice-select.js"></script>
        <script src="assets/js/jquery.elevatezoom.js"></script>
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/jquery-ui-slider-range.js"></script>
        <script src="assets/js/countdown.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/mouse-wheel.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>

<?php } else {
?>
    <script>
        history.back();
    </script>
<?php
} ?>