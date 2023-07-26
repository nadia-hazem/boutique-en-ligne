<?php
session_start();
require_once 'inc/class/User.php';
require_once 'inc/class/Product.php';
require_once "inc/class/Comment.php";
require_once 'inc/class/Wishlist.php';
$user = new User();
$product = new Product();
$comment = new Comment();
$wishlist = new Wishlist();
?>
