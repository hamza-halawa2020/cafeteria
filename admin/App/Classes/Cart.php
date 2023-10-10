<?php

namespace App\Classes;

use App\Traits\validate;
use PDO;


class Cart extends Database
{
    use validate;
    private $productId, $userId, $productQuantity;

    public function __set($key, $value)
    {
        if (property_exists($this, $key)) {
            $value = htmlspecialchars(($value));
            $this->$key = $value;
        } else {
            echo "not found";
        }
    }

    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }
    }

    // public function addToCart()
    // {
    //     $result = $this->runDataBase("INSERT INTO cart (user_id,product_id,quantity) VALUES ('$this->userId','$this->productId','$this->productQuantity');");

    //     return $result;

    // }

    public function showCart()
    {
        $result = $this->runDataBase("SELECT * FROM cart");
        return $result;

    }

    public function destroy($id)
    {
        $result = $this->runDataBase("DELETE FROM cart WHERE id = $id");

    }
}