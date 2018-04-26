<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>User Search</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            extract($_POST);

            if (!$search) {
                echo "<div class=\"opening\">
                        <h2 class=\"title\">Error</h2>
                        <div class=\"error-block\">Empty search field!
                            <a href=\"users.php\" class=\"back-link\">< Go Back</a>
                        </div>
                      </div>";
                die();
            }

            $query = "SELECT * FROM User WHERE ";

            if ($searchBy == "name") {
                $query = $query."fname = '$search' OR lname = '$search'";
            }
            elseif ($searchBy == "email") {
                $query = $query."email = '$search'";
            }
            else { # Search by phone
                $query = $query."phone = '$search' OR cellphone = '$search'";
            }

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

                echo "<div class=\"opening\">
                        <h2 class=\"title\">User Search</h2>
                      </div>
                      <div class=\"list\">
                          <div class=\"separator\"></div>";

                if (mysql_num_rows($result) == 0) {
                    echo "<p class=\"list-title\">
                            The search returned no results.
                          </p>";
                }
                else {
                    while ($row = mysql_fetch_assoc($result)) {
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $email = $row['email'];
                        $address = $row['address'];
                        $cell = $row['cellphone'];
                        $home = $row['phone'];

                        echo "<p class=\"list-title\">$fname&nbsp;$lname</p>
                            <p class=\"list-item\">$email</p>
                            <p class=\"list-item\">$address</p>
                            <p class=\"list-item\">Cell: $cell</p>
                            <p class=\"list-item\">Home: $home</p>";
                    }
                }
                echo "<a href=\"users.php\" class=\"back-link\">
                      < Go Back</a></div><div class=\"separator\"></div>";

                mysql_close($link);
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
