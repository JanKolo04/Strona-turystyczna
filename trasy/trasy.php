<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php

        function all_routes() {
            global $con;

            //find all routes
            $sql = "SELECT * FROM Trasy";
            $query = mysqli_query($con, $sql);

            if($query->num_rows > 0) {
                while($row = mysqli_fetch_array($query)) {
                    //route id
                    $id_route = $row['Id'];
                    //show link into architect
                    echo "<a href='index.php?strona=trasy/trasa&trasa=$id_route'>".$row['Nazwa']."</a></br>";
                }
            }
        }

        all_routes();

    ?>

</body>
</html>