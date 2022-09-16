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
                            <img class='workImg' src='img/{$row_works['Media']}/main.jpeg'>
                            <div class='workInfo'>
                                <p class='objectLocation'><img class='iconLocation' src='img/icon/bookmark.png'> {$row_works['trasa_nazwa']}</p>
                                <a class='workName' href='$link_to_work'><h4>{$row_works['Nazwa']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                            </div>
                        </div>
                    ";
                }
            }
        }
    
    ?>
    <h1>Obiekty</h1>
    <div id='objectsMainHolder'>
        <?php show_all_objects(); ?>
    </div>

</body>
</html>