<?php
require_once '../vendor/autoload.php';
use App\Classes\Users;

$Users = new Users();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

$Users->destroy($id);
header("location: users.php");