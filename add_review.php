<?php

$title = "Save a New Review";
require('header.php');

//auth check
require('auth.php');


// introduce variables to store the form input variables
$username = $_POST ['username'];
$rating = $_POST ['rating'];
$comments = $_POST ['comments'];
$restaurant  = $_POST ['restaurant'];

// validate each input
$ok = true;

if (empty($username))
{
    echo "Userame is Required. <br />";
    $ok = false;
}
if (empty($rating))
{
    echo "Rating is Required. <br />";
    $ok = false;
}
if (empty($comments))
{
    echo "Comment is Required. <br />";
    $ok = false;
}
if ($restaurant == '-Select-')
{
    echo "Restaurant is Required. </br>";
    $ok = false;
}

// connect to the database with server, username, password, dbname
// only save if no validation errors
if ($ok)
{
    // PDO : PHP Database Object (regardless the database, we can use any type database system
    require('db.php');

    if (empty($id))
    {
        $sql = "INSERT INTO reviews (username, rating, comments, restaurant) VALUES (:username, :rating, :comments, :restaurant)";
    }
    else
    {
        $sql = "UPDATE reviews SET username = :username, rating = :rating, comments = :comments, restaurant = :restaurant WHERE reviewId = :reviewId";
    }
    // set up and execute an INSERT command

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':rating', $rating, PDO::PARAM_INT);
    $cmd->bindParam(':comments', $comments, PDO::PARAM_STR, 5000);
    $cmd->bindParam(':restaurant', $restaurant, PDO::PARAM_STR, 100);

    if (!empty($reviewId)) // id가 있다면 cmd에 id도 bindParam으로 추가함
    {
        $cmd->bindParam('reviewId', $reviewId, PDO::PARAM_INT);
    }
    $cmd->execute();

    // disconnect!!! after inserting, disconnect from the database
    $db = null;


    header('location:reviews.php');
}

?>

<?php require('footer.php'); ?>