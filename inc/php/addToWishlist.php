<?php
session_start();
require_once '../class/User.php';
require_once '../class/Product.php';
require_once '../class/Wishlist.php';

$user = new User();
$product = new Product();
$wishlist = new Wishlist();

if ($user->isLogged()) {
    $user_id = $_SESSION['user']['id'];
    $product_id = $_POST['productId'];

    $wishlist->addToWishlist($user_id, $product_id);
} else {
    header('Location: login.php');
    exit();
}
?>