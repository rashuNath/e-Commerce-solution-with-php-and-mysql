
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
		Cart
	</h2>
</section>

<?php
    if($currentUserId==0){
        ?>
        <div class="text-center" style="width:100%; padding-top:50px;">
            <i class="fa fa-times" style="font-size:80px; color:#00aa88"></i>
        </div>
        <h2 class="text-center" style="padding-top:20px; width: 100%;">Please, <a href="registration.php" style="color:#e65540;font-size:2.5rem;">Register here</a> or <a href="login.php" style="color:#e65540;font-size:2.5rem;">login here.</a> </h2>
        <div class="text-center" style="width:100%; margin-bottom:50px;">
            <a style="margin-top:15px;font-size:2.rem;" href="product.php">And start shopping!</a>
        </div>
<?php
    }else {
        $cartItems = $objectSeller->cartView($currentUserId);
        $cartItemsNumber = count($cartItems);


//    var_dump($cartItems);
        ?>


        <!-- Cart -->
        <section class="cart bgwhite p-t-70 p-b-100">
            <form action="checkout_process.php" method="post">
                <div class="container">
                    <!-- Cart item -->
                    <?php

                    $serial = 1;
                    $total = 0;
                    $loopCounter = count($cartItems);
                    $order_number = rand();
                    $_POST['productId'] = array();
                    $_POST['totalPrice'] = array();
                    $_POST['soldCounter'] = array();
                    if ($cartItems != FALSE){

                    ?>
                    <div class="container-table-cart pos-relative">
                        <div class="wrap-table-shopping-cart bgwhite">
                            <table class="table-shopping-cart">
                                <tr class="table-head">
                                    <th class="column-1"></th>
                                    <th class="column-2">Product</th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4 p-l-70">Quantity</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                <?php
                                ?>
                                <?php


                                foreach ($cartItems as $item) {
                                    ?>
                                    <input type="hidden" name="productId[]" value="<?php echo $item->product_id; ?>">
                                    <tr class="table-row">
                                        <td class="column-1">
                                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                                <img src="Upload/<?php echo $item->picture; ?>" alt="IMG-PRODUCT">
                                            </div>
                                        </td>
                                        <td class="column-2"><?php echo $item->product_name; ?></td>
                                        <td class="column-3"><?php
                                            $per_price = $item->total_price/$item->quantity;
                                            echo $per_price;
                                        ?>
                                        </td>
                                        <td class="column-4">
                                            <div class="flex-w bo5 of-hidden w-size17">
                                                <!--                                            <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">-->
                                                <!--                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>-->
                                                <!--                                            </button>-->

                                                <input class="size8 m-text18 t-center num-product" type="number"
                                                       name="quantity[]" value="<?php echo $item->quantity; ?>">

                                                <!--                                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">-->
                                                <!--                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>-->
                                                <!--                                            </button>-->
                                            </div>
                                        </td>
                                        <td class="column-5"><?php echo $item->total_price; ?></td>
                                        <input type="hidden" name="totalPrice[]"
                                               value="<?php echo $item->total_price; ?>">
                                    </tr>
                                    <?php
                                    $total = $total + $item->total_price;
                                    $serial++;
                                }


                                ?>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="loopCounter" value="<?php echo $loopCounter; ?>">
                    <input type="hidden" name="userId" value="<?php echo $currentUserId; ?>">
                    <input type="hidden" name="orderNumber" value="<?php echo $order_number; ?>">
                    <input type="hidden" name="paidAmount" value="<?php echo $total; ?>">
                    <input type="hidden" name="paid" value="yes">

                    <!-- Total -->
                    <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                        <h5 class="m-text20 p-b-24">
<!--                            : <p-->
<!--                                    style="font-size:12px; color:#656565; display: inline; border:1px solid #656565;padding:10px;margin-left:10px;">-->
<!--                                Cash on Delivery</p>-->
                            Payment Type:
                            <select style="    display: block;
    width: 190px;
    float: right;
    font-size: 16px;
    font-weight: 400;" name="deliveryType" class="payment-type-select">
                                <option value="cashDelivery">Cash On Delivery</option>
                                <option value="bikashDelivery">Bikash Delivery</option>
                            </select>
                        </h5>

                        <div class="box display-none">
                            <p>Send the money to<strong> ( 019640999833 ) </strong> this number. and write down<strong> the transaction id into the input box below.</strong> One of our moderator will look up to your <strong>transaction id</strong> and let you know that wheather, your transaction is successfull or not, thankyou.</p>
                            <input type="text" class="form-control bo5 transaction-id" name="transaction-id">
                        </div>


                        <input type="hidden" value="cash on delivery" name="paymentType">
                        <h5 class="m-text20 p-b-24">
                            Cart Totals
                        </h5>

                        <!--  -->
                        <div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

                            <span class="m-text21 w-full-sm">
						<?php
                        echo $total;
                        ?>
					</span>
                        </div>


                        <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

                            <span class="m-text21 w-full-sm">
						<?php
                        echo $total;
                        ?>
					</span>

                            <span class="m-text21 w-full-sm">
						These products will be shipped to your address as soon as possible.
					</span>
                        </div>

                        <div class="size15 trans-0-4">
                            <!-- Button -->
                            <input type="submit" value="Proceed To Checkout" name="checkout"
                                   class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        </div>
                    </div>
                </div>

            </form>
            <?php
            } else {
                ?>
                <div class="text-center">
                    <i class="fa fa-cart-plus" style="font-size:80px; color:#00aa88;"></i>
                </div>
                <h2 class="text-center" style="margin-bottom:50px;margin-top:15px;">Your Cart is empty</h2>
                <?php
            }
            ?>

        </section>
        <?php
    }
?>



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



<script>
    $(document).ready(function () {
        $('.payment-type-select').change(function () {
            var selectedOption = $( ".payment-type-select option:selected" ).text();
            if(selectedOption==="Bikash Delivery"){
                $('.box').removeClass('display-none');
            }else{
                $('.box').addClass('display-none');
            }
        });
    });
</script>
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
