<?php
include_once('vendor/autoload.php');

if(!isset($_SESSION) )session_start();
use App\Message\Message;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="css/form-elements.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom-style.css">
</head>
<body>
<!-- Top content -->
<div class="top-content">
    <div class="container" >
        <table>
            <tr>
                <td width='230' >

                <td width='600' height="50" >


                    <?php  if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>

                        <div  id="message" class="form button"   style="font-size: smaller  " >
                            <center>
                                <?php if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
                                    echo "&nbsp;".Message::message();
                                }
                                Message::message(NULL);
                                ?></center>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        </table>

        <div class="container text-center">
            <div class="registration-box m-auto">
                <div class="form-box" style="margin-top: 0%; margin-bottom:100px;">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Sign up now</h3>
                            <p>Fill in the form below to get instant access:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="authentication/registration.php" method="POST" class="registration-form">
                            <div class="form-group">
                                <label class="" for="form-first_name">First name</label>
                                <input type="text" name="first_name" placeholder="First name..." class="form-first-name form-control" id="form-first-name">
                            </div>
                            <div class="form-group">
                                <label class="" for="form-last-name">Last name</label>
                                <input type="text" name="last_name" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">
                            </div>
                            <div class="form-group">
                                <label class="" for="form-email">Email</label>
                                <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="form-email">
                            </div>

                            <div class="form-group">
                                <label class="" for="form-password">Password</label>
                                <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                            </div>
                            <div class="form-group">
                                <label class="">User Role</label>
                                <select class="form-control form-select" name="user_type">
                                    <option value="----">-----------------</option>
                                    <option value="user">Buyer</option>
                                    <option value="seller">Seller</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="" for="form-email">Phone</label>
                                <input type="text" name="phone" placeholder="Phone..." class="form-phone form-control" id="form-phone">
                            </div>
                            <div class="form-group">
                                <label class="" for="address">Address</label>
                                <input type="text" name="address" placeholder="Address..." class="form-address form-control" id="form-address">
                            </div>
                            <button type="submit" name="register" class="btn">Sign me up!</button>
                        </form>

                        <div class="">
                            <a href="index.php" class="pull-left">Home</a>
                            <a href="login.php" class="pull-right">Already registered! Login here...</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    $('.alert').slideDown("slow").delay(5000).slideUp("slow");
</script>
</body>
</html>