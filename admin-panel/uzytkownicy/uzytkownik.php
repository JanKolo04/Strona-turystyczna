<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-uzytkownik.css">
</head>
<body>

    <?php

        include("../connection.php");

        if(isset($_POST['update'])) {
            update_data();
        }

        $user_data = user_data();      

        function user_data() {
            global $con;

            //get all selected user data
            $sql = "SELECT * FROM Uzytkownicy WHERE id_uzytkownik={$_GET['id']}";
            $query = $con->query($sql);

            if($query->num_rows > 0 && $query != false) {
                $row = $query->fetch_assoc();
                return $row;
            }
        }

        function update_data() {
            global $con;
            $hash = sha1($_POST['password']);
            //update all user data
            $sql = "UPDATE Uzytkownicy SET Imie='{$_POST['name']}', Nazwisko='{$_POST['surname']}', Email='{$_POST['email']}', Haslo='$hash' WHERE id_uzytkownik={$_GET['id']}";
            $query = $con->query($sql);
        }

    ?>  

    <div id="content-holder">
        <div id="other-content-holder">
            <div id="header">
                <h1>Dane <?php echo $user_data['Imie']; echo ' '; echo $user_data['Nazwisko']; ?></h1>
            </div>
            <div id="login-data-holder">
                <form method="POST">
                    <div id="inputs-holder">
                        <input type="text" name="name" placeholder="Imie" class="input" value='<?php echo $user_data['Imie']; ?>'>
                        <input type="text" name="surname" placeholder="Nazwisko" class="input" value='<?php echo $user_data['Nazwisko']; ?>'>
                        <input type="email" name="email" placeholder="Email" class="input" value='<?php echo $user_data['Email']; ?>'>
                        <input type="password" name="password" placeholder="Hasło" class="input" value='<?php echo $user_data['Haslo']; ?>'>
                    </div>
                    <div id="other-data-holder">
                        <div id="button-holder">
                            <button type="submit" name="update">Zatwierdź</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>