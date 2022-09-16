<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php

        function all_architect() {
            global $con;

            //find all architect
            $sql = "SELECT * FROM Architekci";
            $query = mysqli_query($con, $sql);

            if($query->num_rows > 0) {
                while($row = mysqli_fetch_array($query)) {
                    //full name
                    $full_name = $row['Imie'].' '.$row['Nazwisko'];
                    //architect id
                    $id_arch = $row['Id'];
                    //show link into architect
                    echo "<a href='index.php?strona=architekci/architekt&architekt=$id_arch'>$full_name</a></br>";
                }
            }
        }

        all_architect();

    ?>

</body>
</html>