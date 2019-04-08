<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 23-04-18
 * Time: 23.27
 */

namespace App\UserRegistration;

use App\Message\Message;
use App\Utility\Utility;

use App\Database\Database as DB;
use PDO;
use PDOException;
use PDORow;
class UserRegistration extends DB{
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $id;
    public $email_token="";
    public $userType;

    public $name;
    public $message;
    public $leaveComment;

    public function setData($data){
       if(array_key_exists('first_name',$data)){
           $this->firstName = $data['first_name'];
       }
       if(array_key_exists('last_name',$data)){
           $this->lastName = $data['last_name'];
       }
       if(array_key_exists('email',$data)){
           $this->email = $data['email'];
       }
       if(array_key_exists('password',$data)){
           $this->password = $data['password'];
       }
       if(array_key_exists('phone',$data)){
           $this->phone = $data['phone'];
       }
       if(array_key_exists('address',$data)){
           $this->address = $data['address'];
       }
       if(array_key_exists('emailToken',$data)){
           $this->email_token = $data['emailToken'];
       }
       if(array_key_exists('user_type',$data)){
           $this->userType = $data['user_type'];
       }
    }

    public function getData(){
        return $this->firstName;
    }

    public function setContactData($data){
        if(array_key_exists('name',$data)){
            $this->name = $data['name'];
        }
        if(array_key_exists('phone-number',$data)){
            $this->phone = $data['phone-number'];
        }
        if(array_key_exists('email',$data)){
            $this->email = $data['email'];
        }
        if(array_key_exists('message',$data)){
            $this->message = $data['message'];
        }
    }

    public function storeReview($data){
        if(array_key_exists('userName',$data)){
            $userName = $data['userName'];
        }
        if(array_key_exists('productId',$data)){
            $poductId = $data['productId'];
        }
        if(array_key_exists('review',$data)){
            $review = $data['review'];
        }


        $dataArray = array($userName,$poductId,$review);
        $sql = "insert into product_review (user_name, product_id, review) values(?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }

    public function storeRatings($data){
        if(array_key_exists('userName',$data)){
            $userName = $data['userName'];
        }
        if(array_key_exists('productId',$data)){
            $poductId = $data['productId'];
        }
        if(array_key_exists('ratings',$data)){
            $review = $data['ratings'];
        }


        $dataArray = array($userName,$poductId,$review);
        $sql = "insert into product_rating (user_name, product_id, ratings) values(?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }

    public function viewRatings($productId){
        $sql = "select * from product_rating where product_id='".$productId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function viewReview($productId){
        $sql = "select * from product_review where product_id='".$productId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function storeComment(){
        $dataArray = array($this->name, $this->phone, $this->email, $this->message);
        $sql = "insert into comment (comment_name, phone, email, comment) values(?, ?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }



    public function storeNew(){
        $dataArray = array($this->firstName, $this->lastName, $this->email, $this->password, $this->phone, $this->address, $this->email_token, $this->userType);
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`,`phone`, `address`, `email_verified`, `user_type`) VALUES(?,?,?,?,?,?,?,?)";
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($dataArray);

        if($result){
            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Data has been stored successfully, Please check your email and active your account.
                </div>");
            return Utility::redirect($_SERVER['HTTP_REFERER']);
        }else{
            Message::message("
                <div class=\"alert alert-danger\">
                            <strong>Failed!</strong> Data has not been stored successfully. Please, try again!
                </div>");
            return Utility::redirect($_SERVER['HTTP_REFERER']);
        }
    }

//    SINGLE VIEW
    public function view(){
        $query="SELECT * FROM `users` WHERE `email` = '".$this->email."'";
        $result=$this->dbh->query($query);
        $data=$result->fetch(PDO::FETCH_OBJ);
        $row = $result->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }// end of view()
//    SINGLE VIEW




//VERIFYING AN USER
    public function validTokenUpdate(){
        $query="UPDATE `users` SET  `email_verified`='".'Yes'."' WHERE `users`.`email` =:email";
        $result=$this->dbh->prepare($query);
        $result->execute(array(':email'=>$this->email));

        if($result){
            Message::message("<div class=\"alert alert-success\">
             <strong>Success!</strong> Email verification has been successful. Please login now!
              </div>");
        }
        else {
            echo "Error";
        }
        return Utility::redirect('../login.php');
    }
//VERIFYING AN USER


    public function store() {
        $dataArray= array($this->firstName,$this->lastName,$this->password);

        $query="INSERT INTO `ahmed_ecommerce`.`admin`(`user_name`,`email`,`password`) VALUES(?,?,?)";

        $STH=$this->dbh->prepare($query);

        $result = $STH->execute($dataArray);
//        $result = $this->dbh->exec($query);

        if ($result) {
            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Data has been stored successfully.
                </div>");
//            return Utility::redirect($_SERVER['HTTP_REFERER']);
        } else {
            Message::message("
                <div class=\"alert alert-danger\">
                            <strong>Failed!</strong> Data has not been stored successfully.
                </div>");
//            return Utility::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function change_password(){
        $query="UPDATE `ahmed_ecommerce`.`users` SET `password`=:password  WHERE `users`.`email` =:email";
        $result=$this->dbh->prepare($query);
        $result->execute(array(':password'=>$this->password,':email'=>$this->email));

        if($result){
            Message::message("
             <div class=\"alert alert-info\">
             <strong>Success!</strong> Password has been updated  successfully.
              </div>");
        }
        else {
            echo "Error";
        }

    }


    public function update(){

        $query="UPDATE `ahmed_ecommerce`.`users` SET `first_name`=:firstName, `last_name` =:lastName ,  `email` =:email, `phone` = :phone,
 `address` = :address  WHERE `users`.`email` = :email";

        $result=$this->dbh->prepare($query);

        $result->execute(array(':firstName'=>$this->firstName,':lastName'=>$this->lastName,':email'=>$this->email,':phone'=>$this->phone,
            ':address'=>$this->address,':email_token'=>$this->email_token));

        if($result){
            Message::message("
             <div class=\"alert alert-info\">
             <strong>Success!</strong> Data has been updated  successfully.
              </div>");
        }
        else {
            echo "Error";
        }
        return Utility::redirect($_SERVER['HTTP_REFERER']);
    }

    public function usernameByUserid($userid){
        $sql = "select * from users where user_id = '".$userid."' ";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function userEmailByUserid($user_id){
        $sql = "select email from users where user_id = '".$user_id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

}