<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-obiekty.css">
</head>
<body>

    <?php
    
        function show_all_objects() {
            global $con;

            //get all works created by this architect
            $sql_obiekt = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Obiekty INNER JOIN Trasy ON Trasy.Id=Obiekty.Id_trasa ORDER BY (Obiekty.Nazwa) ASC";
            $query_obiekt = mysqli_query($con, $sql_obiekt);

            //show works
            if($query_obiekt->num_rows > 0) {
                while($row_works = mysqli_fetch_array($query_obiekt)) {
                    //link_to_work
                    $link_to_work = "index.php?strona=obiekty/obiekt&obiekt={$row_works['Id']}&trasa={$row_works['Id_trasa']}";
                    echo "
                        <div class='workHolder'>
                            <a href='$link_to_work'><img class='workImg' src='img/{$row_works['Media']}/main 1.jpeg'></a>
                            <div class='workInfo'>
                                <p class='objectLocation'><img class='iconLocation' src='img/icon/bookmark.png'> {$row_works['trasa_nazwa']}</p>
                                
                                <div class='workNameFavoriteHolder'>
                                    <div class='workNameHolder'>
                                        <a class='workName' href='$link_to_work'><h4>{$row_works['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                                    </div>

                                    <div class='favoriteButtonHolder'>
                                        <button type='submit' name='favortie-button' class='favorite-button'></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
            }
        }
    

        class Favorite {
            public $user_id;

            function insert_into_favorite($object_id) {
                global $con;

                //insert object into favortie
                $sql = "INSERT INTO ulubione(Id_uzytkownika, Id_trasy, Id_obiektu) VALUES($user_id, NULL, $object_id);";
                $query = mysqli_query($con, $sql);
            }

            function delete_from_favorite($object_id) {
                global $con;

                //delete object from favortie
                $sql = "DELETE FROM ulubione WHERE Id_uzytkownika=$user_id AND Id_obiektu=$object_id";
                $query = mysqli_query($con, $sql);
            }
        }
    ?>
    
    <h1>Obiekty</h1>
    <div id='objectsMainHolder'>
        <form method="POST">
            <?php show_all_objects(); ?>
        </form>
    </div>

</body>
</html>