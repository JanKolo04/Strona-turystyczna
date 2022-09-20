<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-uzytkownicy.css">
    <script type="text/javascript" src="js/script-uzytkownicy.js"></script>
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
                            <td><input value='{$row['id_uzytkownik']}' class='check' type='checkbox'> <button value='{$row['id_uzytkownik']}' onclick='delete_user()' class='single-delete-button' id='delete-user-button'><i id='x-icon' class='fa-solid fa-x'></i>&nbspUsuń</button></td>
                            <td>{$row['id_uzytkownik']}</td>
                            <td>{$row['Imie']}</td>
                            <td>{$row['Nazwisko']}</td>
                            <td>{$row['Email']}</td>
                            <td><a href='index.php?strona=uzytkownicy/uzytkownik?id={$row['id_uzytkownik']}'>Podgląd</a>
                        </tr>
                    ";
                }
            }
            else {
                echo "<tr><td colspan='4'>Nie ma użytkowników</td></tr>";
            }
        }

    ?>  

    <div id='tableDiv'>
        <div id="option-header">
            <button onclick='delete_user()' id='delete-user-button'><i id='x-icon' class="fa-solid fa-x"></i>&nbspUsuń</button>
        </div>

        <div id="table-overwflow">
            <table id="table-user">
                <thead>
                    <th>
                    <th>Id</th>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <th>Podgląd</th>
                </thead>
                <tbody>
                    <?php show_all_users(); ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>