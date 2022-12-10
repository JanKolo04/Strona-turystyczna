<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-architekt.css">
    <title>Dodaj architekta</title>
</head>
<body>

    <?php

        if(isset($_POST['add_architect'])) {
            $arch = new architect();
            $arch->insert();
        }

        class architect {
            function check() {
                global $con;

                //check if architect exist in database
                $sql = "SELECT * FROM Architekci WHERE Imie='{$_POST['name']}' AND Nazwisko='{$_POST['surname']}'";
                $query = $con->query($sql);

                //if architect exist return Flase, but if doesnt return True
                if($query->num_rows > 0) {
                    return False;
                }
                else {
                    return True;
                }
            }

            function insert() {
                global $con;

                //if check return True insert new architect
                if($this->check() == True) {
                    $sql = "INSERT INTO Architekci(Imie, Nazwisko) VALUES('{$_POST['name']}', '{$_POST['surname']}')";
                    $query = $con->query($sql);
                }
                else {
                    echo "Istnieje architekt o tym imieniu i nazwisku";
                }
            }
        }

    ?>

    <div id="content-holder">
        <div id="header">
            <h1>Dodaj architekta</h1>
        </div>
        <div id="login-data-holder">
            <form method="POST">
                <div id="inputs-holder">
                    <input type="text" name="name" placeholder="Imie" class="input">
                    <input type="text" name="surname" placeholder="Nazwisko" class="input">
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