<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/konto/style-favorite-route.css">
	<title>Ulubione trasy - Szlakiem Szczecina</title>
</head>
<body>

    <h3>Polubione Trasy</h3>

	<?php include("get_objects_routes/route.php"); ?>

	<div id="routesMainHolder">
		<form method="POST">
			<?php 
				//sql function
				$sql = "SELECT Trasy.* FROM Ulubione INNER JOIN Trasy ON Ulubione.Id_obiektu=Trasy.Id WHERE Ulubione.id_uzytkownika=3;";

				$objects = new GetRoutes();
				$objects->check_data_and_print($sql);
			?>
		</form>
	</div>

</body>
</html>