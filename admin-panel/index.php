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

    <div id="main">
        <div id='left-menu'>
            <a class='links-menu' href="index.php?strona=main">
                <div class='option'>
                    <div class='hover' id='strona-glowna'>
                        <p class="main-option">Strona główna</p>
                    </div>
                </div>
            </a>        

            <div class='holder-option'>
                <a class='links-menu' href="index.php?strona=uzytkownicy/uzytkownicy">
                    <div class='option'>
                        <div class='hover' id='uzytkownicy'>
                            <p class="main-option">Użytkownicy</p>
                        </div>
                    </div>
                </a>
                <a class='links-menu' href="index.php?strona=uzytkownicy/dodaj-uzytkownika">
                    <div class='others-option'>
                        <div class="hover" id="dodaj-uzytkownika">
                            <p class="other-option">Dodaj użytkownika</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <a class='links-menu' href="index.php?strona=trasy/trasy">
                <div class='option'>
                    <div class='hover' id='trasy'>
                        <p class="main-option">Trasy</p>
                    </div>
                </div>
            </a>

            <a class='links-menu' href="index.php?strona=architekci/architekci">
                <div class='option'>
                    <div class='hover' id='architekci'>
                        <p class="main-option">Architekci</p>
                    </div>
                </div>
            </a>

            <a class='links-menu' href="index.php?strona=obiekty/obiekty">
                <div class='option'>
                    <div class='hover' id='obiekty'>
                        <p class="main-option">Obiekty</p>
                    </div>
                </div>
            </a>
        </div>

        <?php
            require_once("../connection.php");
        ?>

        <div id=pageContent>
            <?php 
                $strona = "main";
                //if isset variable strona set value from strona to variable strona
                if(isset($_GET['strona'])) {
                    $strona = $_GET['strona'];
                }

                //include page 
                require_once($strona.'.php');
            ?>
        </div>
    </div>

    <script>

        function change_menu_option_color() {
            //get page from PHP
            let page = <?php echo json_encode($strona); ?>;

            //split page
            let split_page = page.split("/");

            //if page ins't main chnage color from $_GET page
            if(page != "main" && (split_page[0] == "uzytkownicy")) {
                //chnage color of menu option 
                document.querySelector("#"+split_page[1]).style = "background-color: #666666;";
                //set display block for others option if you have open parent tab
                document.querySelector(".others-option").style = "display: block;";
            }
            else if(page == "main") {
                document.querySelector("#strona-glowna").style = "background-color: #666666;";
            }
            //if page is main change color for main id object
            else {
                //chnage color of menu option 
                document.querySelector("#"+split_page[0]).style = "background-color: #666666;";
            }
        }

        window.onload = function() {
            change_menu_option_color();
        }

    </script>


</body>
</html>