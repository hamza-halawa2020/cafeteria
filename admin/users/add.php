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
    echo "<p><strong>Is Admin:</strong> Yes</p>";
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
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
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
        <h1>Hello from the Products Page</h1>
        <p>Email:
            <?php echo $userEmail; ?>
        </p>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" type="text" id="name" placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label for="quantity">email</label>
                <input name="email" type="email" id="email" placeholder="Quantity">
            </div>
            <div class="form-group">
                <label for="name">password:</label>
                <input name="password" type="password" id="password" placeholder="Enter product password">
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
                <label for="name">is Admin:</label>
                <input name="isAdmin" type="isAdmin" id="isAdmin" placeholder="isAdmin">
            </div>
            <button name="addUserBTN" type="submit">Add Product</button>
        </form>
    </div>



    <?php include_once '../includes/footer.php' ?>
</body>

</html>