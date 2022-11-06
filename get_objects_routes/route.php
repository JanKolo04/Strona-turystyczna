<?php

    //check which button to update favorite
    $favorite = new Favorite();
    if(isset($_POST['favorite-button'])) {
        $favorite->insert_into_favorite(3, $_POST['favorite-button']);
    }
    else if(isset($_POST['unfavorite-button'])) {
        $favorite->delete_from_favorite(3, $_POST['unfavorite-button']);
    }

    class GetRoutes {
        public $id_user;
        public $all_routes;
        public $all_routes_fav;

        function get_all_routes_from_fav($id_user) {
            global $con;

            //get all routes from favorite where id_user is user id
            $sql_fav = "SELECT Id, Id_trasy FROM ulubione WHERE Id_uzytkownika=$id_user AND Id_trasy!=NULL";
            $query_fav = $con->query($sql_fav);

            $array = [];
            //if count results is bigger than 0 append data into array
            if($query_fav->num_rows > 0) {
                $i=0;
                while($row = mysqli_fetch_array($query_fav)) {
                    $array[$i] = [
                        "Id"=>$row['Id'],
                        "Id_route"=>$row['Id_trasy']
                    ];
                    $i++;
                }
            }

            //all routes from fav
            return $array;
        }

        function check_data_and_print($sql_route) {
            global $con;

            //get all routes
            $query_route = mysqli_query($con, $sql_route);
            
            //aray with objets id from favorite where id_user is your id
            $id_array_routes_fav = $this->get_all_routes_from_fav(3);

            //print routes
            $all_obejcts = [];
            if($query_route->num_rows > 0) {
                $counter=0;
                while($row = mysqli_fetch_array($query_route)) {
                    //variable for favorite button
                    $fav_button_name = "favorite-button";
                    $value = $row['Id'];
                    $background = "out-favorite.png";

                    //check which route is in favorite
                    for($i=0; $i<sizeof($id_array_routes_fav); $i++) {
                        if($row['Id'] == $id_array_routes_fav[$i]['Id_route']) {
                            //update variable when route is in favorite
                            $fav_button_name = "unfavorite-button";
                            $value = $id_array_routes_fav[$i]['Id'];
                            $background = "in-favorite.png";
                            break;
                        }
                    }
                    //link_to_work
                    $link_to_routes = "index.php?strona=trasy/trasa&trasa={$row['Id']}";
                    //link to img for fav_button
                    $link_to_img_for_fav_bt = "img/icon/$background";

                    //if media is null set no photo img
                    $img = "../img/brak-zdjecia.png";
                    if($row['Media'] != NULL) {
                        $img = '../img'.$row['Media'].'/main 1.jpeg';
                    }
                    
                    echo "
                        <div class='routesHolder'>
                            <a href='$link_to_routes'><img class='routesImg' src='img/$img'></a>

                            <div class='routesInfo'>
                                <div class='routesNameHolder'>
                                    <a class='routesName' href='$link_to_routes'><h4>{$row['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                                </div>

                                <div class='favoriteButtonHolder'>
                                    <button style='background-image: url($link_to_img_for_fav_bt);' type='submit' value='$value' name='$fav_button_name' class='favorite-button'></button>
                                </div>
                            </div>
                        </div>
                    ";
                }
            }
        }
    }

    class Favorite {
        public $user_id;
        public $route_id;

        function insert_into_favorite($user_id, $route_id) {
            global $con;

            //insert route into favortie
            $sql = "INSERT INTO ulubione(Id_uzytkownika, Id_trasy, Id_obiektu) VALUES($user_id, $route_id, NULL);";
            $query = $con->query($sql);
        }

        function delete_from_favorite($user_id, $route_id) {
            global $con;

            //delete route from favortie
            $sql = "DELETE FROM ulubione WHERE Id_uzytkownika=$user_id AND Id=$route_id";
            $query = $con->query($sql);
        }
    }
?>