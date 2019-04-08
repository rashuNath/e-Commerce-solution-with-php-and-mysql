<?php
if(!isset($_SESSION) )session_start();
include_once('vendor/autoload.php');
use App\UserRegistration\UserRegistration;
use App\UserRegistration\Auth;
use App\Message\Message;
use App\Utility\Utility;

$obj= new UserRegistration();
$currentUserId = 0;
if(isset($_SESSION['email'])){
    $obj->setData($_SESSION);
    $singleUser = $obj->view();
    $currentUserId = $singleUser->user_id;
}else{
    $currentUserId = 0;
}


$auth= new Auth();
$status = $auth->setData($_SESSION)->logged_in();

$objectSeller = new \App\Seller\Seller();

if(isset($_GET['subCategoryId'])){
    $productsBySubCategory = $objectSeller->productsBySubCategoryId($_GET['subCategoryId']);
}else{
    $_SESSION['subCategoryId']=$_POST['subCategoryId'];
    $_SESSION['subCategoryName']=$_POST['subCategoryName'];
    $productsBySubCategory = $objectSeller->productsBySubCategoryId($_SESSION['subCategoryId']);
}





//if(!$status) {
//    Utility::redirect('login.php');
//    return;
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/slick/slick.css">
    <!--===============================================================================================-->
<!--    <link rel="stylesheet" type="text/css" href="assets/noui/nouislider.min.css">-->

    <link rel="stylesheet" type="text/css" href="assets/jqueryui/jquery-ui.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="css/custom-style.css">

    <script type="text/javascript" src="assets/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="assets/jqueryui/jquery-ui.min.js"></script>

<!--    <script src="js/custom-js.js"></script>-->
</head>
<body class="animsition">

<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <!--<div class="topbar">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <span class="topbar-child1">
                Free shipping for standard order over $100
            </span>

            <div class="topbar-child2">
                <span class="topbar-email">
                    fashe@example.com
                </span>

                <div class="topbar-language rs1-select2">
                    <select class="selection-1" name="time">
                        <option>USD</option>
                        <option>EUR</option>
                    </select>
                </div>
            </div>
        </div>-->

        <div class="wrap_header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <img src="images/icons/logo.png" alt="IMG-LOGO">
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="index.php">Home</a>
                            <!--<ul class="sub_menu">
                                <li><a href="index.php">Homepage V1</a></li>
                                <li><a href="home-02.html">Homepage V2</a></li>
                                <li><a href="home-03.html">Homepage V3</a></li>
                            </ul>-->
                        </li>

                        <li>
                            <a href="product.php" class="active">Shop</a>
                        </li>

                        <li>
                            <a href="about.php">About</a>
                        </li>

                        <li>
                            <a href="contact.php">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">
                <?php
                if(!$status){
                    ?>
                    <a href="login.php" class="header-wrapicon1 dis-block">
                        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">Login
                    </a>
                    <?php
                }else{
                    ?>
                    <ul class="my-account-ul">
                        <li>
                                   <span class="header-wrapicon1 dis-block m-l-30">
                                <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                                       <?php
                                       echo $singleUser->first_name;
                                       ?>
                            </span>
                            <ul class="dropdown-ul">
                                <?php
                                if($singleUser->user_type=='user'){
                                    ?>
                                    <!--                                    <li><a href="my_account.php">My Account</a> </li>-->
                                    <li><a href="cart.php">My Cart</a> </li>
                                    <li><a href="authentication/logout.php">Logout</a> </li>
                                    <?php
                                }else{
                                    ?>
                                    <li><a href="seller_dashboard/seller_dashboard.php">Dashboard</a> </li>
                                    <li><a href="authentication/logout.php">Logout</a> </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                ?>


                <span class="linedivide1"></span>

                <?php

                ?>

                <a href="registration.php">Register</a>

                <?php
                $cart = $objectSeller->cartView($currentUserId);
                ?>

                <div class="header-wrapicon2">
                    <a href="cart.php">
                        <img src="images/icons/icon-header-02.png" class="header-icon1" alt="ICON">
                    </a>

                    <!-- Header cart noti -->
                    <!--						<div class="header-cart header-dropdown">-->
                    <!--							<ul class="header-cart-wrapitem">-->
                    <!--								<li class="header-cart-item">-->
                    <!--									<div class="header-cart-item-img">-->
                    <!--										<img src="images/item-cart-01.jpg" alt="IMG">-->
                    <!--									</div>-->
                    <!---->
                    <!--									<div class="header-cart-item-txt">-->
                    <!--										<a href="#" class="header-cart-item-name">-->
                    <!--											White Shirt With Pleat Detail Back-->
                    <!--										</a>-->
                    <!---->
                    <!--										<span class="header-cart-item-info">-->
                    <!--											1 x $19.00-->
                    <!--										</span>-->
                    <!--									</div>-->
                    <!--								</li>-->
                    <!---->
                    <!--								<li class="header-cart-item">-->
                    <!--									<div class="header-cart-item-img">-->
                    <!--										<img src="images/item-cart-02.jpg" alt="IMG">-->
                    <!--									</div>-->
                    <!---->
                    <!--									<div class="header-cart-item-txt">-->
                    <!--										<a href="#" class="header-cart-item-name">-->
                    <!--											Converse All Star Hi Black Canvas-->
                    <!--										</a>-->
                    <!---->
                    <!--										<span class="header-cart-item-info">-->
                    <!--											1 x $39.00-->
                    <!--										</span>-->
                    <!--									</div>-->
                    <!--								</li>-->
                    <!---->
                    <!--								<li class="header-cart-item">-->
                    <!--									<div class="header-cart-item-img">-->
                    <!--										<img src="images/item-cart-03.jpg" alt="IMG">-->
                    <!--									</div>-->
                    <!---->
                    <!--									<div class="header-cart-item-txt">-->
                    <!--										<a href="#" class="header-cart-item-name">-->
                    <!--											Nixon Porter Leather Watch In Tan-->
                    <!--										</a>-->
                    <!---->
                    <!--										<span class="header-cart-item-info">-->
                    <!--											1 x $17.00-->
                    <!--										</span>-->
                    <!--									</div>-->
                    <!--								</li>-->
                    <!--							</ul>-->
                    <!---->
                    <!--							<div class="header-cart-total">-->
                    <!--								Total: $75.00-->
                    <!--							</div>-->
                    <!---->
                    <!--							<div class="header-cart-buttons">-->
                    <!--								<div class="header-cart-wrapbtn">-->
                    <!--									<!-- Button -->
                    <!--									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">-->
                    <!--										View Cart-->
                    <!--									</a>-->
                    <!--								</div>-->
                    <!---->
                    <!--								<div class="header-cart-wrapbtn">-->
                    <!--									<!-- Button -->
                    <!--									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">-->
                    <!--										Check Out-->
                    <!--									</a>-->
                    <!--								</div>-->
                    <!--							</div>-->
                    <!--						</div>-->
                </div>
            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="index.php" class="logo-mobile">
            <img src="images/icons/logo.png" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <a href="#" class="header-wrapicon1 dis-block">
                    <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-01.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        White Shirt With Pleat Detail Back
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $19.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-02.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Converse All Star Hi Black Canvas
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $39.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-03.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Nixon Porter Leather Watch In Tan
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $17.00
										</span>
                                </div>
                            </li>
                        </ul>

                        <div class="header-cart-total">
                            Total: $75.00
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>

                        <div class="topbar-language rs1-select2">
                            <select class="selection-1" name="time">
                                <option>USD</option>
                                <option>EUR</option>
                            </select>
                        </div>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="index.php">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.php">Homepage V1</a></li>
                        <li><a href="home-02.html">Homepage V2</a></li>
                        <li><a href="home-03.html">Homepage V3</a></li>
                    </ul>
                    <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.php">Shop</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.php">Sale</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="cart.php">Features</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="blog.html">Blog</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="about.php">About</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/breadcrumb.jpg);">
    <h2 class="l-text2 t-center">
        <?php
        if(isset($_GET['subCategoryId'])) {
            echo $_GET['subCategoryName'];
        }else{
            echo $_SESSION['subCategoryName'];
        }
        ?>
    </h2>
    <p class="m-text13 t-center">
        Shop here!
    </p>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <?php echo "<pre>"; echo "</pre>";?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <?php
                    $categories = $objectSeller->viewCategory();
                    ?>
                    <h4 class="m-text14 p-b-7">
                        Categories
                    </h4>

                    <ul class="p-b-54">
                        <?php
                        foreach ($categories as $category){
                            $subCategories = $objectSeller->viewSubcategoryByCategoryId($category->category_id);
                            ?>
                            <li class="p-t-4">
                                <a href="category.php?categoryId=<?php echo $category->category_id ?>&categoryName=<?php echo $category->category_name;?>" class="s-text13">
                                    <?php echo $category->category_name; ?>
                                </a>

                                <?php
                                if($subCategories != false){
                                    foreach ($subCategories as $subCategory){
                                        ?>
                                        <ul class="padding-left-20">
                                            <li class="p-t-4">
                                                <a href="sub_category.php?subCategoryId=<?php echo $subCategory->sub_category_id;?>&subCategoryName=<?php echo $subCategory->sub_category_name; ?>" class="s-text17"><?php echo $subCategory->sub_category_name;?></a>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                }

                                ?>

                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <div class="filter-price p-t-22 p-b-50 bo3">
                        <div class="m-text15 p-b-17">
                            Filter by Price
                        </div>

                        <div id="slider-range"></div>

                        <div>
                            <label for="amount" class="sr-only"></label>
                            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <?php
                                    if(isset($_GET['subCategoryId'])){
                                        ?>
                                        <input type="hidden" name="subCategoryId" value="<?php echo $_GET['subCategoryId']?>">
                                        <input type="hidden" name="subCategoryName" value="<?php echo $_GET['subCategoryName']?>">
                                <?php
                                    }else{
                                        ?>
                                        <input type="hidden" name="subCategoryId" value="<?php echo $_SESSION['subCategoryId']?>">
                                        <input type="hidden" name="subCategoryName" value="<?php echo $_SESSION['subCategoryName']?>">
                                <?php
                                    }
                                ?>
                                Lowest
                                <input type="text" id="low-price" name="low_price" class="form-control" style="border:1px solid #838383!important; margin-bottom: 8px!important;">
                                Highest
                                <input type="text" id="high-price" name="high_price" class="form-control" style="border:1px solid #838383!important; margin-bottom:8px!important;">
                                <input type="submit" value="filter" name="filter" class="form-control" style="border:1px solid #838383!important;background-color:#838383!important;color:#ffffff!important;">
                            </form>
                        </div>
                    </div>

                    <!--  -->
                    <!--                    <h4 class="m-text14 p-b-32">-->
                    <!--                        Filters-->
                    <!--                    </h4>-->

                    <!--						<div class="filter-price p-t-22 p-b-50 bo3">-->
                    <!--							<div class="m-text15 p-b-17">-->
                    <!--								Price-->
                    <!--							</div>-->
                    <!---->
                    <!--							<div class="wra-filter-bar">-->
                    <!--								<div id="filter-bar"></div>-->
                    <!--							</div>-->
                    <!---->
                    <!--							<div class="flex-sb-m flex-w p-t-16">-->
                    <!--								<div class="w-size11">-->
                    <!--									<!-- Button -->
                    <!--									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">-->
                    <!--										Filter-->
                    <!--									</button>-->
                    <!--								</div>-->
                    <!---->
                    <!--								<div class="s-text3 p-t-10 p-b-10">-->
                    <!--									Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>-->
                    <!--								</div>-->
                    <!--							</div>-->
                    <!--						</div>-->


                    <!--						<div class="search-product pos-relative bo4 of-hidden">-->
                    <!--							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">-->
                    <!---->
                    <!--							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">-->
                    <!--								<i class="fs-12 fa fa-search" aria-hidden="true"></i>-->
                    <!--							</button>-->
                    <!--						</div>-->
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <!--					<div class="flex-sb-m flex-w p-b-35">-->
                <!--						<div class="flex-w">-->
                <!--							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">-->
                <!--								<select class="selection-2" name="sorting">-->
                <!--									<option>Price: low to high</option>-->
                <!--									<option>Price: high to low</option>-->
                <!--								</select>-->
                <!--							</div>-->
                <!---->
                <!--							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">-->
                <!--								<select class="selection-2" name="sorting">-->
                <!--									<option>Price</option>-->
                <!--									<option>$0.00 - $50.00</option>-->
                <!--									<option>$50.00 - $100.00</option>-->
                <!--									<option>$100.00 - $150.00</option>-->
                <!--									<option>$150.00 - $200.00</option>-->
                <!--									<option>$200.00+</option>-->
                <!---->
                <!--								</select>-->
                <!--							</div>-->
                <!--						</div>-->
                <!---->
                <!--<!--						<span class="s-text8 p-t-5 p-b-5">-->
                <!--<!--							Showing 1–12 of 16 results-->
                <!--<!--						</span>-->
                <!--					</div>-->

                <!-- Product -->
                <?php

                    if(isset($_POST['filter'])){
                        $low_price = $_POST['low_price'];
                        $high_price = $_POST['high_price'];
                        $low_price = trim($low_price, "$");
                        $high_price = trim($high_price, "$");
                        $subCategoryId = $_POST['subCategoryId'];

//                            echo $low_price;
                        $products = $objectSeller->product_filter_by_price_by_sub_category($low_price, $high_price, $subCategoryId);

                        if($products===false){
                            ?>
                            <div class="text-center" style="width:100%; padding-top:50px;">
                                <i class="fa fa-times" style="font-size:80px; color:#00aa88"></i>
                            </div>

                            <h1 class="text-center" style="padding-top:20px; width: 100%;">Sorry no Products available!</h1>
                            <div class="text-center" style="width:100%;">
                                <a style="margin-top:15px" href="product.php">back to the shop!</a>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="row">
                                <?php
                                //                    $products = $objectSeller->productView();
                                foreach($products as $product){
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                                <img src="Upload/<?php echo $product->picture;?>" alt="IMG-PRODUCT">

                                                <div class="block2-overlay trans-0-4">
                                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                    </a>

                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <form action="cart_process.php" method="post" class="cart-form" style="margin-left:10%;margin-right:10%;" id="<?php echo $product->product_id;?>">
                                                            <input type="hidden" name="productName" value="<?php echo $product->product_name; ?>">
                                                            <input type="hidden" name="productId" value="<?php echo $product->product_id;?>">
                                                            <input type="hidden" name="picture" value="<?php echo $product->picture?>">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <input type="hidden" name="totalPrice" value="<?php echo $product->price;?>">
                                                            <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                            <input type="hidden" name="userId" value="<?php echo $currentUserId; ?>">
                                                            <input type="submit" value="Add to Cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 addToCart" id="addToCart<?php echo $product->product_id;?>">
                                                        </form>
                                                        <script>
//                                                            var form = $("#<?php //echo $product->product_id;?>//");
//                                                            var formData = $(form).serialize();
//                                                            $(form).submit(function (event) {
//                                                                event.preventDefault();
//                                                                $.ajax({
//                                                                    type:'POST',
//                                                                    url: $(this).attr('action'),
//                                                                    data:formData
//                                                                })
//                                                                    .done(function (response) {
//                                                                        console.log('operation successful!');
//
//                                                                    })
//                                                                    .fail(function (message) {
//                                                                        alert('fail to add!')
//
//                                                                    });
//                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="block2-txt p-t-20">
                                                <a href="product-detail.php?productId=<?php echo $product->product_id; ?>" class="block2-name dis-block s-text3 p-b-5">
                                                    <?php echo $product->product_name; ?>
                                                </a>

                                                <span class="block2-price m-text6 p-r-5">
										$<?php echo $product->price;?>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }


                                ?>


                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="row">
                            <?php
                            //                    $products = $objectSeller->productView();
                            if($productsBySubCategory){
                                foreach($productsBySubCategory as $product){
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                                <img src="Upload/<?php echo $product->picture;?>" alt="IMG-PRODUCT">

                                                <div class="block2-overlay trans-0-4">
                                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                    </a>

                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <form action="cart_process.php" method="post" class="cart-form">
                                                            <input type="hidden" name="productName" value="<?php echo $product->product_name; ?>">
                                                            <input type="hidden" name="productId" value="<?php echo $product->product_id;?>">
                                                            <input type="hidden" name="picture" value="<?php echo $product->picture?>">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <input type="hidden" name="totalPrice" value="<?php echo $product->price;?>">
                                                            <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                            <input type="hidden" name="userId" value="<?php echo $singleUser->user_id; ?>">
                                                            <input type="submit" value="Add to Cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 addToCart" id="addToCart<?php echo $product->product_id;?>">
                                                        </form>
                                                        <!-- Button -->

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="block2-txt p-t-20">
                                                <a href="product-detail.php?productId=<?php echo $product->product_id; ?>" class="block2-name dis-block s-text3 p-b-5">
                                                    <?php echo $product->product_name; ?>
                                                </a>

                                                <span class="block2-price m-text6 p-r-5">
										$<?php echo $product->price;?>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }else{
                                ?>
                                <div class="text-center" style="width:100%; padding-top:50px;">
                                    <i class="fa fa-times" style="font-size:80px; color:#00aa88"></i>
                                </div>

                                <h1 class="text-center" style="padding-top:20px; width: 100%;">Sorry no Products available!</h1>
                                <div class="text-center" style="width:100%;">
                                    <a style="margin-top:15px" href="product.php">back to the shop!</a>
                                </div>

                                <?php
                            }


                            ?>


                        </div>
                        <?php
                    }


                ?>
<!--

                <!-- Pagination -->
                <!--					<div class="pagination flex-m flex-w p-t-26">-->
                <!--						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>-->
                <!--						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>-->
                <!--					</div>-->
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="flex-w p-b-90">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                GET IN TOUCH
            </h4>

            <div>
                <p class="s-text7 w-size27">
                    Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                </p>

                <div class="flex-m p-t-30">
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
                </div>
            </div>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Categories
            </h4>

            <ul>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Men
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Women
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Dresses
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Sunglasses
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Links
            </h4>

            <ul>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Search
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        About Us
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Contact Us
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Returns
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Help
            </h4>

            <ul>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Track Order
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Returns
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        Shipping
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="#" class="s-text7">
                        FAQs
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                Newsletter
            </h4>

            <form>
                <div class="effect1 w-size9">
                    <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                    <span class="effect1-line"></span>
                </div>

                <div class="w-size2 p-t-20">
                    <!-- Button -->
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Subscribe
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="t-center p-l-15 p-r-15">
        <a href="#">
            <img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
        </a>

        <a href="#">
            <img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
        </a>

        <a href="#">
            <img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
        </a>

        <a href="#">
            <img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
        </a>

        <a href="#">
            <img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
        </a>

        <div class="t-center s-text8 p-t-20">
            Copyright © 2018 All rights reserved. | This project is being made with <i class="fa fa-heart-o"
                                                                                       aria-hidden="true"></i> by Ahmed
        </div>
    </div>
</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>



<!--===============================================================================================-->
<!--<script type="text/javascript" src="assets/jquery/jquery-3.2.1.min.js"></script>-->
<!--===============================================================================================-->
<script type="text/javascript" src="assets/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="assets/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="assets/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="assets/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="assets/slick/slick.min.js"></script>
<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="assets/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    <?php
    if($currentUserId==0){
    ?>
    $('.block2-btn-addcart').each(function(){
//            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        var register_link = "<a href='registration.php'>register</a>";
        var span = document.createElement("span");
        $(span).addClass('style-span');
        span.innerHTML = "Plesse, <a href='registration.php'>register</a> to add product or <a href='login.php'>login here</a> ";
        $(this).on('click', function(){
            swal({
                title:"hello",
                content:span
            });
        });
    });
    <?php
    }else{
    ?>
    $('.block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        var price = $(this).parent().parent().parent().find('.block2-price').html();
        var contentDiv = document.createElement('div');
        contentDiv.innerHTML = "You have added (1 X"+price+")="+price+" into your cart";
        $(this).on('click', function(){
            swal({
                title:nameProduct,
                content: contentDiv
            });
        });
    });
    <?php
    }
    ?>


    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>

<!--===============================================================================================-->
<script type="text/javascript" src="assets/noui/nouislider.min.js"></script>
<script type="text/javascript">
    /*[ No ui ]
     ===========================================================*/
    var filterBar = document.getElementById('filter-bar');

    noUiSlider.create(filterBar, {
        start: [ 50, 200 ],
        connect: true,
        range: {
            'min': 50,
            'max': 200
        }
    });

    var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
    ];

    filterBar.noUiSlider.on('update', function( values, handle ) {
        skipValues[handle].innerHTML = Math.round(values[handle]) ;
    });
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
<!--<script src="js/custom-js.js"></script>-->
<!--    <script src="custom-js.js"></script>-->

<!--    <script>-->
<!--        $(document).ready(function () {-->
<!--            -->
<!--            $('.addToCart').on('click',function () {-->
<!--                // alert('I am clicked');-->
<!--                var cartForm = $('.cart-form');-->
<!--                var cartFormUrl = $(cartForm).attr('action');-->
<!--                var serializedData = $(cartForm).serialize();-->
<!--                $(cartForm).submit(function (event) {-->
<!--                    event.preventDefault();-->
<!---->
<!--                    $.ajax({-->
<!--                        type: 'POST',-->
<!--                        url: $(cartForm).attr('action'),-->
<!--                        data: serializedData-->
<!--                    })-->
<!---->
<!--                        .done(function(response) {-->
<!--                            // Make sure that the formMessages div has the 'success' class.-->
<!--                            // $(formMessages).removeClass('error');-->
<!--                            // $(formMessages).addClass('success');-->
<!--                            //-->
<!--                            // // Set the message text.-->
<!--                            // $(formMessages).text(response);-->
<!--                            //-->
<!--                            // // Clear the form.-->
<!--                            // $('#name').val('');-->
<!--                            // $('#email').val('');-->
<!--                            // $('#message').val('');-->
<!---->
<!--                            alert(response);-->
<!--                        })-->
<!---->
<!--                        .fail(function(data) {-->
<!--                            // Make sure that the formMessages div has the 'error' class.-->
<!--                            // $(formMessages).removeClass('success');-->
<!--                            // $(formMessages).addClass('error');-->
<!--                            //-->
<!--                            // // Set the message text.-->
<!--                            // if (data.responseText !== '') {-->
<!--                            //     $(formMessages).text(data.responseText);-->
<!--                            // } else {-->
<!--                            //     $(formMessages).text('Oops! An error occured and your message could not be sent.');-->
<!--                            // }-->
<!--                            alert(data.responseText);-->
<!--                        });-->
<!--                });-->
<!--            }); -->
<!--        });-->
<!--    </script>-->

</body>
</html>
