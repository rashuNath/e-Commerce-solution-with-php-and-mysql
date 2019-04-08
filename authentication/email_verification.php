<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 28-04-18
 * Time: 14.19
 */

if(!isset($_SESSION) )session_start();
include_once('../vendor/autoload.php');

use App\UserRegistration\UserRegistration;
use App\Message\Message;
use App\Utility\Utility;

$obj= new UserRegistration();
$obj->setData($_GET);
$singleUser = $obj->view();


if($singleUser->email_verified == $_GET['email_token']) {
    $obj->setData($_GET);
    $obj->validTokenUpdate();
    $_SESSION['email'] = $_GET['email'];
}
else{

    if($singleUser->email_verified=='Yes'){
        Message::message("
             <div class=\"alert alert-info\">
             <strong>Don't worry! </strong>This email already verified. Please login!
              </div>");
        Utility::redirect("signup.php");
    }
    else{
        Message::message("
             <div class=\"alert alert-info\">
             <strong>Sorry! </strong>This Token is Invalid. Please signup with a valid email!
              </div>");
        Utility::redirect("signup.php");
    }
}