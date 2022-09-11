<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-obiekt.css">
</head>
<body>

    <?php

        function object_data() {
            global $con;

            //object id
            $object_id = $_GET['obiekt'];

            //select data
            $sql = "SELECT Obiekty.*, Architekci.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Architekci ON Architekci.Id=Obiekty.Id_architekt INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa WHERE Obiekty.Id=$object_id";
            $query = mysqli_query($con, $sql);

            //show all data
            if($query->num_rows > 0) {
                while($row = mysqli_fetch_array($query)) {
                    //main image
                    $main_img = "img/{$row['Media']}/main.jpeg";

                    echo "  
                        <div id='currentObjectInfo'>       
                            <div id='details'>               
                                <p id='currentObjectLocation'><img id='iconLocationCurrentObject' src='img/icon/bookmark.png'> {$row['trasa_nazwa']}</p>
                                
                                <div id='architect' class='infoDiv'>
                                    <label>Architekt:</label>
                                    <h3>{$row['Imie']} {$row['Nazwisko']}</h3>
                                </div>

                                <div id='years' class='infoDiv'>
                                    <label>Lata budowy:</label>
                                    <h3>{$row['Rok_budowy']}</h3>
                                </div>

                                <div id='place' class='infoDiv'>
                                    <label>Miejsce:</label>
                                    <h3>{$row['Miejsce']}</h3>
                                </div>

                                <div id='category' class='infoDiv'>
                                    <label>Typ obiektu:</label>
                                    <h3>{$row['Kategoria']}</h3>
                                </div>
                            </div>
                        </div>

                        <div id='mainImage' style='background-image: url($main_img);'></div>
                    ";
                }
            }
        }

        //show objects which you can see on route
        function show_close_objects() {
            global $con;

            //get architect ID
            $route_id = $_GET['trasa'];
            //obejct Id
            $object_id = $_GET['obiekt'];

            //get all works created by this architect
            $sql_obiekt = "SELECT * FROM Obiekty WHERE Id_trasa=$route_id AND Id != $object_id";
            $query_obiekt = mysqli_query($con, $sql_obiekt);

            //show works
            if($query_obiekt->num_rows > 0) {
                while($row_works = mysqli_fetch_array($query_obiekt)) {
                    //link_to_work
                    $link_to_work = "index.php?strona=obiekt&obiekt={$row_works['Id']}&trasa={$row_works['Id_trasa']}";
                    echo "
                        <div class='workHolder'>
                            <img class='workImg' src='img/{$row_works['Media']}/main.jpeg'>
                            <div class='workInfo'>
                                <a class='workName' href='$link_to_work'><h4>{$row_works['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                            </div>
                        </div>
                    ";
                }
            }
        }

    ?>

    <div id='currentObejctHolder'>
        <h1>Wypisać dane danego objektu</h1>
        <div id='objectData'>
            <?php object_data(); ?>
        </div>
    </div>

    <div id='objectsMainHolder'>
        <div id='objectsHolderHeader'>
            <h2>Inne obiekty na tej trasie</h2>
        </div>
        <div id='objectsHolder'>
            <?php show_close_objects(); ?>
        </div>
    </div>

</body>
</html>