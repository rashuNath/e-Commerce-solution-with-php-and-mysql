<?php
require_once ('vendor/autoload.php');

$objTest = new \App\UserRegistration\UserRegistration();

$objTest->set_data();

$sum = $objTest->get_data();

echo "the sum is $sum";