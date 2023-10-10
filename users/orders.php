<?php
require_once '../admin/vendor/autoload.php';
use App\Classes\Database;
use App\Classes\Products;
use App\Classes\Users;

session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$Products = new Products();
$User = new USers();


// $sql = "SELECT * FROM cart ( product_id, user_id, quantity)
// VALUES ( '$productId', '$userId', '$productQuantity')";

// $connection->runDataBase($sql);

// header("Location: cart.php");
// unset($_SESSION['cart']);

$connection = new Database();

$sql = "SELECT * FROM cart"; // Adjust the query based on your database structure
$stmt = $connection->runDataBase($sql);
$stmt->execute();

// Check if the query was successful
if ($stmt) {
    $cartData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Handle the case where the query failed
    $cartData = array();
}
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
                    <td><button>Delete</button></td>
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