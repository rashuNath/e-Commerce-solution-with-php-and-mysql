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
use App\UserRegistration\UserRegistration;
use App\Utility\Utility;
//if(isset($_POST['register'])){
//    Utility::var_dump($_POST);
//    $objectUser = new UserRegistration();
//    $status = $objectUser->setData($_POST);
//    echo $objectUser->getData();
//    $status = $objectUser->storeNew();
//    if($status){
//        echo "data stored";
//    }else{
//        echo "data has not been stored";
//    }
//}




$auth= new \App\UserRegistration\Auth();
$status= $auth->setData($_POST)->is_exist();
//Utility::var_dump($_POST);
if($status){
    Message::setMessage("<div class='alert alert-danger'>
    <strong>Taken!</strong> Email has already been taken. </div>");
    return Utility::redirect($_SERVER['HTTP_REFERER']);
}else{
    echo "email is new!";
    $yourGmailAddress = 'rashu.web@gmail.com';
    $yourGmailPassword = 'rashuweb';
    $recipient = $_POST['email'];

    $_POST['emailToken'] = md5(uniqid(rand()));

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
    $mail->addAddress($_REQUEST['email']);
    $mail->Subject = 'Verification link....';
    $mail->AltBody = 'This is a plain text message body';
    $message =  "Please click this link to verify your account:
       http://localhost/e_commerce/authentication/email_verification.php?email=".$_POST['email']."&email_token=".$_POST['emailToken'];
    $mail->Body = $message;
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        Message::message("<strong>Success!</strong> Email has been sent successfully.");
        $objectUser = new \App\UserRegistration\UserRegistration();
        $objectUser->setData($_POST);
        $status = $objectUser->storeNew();
    }
}


    /*
    $_POST['email_token'] = md5(uniqid(rand()));
    $obj= new User();
    $obj->setData($_POST)->store();

    require '../../../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->AddAddress($_POST['email']);
    $mail->Username="bitm.php47@gmail.com";
    $mail->Password="php47password";
    $mail->SetFrom('bitm.php47@gmail.com','User Management');
    $mail->AddReplyTo("bitm.php47@gmail.com","User Management");
    $mail->Subject    = "Your Account Activation Link";
    $message =  "Please click this link to verify your account:
       http://localhost/UserManagement/views/SEIPXXXX/User/Profile/emailverification.php?email=".$_POST['email']."&email_token=".$_POST['email_token'];
    $mail->MsgHTML($message);
    $mail->Send();*/
//}
