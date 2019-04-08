<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 18-05-18
 * Time: 14.42
 */
if(!isset($_SESSION) )session_start();
include_once('vendor/autoload.php');

use App\Utility\Utility;
use App\Message\Message;

Utility::var_dump($_POST);

$objectUserRegistration = new \App\UserRegistration\UserRegistration();

$objectUserRegistration->setContactData($_POST);

$status = $objectUserRegistration->storeComment();

if($status){
    echo "data stored!";
}else{
    echo "data has not been stored!";
}

