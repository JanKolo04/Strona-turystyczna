<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-uzytkownicy.css">
</head>
<body>

    <?php
    
        function show_all_users() {
            global $con;
            
            //find all users
            $sql = "SELECT * FROM uzytkownicy";
            //query
            $query = mysqli_query($con, $sql);

            if($query->num_rows > 0) {
                while($row = mysqli_fetch_array($query)) {
                    echo "
                        <tr>
                            <td>{$row['id_uzytkownik']}</td>
                            <td>{$row['Imie']}</td>
                            <td>{$row['Nazwisko']}</td>
                            <td>{$row['Email']}</td>
                        </tr>
                    ";
                }
            }
            else {
                echo "<tr><td colspan='4'>Nie ma użytkowników</td></tr>";
            }
        }

    ?>
    <div id="tableDiv">
        <table id="table-user">
            <thead>
                <th>Id</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>Email</th>
            </thead>
            <tbody>
                <?php show_all_users(); ?>
            </tbody>
        </table>
    </div>

</body>
</html>