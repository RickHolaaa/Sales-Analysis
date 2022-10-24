<?php

include 'login.php';

$user = new User('php_login_system', '127.0.0.1', 'root', 'root');

$username = $_POST['username'];
$password = $_POST['password'];

if ($user->exists($username, $password)) {
    $_SESSION['login'] = true;
    header("member.php'));
} else {
    header("index.html?message=".urlencode('incorrect username or password'));
    exit();
}