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

        include("connection.php");

        

        function user_data() {
            global $con;

            $sql = "SELECT * FROM Uzytkownicy WHERE id_uzytkownik={$_GET['id']}";
            $query = $con->query($sql);

            if($query->num_rows > 0 && $query != false) {
                $row = $query->fetch_assoc();

                echo "";
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
                                //variable with function which show all users
                                $sql_all_users = "SELECT * FROM Uzytkownicy";

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