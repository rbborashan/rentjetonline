<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Users</title>
        <?php include("header.php");?>
    </head>
    <body>
        <div class="opening">
            <h2 class="title">Users</h2>
        <div class="separator"></div>
        <div class="usersblock">
            <button class="users-link" onclick="showSearchForm()">Find a User</button>
            <br>
            <button class="users-link" onclick="showNewUserForm()">Create a New User</button>
            <br>
            <a href="allusers.php" class="users-link">View All Users</a>
        </div>
        </div>
        <div id="center" class="separator"></div>
        <div id="form"></div>
        <div id="bottom"></div>
    <script>
        function showSearchForm() {
            document.getElementById('center').className = "grey-separator";
            var form = document.getElementById('form');
            form.className = "usersblock";
            form.innerHTML = '<h3 class="form-title">Find a User</h3>' +
            '<form method="post" action="usersearch.php">' +
            '<span class="form-label">🔎&nbsp</span>' +
            '<input type="text" name="search"><br>' +
            '<span class="form-label">Name</span>' +
            '<input class="radio" type="radio" name="searchBy" value="name" checked>' +
            '<span class="form-label">Email</span>' +
            '<input class="radio" type="radio" name="searchBy" value="email">' +
            '<span class="form-label">Phone Number</span>' +
            '<input type="radio" name="searchBy" value="phone"><br>' +
            '<input class="form-submit" type="submit" value="Search"/>';
            document.getElementById('bottom').className = "separator";
        }

        function showNewUserForm() {
            document.getElementById('center').className = "grey-separator";
            var form = document.getElementById('form');
            form.className = "usersblock";
            form.innerHTML = '<h3 class="form-title">Create a New User</h3>' +
            '<form method="post" action="useradd.php">' +
            '<span class="form-label-inline">First Name:</span>' +
            '<input type="text" name="fname"><br>' +
            '<span class="form-label-inline">Last Name:</span>' +
            '<input type="text" name="lname"><br>' +
            '<span class="form-label-inline">Email:</span>' +
            '<input type="text" name="email"><br>' +
            '<span class="form-label-inline">Address:</span>' +
            '<input type="text" name="address"><br>' +
            '<span class="form-label-inline">Cell Number:</span>' +
            '<input type="text" name="cell"><br>' +
            '<span class="form-label-inline">Home Number:</span>' +
            '<input type="text" name="home"><br>' +
            '<span class="form-label-inline">Password:</span>' +
            '<input type="password" name="pass"><br>' +
            '<input class="form-submit" type="submit" value="Add User"/>';
            document.getElementById('bottom').className = "separator";
        }
    </script>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
