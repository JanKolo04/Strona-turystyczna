<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasy.css">
</head>
<body>

    <?php

        function all_routes() {
            global $con;

            //get all routes
            $sql_routes = "SELECT * FROM Trasy";
            $query_routes = $con->query($sql_routes);

            //show routes
            if($query_routes->num_rows > 0) {
                while($row_routes = $query_routes->fetch_array(MYSQLI_ASSOC)) {
                    //link_to_routes
                    $link_to_routes = "index.php?strona=architekci/architekt&architekt={$row_routes['Id']}";

                    //if media is null add grey bacground into routesImg
                    $img = $row_routes['Media'].'/main 1.jpeg';
                    if($img == "/main 1.jpeg") {
                        $img = "brak-zdjecia.png";
                    }

                    echo "
                        <div class='routesHolder'>
                            <a href='$link_to_routes'><img class='routesImg' src='img/$img'></a>
                            <div class='routesInfo'>
                                <a class='routesName' href='$link_to_routes'><h4>{$row_routes['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                            </div>
                        </div>
                    ";
                }
            }
        }

    ?>

    <h1>Trasy</h1>
    <div id='routesMainHolder'>
        <?php all_routes(); ?>
    </div>

</body>
</html>