<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 24-04-18
 * Time: 23.21
 */

namespace App\UserRegistration;

use App\Message\Message;
use App\Utility\Utility;

if(!isset($_SESSION) )  session_start();


use App\Database\Database as DB;
use PDO;
use PDOException;
use PDORow;
class Auth extends DB{

    public $email = "";
    public $password = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function setData($data){
        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }
        if (array_key_exists('password', $data)) {
            $this->password = $data['password'];
        }
        return $this;
    }

    public function is_exist(){

        $query="SELECT * FROM `users` WHERE `users`.`email` =:email";
        $STH=$this->dbh->prepare($query);
        $STH->execute(array(':email'=>$this->email));

        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function is_registered(){
        $dataArray = array($this->email, $this->password);
        $query = "SELECT * FROM `users` WHERE `email_verified`='Yes' AND `email`='".$this->email."' AND `password` ='".$this->password."'";
        $sth=$this->dbh->query($query);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $data = $sth->fetchAll();
        $count = $sth->rowCount();

        if ($count > 0) {
////            header('location:'.$_SERVER['HTTP_REFERER']);
//            $location = $redirectTo['redirectTo'];
//            $_SESSION['email'] = $this->email;
//            Message::message("<div class='alert alert-success'>
//                            You have logged in successfully!
//                </div>");
//            Utility::redirect($location);
            return $data;
        } else {
                return FALSE;
        }
    }


    public function admin_is_registered(){
        $query = "SELECT * FROM `users` WHERE `email_verified`='Yes' AND `email`='".$this->email."' AND `password` ='".$this->password."' AND `user_type`='admin'";
        $sth=$this->dbh->query($query);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $data = $sth->fetchAll();
        $count = $sth->rowCount();
        if($count>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function logged_in(){
        if ((array_key_exists('email', $_SESSION)) && (!empty($_SESSION['email']))) {
//            Utility::redirect($_SERVER['HTTP_REFERER']);
//            header('location:'.$_SERVER['HTTP_REFERER']);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function log_out(){
        $_SESSION['email']="";
        return TRUE;
    }

    public function viewUserById($user_id){
        $sql = "select * from users where user_id = '".$user_id."'";
        $sth = $this->dbh->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $data = $sth->fetchAll();
        $count = $sth->rowCount();

        if($count>0){
            return $data;
        }else{
            return FALSE;
        }
    }
}
