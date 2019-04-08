<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 24-04-18
 * Time: 00.06
 */

namespace App\Database;

use App\Message\Message;
use PDO;
use PDOException;
class Database
{
    public $conn;
    public $dbh;
    public $dbName = 'ahmed_ecommerce';
    public $userName = 'root';

    public function __construct()
    {
        try{
            $this->dbh = new PDO("mysql:host=localhost;dbname=ahmed_ecommerce","root", "");
            $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch (PDOException $error){
            echo "Database Connection Failed".$error->getMessage();
        }
    }
}