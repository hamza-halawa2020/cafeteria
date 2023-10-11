<?php
require_once '../admin/vendor/autoload.php';
use App\Classes\Cart;



$cart = new Cart();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

$cart->destroy($id);
header("location: all-orders.php");