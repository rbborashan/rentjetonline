<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Login Success</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            extract($_POST);

            if (!$email || !$pass)
                blankFields();

            $query = "SELECT password FROM User WHERE email = '$email'";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());


            $password = mysql_result(mysql_query($query), 0);

            if (mysql_num_rows($result) == 0 || $password != $pass)
                accessDenied();
            else
                accessGranted($email);

            mysql_close($link);

            function accessGranted($email) {

                $query = "SELECT id FROM User WHERE email = '$email'";

                $id = mysql_result(mysql_query($query), 0);
                $_SESSION["currentuser"] = $id;
                $_SESSION["site_id"] = 1;
                $_SESSION["username"] = $email;

                echo  "<div class=\"opening\">
                        <h2 class=\"title\">Success!</h2>
                        <div class=\"error-block\">You are now logged in as $email.
                            <a href=\"login.php\" class=\"back-link\">Sign Out</a>
                        </div>
                      </div>";
            }

            function accessDenied() {
                echo  "<div class=\"opening\">
                        <h2 class=\"title\">Access Denied</h2>
                        <div class=\"error-block\">Incorrect Username or Password!
                            <a href=\"login.php\" class=\"back-link\">< Go Back</a>
                        </div>
                      </div>";
            }

            function blankFields() {
                echo "<div class=\"opening\">
                        <h2 class=\"title\">Access Denied</h2>
                        <div class=\"error-block\">Empty Username or Password field!
                            <a href=\"login.php\" class=\"back-link\">< Go Back</a>
                        </div>
                      </div>";
                die();
            }
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
