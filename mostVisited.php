<?php
    extract($_GET);
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
        $query = "SELECT p_id,name,image_url,description,view_count
                  FROM Product WHERE p_id = $pid";

        if (!($result = mysql_query($query)))
            die("Couldn't execute query:".mysql_error());

        $row = mysql_fetch_row($result);

        $p_id = $row[0];
        $name = $row[1];
        $view_count = $row[4];
        echo $name;
        echo "\n";
        echo "http://www.rentjetonline.com/jet.php?jet=$p_id&uid=$UserId&siteid=$SiteId";
        echo "\n";
        echo $view_count;
        echo "\n";

    }
?>
