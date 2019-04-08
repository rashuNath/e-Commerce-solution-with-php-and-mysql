<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 16-05-18
 * Time: 23.41
 */

if(!isset($_SESSION)){
    session_start();
}
include_once('vendor/autoload.php');
require'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
use App\Utility\Utility;
use App\Message\Message;
use App\UserRegistration\UserRegistration;

var_dump($_SESSION);
$recipient=$_SESSION['email'];

$deliveryType = $_POST['deliveryType'];
$transaction = $_POST['transaction-id'];
$date = time();
$_POST['soldDate']= $date;
$_SESSION['soldDate'] = $date;

if($transaction===""){
    $_POST['transaction-id']="cash";
}

if($deliveryType==="bikashDelivery"){
    $_SESSION['paymentType'] = "Bikash";
    $yourGmailAddress = 'rashu.web@gmail.com';
    $yourGmailPassword = 'rashuweb';
    echo $recipient;
    $recipient = $recipient;

    $_POST['transaction-Id'] = $_POST['transaction-id'];

    date_default_timezone_set('Etc/UTC');

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    $mail->isSMTP();
    //Tell PHPMailer to use SMTP
    //$mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 465; //587
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'ssl'; //tls
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $yourGmailAddress;
    //Password to use for SMTP authentication
    $mail->Password = $yourGmailPassword;
    $mail->setFrom($yourGmailAddress, 'e_commerce');
    $mail->addReplyTo($yourGmailAddress, 'e_commerce');
    $mail->addAddress($recipient);
    $mail->Subject = 'Payment Verification....';
    $mail->AltBody = 'This is a plain text message body';
    $message =  "thank you for your order. You will be notified as soon as possible whether your transaction was successfull or not. Thank you!";
    $mail->Body = $message;
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
//        Message::message("<strong>Success!</strong> Email has been sent successfully.");
//        $objectUser = new \App\UserRegistration\UserRegistration();
//        $objectUser->setData($_POST);
//        $status = $objectUser->storeNew();

        echo "mail send";



    }
}else{
    $_SESSION['paymentType'] = "Cash";
    $yourGmailAddress = 'rashu.web@gmail.com';
    $yourGmailPassword = 'rashuweb';
    echo $recipient;
    $recipient = $recipient;

    $_POST['transaction-Id'] = $_POST['transaction-id'];

    date_default_timezone_set('Etc/UTC');

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    $mail->isSMTP();
    //Tell PHPMailer to use SMTP
    //$mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 465; //587
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'ssl'; //tls
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $yourGmailAddress;
    //Password to use for SMTP authentication
    $mail->Password = $yourGmailPassword;
    $mail->setFrom($yourGmailAddress, 'e_commerce');
    $mail->addReplyTo($yourGmailAddress, 'e_commerce');
    $mail->addAddress($recipient);
    $mail->Subject = 'Order Notification....';
    $mail->AltBody = 'This is a plain text message body';
    $message =  "thank you for your order. Your product will be shiped to the given address by you. Be ready there with the payment. Thank you!";
    $mail->Body = $message;
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
//        Message::message("<strong>Success!</strong> Email has been sent successfully.");
//        $objectUser = new \App\UserRegistration\UserRegistration();
//        $objectUser->setData($_POST);
//        $status = $objectUser->storeNew();

        echo "mail send";



    }
}
//echo $_POST['transactionId'];

echo "<pre>";
var_dump($_POST);
echo "</pre>";


$objectSeller = new \App\Seller\Seller();

$status = $objectSeller->setOrderData($_POST);
$status = $objectSeller->setProductSoldData($_POST);




$status = $objectSeller->storeOrder();



$deleteStatus = $objectSeller->deleteOrderDataFromCart();
//if($deleteStatus){
//    echo "deleted";
//}else{
//    echo "not deleted";
//}
if($deleteStatus){

//Utility::var_dump($status);
    $status = $objectSeller->storeIntoProductSold($_SESSION['email']);
    header('Location:thankyou.php');
}else{
    header("Location:cart.php");
}
