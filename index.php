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
$categories = $objectSeller->viewCategory();

//if(!$status) {
//    Utility::redirect('login.php');
//    return;
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>online store</title>
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
	<link rel="stylesheet" type="text/css" href="assets/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

    <link rel="stylesheet" type="text/css" href="css/custom-style.css">
<!--===============================================================================================-->
</head>
<body class="">

	<!-- header fixed -->
	<div class="wrap_header fixed-header2 trans-0-4">
		<!-- Logo -->
		<a href="index.php" class="logo">
			<img src="images/icons/logo.png" alt="IMG-LOGO">
		</a>

		<!-- Menu -->
		<div class="wrap_menu">
			<nav class="menu">
				<ul class="main_menu">
					<li>
						<a href="index.php" class="active">Home</a>
					</li>

					<li>
						<a href="product.php">Shop</a>
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

	<!-- top noti
	<div class="flex-c-m size22 bg0 s-text21 pos-relative">
		20% off everything!
		<a href="product.html" class="s-text22 hov6 p-l-5">
			Shop Now
		</a>

		<button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
			<i class="fa fa-remove fs-13" aria-hidden="true"></i>
		</button>
	</div>-->

	<!-- Header -->
	<header class="header2">
		<!-- Header desktop -->
		<div class="container-menu-header-v2 p-t-26">
			<div class="topbar2">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<!-- Logo2 -->
				<a href="index.php" class="logo2">
					<img src="images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<div class="topbar-child2">
					<span class="topbar-email">
						<a href="mailto:example@gmail.com">Mail to us!</a>
					</span>
                    <?php
                        if(!$status){
                            ?>
                            <a href="login.php" class="header-wrapicon1 dis-block m-l-30 my-account">
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
<!--                                            <li><a href="my_account.php">My Account</a> </li>-->
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

					<a href="registration.php">Register</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2 m-r-13">
                        <a href="cart.php">
                            <img src="images/icons/icon-header-02.png" class="header-icon1" alt="ICON">
                        </a>
					</div>
				</div>
			</div>

			<div class="wrap_header">

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="index.php" class="active">Home</a>
							</li>

							<li>
								<a href="product.php">Shop</a>
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

				</div>
			</div>
<!--		</div>-->

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
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								ahmed@example.com
							</span>
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
					</li>

					<li class="item-menu-mobile">
						<a href="product.php">Shop</a>
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

	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(images/master-slide-07.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
							Electronic Collections
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							New Collection 2018
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="product.php" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(images/master-slide-06.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rollIn">
							Mobile and Accessories
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="lightSpeedIn">
							New Collection 2018
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="product.php" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-image: url(images/master-slide-02.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
							Yor are going to love these!
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
							New Collection 2018
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
							<!-- Button -->
							<a href="product.php" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Banner -->
	<div class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
            <h3 class="m-text5 t-center margin-bottom-40">
                Our Products
            </h3>
			<div class="row">

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="Upload/<?Php echo $categories[0]->picture; ?>" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="category.php?categoryId=<?php echo $categories[0]->category_id; ?>&categoryName=<?php echo $categories[0]->category_name; ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $categories[0]->category_name; ?>
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="Upload/<?php echo $categories[1]->picture; ?>" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="category.php?categoryId=<?php echo $categories[1]->category_id; ?>&categoryName=<?php echo $categories[1]->category_name; ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $categories[1]->category_name;?>
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="Upload/<?php echo $categories[3]->picture;?>" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="category.php?categoryId=<?php echo $categories[2]->category_id; ?>&categoryName=<?php echo $categories[2]->category_name; ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								<?php echo $categories[3]->category_name; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





	<!-- Banner video -->
<!--	<section class="parallax0 parallax100" style="background-image: url(images/bottom_background.jpg);">-->
<!--		<div class="overlay0 p-t-190 p-b-200">-->
<!--			<div class="flex-col-c-m p-l-15 p-r-15">-->
<!--				<span class="m-text9 p-t-45 fs-20-sm">-->
<!--					The Beauty-->
<!--				</span>-->
<!---->
<!--				<h3 class="l-text1 fs-35-sm">-->
<!--					Lookbook-->
<!--				</h3>-->
<!--			</div>-->
<!--		</div>-->
<!--	</section>-->

	<!-- Blog -->
	<section class="blog bgwhite p-t-94 p-b-65">
		<div class="container">
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					Our Blog
				</h3>
			</div>

			<div class="row">
				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="images/blog-01.jpg" alt="IMG-BLOG">
						</a>

						<div class="block3-txt p-t-14">
							<h4 class="p-b-7">
								<a href="blog-detail.html" class="m-text11">
									Black Friday Guide: Best Sales & Discount Codes
								</a>
							</h4>

							<span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
							<span class="s-text6">on</span> <span class="s-text7">July 22, 2017</span>

							<p class="s-text8 p-t-16">
								Duis ut velit gravida nibh bibendum commodo. Sus-pendisse pellentesque mattis augue id euismod. Inter-dum et malesuada fames
							</p>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="images/blog-02.jpg" alt="IMG-BLOG">
						</a>

						<div class="block3-txt p-t-14">
							<h4 class="p-b-7">
								<a href="blog-detail.html" class="m-text11">
									The White Sneakers Nearly Every Fashion Girls Own
								</a>
							</h4>

							<span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
							<span class="s-text6">on</span> <span class="s-text7">July 18, 2017</span>

							<p class="s-text8 p-t-16">
								Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit ame
							</p>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="images/blog-03.jpg" alt="IMG-BLOG">
						</a>

						<div class="block3-txt p-t-14">
							<h4 class="p-b-7">
								<a href="blog-detail.html" class="m-text11">
									New York SS 2018 Street Style: Annina Mislin
								</a>
							</h4>

							<span class="s-text6">By</span> <span class="s-text7">Nancy Ward</span>
							<span class="s-text6">on</span> <span class="s-text7">July 2, 2017</span>

							<p class="s-text8 p-t-16">
								Proin nec vehicula lorem, a efficitur ex. Nam vehicula nulla vel erat tincidunt, sed hendrerit ligula porttitor. Fusce sit amet maximus nunc
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Instagram  -->

	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Free Delivery Worldwide
				</h4>

				<a href="#" class="s-text11 t-center">
					Click here for more info
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					30 Days Return
				</h4>

				<span class="s-text11 t-center">
					Simply return it within 30 days for an exchange.
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Store Opening
				</h4>

				<span class="s-text11 t-center">
					Shop open from Monday to Sunday
				</span>
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
                        <a href="category.php?categoryId=<?php echo $categories[0]->category_id; ?>&categoryName=<?php echo $categories[0]->category_name; ?>"  class="s-text7">
                            <?php echo $categories[0]->category_name; ?>
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="category.php?categoryId=<?php echo $categories[1]->category_id; ?>&categoryName=<?php echo $categories[1]->category_name; ?>"  class="s-text7">
                            <?php echo $categories[1]->category_name; ?>
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="category.php?categoryId=<?php echo $categories[2]->category_id; ?>&categoryName=<?php echo $categories[2]->category_name; ?>"  class="s-text7">
                            <?php echo $categories[2]->category_name; ?>
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="category.php?categoryId=<?php echo $categories[3]->category_id; ?>&categoryName=<?php echo $categories[0]->category_name; ?>"  class="s-text7">
                            <?php echo $categories[3]->category_name; ?>
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

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="w-full wrap-pic-w op-0-0"><img src="images/icons/video-16-9.jpg" alt="IMG"></div>
				<div class="video-mo-01">
					<iframe src="https://www.youtube.com/embed/Nt8ZrWY2Cmk?rel=0&amp;showinfo=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

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
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="assets/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="assets/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="assets/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="assets/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script type="text/javascript" src="assets/parallax100/parallax100.js"></script>
	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
