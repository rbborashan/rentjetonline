<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Review Submitted</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            extract($_POST);

            if (!$_SESSION["currentuser"]) {
                echo "<div class=\"opening\">
                        <h2 class=\"title\">Error</h2>
                        <div class=\"error-block\">You must be signed in to review a product.
                            <a href=\"jet.php?jet=$jet\" class=\"back-link\">< Go Back</a>
                        </div>
                      </div>";
                die();
            }

            $id = $_SESSION["currentuser"];

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                        "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            $query = "SELECT * FROM Product_User WHERE p_id=$jet AND
                      site_id=$siteId AND id=$id";

            $review = mysql_real_escape_string($review, $link);

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            if (mysql_num_rows($result) == 0) {
                $query = "INSERT INTO Product_User VALUES($jet,$siteId,$id,0,$rating,
                                                          '$review')";
            }
            else {
                $query = "UPDATE Product_User SET rating=$rating, review='$review' WHERE
                          p_id=$jet AND site_id=$siteId AND id=$id";
            }

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            mysql_close($link);

            $review = stripslashes($review);

            echo "<div class=\"opening\">
                    <h2 class=\"title\">Review Submitted</h2>
                  </div>
                  <div class=\"separator\"></div>
                  <div class=\"textblock\">
                      <p class=\"text-section\">Rating: $rating<br><br>
                      You Wrote: <br><br>$review
                      <br><br><br>
                      <a href=\"jetreviews.php?jet=$jet&uid=$uid&siteid=$siteId\" class=\"rent-link\">View Jet Reviews</a>
                      <br><br><br>
                      <a href=\"jet.php?jet=$jet&uid=$uid&siteid=$siteId\" class=\"back-link\">< Go Back</a>
                      </p>
                  </div>
                  <div class=\"separator\"></div>";
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
