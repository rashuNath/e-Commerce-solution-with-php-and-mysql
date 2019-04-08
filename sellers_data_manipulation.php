<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 05-05-18
 * Time: 02.20
 */
if(!isset($_SESSION)){
    session_start();
}
include_once('vendor/autoload.php');

use App\Message\Message;
use App\Utility\Utility;

$objectSeller = new \App\Seller\Seller();
$_POST['email']=$_SESSION['email'];


var_dump($_FILES);
$hasPicture = $_FILES['picture']['name'];
if($hasPicture===""){
    $_POST['picture']= $_POST['picturePrev'];
}else{
    $file_name = time().$_FILES['picture']['name'];
    $_POST['picture']=$file_name;

    $source=$_FILES['picture']['tmp_name'];
    $destination = "Upload/$file_name";
    move_uploaded_file($source,$destination);

}

$timestamp = time();

$_POST['entryDate'] = date('Y-m-d',$timestamp);


if(isset($_POST['add-category'])){
    $objectSeller->setData($_POST);
    $objectSeller->storeCategory($_POST['sellerId']);
}

if(isset($_POST['add-sub-category'])){
    $objectSeller->setData($_POST);
    $objectSeller->storeSubCategory($_POST['sellerId']);
}

if(isset($_POST['add-product'])){
    $objectSeller->setData($_POST);
//    echo $objectSeller->emailReturn();
    $categoryId = $objectSeller->storeProduct();
}

if(isset($_POST['update-product'])){
    $objectSeller->setData($_POST);
    $objectSeller->updateProduct($_POST['productId']);
}

if(isset($_POST['update-category'])){
    $objectSeller->setData($_POST);
    $objectSeller->updateCategory();
}