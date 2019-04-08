
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
    $firstName = $singleUser->first_name;
    $lastName = $singleUser->last_name;
}else{
    $currentUserId = 0;
}


$auth= new Auth();
$status = $auth->setData($_SESSION)->logged_in();

$objectSeller = new \App\Seller\Seller();

$orderDetails = $objectSeller->order_details($_SESSION['soldDate']);


//Utility::var_dump($_POST);


//if(!$status) {
//    Utility::redirect('login.php');
//    return;
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
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
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <style>
        .table-div table tr td{
            padding:5px;
        }
        .table-div table tr td:last-child{
            text-align:right;
        }
        .table-div table tr:nth-child(odd) td{
            background-color:#f5f5f5;
        }
        .table-div table tr:last-child{
            padding-top:10px;
            padding-bottom:10px;
            font-weight:600;
            color:#202020;
            background-color: rgba(32, 32, 32, 0.27);
        }
    </style>
    <!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="css/custom-style.css">
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
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
    <h2 class="l-text2 t-center">
        Thanks
    </h2>
</section>

<?php
$cartItems = $objectSeller->cartView($currentUserId);
//    var_dump($cartItems);
?>


<!-- Cart -->
<section class="text-center cart bgwhite p-t-70 p-b-100">
    <i class="fa fa-check-circle" style="font-size:80px; color:#00aa88"></i>
    <h1 style="margin-bottom:30px;">Thank You!</h1>

    <h4 style="margin-bottom:15px;">Your order has been recieved.</h4>






    <div class="row" style="padding-top:50px;width:800px; margin: 0 auto;">
        <div class="col-sm-6">
            <h2 style="margin-bottom:20px;">Pickup Location</h2>
            <h5 style="margin-bottom:8px">Name : <span style="font-size:18px"><?php echo $firstName
                        ." ".$lastName;
                    ?></span></h5>
            <h5 style="margin-bottom:8px">Phone: <span style="font-size:18px"><?php echo $singleUser->phone; ?></span></h5>

            <h5 style="margin-bottom:8px">Address: <span style="font-size:18px"><?php echo $singleUser->address;
                    ?></span></h5>
        </div>
        <div class="col-sm-6">
            <h2 style="margin-bottom:20px;">Payment Method:</h2>
            <h5 style="margin-bottom:8px">Order Number: <span style="font-size:18px;"><?php
                    echo $orderDetails[0]->order_number;
                    ?></span> </h5>
            <h5> <?php echo $_SESSION['paymentType']; ?></h5>

        </div>
    </div>

    <div class="order-details container" style="padding-top:30px">
        <div class="table-div" style="width:500px; margin:0 auto;">
            <table class="table-responsive" style="width:100%;">
                <tr>
                    <td><h4>Serial</h4></td>
                    <td><h4>Product Name</h4></td>
                    <td><h4>Quantity</h4></td>
                    <td><h4>Price</h4></td>
                </tr>
                <?php
                $serial = 1;
                $totalPrice =0;
                foreach($orderDetails as $order){
                    $singleProduct = $objectSeller->singleProductViewByProductId
                    ($order->product_id);
                    ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $singleProduct->product_name; ?></td>
                        <td><?php echo $order->sold_counter; ?></td>
                        <td><?php echo $order->total_price; ?></td>
                    </tr>
                    <?php
                    $totalPrice = $totalPrice+$order->total_price;
                    $serial++;
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td><?php echo $totalPrice ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div style="padding-top:50px;">
        <h5 style="margin-bottom:10px; color:rgba(76,103,255,0.77)">Your order is pending for approval!</h5>
        <h4>Your products will be arrived to your address as soon as possible.</h4>

        <h4 style="text-decoration: underline">Please visit your <strong>Mail Inbox</strong> for further information.</h4>

        <h2 style="margin-top:30px;">Happy Shopping!</h2>
        <a href="product.php">back to the shop!</a>
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
<script type="text/javascript" src="assets/jquery/jquery-3.2.1.min.js"></script>
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
<script src="js/main.js"></script>

</body>
</html>
