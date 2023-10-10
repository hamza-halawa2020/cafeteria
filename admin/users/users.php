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

        .user-card {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-card p {
            margin: 0;
            margin-bottom: 5px;
        }

        .user-card img {
            width: 100px;
            height: 100px;
            display: block;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .user-card .button-container {
            margin-top: 10px;
            text-align: right;
        }

        .user-card a.button {
            margin-left: 10px;
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
        }

        .user-card a.button:hover {
            background-color: #eee;
        }

        .user-card a.delete-button {
            background-color: #FF6347;
            color: #fff;
            border-color: #FF6347;
        }

        .user-card a.delete-button:hover {
            background-color: #FF6347;
            color: #fff;
        }

        .user-card a.edit-button {
            background-color: #008CBA;
            color: #fff;
            border-color: #008CBA;
        }

        .user-card a.edit-button:hover {
            background-color: #005F6B;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php include_once '../includes/header.php' ?>

    <div class="container">
        <h1>Hello from the Users Page</h1>
        <div class='user-card'>
            <h1><a href="add.php" class="button">Add User</a></h1>
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
                echo "<p><strong>Profile Picture:</strong><img src=' {$user['profirPicturePath']}'></p>";
                echo "<p><strong>Is Admin:</strong> {$user['isAdmin']}</p>";

                echo "<div class='button-container'>";
                echo "<a href='delete.php?id={$user['id']}' class='button delete-button' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
                echo "<a href='edit.php?id={$user['id']}' class='button edit-button'>Edit</a>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p>No users available.</p>";
        }
        ?>
    </div>

    <?php include_once '../includes/footer.php' ?>

</body>

</html>