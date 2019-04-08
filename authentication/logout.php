<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 28-04-18
 * Time: 17.52
 */

if(!isset($_SESSION) )session_start();
include_once('../vendor/autoload.php');
use App\UserRegistration\UserRegistration;
use App\UserRegistration\Auth;
use App\Message\Message;
use App\Utility\Utility;


$auth= new Auth();
$status= $auth->log_out();

session_destroy();
session_start();

Message::message("
                <div class=\"alert alert-success\">
                            <strong>Logout!</strong> You have been logged out successfully.
                </div>");
return Utility::redirect('../index.php');