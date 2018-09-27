<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Details</title>
</head>
<body>
<h1>Restaurant Details</h1>

<form action="save-restaurant.php" method="post">
    <fieldset>
        <label form ="nm">Name: </label>
        <input name="nm" id="nm" />
    </fieldset>
    <fieldset>
        <label form ="addr">Addres: </label>
        <textarea name="addr" id="addr"></textarea>
    </fieldset>
    <fieldset>
        <label form ="phone">Phone: </label>
        <input name="phone" id="phone" />
    </fieldset>
    <button>Save</button>
</form>
</body>
</html>