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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addNewUser = new Users();

    $addNewUser->name = $_POST['name'];
    $addNewUser->email = $_POST['email'];
    $addNewUser->password = $_POST['password'];
    // $addNewUser->profirPicturePath = $_POST['file'];
    $addNewUser->isAdmin = $_POST['isAdmin'];

    if (isset($_POST["addUserBTN"])) {
        $imageName = $_FILES["file"]["name"];
        $tmpPath = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileName = explode(".", $imageName);
        $lastElement = end($fileName);
        $lastElement = strtolower($lastElement);
        $imgExtension = ["png", "jpg", "jpeg"];

        if (in_array($lastElement, $imgExtension)) {
            if ($fileSize > 715252) {
                echo "File is too big.";
            } else {
                $imagePath = "../assets/images/" . time() . $imageName;

                if (move_uploaded_file($tmpPath, $imagePath)) {
                    $addNewUser->photo = $imagePath;
                    $addNewUser->addUser();
                    echo "Product added successfully.";
                } else {
                    echo "Failed to move the uploaded image.";
                }
            }
        } else {
            echo "Invalid image format. Allowed formats: png, jpg, jpeg.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
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
        <h1 class="mb-4">Add User</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
            </div>


            <div class="profile-picture-section">
                <label for="ProfilePicture">product photo</label>
                <input name="file" type="file" id="ProfilePicture">
                <label class="profile-picture-label" for="ProfilePicture">
                    <i class="fas fa-camera"></i>
                    <span>Click to upload a product photo</span>
                </label>
            </div>

            <div class="form-group">
                <label for="isAdmin">Is Admin:</label>
                <input name="isAdmin" type="text" class="form-control" id="isAdmin"
                    placeholder="Enter 'admin' or 'user'">
            </div>

            <button name="addUserBTN" type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>

    <?php include_once '../includes/footer.php' ?>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>