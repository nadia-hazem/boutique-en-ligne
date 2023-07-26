<?php
session_start();
require_once '../class/User.php';
$user = new User();

// is login exist
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// modification login
if (isset($_POST['modifLogin'])) {
    $login = $_POST['login'];
    $oldLogin = $_POST['oldLogin'];
    $password = $_POST['password'];
    $user->updateLogin($login, $oldLogin, $password);
}

// modification password
if (isset($_POST['modifPass'])) {
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $user->updatePassword($password, $newPassword);
}
