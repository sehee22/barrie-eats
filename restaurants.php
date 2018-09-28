<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<a href="restaurant.php">Add a New Restaurant</a>
<h1>Restaurants</h1>

<?php
// connect
//$db = new PDO ('mysql:host=localhost:511;dbname=barrieeats', 'root', 'dirtn');
$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

// set up query
$sql = "SELECT * FROM restaurants";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

// start the table
echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Address</th><th>Phone</th><th>Restaurant Type</th></thead>';

// loop through the data & show each restaurant on a new row
// . 으로 연결을 열고 닫고 함
foreach ($restaurants as $r)
{
    echo '<tr><td>' . $r['nm'] .
        '</td><td>' . $r['addr'] .
        '</td><td>' . $r['phone'] .
        '</td><td>' . $r['rst_tp'] . '</td></tr>';
}
// close the table
echo '</table>';

// disconnect
$db = null;
?>

</body>
</html>