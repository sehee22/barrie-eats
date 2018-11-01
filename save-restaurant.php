<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Restaurant</title>
</head>
<body>

<!-- html은 그냥 보여주기만 할 뿐, 실질적인 데이터 처리는 php -->
<?php
// auto check
session_start();
if (empty($_SESSION['userID']))
{
    header('location:login.php');
    exit();
}

// introduce variables to store the form input variables
$nm = $_POST ['nm'];
$addr = $_POST ['addr'];
$phone = $_POST ['phone'];
$rst_tp = $_POST ['rst_tp'];
$id = $_POST['id'];

// validate each input
$ok = true;

if (empty($nm))
{
    echo "Name is Required. <br />";
    $ok = false;
}
if (empty($addr))
{
    echo "Address is Required. <br />";
    $ok = false;
}
if (empty($phone))
{
    echo "Phone is Required. <br />";
    $ok = false;
}
if ($rst_tp == '-Select-')
{
    echo "Type is Required. </br>";
    $ok = false;
}

// connect to the database with server, username, password, dbname
// only save if no validation errors
if ($ok)
{
    // PDO : PHP Database Object (regardless the database, we can use any type database system
    $db = new PDO('mysql:host=localhost:511;dbname=barrieeats', 'root', 'dirtn');
    //$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

    if (empty($id))
    {
        $sql = "INSERT INTO restaurants (nm, addr, phone, rst_tp) VALUES (:nm, :addr, :phone, :rst_tp)";
    }
    else
    {
        $sql = "UPDATE restaurants SET name = :name, addr = :addr, phone = :phone, rst_tp = :rst_tp WHERE id = :id";
    }
    // set up and execute an INSERT command

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':nm', $nm, PDO::PARAM_STR, 60);
    $cmd->bindParam(':addr', $addr, PDO::PARAM_STR, 120);
    $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 15);
    $cmd->bindParam(':rst_tp', $rst_tp, PDO::PARAM_STR, 50);

    if (!empty($id)) // id가 있다면 cmd에 id도 bindParam으로 추가함
    {
        $cmd->bindParam('id', $id, PDO::PARAM_INT);
    }
    $cmd->execute();

    // disconnect!!! after inserting, disconnect from the database
    $db = null;

    header('location:restaurants.php');

    echo "Restaurant Saved";
}

?>

</body>
</html>