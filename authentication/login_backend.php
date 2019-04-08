<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 25-04-18
 * Time: 14.59
 */

if(!isset($_SESSION))session_start();
include_once('../vendor/autoload.php');

use App\Message\Message;
use App\Utility\Utility;

//if(!isset($_SESSION['url'])){
//    $lurl = array();
//}else{
//    $lurl = $_POST['redirectTo'];
//    $count = count($lurl);
//    $lurl[$count % 2] = $_SERVER['HTTP_REFERER'];
//    $_SESSION['url'] = $lurl;
//}

Utility::var_dump($_SESSION);
Utility::var_dump($_POST);
$auth= new \App\UserRegistration\Auth();

if($_POST['user_type']==='admin'){
    $status = $auth->setData($_POST);
    $data = $auth->admin_is_registered();

    if($data){
        $_SESSION['email'] = $_POST['email'];
        Utility::redirect("../seller_dashboard/admin_dashboard.php");
    }else{
        Utility::redirect("../index.php");
    }
}else{
    $status= $auth->setData($_POST);
    $data = $auth->is_registered();



    if($data){
        $_SESSION['email']=$_POST['email'];
//    $location = "../".$lurl;
        Message::message("<div class='alert alert-success'>
                            You have logged in successfully!
                </div>");
        Utility::redirect("../index.php");
    }else{
        Message::message("<div class='alert alert-success'>
                            Email or password is wrong!
                </div>");
        Utility::redirect("../login.php");
    }
}



//echo "data";
//Utility::var_dump($data);
//echo "data";

//if($data){
//    Utility::var_dump($data);
//    $_SESSION['email'] = $_POST['email'];
//    Message::message("
//                <div class=\"alert alert-success\">
//                            <strong>Welcome!</strong> You have successfully logged in.
//                </div>");
//
//    Utility::redirect('../index.php');
//
//}else{
//    Message::message("
//                <div class=\"alert alert-danger\">
//                            <strong>Wrong information!</strong> Please try again.
//                </div>");
//
//    Utility::redirect('../login.php');
//
//}


