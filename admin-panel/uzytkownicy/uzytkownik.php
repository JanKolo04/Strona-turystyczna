<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php

        function get_data_from_form() {
            global $con;

            //array with all user data from form
            $new_user_array = {
                "Name"=>$_POST['name'],
                "Nazwisko"->$_POST['surname'],
                "Email"=>$_POST['email'],
                "Date_birth"=>$_POST['birth_date']
            };

            return $new_user_array; //return array
        }

    ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Imie...">
        <input type="text" name="surname" placeholder="Nazwisko...">
        <input type="email" name="email" placeholder="Email...">
        <input type="date" name="birth_date">

        <button type="submit" name="add_user">Dodaj</button>
    </form>

</body>
</html>