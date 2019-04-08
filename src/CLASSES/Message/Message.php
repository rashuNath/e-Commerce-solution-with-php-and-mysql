<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 23-04-18
 * Time: 23.55
 */

namespace App\Message;

if(!isset($_SESSION)){
    session_start();
}
class Message
{
    public static function message($message=NULL){
        if(is_null($message)){
            $_message = self::getMessage();
            return $_message;
        }else{
            self::setMessage($message);
        }
    }

    public static function setMessage($message){
        $_SESSION['message']=$message;
    }

    public static function getMessage(){
        if(isset($_SESSION['message'])){
            $_message = $_SESSION['message'];
            return $_message;
        }else{
            $_message='';
            $_SESSION['message']='';
            return $_message;
        }
    }
}