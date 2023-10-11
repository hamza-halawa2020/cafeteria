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



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include_once '../includes/header.php' ?>

    <div>hello from dashboard page</div>
    <p>Email:
        <?php echo $userEmail; ?>

    </p>

    <div>
        <?php
        foreach ($userData as $user) {
            if (isset($user['isAdmin'])) {
                echo "<p><strong>Is Admin:</strong> {$user['isAdmin']}</p>";
                echo "<p><strong>Id:</strong> {$user['id']}</p>";
            }
        }

        ?>
    </div>

    <?php include_once '../includes/footer.php' ?>
</body>

</html>