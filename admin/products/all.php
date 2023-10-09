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
    echo "<p><strong>Is Admin:</strong> Yes</p>";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-card {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100px;
            height: 100px;
            display: block;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .product-card p {
            margin: 0;
            margin-bottom: 5px;
        }

        .product-card .button-container {
            margin-top: 15px;
            text-align: right;
        }

        .product-card a.button {
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
            margin-left: 10px;
        }

        .product-card a.button:hover {
            background-color: #eee;
        }

        .product-card a.delete-button {
            background-color: #FF6347;
            color: #fff;
            border-color: #FF6347;
        }

        .product-card a.delete-button:hover {
            background-color: #FF6347;
            color: #fff;
        }

        .product-card a.edit-button {
            background-color: #008CBA;
            color: #fff;
            border-color: #008CBA;
        }

        .product-card a.edit-button:hover {
            background-color: #005F6B;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .add-product-link {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include_once '../includes/header.php' ?>

    <div class="container">
        <h1>Hello from the Products Page</h1>
        <div class="add-product-link">
            <div class='product-card'>
                <a href="add.php" class="button">Add Product</a>
            </div>
        </div>

        <?php
        $products = $Products->showProduct();

        if ($products) {
            foreach ($products as $product) {
                echo "<div class='product-card'>";
                echo "<img src='../{$product['photo']}' alt='Product Photo'>";
                echo "<p><strong>Product Name:</strong> {$product['name']}</p>";
                echo "<p><strong>Price:</strong> {$product['price']}</p>";
                echo "<p><strong>Quantity:</strong> {$product['quantity']}</p>";

                echo "<div class='button-container'>";
                echo "<a href='delete.php?id={$product['id']}' class='button delete-button' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>";
                echo "<a href='edit.php?id={$product['id']}' class='button edit-button'>Edit</a>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>

    <?php include_once '../includes/footer.php' ?>
</body>

</html>