<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 05-06-18
 * Time: 23.38
 */
if(!isset($_SESSION) )session_start();
include_once('vendor/autoload.php');
use App\UserRegistration\UserRegistration;
use App\UserRegistration\Auth;
use App\Message\Message;
use App\Utility\Utility;

$objectUserRegistration = new UserRegistration();
$status = $objectUserRegistration->storeReview($_POST);

if($status==true){
    echo "review stored successfully";
    Message::message("Thanks for your review");
    $location = $_SERVER['HTTP_REFERER'];
    Utility::redirect($location);
}else{
    echo "something went wrong!";
}