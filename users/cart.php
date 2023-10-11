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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php include_once '../admin/includes/header.php' ?>

    <div class="container mt-4">
        <h1 class="mb-4">My Cart</h1>
        <?php
        if (isset($exist)) {
            echo '<div class="alert alert-warning">Product already exists in the cart.</div>';
        } ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Product Id.</th>
                    <th>User Id.</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
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
                                    <input type='number' value='{$value['quantity']}' name='newQuantity' class='form-control'>
                                    <input type='hidden' name='updateProductId' value='{$value['id']}'>
                                    <button type='submit' name='updateFromCart' class='btn btn-primary'>Update</button>
                                </form>
                            </td>
                            <td>$totalPrice</td>
                            <td>
                                <form method='post' action=''>
                                    <input type='hidden' name='removeProductId' value='{$value['id']}'>
                                    <button type='submit' name='removeFromCart' class='btn btn-danger'>Remove</button>
                                </form>
                            </td>
                        </tr>
                        ";
                    }
                }
                ?>
                <tr>
                    <td colspan="7" class="text-right">
                        <strong>Total:
                            <?php
                            $total = 0;
                            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $value) {
                                    $total += $value['price'] * $value['quantity'];
                                }
                                echo $total;
                            }
                            ?>
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <form method="post" action="save.php">
            <button type="submit" name="submitBTN" class="btn btn-success">Submit</button>
        </form>
    </div>

    <?php include_once '../admin/includes/footer.php' ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>