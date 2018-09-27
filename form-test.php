<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Test</title>
</head>
<body>

<form  action="process-form.php" method="post"> <!-- default is GET, so this statement should be written -->
    <fieldset>
        <label for="firstName">First Name: </label>
        <input name="firstName" id="firstName" /> <!-- name is for PHP, id is for user/Java-->
    </fieldset>
    <fieldset>
        <label for="lastName">Last Name: </label>
        <input name="lastName" id="lastName" />
    </fieldset>
    <fieldset>
        <label for="email">Email: </label>
        <input name="email" id="email" />
    </fieldset>
    <button>Submit</button>
</form>
</body>
</html>