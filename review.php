<?php
$title = "Add a New Review";
require('header.php');

//auth check
require('auth.php');

?>

<h1>Create a Review</h1>

<form method="post" action="add_review.php">
    <fieldset>
        <label for="username" class="col-md-1">Username: </label>
        <input name="username" id="username" required />
    </fieldset>
    <fieldset>
        <label for="rating" class="col-md-1">Rating: </label>
        <input name="rating" id="rating" required type="number" min="0" max="5" />
    </fieldset>
    <fieldset>
        <label for="comments" class="col-md-1">Comments: </label>
        <textarea name="comments" id="comments" required></textarea>
    </fieldset>
    <fieldset>
        <label for="restaurant" class="col-md-1">Restaurant: </label>
        <select name="restaurant" id="restaurant">
            <option>-Select-</option>
            <?php
            // connect
            require('db.php');

            // set up query
            $sql = "SELECT nm FROM restaurants ORDER BY nm";
            $cmd = $db->prepare($sql);

            // fetch the results
            $cmd->execute();
            $restaurants = $cmd->fetchAll();

            // loop through and create a new option tag for each type
            foreach ($restaurants as $r) {
                echo "<option> {$r['nm']} </option>";
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <button class="col-md-offset-1 btn btn-primary">Save</button>
</form>

<?php require('footer.php'); ?>

