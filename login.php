<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>User Login</title>
        <?php
            include("header.php");
            session_unset();
            session_destroy();
        ?>
    </head>
    <body>
        <div class="opening">
            <h2 class="title">User Login</h2>
        </div>
        <div class="small-separator"></div>
        <div class="smallblock">
            <form method="post" action="logout.php">
                <p class="form-label">Email</p>
                <input type="text" name="email"/>
                <br>
                <p class="form-label">Password</p>
                <input type="password" name="pass"/>
                <br>
                <input class="form-submit" type="submit" value="Submit"/>
            </form>
        </div>
        <div class="small-separator"></div>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
