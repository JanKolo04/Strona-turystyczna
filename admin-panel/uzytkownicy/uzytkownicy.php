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

        //global varibale 
        
        $array_data = [];

        if(isset($_POST['single_delete_button'])) {
            single_delete_button();
        }

        function show_all_users() {
            global $con;
            
            $array_data = [];

            //find all users
            $sql = "SELECT * FROM uzytkownicy";
            //query
            $query = mysqli_query($con, $sql);

            //check if query is bigger than 0
            if($query->num_rows > 0) {
                $i=0; //counter
                //loop to add data into array
                while($row = mysqli_fetch_array($query)) {
                    $array_data[$i] = [
                        "id_uzytkownik"=>$row['id_uzytkownik'],
                        "Imie"=>$row['Imie'],
                        "Nazwisko"=>$row['Nazwisko'],
                        "Email"=>$row['Email']
                    ];
                    $i++;
                }
                //print data
                print_data($array_data);
            }
            else {
                echo "<tr><td colspan='6'>Nie ma użytkowników</td></tr>";
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


        function search_func() {
            global $con;
            $array_data = [];

            //get data from input
            $input_data = $_POST['search-input'];

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
            //query
            $query = mysqli_query($con, $search_sql);

            //check if query is bigger than 0
            if($query->num_rows > 0) {
                $i=0; //counter
                //loop to add data into array
                while($row = mysqli_fetch_array($query)) {
                    $array_data[$i] = [
                        "id_uzytkownik"=>$row['id_uzytkownik'],
                        "Imie"=>$row['Imie'],
                        "Nazwisko"=>$row['Nazwisko'],
                        "Email"=>$row['Email']
                    ];
                    $i++;
                }
                //print data
                print_data($array_data);
            }
            else {
                echo "<tr><td colspan='6'>Brak wyników wyszukiwania</td></tr>";
            }

        }

        function print_data($array) {

            for($i=0; $i<sizeof($array); $i++) {
                echo "
                    <tr>
                        <td class='manipulation-td'>
                            <input value='{$array[$i]['id_uzytkownik']}' class='check' type='checkbox'>
                            <button value='{$array[$i]['id_uzytkownik']}' class='delete-user-button' onclick='delete_user()' type='submit' name='single_delete_button'><i id='x-icon' class='fa-solid fa-x'></i>&nbspUsuń</button>
                        </td>
                        <td>{$array[$i]['id_uzytkownik']}</td>
                        <td>{$array[$i]['Imie']}</td>
                        <td>{$array[$i]['Nazwisko']}</td>
                        <td>{$array[$i]['Email']}</td>
                        <td><a href='index.php?strona=uzytkownicy/uzytkownik?id={$array[$i]['id_uzytkownik']}'>Podgląd</a>
                    </tr>
                ";
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
                            <?php 
                                if(isset($_POST['search-button'])) {
                                    if(strlen($_POST['search-input']) > 0) {
                                        search_func();
                                    }
                                    else {
                                        show_all_users();
                                    }
                                }
                                else {
                                    show_all_users();
                                }
                            ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>