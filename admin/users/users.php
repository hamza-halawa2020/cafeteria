<?php
require_once '../vendor/autoload.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$userEmail = $_SESSION['email'];

use App\Classes\Users;

$users = new Users();
$userData = $users->showUserByEmail($userEmail);

if ($userData && $userData[0]['isAdmin'] === 'admin') {
} else {
    header("Location: http://localhost/php/project/index.php");
}


$users = new Users;



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .user-card {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-card img {
            width: 100px;
            height: 100px;
            display: block;
            margin-bottom: 10px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php include_once '../includes/header.php' ?>

    <div class="container">
        <h1 class="mb-4">Hello from the Users Page</h1>
        <div class='user-card'>
            <h1><a href="add.php" class="btn btn-primary">Add User</a></h1>
        </div>
        <?php
        $users = $users->showUser2();

        if ($users) {
            foreach ($users as $user) {
                echo "<div class='user-card'>";
                echo "<p><strong>ID:</strong> {$user['id']}</p>";
                echo "<p><strong>Name:</strong> {$user['name']}</p>";
                echo "<p><strong>Email:</strong> {$user['email']}</p>";
                echo "<p><strong>Password:</strong> {$user['password']}</p>";
                echo "<p><strong>Profile Picture:</strong><img src=' ..{$user['profirPicturePath']}'></p>";
                echo "<p><strong>Is Admin:</strong> {$user['isAdmin']}</p>";

                echo "<div class='button-container'>";
                echo "<a href='delete.php?id={$user['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
                echo "<a href='edit.php?id={$user['id']}' class='btn btn-info'>Edit</a>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p>No users available.</p>";
        }
        ?>
    </div>

    <?php include_once '../includes/footer.php' ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>