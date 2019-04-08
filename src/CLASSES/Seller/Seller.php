<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 05-05-18
 * Time: 01.14
 */

namespace App\Seller;

use App\Message\Message;
use App\Utility\Utility;
use App\Database\Database as DB;
use PDO, PDOException, PDORow;

class Seller extends DB
{
    public $productId;
    public $category;
    public $name;
    public $width;
    public $height;
    public $weight;
    public $description;
    public $picture;
    public $price;
    public $salePrice;
    public $entryDate;
    public $stock;

    public $quantity;
    public $totalPrice;
    
    public $email;
    public $userId;

    public $loopCounter;

    public $product_id=array();
    public $user_id = array();
    public $total_price = array();
    public $sold_counter = array();

    public $orderNumber;
    public $paidAmount;
    public $paid;

    public $categoryId;

    public $subCategory;

    public $transationId="cash";

    public $soldDate;

    public function setCategoryGetData($data){
        if(array_key_exists('categoryId',$data)){
            $this->categoryId = $data['categoryId'];
        }
    }

    public function setGetData($data){
        if(array_key_exists('productId',$data)){
            $this->productId = $data['productId'];
        }
    }
    public function setData($data){
        if(array_key_exists('subCategory',$data)){
            $this->subCategory = $data['subCategory'];
        }
        if(array_key_exists('productId',$data)){
            $this->productId = $data['productId'];
        }
        if(array_key_exists('categoryId',$data)){
            $this->categoryId = $data['categoryId'];
        }
        if(array_key_exists('category',$data)){
            $this->category = $data['category'];
        }
        if(array_key_exists('name',$data)){
            $this->name = $data['name'];
        }
        if(array_key_exists('width',$data)){
            $this->width = $data['width'];
        }
        if(array_key_exists('height',$data)){
            $this->height = $data['height'];
        }
        if(array_key_exists('weight',$data)){
            $this->weight = $data['weight'];
        }
        if(array_key_exists('description',$data)){
            $this->description = $data['description'];
        }
        if(array_key_exists('picture',$data)){
            $this->picture = $data['picture'];
        }
        if(array_key_exists('price',$data)){
            $this->price = $data['price'];
        }
        if(array_key_exists('salePrice',$data)){
            $this->salePrice = $data['price'];
        }
        if(array_key_exists('email',$data)){
            $this->email = $data['email'];
        }
        if(array_key_exists('entryDate',$data)){
            $this->entryDate = $data['entryDate'];
        }
        if(array_key_exists('stock',$data)){
            $this->stock = $data['stock'];
        }
    }

    public function setCartData($data){
        if(array_key_exists('email',$data)){
            $this->email = $data['email'];
        }
        if(array_key_exists('productId',$data)){
            $this->productId = $data['productId'];
        }
        if(array_key_exists('productName',$data)){
            $this->name = $data['productName'];
        }
        if(array_key_exists('picture',$data)){
            $this->picture = $data['picture'];
        }
        if(array_key_exists('quantity',$data)){
            $this->quantity = $data['quantity'];
        }
        if(array_key_exists('totalPrice',$data)){
            $this->totalPrice = $data['totalPrice'];
        }
        if(array_key_exists('userId',$data)){
            $this->userId = $data['userId'];
        }
    }

    public function setProductSoldData($data){
        if(array_key_exists('loopCounter',$data)){
            $this->loopCounter = $data['loopCounter'];
        }
        if(array_key_exists('orderNumber',$data)){
            $this->orderNumber = $data['orderNumber'];
        }
        if(array_key_exists('soldDate',$data)){
            $this->soldDate = $data['soldDate'];
        }
        for($i=0; $i<$this->loopCounter; $i++){
            if(array_key_exists("productId",$data)){
                $this->product_id[$i] = $data['productId'][$i];
            }
            if(array_key_exists("quantity",$data)){
                $this->sold_counter[$i] = $data['quantity'][$i];
            }
            if(array_key_exists('totalPrice',$data)){
                $this->total_price[$i] = $data['totalPrice'][$i];
            }
        }
        return $this->product_id;
    }


    public function setOrderData($data){
        if(array_key_exists('userId',$data)){
            $this->userId = $data['userId'];
        }
        if(array_key_exists('orderNumber',$data)){
            $this->orderNumber = $data['orderNumber'];
        }
        if(array_key_exists('paidAmount',$data)){
            $this->paidAmount = $data['paidAmount'];
        }
        if(array_key_exists('paid',$data)){
            $this->paid = $data['paid'];
        }
        if(array_key_exists('transaction-id',$data)){
            $this->transationId = $data['transaction-id'];
        }
    }

    public function storeOrder(){
        $dataArray = array($this->userId, $this->orderNumber, $this->paidAmount, $this->transationId, "no");
        $sql = "insert into orders (user_id, order_number, paid_amount, paid, delivered) values (?, ?, ?, ?,?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }

    public function storeIntoProductSold($userEmail){
        $sql = "select user_id from users where email ='".$userEmail."'";
        $sth = $this->dbh->query($sql);
        $buyerId = $sth->fetch(PDO::FETCH_OBJ);

        $status=FALSE;
        for($i=0; $i<$this->loopCounter; $i++){
            $sql = "select vendor_id from products where product_id='".$this->product_id[$i]."'";
            $sth = $this->dbh->query($sql);
            $user_id = $sth->fetch(PDO::FETCH_OBJ);

            $dataArray = array($this->product_id[$i], $buyerId->user_id, $this->orderNumber, $this->sold_counter[$i], $user_id->vendor_id, $this->total_price[$i],$this->soldDate);
            $sql = "insert into product_sold (product_id, user_id, order_number, sold_counter, vendor_id, total_price,sold_date) values (?,?, ?, ?, ?,?,?)";
            $sth = $this->dbh->prepare($sql);
            $status = $sth->execute($dataArray);
        }
        return $status;
    }

    public function storeIntoCart(){
        $dataArray = array($this->userId, $this->productId, $this->name, $this->picture, $this->quantity, $this->totalPrice);
        $sql = "insert into cart (user_id, product_id, product_name, picture, quantity, total_price ) values (?, ?, ?, ?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);
        return $status;
    }


    public function storeCategory($sellerId){
        $sql = "SELECT * FROM category where category_name = '".$this->name."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        if($data->category_name==$this->name){
            Message::message('This category has already been taken.');
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }else{
            $data = array($this->name, $this->description, $this->picture, $sellerId);
            $sql = 'INSERT INTO `category` (`category_name`,`description`,`picture`,`vendor_id`) VALUES (?, ?, ?,?)';
            $sth = $this->dbh->prepare($sql);
            $status = $sth->execute($data);

            if($status){
                Message::message("<div class='alert alert-success'>
                            Category has been added successfully.
                </div>");
                Utility::redirect($_SERVER['HTTP_REFERER']);
            }else{
                Message::message("<div class='alert alert-danger'>
                            Category has not been added!
                </div>");
                Utility::redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    public function updateCategory(){
        $dataArray = array($this->name, $this->description, $this->picture);
        $sql = "update category set category_name=?, description=?, picture=? where category_id='".$this->categoryId."'";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);

        if($status){
            Message::message("<div class='alert alert-success'>
                            Category has been Updated successfully.
                </div>");
            $location = "seller_dashboard/seller_dashboard.php";
            Utility::redirect($location);
        }else{
            Message::message("<div class='alert alert-danger'>
                            Something went wrong!
                </div>");
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function storeSubCategory($sellerId){
        $sql = "select category_id from category where category_name = '".$this->category."'";
        $sth = $this->dbh->query($sql);
        $categoryId = $sth->fetch(PDO::FETCH_OBJ);

        $dataArray = array($this->name, $categoryId->category_id, $this->picture,$sellerId);
        $sql = "insert into sub_category (sub_category_name, category_id, picture, vendor_id) values(?, ?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);

        if($status){
            Message::message("<div class='alert alert-success'>
                            Sub category has been added successfully.
                </div>");
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }else{
            Message::message("<div class='alert alert-danger'>
                            Sub category has not been added!
                </div>");
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function storeProduct(){
        $sql = "select category_id from category where category_name = '".$this->category."'";
        $sth = $this->dbh->query($sql);
        $categoryId = $sth->fetch(PDO::FETCH_OBJ);

        $sql = "select sub_category_id from sub_category where sub_category_name = '".$this->subCategory."'";
        $sth = $this->dbh->query($sql);
        $subCategoryId = $sth->fetch(PDO::FETCH_OBJ);

        $sql = "select user_id from users where email = '".$this->email."' and user_type = 'seller'";
        $sth = $this->dbh->query($sql);
        $sellerId = $sth->fetch(PDO::FETCH_OBJ);

        $dataArray = array($categoryId->category_id, $subCategoryId->sub_category_id, $this->name, $this->picture, $this->width, $this->height, $this->weight, $this->description, $this->price, $this->salePrice, $sellerId->user_id, $this->entryDate);
        $sql = 'insert into products (category_id, sub_category_id, product_name, picture, width, height, weight, description, price, sale_price, vendor_id, entry_date) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)';
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);

        $sql = "select product_id from products where product_name = '".$this->name."'";
        $sth = $this->dbh->query($sql);
        $product_id = $sth->fetch(PDO::FETCH_OBJ);

        $dataArray = array($product_id->product_id, $this->stock, $this->entryDate);
        $sql = "insert into stock (product_id, present_stock, date) VALUES (?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);

        if($status){
            Message::message("<div class='alert alert-success'>
                            Product has been added successfully.
                </div>");
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }else{
            Message::message("<div class='alert alert-danger'>
                            Category has not been added!
                </div>");
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function updateProduct($productId){
        $dataArray = array($this->name, $this->picture, $this->width, $this->height, $this->weight, $this->description, $this->price, $this->salePrice);
        $sql = "update products set product_name=?, picture=?, width=?, height=?, weight=?, description=?, price=?, sale_price=? where product_id='".$productId."'";
        $sth = $this->dbh->prepare($sql);
        $status = $sth->execute($dataArray);

        if($status){
            Message::message("<div class='alert alert-success'>
                            Product has been Updated successfully.
                </div>");
            $location = "seller_dashboard/seller_dashboard.php";
            Utility::redirect($location);
        }else{
            Message::message("<div class='alert alert-danger'>
                            Something went wrong!
                </div>");
            Utility::redirect($_SERVER['HTTP_REFERER']);
        }

    }


    public function categoryName($userId){
        $sql = "SELECT `category_name` FROM `category` where vendor_id='".$userId."'";
        $sth = $this->dbh->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $data = $sth->fetchAll();
        return $data;
    }

    public function subCategoryName($userId){
        $sql = "SELECT `sub_category_name` FROM `sub_category` where vendor_id='".$userId."'";
        $sth = $this->dbh->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $data = $sth->fetchAll();
        return $data;
    }

    public function viewCategory(){
        $sql = 'select * from category';
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function viewSubcategoryByCategoryId($categoryId){
        $sql = "select * from sub_category where category_id='".$categoryId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();

        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function viewOrderDataBySellerId($sellerId){
        $sql = "select * from product_sold where vendor_id='".$sellerId."'";
        $sth =$this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();

        if($row>0){
            return $data;
        }else{
            return FALSE;
        }

    }

    public function productsByCategoryId(){
        $sql = "select * from products where category_id='".$this->categoryId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function productsBySubCategoryId($subCategoryId){
        $sql = "select * from products where sub_category_id='".$subCategoryId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }


    public function productFromCategoryByProductId(){
        $sql = "select category_id from products where product_id='".$this->productId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $sql = "select * from products where category_id='".$data[0]->category_id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }
    public function productView(){
        $sql = 'select * from products';
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function productViewBySellerId($id){
        $sql = "select * from products WHERE vendor_id = '".$id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function categoryViewBySellerId($id){
        $sql = "select * from category WHERE vendor_id = '".$id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function singleProductView(){
        $sql = "select * from products where product_id='".$this->productId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function singleProductViewByProductId($productId){
        $sql = "select * from products where product_id='".$productId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function singleCategoryViewByCategoryId($categoryId){
        $sql = "select * from category where category_id='".$categoryId."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function cartView($id){
        $sql = "select * from cart where user_id = '".$id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
        
    }

    public function product_filter_by_price($low_price,$high_price){
        $sql = "select * from products where price>='".$low_price."' and price<='".$high_price."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function product_filter_by_price_by_category($low_price,$high_price,$categoryId){
        $sql = "select * from products where category_id='".$categoryId."' and price>='".$low_price."' and price<='".$high_price."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function product_filter_by_price_by_sub_category($low_price,$high_price,$subCategoryId){
        $sql = "select * from products where sub_category_id='".$subCategoryId."' and price>='".$low_price."' and price<='".$high_price."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function viewSoldDataForSeller($email){
        $sql = "select user_id from users where email='".$email."'";
        $sth = $this->dbh->query($sql);
        $id = $sth->fetch(PDO::FETCH_OBJ);

        $sql = "select * from product_sold WHERE vendor_id = '".$id->user_id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }

    }

    public function viewTotalSoldData(){
        $sql = "select * from product_sold";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function is_exist($data){


    }

    public function deleteOrderDataFromCart(){
        $status = false;
        for($i=0; $i<$this->loopCounter; $i++){
            $sql = "delete from cart where product_id = '".$this->product_id[$i]."'";
            $sth = $this->dbh->exec($sql);

            if($sth){
                $status = TRUE;
            }else{
                $status = FALSE;
            }
        }
        return $status;

    }

    public function viewOrders(){
        $sql = "Select * from orders where delivered ='No'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();

        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function ratingStat($product_id){
        $sql = "select ratings from product_rating where product_id='".$product_id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $row = $sth->rowCount();

        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function viewProductById($product_id){
        $sql = "select price from productrs where product_id ='".$product_id."'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function order_details($soldDate){
        $sql = "select * from product_sold where sold_date = '".$soldDate."' and delivered = 'no'";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);
        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    //order completion
    public function updatePaymentStatus($orderId){
        $sql = "update orders set paid='paid' where order_id='".$orderId."'";
        $sth = $this->dbh->exec($sql);

        if($sth){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function deleteFromOrderList($orderId){
        $sql = "update orders set delivered='rejected' where order_id = '".$orderId."'";
        $sth = $this->dbh->exec($sql);

        if($sth){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function viewDelivered(){
        $sql = "select * from orders where delivered in ('yes','rejected')";
        $sth = $this->dbh->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_OBJ);

        $row = $sth->rowCount();
        if($row>0){
            return $data;
        }else{
            return FALSE;
        }
    }

    public function updateDeliveryStatus($order_id){
        $sql = "update orders set delivered = 'yes' where order_id = '".$order_id."'";
        $sth = $this->dbh->exec($sql);
        if($sth){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}