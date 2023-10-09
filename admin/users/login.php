<?php


require_once '../vendor/autoload.php';

use App\Classes\Users;

$checkEmailRegisterd = null;
$checkPasswordRegistered = null;
// session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginUser = new Users();
    $checkEmailRegisterd = $loginUser->checkEmail($_POST['email']);
    $checkPasswordRegistered = $loginUser->checkLoginPassword($_POST['password']);
    $loginUser->email = $_POST['email'];
    $loginUser->password = $_POST['password'];

    $result = $loginUser->showUser();
    if (is_array($result)) {
        session_start();

        $_SESSION['email'] = $_POST['email'];
        $_SESSION['isAdmin'];
        $_SESSION['id'];
        header("location: dashboard.php");
    } else {
        header("location: login.php");
    }
}

// }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 50px 20px;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
            display: block;
            text-align: left;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 15px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include_once '../includes/header.php' ?>
    <div class="container mt-5">



        <h2>Cafeteria Login</h2>
        <form action="" method="POST">
            <label for="email">Email</label>
            <div style="color: red;">
                <?php echo $checkEmailRegisterd ? "$checkEmailRegisterd" : ""; ?>
            </div>
            <input name="email" type="email" id="email" placeholder="Enter your email">
            <label for="password">Password</label>
            <div style="color: red;">
                <?php echo $checkPasswordRegistered ? "$checkPasswordRegistered" : ""; ?>
            </div>
            <input name="password" type="password" id="password" placeholder="Enter your password">
            <a href="recovery.php">Forgot password?</a>
            <a href="register.php">Don't have an account? Register here.</a>
            <input type="submit" value="Login">
        </form>
    </div>

    <?php include_once '../includes/footer.php' ?>

</body>

</html>