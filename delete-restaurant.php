<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
// GET selected restaurantID
$id = $_GET['id'];

if (empty($id))
{
    header ('location:restaurants.php'); // return list page
}

// connect
$db = new PDO('mysql:host=localhost:511;dbname=barrieeats', 'root', 'dirtn');

// set up and execute SQL DELETE command
$sql = "DELETE FROM restaurants WHERE id = :id";
$cmd = $db->prepare($sql);
$cmd-> bindParam('id', $id, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$db = null;

// redirect to updated restaurants page
header ('location:restaurants.php'); // return list page
?>
</body>
</html>