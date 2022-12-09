<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasa.css">
    <title>Dodaj trase</title>
</head>
<body>

    <div id="content-holder">
        <div id="header">
            <h1>Dodawanie nowej trasy</h1>
        </div>
        <div id="login-data-holder">
            <form method="POST">
                <div id="inputs-holder">
                    <input type="text" name="name" placeholder="Nazwa" class="input">
                    <input type="text" name="beginning" placeholder="Poczatek" class="input">
                    <input type="text" name="end" placeholder="Koniec" class="input">
                    
                    <div id="hard-level">
                        <p><strong>Wybierz poziom trudnosci trasy</strong></p>
                        <div id="inputs-labels">
                            <label for="easy">Łatwa</label>
                            <input type="radio" name="level" value="Łatwa" id="first">

                            <div id="margin-radio">
                                <label for="middle">Średnia</label>
                                <input type="radio" name="level" value="Średnia">
                            </div>

                            <label for="hard">Trudna</label>
                            <input type="radio" name="level" value="Trudna">
                        </div>
                    </div>

                    <div id="category-select">
                        <select name="category">
                            <option selected disabled>Wybierz kategorie</option>
                            <option>Modernizm</option>
                            <option>Barok</option>
                        </select>
                    </div>

                    <textarea name="description" placeholder="Krótki opis trasy, maksymalnie 150 znaków..." maxlength=150></textarea>
                    <textarea name="info" placeholder="Cały opis trasy, maksymalnie 350 znaków..." maxlength=350></textarea>
                </div>
                <div id="other-data-holder">
                    <div id="button-holder">
                        <button type="submit" name="add_route">Zatwierdź</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php

        if(isset($_POST['add_route'])) {
            add_route();
        }

        function add_route() {
            global $con;

            //check for other user don't use same email
            $sql_check = "SELECT * FROM Trasy WHERE Nazwa='{$_POST['name']}'";
            $query_check = mysqli_query($con, $sql_check);

            if($query_check->num_rows == 0) {
                //add user
                $sql_insert = "INSERT INTO Trasy(Nazwa, Poczatek, Koniec, Trudnosc, Opis, Informacje, Kategoria) VALUES('{$_POST['name']}', '{$_POST['beginning']}', '{$_POST['end']}', '{$_POST['level']}', '{$_POST['category']}', '{$_POST['description']}', '{$_POST['info']}');";
                $query_insert = mysqli_query($con, $sql_insert);

                if(!$query_insert) {
                    echo "<script>alert('Coś poszło nie tak');</script>";
                }
                else {
                    echo "<script>alert('Dodano trase');</script>";
                }
            }
            else {
                echo "<script>alert('Istnieje trasa o tej nazwie');</script>";
            }
        }

    ?>

</body>
</html>