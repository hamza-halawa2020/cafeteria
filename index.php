<?php
require_once './admin/vendor/autoload.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: http://localhost/php/project/admin/users/login.php");
}

$userEmail = $_SESSION['email'];

// use App\Classes\Users;

// $users = new Users();
// $userData = $users->showUserByEmail($userEmail);

// if ($userData && $userData[0]['isAdmin'] === 'admin') {
//     echo "<p><strong>Is Admin:</strong> Yes</p>";
// } else {
//     header("Location: http://localhost/php/project/admin/users/users.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include_once 'admin/includes/header.php' ?>
    <?php echo $userEmail; ?>


    <?php include_once 'admin/includes/footer.php' ?>

</body>

</html>