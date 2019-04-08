<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 05-06-18
 * Time: 19.58
 */

if(!isset($_SESSION)){
    session_start();
}
include_once('vendor/autoload.php');
use App\Utility;


$objectSeller = new \App\Seller\Seller();
Utility\Utility::var_dump($_POST);