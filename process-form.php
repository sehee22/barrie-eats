<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process Form</title>
</head>
<body>

<?php
// take the value from each form input and store in a variable
// case sensitive!!
// double quote and sing quote 일반적으로 차이는 없지만
// variable에서 single을 쓰면 변수 이름 그 자리를 보여줌, 값을 보여주고 싶으면 double 사용할 것

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];

echo "$firstName $lastName <br />";
echo $email;
?>

</body>
</html>