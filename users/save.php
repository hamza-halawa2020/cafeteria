<?php
session_start();
require_once '../admin/vendor/autoload.php';
use App\Classes\Products;
use App\Classes\Database;
use App\Classes\Users;

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$Products = new Products();
$User = new USers();
$connection = new Database();

$showUser = $User->showUserByEmail($_SESSION['email']);

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {

}
// var_dump($_SESSION);

if (isset($_POST['submitBTN'])) {
    foreach ($_SESSION['cart'] as $value) {
        // $totalPrice = $value['price'] * $value['quantity'];
        $productId = $value['id'];
        $userId = $showUser[0]['id'];
        // $productName = $value['name'];
        // $productPrice = $value['price'];
        $productQuantity = $value['quantity'];
        // $orderNo = $value['orderNo'];


        $sql = "INSERT INTO cart ( product_id, user_id, quantity)
                VALUES ( '$productId', '$userId', '$productQuantity')";

        $connection->runDataBase($sql);

        header("Location: orders.php");
        unset($_SESSION['cart']);


    }
}
?>