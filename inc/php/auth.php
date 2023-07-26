<?php
session_start();
require_once "../class/User.php";

$user = new User();

// is user exist
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// register
if (isset($_POST['insc'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $user->register($login, $password, $firstname, $lastname, $mail, $address, $city, $zip, $country);
}

// connection
if (isset($_POST['conn'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user->connect($login, $password);
}
