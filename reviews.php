<?php
$title = "Reviews";
require('header.php');
?>

<h1>Reviews</h1>

<?php
// connect
require('db.php');

// set up query
$sql = "SELECT * FROM reviews";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

// start the table
echo '<table class="table table-striped table-hover sortable"><thead><th>Restaurant</th><th>Username</th><th>Rating</th><th>Cooments</th><th>Date</th></thead>';

// loop through the data & show each restaurant on a new row
// . 으로 연결을 열고 닫고 함
foreach ($restaurants as $r)
{

    echo "<tr>
              <td> {$r['restaurant']} </td>
              <td> {$r['username']} </td>
              <td> {$r['rating']} </td>
              <td> {$r['comments']} </td>
              <td> {$r['reviewDate']} </td>
          </tr>";
}
// close the table
echo '</table>';

// disconnect
$db = null;
?>

<!-- js -->
<script src ="js/jquery-3.3.1.min.js"></script>
<script src="js/scripts.js"></script>

<?php require('footer.php'); ?>