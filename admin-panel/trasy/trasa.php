<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-trasa.css">
    <title>Dodaj trase</title>
</head>
<body>

    <?php

        if(isset($_POST['add_route'])) {
            update_data();
        }

        $array = print_data();

        function print_data() {
            global $con;
            //print current data about choosen route
            $sql = "SELECT * FROM Trasy WHERE Id={$_GET['id']}";
            $query = $con->query($sql);

            if($query->num_rows > 0) {
                $row = $query->fetch_assoc();
                return $row;
            }
        }

        function update_data() {
            global $con;
            //update chnages 
            $sql = "UPDATE Trasy SET Nazwa='{$_POST['name']}', Poczatek='{$_POST['beginning']}', Koniec='{$_POST['end']}', Trudnosc='{$_POST['level']}', Opis='{$_POST['description']}', Informacje='{$_POST['info']}', Kategoria='{$_POST['category']}' WHERE Id={$_GET['id']}";
            $query = $con->query($sql);
        }

    ?>

    <div id="content-holder">
        <div id="header">
            <h1>Edytuj trase</h1>
        </div>
        <div id="login-data-holder">
            <form method="POST">
                <div id="inputs-holder">
                    <input type="text" name="name" placeholder="Nazwa" class="input" value="<?php echo $array['Nazwa']; ?>">
                    <input type="text" name="beginning" placeholder="Poczatek" class="input" value="<?php echo $array['Poczatek']; ?>">
                    <input type="text" name="end" placeholder="Koniec" class="input" value="<?php echo $array['Koniec']; ?>">
                    
                    <div id="hard-level">
                        <p><strong>Wybierz poziom trudnosci trasy</strong></p>
                        <div id="inputs-labels">
                            <label for="easy">Łatwa</label>
                            <input type="radio" name="level" value="Łatwy">

                            <div id="margin-radio">
                                <label for="middle">Średnia</label>
                                <input type="radio" name="level" value="Średni">
                            </div>

                            <label for="hard">Trudna</label>
                            <input type="radio" name="level" value="Trudny">
                        </div>
                    </div>

                    <div id="category-select">
                        <select name="category">
                            <option selected disabled>Wybierz kategorie</option>
                            <option>Modernizm</option>
                            <option>Barok</option>
                        </select>
                    </div>

                    <textarea name="description" placeholder="Krótki opis trasy, maksymalnie 150 znaków..." maxlength=150><?php echo $array['Opis']; ?></textarea>
                    <textarea name="info" placeholder="Cały opis trasy, maksymalnie 350 znaków..." maxlength=350><?php echo $array['Informacje']; ?></textarea>
                </div>
                <div id="other-data-holder">
                    <div id="button-holder">
                        <button type="submit" name="add_route">Zatwierdź</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function choose_radio() {
            //get all radio
            let all_radio = document.querySelectorAll("input[type='radio']");
            //selected level
            let selected_level = <?php echo json_encode($array['Trudnosc']); ?>;
            
            //check which value of input[type=radio] ecuals selected level
            for(let i=0; i<all_radio.length; i++) {
                if(all_radio[i].value == selected_level) {
                    all_radio[i].click();
                }
            }
        }

        choose_radio();

        function choose_option() {
            //get select
            let options = document.querySelector("select");
            //selected category
            let category = <?php echo json_encode($array['Kategoria']); ?>;

            //check which category ecuals into option from select
            for(let i=0; i<options.length; i++) {
                if(options[i].innerHTML == category) {
                    options[i].selected = "selected";
                }
            }
            
        }

        choose_option();
    </script>

</body>
</html>