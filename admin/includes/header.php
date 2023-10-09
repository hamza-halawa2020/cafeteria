<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
        }

        .header a:hover {
            background-color: #555;
            border-radius: 5px;
        }

        .header .logo {
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo"><a href="http://localhost/php/project/index.php">Cafeteria</a></div>
        <div class="nav-links">
            <a href="http://localhost/php/project/index.php">Home</a>
            <?php
            use App\Classes\Users;

            if (isset($_SESSION['email'])) {

                $users = new Users();
                $userData = $users->showUserByEmail($_SESSION['email']);
                if ($userData && $userData[0]['isAdmin'] === 'admin') {

                    echo '<a href="http://localhost/php/project/admin/users/dashboard.php">dashboard</a>';
                    echo '<a href="http://localhost/php/project/admin/products/all.php">products</a>';
                    echo '<a href="http://localhost/php/project/admin/users/users.php">users</a>';
                    echo '<a href="http://localhost/php/project/admin/users/logout.php">Logout</a>';

                } else {
                    echo '<a href="http://localhost/php/project/users/all-products.php">All Products</a>';
                    echo '<a href="http://localhost/php/project/users/cart.php">Cart</a>';
                    echo '<a href="http://localhost/php/project/admin/users/logout.php">Logout</a>';

                }
            } else {
                // header("Location: http://localhost/php/project/index.php");
                echo '<a href="http://localhost/php/project/admin/users/login.php">Login</a>';
                echo ' <a href="http://localhost/php/project/admin/users/register.php">Register</a>';
            } ?>
        </div>
    </div>
</body>

</html>