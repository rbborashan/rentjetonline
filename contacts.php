<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Company Contacts</title>
        <?php include("header.php");?>
    </head>
    <body>
        <div class="opening">
            <h2 class="title">Company Contacts</h2>
        </div>
        <div class="list">
            <div class="separator"></div>
            <?php
                $contents = file_get_contents('contacts.txt');
                $contacts = explode("$", $contents);

                foreach ($contacts as $contact => $details) {
                    $fields = explode("\n", $details);
                    foreach ($fields as $field => $info) {
                        if ($field % 3 == 1) {
                            echo "<p class=\"list-title\">";
                            echo $info."</p>";
                        }
                        else {
                            echo "<p class=\"list-item\">";
                            echo $info."<br></p>";
                        }
                    }
                }
            ?>
        </div>
        <div class="separator"></div>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
