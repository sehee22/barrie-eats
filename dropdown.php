<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Review</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<h1>Add a Review</h1>

<form action = "add_review.php" method ="post">
    <fieldset>
        <label for ="username" class="col-md-1">User Name: </label>
        <input name="username" id="username" required/>
    </fieldset>
    <fieldset>
        <label for="mm" class="col-md-1">Rating: </label>
        <?php
        // connect
        $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=', '', '');

        // set up query
        $sql = "select rating from rating;";
        $cmd = $db->prepare($sql);

        // fetch the results
        $cmd->execute();
        $rating = $cmd->fetchAll();

        // start the select
        echo '<select name = "rating">';

        // loop through and create a new option tag for each type
        foreach ($rating as $r)
        {
            echo '<option>' . $r['rating'] . '</option>';
        }

        // close the select
        echo '</select>';

        // disconnect
        $db = null;
        ?>
    </fieldset>
    <fieldset>
        <label for ="comments" class="col-md-1">Comments: </label>
        <textarea name="comments" id="comments" requiered></textarea>
    </fieldset>
    <fieldset>
        <label for ="restaurant" class="col-md-1">Restaurant: </label>
        <?php
        // connect
        require('db.php');
        // $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=', '', '');

        // set up query
        $sql = "SELECT * FROM restaurants order by nm";

        // execute & store the result
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

        // start the select
        echo '<select name = "restaurant">';

        // loop through the data & show each restaurant on a new row
        foreach ($restaurants as $r)
        {
            echo '<option>' . $r['nm'] . '</option>';
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
