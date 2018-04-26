<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>New User Created</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            extract($_POST);

            $query = "INSERT INTO User(fname,lname,email,address,phone,cellphone,password)
                      VALUES('$fname','$lname','$email','$address','$home','$cell','$pass')";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!mysql_query($query))
                die("Couldn't execute query:".mysql_error());

            echo "<div class=\"opening\">
                    <h2 class=\"title\">New User Created</h2>
                  </div>
                  <div class=\"small-separator\"></div>
                  <div class=\"smallblock\">
                    <span class=\"new-user\">
                        $fname $lname<br>$address<br>
                        $email<br>$home<br>$cell<br><br>
                        <a href=\"users.php\">< Go Back</a>
                    </span>
                  </div>
                  <div class=\"small-separator\"></div>";

            mysql_close($link);
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
