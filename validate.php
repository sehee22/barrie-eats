<?php

$username = $_POST['username'];
$password = $_POST['password'];

$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

$sql = "SELECT userId, password FROM users WHERE username = :username";

$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();

$user = $cmd->fetch();

if (!password_verify($password, $user['password'])) {
    header('location:login.php?invalid=true');
    exit();
}
else
{
    session_start(); // 창을 띄운 순간부터 이미 세션은 시작된 것. connect to existing session so we can write to it
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['username'] = $username;
    header('location:restaurants.php');
}

$db = null;

?>
