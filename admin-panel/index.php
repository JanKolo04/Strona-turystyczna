<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-index.css">
    <script src="https://kit.fontawesome.com/fdfda35f5c.js" crossorigin="anonymous"></script>
</head>
<body>

    <div id='baner'>
        <div id='logo-holder'>
            <a id='logo' href='index.php?strona=main'><h3>Szlakiem Szczecina</h3>&nbsp<p id="logo-admin-panel">>> Panel Administratora</p></a>
        </div>
    </div>

    <div id='left-menu'>
        <a href="index.php?strona=uzytkownicy">
            <div class='option'>
                <p>Użytkownicy</p>
            </div>
        </a>
        
        <a href="index.php?strona=trasy">
            <div class='option'>
                <p>Trasy</p>
            </div>
        </a>

        <a href="index.php?strona=architekci">
            <div class='option'>
                <p>Architekci</p>
            </div>
        </a>

        <a href="index.php?strona=obiekty">
            <div class='option'>
                <p>Obiekty</p>
            </div>
        </a>
    </div>

    <?php
        require_once("../connection.php");
    ?>

    <div id=pageContent>
        <?php 
            $strona = "main";
            if(isset($_GET['strona'])) {
                $strona = $_GET['strona'];
            }

            require_once($strona.'.php');
        ?>
    </div>


</body>
</html>