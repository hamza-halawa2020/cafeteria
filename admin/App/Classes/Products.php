<?php

namespace App\Classes;

use App\Traits\validate;
use PDO;


class Products extends Database
{
    use validate;
    private $name, $quantity, $photo, $price, $errors;

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

    public function addProduct()
    {
        $result = $this->runDataBase("INSERT INTO products (name,quantity,price,photo) VALUES ('$this->name','$this->quantity','$this->price','$this->photo');");

        return $result;

    }

    public function showProduct()
    {
        $result = $this->runDataBase("SELECT * FROM products");
        return $result;

    }

    public function show($id)
    {
        $result = $this->runDataBase("SELECT * FROM products WHERE id = $id");
        return $result->fetch(PDO::FETCH_ASSOC);

        // return $result;
    }

    public function update($id)
    {
        $result = $this->runDataBase("UPDATE `products` SET `name`='$this->name' , `quantity`='$this->quantity' , `price`='$this->price' , `photo`='$this->photo' WHERE id=$id");

        if ($result) {
            return "updated";
        } else {
            return "failed";
        }
    }
    public function destroy($id)
    {
        $result = $this->runDataBase("DELETE FROM products WHERE id = $id");

    }
    function getProductById($id)
    {

        $result = $this->runDataBase("SELECT * FROM cart WHERE product_id = $id");
        return $result;

    }


    function getCartItems($id)
    {

        $result = $this->runDataBase("SELECT * FROM cart WHERE user_id = $id");
        return $result;

    }


}