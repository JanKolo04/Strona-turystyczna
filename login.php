<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
	<title>Zaloguj się - Szlakiem Szczecina</title>
</head>
<body>

    <div id="content-holder">
        <div id="img-holder"></div>
        <div id="other-content-holder">
            <div id="header">
                <h1>Logowanie</h1>
                <p>Wpisz swój login i hasło</p>
            </div>
            <div id="login-data-holder">
                <form method="POST">
                    <div id="inputs-holder">
                        <input type="text" name="email" placeholder="Email" class="input">
                        <input type="password" name="password" placeholder="Hasło" class="input">
                    </div>
                    <div id="other-data-holder">
                        <div id="button-holder">
                            <button type="submit" name="submit">Zatwierdź</button>
                        </div>
                        <div id="register-link-holder">
                            <p>Jeśli nie masz konta to? <a id="registrer-link" href="index.php?strona=register">Kliknij tutaj</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

        if(isset($_COOKIE['autologin'])) {
            $_SESSION['login'] = $_COOKIE['autologin'];
        }

        if(isset($_POST['cookie'])) {
            //set COOKIE for autologin
            setcookie("autologin", $_SESSION['login'], time() + (86400 * 30), "/");
        }

        if(isset($_POST['submit'])) {
            $loginClass = new Login();
            //compare data
            $loginClass->compare();
        }

        class Login {
            function get_data() {
                $_SESSION['login'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
            }

            function search_user() {
                global $con;

                $this->get_data();
                $sql = "SELECT * FROM Uzytkownicy WHERE Email='{$_SESSION['login']}'";
                $query = $con->query($sql);

                if($query->num_rows > 0) {
                    $row = $query->fetch_array(MYSQLI_ASSOC);
                    return $row;
                }
                else {
                    return false;
                }
            }

            function compare() {
                $row = $this->search_user();

                if($row != false) {
                    if($row['Haslo'] == $_SESSION['password']) {
                        header("Location: index.php");
                    }
                    else {
                        echo "Hasło nie poprawne";
                    }
                }
                else {
                    echo "Nie ma takiego uzytkownika";
                }
            }
        }
    
    ?>

</body>
</html>