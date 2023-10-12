<?php

require_once '../vendor/autoload.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
use App\Classes\Products;

$product = new Products();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}
$pro = $product->show($id);
$userEmail = $_SESSION['email'];

use App\Classes\Users;

$users = new Users();
$userData = $users->showUserByEmail($userEmail);

if ($userData && $userData[0]['isAdmin'] === 'admin') {
} else {
    header("Location: http://localhost/php/project/index.php");
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $product->name = $_POST['name'];
    $product->quantity = $_POST['quantity'];
    $product->price = $_POST['price'];

    if (isset($_POST["updateProductBTN"])) {
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
                $imagePath = "/assets/images/" . time() . $imageName;

                if (move_uploaded_file($tmpPath, '..' . $imagePath)) {
                    $product->photo = $imagePath;
                    $product->update($id);

                    echo "Product added successfully.";
                    header("location: all.php");

                } else {
                    echo "Failed to move the uploaded image.";
                }
            }
        } else {
            $product->photo = $pro['photo'];
        }
    }
}


$userEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 0;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #008CBA;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005F6B;
        }

        .error-message {
            color: red;
        }

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

    <p>Email:
        <?php echo $userEmail; ?>
    </p>

    <div class="container">
        <h1>Edit Product</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter product name"
                    value="<?php echo $pro['name']; ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" placeholder="Quantity"
                    value="<?php echo $pro['quantity']; ?>">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" placeholder="Price" value="<?php echo $pro['price']; ?>">
            </div>

            <div class="profile-picture-section">
                <label for="ProfilePicture">Product Photo</label>
                <input name="file" type="file" id="ProfilePicture" value="<?php echo $pro['photo']; ?>">
                <label class="profile-picture-label" for="ProfilePicture">
                    <i class="fas fa-camera"></i>
                    <span>Click to upload a product photo</span>
                </label>

                <?php
                if (!empty($pro['photo'])) {
                    echo '<img src="..' . $pro['photo'] . '" alt="Current Product Photo">';
                }
                ?>
            </div>

            <button type="submit" name="updateProductBTN">Update Product</button>
        </form>
    </div>

    <?php include_once '../includes/footer.php' ?>
</body>

</html>