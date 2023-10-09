<?php
require_once '../vendor/autoload.php';
use App\Classes\Products;

$dept = new Products();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

$dept->destroy($id);
header("location: all.php");