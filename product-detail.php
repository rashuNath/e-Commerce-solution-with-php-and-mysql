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

//PRODUCT DETAILS BY ID
$objectSeller->setGetData($_GET);
$singleProduct = $objectSeller->singleProductView();

$products = $objectSeller->productView();
//$productsByCategory = $objectSeller->productViewByCategory();
//echo 'hello';



//if(!$status) {
//    Utility::redirect('login.php');
//    return;
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail</title>
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
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/breadcrumb.jpg);">
	<h2 class="l-text2 t-center">
		<?php echo $singleProduct->product_name; ?>
	</h2>
</section>


<!-- Product Detail -->
<?php // if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>
<!---->
<!--    <div  id="message" class="form button"   style="font-size: smaller  " >-->
<!--        <center>-->
<!--            --><?php //if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
//                echo "&nbsp;".Message::message();
//            }
//            Message::message(NULL);
//            ?><!--</center>-->
<!--    </div>-->
<?php //} ?>

    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <img src="Upload/<?php echo $singleProduct->picture; ?>">

            </div>

            <div class="w-size14 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                    <?php echo $singleProduct->product_name; ?>
                    <?php
                    $product_id = $singleProduct->product_id;
                    $ratings = $obj->viewRatings($product_id);
                    ?>
                    <?php if($ratings){
                        $totalRatings = 0;
                        $serialRating = 0;
                        foreach ($ratings as $rating){
                            $totalRatings = $totalRatings + $rating->ratings;
                        }
//                                                    $ratingsArray = $ratings->ratings;
//                                                    $totalRatings = array_sum($ratingsArray);
                        $ratingsCounter = count($ratings);

                        $averageRatings = $totalRatings/$ratingsCounter;

                        ?>
                        <div><?php
                            for($i=1; $i<=$averageRatings;$i++){
                                ?>
                                <img src="images/rating_star.png" alt="icon" style="width:30px;">
                                <?php
                            }
                            ?>
                            <span class="badge custom-badge">
                                <?php
                                    echo $ratingsCounter;
                                ?>
                            </span>
                        </div>
                        <?php
                    }

                    ?>




                </h4>

                <span class="m-text17">
					$<?php echo $singleProduct->price; ?>

				</span>

                <p class="s-text8 p-t-10">
                    <?php echo $singleProduct->description; ?>
                </p>

                <!--  -->
                <div class="p-t-33 p-b-60">
                    <!--					<div class="flex-m flex-w p-b-10">-->
                    <!--						<div class="s-text15 w-size15 t-center">-->
                    <!--							Size-->
                    <!--						</div>-->
                    <!---->
                    <!--						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">-->
                    <!--							<select class="selection-2" name="size">-->
                    <!--								<option>Choose an option</option>-->
                    <!--								<option>Size S</option>-->
                    <!--								<option>Size M</option>-->
                    <!--								<option>Size L</option>-->
                    <!--								<option>Size XL</option>-->
                    <!--							</select>-->
                    <!--						</div>-->
                    <!--					</div>-->
                    <!---->
                    <!--					<div class="flex-m flex-w">-->
                    <!--						<div class="s-text15 w-size15 t-center">-->
                    <!--							Color-->
                    <!--						</div>-->
                    <!---->
                    <!--						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">-->
                    <!--							<select class="selection-2" name="color">-->
                    <!--								<option>Choose an option</option>-->
                    <!--								<option>Gray</option>-->
                    <!--								<option>Red</option>-->
                    <!--								<option>Black</option>-->
                    <!--								<option>Blue</option>-->
                    <!--							</select>-->
                    <!--						</div>-->
                    <!--					</div>-->
                    <form action="cart_process.php" method="post" style="margin-left:10%;margin-right:10%;">
                        <input type="hidden" name="userId" value="<?php echo $currentUserId; ?>">
                        <input type="hidden" name="productId" value="<?php echo $singleProduct->product_id; ?>">
                        <input type="hidden" name="picture" value="<?php echo $singleProduct->picture;?>">
                        <input type="hidden" name="productName" value="<?php echo $singleProduct->product_name;?>">
                        <input type="hidden" name="totalPrice" value="<?php echo $singleProduct->price;?>">
                    <div class="flex-r-m flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="quantity" value="1">

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                <input type="submit" value="Add to Cart" name="addToCArt" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <!--				<div class="p-b-45">-->
                <!--					<span class="s-text8 m-r-35">SKU: MUG-01</span>-->
                <!--					<span class="s-text8">Categories: Mug, Design</span>-->
                <!--				</div>-->

                <!--  -->
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Description
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            <?php echo $singleProduct->description; ?>
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Additional information
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Rate this product
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <div class="rating-stat">
                            <?php
                                $rating_stat = $objectSeller->ratingStat($_GET['productId']);

                                if($rating_stat===false){
                                    echo "this product has not been rated yet!";
                                }else{
//                                    var_dump($rating_stat);
                                    $loop_counter = 1;
                                    $twoStar = array();
                                    $threeStar = array();
                                    $oneStar = array();
                                    $fourStar = array();
                                    $fiveStar = array();
                                    foreach($rating_stat as $rating){
                                        if($rating->ratings=="1"){
//                                            echo "it is 1";
                                            array_push($oneStar,$rating);
                                        }
                                        if($rating->ratings=="2"){
//                                            echo "it is 2";
                                            array_push($twoStar, $rating);
                                        }
                                        if($rating->ratings=="3"){
//                                            echo "it is 3";
                                            array_push($threeStar,$rating);
                                        }
                                        if($rating->ratings=="4"){
//                                            echo "it is 4";
                                            array_push($fourStar,$rating);
                                        }
                                        if($rating->ratings=="5"){
//                                            echo "it is 5";
//                                            $fiveStar[$loop_counter]=1;
                                            array_push($fiveStar,$rating);
                                        }


                                        $loop_counter++;
                                    }

//                                    echo count($threeStar)." user rated this product.";
//                                    echo count($rating_stat)." user rated this product.";

                                    ?>
                                    <div>
                                    <?php
                                    if(count($oneStar)>0){
//                                        echo "<p>".count($oneStar). " user has given one star</p>";
                                        ?>
                            <div style="inline-block">
                                <?php
                                        for($i=1; $i<=1; $i++){
                                            ?>

                                            <img src="images/rating_star.png" alt="icon" style="width:30px;">
                            <?php

                                        }
                                ?>
                            </div>
                                        <span class="badge custom-badge"><?php echo count($oneStar);
                                        ?>
                                        </span>
                                        <?php
                                    }

                                    ?>
                                    </div>
                                    <div>
                                        <?php

                                    if(count($twoStar)>0){
//                                        echo "<p>".count($oneStar). " user has given one star</p>";
                                        ?>
                                        <div style="display:inline-block">
                                            <?php
                                            for($i=0; $i<=1; $i++){
                                                ?>

                                                <img src="images/rating_star.png" alt="icon" style="width:30px;">
                                                <?php

                                            }
                                            ?>
                                        </div>
                                        <span class="badge custom-badge"><?php echo count
                                            ($twoStar); ?></span>
                                        <?php
                                    }

                                        ?>
                                    </div>
                                    <div>
                                        <?php

                                    if(count($threeStar)>0){
//                                        echo "<p>".count($oneStar). " user has given one star</p>";
                                        ?>
                                        <div style="display:inline-block">
                                            <?php
                                            for($i=0; $i<=2; $i++){
                                                ?>

                                                <img src="images/rating_star.png" alt="icon" style="width:30px;">
                                                <?php

                                            }
                                            ?>
                                        </div>
                                        <span class="badge custom-badge"><?php echo count
                                            ($threeStar); ?></span>
                                        <?php
                                    }
                                        ?>
                                    </div>
                                    <div>
                                        <?php

                                    if(count($fourStar)>0){
//                                        echo "<p>".count($oneStar). " user has given one star</p>";
                                        ?>
                                        <div style="display:inline-block">
                                            <?php
                                            for($i=0; $i<=3; $i++){
                                                ?>

                                                <img src="images/rating_star.png" alt="icon" style="width:30px;">
                                                <?php

                                            }
                                            ?>
                                        </div>
                                        <span class="badge custom-badge"><?php echo count
                                            ($fourStar); ?></span>
                                        <?php
                                    }
                                        ?>
                                    </div>
                                    <div>
                                        <?php

                                    if(count($fiveStar)>0){
//                                        echo "<p>".count($oneStar). " user has given one star</p>";
                                        ?>
                                        <div style="display:inline-block">
                                            <?php
                                            for($i=0; $i<=4; $i++){
                                                ?>

                                                <img src="images/rating_star.png" alt="icon" style="width:30px;">
                                                <?php

                                            }
                                            ?>
                                        </div>
                                        <span class="badge custom-badge"><?php echo count
                                            ($fiveStar); ?></span>
                                        <?php
                                    }
                                        ?>
                                    </div>
                                        <?php

                                }
                            ?>
                        </div>
                        <form action="ratings.php" method="post" class="reviewForm">
                            <h2>Give Your Ratings Here:</h2>
                            Name:
                            <?php if($currentUserId==0){
                                ?>
                                <input type="text" name="userName" class="form-control" style="border:1px solid #838383!important; margin-bottom: 8px!important;" autofocus>
                                <?php

                            }else{
                                ?>
                                <input type="text" name="userName" class="form-control" style="border:1px solid #838383!important; margin-bottom: 8px!important;" value="<?php echo $singleUser->first_name;?>">
                                <?php

                            } ?>

                            <input type="hidden" name="productId" value="<?php echo $_GET['productId']; ?>" >

                            Give Your Rating:
                            <br>
                            <input type="radio" value="1" name="ratings">One star
                            <input type="radio" value="2" name="ratings">Two star
                            <input type="radio" value="3" name="ratings">Three star
                            <input type="radio" value="4" name="ratings">Four Star
                            <input type="radio" value="5" name="ratings">Five Star
                            <input type="submit" value="Send" name="send" class="form-control sendReview" style="border:1px solid #838383!important;background-color:#838383!important;color:#ffffff!important;">
                        </form>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <?php
                        $reviews = $obj->viewReview($_GET['productId']);

                        if(!$reviews){
                            ?>
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                                Reviews (0)
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>
                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <?php
                        }else{
                            $reviewsCounter = count($reviews);
                            ?>
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                                Reviews (<?php echo $reviewsCounter; ?>)
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>
                    <?php
                            foreach ($reviews as $review){
                                ?>
                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="m-text19">Name: <span class="s-text8"><?php echo $review->user_name;?></span> </p>
                        <p class="m-text19">
                            Review: <span class="s-text8"> <?php echo $review->review; ?> </span>
                        </p>
                    <?php
                            }
                        }
                    ?>



                        <form action="review.php" method="post" class="reviewForm">
                            <h2>Give Your Review Here:</h2>
                            Name:
                            <?php if($currentUserId==0){
                                ?>
                                <input type="text" name="userName" class="form-control" style="border:1px solid #838383!important; margin-bottom: 8px!important;" autofocus>
                                <?php

                            }else{
                                ?>
                                <input type="text" name="userName" class="form-control" style="border:1px solid #838383!important; margin-bottom: 8px!important;" value="<?php echo $singleUser->first_name;?>">
                            <?php

                            } ?>

                            <input type="hidden" name="productId" value="<?php echo $_GET['productId']; ?>" >

                            Give Your Review:
                            <textarea name="review" class="form-control" style="border:1px solid #838383!important; margin-bottom:8px!important;" rows="5"></textarea>
                            <input type="submit" value="Send" name="send" class="form-control sendReview" style="border:1px solid #838383!important;background-color:#838383!important;color:#ffffff!important;">
                        </form>
                    </div>
                </div>
            </div>





        </div>
    </div>





	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

                    <?php
//                        $loopCounter = 0;
//                        $objectSeller->setGetData($_GET);
//                        $productFromCategoryByProductId = $objectSeller->productFromCategoryByProductId();
//                        var_dump($productFromCategoryByProductId);
                    $status = $objectSeller->setGetData($_GET);
                    $productsFromCategory = $objectSeller->productFromCategoryByProductId();
                    $numberOfProduct = count($productsFromCategory);

                            if($productsFromCategory>1) {
                                foreach($productsFromCategory as $product) {
                                    if($product->product_id!=$_GET['productId']) {

                                        ?>
                                        <div class="item-slick2 p-l-15 p-r-15">
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
                                                                <input type="hidden" name="productName" value="<?php echo $product->product_name; ?>" id="productName<?php echo $product->product_id; ?>">
                                                                <input type="hidden" name="productId" value="<?php echo $product->product_id;?>">
                                                                <input type="hidden" name="picture" value="<?php echo $product->picture?>">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="totalPrice" value="<?php echo $product->price;?>">
                                                                <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                                <input type="hidden" name="userId" value="<?php echo $currentUserId; ?>">
                                                                <input type="submit" value="Add to Cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 addToCart" id="addToCart<?php echo $product->product_id;?>">
                                                            </form>
                                                            <script>
                                                                //                                                                var form = $("#<?php //echo $product->product_id;?>//");
                                                                //                                                                var formData = $(form).serialize();
                                                                //                                                                var productName = $('#productName<?php //echo $product->product_id; ?>//');
                                                                //                                                                $(form).submit(function (event) {
                                                                //                                                                    event.preventDefault();
                                                                //                                                                    $.ajax({
                                                                //                                                                        type:'POST',
                                                                //                                                                        url: $(this).attr('action'),
                                                                //                                                                        data:formData
                                                                //                                                                    })
                                                                //                                                                        .done(function (response) {
                                                                //                                                                            console.log('operation is successful!');
                                                                //                                                                            console.log(formData);
                                                                //                                                                            console.log(productName);
                                                                //
                                                                //                                                                        })
                                                                //                                                                        .fail(function (message) {
                                                                //                                                                            alert('fail to add!')
                                                                //
                                                                //                                                                        });
                                                                //                                                                });
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
                                }
                            }else{
                                ?>
                                <h2 style="text-align: center; width:100%;">No related product found</h2>
                    <?php
                            }




                    ?>

<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">-->
<!--								<img src="images/item-02.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Herschel supply co 25l-->
<!--								</a>-->
<!---->
<!--								<span class="block2-price m-text6 p-r-5">-->
<!--									$75.00-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative">-->
<!--								<img src="images/item-03.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!---->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Denim jacket blue-->
<!--								</a>-->
<!---->
<!--								<span class="block2-price m-text6 p-r-5">-->
<!--									$92.50-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative">-->
<!--								<img src="images/item-05.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!---->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Coach slim easton black-->
<!--								</a>-->
<!---->
<!--								<span class="block2-price m-text6 p-r-5">-->
<!--									$165.90-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">-->
<!--								<img src="images/item-07.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!---->
<!--										<button class="flex-c-m sze1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Frayed denim shorts-->
<!--								</a>-->
<!---->
<!--								<span class="block2-oldprice m-text7 p-r-5">-->
<!--									$29.50-->
<!--								</span>-->
<!---->
<!--								<span class="block2-newprice m-text8 p-r-5">-->
<!--									$15.90-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">-->
<!--								<img src="images/item-02.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!---->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Herschel supply co 25l-->
<!--								</a>-->
<!---->
<!--								<span class="block2-price m-text6 p-r-5">-->
<!--									$75.00-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative">-->
<!--								<img src="images/item-03.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!---->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Denim jacket blue-->
<!--								</a>-->
<!---->
<!--								<span class="block2-price m-text6 p-r-5">-->
<!--									$92.50-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative">-->
<!--								<img src="images/item-05.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!---->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Coach slim easton black-->
<!--								</a>-->
<!---->
<!--								<span class="block2-price m-text6 p-r-5">-->
<!--									$165.90-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="item-slick2 p-l-15 p-r-15">-->
<!---->
<!--						<div class="block2">-->
<!--							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">-->
<!--								<img src="images/item-07.jpg" alt="IMG-PRODUCT">-->
<!---->
<!--								<div class="block2-overlay trans-0-4">-->
<!--									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">-->
<!--										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>-->
<!--										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>-->
<!--									</a>-->
<!---->
<!--									<div class="block2-btn-addcart w-size1 trans-0-4">-->
<!--										-->
<!--										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--											Add to Cart-->
<!--										</button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="block2-txt p-t-20">-->
<!--								<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">-->
<!--									Frayed denim shorts-->
<!--								</a>-->
<!---->
<!--								<span class="block2-oldprice m-text7 p-r-5">-->
<!--									$29.50-->
<!--								</span>-->
<!---->
<!--								<span class="block2-newprice m-text8 p-r-5">-->
<!--									$15.90-->
<!--								</span>-->
<!--							</div>-->
<!--						</div>-->
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
	<script type="text/javascript" src="assets/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
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

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

    <script src="js/custom-js.js"></script>

</body>
</html>
