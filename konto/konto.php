<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/konto/style-my-account.css">
</head>
<body>

    <?php
    
        $category_account = "your-data";
        if(isset($_GET['category'])) {
            $category_account = $_GET['category'];
        }
    
    ?>

    <div id="my-account-all-section">
        <div id="left-side">
            <div id="avatar-holder">
                <div id="avatar">
                    <img id="avatar-photo" src="https://www.w3schools.com/howto/img_avatar.png">
                </div>
            </div>

            <div id="name-surname">
                <p>Jan Kołodziej</p>
            </div>
            
            <div id="menu">
                <div id="a-holder">
                    <a id="your-data" href="index.php?strona=konto/konto&category=your-data">Twoje dane</a>
                    
                    <p id="favorite">Ulubione</p>
                    <a id="obiekty" href="index.php?strona=konto/konto&category=obiekty">Obiekty</a>
                    <a id="trasy" href="index.php?strona=konto/konto&category=trasy">Trasy</a>

                    <a id="history-of-purchased-trips" href="index.php?strona=konto/konto&category=history-of-purchased-trips">Historia kupionych wycieczek</a>
                </div>
            </div>
        </div>

        <div id="right-side">

            <?php include($category_account.".php"); ?>

        </div>
    </div>

    <script>

        function change_menu_option_color() {
            //get page from PHP
            let page = <?php echo json_encode($category_account); ?>;

            //change color
            document.querySelector("#"+page).style = "color: black; font-weight: bold;";
        
        }

        window.onload = function() {
            change_menu_option_color();
        }

    </script>

</body>
</html>