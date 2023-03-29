<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-main.css">
    <link rel="stylesheet" type="text/css" href="css/style-obiekty.css">
    <title>Strona główna</title>
</head>
<body>

    <?php

        include("get_objects_routes/objects.php");
        //require_once("chart/index.php");

        //run funciton with saveing move
        //save_move_on_page();
    
    ?>


    <div id="baner-section">
        <h3>Najwspanialsze zabytki w Szczecinie</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque orci velit, consectetur fermentum vulputate et, pellentesque quis metus. Aenean at dictum ipsum. Morbi volutpat ut enim sit amet pretium. Morbi metus urna, fermentum at congue ac, semper et sem. In vel purus suscipit, imperdiet dui a, faucibus leo. Sed id sollicitudin tellus, at pulvinar urna. Sed sagittis, odio non eleifend facilisis, felis lacus aliquam risus, quis viverra risus quam ut ante. Praesent feugiat fringilla magna, a blandit felis fermentum nec. Vestibulum bibendum maximus mi non volutpat. Aliquam id elementum erat, quis ullamcorper orci.</p>
    </div>

    <div id="blocks-holder">
        <div class="block">
            <div class="img" style="background-image: url('img/icon/about-us.png');"></div>

            <div class="text-holder">
                <div class="header-info">
                    <h3>O nas</h3>
                </div>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque orci velit, consectetur fermentum vulputate et, pellentesque quis metus. Aenean at dictum ipsum. Morbi volutpat ut enim sit amet pretium. Morbi metus urna, fermentum at congue ac, semper et sem.</p>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="img" style="background-image: url('img/icon/anchor.png');"></div>

            <div class="text-holder">
                <div class="header-info">
                    <h3>Co u nas doświadczysz</h3>
                </div>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque orci velit, consectetur fermentum vulputate et, pellentesque quis metus. Aenean at dictum ipsum. Morbi volutpat ut enim sit amet pretium. Morbi metus urna, fermentum at congue ac, semper et sem.</p>
                </div>
            </div>
        </div>
        
        <div class="block">
            <div class="img" style="background-image: url('img/icon/payment-method.png');"></div>

            <div class="text-holder">
                <div class="header-info">
                    <h3>Zaufane płatności</h3>
                </div>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque orci velit, consectetur fermentum vulputate et, pellentesque quis metus. Aenean at dictum ipsum. Morbi volutpat ut enim sit amet pretium. Morbi metus urna, fermentum at congue ac, semper et sem.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="best">
        <div class="best-header">
            <h2>Najpopularniejsze obiekty</h2>
            <p>Są to najpopulatnriejsze obiekty które są odwiedzane i polubione przez naszych uytkowników</p>
        </div>

        <div class="data-best">
            <form method="POST">
                <?php
                    //sql function
                    $sql = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa ORDER BY (Obiekty.Ilosc_wejsc) DESC LIMIT 3";

                    $print_objects = new GetObjects();
                    $print_objects->check_data_and_print($sql);
                ?>
            </form>
        </div>
    </div>
    
    <!----DODAC OBIEKTY----->

</body>
</html>