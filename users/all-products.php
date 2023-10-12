<?php
require_once '../admin/vendor/autoload.php';
use App\Classes\Products;

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$Products = new Products();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
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
    <?php include_once '../admin/includes/header.php' ?>

    <div class="container">
        <h1 class="mt-5">Hello from the Products Page</h1>
    </div>

    <div class="container">
        <?php
        $products = $Products->showProduct();

        if ($products) {
            foreach ($products as $product) {
                echo "<div class='product-card'>";
                echo "<img src='../admin{$product['photo']}' alt='Product Photo' class='img-fluid'>";
                echo "<p class='font-weight-bold'>Product Name: {$product['name']}</p>";
                echo "<p><strong>Price:</strong> {$product['price']} L.E</p>";
                echo "<p><strong>Quantity:</strong> {$product['quantity']}</p>";

                echo "<div class='button-container'>";
                echo "<form action='cart.php' method='POST'>";
                echo "<input type='hidden' name='productId' value='{$product['id']}'>";
                echo "<input type='hidden' name='productName' value='{$product['name']}'>";
                echo "<input type='hidden' name='productPrice' value='{$product['price']}'>";

                echo "<input type='number' name='quantity' value='1' min='1' max='{$product['quantity']}' class='form-control mb-2'>";
                echo "<button type='submit' name='addToCart' class='btn btn-primary'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>

    <?php include_once '../admin/includes/footer.php' ?>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>