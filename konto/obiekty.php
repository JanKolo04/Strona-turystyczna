<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/konto/style-favorite.css">
	<title>Ulubione obiekty - Szlakiem Szczecina</title>
</head>
<body>

    <h3>Polubione obiekty</h3>

	<?php

		include("get_objects_routes/objects.php");
	
	?>

	<div id="objectsMainHolder">
		<form method="POST">
			<?php 
				//sql function
				$sql = "SELECT Obiekty.*, Trasy.Nazwa AS 'trasa_nazwa' FROM Ulubione INNER JOIN Obiekty ON Ulubione.Id_obiektu=Obiekty.Id INNER JOIN Trasy ON Obiekty.Id_trasa=Trasy.Id WHERE Ulubione.id_uzytkownika=3;";

				$objects = new GetObjects();
				$objects->check_data_and_print($sql);
			?>
		</form>
	</div>

</body>
</html>