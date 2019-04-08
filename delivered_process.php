<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 9/9/2018
 * Time: 5:45 PM
 */

if(!isset($_SESSION)){
    session_start();
}
include_once('vendor/autoload.php');
require'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
use App\Utility\Utility;
use App\Message\Message;
use App\UserRegistration\UserRegistration;
use App\Seller\Seller;

$objectSeller = new Seller();

$status = $objectSeller->updateDeliveryStatus($_GET['orderId']);

Utility::redirect('seller_dashboard/order_completion.php');