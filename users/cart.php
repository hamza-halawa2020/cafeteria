<?php
require_once '../admin/vendor/autoload.php';
use App\Classes\Products;
use App\Classes\Users;

session_start();
$Products = new Products();
$User = new USers();


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

if (isset($_POST['addToCart'])) {
    $quantity = $_POST['quantity'];
    $id = $_POST['productId'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $productExists = false;
    foreach ($_SESSION['cart'] as $product) {
        if ($product['id'] == $id) {
            $productExists = true;
            // break;
        }
    }

    if ($productExists) {
        $exist = '<h1>Product already exists in the cart.</h1>';
    } else {
        $_SESSION['cart'][] = array(
            'id' => $id,
            'quantity' => $quantity,
            'name' => $name,
            'price' => $price
        );
    }

}

if (isset($_POST['removeFromCart'])) {
    $removeProductId = $_POST['removeProductId'];
    $updatedCart = array();

    foreach ($_SESSION['cart'] as $product) {
        if ($product['id'] !== $removeProductId) {
            $updatedCart[] = $product;
        }
    }
    $_SESSION['cart'] = $updatedCart;

}

if (isset($_POST['updateFromCart'])) {
    $updateProductId = $_POST['updateProductId'];
    $newQuantity = $_POST['newQuantity'];

    $updatedCart = array();

    foreach ($_SESSION['cart'] as $product) {
        if ($product['id'] === $updateProductId) {
            $product['quantity'] = $newQuantity;
        }
        $updatedCart[] = $product;
    }
    $_SESSION['cart'] = $updatedCart;
}

$showUser = $User->showUserByEmail($_SESSION['email']);


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
        if (isset($_SESSION['cart'])) {


            foreach ($_SESSION['cart'] as $value) {

                $totalPrice = $value['price'] * $value['quantity'];
                $i = $showUser[0]['id'] . $value['id'] . $value['price'];

                echo "
                <tr>
                
                <td>$i</td>
                <td>{$value['id']}</td>
                <td>{$showUser[0]['id']}</td>
                <td>{$value['name']}</td>
                <td>{$value['price']}</td>
                <td>

                    <form method='post' action=''>
                        <input type='number' value='{$value['quantity']}' name='newQuantity'>
                        <input type='hidden' name='updateProductId' value='{$value['id']}'>
                        <button type='submit' name='updateFromCart'>Update</button>
                    </form>
                </td>
                <td>$totalPrice</td>
                    <td>
                    <form method='post' action=''>
                        <input type='hidden' name='removeProductId' value='{$value['id']}'>
                        <button type='submit' name='removeFromCart'>Remove</button>
                    </form>
                    
                </td>
                </tr>
                
        ";
            }
        }
        ?>
        <tr>
            <td>
                Total:
                <?php
                $total = 0;
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $value) {
                        $total += $value['price'] * $value['quantity'];
                    }

                    echo $total;
                }



                ?>
            </td>
        </tr>
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