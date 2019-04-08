<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 9/9/2018
 * Time: 3:34 PM
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
$objectAuth = new UserRegistration();

$recipient = $objectAuth->userEmailByUserid($_GET['userId']);
var_dump($recipient);
$recipient = $recipient->email;
echo $recipient;

if($_GET['status']=="approve"){
    $status = $objectSeller->updatePaymentStatus($_GET['orderId']);

    if($status===true) {

        //informing to the client
        $yourGmailAddress = 'rashu.web@gmail.com';
        $yourGmailPassword = 'rashuweb';
//    $recipient = $recipient;

//        $_POST['transaction-Id'] = $_POST['transaction-id'];

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
        $message = "Payment for your order Completed sucessfully. You will be receiving your product within 5 days. Thanks.";
        $mail->Body = $message;
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo "Mail has not been sent!!";
        } else {
//        Message::message("<strong>Success!</strong> Email has been sent successfully.");
//        $objectUser = new \App\UserRegistration\UserRegistration();
//        $objectUser->setData($_POST);
//        $status = $objectUser->storeNew();

            echo "mail send";
            Utility::redirect("seller_dashboard/pending_orders.php");

        }
        //informing to the client
//        echo "approved";
    }


}else{
//    echo "rejected";
    $status = $objectSeller->deleteFromOrderList($_GET['orderId']);
    if($status===true) {

        //informing to the client
        $yourGmailAddress = 'rashu.web@gmail.com';
        $yourGmailPassword = 'rashuweb';
//    $recipient = $recipient;

//        $_POST['transaction-Id'] = $_POST['transaction-id'];

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
        $mail->Subject = 'Order Information....';
        $mail->AltBody = 'This is a plain text message body';
        $message = "Sorry, your order has been declined. Please order again. You will be receiving your product within 5 days. Thanks.";
        $mail->Body = $message;
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo "Mail has not been sent!!";
        } else {
//        Message::message("<strong>Success!</strong> Email has been sent successfully.");
//        $objectUser = new \App\UserRegistration\UserRegistration();
//        $objectUser->setData($_POST);
//        $status = $objectUser->storeNew();

            echo "mail send";
            Utility::redirect("seller_dashboard/pending_orders.php");

        }
        //informing to the client
//        echo "approved";
    }
}