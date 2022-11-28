<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasy.css">
    <script type="text/javascript" src="js/script-trasy.js"></script>
    <title>Trasy</title>
</head>
<body>

    <?php

        if(isset($_POST['single_delete_button'])) {
            single_delete_button();
        }

        function single_delete_button() {
            global $con;

            //value from delte button
            $route_id = $_POST['single_delete_button'];
            
            //delete route sql
            $sql = "DELETE FROM Trasy WHERE Id=$route_id";
            //query
            $query = mysqli_query($con, $sql);
        }


        class search {
            public $columns;
            public $split_input_data;
            public $search_sql;

            function get_primary_data() {
                global $con;
                //get data from input
                $input_data = $_POST['search-input'];

                //split input
                $this->split_input_data = explode(" ", $input_data);

                //column to search in uzytkownicy table
                $this->columns = ["Nazwa", "Opis"];
                //set search variable with primary syntax
                $this->search_sql = "SELECT * FROM Trasy WHERE ";
            }

            function setup_primary_data() {
                //get all data
                $this->get_primary_data();

                //first loop is to go for all columns from columns_array
                for($i=0; $i<sizeof($this->columns); $i++) {
                    //if its first column don't add OR before column
                    if($i == 0) { 
                        $this->search_sql .= "{$this->columns[$i]} IN";
                    }
                    else {
                        $this->search_sql .= " OR {$this->columns[$i]} IN";
                    }

                    //run next for loop
                    $this->insert_like_function($i);
                }
                $this->search_sql .= ";";

                return $this->search_sql;
            }

            function insert_like_function($i) {
                $this->search_sql .= " (select {$this->columns[$i]} from Trasy where";
                for($y=0; $y<sizeof($this->split_input_data); $y++) {
                    //if data from explode isn't last add OR after like
                    if($y < sizeof($this->split_input_data) - 1) {
                        $this->search_sql .= " {$this->columns[$i]} like '%{$this->split_input_data[$y]}%' or";
                    }
                    else {
                        $this->search_sql .= " {$this->columns[$i]} like '%{$this->split_input_data[$y]}%') ";
                    }
                }
            }
        }

        function print_data($sql) {
            global $con;
            //query
            $query = $con->query($sql);

            if($query->num_rows > 0) {
                $i=0; //counter
                while($row = $query->fetch_array(MYSQLI_ASSOC)) {
                    //cut info and desc words to better print data
                    $desc = $row['Opis'];
                    $info = $row['Opis'];
                    
                    if(strlen($desc) > 40) {
                        $desc = substr($desc, 0, 37);
                        $desc .= '...';
                    }
                    if(strlen($info) > 40) {
                        $info = substr($info, 0, 37);
                        $info .= '...';
                    }

                    echo "
                        <tr>
                            <td class='manipulation-td'>
                                <input value='{$row['Id']}' class='check' type='checkbox'>
                                <button value='{$row['Id']}' class='delete-user-button' onclick='delete_user()' type='submit' name='single_delete_button'><i id='x-icon' class='fa-solid fa-x'></i>&nbspUsuń</button>
                            </td>
                            <td>{$row['Id']}</td>
                            <td>{$row['Nazwa']}</td>
                            <td>{$row['Poczatek']}</td>
                            <td>{$row['Koniec']}</td>
                            <td>{$row['Trudnosc']}</td>
                            <td>$desc</td>
                            <td>$info</td>
                            <td>{$row['Kategoria']}</td>
                            <td><a href='index.php?strona=trasy/trasa&id={$row['Id']}'>Edycja</a>
                        </tr>
                    ";
                }
            }
            else {
                echo "
                    <tr>
                        <td colspan='6'>Brak wyników</td>
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
                        <th>Naza</th>
                        <th>Poczatek</th>
                        <th>Koniec</th>
                        <th>Trudnosc</th>
                        <th>Opis</th>
                        <th>Informacje</th>
                        <th>Kategoria</th>
                        <th>Edycja</th>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <?php
                                //variable with function which show all users
                                $sql_all_users = "SELECT * FROM Trasy";

                                //search class
                                $search_obj = new search();
                                if(isset($_POST['search-button'])) {
                                    if(strlen($_POST['search-input']) > 0) {
                                        //print whole search data
                                        print_data($search_obj->setup_primary_data());
                                    }
                                    else {
                                        print_data($sql_all_users);
                                    }
                                }
                                else {
                                    print_data($sql_all_users);
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