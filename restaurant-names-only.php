<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants Names Only</title>
</head>
<body>
<h1>Restaurants Names Only</h1>


<?php
// connect
//$db = new PDO ('mysql:host=localhost:511;dbname=barrieeats', 'root', 'dirtn');
$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');
// set up the query

// fetch the data from the db
$sql = "SELECT nm FROM restaurants";
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll();

// loop through the data and print 1 recode at a time
foreach ($restaurants as $r)
{
    echo $r['nm'] . "<br />";
}

// disconnect
$db = null;

?>


</body>
</html>