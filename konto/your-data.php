<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/script-account.js"></script>
	<title>Twoje dane - Szlakiem Szczecina</title>
</head>
<body>

    <?php
    
        class user_data {
            function get_data($user_id) {
                global $con;

                //get all user data
                $sql = "SELECT * FROM Uzytkownicy WHERE id_uzytkownik=$user_id";
                $query = $con->query($sql);

                //if row in query is more than 0 return array with data from query
                if($query->num_rows > 0) {
                    $row = $query->fetch_array(MYSQLI_ASSOC);
                    return $row;
                }
            }

            function print_data($array) {
                echo "
                    <input class='input' type='text' name='name' value='{$array['Imie']}'>
                    <input class='input' type='text' name='surname' value='{$array['Nazwisko']}'>
                    <input class='input' type='email' name='email' value='{$array['Email']}'>
                    <input class='input' id='password' type='password' name='password' value='{$array['Haslo']}'>

                    <div id='other-data-holder'>
                        <div id='show-password-holder'>
                            <label for='show-password'>Pokaz hasło</label>
                            <input id='show-password' type='checkbox' value='show' onclick='show_password(this)'>
                        </div>

                        <div id='submit-button-holder'>
                            <button type='submit' name='update-user-data'>Zatwierdź</button>
                        </div>
                    </div>
                ";
            }
        }
    
    ?>

    <div id="basic-data-holder">
        <div id="header-right-side">
            <h3>Twoje dane</h3>
        </div>

        <div id="inputs-holder">
            <form method="POST">
                <?php
                    //create object
                    $user = new user_data();
                    $get_user_data = $user->get_data(3);
                    $user->print_data($get_user_data);
                ?>
            </form>
        </div>
    </div>

</body>
</html>