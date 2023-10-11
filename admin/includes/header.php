<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/php/project/index.php">Cafeteria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">

                <?php
                use App\Classes\Users;

                if (isset($_SESSION['email'])) {
                    $users = new Users();
                    $userData = $users->showUserByEmail($_SESSION['email']);
                    if ($userData && $userData[0]['isAdmin'] === 'admin') {
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/users/all-orders.php">All Orders</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/users/dashboard.php">Dashboard</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/products/all.php">Products</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/users/users.php">Users</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/users/logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/users/all-products.php">All Products</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/users/cart.php">Cart</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/users/orders.php">Orders</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/users/logout.php">Logout</a></li>';
                    }
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/users/login.php">Login</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="http://localhost/php/project/admin/users/register.php">Register</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>