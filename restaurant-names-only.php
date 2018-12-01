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
require('db.php');
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