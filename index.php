<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-index.css">
</head>
<body>

    <div id='baner'>
        <div id='logo-holder'>
            <a id='logo' href='index.php?strona=main'><h3>Szlakiem Szczecina</h3></a>
        </div>
        <div id="links-holder">
            <a href="index.php?strona=trasy/trasy">Trasy</a>
            <a href="index.php?strona=obiekty/obiekty">Obiekty</a>
            <a href="index.php?strona=architekci/architekci">Architekci</a>

            <a id='account-link' href="index.php?strona=konto">Moje konto</a>
        </div>
    </div>

    <?php
        include("connection.php");
    ?>

    <div id=pageContent>
        <?php 
            $strona = "main";
            if(isset($_GET['strona'])) {
                $strona = $_GET['strona'];
            }

            include($strona.'.php');
        ?>
    </div>

</body>
</html>