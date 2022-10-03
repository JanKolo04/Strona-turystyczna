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
            <a id='logo' href='index.php?strona=main'><h3>Szlakiem Szczecina</h3></a>
        </div>
        <div id="links-holder">
            <a class='link' href="index.php?strona=trasy/trasy">Trasy</a>
            <a class='link' href="index.php?strona=obiekty/obiekty">Obiekty</a>
            <a class='link' href="index.php?strona=architekci/architekci">Architekci</a>

            <a id='account-link' href="index.php?strona=konto">Moje konto</a>
        </div>
    </div>
    <div style="height: 70px; width: 100%;"></div>

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

    <div id='footer'>
        <div id='about-page'>
            <h2>O nas</h2>
            <p id='about-us'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac purus in turpis venenatis suscipit. Sed at mauris volutpat nisi mollis varius non eu ex. Nulla nisl urna, eleifend a hendrerit quis, sodales ut massa. Aenean molestie ipsum a velit feugiat, vehicula facilisis quam dignissim. Sed tristique, nisl sodales vestibulum interdum, ipsum nisi sollicitudin nunc, vitae egestas orci odio non quam.</p>
        </div>

        <div id='nav-menu'>
            <h2>Menu</h2>
            <ul id='list'>
                <li id='first-link'><a class='link list-object' href="index.php?strona=trasy/trasy">Trasy</a></li>
                <li><a class='link list-object' href="index.php?strona=obiekty/obiekty">Obiekty</a></li>
                <li><a class='link list-object' href="index.php?strona=architekci/architekci">Architekci</a></li>
                <li><a class='link list-object' href="index.php?strona=konto">Moje konto</a></li>
            </ul>
        </div>

        <div id='contact'>
            <h2>Kontakt</h2>
            <div class='contact-data'>
                <i class="fa fa-map-marker"></i>
                <p>+48 123 123 123</p>
            </div>

            <div class='contact-data'>
                <i class="fa fa-phone"></i>
                <p>Żołnierska 53, Szczecin</p>
            </div>

            <div class='contact-data'>
                <i class="fa fa-envelope"></i>
                <p>biuro@turystyka.pl</p>
            </div>
        </div>
    </div>

</body>
</html>