<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving your Registration</title>
</head>
<body>
<?php
// store form inputs in variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if(empty($username))
{
    echo 'Username is Required <br />';
    $ok = false;
}

if(strlen($password) < 8)
{
    echo 'Password is invalid <br />';
    $ok = false;
}

if ($password != $confirm)
{
    echo 'Passwords do not match <br />';
    $ok = false;
}

if ($ok)
{
    // hash the password
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    // connect
    $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

    // set up and execute the insert
    $sql = "INSERT INTO users (username, password) VALUES(:username, :password);"; // [:username] -> parameter
    $cmd = $db->prepare($sql);
    $cmd ->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd ->bindParam(':password', $hashedpassword, PDO::PARAM_STR, 255);
    $cmd -> execute();

    // disconnect
    $db = null;

    // redirect to login
}
?>
</body>
</html>