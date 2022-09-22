<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

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
                "Date_birth"=>$_POST['birth_date']
            ];

            return $new_user_array; //return array
        }

        function add_user() {
            global $con;

            //get data
            $user_data = get_data_from_form();

            //check for other user don't use same email
            $sql_check = "SELECT * FROM uzytkownicy WHERE Email='{$user_data['Email']}'";
            $query_check = mysqli_query($con, $sql_check);

            if($query_check->num_rows == 0) {
                //add user
                $sql_insert = "INSERT INTO uzytkownicy(Imie, Nazwisko, Email, Data_urodzenia) VALUES('{$user_data['Name']}', '{$user_data['Surname']}', '{$user_data['Email']}', '{$user_data['Date_birth']}');";
                $query_insert = mysqli_query($con, $sql_insert);

                echo "Dodano użytkownika";
            }
            else {
                echo "Instnieje użytkownik o tym Emailu";
            }
        }

    ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Imie..." required>
        <input type="text" name="surname" placeholder="Nazwisko..." required>
        <input type="email" name="email" placeholder="Email..." required>
        <input type="text" name="birth_date" placeholder="YYYY-MM-DD" pattern="(?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31)))" required>

        <button type="submit" name="add_user">Dodaj</button>
    </form>

</body>
</html>