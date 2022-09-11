<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasa.css">
    <script src="js/script-trasa.js"></script>
</head>
<body>

    <?php

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
            $row = get_route_data();
            echo $row['Nazwa'];
        }

        function show_route_information() {
            //row
            $row = get_route_data();

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

        //show objects which you can see on route
        function show_close_objects() {
            global $con;

            //get architect ID
            $route_id = $_GET['trasa'];

            //get all works created by this architect
            $sql_obiekt = "SELECT * FROM Obiekty WHERE Id_trasa=$route_id";
            $query_obiekt = mysqli_query($con, $sql_obiekt);

            //show works
            if($query_obiekt->num_rows > 0) {
                while($row_works = mysqli_fetch_array($query_obiekt)) {
                    echo "
                        <div class='workHolder'>
                            <img class='workImg' src='img/{$row_works['Media']}/main.jpeg'>
                            <h4 class='workName'>{$row_works['Nazwa']}</h4>
                        </div>
                    ";
                }
            }
        }
    ?>

    <title>Trasa <?php route_name(); ?></title>

    <div id='routeInfoHolder'>
        <?php show_route_information(); ?>
    </div>

    <div id='objectsMainHolder'>
        <div id='objectsHolderHeader'>
            <h2>Obiekty na tej trasie</h2>
        </div>
        <div id='objectsHolder'>
            <?php show_close_objects(); ?>
        </div>
    </div>

</body>
</html>