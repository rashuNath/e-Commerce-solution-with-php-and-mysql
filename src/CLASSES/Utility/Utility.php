<?php
/**
 * Created by PhpStorm.
 * User: rashu
 * Date: 23-04-18
 * Time: 23.48
 */

namespace App\Utility;


class Utility
{
    public static function var_dump($dataForDumped){
        echo "<pre>";
        var_dump($dataForDumped);
        echo "<pre>";
    }

    public static function redirect($location){
        header('location:'.$location);
    }
}