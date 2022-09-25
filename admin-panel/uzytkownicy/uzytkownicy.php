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

        if(isset($_POST['search-button'])) {
            search_func();           
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
                            <td class='manipulation-td'>
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


        function create_search_func() {
            //get data from input
            //$input_data = $_POST['search-input'];

            $input_data = "Szymon Zimecki";
            //split input
            $split_data = explode(" ", $input_data);

            //column to search in uzytkownicy table
            $columns_array = ["Imie", "Nazwisko", "Email"];
            //set search variable with primary syntax
            $search_sql = "SELECT * FROM Uzytkownicy WHERE ";
            /*
                first loop is to go for all columns from columns_array
                second loop is to go for all split data from input
            */
            for($i=0; $i<sizeof($columns_array); $i++) {
                //if its first column don't add OR before column
                if($i == 0) { 
                    $search_sql .= "$columns_array[$i] IN";
                }
                else {
                    $search_sql .= " OR $columns_array[$i] IN";
                }

                //set primary search in
                $search_sql .= " (select $columns_array[$i] from Uzytkownicy where";
                for($y=0; $y<sizeof($split_data); $y++) {
                    //if data from explode isn't last add OR after like
                    if($y < sizeof($split_data) - 1) {
                        $search_sql .= " $columns_array[$i] like '%{$split_data[$y]}%' or";
                    }
                    else {
                        $search_sql .= " $columns_array[$i] like '%{$split_data[$y]}%') ";
                    }
                }
            }
            $search_sql .= ';';
            echo "SELECT * FROM Uzytkownicy WHERE Imie IN (select Imie from Uzytkownicy where Imie like '%Szymon%' or Imie like '%Zimecki%');</br>";
            echo $search_sql;

        }

        create_search_func();

        function search_func() {
            global $con;

            //get data from input
            $input_data = $_POST['search-input'];

            //search users in database
            $sql_search = "SELECT DISTINCT * FROM uzytkownicy WHERE Imie LIKE '%$input_data%' OR Nazwisko LIKE '%$input_data%' OR Email LIKE '%$input_data%';";
            $query_search = mysqli_query($con, $sql_search);

            //maybe good sql query
            /*
            finished function to search but I have to do this better
            SELECT * FROM Uzytkownicy WHERE Imie IN (select Imie from Uzytkownicy where Imie like '%Szymon%' or Imie like '%Zimecki%');


            OR Nazwisko IN (select Nazwisko from Uzytkownicy where Nazwisko like '%Szymon%' or Nazwisko like '%Zimecki%')
            OR Email IN (select Email from Uzytkownicy where Email like '%Szymon%' or Email like '%Zimecki%');

            */

            if($query_search->num_rows > 0) {
                print_r(mysqli_fetch_array($query_search));
                echo $sql_search;
            }
            else {
                echo "Error";
            }

        }

    ?>  

    <div id="add-user-page">
        <form method="POST" id="search-form">
            <div id="search-holder">
                <div id="search-header">
                    <div id="input-holder" class="search-holders">
                        <input type="text" name="search-input" id='search-input' placeholder="Wyszukaj osobę...">
                    </div>
                    <div id="button-search-holder" class="search-holders">
                        <button id="search-button" name="search-button" type="submit">Szukaj</button>
                    </div>
                </div>
            </form>
        </div>

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
    </div>

</body>
</html>