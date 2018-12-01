<?php
$title = "Register";
require ('header.php');
?>

<main class="container">
    <h1>User Registration</h1>
    <div class="alert alert-info" id="message">Please create your account</div>
    <form method="post" action="save-registration.php">
        <fieldset class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required
                   type="email" placeholder="email@email.com"
            />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <!-- number(d: digit), lower and upper character, at list 8 long characters -->
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-sm-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>

        <div class="g-recaptcha" data-sitekey="6Lf_OX4UAAAAAIDZVeBJBDB4Wag6fL6Sk1-Dwdbs"></div>

        <div class="col-sm-offset-2">
            <input type="submit" value="Register" class="btn btn-success" />
        </div>
    </form>
</main>


<script src="js/jquery-3.1.1.min.js"></script>


<script src="js/bootstrap.min.js"></script>


<?php require('footer.php'); ?>