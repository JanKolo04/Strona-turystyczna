<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-register.css">
	<title>Zaloguj się - Szlakiem Szczecina</title>
</head>
<body>

    <div id="content-holder">
        <div id="img-holder"></div>
        <div id="other-content-holder">
            <div id="header">
                <h1>Rejstracja</h1>
                <p>Stwórz konto aby mieć więcej mozliwości</p>
            </div>
            <div id="login-data-holder">
                <form method="POST">
                    <div id="inputs-holder">
                        <input type="text" name="name" placeholder="Imie" class="input">
                        <input type="text" name="surname" placeholder="Nazwisko" class="input">
                        <input type="text" name="email" placeholder="Emial" class="input">
                        <input type="password" name="password" placeholder="Hasło" class="input">
                    </div>
                    <div id="other-data-holder">
                        <div id="button-holder">
                            <button type="submit">Zatwierdź</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

        if(isset($_POST['add_user'])) {
            add_user();
        }

        function get_data_from_form() {
            //array with all user data from form
            $new_user_array = [
                "Name"=>$_POST['name'],
                "Surname"=>$_POST['surname'],
                "Email"=>$_POST['email'],
                "Password"=>$_POST['password']
            ];

            return $new_user_array; //return array
        }

        function add_user() {
            global $con, $alert;

            $alert = ""; //alert

            //get data
            $user_data = get_data_from_form();

            //check for other user don't use same email
            $sql_check = "SELECT * FROM uzytkownicy WHERE Email='{$user_data['Email']}'";
            $query_check = mysqli_query($con, $sql_check);

            if($query_check->num_rows == 0) {
                //add user
                $sql_insert = "INSERT INTO uzytkownicy(Imie, Nazwisko, Email, Data_urodzenia) VALUES('{$user_data['Name']}', '{$user_data['Surname']}', '{$user_data['Email']}', '{$user_data['Date_birth']}');";
                $query_insert = mysqli_query($con, $sql_insert);

                if(!$query_insert) {
                    echo "<script>alert('Coś poszło nie tak');</script>";
                }
                else {
                    echo "<script>alert('Dodano uzytkownika');</script>";
                }
            }
            else {
                echo "<script>alert('Istnieje uzytkownik o tym Emailu');</script>";
            }
        }
    
    ?>

</body>
</html>