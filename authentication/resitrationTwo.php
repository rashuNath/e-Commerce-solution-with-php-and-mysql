<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 24-04-18
 * Time: 23.14
 */

include_once ('../vendor/autoload.php');
require'../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//use App\BITM\SEIPXXXX\User\User;
//use App\BITM\SEIPXXXX\User\Auth;
use App\Message\Message;
use App\Utility\Utility;



$auth= new \App\UserRegistration\Auth();
$status= $auth->setData($_POST)->is_exist();
Utility::var_dump($_POST);
$yourGmailAddress = 'rashu.web@gmail.com';
$yourGmailPassword = 'rashuweb';

if(isset($_REQUEST['email'])) {

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
    $mail->SMTPDebug = 2;
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
    //Set who the message is to be sent from
    $mail->setFrom($yourGmailAddress, 'Rashu the developer');
    //Set an alternative reply-to address
    $mail->addReplyTo($yourGmailAddress, 'Rashu the developer');
    //Set who the message is to be sent to

    //echo $_REQUEST['email']; die();

    $mail->addAddress($_REQUEST['email']);
    //Set the subject line
    $mail->Subject = 'nothing';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    //Replace the plain text body with one created manually
//    $mail->AltBody = 'This is a plain-text message body';

  $mail->Body = "nothing in the body, here!";


    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        echo "you are fucked up!";
    } else {
        echo "mail has been sent";

//        Message::message("<strong>Success!</strong> Email has been sent successfully.");

        ?>
        <script type="text/javascript">
            // window.location.href = 'index.php';
        </script>
        <?php



    }

}

//if($status){
//    Message::setMessage("<div class='alert alert-danger'>
//    <strong>Taken!</strong> Email has already been taken. </div>");
//    return Utility::redirect($_SERVER['HTTP_REFERER']);
//}else{
//    $senderEmail = "raihanweb722@gmail.com";
//    $senderPassword = "webraihan";
//    $recipient = $_POST['email'];
//
//    $_POST['emailToken'] = md5(uniqid(rand()));
//
//    date_default_timezone_set('Etc/UTC');
//
//    $mail = new PHPMailer;
//    $mail->isSMTP();
//    $mail->SMTPDebug = 2;
//    $mail->Debugoutput = 'html';
//    $mail->Host = 'smtp.gmail.com';
//    $mail->port = 587;
//    $mail->SMTPSecure = 'tls';
//    $mail->SMTPAuth = 'true';
//    $mail->Username = $senderEmail;
//    $mail->Password = $senderPassword;
//    $mail->setFrom($senderEmail, 'user manager');
//    $mail->addReplyTo($senderEmail, 'user manager');
//    $mail->addAddress($_REQUEST['email']);
//    $mail->Subject = 'Verification link....';
//    $mail->AltBody = 'This is a plain text message body';
//    $message =  "Please click this link to verify your account:
//       http://localhost/UserManagement/views/SEIPXXXX/User/Profile/emailverification.php?email=".$_POST['email']."&email_token=".$_POST['emailToken'];
//    $mail->Body = $message;
//    if (!$mail->send()) {
//        echo "Mailer Error: " . $mail->ErrorInfo;
//    } else {
//        Message::message("<strong>Success!</strong> Email has been sent successfully.");
//        $objectUser = new \App\UserRegistration\UserRegistration();
//        $objectUser->setData($_POST)->store();
//
//        ?>
<!--        <script type="text/javascript">-->
<!--            window.location.href = 'index.php';-->
<!--        </script>-->
<!--        --><?php
//
//
//    }
//    $objectUser = new \App\UserRegistration\UserRegistration();
//    $objectUser->setData($_POST)->store();
//
//}
//
//
///*
//$_POST['email_token'] = md5(uniqid(rand()));
//$obj= new User();
//$obj->setData($_POST)->store();
//
//require '../../../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//$mail = new PHPMailer();
//$mail->IsSMTP();
//$mail->SMTPDebug  = 0;
//$mail->SMTPAuth   = true;
//$mail->SMTPSecure = "ssl";
//$mail->Host       = "smtp.gmail.com";
//$mail->Port       = 465;
//$mail->AddAddress($_POST['email']);
//$mail->Username="bitm.php47@gmail.com";
//$mail->Password="php47password";
//$mail->SetFrom('bitm.php47@gmail.com','User Management');
//$mail->AddReplyTo("bitm.php47@gmail.com","User Management");
//$mail->Subject    = "Your Account Activation Link";
//$message =  "Please click this link to verify your account:
//   http://localhost/UserManagement/views/SEIPXXXX/User/Profile/emailverification.php?email=".$_POST['email']."&email_token=".$_POST['email_token'];
//$mail->MsgHTML($message);
//$mail->Send();*/
////}
