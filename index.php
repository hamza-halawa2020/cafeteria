<?php
require_once 'admin/vendor/autoload.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: http://localhost/php/project/admin/users/login.php");
}

$userEmail = $_SESSION['email'];
use App\Classes\Users;

$users = new Users();
$userData = $users->showUserByEmail($userEmail);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php include_once 'admin/includes/header.php' ?>

    <?php
    foreach ($userData as $user) {
        if (isset($user['isAdmin'])) {
            ?>
            <div class="container mt-5">
                <h1>Welcome,
                    <?php echo $user['name']; ?>
                </h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">User Information</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID:</strong>
                                <?php echo $user['id']; ?>
                            </li>
                            <li class="list-group-item"><strong>Email:</strong>
                                <?php echo $userEmail; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Profile Picture:</strong><br>
                                <img src="<?php echo './admin' . $user['profirPicturePath']; ?>" alt="Profile Picture"
                                    class="img-fluid rounded" width='150px'>
                            </li>
                            <li class="list-group-item"><strong>Permission:</strong>
                                <?php echo $user['isAdmin']; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php }
    } ?>

    <?php include_once 'admin/includes/footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>