<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Jet Reviews</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            extract($_GET);

            $query = "SELECT * FROM Product_User WHERE p_id=$jet";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            echo "<div class=\"opening\">
                    <h2 class=\"title\">Jet Reviews</h2>
                  </div>
                  <div class=\"list\">
                    <div class=\"separator\"></div>";

            while ($row = mysql_fetch_assoc($result)) {
                $rating = $row['rating'];
                $review = $row['review'];

                echo "<br><p class=\"list-item\">Rating:&nbsp;$rating</p>
                      <p class=\"list-item\">Review:&nbsp;$review</p>";
            }

            echo "<a href=\"jet.php?jet=$jet&uid=$uid&siteid=$siteid\" class=\"back-link\">
                  < Go Back</a></div><div class=\"separator\"></div>";

            mysql_close($link);
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
