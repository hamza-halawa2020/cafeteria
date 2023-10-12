<?php
require_once '../admin/vendor/autoload.php';
use App\Classes\Cart;
use App\Classes\Products;
use App\Classes\Users;

session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$Products = new Products();
$User = new Users();
$Cart = new Cart();

$cartData = $Cart->showCart();



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php include_once '../admin/includes/header.php' ?>

    <div class="container mt-4">
        <h1 class="mb-4">My Orders</h1>
        <?php
        if (isset($exist)) {
            echo '<div class="alert alert-danger">Product already exists in the cart.</div>';
        } ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>User ID</th>
                    <th>Product Name</th>
                    <th>Product image</th>
                    <th>User Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userData = $User->showUserByEmail($_SESSION['email']);

                foreach ($userData as $user) {
                    if (isset($user)) {
                        $userId = $user['id'];
                        $userCartData = $Cart->showUserCart($userId);

                        foreach ($userCartData as $row) {
                            $totalPrice = $row['product_price'] * $row['quantity'];
                            echo "<tr>
                            <th>Order No.</th>
                            <td>{$row['cart_id']}</td>
                            <td>{$row['cart_product_id']}</td>
                            <td>{$row['cart_user_id']}</td>
                            <td>{$row['product_name']}</td>
                            <td><img src='../admin{$row['product_image']}' width='100'></td>
                            <td>{$row['user_name']}</td>
                            <td>{$row['product_price']}</td>
                            <td>{$row['quantity']}</td>
                            <td>$totalPrice</td>
                            <td>{$row['status']}</td>
                <td>
                    <a href='delete.php?id={$row['cart_id']}' class='btn btn-danger'>Delete</a>
                </td>
            </tr>";
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php include_once '../admin/includes/footer.php' ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>