<?php
    session_start();
    $page = basename($_SERVER['PHP_SELF']);

    if ($page == "index.php") {
        echo "<nav>
                <a href=\"index.php\" class=\"nav-current\">Home</a>
                <a href=\"about.php\" class=\"nav\">About Us</a>
                <a href=\"products.php\" class=\"nav\">Rent</a>
                <a href=\"news.php\" class=\"nav\">News</a>
                <a href=\"contacts.php\" class=\"nav\">Contacts</a>
                <a href=\"users.php\" class=\"nav\">Users</a>";
    }
    elseif ($page == "about.php") {
        echo "<nav>
                <a href=\"index.php\" class=\"nav\">Home</a>
                <a href=\"about.php\" class=\"nav-current\">About Us</a>
                <a href=\"products.php\" class=\"nav\">Rent</a>
                <a href=\"news.php\" class=\"nav\">News</a>
                <a href=\"contacts.php\" class=\"nav\">Contacts</a>
                <a href=\"users.php\" class=\"nav\">Users</a>";
    }
    elseif ($page == "products.php" || $page == "jet.php"
                                    || $page == "review.php"
                                    || $page == "jetreviews.php"
                                    || $page == "topproducts.php"
                                    || $page == "topRated.php"
                                    || $page == "mostReviewed.php") {
        echo "<nav>
                <a href=\"index.php\" class=\"nav\">Home</a>
                <a href=\"about.php\" class=\"nav\">About Us</a>
                <a href=\"products.php\" class=\"nav-current\">Rent</a>
                <a href=\"news.php\" class=\"nav\">News</a>
                <a href=\"contacts.php\" class=\"nav\">Contacts</a>
                <a href=\"users.php\" class=\"nav\">Users</a>";
    }
    elseif ($page == "news.php") {
        echo "<nav>
                <a href=\"index.php\" class=\"nav\">Home</a>
                <a href=\"about.php\" class=\"nav\">About Us</a>
                <a href=\"products.php\" class=\"nav\">Rent</a>
                <a href=\"news.php\" class=\"nav-current\">News</a>
                <a href=\"contacts.php\" class=\"nav\">Contacts</a>
                <a href=\"users.php\" class=\"nav\">Users</a>";
    }
    elseif ($page == "contacts.php") {
        echo "<nav>
                <a href=\"index.php\" class=\"nav\">Home</a>
                <a href=\"about.php\" class=\"nav\">About Us</a>
                <a href=\"products.php\" class=\"nav\">Rent</a>
                <a href=\"news.php\" class=\"nav\">News</a>
                <a href=\"contacts.php\" class=\"nav-current\">Contacts</a>
                <a href=\"users.php\" class=\"nav\">Users</a>";
    }
    elseif ($page == "users.php" || $page == "useradd.php"
                                 || $page == "usersearch.php"
                                 || $page == "allusers.php") {
        echo "<nav>
                <a href=\"index.php\" class=\"nav\">Home</a>
                <a href=\"about.php\" class=\"nav\">About Us</a>
                <a href=\"products.php\" class=\"nav\">Rent</a>
                <a href=\"news.php\" class=\"nav\">News</a>
                <a href=\"contacts.php\" class=\"nav\">Contacts</a>
                <a href=\"users.php\" class=\"nav-current\">Users</a>";
    }
    else {
        echo "<nav>
                <a href=\"index.php\" class=\"nav\">Home</a>
                <a href=\"about.php\" class=\"nav\">About Us</a>
                <a href=\"products.php\" class=\"nav\">Rent</a>
                <a href=\"news.php\" class=\"nav\">News</a>
                <a href=\"contacts.php\" class=\"nav\">Contacts</a>
                <a href=\"users.php\" class=\"nav\">Users</a>";
    }

    if ($_SESSION["currentuser"])
        echo "<a href=\"login.php\" class=\"nav-login\">Logout</a></nav>";
    else
        echo  "<a href=\"login.php\" class=\"nav-login\">Login</a></nav>";
 ?>
