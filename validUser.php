<?php
    $fname = $_GET['fname']; //get user name and password
    $password = $_GET['password'];

    $query = "SELECT * FROM User WHERE id='$fname' OR email='$fname'";

    if (!($link = mysql_connect("localhost", "rentjeto_admin",
                           "!s8cmrtJms7cmrtJm")))
        die("Couldn't connect to db:".mysql_error());

    if (!mysql_select_db("rentjeto_data", $link))
        die("Couldn't open db".mysql_error());

    if (!($result = mysql_query($query)))
        die("Couldn't execute query:".mysql_error());

    $validUser = false;
    $userId = 0;
    $userName = "";

    if (!mysql_num_rows($result) == 0)
    {
        while ($row = mysql_fetch_assoc($result))
        {
            if( $row['password'] == $password )
            {
                $validUser = true;
                $userId = $row['id'];
                $userName = $row['email'];
            }
        }
    }
    if ($validUser)
    {
        session_start();
        $_SESSION['LoggedIn'] = "yes";
        $_SESSION['UserId'] = $userId;
        $_SESSION['UserName'] = $userName;
        echo "1\n";
        echo  $userId;
        echo "\n";
        echo  $userName;

    }
    else
        echo "0";
?>
