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

    $query = "SELECT * FROM Product_User WHERE review IS NOT NULL";

    if (!($result = mysql_query($query)))
        die("Couldn't execute query:".mysql_error());

    $reviews = array(0,0,0,0,0,0,0,0,0,0);
    while ($row = mysql_fetch_assoc($result))
    {
        $index = $row['p_id'] - 1;
        $reviews[$index] = $reviews[$index] + 1;
    }

    $pid_by_review = array(1,2,3,4,5,6,7,8,9,10);
    array_multisort($reviews, SORT_DESC, $pid_by_review);

    for($i = 0; $i < 5; $i++) {
        if($reviews[$i] ==  0)
        {
            break;
        }

        $pid = $pid_by_review[$i];
        echo  $products[$pid - 1];
        echo "\n";
        echo  "http://www.rentjetonline.com/jet.php?jet=$pid&uid=$uid&siteid=$siteid";
        echo "\n";
        echo $reviews[$i];
        echo "\n";
    }
?>
