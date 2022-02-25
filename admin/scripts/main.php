<?php
ob_start();
require "configs/connection.php";
require "configs/test.data.php";

###############################    SIGNIN       ################################

if (isset($_POST["signin"])) {
  $id         = TestData($_POST["id"]);
  $password   = TestData($_POST["password"]);
  $query      = mysqli_query($connection, "SELECT * FROM users WHERE user_phone ='$id' OR user_email='$id' AND user_password ='$password'  AND user_status ='active'") or die(mysqli_error($connection));
  $count      = mysqli_num_rows($query);
  if ($count == 1) {

    $data = mysqli_fetch_assoc($query);

    $alert  = "success";
    $msg    = "You have successfully signed in.";

    setcookie("SK_USER_ID", $data["user_id"], time() + (86400 * 30), "/");
    setcookie("SK_USER_ROLE", $data["user_role"], time() + (86400 * 30), "/");
    setcookie("SK_USER_USERNAME", $data["user_name"], time() + (86400 * 30), "/");

    if ($data["user_role"] == 'admin') {
      $home = "dashboard";
    }

?>
    <script type="text/javascript">
      setTimeout(function() {
        window.location = "<?php print($home) ?>";
      }, 3000);
    </script>
<?php
  } else {
    $alert  = "danger";
    $msg    = "Invalid login information, please try again.";
  }

  require "templates/alert.php";
}


//#####################################  USER REGISTRATION  ######################//

if (isset($_POST["addUser"])) {

  $fname                = TestData($_POST["fname"]);
  $lname                = TestData($_POST["lname"]);
  $phone                = TestData($_POST["phone"]);
  $email                = TestData($_POST["email"]);
  $role                 = TestData($_POST["role"]);

  // GENERATE PASSWORD

  $digits_needed = 6;
  $random_number = ''; // set up a blank string
  $count = 0;
  while ($count < $digits_needed) {
    $random_digit = mt_rand(0, 9);

    $random_number .= $random_digit;
    $count++;
  }

  $password             = $random_number;

  $query = mysqli_query($connection, "INSERT INTO `users` (`user_id`, `user_name`, `user_lname`, `user_fname`, `user_phone`, `user_email`, `user_password`, `user_role`, `user_status`) 
  VALUES (NULL, '$fname', '$lname', '$fname', '$phone', '$email', '$password', '$role', 'active')") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully registered new user!";
    require("templates/alert.php");
  }
}

# ADD CATEGORY

if (isset($_POST["addCategory"])) {

  $categoryName               = TestData($_POST["categoryName"]);
  $categoryDescription        = TestData($_POST["categoryDescription"]);

  $fileName                   = $_FILES["categoryImage"]["name"];
  $fileSize                   = $_FILES["categoryImage"]["size"] / 1024;
  $fileType                   = $_FILES["categoryImage"]["type"];
  $fileTmpName                = $_FILES["categoryImage"]["tmp_name"];

  if (
    $fileType == "image/png"
    || $fileType == "image/PNG"
    || $fileType == "image/JPG"
    || $fileType == "image/jpg"
    || $fileType == "image/jpeg"
    || $fileType == "image/JPEG"
    || $fileType == "image/gif"

  ) {

    //New file name
    $random = sha1(rand());
    $newFileName = $random . $fileName;

    //File upload path
    $uploadPath = "../catalog/categories/" . $newFileName;

    //function for upload file
    move_uploaded_file($fileTmpName, $uploadPath);

    if (move_uploaded_file($fileTmpName, $uploadPath)) {

      $query = mysqli_query($connection, "INSERT INTO `categories` (`category_id`, `category_name`, `category_image`, `category_description`) 
      VALUES (NULL, '$categoryName', '$uploadPath', '$categoryDescription')") or die(mysqli_error($connection));

      if ($query) {

        // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
        require("configs/deny.resubmit.php");
        // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

        $alert  = "success";
        $msg    = "You have successfully registered new product!";
        require("templates/alert.php");
      }
    } else {
      $alert  = "danger";
      $msg    = "Something wrong happened";
      require("templates/alert.php");
    }
  } else {

    $alert  = "danger";
    $msg    = "Invalid image type!" . $fileType;
    require("templates/alert.php");
  }
}


# EDIT 
# ADD CATEGORY

if (isset($_POST["editCategory"])) {

  $categoryId = TestData($_POST["categoryId"]);
  $categoryName               = TestData($_POST["categoryName"]);
  $categoryDescription        = TestData($_POST["categoryDescription"]);

  $fileName                   = $_FILES["categoryImage"]["name"];
  $fileSize                   = $_FILES["categoryImage"]["size"] / 1024;
  $fileType                   = $_FILES["categoryImage"]["type"];
  $fileTmpName                = $_FILES["categoryImage"]["tmp_name"];

  if (
    $fileType == "image/png"
    || $fileType == "image/PNG"
    || $fileType == "image/JPG"
    || $fileType == "image/jpg"
    || $fileType == "image/jpeg"
    || $fileType == "image/JPEG"
    || $fileType == "image/gif"

  ) {

    //New file name
    $random = sha1(rand());
    $newFileName = $random . $fileName;

    //File upload path
    $uploadPath = "../catalog/categories/" . $newFileName;
    print $path = "catalog/categories/" . $newFileName;

    //function for upload file
    move_uploaded_file($fileTmpName, $uploadPath);

    if (move_uploaded_file($fileTmpName, $uploadPath)) {

      $query = mysqli_query($connection, "UPDATE `categories` SET `category_name` = '$categoryName', `category_description` = '$categoryDescription', `category_image` = '$path' WHERE `categories`.`category_id` = '$categoryId'") or die(mysqli_error($connection));

      if ($query) {

        // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form rsesubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
        require("configs/deny.resubmit.php");
        // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

        $alert  = "success";
        $msg    = "You have successfully updated categroy information";
        require("templates/alert.php");
      }
    } else {
      $alert  = "danger";
      $msg    = "Something wrong happened";
      require("templates/alert.php");
    }
  } else {

    $alert  = "danger";
    $msg    = "Invalid image type!" . $fileType;
    require("templates/alert.php");
  }
}



# DELETE CATEGORY

if (isset($_GET["deleteCategory"])) {

  $categoryId      = TestData($_GET["deleteCategory"]);
  $query = mysqli_query($connection, "DELETE FROM `categories` WHERE `category_id` = '$categoryId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted category!";
    require("templates/alert.php");
  }
}

# SHOP CATEGORIES

if (isset($_POST["addShopCategory"])) {

  $categoryId      = TestData($_POST["categoryId"]);
  $shopId          = TestData($_POST["shopId"]);

  $query = mysqli_query($connection, "INSERT INTO `shop_categories` (`shop_category_id`, `shop_id`, `category_id`) 
  VALUES (NULL, '$shopId', '$categoryId')") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully added shop category";
    require("templates/alert.php");
  }
}


# DELETE POST

if (isset($_GET["deletePost"])) {

  $postId      = TestData($_GET["deletePost"]);
  $query = mysqli_query($connection, "DELETE FROM `posts` WHERE `post_id` = '$postId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted post from forum!";
    require("templates/alert.php");
  }
}


# DELETE SHOP

if (isset($_GET["deleteShop"])) {

  $shopId      = TestData($_GET["deleteShop"]);
  $query = mysqli_query($connection, "DELETE FROM `shops` WHERE `shop_id` = '$shopId'") or die(mysqli_error($connection));
  mysqli_query($connection, "DELETE FROM products WHERE shop_id ='$shopId'");
  mysqli_query($connection, "DELETE FROM sales WHERE shop_id ='$shopId'");

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted shop!";
    require("templates/alert.php");
  }
}

# SPONSOR SHOP

if (isset($_GET["sponsor"])) {

  $shopId      = TestData($_GET["sponsor"]);
  mysqli_query($connection, "DELETE FROM sponsored_shops WHERE shop_id ='$shopId'");
  $query = mysqli_query($connection, "INSERT INTO `sponsored_shops` (`id`, `shop_id`, `sponsored_date`) VALUES (NULL, '$shopId', current_timestamp())") or die(mysqli_error($connection));
  

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully sponsored shop!";
    require("templates/alert.php");
  }
}

# UNSPONSOR SHOP

if (isset($_GET["unsponsor"])) {

  $shopId      = TestData($_GET["unsponsor"]);
  $query = mysqli_query($connection, "DELETE FROM sponsored_shops WHERE shop_id ='$shopId'");
  //$query = mysqli_query($connection, "INSERT INTO `sponsored_shops` (`id`, `shop_id`) VALUES (NULL, '$shopId')") or die(mysqli_error($connection));
  

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully unsponsored shop!";
    require("templates/alert.php");
  }
}

# ADD PRODUCT

if (isset($_POST["addProduct"])) {

  $productName                = TestData($_POST["productName"]);
  $productDescription         = TestData($_POST["productDescription"]);
  $productPrice               = TestData($_POST["productPrice"]);
  $discountPrice              = TestData($_POST["discountPrice"]);
  $categoryId                 = TestData($_POST["categoryId"]);

  // SKU GENERATOR 
  function generateRandomString($length = 10)
  {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  $productSku    = generateRandomString();

  $fileName                   = $_FILES["productImage"]["name"];
  $fileSize                   = $_FILES["productImage"]["size"] / 1024;
  $fileType                   = $_FILES["productImage"]["type"];
  $fileTmpName                = $_FILES["productImage"]["tmp_name"];


  if (
    $fileType == "image/png"
    || $fileType == "image/PNG"
    || $fileType == "image/JPG"
    || $fileType == "image/jpg"
    || $fileType == "image/jpeg"
    || $fileType == "image/JPEG"
    || $fileType == "image/gif"

  ) {

    //New file name
    $random = sha1(rand());
    $newFileName = $random . $fileName;

    //File upload path
    $uploadPath = "../storage/products/" . $newFileName;

    //function for upload file
    if (move_uploaded_file($fileTmpName, $uploadPath)) {

      $query = mysqli_query($connection, "INSERT INTO `products` (`product_id`,`product_sku`, `product_name`, `product_description`, `product_image`, `product_price`, `product_discount_price`, `product_status`) 
      VALUES (NULL, '$productSku','$productName', '$productDescription', '$newFileName', '$productPrice', '$discountPrice', 'active')") or die(mysqli_error($connection));

      $productId = mysqli_insert_id($connection);

      mysqli_query($connection, "INSERT INTO `products_categories` (`id`, `product_id`, `category_id`) VALUES (NULL, '$productId', '$categoryId')") or die(mysqli_error($connection));
      if ($query) {

        // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
        require("configs/deny.resubmit.php");
        // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

        $alert  = "success";
        $msg    = "You have successfully registered new product!";
        require("templates/alert.php");
      }
    } else {
      $alert  = "danger";
      $msg    = "Something wrong happened";
      require("templates/alert.php");
    }
  } else {

    $alert  = "danger";
    $msg    = "Invalid image type!" . $fileType;
    require("templates/alert.php");
  }
}

# DELETE PRODUCT

if (isset($_GET["deleteProduct"])) {

  $productId      = TestData($_GET["deleteProduct"]);

  $query = mysqli_query($connection, "SELECT * FROM products WHERE product_id ='$productId'") or die(mysqli_error($connection));
  $data = mysqli_fetch_assoc($query);
  $productImage = "http://localhost/chinakigali/storage/products/" . $data["product_image"];

  @unlink($productImage);

  $query = mysqli_query($connection, "DELETE FROM `products` WHERE `products`.`product_id` = '$productId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted product!";
    require("templates/alert.php");
  }
}

# DELETE USER

if (isset($_GET["deleteUser"])) {

  $userId      = TestData($_GET["deleteUser"]);
  $query = mysqli_query($connection, "DELETE FROM `users` WHERE `users`.`user_id` = '$userId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted a user from system!";
    require("templates/alert.php");
  }
}




# DELETE REFILL

if (isset($_GET["deleteRefill"])) {

  $refillId      = TestData($_GET["deleteRefill"]);
  $query = mysqli_query($connection, "DELETE FROM `fuel_refilling` WHERE `fuel_refilling`.`refill_id` = '$refillId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted fuel refilling info from system!";
    require("templates/alert.php");
  }
}

# DELETE REQUEST

if (isset($_GET["deleteRequest"])) {

  $requestId      = TestData($_GET["deleteRequest"]);
  $query = mysqli_query($connection, "DELETE FROM `requests` WHERE `requests`.`request_id` = '$requestId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully deleted fuel request from system!";
    require("templates/alert.php");
  }
}

# APPROVE REQUEST

if (isset($_GET["approveRequest"])) {

  $requestId      = TestData($_GET["approveRequest"]);
  $query = mysqli_query($connection, "UPDATE `requests` SET `request_status` = 'APPROVED' WHERE `requests`.`request_id` = '$requestId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully approved fuel request from system!";
    require("templates/alert.php");
  }
}

# REJECT REQUEST

if (isset($_GET["rejectRequest"])) {

  $requestId      = TestData($_GET["rejectRequest"]);
  $query = mysqli_query($connection, "UPDATE `requests` SET `request_status` = 'REJECTED' WHERE `requests`.`request_id` = '$requestId'") or die(mysqli_error($connection));

  if ($query) {

    // >>>>>>>>>>>>>>>>>>>>>>>>>      prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//
    require("configs/deny.resubmit.php");
    // >>>>>>>>>>>>>>>>>>>>>>>>>   end prevent form resubmit on refresh   <<<<<<<<<<<<<<<<<<<<<<<<<//

    $alert  = "success";
    $msg    = "You have successfully rejected fuel request from system!";
    require("templates/alert.php");
  }
}
ob_end_flush();
?>