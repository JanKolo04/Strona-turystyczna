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

        class GetCloseObjects {
            public $id_user;
            public $all_objects;
            public $all_objects_fav;

            function get_all_objects_from_fav($id_user) {
                global $con;

                //get all objects from favorite where id_user is user id
                $sql_fav = "SELECT Id, Id_obiektu FROM ulubione WHERE Id_uzytkownika=$id_user";
                $query_fav = $con->query($sql_fav);

                $array = [];
                //if count results is bigger than 0 append data into array
                if($query_fav->num_rows > 0) {
                    $i=0;
                    while($row = mysqli_fetch_array($query_fav)) {
                        $array[$i] = [
                            "Id"=>$row['Id'],
                            "Id_object"=>$row['Id_obiektu']
                        ];
                        $i++;
                    }
                }

                //all objects from fav
                return $array;
            }

            function check_data_and_print() {
                global $con;

                $route_id = $_GET['trasa'];
    
                //get all works created by this route
                $sql_obiekt = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa WHERE Id_trasa=$route_id ORDER BY (Obiekty.Nazwa) ASC";
                $query_obiekt = mysqli_query($con, $sql_obiekt);
                
                //aray with objets id from favorite where id_user is your id
                $id_array_objects_fav = $this->get_all_objects_from_fav(3);

                //print objects
                $all_obejcts = [];
                if($query_obiekt->num_rows > 0) {
                    $counter=0;
                    while($row = mysqli_fetch_array($query_obiekt)) {
                        //variable for favorite button
                        $fav_button_name = "favorite-button";
                        $value = $row['Id'];
                        $background = "out-favorite.png";

                        //check which object is in favorite
                        for($i=0; $i<sizeof($id_array_objects_fav); $i++) {
                            if($row['Id'] == $id_array_objects_fav[$i]['Id_object']) {
                                //update variable when object is in favorite
                                $fav_button_name = "unfavorite-button";
                                $value = $id_array_objects_fav[$i]['Id'];
                                $background = "in-favorite.png";
                                break;
                            }
                        }
                        //link_to_work
                        $link_to_work = "index.php?strona=obiekty/obiekt&obiekt={$row['Id']}&trasa={$row['Id_trasa']}";
                        //link to img for fav_button
                        $link_to_img_for_fav_bt = "img/icon/$background";
                        
                        echo "
                            <div class='workHolder'>
                                <a href='$link_to_work'><img class='workImg' src='img/{$row['Media']}/main 1.jpeg'></a>
                                <div class='workInfo'>
                                    <p class='objectLocation'><img class='iconLocation' src='img/icon/bookmark.png'> {$row['trasa_nazwa']}</p>
                                    
                                    <div class='workNameFavoriteHolder'>
                                        <div class='workNameHolder'>
                                            <a class='workName' href='$link_to_work'><h4>{$row['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                                        </div>

                                        <div class='favoriteButtonHolder'>
                                            <button style='background-image: url($link_to_img_for_fav_bt);' type='submit' value='$value' name='$fav_button_name' class='favorite-button'></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
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
            <?php 
                $close_obejcts = new GetCloseObjects();
                $close_obejcts->check_data_and_print();
            ?>
        </div>
    </div>

</body>
</html>