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

    public function showCart()
    {
        $sql = "SELECT
                    cart.id AS cart_id,
                    cart.user_id AS cart_user_id,
                    cart.product_id AS cart_product_id,
                    users.name AS user_name,
                    products.name AS product_name,
                    products.price AS product_price,
                    products.photo AS product_image, 
                    cart.quantity,
                    cart.status AS status

                FROM
                    cart
                JOIN
                    users ON cart.user_id = users.id
                JOIN
                    products ON cart.product_id = products.id";

        $result = $this->runDataBase($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    public function showUserCart($userId)
    {
        $sql = "SELECT
                    cart.id AS cart_id,
                    cart.user_id AS cart_user_id,
                    cart.product_id AS cart_product_id,
                    users.name AS user_name,
                    products.photo AS product_image, 
                    products.name AS product_name,
                    products.price AS product_price,
                    cart.quantity,
                    cart.status AS status
                FROM
                    cart
                JOIN
                    users ON cart.user_id = users.id
                JOIN
                    products ON cart.product_id = products.id
                WHERE
                    cart.user_id = $userId";

        $result = $this->runDataBase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function destroy($id)
    {
        $result = $this->runDataBase("DELETE FROM cart WHERE id = $id");

    }
}