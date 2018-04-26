<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>All Users</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            $query = "SELECT * FROM User";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            echo "<div class=\"opening\">
                    <h2 class=\"title\">All Users</h2>
                  </div>
                  <div class=\"list\">
                  <div class=\"separator\"></div>";

            while ($row = mysql_fetch_assoc($result)) {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $address = $row['address'];
                $cell = $row['cellphone'];
                $home = $row['phone'];

                echo "<br><p class=\"list-title\">$fname&nbsp;$lname</p>
                <p class=\"list-item\">$email</p>
                <p class=\"list-item\">$address</p>
                <p class=\"list-item\">Cell: $cell</p>
                <p class=\"list-item\">Home: $home</p>";
            }

            mysql_close($link);

            echo "<a href=\"users.php\" class=\"back-link\">
                  < Go Back</a></div><div class=\"separator\"></div>";
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
