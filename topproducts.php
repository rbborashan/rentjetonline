<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Most Visited</title>
        <?php include("header.php");?>
    </head>
    <body>
        <div class="opening">
            <h2 class="title">Most Visited Products</h2>
        </div>
        <div class="list">
            <div class="separator"></div><br>
        <?php

            if (!$_SESSION["currentuser"] || !$_SESSION["site_id"]) {
                $uid = 0;
                $siteid = 1;
            }
            else {
                $uid = $_SESSION["currentuser"];
                $siteid = $_SESSION["site_id"];
            }

            $query = "SELECT p_id, view_count FROM Product";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                   "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            $index = 0;
            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[$index] = $row;
                $index++;
            }

            $temp = 0;
            for ($i = 0; $i < count($rows) - 1; $i++) {
                for ($j = 1; $j < count($rows) - $i; $j++) {
                    if ($rows[$j-1]["view_count"] < $rows[$j]["view_count"]) {
                        $temp = $rows[$j-1];
                        $rows[$j-1] = $rows[$j];
                        $rows[$j] = $temp;
                    }
                }
            }

            for ($i = 0; $i < 5; $i++) {
                $pid = $rows[$i]['p_id'];
                $query = "SELECT p_id,name,image_url,description, view_count
                          FROM Product WHERE p_id = $pid";

                if (!($result = mysql_query($query)))
                    die("Couldn't execute query:".mysql_error());

                $row = mysql_fetch_row($result);

                $p_id = $row[0];
                $name = $row[1];
                $image_url = $row[2];
                $description = $row[3];
                $view_count = $row[4];

                echo "<br><a href=\"jet.php?jet=$p_id&uid=$uid&siteid=$siteid\"
                             class=\"preview-title\">
                      $name - $view_count views<br><br><br>
                      <img src=\"$image_url\" alt=\"$name\"
                           class=\"preview-img\" align=\"left\" hspace=\"20\">
                           </a>
                     <p class=\"description\">$description</p>";

                if ($i < 4) {
                    echo "<div style=\"margin-top: 30px;\"
                               class=\"grey-separator\"></div>";
                }
            }

                mysql_close($link);

                echo "</div><div class=\"separator\"></div>";
        ?>
    </body>
    <footer>
    </footer>
<html>
