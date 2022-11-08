<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasa.css">
    <link rel="stylesheet" type="text/css" href="css/style-obiekty.css">
    <script src="js/script-trasa.js"></script>
</head>
<body>

    <?php

        include("get_objects_routes/objects.php");

        class Route {
            function get_route_data() {
                global $con;

                //route id
                $route_id = $_GET['trasa'];

                //get all data
                $sql = "SELECT * FROM Trasy WHERE Id=$route_id";
                $query = mysqli_query($con, $sql);

                //if route with this ID exist return all data
                if($query->num_rows > 0) {
                    return mysqli_fetch_array($query);
                }
            }

            function route_name() {
                $row = $this->get_route_data();
                echo $row['Nazwa'];
            }

            function show_route_information() {
                //row
                $row = $this->get_route_data();

                echo "
                    <div id='routeName'>
                        <h2>{$row['Nazwa']}</h2>
                    </div>
                    <div id='shortDescription'>
                        <p>{$row['Opis']}</p>
                    </div>
                    <div id='buttonInfoHolder'>
                        <button id='routeButton' onclick='show_route_info();'>Informacje o trasie</button>
                    </div>
                    <div style='display: none;' id='infoHolder'>
                        <p>{$row['Informacje']}</p>
                    </div>
                ";
            }
        }

    ?>

    <title>Trasa <?php $route = new Route(); $route->route_name(); ?>
    </title>

    <div id='routeInfoHolder'>
        <?php $route->show_route_information(); ?>
    </div>

    <div id='objectsMainHolder'>
        <div id='objectsHolderHeader'>
            <h2>Obiekty na tej trasie</h2>
        </div>
        <div id='objectsHolder'>
            <form method="POST">
                <?php 
                    //sql function
                    $sql = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa WHERE Id_trasa={$_GET['trasa']} ORDER BY (Obiekty.Nazwa) ASC";

                    $close_obejcts = new GetObjects();
                    $close_obejcts->check_data_and_print($sql);
                ?>
            </form>
        </div>
    </div>

</body>
</html>