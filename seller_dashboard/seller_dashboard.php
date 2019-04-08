<?php
if(!isset($_SESSION))session_start();
include_once('../vendor/autoload.php');
use App\UserRegistration\UserRegistration;
use App\UserRegistration\Auth;
use App\Message\Message;
use App\Utility\Utility;

$obj= new UserRegistration();
//$obj->setData($_SESSION);
//$singleUser = $obj->view();

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Ela - Bootstrap Admin Dashboard Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
    <!-- Custom CSS -->

    <link href="css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="../css/custom-style.css" rel="stylesheet">
	
	
	
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">
                        <!-- Logo icon -->
                        <b><img src="images/logo.png" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>Visit the Site</span>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- Messages -->
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-th-large"></i></a>
                            <div class="dropdown-menu animated zoomIn">
                                <ul class="mega-dropdown-menu row">


                                    <li class="col-lg-3  m-b-30">
                                        <h4 class="m-b-20">CONTACT US</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email"> </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </li>
                                    <li class="col-lg-3 col-xlg-3 m-b-30">
                                        <h4 class="m-b-20">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                        </ul>
                                    </li>
                                    <li class="col-lg-3 col-xlg-3 m-b-30">
                                        <h4 class="m-b-20">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                        </ul>
                                    </li>
                                    <li class="col-lg-3 col-xlg-3 m-b-30">
                                        <h4 class="m-b-20">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Messages -->
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/users/5.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="#"><i class="ti-user"></i><?php echo $singleUser->first_name;?></a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> Balance <span class="badge pull-right">20</span> </a> </li>
<!--                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>-->
<!--                                    <li><a href="#"><i class="ti-settings"></i> Setting</a></li>-->
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="nav nav-tabs">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Dashboard</li>
                        <li class="nav-devider"></li>

                        <li class="padding-top-thirty"></li>

                        <li class="active"><a data-toggle="tab" href="#overview"><i class="fa fa-file"></i> Overview</a> </li>
                        <li class=""><a data-toggle="tab" href="#add-category"><i class="fa fa-file"></i> Add Category</a> </li>
                        <li class=""><a data-toggle="tab" href="#add-sub-category"><i class="fa fa-file"></i> Add Sub-category</a> </li>
                        <li class=""><a data-toggle="tab" href="#update-category"><i class="fa fa-file"></i> Update Category</a> </li>
                        <li class=""><a data-toggle="tab" href="#upload"><i class="fa fa-file"></i> Add Product</a> </li>
                        <li role="presentation" class=""><a data-toggle="tab" href="#edit"><i class="fa fa-file"></i> Update Product</a> </li>
                        <li role="presentation" class=""><a data-toggle="tab" href="#product-list"><i class="fa fa-file"></i> Active Product List </a> </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <?php  if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>

                    <div  id="message" class="form button"   style="font-size: smaller  " >
                        <center>
                            <?php if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
                                echo "&nbsp;".Message::message();
                            }
                            Message::message(NULL);
                            ?></center>
                    </div>
                <?php } ?>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="overview">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                                $email = $_SESSION['email'];
                                                $soldDataSeller = $objectSeller->viewSoldDataForSeller($email);
                                                $totalRevenue = 0;
                                                $saleNumber = 0;
                                                $serial = 0;
                                                foreach ($soldDataSeller as $data){
                                                    $totalRevenue = $totalRevenue+$data->total_price;
                                                    $saleNumber = $saleNumber+$data->sold_counter;
                                                    $serial++;
                                                }
                                            ?>
                                            <h2> <?php echo $totalRevenue; ?></h2>
                                            <p class="m-b-0">Total Revenue</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2><?php echo $saleNumber; ?></h2>
                                            <p class="m-b-0">Sales</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-md-3">-->
<!--                                <div class="card p-30">-->
<!--                                    <div class="media">-->
<!--                                        <div class="media-left meida media-middle">-->
<!--                                            <span><i class="fa fa-archive f-s-40 color-warning"></i></span>-->
<!--                                        </div>-->
<!--                                        <div class="media-body media-text-right">-->
<!--                                            <h2>25</h2>-->
<!--                                            <p class="m-b-0">Stores</p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-3">-->
<!--                                <div class="card p-30">-->
<!--                                    <div class="media">-->
<!--                                        <div class="media-left meida media-middle">-->
<!--                                            <span><i class="fa fa-user f-s-40 color-danger"></i></span>-->
<!--                                        </div>-->
<!--                                        <div class="media-body media-text-right">-->
<!--                                            <h2>847</h2>-->
<!--                                            <p class="m-b-0">Customer</p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>

<!--                        <div class="row bg-white m-l-0 m-r-0 box-shadow ">-->
<!---->
<!--                            <!-- column -->-->
<!--                            <div class="col-lg-8">-->
<!--                                <div class="card">-->
<!--                                    <div class="card-body">-->
<!--                                        <h4 class="card-title">Extra Area Chart</h4>-->
<!--                                        <div id="extra-area-chart"></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <!-- column -->
<!---->
<!--                            <!-- column -->
<!--                            <div class="col-lg-4">-->
<!--                                <div class="card">-->
<!--                                    <div class="card-body browser">-->
<!--                                        <p class="f-w-600">iMacs <span class="pull-right">85%</span></p>-->
<!--                                        <div class="progress ">-->
<!--                                            <div role="progressbar" style="width: 85%; height:8px;" class="progress-bar bg-danger wow animated progress-animated"> <span class="sr-only">60% Complete</span> </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <p class="m-t-30 f-w-600">iBooks<span class="pull-right">90%</span></p>-->
<!--                                        <div class="progress">-->
<!--                                            <div role="progressbar" style="width: 90%; height:8px;" class="progress-bar bg-info wow animated progress-animated"> <span class="sr-only">60% Complete</span> </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <p class="m-t-30 f-w-600">iPhone<span class="pull-right">65%</span></p>-->
<!--                                        <div class="progress">-->
<!--                                            <div role="progressbar" style="width: 65%; height:8px;" class="progress-bar bg-success wow animated progress-animated"> <span class="sr-only">60% Complete</span> </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <p class="m-t-30 f-w-600">Samsung<span class="pull-right">65%</span></p>-->
<!--                                        <div class="progress">-->
<!--                                            <div role="progressbar" style="width: 65%; height:8px;" class="progress-bar bg-warning wow animated progress-animated"> <span class="sr-only">60% Complete</span> </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <p class="m-t-30 f-w-600">android<span class="pull-right">65%</span></p>-->
<!--                                        <div class="progress m-b-30">-->
<!--                                            <div role="progressbar" style="width: 65%; height:8px;" class="progress-bar bg-success wow animated progress-animated"> <span class="sr-only">60% Complete</span> </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <!-- column -->
<!--                        </div>-->
                        <div class="row">
<!--                            <div class="col-lg-3">-->
<!--                                <div class="card bg-dark">-->
<!--                                    <div class="testimonial-widget-one p-17">-->
<!--                                        <div class="testimonial-widget-one owl-carousel owl-theme">-->
<!--                                            <div class="item">-->
<!--                                                <div class="testimonial-content">-->
<!--                                                    <img class="testimonial-author-img" src="images/avatar/2.jpg" alt="" />-->
<!--                                                    <div class="testimonial-author">John</div>-->
<!--                                                    <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>-->
<!---->
<!--                                                    <div class="testimonial-text">-->
<!--                                                        <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .-->
<!--                                                        <i class="fa fa-quote-right"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="item">-->
<!--                                                <div class="testimonial-content">-->
<!--                                                    <img class="testimonial-author-img" src="images/avatar/3.jpg" alt="" />-->
<!--                                                    <div class="testimonial-author">Abraham</div>-->
<!--                                                    <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>-->
<!---->
<!--                                                    <div class="testimonial-text">-->
<!--                                                        <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .-->
<!--                                                        <i class="fa fa-quote-right"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="item">-->
<!--                                                <div class="testimonial-content">-->
<!--                                                    <img class="testimonial-author-img" src="images/avatar/1.jpg" alt="" />-->
<!--                                                    <div class="testimonial-author">Lincoln</div>-->
<!--                                                    <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>-->
<!---->
<!--                                                    <div class="testimonial-text">-->
<!--                                                        <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .-->
<!--                                                        <i class="fa fa-quote-right"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="item">-->
<!--                                                <div class="testimonial-content">-->
<!--                                                    <img class="testimonial-author-img" src="images/avatar/4.jpg" alt="" />-->
<!--                                                    <div class="testimonial-author">TYRION LANNISTER</div>-->
<!--                                                    <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>-->
<!---->
<!--                                                    <div class="testimonial-text">-->
<!--                                                        <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .-->
<!--                                                        <i class="fa fa-quote-right"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="item">-->
<!--                                                <div class="testimonial-content">-->
<!--                                                    <img class="testimonial-author-img" src="images/avatar/5.jpg" alt="" />-->
<!--                                                    <div class="testimonial-author">TYRION LANNISTER</div>-->
<!--                                                    <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>-->
<!---->
<!--                                                    <div class="testimonial-text">-->
<!--                                                        <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .-->
<!--                                                        <i class="fa fa-quote-right"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="item">-->
<!--                                                <div class="testimonial-content">-->
<!--                                                    <img class="testimonial-author-img" src="images/avatar/6.jpg" alt="" />-->
<!--                                                    <div class="testimonial-author">TYRION LANNISTER</div>-->
<!--                                                    <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>-->
<!---->
<!--                                                    <div class="testimonial-text">-->
<!--                                                        <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .-->
<!--                                                        <i class="fa fa-quote-right"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
<!--                                        <h4>Recent Orders </h4>-->
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <!--<tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>quantity</th>
                                                    <th>Status</th>
                                                </tr>-->
                                                </thead>
                                                <tbody>
                                                <?php
                                                   /* $productSoldTable=$objectSeller->viewOrderDataBySellerId($singleUser->user_id);
//                                                    Utility::var_dump($productSoldTable);
                                                foreach($productSoldTable as $singleProduct){
                                                    $obj->setData($singleProduct);
                                                    $userName = $obj->view();
//                                                    echo "$userName->first_name";
                                                    */?>
                                                    <!--<tr>
                                                        <td>
                                                            <div class="round-img">
                                                                <a href=""><img src="images/avatar/4.jpg" alt=""></a>
                                                            </div>
                                                        </td>
                                                        <td>John Abraham</td>
                                                        <td><span>iBook</span></td>
                                                        <td><span>456 pcs</span></td>
                                                        <td><span class="badge badge-success">Done</span></td>
                                                    </tr>-->
                                                <?php/*
                                                }
                                                */?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>Message </h4>
                                            </div>
                                            <div class="recent-comment">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#"><img alt="..." src="images/avatar/1.jpg" class="media-object"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">john doe</h4>
                                                        <p>Cras sit amet nibh libero, in gravida nulla. </p>
                                                        <p class="comment-date">October 21, 2018</p>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#"><img alt="..." src="images/avatar/1.jpg" class="media-object"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">john doe</h4>
                                                        <p>Cras sit amet nibh libero, in gravida nulla. </p>
                                                        <p class="comment-date">October 21, 2018</p>
                                                    </div>
                                                </div>

                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#"><img alt="..." src="images/avatar/1.jpg" class="media-object"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">john doe</h4>
                                                        <p>Cras sit amet nibh libero, in gravida nulla. </p>
                                                        <p class="comment-date">October 21, 2018</p>
                                                    </div>
                                                </div>

                                                <div class="media no-border">
                                                    <div class="media-left">
                                                        <a href="#"><img alt="..." src="images/avatar/1.jpg" class="media-object"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">Mr. Michael</h4>
                                                        <p>Cras sit amet nibh libero, in gravida nulla. </p>
                                                        <div class="comment-date">October 21, 2018</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /# card -->
                                    </div>
                                    <!-- /# column -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="year-calendar"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

<!--                            <div class="col-lg-4">-->
<!--                                <div class="card">-->
<!--                                    <div class="card-body">-->
<!--                                        <h4 class="card-title">-->
<!--                                        <div class="card-content">-->
<!--                                            <div class="-->
<!--                                                <div class="tdl-holder">-->
<!--                                                    <div class="tdl-content">-->
<!--                                                        <ul>-->
<!--                                                            <li>-->
<!--                                                                <label>-->
<!--                                                                    <input type="checkbox"><i class="bg-primary"></i><span>Build an angular app</span>-->
<!--                                                                    <a href='#' class="ti-close"></a>-->
<!--                                                                </label>-->
<!--                                                            </li>-->
<!--                                                            <li>-->
<!--                                                                <label>-->
<!--                                                                    <input type="checkbox" checked><i class="bg-success"></i><span>Creating component page</span>-->
<!--                                                                    <a href='#' class="ti-close"></a>-->
<!--                                                                </label>-->
<!--                                                            </li>-->
<!--                                                            <li>-->
<!--                                                                <label>-->
<!--                                                                    <input type="checkbox" checked><i class="bg-warning"></i><span>Follow back those who follow you</span>-->
<!--                                                                    <a href='#' class="ti-close"></a>-->
<!--                                                                </label>-->
<!--                                                            </li>-->
<!--                                                            <li>-->
<!--                                                                <label>-->
<!--                                                                    <input type="checkbox" checked><i class="bg-danger"></i><span>Design One page theme</span>-->
<!--                                                                    <a href='#' class="ti-close"></a>-->
<!--                                                                </label>-->
<!--                                                            </li>-->
<!---->
<!--                                                            <li>-->
<!--                                                                <label>-->
<!--                                                                    <input type="checkbox" checked><i class="bg-success"></i><span>Creating component page</span>-->
<!--                                                                    <a href='#' class="ti-close"></a>-->
<!--                                                                </label>-->
<!--                                                            </li>-->
<!--                                                        </ul>-->
<!--                                                    </div>-->
<!--                                                    <input type="text" class="tdl-new form-control" placeholder="Type here">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                        </div>

                    </div>

                    <div  class="tab-pane" id="add-category">

                        <div class="">
                            <h2 class="">Add Category</h2>
                            <form id="addcategory" class="form-group" method="post" action="../sellers_data_manipulation.php" enctype="multipart/form-data">
<!--                                --><?php //$sellerId = $singleUser->user_id;
                                ?>
                                <input type="hidden" value="<?php echo $currentUserId; ?>" name="sellerId">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Category Name</span>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Picture</span>
                                            <input type="file" name="picture" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <div class="input-group">
                                            <div class="">
                                                <label for="description">Description</label>
                                            </div>
                                            <textarea name="description" id="description" class="form-control" style="height:120px;width:100%;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-primary" value="Add" name="add-category">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div  class="tab-pane" id="add-sub-category">
                        <div class="">
                            <h2 class="">Add Sub category</h2>
                            <?php
//                            echo
//                            $singleUser->user_id;

//                            $categoryNames = $objectSeller->categoryName($singleUser->user_id);
//                            var_dump($categoryNames);

                            ?>

                            <form class="form-group" method="post" action="../sellers_data_manipulation.php" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $currentUserId;?>" name="sellerId">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Category</span>
                                            <select class="form-control" name="category" style="height:42px;">
                                                <?php
                                                $categoryNames = $objectSeller->categoryName($currentUserId);
                                                foreach ($categoryNames as $categoryName){
                                                    ?>
                                                    <option value="<?php echo $categoryName->category_name; ?>"><?php echo $categoryName->category_name;?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sub-category Name</span>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">picture</span>
                                            <input type="file" name="picture" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="input-group">
                                            <div class="">
                                                <label for="description">Description</label>
                                            </div>
                                            <textarea name="description" class="form-control" style="height:120px;width:100%;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-primary" value="Add Sub-category" name="add-sub-category">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane" id="update-category">

                        <?php
//                        $sellerId = $singleUser->user_id;
                        $products = $objectSeller->categoryViewBySellerId($currentUserId);

                        if($products==FALSE){
                            echo "Yoh have not added any category yet!";
                        }else{
                            ?>
                            <table style="width: 100%">
                                <thead>
                                <tr style="text-align: center">
                                    <td>
                                        Picture
                                    </td>
                                    <td>Name</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <?php
                                foreach ($products as $product) {
                                    ?>

                                    <tr style="text-align: center">
                                        <td><img style="width:50px;height:80px;" src="../Upload/<?php echo $product->picture;?>"></td>
                                        <td><?php echo $product->category_name;?></td>
                                        <td><a href="category_update.php?categoryId=<?php echo $product->category_id; ?>">Update</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="tab-pane" id="upload">
                        <div class="">
                            <h2 class="">Add Products and Produce Your Revenue!</h2>
                            <form class="form-group" method="post" action="../sellers_data_manipulation.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Category</span>
                                            <select class="form-control" name="category" style="height:42px;">
                                                <?php
//                                                        $userId = $singleUser->user_id;
                                                        $categoryNames = $objectSeller->categoryName($currentUserId);
                                                        foreach ($categoryNames as $categoryName){
                                                            ?>
                                                            <option value="<?php echo $categoryName->category_name; ?>"><?php echo $categoryName->category_name;?></option>
                                                <?php
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sub Category</span>
                                            <select class="form-control" name="subCategory" style="height:42px;">
                                                <?php
//                                                $userId = $singleUser->user_id;
                                                $categoryNames = $objectSeller->subCategoryName($currentUserId);
                                                foreach ($categoryNames as $categoryName){
                                                    ?>
                                                    <option value="<?php echo $categoryName->sub_category_name; ?>"><?php echo $categoryName->sub_category_name;?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Product Name</span>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Width(inch)</span>
                                            <input type="text" name="width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Height(inch)</span>
                                            <input type="text" name="height" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Weight(kg)</span>
                                            <input type="text" name="weight" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Picture</span>
                                            <input type="file" name="picture" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Price($)</span>
                                            <input type="text" name="price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sale Price($)</span>
                                            <input type="text" name="salePrice" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="input-group">
                                            <div class="">
                                                <label for="description">Description</label>
                                            </div>
                                            <textarea name="description" class="form-control" style="height:120px;width:100%;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Stock</span>
                                            <input type="number" name="stock" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-primary" value="Add" name="add-product">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="tab-pane" id="edit">

                        <?php
//                        $sellerId = $singleUser->user_id;
                        $products = $objectSeller->productViewBySellerId($currentUserId);

                        if($products==FALSE){
                            echo "Yoh have not added any products yet!";
                        }else{
                            ?>
                            <table style="width: 100%">
                                <thead>
                                <tr style="text-align: center">
                                    <td>
                                        Picture
                                    </td>
                                    <td>Name</td>
                                    <td>price</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <?php
                                foreach ($products as $product) {
                                    ?>

                                    <tr style="text-align: center">
                                        <td><img style="width:50px;height:80px;" src="../Upload/<?php echo $product->picture?>"></td>
                                        <td><?php echo $product->product_name?></td>
                                        <td style="text-align: center;"><?php echo $product->price?></td>
                                        <td><a href="product_update.php?productId=<?php echo $product->product_id; ?>">Update</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        <?php
                        }
                        ?>

                    </div>

                    <div class="tab-pane" id="product-list">
                        <?php
//                        $sellerId = $singleUser->user_id;
                        $products = $objectSeller->productViewBySellerId($currentUserId);
                        if($products==FALSE){
                            echo "You currently don't have any active product!";
                        }else {
                            ?>
                            <table style="width: 100ch">
                            <thead>
                            <tr style="text-align: center">
                                <td>
                                    Picture
                                </td>
                                <td>Name</td>
                                <td>price</td>
                            </tr>
                            </thead>
                            <?php
                            foreach ($products as $product) {
                                ?>

                                    <tr style="text-align: center">
                                        <td><img style="width:50px;height:80px;" src="../Upload/<?php echo $product->picture?>"></td>
                                        <td><?php echo $product->product_name?></td>
                                        <td style="text-align: center;"><?php echo $product->price?></td>
                                    </tr>
                                <?php
                            }
                            ?>
                            </table>
                                <?php
                        }
                        ?>
                    </div>
                </div>

                <script>
                    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                        localStorage.setItem('activeTab', $(e.target).attr('href'));
                    });

                    // Acá guarda el index al cual corresponde la tab. Lo podés ver en el dev tool de chrome.
                    var activeTab = localStorage.getItem('activeTab');

                    // En la consola te va a mostrar la pestaña donde hiciste el último click y lo
                    // guarda en "activeTab". Te dejo el console para que lo veas. Y cuando refresques
                    // el browser, va a quedar activa la última donde hiciste el click.
                    console.log(activeTab);

                    if (activeTab) {
                        $('a[href="' + activeTab + '"]').tab('show');
                    }
                </script>


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->


    <!-- Amchart -->
     <script src="js/lib/morris-chart/raphael-min.js"></script>
    <script src="js/lib/morris-chart/morris.js"></script>
    <script src="js/lib/morris-chart/dashboard1-init.js"></script>


	<script src="js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="js/lib/calendar-2/pignose.init.js"></script>

    <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="js/scripts.js"></script>
    <!-- scripit init-->

    <script src="js/custom.min.js"></script>

    <script src="../js/jquery.form.min.js"></script>

    <script src="../js/custom-js.js"></script>

</body>

</html>