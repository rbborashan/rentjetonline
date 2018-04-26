<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Top Rated</title>
        <?php include("header.php");?>
    </head>
    <body>
        <div class="opening">
            <h2 class="title">Top Rated</h2>
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

            $query = "SELECT * FROM Product";

            if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                        "!s8cmrtJms7cmrtJm")))
                die("Couldn't connect to db:".mysql_error());

            if (!mysql_select_db("rentjeto_data", $link))
                die("Couldn't open db".mysql_error());

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            $products = array();
            $imgs = array();
            $descs = array();
            while ($row = mysql_fetch_assoc($result)) {
                array_push($products, $row['name']);
                array_push($imgs, $row['image_url']);
                array_push($descs, $row['description']);
            }

            $query = "SELECT * FROM Product_User";

            if (!($result = mysql_query($query)))
                die("Couldn't execute query:".mysql_error());

            $ratings = array(0,0,0,0,0,0,0,0,0,0);
            $usersRated = array(0,0,0,0,0,0,0,0,0,0);
            while ($row = mysql_fetch_assoc($result))
            {
                $index = $row['p_id'] - 1;
                $ratings[$index] = $ratings[$index] + $row['rating'];
                $usersRated[$index] = $usersRated[$index] + 1;
            }

            for($i = 0; $i < 10; $i++)
            {
                $ratings[$i] = $ratings[$i]/$usersRated[$i];
            }

            $pid_by_views = array(1,2,3,4,5,6,7,8,9,10);
            array_multisort($ratings, SORT_DESC, $pid_by_views);

            for ($i = 0; $i < 5; $i++) {
                if ($ratings[$i] ==  0)
                    break;

                $pid = $pid_by_views[$i];
                $name =  $products[$pid - 1];
                $image_url = $imgs[$pid - 1];
                $description = $descs[$pid - 1];
                $rating = $ratings[$i];

                echo "<br><a href=\"jet.php?jet=$pid&uid=$uid&siteid=$siteid\"
                             class=\"preview-title\">
                      $name - Average Rating: $rating<br><br><br>
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
        <?php include("footer.php");?>
    </footer>
<html>
