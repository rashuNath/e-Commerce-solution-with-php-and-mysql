<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 15-05-18
 * Time: 22.19
 */
if(!isset($_SESSION)){
    session_start();
}
include_once('vendor/autoload.php');

$objectSeller = new \App\Seller\Seller();

var_dump($_POST);
var_dump($_SESSION);
echo $_SESSION['email'];
$quantity = $_POST['quantity'];
$price = $_POST['totalPrice'];

$_POST['totalPrice'] = $price * $quantity;

$objectSeller->setCartData($_POST);

//if($status==TRUE){
//    echo "data setted!";
//}else{
//    echo "data has not been setted!";
//}

$status = $objectSeller->storeIntoCart();
echo $status;

if($status){
    echo "data inserted sucessfully!";
    header('Location:'.$_SERVER['HTTP_REFERER']);
}else{
    echo "something went wrong!";
}
