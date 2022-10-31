<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-architekci.css">
</head>
<body>

    <?php

        function all_architect() {
            global $con;

            //get all works created by this architect
            $sql_architect = "SELECT * FROM Architekci";
            $query_architect = mysqli_query($con, $sql_architect);

            //show works
            if($query_architect->num_rows > 0) {
                while($row_arch = mysqli_fetch_array($query_architect)) {
                    //link_to_architect
                    $link_to_architect = "index.php?strona=architekci/architekt&architekt={$row_arch['Id']}";

                    //if media is null add grey bacground into archImg
                    $img = $row_arch['Media'].'/main 1.jpeg';
                    if($img == "/main 1.jpeg") {
                        $img = "brak-zdjecia.png";
                    }

                    echo "
                        <div class='architectHolder'>
                            <a href='$link_to_architect'><img class='archImg' src='img/$img'></a>
                            <div class='archInfo'>
                                <a class='archName' href='$link_to_architect'><h4>{$row_arch['Imie']} {$row_arch['Nazwisko']}</h4><img class='iconReadMore' src='img/icon/read-more.png'></a>
                            </div>
                        </div>
                    ";
                }
            }
        }

    ?>

    <h1>Architekci</h1>
    <div id='architectsMainHolder'>
        <?php all_architect(); ?>
    </div>


</body>
</html>