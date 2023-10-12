<?php

require_once '../admin/vendor/autoload.php';
use App\Classes\Cart;
use App\Classes\Products;
use App\Classes\Users;

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$userEmail = $_SESSION['email'];

$Products = new Products();
$Cart = new Cart();
$users = new Users();
$userData = $users->showUserByEmail($userEmail);

if ($userData && $userData[0]['isAdmin'] === 'admin') {
} else {
    header("Location: http://localhost/php/project/users/orders.php");
}



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

    <div class="container mt-5">
        <h1 class="mb-4">My Orders</h1>

        <?php if (isset($exist)): ?>
            <div class="alert alert-warning" role="alert">
                Product already exists in the cart.
            </div>
        <?php endif; ?>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Order No.</th>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>User ID</th>
                    <th>Product image</th>
                    <th>Product Name</th>
                    <th>User Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartData as $row): ?>
                    <?php $totalPrice = $row['product_price'] * $row['quantity']; ?>
                    <tr>
                        <td>Order No.</td>
                        <td>
                            <?php echo $row['cart_id']; ?>
                        </td>
                        <td>
                            <?php echo $row['cart_product_id']; ?>
                        </td>
                        <td>
                            <?php echo $row['cart_user_id']; ?>
                        </td>
                        <td>
                            <img src="<?php echo '../admin' . $row['product_image']; ?>" alt="Product Image" width="100">
                        </td>
                        <td>
                            <?php echo $row['product_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['user_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['product_price']; ?>
                        </td>
                        <td>
                            <?php echo $row['quantity']; ?>
                        </td>

                        <td>
                            <?php echo $totalPrice; ?>
                        </td>

                        <td>
                            <select class="form-control">
                                <option>
                                    <?php echo $row['status']; ?>
                                </option>
                            </select>


                        </td>


                        <td>
                            <a href='delete.php?id=<?php echo $row['cart_id']; ?>' class='btn btn-danger'
                                onclick='return confirm("Are you sure you want to delete this product?");'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once '../admin/includes/footer.php' ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>