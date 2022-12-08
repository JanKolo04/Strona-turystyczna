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

        //user_data object
        $user = new user_data();
        //var with user data array
        $get_user_data = $user->get_data_from_db($_GET['id']);

        //if user click submit update data
        if(isset($_POST['update-user-data'])) {
            $user->update_data();
            header("Location: index.php?strona=konto/konto&id={$_SESSION['user_id']}");
        }

        class user_data {
            public $user_id;

            function get_data_from_db($id_user) {
                global $con;

                $this->user_id = $id_user;

                //get all user data
                $sql = "SELECT * FROM Uzytkownicy WHERE id_uzytkownik={$this->user_id}";
                $query = $con->query($sql);
    
                //if row in query is more than 0 return array with data from query
                if($query->num_rows > 0) {
                    $row = $query->fetch_array(MYSQLI_ASSOC);
                    return $row;
                }
            }

            function update_data() {
                global $con;

                //update data
                $sql = "UPDATE Uzytkownicy SET Imie='{$_POST['name']}', Nazwisko='{$_POST['surname']}', Haslo='{$_POST['password']}', Email='{$_POST['email']}' WHERE id_uzytkownik={$this->user_id}";
                $query = $con->query($sql);
            }
        }
    
    ?>

    <div id="basic-data-holder">
        <div id="header-right-side">
            <h3>Twoje dane</h3>
        </div>

        <div id="inputs-holder">
            <form method="POST">
                <input class="input" type="text" name="name" value="<?php echo $get_user_data["Imie"]; ?>">  
                <input class="input" type="text" name="surname" value="<?php echo $get_user_data["Nazwisko"]; ?>">
                <input class="input" type="email" name="email" value="<?php echo $get_user_data["Email"]; ?>">
                <input class="input" id="password" type="password" name="password" value="<?php echo $_SESSION['password']; ?>">

                <div id="other-data-holder">
                    <div id="show-password-holder">
                        <label for="show-password">Pokaz hasło</label>
                        <input id="show-password" type="checkbox" value="show" onclick="show_password(this)">
                    </div>

                    <div id="submit-button-holder">
                        <button type="submit" name="update-user-data">Zatwierdź</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>