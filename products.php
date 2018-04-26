<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Products</title>
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            if (!$_SESSION["currentuser"] || !$_SESSION["site_id"]) {
                $uid = 0;
                $siteid = 1;
            }
            else {
                $uid = $_SESSION["currentuser"];
                $siteid = $_SESSION["site_id"];
            }

            $query = "SELECT p_id,name,image_url,description FROM Product";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            echo "<div class=\"opening\">
                    <h2 class=\"title\">Available Jets</h2><br>
                    <a href=\"topproducts.php\" class=\"rent-link\">
                        View Most Visited Products
                    </a>
                    <a href=\"topRated.php\" class=\"rent-link\">
                        View Top Rated Products
                    </a>
                    <a href=\"mostReviewed.php\" class=\"rent-link\">
                        View Most Reviewed Products
                    </a><br><br><br>
                 </div>
                 <div class=\"list\">
                     <div class=\"separator\"></div><br>";

            while ($row = mysql_fetch_assoc($result)) {
                $p_id = $row['p_id'];
                $name = $row['name'];
                $image_url = $row['image_url'];
                $description = $row['description'];

                echo "<br><a href=\"jet.php?jet=$p_id&uid=$uid&siteid=$siteid\" class=\"preview-title\">
                      $name<br><br>
                        <img src=\"$image_url\" alt=\"$name\"
                             class=\"preview-img\" align=\"left\" hspace=\"20\">
                     </a>
                     <p class=\"description\">$description</p>";

                if ($p_id != 10)
                    echo "<div style=\"margin-top: 30px;\"
                               class=\"grey-separator\"></div>";
            }

            mysql_close($link);

            echo "</div><div class=\"separator\"></div>";
        ?>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
