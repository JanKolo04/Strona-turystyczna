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

        if(isset($_POST['single_delete_button'])) {
            single_delete_button();
        }
    
        function show_all_users() {
            global $con;
            
            //find all users
            $sql = "SELECT * FROM uzytkownicy";
            //query
            $query = mysqli_query($con, $sql);

            if($query->num_rows > 0) {
                $i=0;
                while($row = mysqli_fetch_array($query)) {
                    echo "
                        <tr>
                            <td>
                                <input value='{$row['id_uzytkownik']}' class='check' type='checkbox'>
                                <button value='{$row['id_uzytkownik']}' class='delete-user-button' onclick='delete_user()' type='submit' name='single_delete_button'><i id='x-icon' class='fa-solid fa-x'></i>&nbspUsuń</button>
                            </td>
                            <td>{$row['id_uzytkownik']}</td>
                            <td>{$row['Imie']}</td>
                            <td>{$row['Nazwisko']}</td>
                            <td>{$row['Email']}</td>
                            <td><a href='index.php?strona=uzytkownicy/uzytkownik?id={$row['id_uzytkownik']}'>Podgląd</a>
                        </tr>
                    ";
                    $i++;
                }
            }
            else {
                echo "<tr><td colspan='4'>Nie ma użytkowników</td></tr>";
            }
        }

        function single_delete_button() {
            global $con;

            //value from delte button
            $user_id = $_POST['single_delete_button'];
            
            //delte user sql
            $sql = "DELETE FROM Uzytkownicy WHERE id_uzytkownik=$user_id";
            //query
            $query = mysqli_query($con, $sql);
        }

    ?>  

    <div id='tableDiv'>
        <div id="option-header">
            <p>Działania masowe: </p>
            <button onclick='delete_user()' class='delete-user-button'><i id='x-icon' class="fa-solid fa-x"></i>&nbspUsuń</button>
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
                    <form method="POST">
                        <?php show_all_users(); ?>
                    </form>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>