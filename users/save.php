<?php
session_start();
require_once '../admin/vendor/autoload.php';
use App\Classes\Products;
use App\Classes\Database;
use App\Classes\Users;

$Products = new Products();
$User = new USers();
$connection = new Database(); // Modify this based on your Database class

$showUser = $User->showUserByEmail($_SESSION['email']);

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {

}
var_dump($_SESSION); // Print the entire session to debug

if (isset($_POST['submit'])) {
    // Loop through the cart items and save them to the database
    foreach ($_SESSION['cart'] as $value) {
        // $totalPrice = $value['price'] * $value['quantity'];
        $productId = $value['id'];
        $userId = $showUser[0]['id'];
        // $productName = $value['name'];
        // $productPrice = $value['price'];
        $productQuantity = $value['quantity'];
        // $orderNo = $value['orderNo'];


        // SQL query to insert cart item into the database
        $sql = "INSERT INTO cart ( product_id, user_id, quantity)
                VALUES ( '$productId', '$userId', '$productQuantity')";

        $connection->runDataBase($sql); // Modify this based on your Database class


        // if ($connection->querySuccess()) {
        //     echo "Record inserted successfully.";
        // } else {
        //     echo "Error: " . $connection->getError();
        // }
    }
}
?>