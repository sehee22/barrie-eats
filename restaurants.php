<?php
$title = "Restaurants";
require('header.php');


?>
<h1>Restaurants</h1>
<form method="get">
<fieldset class="col-md-12 text-right">
    <label for="searchName">Search:</label>
    <input name="searchName" id="searchName" placeholder="Search By Name" />
        <select name="searchType" id="searchType">
        <option>-All-</option>
        <?php
        require ('db.php');
        $sql = "SELECT * FROM restauranttypes ORDER BY rst_tp";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $types = $cmd->fetchAll();
        foreach($types as $t)
        {
            echo "<option>{$t['rst_tp']}</option>";
        }
        ?>
    </select>
    <button class="btn-primary">Go</button>
</fieldset>
</form>
<?php
try {
// connect
// all variables will be shared within db.php and other pages.
    require('db.php');

// set up query
    $sql = "SELECT * FROM restaurants";

    // search by name if the user is searching
    $searchName = null;
    $searchType = null;

    if (isset($_GET['searchName']))
    {
        $searchName = $_GET['searchName'];
        $sql .= " WHERE nm LIKE '%";
        $sql .= $searchName;
        $sql .= "%'";
        if ($_GET['searchType'] != "-All-")
            {
                $searchType = $_GET['searchType'];
                $sql .= " AND rst_tp = '";
                $sql .= $searchType;
                $sql .= "'";
            }
    }

    // execute & store the result
    $cmd = $db->prepare($sql);

    $cmd->execute();
    // the row count of $sql query
    $count = $cmd->rowCount();

    if (isset($searchName) AND empty($searchType))
    {
        $cmd->bindParam(':searchName', $searchName, PDO::PARAM_STR, 60);
        echo "<h3>You searched: $searchName </h3>";
        echo "$count Result(s)";
    }
    else if (empty($searchName) AND isset($searchType))
    {
        $cmd->bindParam(':searchType', $searchType, PDO::PARAM_STR, 50);
        echo "<h3>You searched: $searchType </h3>";
        echo "$count Result(s)";
    }
    else if (isset($searchName) AND isset($searchType))
    {
        $cmd->bindParam(':searchName', $searchName, PDO::PARAM_STR, 60);
        $cmd->bindParam(':searchType', $searchType, PDO::PARAM_STR, 50);
        echo "<h3>You searched: $searchName / $searchType </h3>";
        echo "$count Result(s)";
    }

    $restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

    // start the table
    echo '<table class="table table-striped table-hover sortable"><thead><th>Name</th><th></th><th>Address</th><th>Phone</th><th>Type</th>';

    if (isset($_SESSION['userId'])) {
        echo '<th>Actions</th>';
    }

    echo '</thead>';


    // loop through the data & show each restaurant on a new row
    // . 으로 연결을 열고 닫고 함
    foreach ($restaurants as $r) {
        echo "<tr>
                    <td> {$r['nm']} </td>";
        if (isset($r['logo']))
        {
            echo "<td><img src=\"img/{$r['logo']}\" alt=\"Logo\" height=\"50px\" /></td>";
        }
        else
        {
            echo "<td></td>";
        }
        echo " <td> {$r['addr']} </td>
                <td> {$r['phone']} </td>
                <td> {$r['rst_tp']} </td>";


        if (isset($_SESSION['userId'])) {
            echo "<td><a href=\"restaurant.php?id={$r['id']}\">Edit</a> | 
                    <a href=\"delete-restaurant.php?id={$r['id']}\" class=\"text-danger confirmation\">Delete</a> </td>";
        }

        echo "</tr>";
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
}
catch (Exception $e)
{
    // send
    mail('200389459@student.georgianc.on.ca', 'Barrie Eats Error', $e);
    // show generic error page
    header('location:error.php');
}
?>

<?php require('footer.php'); ?>
