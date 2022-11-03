<?php

    //check which button to update favorite
    $favorite = new Favorite();
    if(isset($_POST['favorite-button']) && isset($_SESSION['user_id'])) {
        $favorite->insert_into_favorite(3, $_POST['favorite-button']);
    }
    else if(isset($_POST['unfavorite-button']) && isset($_SESSION['user_id'])) {
        $favorite->delete_from_favorite(3, $_POST['unfavorite-button']);
    }

    class GetObjects {
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

        function check_data_and_print($sql_obiekt) {
            global $con;

            //get all objects
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

    class Favorite {
        public $user_id;
        public $object_id;

        function insert_into_favorite($user_id, $object_id) {
            global $con;

            //insert object into favortie
            $sql = "INSERT INTO ulubione(Id_uzytkownika, Id_trasy, Id_obiektu) VALUES($user_id, NULL, $object_id);";
            $query = $con->query($sql);
        }

        function delete_from_favorite($user_id, $object_id) {
            global $con;

            //delete object from favortie
            $sql = "DELETE FROM ulubione WHERE Id_uzytkownika=$user_id AND Id=$object_id";
            $query = $con->query($sql);
        }
    }
?>