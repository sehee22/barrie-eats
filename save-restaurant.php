<?php
require('header.php');
require('auth.php');

// introduce variables to store the form input variables
$nm = $_POST ['nm'];
$addr = $_POST ['addr'];
$phone = $_POST ['phone'];
$rst_tp = $_POST ['rst_tp'];
$id = $_POST['id'];
$logo = null;

// validate each input
$ok = true;

if (empty($nm))
{
    echo "Name is Required. <br />";
    $ok = false;
}
if (empty($addr))
{
    echo "Address is Required. <br />";
    $ok = false;
}
if (empty($phone))
{
    echo "Phone is Required. <br />";
    $ok = false;
}
if ($rst_tp == '-Select-')
{
    echo "Type is Required. </br>";
    $ok = false;
}
// check and validate logo upload
if (isset($_FILES['logo']))
{
    $logoFile = $_FILES['logo'];

    if ($logoFile['size'] > 0)
    {
        // generate unique file name
        $logo = session_id() . "-" . $logoFile['name'];

        // check file type
        $fileType = null;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $logoFile['tmp_name']);

        // allow only jpeg & png
        if (($fileType != "image/jpeg") && ($fileType != "image/png"))
        {
            echo 'Please upload a valid JPG or PNG logo<br />';
            $ok = false;
        }
        else
        {
            // save the file
            move_uploaded_file($logoFile['tmp_name'], "img/{$logo}");
        }
    }

}
// connect to the database with server, username, password, dbname
// only save if no validation errors
if ($ok)
{
    // PDO : PHP Database Object (regardless the database, we can use any type database system
    require('db.php');
    //$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=', '', '');

    if (empty($id))
    {
        $sql = "INSERT INTO restaurants (nm, addr, phone, rst_tp, logo) VALUES (:nm, :addr, :phone, :rst_tp, :logo)";
    }
    else
    {
        $sql = "UPDATE restaurants SET nm = :nm, addr = :addr, phone = :phone, rst_tp = :rst_tp, logo = :logo WHERE id = :id";
    }
    // set up and execute an INSERT command

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':nm', $nm, PDO::PARAM_STR, 60);
    $cmd->bindParam(':addr', $addr, PDO::PARAM_STR, 120);
    $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 15);
    $cmd->bindParam(':rst_tp', $rst_tp, PDO::PARAM_STR, 50);
    $cmd->bindParam(':logo', $logo, PDO::PARAM_STR, 100);

    if (!empty($id)) // id가 있다면 cmd에 id도 bindParam으로 추가함
    {
        $cmd->bindParam('id', $id, PDO::PARAM_INT);
    }
    $cmd->execute();

    // disconnect!!! after inserting, disconnect from the database
    $db = null;

    header('location:restaurants.php');
}

?>

<?php require('footer.php'); ?>
