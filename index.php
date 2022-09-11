<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-index.css">
</head>
<body>

    <?php
        include("connection.php");
    ?>

    <div id=pageContent>
        <?php 
            $strona = "login";
            if(isset($_GET['strona'])) {
                $strona = $_GET['strona'];
            }

            include($strona.'.php');
        ?>
    </div>

</body>
</html>