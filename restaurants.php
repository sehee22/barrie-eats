<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<?php
    // access the current session
    session_start();

    if(isset($_SESSION['userId']))
    {
        echo '<a href="restaurant.php">Add a New Restaurant</a>';
    }
?>
<h1>Restaurants</h1>

<?php
// connect
$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

// set up query
$sql = "SELECT * FROM restaurants";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

// start the table
echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Address</th><th>Phone</th><th>Type</th>';

if (isset($_SESSION['userID']))
{
    echo '<th>Actions</th></thead>';
}

// loop through the data & show each restaurant on a new row
// . 으로 연결을 열고 닫고 함
foreach ($restaurants as $r)
{

    echo "<tr>
                <td> {$r['nm']} </td>
              <td> {$r['addr']} </td>
              <td> {$r['phone']} </td>
              <td> {$r['rst_tp']} </td>";

        if (isset($_SESSION['userID'])) {
            "<td><a href=\"restaurant.php?id={$r['id']}\">Edit</a> | <a href=\"delete-restaurant.php?id={$r['id']} \" 
                     class=\"text-danger confirmation\">Delete</a> </td> 
          </tr>";
        }
        else
        {
            "</tr>\";";
        }
    /*
    echo '<tr><td>' . $r['nm'] .
        '</td><td>' . $r['addr'] .
        '</td><td>' . $r['phone'] .
        '</td><td>' . $r['rst_tp'] .
        '</td><td>' . '<a href="delete-restaurant.php?id=' . $r['id'] . '" class="text-danger">Delete</a>' . '</td></tr>';
    */
}
// close the table
echo '</table>';

// disconnect
$db = null;
?>

<!-- js -->
<script src ="js/jquery-3.3.1.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>