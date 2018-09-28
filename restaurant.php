<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<a href="restaurants.php">View Restaurants</a>

<h1>Restaurant Details</h1>

<form action="save-restaurant.php" method="post">
    <fieldset>
        <label for ="nm" class="col-md-1">Name: </label>
        <input name="nm" id="nm" requiered/>
    </fieldset>
    <fieldset>
        <label for ="addr" class="col-md-1">Addres: </label>
        <textarea name="addr" id="addr" requiered></textarea>
    </fieldset>
    <fieldset>
        <label for ="phone" class="col-md-1">Phone: </label>
        <input name="phone" id="phone"  requiered type="tel"/>
    </fieldset>
    <fieldset>
        <label for="rst_tp" class="col-md-1">Type: </label>
            <?php
            // connect
            $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

            // set up query
            $sql = "select * from restauranttypes order by rst_tp";
            $cmd = $db->prepare($sql);

            // fetch the results
            $cmd->execute();
            $types = $cmd->fetchAll();

            // start the select
            echo '<select name = "rst_tp">';

            // loop through and create a new option tag for each type
            foreach ($types as $t)
            {
                //echo "<option> {$t['rst_tp']} </option>";
                echo '<option>' . $t[rst_tp] . '</option>';
            }

            // close the select
            echo '</select>';

            // disconnect
            $db = null;
            ?>
    </fieldset>
    <button class="col-md-offset-1 btn btn-primary">Save</button>
</form>
</body>
</html>