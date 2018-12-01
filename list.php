<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Test</title>
</head>
<body>
<h1>Restaurants</h1>

<?php
// connection
require('db.php');

// set up query
$sql = "SELECT nm FROM restaurants order by nm";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

// start ul
echo '<ul style="display:inline-block;">';

// loop through the data & show each restaurant on a new row
foreach ($restaurants as $r)
{
    echo '<li><a href="#">' . $r['nm'] . '</li>';
}

// close ul
echo '</ul>';

// disconnect
$db = null;
?>
</body>
</html>