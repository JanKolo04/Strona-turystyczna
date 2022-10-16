<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-my-account.css">
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
                    <a href="index.php?strona=konto/konto&category=your-data">Twoje dane</a>
                    <a href="index.php?strona=konto/konto&category=favorite">Ulubione</a>
                    <a href="index.php?strona=konto/konto&category=history-of-purchased-trips">Historia kupionych wycieczek</a>
                </div>
            </div>
        </div>

        <div id="right-side">

            <?php include($category_account.".php"); ?>

        </div>
    </div>

</body>
</html>