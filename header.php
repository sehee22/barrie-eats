<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
    <!-- since this file is for header, (body, html) tag will go to footer file -->
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="default.php">Barrie Eats</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="restaurants.php">Restaurants</a></li>
                <li><a href="reviews.php">Reviews</a></li>
                <?php
                session_start();
                if (isset($_SESSION['userId']))
                {
                    echo '<li><a href="restaurant.php">Add a NEW Restaurant</a></li>';
                    echo '<li><a href="review.php">Add a NEW Riview</a></li>';
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(empty($_SESSION['userId']))
                {
                    echo '<li><a href="register.php">Register</a></li>
                            <li><a href="login.php">Login</a></li>';
                }
                else
                {
                    echo '<li><a href="#">' . $_SESSION['username'] . '</a></li>
                            <li><a href="logout.php">Logout</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>


    <!-- Facebook Comment -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
