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
        header("location: http://localhost/php/project/index.php");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    </style>
</head>

<body>
    <?php include_once '../includes/header.php' ?>
    <div class="container mt-5">
        <h2 class="mb-4">Cafeteria Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                <small class="text-danger">
                    <?php echo $checkEmailRegisterd ? $checkEmailRegisterd : ""; ?>
                </small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password"
                    placeholder="Enter your password">
                <small class="text-danger">
                    <?php echo $checkPasswordRegistered ? $checkPasswordRegistered : ""; ?>
                </small>
            </div>
            <a href="recovery.php">Forgot password?</a><br>
            <a href="register.php">Don't have an account? Register here.</a><br>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
        </form>
    </div>

    <?php include_once '../includes/footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>