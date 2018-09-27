<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Restaurant</title>
</head>
<body>

<!-- html은 그냥 보여주기만 할 뿐, 실질적인 데이터 처리는 php -->
<?php
// introduce variables to store the form input variables
$nm = $_POST ['nm'];
$addr = $_POST ['addr'];
$phone = $_POST ['phone'];

// connect to the database with server, username, password, dbname
// PDO : PHP Database Object (regardless the database, we can use any type database system
//$db = new PDO('mysql:host=localhost:511;dbname=barrieeats', 'root', 'dirtn');
$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

// set up and execute an INSERT command
$sql = "INSERT INTO restaurants (nm, addr, phone) VALUES (:nm, :addr, :phone)";
$cmd = $db->prepare($sql);
$cmd->bindParam (':nm',$nm, PDO::PARAM_STR, 60);
$cmd->bindParam (':addr',$addr, PDO::PARAM_STR, 120);
$cmd->bindParam (':phone',$phone, PDO::PARAM_STR, 15);
$cmd->execute();

// disconnect!!! after inserting, disconnect from the database
$db = null;

echo "Restaurant Saved";
?>

</body>
</html>