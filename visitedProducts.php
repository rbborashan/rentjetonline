<?php
    $uid = $_GET['UserId']; //get user name and password
    $siteid = $_GET['SiteId'];

    $query = "SELECT * FROM Product";

    if (!($link = mysql_connect("localhost", "rentjeto_admin",
                                "!s8cmrtJms7cmrtJm")))
        die("Couldn't connect to db:".mysql_error());

    if (!mysql_select_db("rentjeto_data", $link))
        die("Couldn't open db".mysql_error());

    if (!($result = mysql_query($query)))
        die("Couldn't execute query:".mysql_error());

    $products = array();
    while ($row = mysql_fetch_assoc($result)) {
        array_push($products, $row['name']);
    }

    $query = "SELECT * FROM Product_User WHERE id=$uid AND site_id=$siteid";

    if (!($result = mysql_query($query)))
        die("Couldn't execute query:".mysql_error());

    while ($row = mysql_fetch_assoc($result)) {
        $pid = $row['p_id'];
        echo  $products[$pid - 1];
        echo "\n";
        echo  "http://www.rentjetonline.com/jet.php?jet=$pid&uid=$uid&siteid=$siteid";
        echo "\n";
    }
?>
