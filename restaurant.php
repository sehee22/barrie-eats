<?php
$title = "Restaurant Details";
require('header.php');

//auth check
require('auth.php');


// initialize variables
$nm = null;
$addr = null;
$phone = null;
$rst_tp = null;
$id = null;
$logo = null;


// was an existing id passed to this page? If so, select the matching record from the DB
if (!empty($_GET['id']))
{
    $id = $_GET['id'];

    //connect
    require('db.php');

    // set up and execute the query
    $sql = "SELECT * FROM restaurants WHERE id = :id";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':id', $id, PDO::PARAM_INT);
    $cmd->execute();
    $r = $cmd->fetch(); // we don't display all the data, but only one. using fetch rather than fetchAll

    // store each column value in a variable
    $nm = $r['nm'];
    $addr = $r['addr'];
    $phone = $r['phone'];
    $rst_tp = $r['rst_tp'];
    $logo = $r['logo'];

    // disconnect
    $db = null;
}
?>


<h1>Restaurant Details</h1>

<form method="post" action="save-restaurant.php" enctype="multipart/form-data">
    <fieldset>
        <label for="nm" class="col-md-1">Name: </label>
        <input name="nm" id="nm" required value="<?php echo $nm; ?>" />
    </fieldset>
    <fieldset>
        <label for ="addr" class="col-md-1">Address: </label>
        <textarea name="addr" id="addr" required><?php echo $addr; ?></textarea>
    </fieldset>
    <fieldset>
        <label for ="phone" class="col-md-1">Phone: </label>
        <input name="phone" id="phone"  required type="tel" value="<?php echo $phone; ?>"/>
    </fieldset>
    <fieldset>
        <label for="rst_tp" class="col-md-1">Type: </label>
        <select name="rst_tp" id="rst_tp">
            <option>-Select-</option>
            <?php
            // connect
            $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=', '', '');

            // set up query
            $sql = "select rst_tp from restauranttypes order by rst_tp";
            $cmd = $db->prepare($sql);

            // fetch the results
            $cmd->execute();
            $types = $cmd->fetchAll();

            // loop through and create a new option tag for each type
            foreach ($types as $t)
            {
                if ($t['rst_tp'] == $rst_tp)
                {
                    echo "<option selected> {$t['rst_tp']}</option>";
                }
                else
                {
                    echo "<option>{$t['rst_tp']}</option>";
                }
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="logo" class="col-md-1">Logo:</label>
        <input type="file" name="logo" id="logo" />
    </fieldset>
    <div class="col-md-offset-1">
        <?php
        if (isset($logo)) {
            echo "<img src=\"img/$logo\" alt=\"Logo\" />";
        }
        ?>
    </div>
    <button class="col-md-offset-1 btn btn-primary">Save</button>
    <input type="hidden" name ="id", id="id" value=<?php echo $id; ?>" />

    <?php
        // connect

        if (isset($id)) {
            $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=', '', '');
            $sql = "SELECT * FROM reviews WHERE restaurant = :nm";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':nm', $nm, PDO::PARAM_STR, 60);
            $cmd->execute();
            $count = $cmd->rowCount(); // the row count of $sql query

            $reviews = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름.  fetch 로 하니까 에... 왜지?

            if ($count > 0)
            {
                echo '<h1>Review</h1>';
                // start the table
                echo '<table class="table table-striped table-hover sortable"><thead><th>Username</th><th>Rating</th><th>Cooments</th><th>Date</th></thead>';

                // loop through the data & show each restaurant on a new row
                // . 으로 연결을 열고 닫고 함
                foreach ($reviews as $r) {

                    echo "<tr>
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
            }
            else
            {
                echo '<h1>Leave the first Review!</h1>';
            }
        }
    ?>




<div class="fb-comments" data-href="http://aws.computerstudi.es/~//.php" data-width="100" data-numposts="5"></div>



</form>


<?php require('footer.php'); ?>
