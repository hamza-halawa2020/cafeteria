<?php

// require_once '../App/Classes/Database.php';
// require_once '../App/Classes/Users.php';

require_once '../vendor/autoload.php';

use App\Classes\Users;

$checkNameRegisterd = null;
$checkEmailRegisterd = null;
$checkPasswordRegistered = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addNewUser = new Users();
    $checkNameRegisterd = $addNewUser->checkName($_POST['name']);
    $checkEmailRegisterd = $addNewUser->checkEmail($_POST['email']);
    $checkPasswordRegistered = $addNewUser->checkPassword($_POST['password']);

    // if ($checkNameRegisterd) {
    //     $checkNameRegisterd = "Validation error: $checkNameRegisterd";
    // } else if ($checkEmailRegisterd) {
    //     $checkEmailRegisterd = "Validation error: $checkEmailRegisterd";
    // } else if ($checkPasswordRegistered) {
    //     $checkPasswordRegistered = "Validation error: $checkPasswordRegistered";
    // } else {
    $addNewUser->name = $_POST['name'];
    $addNewUser->email = $_POST['email'];
    $addNewUser->password = $_POST['password'];
    // $addNewUser->password = $_POST['password'];

    if (!is_array($addNewUser->addUser())) {

        $result = $addNewUser->addUser();
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
    <title>Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
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
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
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

        /* Style for the profile picture section */
        .profile-picture-section {
            margin-bottom: 20px;
        }

        .profile-picture-section label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .profile-picture-section input[type="file"] {
            display: none;
        }

        .profile-picture-section .profile-picture-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-picture-section .profile-picture-label i {
            font-size: 48px;
            color: #ccc;
        }

        .profile-picture-section .profile-picture-label span {
            font-size: 14px;
            color: #333;
        }
    </style>
</head>

<body>
    <?php include_once '../includes/header.php' ?>

    <div class="container">
        <h2>Register</h2>



        <form action="" method="POST">
            <label for="name">Name</label>
            <div style="color: red;">
                <?php echo $checkNameRegisterd ? "$checkNameRegisterd" : ""; ?>
            </div>
            <input name="name" type="text" id="name" placeholder="Enter your name">

            <label for="email">Email</label>
            <div>
                <?php
                if (isset($result)) { ?>
                    <h1>Added..</h1>
                <?php } ?>

                <?php if (isset($errors) && !empty($errors)) { ?>
                    <div>
                        <ul>
                            <?php foreach ($errors as $error) { ?>
                                <li>
                                    <?php echo $error; ?>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div style="color: red;">
                <?php echo $checkEmailRegisterd ? "$checkEmailRegisterd" : ""; ?>
            </div>
            <input name="email" type="email" id="email" placeholder="Enter your email">

            <label for="password">Password</label>
            <div style="color: red;">
                <?php echo $checkPasswordRegistered ? "$checkPasswordRegistered" : ""; ?>
            </div>
            <input name="password" type="password" id="password" placeholder="Enter your password">

            <label for="confirmPassword">Confirm Password</label>
            <input name="confirmPassword" type="password" id="confirmPassword" placeholder="Confirm your password">

            <!-- Profile Picture Section -->
            <div class="profile-picture-section">
                <label for="ProfilePicture">Profile Picture</label>
                <input name="ProfilePicture" type="file" id="ProfilePicture">
                <label class="profile-picture-label" for="ProfilePicture">
                    <i class="fas fa-camera"></i>
                    <span>Click to upload a profile picture</span>
                </label>
            </div>
            <a href="login.php">Already have an account? Login here.</a>

            <input name="RegisterBTN" type="submit" value="Register">
        </form>
    </div>



    <?php include_once '../includes/footer.php' ?>
</body>

</html>