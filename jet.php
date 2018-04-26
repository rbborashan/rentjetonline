<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <?php include("header.php");?>
    </head>
    <body>
        <?php
            extract($_GET);

            if (!$jet) {
                echo "<div class=\"opening\">
                        <h2 class=\"title\">Error</h2>
                        <div class=\"error-block\">No jet selected!
                            <a href=\"products.php\" class=\"back-link\">< Go Back</a>
                        </div>
                      </div>";
                die();
            }

            $_SESSION["currentuser"] = $uid;
            $_SESSION["site_id"] = $siteid;

            $siteId = $_SESSION["site_id"];

            if (!$siteId)
                $siteId = 1;

            $id = $_SESSION["currentuser"];
            if (!$id) {
                $id = 0;
            }

            $query = "SELECT * FROM Product_User WHERE id=$id AND p_id=$jet AND
                      site_id=$siteId";

             if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                             "!s8cmrtJms7cmrtJm")))
                      die("Couldn't connect to db:".mysql_error());

             if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

             if (!($result = mysql_query($query)))
                  die("Couldn't execute query:".mysql_error());

            if (mysql_num_rows($result) == 0) {
                $query = "INSERT INTO Product_User VALUES($jet, $siteId, $id, 1, 0, NULL)";
            }
            else {
                $query = "SELECT view_count FROM Product_User WHERE p_id=$jet AND
                          site_id=$siteId AND id=$id";

                if (!($result = mysql_query($query)))
                    die("Couldn't execute query:".mysql_error());

                $view_count = mysql_result(mysql_query("$query"), 0);
                $view_count++;

                $query = "UPDATE Product_User SET view_count=$view_count WHERE
                          p_id=$jet AND site_id=$siteId AND id=$id";
            }

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            $query = "SELECT view_count FROM Product WHERE p_id = $jet";
            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            $view_count = mysql_result(mysql_query("$query"), 0);
            $view_count++;

            $query = "UPDATE Product SET view_count=$view_count WHERE p_id=$jet";

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());


            $query = "SELECT * FROM Product WHERE p_id = $jet";

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            if (mysql_num_rows($result) == 0) {
                echo "<div class=\"opening\">
                        <h2 class=\"title\">Error</h2>
                        <div class=\"error-block\">Invalid jet selection!
                            <a href=\"products.php\" class=\"back-link\">< Go Back</a>
                        </div>
                      </div>";
                die();
            }

            $row = mysql_fetch_row($result);

            mysql_close($link);

            echo "<title>$row[1]</title>
                 <div class=\"opening\">
                    <h2 class=\"title\">$row[1]
                        <span class=\"subtitle\">-&nbsp;&nbsp;\$$row[2].00/hr</span>
                    </h2>
                 </div>
                 <div class=\"list\">
                    <div class=\"separator\"></div>
                    <img src=\"$row[3]\" alt=\"$row[1]\" class=\"rent-img\">
                    <br><br>
                    <a href=\"images/$row[4]\"
                    style=\"display: block;\">
                        <img src=\"images/$row[4]\" alt=\"$row[1]\"
                         class=\"preview-img\" align=\"left\">
                    </a>
                    <a href=\"images/$row[5]\">
                        <img src=\"images/$row[5]\" alt=\"$row[1]\"
                         class=\"preview-img\" align=\"left\">
                    </a>
                    <span class=\"list-item\">Range: $row[6]</span><br><br>
                    <span class=\"list-item\">City Pairs: $row[7]</span><br><br>
                    <span class=\"list-item\">Cruising Speed: $row[8] mph</span><br><br>
                    <span class=\"list-item\">Passenger Capacity: $row[9]</span>
                    <br><br><br><span class=\"list-item\">$row[10]</span>";
         ?>
        <div>
            <br><br>
            <form method="post" action="review.php">
                <span class="list-item">Review this product:&nbsp;</span>
                <br><br>
                <textarea type="text" name="review" rows="5" cols="100"
                          class="review"></textarea>
                <br>
                <span class="list-item">Rating:&nbsp;</span>
                <select class="rating" name="rating">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <?php
                    echo "<input type=\"hidden\" name=\"jet\" value=\"$jet\">
                          <input type=\"hidden\" name=\"siteId\" value=\"$siteId\">
                          <input type=\"hidden\" name=\"uid\" value=\"$uid\">
                          <input type=\"submit\" value=\"Submit\"
                                 class=\"form-submit-small\">
                          <a href=\"jetreviews.php?jet=$jet&uid=$uid&siteid=$siteId\" class=\"back-link\">
                          View jet reviews</a>
                    </form>";
                ?>
            </div>
        </div>
        <div class="separator"></div>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
