<?php
$title = "delete restaurant";
require('header.php');
require('auth.php');


// GET selected restaurantID
$id = $_GET['id'];

if (empty($id))
{
    header ('location:restaurants.php'); // return list page
}
else
{
    // connect
    require('db.php');

    // find logo & delete it if there is on
    $sql = "SELECT logo FROM restaurants WHERE id = :id";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':id', $id, PDO::PARAM_INT);
    $cmd->execute();
    $logo = $cmd->fetchColumn();

    // set up and execute SQL DELETE command
    $sql = "DELETE FROM restaurants WHERE id = :id";
    $cmd = $db->prepare($sql);
    $cmd->bindParam('id', $id, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $db = null;

    // now delete the og if there is one (delete from database and then delete the image)
    if (isset($logo))
    {
        unlink("img/$logo");
    }
}

// redirect to updated restaurants page
header ('location:restaurants.php'); // return list page

?>
</body>
</html>