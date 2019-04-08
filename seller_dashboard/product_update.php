<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 06-06-18
 * Time: 21.57
 */

if(!isset($_SESSION) )session_start();
include_once('../vendor/autoload.php');
use App\UserRegistration\UserRegistration;
use App\Seller\Seller;
use App\UserRegistration\Auth;
use App\Message\Message;
use App\Utility\Utility;

$obj= new UserRegistration();
$obj->setData($_SESSION);
$singleUser = $obj->view();


$auth= new Auth();
$status = $auth->setData($_SESSION)->logged_in();

$objectSeller = new Seller();

$product = $objectSeller->singleProductViewByProductId($_GET['productId']);
//Utility::var_dump($product);

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
    <title>Update product</title>
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
<body>
<div class="container">
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

    <h3><a href="seller_dashboard.php">back to dashboard</a> </h3>
    <h2 class="">Update the information of this product</h2>
    <form class="form-group" method="post" action="../sellers_data_manipulation.php" enctype="multipart/form-data">
        <input type="hidden" name="productId" value="<?php echo $_GET['productId']; ?>"
        <div class="row">
<!--            <div class="col-sm-6 col-xs-12">-->
<!--                <div class="input-group">-->
<!--                    <span class="input-group-addon">Category</span>-->
<!--                    <input type="text" name="category" value="--><?php //echo $product->category_name;?><!--" class="form-control">-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Product Name</span>
                    <input type="text" name="name" class="form-control" value="<?php echo $product->product_name; ?>">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Width(inch)</span>
                    <input type="text" name="width" class="form-control" value="<?php echo $product->width; ?>" >
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Height(inch)</span>
                    <input type="text" name="height" class="form-control" value="<?php echo $product->height; ?>">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Weight(kg)</span>
                    <input type="text" name="weight" class="form-control" value="<?php echo $product->weight; ?>">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Picture</span>
                    <input type="file" name="picture" class="form-control">
                    <input type="hidden" name="picturePrev" value="<?php echo $product->picture;?>"
                    <img src="../Upload/<?php echo $product->picture;  ?>" style="width:150px;height:150px;">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Price($)</span>
                    <input type="text" name="price" class="form-control" value="<?php echo $product->price; ?>">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Sale Price($)</span>
                    <input type="text" name="salePrice" class="form-control" value="<?php echo $product->sale_price; ?>">
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="input-group">
                    <div class="">
                        Description
                    </div>
                    <textarea name="description" class="form-control" style="height:120px;width:100%;">
                        <?php echo $product->description; ?>
                    </textarea>
                </div>
            </div>
<!--            <div class="col-sm-6 col-xs-12">-->
<!--                <div class="input-group">-->
<!--                    <span class="input-group-addon">Stock</span>-->
<!--                    <input type="number" name="stock" class="form-control">-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-sm-12">
                <input type="submit" class="btn btn-primary" value="Update" name="update-product">
            </div>
        </div>
    </form>
</div>
</body>
</html>
