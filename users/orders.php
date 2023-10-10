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
    <title>Cart Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <?php include_once '../admin/includes/header.php' ?>

    <h1>My Cart</h1>
    <?php
    if (isset($exist)) {
        echo '<h1>Product already exists in the cart.</h1>';
    } ?>
    <table>
        <tr>
            <th>Order No.</th>
            <th>Product Id.</th>
            <th>USer Id.</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Total Price</th>
            <th>Status</th>

            <th>Delete</th>
        </tr>


        <?php
        foreach ($cartData as $row) {
            echo "<tr>
            <th>Order No.</th>

                    <td>{$row['product_id']}</td>
                    <td>{$row['user_id']}</td>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <td>{$row['quantity']}</td>
                    <th>Total Price</th>
                    <th>Status</th>

                    <td>
                        <button>
                            <a href='delete.php?id={$row['id']}' class='button delete-button' onclick='return confirm(\'Are you sure you want to delete this product?\');'>Delete</a>
                        </button>
                    </td>
                </tr>";
        }
        ?>

        <tr>
            <form method="post" action="save.php">
        <tr>
            <td><input type="submit" name="submit" value="Submit"></td>
        </tr>
        </form>
        </tr>

    </table>



    <?php include_once '../admin/includes/footer.php' ?>
</body>

</html>