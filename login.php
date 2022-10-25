<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Zaloguj się - Szlakiem Szczecina</title>
</head>
<body>

    <form method="POST">
        <label for="input:[type=text]">Login</label>
        <input type="text" name="login"></br>

        <label for="input:[type=password]">Password</label>
        <input type="password" name="password"></br>
        
        <label for="input:[type=checkbox]">Cookie</label>
        <input type="checkbox" name="cookie"></br>

        <button type="submit" name="submit">Sign in</button>
    </form>

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
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
            }

            function search_user() {
                global $con;

                $sql = "SELECT * FROM users WHERE login='{$_SESSION['login']}'";
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
                    $this->get_data();
                    if($row['password'] == $_SESSION['password']) {
                        header("Location: main.php");
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