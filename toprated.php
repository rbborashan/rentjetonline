<?php
    $uid = $_GET['UserId'];
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

    $query = "SELECT * FROM Product_User";

    if (!($result = mysql_query($query)))
        die("Couldn't execute query:".mysql_error());

    $ratings = array(0,0,0,0,0,0,0,0,0,0);
    $usersRated = array(0,0,0,0,0,0,0,0,0,0);
    while ($row = mysql_fetch_assoc($result)) {
        $index = $row['p_id'] - 1;
        $ratings[$index] = $ratings[$index] + $row['rating'];
        $usersRated[$index] = $usersRated[$index] + 1;
    }

    for ($i = 0; $i < 10; $i++)
        $ratings[$i] = $ratings[$i]/$usersRated[$i];

    $pid_by_views = array(1,2,3,4,5,6,7,8,9,10);
    array_multisort($ratings, SORT_DESC, $pid_by_views);

    for ($i = 0; $i < 5; $i++) {
        if ($ratings[$i] ==  0)
            break;

        $pid = $pid_by_views[$i];
        echo  $products[$pid - 1];
        echo "\n";
        echo  "http://www.rentjetonline.com/jet.php?jet=$pid&uid=$uid&siteid=$siteid";
        echo "\n";
        echo $ratings[$i];
        echo "\n";
    }
?>
