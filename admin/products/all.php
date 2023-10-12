<?php
require_once '../vendor/autoload.php';
use App\Classes\Users;

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$userEmail = $_SESSION['email'];

$userEmail = $_SESSION['email'];


$users = new Users();
$userData = $users->showUserByEmail($userEmail);

if ($userData && $userData[0]['isAdmin'] === 'admin') {
} else {
    header("Location: http://localhost/php/project/index.php");
}

use App\Classes\Products;


$Products = new Products();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php include_once '../includes/header.php' ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Hello from the Products Page</h1>
        <div class="text-center mb-4">
            <a href="add.php" class="btn btn-primary">Add Product</a>
        </div>

        <?php
        $products = $Products->showProduct();

        if ($products) {
            foreach ($products as $product) {
                echo "<div class='card product-card'>";
                echo "<img src='../{$product['photo']}' alt='Product Photo' class='card-img-top' >";
                echo "<div class='card-body'>";
                echo "<p class='card-text'><strong>Product Name:</strong> {$product['name']}</p>";
                echo "<p class='card-text'><strong>Price:</strong> {$product['price']}</p>";
                echo "<p class='card-text'><strong>Quantity:</strong> {$product['quantity']}</p>";
                echo "<div class='button-container text-right'>";
                echo "<a href='delete.php?id={$product['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>";
                echo "<a href='edit.php?id={$product['id']}' class='btn btn-info'>Edit</a>";
                echo "</div></div></div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>

    <?php include_once '../includes/footer.php' ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>