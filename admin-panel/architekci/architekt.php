<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-architekt.css">
    <title>Edycja architekta</title>
</head>
<body>

    <?php

        if(isset($_POST['add_architect'])) {
            update_data();
        }

        $array = print_data();

        function print_data() {
            global $con;
            //print current data about choosen route
            $sql = "SELECT * FROM Architekci WHERE Id={$_GET['id']}";
            $query = $con->query($sql);

            if($query->num_rows > 0) {
                $row = $query->fetch_assoc();
                return $row;
            }
        }

        function update_data() {
            global $con;
            //update chnages 
            $sql = "UPDATE Architekci SET Imie='{$_POST['name']}', Nazwisko='{$_POST['surname']}' WHERE Id={$_GET['id']}";
            $query = $con->query($sql);
        }

    ?>

    <div id="content-holder">
        <div id="header">
            <h1>Edytuj architekta</h1>
        </div>
        <div id="login-data-holder">
            <form method="POST">
                <div id="inputs-holder">
                    <input type="text" name="name" placeholder="Imie" class="input" value="<?php echo $array['Imie']; ?>">
                    <input type="text" name="surname" placeholder="Nazwisko" class="input" value="<?php echo $array['Nazwisko']; ?>">
                </div>

                <div id="other-data-holder">
                    <div id="button-holder">
                        <button type="submit" name="add_architect">Zatwierdź</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    

</body>
</html>